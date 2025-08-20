@extends('layouts.master')

@section('content')

  <div class="app-content content">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper">
    <div class="content-header row">
      <div class="content-header-left col-md-9 col-12 mb-2">
      <div class="row breadcrumbs-top">
        <div class="col-12">
        <div class="breadcrumb-wrapper">
          <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
          <li class="breadcrumb-item"><a href="{{ route('admin.customers') }}">Customer Listing</a></li>
          <li class="breadcrumb-item active">Customer Detail</li>
          </ol>
        </div>
        </div>
      </div>
      </div>
    </div>
    <div class="content-body">
      <div class="row">
      <div class="col-md-12">
        <div class="card">
        <div class="card-header">
          <h4 class="card-title">Customer Detail</h4>
        </div>
        <div class="card-body">
          <div class="row mb-2">
          <div class="col-md-2 text-center">
            <img
            src="{{ $customer->profile_pic ? asset('storage/' . $customer->profile_pic) : asset('images/default-avatar.png') }}"
            class="profile-img mb-3" alt="Customer Profile" style="width:110px;">
          </div>
          <div class="col-md-8" style="margin-left:-30px;">
            <h5>{{ $customer->first_name }} {{ $customer->last_name }}</h5>
            <p><strong>Display Name:</strong> {{ $customer->display_name }}</p>
            <p><strong>Email:</strong> {{ $customer->email }}</p>
            <p><strong>Contact Number:</strong> {{ $customer->mobile }}</p>
            <!-- <p><strong>Full Address:</strong> {{ $customer->address }}</p> -->
          </div>
          </div>

          <!-- Bootstrap Tabs -->
          <ul class="nav nav-tabs mb-3" id="customerTab" role="tablist">
          <li class="nav-item" role="presentation">
            <button class="nav-link active" id="enquiries-tab" data-toggle="tab" data-target="#enquiries"
            type="button" role="tab" aria-controls="enquiries" aria-selected="true">Enquiries</button>
          </li>
          <li class="nav-item" role="presentation">
            <button class="nav-link" id="addresses-tab" data-toggle="tab" data-target="#addresses" type="button"
            role="tab" aria-controls="addresses" aria-selected="false">Addresses</button>
          </li>
          </ul>

          <div class="tab-content" id="customerTabContent">
          <!-- Enquiries Tab -->
          <div class="tab-pane fade show active" id="enquiries" role="tabpanel" aria-labelledby="enquiries-tab">
            <div class="table-responsive">
            <table class="table" id="enquiries-table">
              <thead>
              <tr>
                <th>Date & Time</th>
                <th>Quote ID</th>
                <th>Order ID</th>
                <th>Product</th>
                <th>Estimated Cost</th>
                <th>Action</th>
              </tr>
              </thead>
              <tbody>
              @forelse ($customer->quotes as $quote)
            <tr>
              <td>{{ $quote->created_at->format('Y-m-d H:i') }}</td>
              <td>#{{ $quote->quote_number }}</td>
                <td>#{{ $quote->order_number }}</td>
              @php
          $subcategory = optional($quote->items->first())->subcategory;
          $category = $subcategory?->categories->first();
          @endphp
              <td>
              {{ $category?->name ?? '-' }} >
              {{ $subcategory?->name ?? '-' }}
              </td>
              <td>£{{ number_format($quote->grand_total, 2) }}</td>
              <td>
              <a href="{{ route('admin.quote.show', $quote->id) }}" class="btn btn-sm btn-info">View
              Quotation</a>
              </td>
            </tr>
        @empty
          <tr>
          <td colspan="5" class="text-center">No quotes found.</td>
          </tr>
        @endforelse
              </tbody>
            </table>
            </div>
          </div>

          <!-- Addresses Tab -->
          <div class="tab-pane fade" id="addresses" role="tabpanel" aria-labelledby="addresses-tab">
            <div class="table-responsive">
            <table class="table table-bordered">
              <thead>
              <tr>
                <th>Type</th>
                <th>Tag</th>
                <th>Default</th>
                <th>Address Line</th>
                <th>City</th>
                <th>State</th>
                <th>Postal Code</th>
                <th>Country</th>
              </tr>
              </thead>
              <tbody>
              @forelse ($customer->addresses as $address)
          <tr>
          <td>{{ ucfirst($address->type) }}</td>
          <td>{{ ucfirst($address->address_tag) }}</td>
          <td>{{ $address->is_default ? 'Yes' : 'No'  }}</td>
          <td>{{ $address->address_line1 }} {{  $address->address_line2 }}</td>
          <td>{{ $address->cityname->name ?? '' }}</td>
          <td>{{ $address->statename->name ?? '' }}</td>
          <td>{{ $address->postal_code }}</td>
          <td>{{ $address->countryname->name ?? '' }}</td>
          </tr>
        @empty
          <tr>
          <td colspan="6" class="text-center">No addresses found.</td>
          </tr>
        @endforelse
              </tbody>
            </table>
            </div>
          </div>

          </div>
        </div>

        </div>
      </div>
      </div>
    </div>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
@endsection