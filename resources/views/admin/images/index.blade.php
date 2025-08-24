@extends('layouts.master')

@section('content')
  <div class="app-content content">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper">

    <div class="content-header row">
      <div class="content-header-left col-md-9 col-12 mb-2">
      <h2 class="content-header-title">Image Conditions</h2>
      </div>
      <div class="content-header-right col-md-3 col-12">
      <a href="{{ route('admin.images.create') }}" class="btn btn-primary float-right">Add New</a>
      </div>
    </div>

    <div class="content-body">
      <section id="image-conditions-list">
      <div class="card">
        <div class="card-body table-responsive">
        <table class="table table-bordered table-striped">
          <thead>
          <tr>
            <th>#</th>
            <th>Subcategory</th>
            <th>Dependencies</th>
            <th>Affected Attribute</th>
            <th>Affected Values + Image</th>
            <th>Actions</th>
          </tr>
          </thead>
          <tbody>
          @forelse($images as $index => $condition)
          <tr>
          <td>{{ $index + 1 }}</td>
          <td>{{ $condition->subcategory->name ?? '-' }}</td>

          {{-- Dependencies --}}
          <td>
          @if($condition->dependencies->count())
          <ul class="mb-0 pl-3">
          @foreach($condition->dependencies as $dep)
          <li>
          {{ $dep->attribute->name ?? 'Attribute' }}
          =
          {{ $dep->value->value ?? 'Value' }}
          </li>
        @endforeach
          </ul>
        @else
        <span class="text-muted">None</span>
        @endif
          </td>

          {{-- Affected Attribute --}}
          <td>{{ $condition->affectedAttribute->name ?? '-' }}</td>

          {{-- Affected Values --}}
          <td>
          @if($condition->affectedValues->count())
          <ul class="mb-0 pl-3">
          @foreach($condition->affectedValues as $val)
          <li>
          {{ $val->value->value ?? '-' }}
          @if($val->image)
          <br>
          <img src="{{ asset('storage/' . $val->image) }}" alt="value image" width="80"
          class="mt-1 border rounded">
        @endif
          </li>
        @endforeach
          </ul>
        @else
        <span class="text-muted">None</span>
        @endif
          </td>
<td>
          <a href="{{ route('admin.images.edit', $condition->id) }}" class="btn btn-sm btn-info">Edit</a>
          <button type="button" class="btn btn-sm btn-danger btn-delete" data-id="{{ $condition->id }}">
            Delete
          </button>
          </td>

          </tr>
      @empty
        <tr>
        <td colspan="6" class="text-center text-muted">No conditions found</td>
        </tr>
      @endforelse
          </tbody>
        </table>
        </div>
      </div>
      </section>
    </div>
    </div>
  </div>
@endsection
@push('scripts')
<script>
    $(document).ready(function () {
        $('.btn-delete').on('click', function () {
            let id = $(this).data('id');

            Swal.fire({
                title: "Are you sure?",
                text: "This condition will be permanently deleted!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "{{ url('admin/images') }}/" + id,  // adjust route prefix if needed
                        type: "POST",
                        data: {
                            _method: "DELETE",
                            _token: "{{ csrf_token() }}"
                        },
                        success: function (res) {
                            if (res.success) {
                                Swal.fire(
                                    "Deleted!",
                                    "Condition has been deleted.",
                                    "success"
                                );

                                // remove row from table
                                $("button[data-id='" + id + "']").closest('tr').fadeOut(500, function() {
                                    $(this).remove();
                                });
                            } else {
                                Swal.fire("Error", "Something went wrong!", "error");
                            }
                        },
                        error: function () {
                            Swal.fire("Error", "Server error, try again!", "error");
                        }
                    });
                }
            });
        });
    });
</script>
@endpush
