@extends('layouts.master')

@section('content')
  <div class="app-content content">
    <div class="content-wrapper">
    <div class="content-header row mb-2">
      <div class="col-md-6">
      <h4>Centralized Paper Pricing</h4>
      </div>
    </div>

    <div class="content-body">
      <div class="card">
      <div class="card-body">

        {{-- Tab Navigation --}}
        <ul class="nav nav-tabs" id="pricingTab" role="tablist">
        <li class="nav-item">
          <a class="nav-link active" id="sra3-counts-tab" data-toggle="tab" href="#sra3-counts" role="tab">SRA3
          Counts</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="pricing-rules-tab" data-toggle="tab" href="#paper-rates" role="tab">Paper
          Rates</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="sra3-counts-tab" data-toggle="tab" href="#paper-weight-rates" role="tab">Paper
          Weight Rates</a>
        </li>
        </ul>

        {{-- Tab Content --}}
        <div class="tab-content" id="pricingTabContent">

        {{-- Tab 1: SRA3 Counts --}}
        <div class="tab-pane fade show active" id="sra3-counts" role="tabpanel">
          <div class="mb-2 text-right">
          @if(!isset($sra3Counts))
        <a href="{{ route('admin.sra3-sheets.create', $attribute->id) }}" class="btn btn-primary btn-sm">
        Add SRA3 Counts
        </a>
      @else
        <a href="{{ route('admin.sra3-sheets.edit', $attribute->id) }}" class="btn btn-primary btn-sm">
        Edit SRA3 Counts
        </a>
      @endif
          </div>

          <div class="table-responsive">
          <table class="table table-bordered table-striped">
            <thead class="thead-light">
            <tr>
              <th>Value</th>
              <th>No of Sheets made from 1 SRA3 Sheet</th>
            </tr>
            </thead>
            <tbody>
            @foreach($attribute->values as $val)
        <tr>
          <td>{{ $val->value }}</td>
          <td>{{ $sra3Counts[$val->id]->sheet_count ?? 'Not Set' }}</td>
        </tr>
        @endforeach
            </tbody>
          </table>
          </div>
        </div>

        {{-- Tab 2: Pricing Rules --}}
        <div class="tab-pane fade" id="paper-rates" role="tabpanel">
          <div class="mb-2 text-right">
          @if($paperSizePricing->isEmpty())
        <a href="{{ route('admin.paper-rates.create') }}" class="btn btn-primary btn-sm">
        ＋ Add Paper Rates
        </a>
      @else
        <a href="{{ route('admin.paper-rates.edit', $attribute->id) }}" class="btn btn-primary btn-sm">
        Edit Paper Rates
        </a>
      @endif
          </div>

          @if($paperSizePricing->isEmpty())
        <p>No pricing data for paper size found.</p>
      @else

        @foreach($paperSizePricing as $rule)
        <div class="card mb-3 border shadow-sm">
        <div class="card-body">
        <h6 class="text-primary">Dependencies:</h6>
        <ul>
        @foreach($rule->dependencies as $dep)
        <li><strong>{{ $dep->attribute->name }}:</strong> {{ $dep->value->value }}</li>
        @endforeach
        </ul>

        <h6 class="text-success">Quantity Ranges:</h6>
        <table class="table table-sm table-bordered">
        <thead class="thead-light">
        <tr>
        <th>From</th>
        <th>To</th>
        <th>Price (SRA3 sheets)</th>
        </tr>
        </thead>
        <tbody>
        @foreach($rule->quantityRanges as $range)
        <tr>
        <td>{{ $range->quantity_from }}</td>
        <td>{{ $range->quantity_to }}</td>
        <td>£ {{ number_format($range->price, 2) }}</td>
        </tr>
        @endforeach
        </tbody>
        </table>
        </div>
        </div>
      @endforeach
      @endif
        </div>

        {{-- Tab 3: Pricing Rules --}}
        <div class="tab-pane fade" id="paper-weight-rates" role="tabpanel">
          <div class="mb-2 text-right">
          @if($paperWeightPricing->isEmpty())
        <a href="{{ route('admin.paper-weight-rates.create') }}" class="btn btn-primary btn-sm">
        ＋ Add Paper Weight Rate
        </a>
      @else
        <a href="{{ route('admin.paper-weight-rates.edit', $paperWeight->id) }}" class="btn btn-primary btn-sm">
        Edit Paper Weight Rates
        </a>
      @endif
          </div>

          @if($paperWeightPricing->isEmpty())
        <p>No pricing data for paper weight.</p>
      @else

        <div class="table-responsive">
        <table class="table table-bordered table-striped">
          <thead class="thead-light">
          <tr>
          <th>Main Attribute</th>
          <th>Value</th>
          <th>Dependencies</th>
          <th>Price (Per 1000 SRA3 sheets)</th>
          </tr>
          </thead>
          <tbody>
          @foreach($paperWeightPricing as $rule)
        <tr>
          <td>{{ $rule['attribute']['name'] ?? '-' }}</td>
          <td>{{ $rule['value']['value'] ?? '-' }}</td>
          <td>
          @if(!empty($rule['dependencies']))
        <ul class="pl-3 mb-0">
          @foreach($rule['dependencies'] as $dep)
        <li><strong>{{ $dep['attribute']['name'] ?? '-' }}:</strong>
        {{ $dep['value']['value'] ?? '-' }}</li>
        @endforeach
        </ul>
        @else
        No dependencies
        @endif
          </td>
          <td>£ {{ number_format($rule['price'], 2) }}</td>
        </tr>
        @endforeach
          </tbody>
        </table>
        </div>

      @endif
        </div>


        </div> {{-- End of Tab Content --}}

      </div>
      </div>
    </div>
    </div>
  </div>
@endsection

@push('scripts')
  <script>
    $(document).ready(function () {
    // Show tab from URL hash on page load
    var hash = window.location.hash;
    if (hash) {
      $('#pricingTab a[href="' + hash + '"]').tab('show');
    }

    // Update hash in URL when tab is clicked
    $('#pricingTab a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
      history.replaceState(null, null, e.target.hash);
    });
    });
  </script>
@endpush