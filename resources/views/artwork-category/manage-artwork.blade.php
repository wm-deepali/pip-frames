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
                <li class="breadcrumb-item active">Artwork Category </li>
              </ol>
            </div>
          </div>
        </div>
      </div>
      <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
        <div class="form-group breadcrumb-right">
          <div class="dropdown">
            <a href="javascript:void(0)" class="btn-icon btn btn-primary btn-round btn-sm dropdown-toggle" data-toggle="modal" data-target="#add-content">Add Content</a>
            <!-- <a href="javascript:void(0)" class="btn-icon btn btn-primary btn-round btn-sm dropdown-toggle" data-toggle="modal" data-target="#add-page-type">Add Artwork Category</a> -->
          </div>
        </div>
      </div>
    </div>
    <div class="content-body">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <h4 class="card-title">Book Types</h4>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table" id="artwork-table">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Icon Image</th>
                      <th>Heading</th>
                      <th>Title</th>
                      <th>Status</th>
                      <th width="70px">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @if(count($artwork) > 0) 
                      @foreach($artwork as $t => $type)
                        <tr>
                          <td>{{ $t + 1 }}</td>
                          <td><img src="{{asset('/images/artwork/'.$type->icon_image) }}" style="width: 80px"></td>
                          <td>{{ $type->heading }}</td>
                          <td>{{ $type->short_content }}</td>
                          <td>
                            <div class="custom-control custom-switch">
                              <input type="checkbox" class="custom-control-input change-status" data-art_id="{{ $type->id }}" id="change-status_{{ $type->id }}" {{ $type->status == 'active' ? 'checked' : '' }} >
                              <label class="custom-control-label" for="change-status_{{ $type->id }}"></label>
                            </div>
                          </td>
                          <td>
                            <a href="javascript:void()" class="btn btn-primary btn-sm-custom waves-effect waves-float waves-light view_artwork_modal" art_id="<?= $type->id;?>"><i class="fas fa-pencil-alt"></i></a>| 
                            <form action="{{ route('manage-artwork-category.destroy', $type->id) }}" method="POST" style="display: inline-block">
                            @csrf
                            @method('DELETE')
                              <button class="btn btn-danger btn-sm-custom waves-effect waves-float waves-light"><i class="far fa-trash-alt"></i></button>
                            </form>
                          </td>
                          </td>
                        </tr>
                      @endforeach
                    @else
                      <tr>
                        <td colspan="3">No record(s) found.</td>
                      </tr>
                    @endif
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

<!-- The category -->
<div class="modal" id="add-page-type">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Add Artwork Category</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <div class="container-fluid">
          <form method="POST" action="{{ route('manage-artwork-category.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group row">
              <div class="col-md-6">
                <div class="form-group">
                  <label>Upload Image</label>
                  <div class="custom-img-uploader">
                    <div class="input-group">
                      <span class="input-group-btn">
                        <span class="btn-file">
                          <input type="file" id="imgSec" name="image">
                          <img id='upload-img' class="img-upload-block" src="https://www.miraclesaba.xyz/Rajpal/bookempire-admin/images/plus-upload.jpg"/>
                        </span>
                      </span>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="form-group row">
              <label>Heading</label>
              <input type="text" name="heading" class="form-control" placeholder="Enter Heading" value="{{ old('heading') }}" required="">
            </div>
            <div class="form-group row">
              <label>Title</label>
              <input type="text" name="title" class="form-control" value="{{ old('title') }}" placeholder="Enter Title" required="">
            </div>
            <div class="form-group row">
                <label>Content</label>
                <input required="" type="text" class="form-control" name="meta_title" id="meta_title" value="{{ old('meta_title') }}"/>
            </div>                     
            <div class="form-group row">
                <label>Meta Keywords </label>
                <input required="" type="text" class="form-control" name="meta_keywords" id="meta_keywords" value="{{ old('meta_keywords') }}" />
            </div>
      
            <div class="form-group row">
                <label>Meta Description </label>
                <textarea required="" class="form-control" name="meta_description" rows="3" placeholder="Meta Description" id="meta_description">{{ old('meta_description') }}</textarea>
            </div>
            
            <div class="form-group row">
              <button type="submit" class="btn btn-info">Submit</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>


<!-- The category content-->
<div class="modal" id="add-content">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Add Artwork Content</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <div class="container-fluid">
          <form method="POST" action="{{ route('artwork-content') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group row">
              <div class="col-md-6">
                <div class="form-group">
                  <label>Upload Image</label>
                  <div class="custom-img-uploader">
                    <div class="input-group">
                      <span class="input-group-btn">
                        <span class="btn-file">
                          <input type="file" id="imgLogo" name="image">
                          <img id='upload-logo' class="img-upload-block" src="{{asset('/images/artwork/'. $content->image) }}"/>
                        </span>
                      </span>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="form-group row">
              <label>Heading</label>
              <input type="text" name="heading" class="form-control" placeholder="Enter Heading" value="{{ $content->heading }}" required="">
            </div>
            <div class="form-group row">
              <label>Subheading</label>
              <input type="text" name="subheading" class="form-control" value="{{ $content->subheading }}" placeholder="Enter Title" required="">
            </div>
            <div class="form-group row">
                <label>Content</label>
                <textarea class="form-control" name="content" id="content" required="">{{ $content->content }}</textarea>
            </div>                     
           <input type="hidden" name="old_image" value="{{ $content->image}}">
            <div class="form-group row">
              <button type="submit" class="btn btn-info">Submit</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<!--edit category-->
<div id="view_artwork_modal" class="modal fade" role="dialog"></div>


@endsection
@push('scripts')

<script type="text/javascript">
 CKEDITOR.replace('content');
  $(document).ready( function () {
    $('#artwork-table').DataTable();
  });

$(document).on("click", ".view_artwork_modal", function(event) {
  var art_id = $(this).attr("art_id");
  $.ajax({
    'url':'{{ route('view-art-edit') }}',
    type: "GET",
    data: {"art_id": art_id},
    success: function(result) {
      $("#view_artwork_modal").html(result);
      $("#view_artwork_modal").modal("show");
    }
  })
});


    $(".change-status").on('change', function(){
    const art_id = $(this).data('art_id');
    const status = $(this).prop('checked') == true ? 'active' : 'block'; 
      $.ajax({
          'url':'{{ route('change-status-art') }}',
          'type':'GET',
          'data':{'art_id':art_id, 'status':status},
          success:function(){
            location.reload();
          }
      });
  });

</script>
@endpush