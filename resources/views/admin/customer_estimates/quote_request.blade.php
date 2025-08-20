@extends('layouts.master')

@section('content')
  <div class="app-content content">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper">
    <div class="content-header row">
      <div class="col-md-12">
      <ul class="nav nav-tabs" id="orderTabs" role="tablist">
        <li class="nav-item">
        <a class="nav-link active" data-toggle="tab" data-tab="new-orders" href="#new-orders" role="tab">New
          Orders</a>
        </li>
        <li class="nav-item">
        <a class="nav-link" data-toggle="tab" data-tab="approved-orders" href="#approved-orders" role="tab">Approved
          Orders</a>
        </li>

        @foreach($departments as $department)
      @php $slug = Str::slug($department->name); @endphp
      <li class="nav-item">
      <a class="nav-link" data-toggle="tab" data-tab="{{ $slug }}" href="#{{ $slug }}" role="tab">
        {{ $department->name }}
      </a>
      </li>
      @endforeach

      </ul>



      <div class="tab-content" id="orderTabsContent">
        <!-- New Orders Tab -->
        <div class="tab-pane fade show active" id="new-orders" role="tabpanel">
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
              <th>Customer Info</th>
              <th>Address</th>
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
          <td>
          {{ $quote->customer->first_name ?? '-' }} {{ $quote->customer->last_name ?? '' }}<br>
          {{ $quote->customer->email ?? '-' }}<br>
          {{ $quote->customer->mobile ?? '-' }}
          </td>
          <td>{{ $quote->deliveryAddress->address ?? 'No delivery address' }}</td>
          <td>
          <a href="{{ route('admin.quote.show', $quote->id) }}" class="btn btn-sm btn-info mb-1">View
          Quote
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
        </div>

        <!-- Other Tabs (blank) -->
        <div class="tab-pane fade" id="approved-orders">
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
              <td>{{ $quote->order_number ?? '-' }}</td>
              <td>
              {{ optional($quote->items->first()->subcategory->categories->first())->name ?? '-' }}
              >
              {{ optional($quote->items->first()->subcategory)->name ?? '-' }}
              </td>
              <td>
              {{ $quote->customer->first_name ?? '-' }} {{ $quote->customer->last_name ?? '' }}<br>
              {{ $quote->customer->email ?? '-' }}<br>
              {{ $quote->customer->mobile ?? '-' }}
              </td>

                  <td> @if($quote->payments->isEmpty())
          <!-- No payment exists, show Pay Now -->
          <span class="badge badge-danger">UnPaid</span>
          @else
          <!-- Payment exists, show Paid badge -->
          <span class="badge badge-success">Paid</span>
          @endif
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
              Quote
              Detail</a>
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

              </td>
            </tr>
            <div id="quote-notes-{{ $quote->id }}" class="d-none">
              @foreach($quote->departments as $department)
          <div class="col-md-6">
          <div class="card border mb-3">
            <div class="card-body">
            <p><strong>Date & Time:</strong> {{ $department->pivot->created_at ?? '-' }}</p>
            <p><strong>Department:</strong> {{ $department->name }}</p>
            <p><strong>Notes:</strong> {{ $department->pivot->notes ?? '-' }}</p>
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
        </div>
        @foreach($departments as $department)
      @php $slug = Str::slug($department->name); @endphp
      <div class="tab-pane fade" id="{{ $slug }}" role="tabpanel">
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
        <th>Order ID</th>
        <th>Payment</th>
        <th>Product</th>
        <th>Customer Info</th>
        <th>Department Notes</th>
        <th>Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($departmentQuotes[$department->id] as $quote)
        @php $pivot = $quote->departments->firstWhere('id', $department->id)?->pivot; @endphp
        <tr>
        <td>{{ $quote->created_at->format('Y-m-d H:i') }}</td>
        <td>#{{ $quote->order_number }}</td>
        <td> @if($quote->payments->isEmpty())
      <!-- No payment exists, show Pay Now -->
      <span class="badge badge-danger">UnPaid</span>
      @else
      <!-- Payment exists, show Paid badge -->
      <span class="badge badge-success">Paid</span>
      @endif
        </td>
        <td>
        {{ optional($quote->items->first()->subcategory->categories->first())->name ?? '-' }}
        >
        {{ optional($quote->items->first()->subcategory)->name ?? '-' }}
        </td>
        <td>
        {{ $quote->customer->first_name ?? '-' }} {{ $quote->customer->last_name ?? '' }}<br>
        {{ $quote->customer->email ?? '-' }}<br>
        {{ $quote->customer->mobile ?? '-' }}
        </td>
        <td>{{ $pivot->notes ?? '-' }}</td>
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
        Quote Request</a>
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
      </div>
      @endforeach



      </div>
      </div>
    </div>
    </div>
  </div>

  <!-- Change Status Modal -->
  <div class="modal fade" id="changeStatusModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
    <form>
      <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Change Order Status</h5><button type="button" class="close"
        data-dismiss="modal">&times;</button>
      </div>
      <!-- Inside #changeStatusModal -->
      <input type="hidden" id="statusQuoteId">

      <div class="modal-body">
        <label>Status</label>
        <select class="form-control" id="statusSelect">
        <option value="">Select</option>
        <option value="approved">Approved</option>
        <option value="cancelled">Cancelled</option>
        </select>
      </div>
      <div class="modal-footer"><button type="submit" class="btn btn-primary">Save</button></div>
      </div>
    </form>
    </div>
  </div>

  <!-- View All Notes Modal -->
  <div class="modal fade" id="viewNotesModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
      <h5 class="modal-title">All Notes (Department-wise)</h5><button type="button" class="close"
        data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
      <div class="row">
        <!-- Add notes dynamic -->
      </div>
      </div>
    </div>
    </div>
  </div>


  <!-- Process to Department Modal (AJAX) -->
  <div class="modal fade" id="processToDepartmentModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
      <h5 class="modal-title">Process Quote to Department</h5>
      <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
      <input type="hidden" id="processQuoteId">

      <div class="form-group">
        <label>Department</label>
        <select id="departmentSelect" class="form-control" required>
        <option value="">Select Department</option>
        @foreach($departments as $dept)
      <option value="{{ $dept->id }}">{{ $dept->name }}</option>
      @endforeach
        </select>
      </div>

      <div class="form-group">
        <label>Notes</label>
        <textarea id="departmentNotes" class="form-control" rows="3" placeholder="Enter notes..."></textarea>
      </div>
      </div>
      <div class="modal-footer">
      <button type="button" id="submitDepartment" class="btn btn-primary">Submit</button>
      </div>
    </div>
    </div>
  </div>


  <!-- Pay Now Modal -->
  <div class="modal fade" id="payNowModal" tabindex="-1" role="dialog" aria-labelledby="payNowModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
    <form id="payNowForm" enctype="multipart/form-data">
      @csrf
      <input type="hidden" name="quote_id" id="payNowQuoteId">

      <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="payNowModalLabel">Pay Now</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
        <!-- Order Value (Read-only) -->
        <div class="form-group">
        <label>Order Value</label>
        <input type="text" name="amount_received" class="form-control" id="orderValue" readonly>
        </div>

        <!-- Payment Type (Online / Offline) -->
        <div class="form-group">
        <label>Payment Type</label>
        <select name="payment_type" class="form-control" required>
          <option value="">-- Select Payment Type --</option>
          <option value="Online">Online</option>
          <option value="Offline">Offline</option>
        </select>
        </div>


        <!-- Enter Amount Received -->
        <!-- <div class="form-group">
      <label>Amount Received</label>
      <input type="number" name="amount_received" class="form-control" required step="0.01">
      </div> -->

        <!-- Payment Method Dropdown -->
        <div class="form-group">
        <label>Payment Method</label>
        <select name="payment_method" class="form-control" required>
          <option value="">-- Select --</option>
          <option value="Cash">Cash</option>
          <option value="Wire Transfer">Wire Transfer</option>
          <option value="Online Payment">Online Payment</option>
          <option value="POS">POS</option>
          <option value="Bank Transfer">Bank Transfer</option>
          <option value="Others">Others</option>
        </select>
        </div>

        <!-- Payment Date -->
        <div class="form-group">
        <label>Payment Date</label>
        <input type="date" name="payment_date" class="form-control" required>
        </div>

        <!-- Reference Number -->
        <div class="form-group">
        <label>Reference Number</label>
        <input type="text" name="reference_number" class="form-control">
        </div>

        <!-- Payment Remarks -->
        <div class="form-group">
        <label>Payment Remarks</label>
        <textarea name="remarks" class="form-control" rows="3"></textarea>
        </div>

        <!-- Upload Payment Proof -->
        <div class="form-group">
        <label>Upload Payment Proof (optional)</label>
        <input type="file" name="payment_proof" class="form-control-file" accept="image/*,application/pdf">
        </div>
      </div>

      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Submit Payment</button>
      </div>
      </div>
    </form>
    </div>
  </div>


@endsection

@push('scripts')
  <script>


    $(document).on('click', '.pay-now-btn', function () {
    const quoteId = $(this).data('quote-id');
    const orderValue = $(this).data('order-value');

    $('#payNowQuoteId').val(quoteId);
    $('#orderValue').val(orderValue);

    $('#payNowModal').modal('show');
    });


    $('#statusSelect').on('change', function () {
    $('#departmentFields').toggle($(this).val() === 'department');
    });

    $(document).on('click', '.change-status-btn', function () {
    const quoteId = $(this).data('quote-id');
    $('#statusQuoteId').val(quoteId);
    });


    $('#changeStatusModal form').on('submit', function (e) {
    e.preventDefault();

    const quoteId = $('#statusQuoteId').val();
    const selectedStatus = $('#statusSelect').val();

    if (!selectedStatus) {
      alert('Please select a status.');
      return;
    }

    updateQuoteStatus(quoteId, selectedStatus);
    $('#changeStatusModal').modal('hide');
    });


    // Set quote ID in modal
    $('.process-to-dept-btn').on('click', function () {
    const quoteId = $(this).data('quote-id');
    const usedDepartments = ($(this).data('used-departments') || '').toString().split(',').map(id => id.trim());

    $('#processQuoteId').val(quoteId);

    // Reset dropdown
    $('#departmentSelect option').show(); // show all first

    // Hide used departments
    usedDepartments.forEach(id => {
      $('#departmentSelect option[value="' + id + '"]').hide();
    });

    // Reset selection
    $('#departmentSelect').val('');
    $('#departmentNotes').val('');
    });


    $(document).on('click', '.view-notes-btn', function () {
    const quoteId = $(this).data('quote-id');
    const notesHtml = $(`#quote-notes-${quoteId}`).html();
    if (notesHtml && notesHtml.trim() !== '') {
      $('#viewNotesModal .modal-body .row').html(notesHtml);
    } else {
      $('#viewNotesModal .modal-body .row').html('<div class="col-md-12 text-muted text-center">No notes available for this quote.</div>');
    }
    });


    // AJAX request
    $('#submitDepartment').on('click', function () {
    const quoteId = $('#processQuoteId').val();
    const departmentId = $('#departmentSelect').val();
    const notes = $('#departmentNotes').val();

    if (!departmentId) {
      alert('Please select a department.');
      return;
    }

    $.ajax({
      url: '{{ route("admin.quote.update-department") }}',
      type: 'POST',
      data: {
      _token: '{{ csrf_token() }}',
      quote_id: quoteId,
      department_id: departmentId,
      notes: notes
      },
      success: function (response) {
      $('#processToDepartmentModal').modal('hide');
      Swal.fire('Success', response.message, 'success');
      location.reload(); // or refresh just the affected tab/table
      },
      error: function (xhr) {
      const errMsg = xhr.responseJSON?.message || 'An error occurred.';
      alert(errMsg);
      }
    });
    });

    document.addEventListener('DOMContentLoaded', function () {
    const urlParams = new URLSearchParams(window.location.search);
    const tabParam = urlParams.get('tab');

    // Show the correct tab on load
    if (tabParam) {
      const targetTab = document.querySelector(`a[data-tab="${tabParam}"]`);
      if (targetTab) {
      new bootstrap.Tab(targetTab).show();
      }
    }

    // Update URL when tab is clicked
    document.querySelectorAll('a[data-toggle="tab"]').forEach(tab => {
      console.log('here');

      tab.addEventListener('click', function (e) {
      const tabName = this.getAttribute('data-tab');
      const newUrl = new URL(window.location);
      newUrl.searchParams.set('tab', tabName);
      window.history.replaceState({}, '', newUrl);
      });
    });
    });


    function updateQuoteStatus(quoteId, status) {
    $.ajax({
      url: '{{ route('admin.quotes.update.status') }}',
      type: 'POST',
      data: {
      quote_id: quoteId,
      status: status,
      _token: '{{ csrf_token() }}'
      },
      success: function (response) {
      if (response.success) {
        Swal.fire('Success', response.message, 'success');
      } else {
        Swal.fire('Error', 'Something went wrong.', 'error');
      }
      },
      error: function (xhr) {
      Swal.fire('Error', 'Unable to update status.', 'error');
      }
    });
    }


    $('#payNowForm').on('submit', function (e) {
    e.preventDefault();

    let form = $(this)[0];
    let formData = new FormData(form);

    $.ajax({
      url: "{{ route('admin.quotes.payment.submit') }}",  // Define this route in web.php
      method: 'POST',
      data: formData,
      processData: false,
      contentType: false,
      beforeSend: function () {
      // Optional: Show loader
      },
      success: function (response) {
      if (response.success) {
        $('#payNowModal').modal('hide');
        Swal.fire('Success', response.message, 'success');
        // Optional: reload or update part of the page
        setTimeout(() => location.reload(), 1000);
      } else {
        Swal.fire('Error', response.message || 'Something went wrong', 'error');
      }
      },
      error: function (xhr) {
      let errorMsg = xhr.responseJSON?.message || 'Something went wrong';
      Swal.fire('Error', errorMsg, 'error');
      }
    });
    });


  </script>
@endpush