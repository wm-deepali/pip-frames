  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel">Update Artwork Category</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
          </button>
      </div>
        <div class="modal-body">           
          <form method="POST" action="{{ route('manage-artwork-category.update', $artwork->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group row">
              <div class="col-md-6">
                <div class="form-group">
                  <label>Upload Image</label>
                  <div class="custom-img-uploader">
                    <div class="input-group">
                      <span class="input-group-btn">
                        <span class="btn-file">
                          <input type="file" id="imgSec" name="image">
                          <img id='upload-img' class="img-upload-block" src="{{asset('/images/artwork/'. $artwork->icon_image) }}" style="width: 80px;" />
                        </span>
                      </span>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="form-group row">
              <label>Heading</label>
              <input type="text" name="heading" class="form-control" placeholder="Enter Heading" value="{{ $artwork->heading }}" required="">
            </div>
            <div class="form-group row">
              <label>Title</label>
              <input type="text" name="title" class="form-control" value="{{ $artwork->short_content }}" placeholder="Enter Title">
            </div>

            <div class="form-group row">
                <label>Meta Title</label>
                <input required="" type="text" class="form-control" name="meta_title" id="meta_title" value="{{ $artwork->meta_title }}"/>
            </div>                     
            <div class="form-group row">
                <label>Meta Keywords</label>
                <input required="" type="text" class="form-control" name="meta_keywords" id="meta_keywords" value="{{ $artwork->meta_keywords }}" />
            </div>
      
            <div class="form-group row">
                <label>Meta Description </label>
                <textarea required="" class="form-control" name="meta_description" rows="3" placeholder="Meta Description" id="meta_description">{{ $artwork->meta_description }}</textarea>
            </div>

            <div class="form-group row">
              <input type="hidden" name="old_image" value="{{ $artwork->icon_image }}">
              <button type="submit" class="btn btn-info">Submit</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  