<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Quote #{{ $quote->quote_number }}</title>
    {{-- Embedded Bootstrap + Custom CSS for PDF (DomPDF only supports inline/local CSS) --}}
    <style>
        {!! file_get_contents(public_path('admin_assets/css/bootstrap.min.css')) !!}
        {!! file_get_contents(public_path('admin_assets/css/style.css')) !!}
    </style>
</head>

<body>
    <div class="content-body">
        <div class="card">
            <div class="card-body">

                {{-- Company Logo --}}
                <div class="text-center mb-3">
                    <img src="{{ public_path('admin_assets/images/logo.png') }}" alt="Company Logo"
                        style="max-width: 200px;">
                </div>

                {{-- Order ID + Status --}}
                <div class="row mb-4">
                    <div class="col-md-6">
                        <h5><strong>Order ID:</strong> #{{ $quote->quote_number }}</h5>
                        <h5>
                            <strong>Payment Status:</strong>
                            @if($quote->payments->isEmpty())
                                <span class="badge badge-danger">UnPaid</span>
                            @else
                                <span class="badge badge-success">Paid</span>
                            @endif
                        </h5>
                        <h5>
                            <strong>Order Status:</strong>
                            @if($quote->status === 'cancelled')
                                <span class="badge badge-danger">Cancelled</span>
                            @elseif($quote->status === 'approved')
                                <span class="badge badge-success">Approved</span>
                            @else
                                <span class="badge badge-secondary text-capitalize">{{ $quote->status ?? 'Pending' }}</span>
                            @endif
                        </h5>

                    </div>


                </div>

                {{-- Customer & Company Info --}}
                <div class="row border p-3 mb-4">
                    <div class="col-md-6">
                        <h5><strong>Customer Info</strong></h5>
                        <p><strong>Name:</strong> {{ $quote->customer->first_name ?? 'N/A' }}
                            {{ $quote->customer->last_name ?? '' }}
                        </p>
                        <p><strong>Contact:</strong> {{ $quote->customer->mobile ?? 'N/A' }}</p>
                        <p><strong>Email:</strong> {{ $quote->customer->email ?? 'N/A' }}</p>
                        <p><strong>Expected Delivery:</strong>
                            {{ \Carbon\Carbon::parse($quote->delivery_date)->format('d F Y') ?? 'N/A' }}</p>
                        <p><strong>Date & Time:</strong> {{ $quote->created_at->format('d F Y, h:i A') ?? 'N/A' }}</p>
                        <p><strong>Delivery Address:</strong>
                            {{ $quote->deliveryAddress->address ?? '' }}, {{ $quote->deliveryAddress->city ?? '' }},
                            {{ $quote->deliveryAddress->postcode ?? '' }},
                            {{ $quote->deliveryAddress->country_name ?? '' }}
                        </p>

                    </div>
                    <div class="col-md-6 text-right">
                        <h5><strong>Company Info</strong></h5>
                        <p><strong>Name:</strong> My Company Name</p>
                        <p><strong>Contact:</strong> 0-00-000-000</p>
                        <p><strong>Email:</strong> yourcompany@gmail.com</p>
                        <p><strong>Address:</strong> Company Street, NY 1001-234</p>
                        <p><strong>Website:</strong> www.company.com</p>
                    </div>
                </div>

                {{-- Quote Items --}}
                {{-- Quote Items --}}
                <h5 class="mb-2">Quote Items</h5>
                <div class="table-responsive">
                    @php
                        $totalExtraOptions = 0;
                        foreach ($quote->items as $item) {
                            $options = json_decode($item->extra_options, true) ?: [];
                            foreach ($options as $opt) {
                                if (!empty($opt['price']) && floatval($opt['price']) > 0) {
                                    $totalExtraOptions += floatval($opt['price']);
                                }
                            }
                        }
                    @endphp

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
                                @php
                                    $extraOptions = json_decode($item->extra_options, true) ?: [];
                                    $extraOptionsTotal = 0;
                                    foreach ($extraOptions as $opt) {
                                        if (!empty($opt['price']) && floatval($opt['price']) > 0) {
                                            $extraOptionsTotal += floatval($opt['price']);
                                        }
                                    }
                                    $itemTotalWithExtras = $item->sub_total + $extraOptionsTotal;
                                    $rate = ($item->quantity > 0) ? $itemTotalWithExtras / $item->quantity : 0;
                                  @endphp
                                <tr>
                                    <td>
                                        <div style="font-weight: 600; margin-bottom: 5px;">
                                            {{ $item->subcategory->name ?? 'N/A' }}
                                            ({{ optional($item->subcategory->categories->first())->name ?? 'N/A' }})
                                        </div>
                                        @if ($item->attributes->count())
                                            @foreach ($item->attributes as $attribute)
                                                <div style="font-size: 13px; margin-left: 8px;">
                                                    <strong>{{ $attribute->attribute->name ?? '' }}:</strong>
                                                    @if ($attribute->attributeValue)
                                                        {{ $attribute->attributeValue->value }}
                                                    @elseif ($attribute->length && $attribute->width)
                                                        {{ $attribute->length }} x {{ $attribute->width }} {{ $attribute->unit }}
                                                    @elseif ($attribute->length)
                                                        {{ $attribute->length }} {{ $attribute->unit }}
                                                    @else
                                                        -
                                                    @endif
                                                </div>
                                            @endforeach
                                        @endif

                                        @if($item->pet_name || $item->pet_birthdate || $item->personal_text || $item->note)
                                            <div
                                                style="margin-top: 8px; font-size: 13px; background-color: #f8f9fa; padding: 5px; border-radius: 5px;">
                                                <strong>Pet Details:</strong><br>
                                                @if($item->pet_name)
                                                <div>Name: {{ $item->pet_name }}</div>@endif
                                                @if($item->pet_birthdate)
                                                <div>Birthdate: {{ $item->pet_birthdate->format('d M Y') }}</div>@endif
                                                @if($item->personal_text)
                                                <div>Personal Text: {{ $item->personal_text }}</div>@endif
                                                @if($item->note)
                                                <div>Note: {{ $item->note }}</div>@endif
                                            </div>
                                        @endif

                                        @if(count($extraOptions))
                                            <div style="margin-top: 8px;">
                                                <strong>Extra Options:</strong><br>
                                                @foreach ($extraOptions as $opt)
                                                    <span
                                                        style="background: #17a2b8; color: #fff; padding: 3px 8px; margin-right: 4px; border-radius: 12px; font-size: 12px;">
                                                        {{ $opt['title'] }}
                                                        @if(!empty($opt['price']) && floatval($opt['price']) > 0)(£{{ number_format(floatval($opt['price']), 2) }})@endif
                                                    </span>
                                                @endforeach
                                            </div>
                                        @endif
                                    </td>
                                    <td>{{ $item->quantity }}</td>
                                    <td>£{{ number_format($rate, 2) }}</td>
                                    <td>£{{ number_format($itemTotalWithExtras, 2) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    {{-- Totals --}}
                    @php
                        $subtotalWithExtras = $quote->items->sum('sub_total') + $totalExtraOptions + ($quote->proof_price ?? 0);
                    @endphp

                    <div class="row justify-content-end mt-4">
                        <div class="col-md-5">
                            <table class="table table-borderless">
                                <tr>
                                    <th>Subtotal:</th>
                                    <td class="text-right">£{{ number_format($subtotalWithExtras, 2) }}</td>
                                </tr>
                                <tr>
                                    <th>Delivery Charge:</th>
                                    <td class="text-right">£{{ number_format($quote->delivery_price, 2) }}</td>
                                </tr>
                                <tr>
                                    <th>VAT ({{ (int) $quote->vat_percentage }}%):</th>
                                    <td class="text-right">£{{ number_format($quote->vat_amount, 2) }}</td>
                                </tr>
                                <tr
                                    style="border-top: 2px solid #6B3DF4; border-bottom: 2px solid #6B3DF4; font-weight: bold; font-size: 18px; color: #6B3DF4;">
                                    <th>Total:</th>
                                    <td class="text-right">£{{ number_format($quote->grand_total, 2) }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>

                </div>



                {{-- Summary --}}
                <!-- <div class="row justify-content-end mt-4">
                    <div class="col-md-5">
                        <table class="table table-borderless">
                            <tr>
                                <th>Subtotal:</th>
                                <td class="text-right">
                                    £{{ number_format($quote->items->sum('sub_total') + ($quote->proof_price ?? 0), 2) }}
                                </td>
                            </tr>
                            <tr>
                                <th>Delivery Charge:</th>
                                <td class="text-right">£{{ number_format($quote->delivery_price, 2) }}</td>
                            </tr>
                            <tr>
                                <th>VAT ({{ (int) $quote->vat_percentage }}%):</th>
                                <td class="text-right">£{{ number_format($quote->vat_amount, 0) }}</td>
                            </tr>
                            <tr class="border-top">
                                <th><strong>Grand Total:</strong></th>
                                <td class="text-right"><strong>£{{ number_format($quote->grand_total, 2) }}</strong>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div> -->


                {{-- Horizontal Line --}}
                <!-- <hr> -->

                {{-- Customer Documents --}}
                <!-- <h5>Customer Documents</h5>
                <div class="table-responsive">
                    <table class="table table-bordered mt-2">
                        <thead>
                            <tr>
                                <th>Remarks / Title</th>
                                <th>Thumbnail</th>
                                <th>View</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($quote->documents as $doc)
                                <tr>
                                    <td>{{ $doc->name ?? 'Untitled' }}</td>
                                    <td>
                                        @if(Str::endsWith($doc->path, ['.jpg', '.jpeg', '.png']))
                                            <img src="{{ asset('storage/' . $doc->path) }}" width="80" />
                                        @elseif(Str::endsWith($doc->path, '.pdf'))
                                            <img src="{{ asset('admin_assets/images/pdf.png')}}" width="40" alt="PDF" />
                                        @elseif(Str::endsWith($doc->path, ['.doc', '.docx']))
                                            <img src="{{ asset('admin_assets/images/google-docs.png') }}" width="40"
                                                alt="Word Doc" />
                                        @else
                                            <span class="text-muted">No Preview</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ asset('storage/' . $doc->path) }}" target="_blank"
                                            class="btn btn-sm btn-info">View</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center">No documents uploaded.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div> -->


                <!-- {{-- Action Buttons --}}
                <div class="row justify-content-center mt-4">
                    <div class="col-md-2">
                        <a href="{{ route('admin.quotes.download.pdf', $quote->id) }}" class="btn btn-primary btn-block"
                            target="_blank">
                            Download PDF
                        </a>

                    </div>
                    <div class="col-md-2">
                        <button class="btn btn-success btn-block">Send Email</button>
                    </div>
                </div> -->

            </div>
        </div>
    </div>


</body>

</html>