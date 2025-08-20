@extends('layouts.master')

@section('content')
    <div class="app-content content mb-3">
        <div class="content-wrapper">
            <div class="content-body">
                <div class="card p-4 shadow-sm" style="max-width: 900px; margin: auto; background: #fff;">

                    {{-- Header Section --}}
                    <div class="d-flex justify-content-between align-items-start mb-4">
                        <div>
                            <h2 class="mb-0" style="font-weight:700;">INVOICE</h2>
                            <small class="text-muted"
                                style="font-weight:600;">#{{ $invoice->invoice_number ?? 'N/A' }}</small>
                        </div>
                        <div>
                            <img src="{{ asset('admin_assets/images/logo.png') }}" alt="Logo" style="height: 30px;">
                        </div>
                    </div>

                    {{-- Issued/Billed/From Info --}}
                    <div class="row border-top border-bottom   mb-4" style="font-size: 14px;">
                        <div class="col-md-4 p-2">
                            <strong class="mb-1">Info</strong>
                            <hr>
                            <p class="" style="margin-bottom:6px;"><strong>Invoice Date:</strong>
                                {{ \Carbon\Carbon::parse($invoice->invoice_date)->format('d M, Y') }}</p>
                            <p style="margin-bottom:6px;"> <strong>Order Id: </strong>
                                #{{ $quote->order_number }}</p>
                            <p style="margin-bottom:6px;"> <strong>Payment Status: </strong>
                                {{ $payments->sum('amount_received') >= $quote->grand_total ? 'Paid' : 'Unpaid' }}</p>
                            <p style="margin-bottom:6px;"> <strong>Payment Method: </strong>
                                {{ $payments->last()->payment_method ?? 'N/A' }}</p>
                            <p style="margin-bottom:6px;"> <strong>Payment Date:
                                </strong>{{ \Carbon\Carbon::parse($payments->last()->payment_date)->format('d M, Y') ?? 'N/A' }}
                            </p>

                        </div>
                        <div class="col-md-4 border-left border-right p-2">
                            <strong class="mb-1">Billed to</strong>
                            <hr>
                            <p class="" style="margin-bottom:6px;font-weight:600;">
                                {{ $customer->first_name ?? '-'}}
                                {{ $customer->last_name ?? '' }}
                            </p>
                            <p class="" style="margin-bottom:6px;">{{ $quote->billingAddress->address }}</p>

                            <p style="margin-bottom:4px; ">{{ $customer->mobile ?? '' }}</p>
                            <p class="text-blue" style="margin-bottom:6px; color:blue;">{{ $customer->email ?? '' }}</p>
                        </div>
                        <div class="col-md-4 p-2">
                            <strong class="mb-1">From</strong>
                            <hr>

                            <p class="" style="margin-bottom:6px;font-weight:600;">Nuvem Print</p>
                            <p class="" style="margin-bottom:6px; ">Unit 7 Lotherton Way Garforth Leeds LS252JY</p>

                            <!--<p class="mb-1">www.company.com</p>-->
                            <p style="margin-bottom:4px; "> 01132 874724</p>
                            <p class=" text-blue" style="color:blue;">andy@nuvemprint.com</p>
                        </div>
                    </div>

                    {{-- Item Table --}}
                    <h5 class="mb-2">Item Summary</h5>
                    <div class="table-responsive">
                        <table class="table table-bordered" style="font-size: 14px;">
                            <thead class="thead-light">
                                <tr>
                                    <th>Description</th>
                                    <th>Qty</th>
                                    <th>Rate (£)</th>
                                    <th>Total (£)</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($quote->items as $item)
                                    <tr>
<td>
    {{-- Subcategory + Category --}}
    <div style="font-weight: 600;">
        {{ $item->subcategory->name ?? 'N/A' }}
        ({{ optional($item->subcategory->categories->first())->name ?? 'N/A' }})
    </div>

    {{-- Attributes --}}
    @if ($item->attributes && $item->attributes->count())
        <div style="margin-top: 5px;">
              @foreach ($item->attributes as $attr)
  <div style="font-size: 13px; margin-left: 8px;">
    <strong>{{ $attr->attribute->name ?? '' }}:</strong>
    @if ($attr->attributeValue)
      {{ $attr->attributeValue->value }}
    @elseif ($attr->length && $attr->width)
      {{ $attr->length }} x {{ $attr->width }} {{ $attr->unit }}
    @elseif ($attr->length)
      {{ $attr->length }} {{ $attr->unit }}
    @else
      -
    @endif
  </div>
@endforeach

        </div>
    @endif

 
    {{-- Number of Pages --}}
    @if (!is_null($item->pages))
        <div style="margin-top: 5px; font-size: 13px; margin-left: 8px;">
            <strong>Pages:</strong> {{ $item->pages }}
        </div>
    @endif

</td>

                                        <td>{{ $item->quantity }}</td>
                                        <td> {{ $item->quantity > 0 ? number_format($item->sub_total / $item->quantity, 2) : '0.00' }}</td>
                                        <td>{{ number_format($item->sub_total, 2) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    {{-- Totals --}}
                    <div class="row justify-content-end mt-4">
                        <div class="col-md-5">
                            <table class="table table-borderless">
                                <tr>
                                    <th>Subtotal:</th>
                                    <td class="text-right">£{{ number_format($quote->items->sum('sub_total') + ($quote->proof_price ?? 0), 2) }}</td>
                                </tr>
                                <tr>
                                    <th>Delivery Charge:</th>
                                    <td class="text-right">£{{ number_format($quote->delivery_price, 2) }}</td>
                                </tr>
                                 <tr>
                                    <th>Proof Reading:</th>
                                    <td class="text-right">£{{ number_format($quote->proof_price, 2) }}</td>
                                </tr>
                                <tr>
                                    <th>VAT ({{ (int)$quote->vat_percentage }}%):</th>
                                    <td class="text-right">£{{ number_format($quote->vat_amount, 2) }}</td>
                                </tr>
                            
                                <tr class="font-weight-bold "
                                    style="font-size: 18px; color: #6B3DF4; border-top:2px solid #6B3DF4; border-bottom:2px solid #6B3DF4;">
                                    <th><strong>Total</strong></th>
                                    <td class="text-right"><strong>£{{ number_format($quote->grand_total, 2) }}</strong></td>
                                </tr>
                            </table>

                        </div>
                    </div>

                    {{-- Actions --}}
                    <div class="row justify-content-center mt-4">
                        <div class="col-md-3">
                            <a href="{{ route('admin.invoices.download', $quote->id) }}" class="btn btn-outline-primary btn-block">
                                Download Invoice
                            </a>
                        </div>
                        <div class="col-md-3">
                            <button class="btn btn-outline-success btn-block">Send via Email</button>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection