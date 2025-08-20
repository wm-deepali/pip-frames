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
                  <li class="breadcrumb-item active">Manage Page Content</li>
                </ol>
              </div>
            </div>
          </div>
        </div>
        <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
          <div class="form-group breadcrumb-right">
            <button class="btn-icon btn btn-primary btn-round btn-sm" data-toggle="modal" data-target="#addContentModal">Add New Content</button>
          </div>
        </div>
      </div>
      <div class="content-body">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title">Page Content Listing</h4>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table" id="page-content-table">
                    <thead>
                      <tr>
                        <th>Date & Time</th>
                        <th>Page Name</th>
                        <th>Heading</th>
                        <th>Status</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>2025-07-10 14:30</td>
                        <td>About Comic Books</td>
                        <td>Welcome to Our Comic Collection</td>
                        <td>Published</td>
                        <td>
                          <a href="" class="btn btn-sm btn-info mr-1">Edit</a>
                          <button class="btn btn-sm btn-danger" >Delete</button>
                        </td>
                      </tr>
                      <tr>
                        <td>2025-07-09 10:15</td>
                        <td>Graphic Novels Guide</td>
                        <td>Explore Graphic Novels</td>
                        <td>Draft</td>
                        <td>
                          <a href="" class="btn btn-sm btn-info mr-1">Edit</a>
                          <button class="btn btn-sm btn-danger" >Delete</button>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Add New Content Modal -->
    <div class="modal fade" id="addContentModal" tabindex="-1" role="dialog" aria-labelledby="addContentModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="addContentModalLabel">Add New Content</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">
            <form action="" method="POST">
              <div class="form-group">
                <label for="page_name">Select Page</label>
                <select class="form-control" id="page_name" name="page_name" required>
                  <option value="">Select a page</option>
                  <option value="About Comic Books">About Comic Books</option>
                  <option value="Graphic Novels Guide">Graphic Novels Guide</option>
                </select>
              </div>
              <div class="form-group">
                <label for="heading">Heading</label>
                <input type="text" class="form-control" id="heading" name="heading" placeholder="Enter heading" required>
              </div>
              <div class="form-group">
                <label for="detail_content">Detail Content</label>
                <textarea class="form-control" id="detail_content" name="detail_content" required></textarea>
              </div>
              <button type="submit" class="btn btn-primary">Submit</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- CKEditor 5 CDN -->
  <script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/classic/ckeditor.js"></script>
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script>
    // Initialize CKEditor 5
    ClassicEditor
      .create(document.querySelector('#detail_content'), {
        toolbar: ['heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote', 'undo', 'redo'],
        height: 400
      })
      .catch(error => {
        console.error(error);
      });

    // Delete confirmation
    function confirmDelete(url) {
      if (confirm('Are you sure you want to delete this content?')) {
        window.location.href = url;
      }
    }
  </script>
@endsection