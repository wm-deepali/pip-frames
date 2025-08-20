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
                <li class="breadcrumb-item active">Site Meta Contents</li>
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
          <div class="card">
            <div class="card-header">
              <h4 class="card-title">Slider List</h4>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table" id="team-table">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Page Type</th>
                      <th>Title</th>
                      <th>Keywords</th>
                      <th>Description</th>
            <th>Canonical Link</th>
            <th>OG Tag URL</th>
            <th>Twitter Tag URL</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @forelse($metas as $meta)
                    <tr>
                      <td>#{{ $loop->iteration }}</td>
                      <td>{{ $meta->slug }}</td>
                      <td>{{ $meta->title }}</td>
                      <td>{{ $meta->keywords }}</td>
                      <td>{{ $meta->description }}</td>
                      <td>{{ $meta->canonical_link }}</td>
                      <td>{{ $meta->og_tag }}</td>
                      <td>{{ $meta->twitter_tag_url }}</td>
                      <td>
                        <a href="{{ url('admin/site/meta/edit') }}/{{ base64_encode($meta->id) }}" class="btn btn-primary btn-sm-custom waves-effect waves-float waves-light"><i class="fas fa-pencil-alt"></i></a>
                      </td>
                    </tr>
                    @empty
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
@endsection
@push('scripts')

@endpush