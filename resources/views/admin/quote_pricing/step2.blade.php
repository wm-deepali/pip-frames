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
                <li class="breadcrumb-item"><a href="{{ route('admin.quote-pricing.index') }}">Quote Pricing</a></li>
                <li class="breadcrumb-item active">Step 2 - Pricing</li>
              </ol>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="content-body">
      <form action="{{ route('admin.quote-pricing.step2.save', $quote->id) }}" method="POST">
        @csrf

        @php
          $allFields = collect($selectedOptions)->flatten(1)->pluck('fields')->flatten()->unique();
        @endphp

        @foreach ($selectedOptions as $group => $groupOptions)
        <div class="card mb-2">
          <div class="card-header bg-light">
            <h5 class="mb-0">{{ ucfirst($group) }} Options</h5>
          </div>
          <div class="card-body p-2">
            <table class="table table-bordered mb-0">
              <thead class="thead-light">
                <tr>
                  <th style="width: 20%">Master</th>
                  <th style="width: 20%">Option</th>
                  @foreach($allFields as $field)
                    <th>{{ ucwords(str_replace('_', ' ', $field)) }}</th>
                  @endforeach
                  <th style="width: 10%">Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach($groupOptions as $label => $data)
                <tr class="master-row" data-label="{{ $label }}">
                  <td>{{ $label }}</td>
                  <td>
                    <select name="option_values[{{ $label }}][]" class="form-control">
                      <option value="">-- Select {{ $label }} --</option>
                      @foreach($data['options'] as $opt)
                        <option value="{{ $opt->id }}">{{ $opt->name ?? $opt->gsm ?? 'Option ' . $opt->id }}</option>
                      @endforeach
                    </select>
                  </td>
                  @foreach($allFields as $field)
                  <td>
                    @if(in_array($field, $data['fields']))
                      <input type="number" name="{{ $field }}[{{ $label }}][]" class="form-control" />
                    @else
                      <input type="hidden" name="{{ $field }}[{{ $label }}][]" value="">
                    @endif
                  </td>
                  @endforeach
                  <td class="d-flex gap-1">
                    <button type="button" class="btn btn-success btn-sm add-row mr-1">+</button>
                    <button type="button" class="btn btn-danger btn-sm remove-row">−</button>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
        @endforeach

        <div class="text-right mt-3">
          <button type="submit" class="btn btn-primary">Save Pricing</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection

@push('scripts')
<script>
  $(document).on('click', '.add-row', function () {
    const row = $(this).closest('tr');
    const cloned = row.clone();

    cloned.find('input').val('');
    cloned.find('select').val('');

    row.after(cloned);
  });

  $(document).on('click', '.remove-row', function () {
    const row = $(this).closest('tr');
    const label = row.data('label');
    const similarRows = $(`tr[data-label="${label}"]`);

    if (similarRows.length > 1) {
      row.remove();
    } else {
      alert('At least one row is required for each option.');
    }
  });
</script>
@endpush
