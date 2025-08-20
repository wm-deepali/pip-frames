<div class="card mt-2">
  <div class="card-header">
    <h4 class="card-title">Quote Requests - New Orders</h4>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table">
        <thead>
          <tr>
            <th>Date & Time</th>
            <th>Quote ID</th>
            <th>Product</th>
            <th>Billed Amount</th>
            <th>Payment Status</th>
            <th>Order Status</th>
            <th>Customer Info</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach($quotes as $quote)
        <tr>
        <td>{{ $quote->created_at->format('Y-m-d H:i') }}</td>
        <td>#{{ $quote->quote_number }}</td>
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
          <a href="{{ route('admin.quotes.invoice', $quote->id) }}"
            class="btn btn-sm btn-dark mb-1">View Invoice</a>
          @endif
          <a href="{{ route('admin.quote.show', $quote->id) }}" class="btn btn-sm btn-info mb-1">View
          Order
          Detail</a>
          <a href="{{ route('admin.customers.detail', $quote->customer->id) }}"
          class="btn btn-sm btn-primary mb-1">View Customer Detail</a>
          <button class="btn btn-sm btn-warning mb-1 change-status-btn" data-toggle="modal"
          data-target="#changeStatusModal" data-quote-id="{{ $quote->id }}">
          Change Status
          </button>
          <!-- <a href="{{ route('admin.quote.index') }}" class="btn btn-sm btn-dark mb-1">View Invoice</a> -->
        </td>
        </tr>
      @endforeach

        </tbody>
      </table>
    </div>
  </div>
</div>