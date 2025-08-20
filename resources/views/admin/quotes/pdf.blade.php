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
                            {{ $quote->deliveryAddress->address ?? '' }}
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
                    <table class="table table-bordered">
                        <thead class="thead-light">
                            <tr>
                                <th style="width: 60%;">Detail</th>
                                <th style="width: 20%;">Quantity</th>
                                <th style="width: 20%;">Price (£)</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($quote->items as $item)
                                <tr>
                                    <td>
                                        {{-- Subcategory Name --}}
                                        <div style="font-weight: 600; margin-bottom: 4px;">
                                            {{ $item->subcategory->name ?? 'N/A' }}
                                            ({{ optional($item->subcategory->categories->first())->name ?? 'N/A' }})
                                        </div>

                                        {{-- Attribute Name-Value List --}}
                                        @if($item->attributes && $item->attributes->count())
                                            <div>
                                                @foreach($item->attributes as $attr)
                                                    <div style="font-size: 14px; margin-left: 10px;">
                                                        <strong>{{ $attr->attribute->name ?? 'Attribute' }}:</strong>
                                                        @if($attr->attributeValue)
                                                            {{ $attr->attributeValue->value }}
                                                        @elseif($attr->length && $attr->width)
                                                            {{ $attr->length }} x {{ $attr->width }} {{ $attr->unit }}
                                                        @elseif($attr->length)
                                                            {{ $attr->length }} {{ $attr->unit }}
                                                        @else
                                                            -
                                                        @endif
                                                    </div>
                                                @endforeach

                                            </div>
                                        @else
                                            <div class="text-muted" style="font-size: 13px; margin-left: 10px;">No attributes
                                                selected.</div>
                                        @endif

                                        {{-- Pages --}}
                                        @if (!is_null($item->pages))
                                            <div style="font-size: 14px; margin-left: 10px;">
                                                <strong> Pages:</strong> {{ $item->pages }}
                                            </div>
                                        @endif
                                    </td>

                                    <td>{{ $item->quantity }}</td>
                                    <td>{{ number_format($item->sub_total, 2) }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center">No quote items found.</td>
                                </tr>
                            @endforelse

                            {{-- Proofreading price row --}}
                            @if($quote->proof_type && $quote->proof_price)
                                <tr>
                                    <td><strong>Proof Type:</strong> {{ ucfirst($quote->proof_type) }}</td>
                                    <td>—</td>
                                    <td>{{ number_format($quote->proof_price, 2) }}</td>
                                </tr>
                            @endif

                        </tbody>
                    </table>
                </div>



                {{-- Summary --}}
                <div class="row justify-content-end mt-4">
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
                </div>


                {{-- Horizontal Line --}}
                <hr>

                {{-- Customer Documents --}}
                <h5>Customer Documents</h5>
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
                </div>


                {{-- Action Buttons --}}
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
                </div>

            </div>
        </div>
    </div>


</body>

</html>