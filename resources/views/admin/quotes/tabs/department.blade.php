<div class="card mt-2">
  <div class="card-header">
    <h4 class="card-title">{{ $department->name }}</h4>
  </div>

  <div class="card-body">
    @if(isset($departmentQuotes[$department->id]) && count($departmentQuotes[$department->id]))
    <div class="table-responsive">
      <table class="table">
      <thead>
        <tr>
        <th>Date & Time</th>
        <th>Quote ID</th>
        <th>Order ID</th>
        <th>Product</th>
        <th>Billed Amount</th>
        <th>Payment Status</th>
        <th>Order Status</th>
        <th>Customer Info</th>
        <th>Action</th>
        </tr>
      </thead>
      <tbody>
        @foreach($departmentQuotes[$department->id] as $quote)
      @php $pivot = $quote->departments->firstWhere('id', $department->id)?->pivot; @endphp
      <tr>
      <td>{{ $quote->created_at->format('Y-m-d H:i') }}</td>
      <td>#{{ $quote->quote_number }}</td>
      <td>#{{ $quote->order_number }}</td>

      <td>
        {{ optional($quote->items->first()->subcategory->categories->first())->name ?? '-' }}
        >
        {{ optional($quote->items->first()->subcategory)->name ?? '-' }}
      </td>

      <td>£{{ number_format($quote->grand_total, 2) }}</td>

      <td> @if($quote->payments->isEmpty())
      <!-- No payment exists, show Pay Now -->
      <span class="badge badge-danger">UnPaid</span>
      @else
      <!-- Payment exists, show Paid badge -->
      <span class="badge badge-success">Paid</span>
      @endif
      </td>

      <td>{{ $quote->status ?? '' }}</td>

      <td>
        {{ $quote->customer->first_name ?? '-' }} {{ $quote->customer->last_name ?? '' }}<br>
        {{ $quote->customer->email ?? '-' }}<br>
        {{ $quote->customer->mobile ?? '-' }}
      </td>

      <td>
        @if($quote->payments->isEmpty())
      <!-- No payment exists, show Pay Now -->
      <button class="btn btn-sm btn-success pay-now-btn mb-1" data-quote-id="{{ $quote->id }}"
      data-order-value="{{ $quote->grand_total }}">
      Pay Now
      </button>
      @else
      <a href="{{ route('admin.quotes.invoice', $quote->id) }}" class="btn btn-sm btn-dark mb-1">View
      Invoice</a>
      @endif
        <a href="{{ route('admin.quote.show', $quote->id) }}" class="btn btn-sm btn-info mb-1">View
        Order Details</a>
        <a href="{{ route('admin.customers.detail', $quote->customer->id) }}"
        class="btn btn-sm btn-primary mb-1">View Customer Detail</a>
        <button class="btn btn-sm btn-success process-to-dept-btn mb-1" data-toggle="modal"
        data-target="#processToDepartmentModal" data-quote-id="{{ $quote->id }}"
        data-used-departments="{{ $quote->departments->pluck('id')->implode(',') }}">
        Process to Department
        </button>
        <button class="btn btn-sm btn-secondary mb-1 view-notes-btn" data-toggle="modal"
        data-target="#viewNotesModal" data-quote-id="{{ $quote->id }}">
        View All Notes
        </button>

        <button class="btn btn-sm btn-danger mb-1 cancel-order-btn" data-quote-id="{{ $quote->id }}">
        Cancel Order
        </button>

      </td>

      </tr>
      @endforeach
      </tbody>
      </table>
    </div>
  @else
    <div class="text-muted">No quotes assigned to {{ $department->name }} yet.</div>
  @endif
  </div>
</div>