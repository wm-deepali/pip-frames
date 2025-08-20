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
                <li class="breadcrumb-item"><a href="{{ route('admin.manageSiteMetas') }}">Meta Tags</a></li>
                <li class="breadcrumb-item active">Update Meta Contents</li>
              </ol>
            </div>
          </div>
        </div>
      </div>
      <!-- <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
        <div class="form-group breadcrumb-right">
          <div class="dropdown">
            <a href="{{ route('slider.create') }}" class="btn-icon btn btn-primary btn-round btn-sm dropdown-toggle">Add Slider</a>
          </div>
        </div>
      </div> -->
    </div>
    <div class="content-body">
      <div class="row">
        <div class="col-md-12">
          @if(count($errors) > 0 )
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
              <ul class="p-0 m-0" style="list-style: none;">
                  @foreach($errors->all() as $error)
                  <li>{{$error}}</li>
                  @endforeach
              </ul>
          </div>
          @endif
          @if(session()->has('success'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <ul class="p-0 m-0" style="list-style: none;">
                    <li>{{ session()->get('success') }}</li>
                </ul>
            </div>
          @endif
          <form method="post" action="{{ route('admin.updateSiteMetas') }}">
          @csrf
          <div class="card">
            <div class="card-header">
              <h4 class="card-title">Manage Content</h4>
            </div>
            <div class="card-body">
              <div class="container-fluid">
                  <input type="hidden" name="id" value="{{ $picked->id }}">
                  <div class="row">
                    <div class="col-md-12">
                      <label class="label-control">Meta Title</label>
                      <input type="text" class="form-control" id="ooo_current_title{{ $picked->id }}" name="meta_title" value="{{ $picked->title }}" onkeyup="manageTextBoxLength('current_title{{ $picked->id }}', 'maximum_title{{ $picked->id }}')" required>
                      <div>
                        <span id="current_title{{ $picked->id }}">0</span>
                        <span id="maximum_title{{ $picked->id }}">/ 60</span>
                      </div>
                    </div>
                    <div class="col-md-12" style="margin-top: 10px;">
                      <label class="label-control">Meta Keywords</label>
                      <textarea class="form-control" name="meta_keyword" rows="2" cols="4" required>{{ $picked->keywords }}</textarea>
                    </div>
                    <div class="col-md-12" style="margin-top: 10px;">
                      <label class="label-control">Meta Description</label>
                      <textarea class="form-control" id="ooo_current_desc{{ $picked->id }}" name="meta_description" rows="2" cols="4" onkeyup="manageDescTextBoxLength('current_desc{{ $picked->id }}', 'maximum_desc{{ $picked->id }}')" required>{{ $picked->description }}</textarea>
                      <div>
                        <span id="current_desc{{ $picked->id }}">0</span>
                        <span id="maximum_desc{{ $picked->id }}">/ 158</span>
                      </div>
                    </div>
                    <div class="col-md-12" style="margin-top: 10px;">
                      <label class="label-control">Publisher</label>
                      <input type="text" class="form-control" name="publisher" value="{{ $picked->publisher }}" required>
                    </div>
                    <div class="col-md-12" style="margin-top: 10px;">
                      <label class="label-control">Canonical Link</label>
                      <input type="text" class="form-control" name="canonical_link" value="{{ $picked->canonical_link }}" required>
                    </div>
                  </div>
              </div>
            </div>
          </div>
          <div class="card">
            <div class="card-header">
              <h4 class="card-title">Manage OG Tag Contents</h4>
            </div>
            <div class="card-body">
              <div class="container-fluid">
                <div class="row">
                  <div class="col-md-3">
                    <label class="label-control">OG Locale</label>
                    <input type="text" class="form-control" name="og_locale" value="{{ $picked->og_locale }}" required />
                  </div>
                  <div class="col-md-3">
                    <label class="label-control">OG Type</label>
                    <input type="text" class="form-control" name="og_type" value="{{ $picked->og_type }}" required />
                  </div>
                  <div class="col-md-3">
                    <label class="label-control">OG Title</label>
                    <input type="text" class="form-control" name="og_title" value="{{ $picked->og_title }}" required />
                  </div>
                  <div class="col-md-3">
                    <label class="label-control">OG Site Name</label>
                    <input type="text" class="form-control" name="og_site_name" value="{{ $picked->og_site_name }}" required />
                  </div>
                  <div class="col-md-6" style="margin-top: 10px;">
                    <label class="label-control">OG Image URL</label>
                    <input type="text" class="form-control" name="og_image" value="{{ $picked->og_image }}" required />
                  </div>
                  <div class="col-md-6" style="margin-top: 10px;">
                    <label class="label-control">OG URL</label>
                    <input type="text" class="form-control" name="og_tag" value="{{ $picked->og_tag }}"/>
                  </div>
                  <div class="col-md-12" style="margin-top: 10px;">
                    <label class="label-control">OG Description</label>
                    <textarea class="form-control" name="og_description" rows="2" cols="4" required>{{ $picked->og_description }}</textarea>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="card">
            <div class="card-header">
              <h4 class="card-title">Twitter Contents</h4>
            </div>
            <div class="card-body">
              <div class="container-fluid">
                <div class="row">
                  <div class="col-md-4">
                    <label class="label-control">Twitter Card</label>
                    <input type="text" class="form-control" name="twitter_card" value="{{ $picked->twitter_card }}" required />
                  </div>
                  <div class="col-md-4">
                    <label class="label-control">Twitter Creator</label>
                    <input type="text" class="form-control" name="twitter_creator" value="{{ $picked->twitter_creator }}" required />
                  </div>
                  <div class="col-md-4">
                    <label class="label-control">Twitter Site</label>
                    <input type="text" class="form-control" name="twitter_site" value="{{ $picked->twitter_site }}" required />
                  </div>
                  <div class="col-md-6" style="margin-top: 10px;">
                    <label class="label-control">Twitter Title</label>
                    <input type="text" class="form-control" name="twitter_title" value="{{ $picked->twitter_title }}" required />
                  </div>
                  <div class="col-md-6" style="margin-top: 10px;">
                    <label class="label-control">Twitter Image URL</label>
                    <input type="text" class="form-control" name="twitter_image" value="{{ $picked->twitter_image }}" required />
                  </div>
                  <div class="col-md-12" style="margin-top: 10px;">
                    <label class="label-control">Twitter Description</label>
                    <textarea class="form-control" name="twitter_description" rows="2" cols="4" required>{{ $picked->twitter_description }}</textarea>
                  </div>
                  <div class="col-md-12" style="margin-top: 10px;">
                    <label class="label-control">Twitter Domain</label>
                  <input type="text" class="form-control" name="twitter_tag_url" value="{{ $picked->twitter_tag_url }}"/>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-12" style="margin-top: 10px;">
            <center><button class="btn btn-primary waves-effect waves-float waves-light" type="submit">Update</button></center>
          </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
@push('scripts')
<script type="text/javascript">
    openUpdateModal('{{ $picked->id }}');
    function manageTextBoxLength(curr, max) {
        var characterCount = $('#ooo_'+curr).val().length;
        current = $('#'+curr),
        maximum = $('#'+max),
        theCount = $('#the-count');
        current.text(characterCount);
        if (characterCount >= 60) {
          maximum.css('color', '#8f0001');
          current.css('color', '#8f0001');
          theCount.css('font-weight','bold');
        }else{
          maximum.css('color','#666');
          theCount.css('font-weight','normal');
        }
    }
  
  function manageDescTextBoxLength(curr, max) {
        var characterCount = $('#ooo_'+curr).val().length;
        current = $('#'+curr),
        maximum = $('#'+max),
        theCount = $('#the-count');
        current.text(characterCount);
        if(characterCount >= 158) {
          maximum.css('color', '#8f0001');
          current.css('color', '#8f0001');
          theCount.css('font-weight','bold');
        }else{
          maximum.css('color','#666');
          theCount.css('font-weight','normal');
        }
    }
  
  function openUpdateModal(id) {
      manageTextBoxLength('current_title'+id, 'maximum_title'+id);
      manageDescTextBoxLength('current_desc'+id, 'maximum_desc'+id);
    $('#update-tags'+id).modal('show');
  }
</script>
@endpush