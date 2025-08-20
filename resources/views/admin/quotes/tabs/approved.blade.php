<div class="card mt-2">
  <div class="card mt-2">
    <div class="card-header">
      <h4 class="card-title">Approved Orders</h4>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table">
          <thead>
            <tr>
              <th>Date & Time</th>
              <th>quote ID</th>
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
            @forelse($approvedQuotes as $quote)
            <tr>
              <td>{{ $quote->created_at->format('Y-m-d H:i') }}</td>
              <td>#{{ $quote->quote_number }}</td>
              <td>#{{ $quote->order_number ?? '-' }}</td>
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
              <button class="btn btn-sm btn-success mb-1 process-to-dept-btn" data-toggle="modal"
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

            <div id="quote-notes-{{ $quote->id }}" class="d-none">
              @foreach($quote->departments as $department)
            <div class="col-md-6">
            <div class="card border mb-3">
            <div class="card-body">
            <p><strong>Date & Time:</strong> {{ $department->pivot->created_at ?? '-' }}</p>
            <p><strong>Department:</strong> {{ $department->name }}</p>
            <p><strong>Notes:</strong> <span class="note-text">{{ $department->pivot->notes ?? '-' }}</span></p>

            <!-- Add Edit Button -->
            <button class="btn btn-sm btn-warning edit-note-btn" data-quote-id="{{ $quote->id }}"
              data-department-id="{{ $department->id }}" data-department-name="{{ $department->name }}"
              data-notes="{{ $department->pivot->notes }}">
              Edit
            </button>

            </div>
            </div>
            </div>
          @endforeach
            </div>


      @empty
        <tr>
          <td colspan="5" class="text-center">No approved orders found.</td>
        </tr>
      @endforelse
          </tbody>

        </table>
      </div>
    </div>
  </div>

</div>