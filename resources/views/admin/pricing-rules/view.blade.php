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
          <li class="breadcrumb-item"><a href="{{ route('admin.pricing-rules.index') }}">Pricing Rules</a></li>
          <li class="breadcrumb-item active">View Pricing Rule</li>
          </ol>
        </div>
        </div>
      </div>
      </div>
      <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
      <a href="{{ route('admin.pricing-rules.edit', $rule->id) }}" class="btn btn-primary btn-sm">Edit</a>
      </div>
    </div>

    <div class="content-body">
      <div class="row">
      <div class="col-md-12">
        <div class="card">
        <div class="card-header">
          <h4 class="card-title">Pricing Rule Details</h4>
        </div>
        <div class="card-body">
          <dl class="row">

          <dt class="col-sm-3">Subcategory</dt>
          <dd class="col-sm-9">
            {{ $rule->subcategory->name ?? '-' }} <br>
            <small>Category: {{ $rule->category->name ?? '-' }}</small>
          </dd>

          <hr class="col-12 my-2">


          <dt class="col-sm-3">Pages Dragger</dt>
          <dd class="col-sm-9">
            @if ($rule->pages_dragger_required)
          <div class="mb-1">
          <strong class="text-success">Required</strong>
          @php
          $depAttr = $dependencyAttrs[$rule->pages_dragger_dependency] ?? null;
        @endphp
          @if ($depAttr)
        <br>Depends on: <strong>{{ $depAttr->name }}</strong>
        @else
        <br><em class="text-danger">Invalid Dependency</em>
        @endif
          </div>
          <div class="row">
          <div class="col-md-4"><strong>Default Pages:</strong> {{ $rule->default_pages ?? '-' }}</div>
          <div class="col-md-4"><strong>Min Pages:</strong> {{ $rule->min_pages ?? '-' }}</div>
          <div class="col-md-4"><strong>Max Pages:</strong> {{ $rule->max_pages ?? '-' }}</div>
          </div>
        @else
        <span class="text-muted">No</span>
        @endif
          </dd>

          <hr class="col-12 my-2">

          <dt class="col-sm-3">Quantity</dt>
          <dd class="col-sm-9">
            <div class="row">
            <div class="col-md-4"><strong>Default:</strong> {{ $rule->default_quantity ?? '-' }}</div>
            <div class="col-md-4"><strong>Min:</strong> {{ $rule->min_quantity ?? '-' }}</div>
            <div class="col-md-4"><strong>Max:</strong> {{ $rule->max_quantity ?? '-' }}</div>
            </div>
          </dd>

          <hr class="col-12 my-2">


          <dt class="col-sm-3">Attributes</dt>
          <dd class="col-sm-9">
            @forelse ($rule->attributes as $attr)
          <div class="border rounded p-2 mb-2">
          <strong>{{ $attr->attribute->name ?? '-' }}</strong>:
          @if($attr->attribute->input_type == 'select_area')
        <div>
          <strong>Max Width:</strong> {{ $attr->max_width ?? '-' }},
          <strong>Max Height:</strong> {{ $attr->max_height ?? '-' }}
        </div>

        @else
        {{ $attr->value->value ?? '-' }}
        @endif

          @if($attr->is_default)
        <span class="badge badge-primary ml-1">Default</span>
        @endif
          <br>
          <small class="text-muted">
            ({{ ucfirst($attr->price_modifier_type) }}
            {{ $attr->price_modifier_type === 'multiply' ? '×' : '' }}
            {{ rtrim(rtrim(number_format($attr->price_modifier_value, 4, '.', ''), '0'), '.') }}
            {{ $attr->base_charges_type === 'percentage' ? '%' : '' }}
            {{ $attr->extra_copy_charge ? '| Extra: ' . rtrim(rtrim(number_format($attr->extra_copy_charge, 4, '.', ''), '0'), '.') : '' }}
            {{ $attr->extra_copy_charge_type === 'percentage' ? '%' : '' }})
          </small>

          @if ($attr->dependencies && $attr->dependencies->isNotEmpty())
          <div class="small text-danger mt-1">
          <strong>Depends on:</strong>
          <ul class="pl-3 mb-0">
          @foreach ($attr->dependencies as $dep)
          <li>
          <strong>{{ $dep->parentAttribute->name ?? 'Attribute #' . $dep->parent_attribute_id }}</strong>
          =
          <span
          class="text-dark">{{ $dep->parentValue->value ?? 'Value #' . $dep->parent_value_id }}</span>
          </li>
        @endforeach
          </ul>
          </div>
        @endif

          @if ($attr->quantityRanges->isNotEmpty())
          <div class="text-muted small mt-1">
          <strong>{{ $attr->attribute->pricing_basis === 'per_product' ? 'Per Product Pricing:' : 'Per Page Pricing:' }}</strong>
          <ul class="mb-0 pl-3">
          @foreach ($attr->quantityRanges as $range)
          <li>
          From {{ $range->quantity_from }} to {{ $range->quantity_to }}:
          £{{ rtrim(rtrim(number_format($range->price, 4, '.', ''), '0'), '.') }}
          </li>
        @endforeach
          </ul>
          </div>
        @endif

          @if ($attr->attribute->pricing_basis === 'fixed_per_page')
        <div class="text-muted small mt-1">
          <strong>Fixed Per Page Price:</strong>
          £{{ rtrim(rtrim(number_format($attr->flat_rate_per_page, 4, '.', ''), '0'), '.') }}
        </div>
        @endif

          @if ($attr->attribute->pricing_basis === 'per_extra_copy')
        <div class="text-muted small mt-1">
          <strong>Per Extra Copy Price:</strong>
          £{{ rtrim(rtrim(number_format($attr->extra_copy_charge, 4, '.', ''), '0'), '.') }}
        </div>
        @endif
          </div>
        @empty
        <span class="text-muted">No Modifiers</span>
        @endforelse
          </dd>

          </dl>
        </div>
        </div>
      </div>
      </div>
    </div>
    </div>
  </div>
@endsection