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
                                    <li class="breadcrumb-item active">Group Assignments</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
                    <div class="form-group breadcrumb-right">
                        <a href="javascript:void(0)" class="btn btn-primary btn-round btn-sm"
                            id="add-group-assignments">Add</a>
                    </div>
                </div>
            </div>

            <div class="content-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Group Assignments</h4>
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Subcategory</th>
                                            <th>Group Name</th>
                                            <th>Sort Order</th>
                                            <th>Toggleable</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($assignments as $item)
                                            <tr id="assignment-row-{{ $item->id }}">
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $item->subcategory->name ?? '-' }}</td>
                                                <td>{{ $item->group->name ?? '-' }}</td>
                                                <td>{{ $item->sort_order }}</td>
                                                <td>
                                                    <span
                                                        class="badge badge-{{ $item->is_toggleable ? 'success' : 'secondary' }}">
                                                        {{ $item->is_toggleable ? 'Yes' : 'No' }}
                                                    </span>
                                                </td>
                                                <td>
                                                    <ul class="list-inline mb-0">
                                                        <li class="list-inline-item">
                                                            <a href="javascript:void(0)"
                                                                class="btn btn-sm btn-primary edit-group-assignment"
                                                                data-id="{{ $item->id }}">
                                                                <i class="fas fa-pencil-alt"></i>
                                                            </a>
                                                        </li>
                                                        <li class="list-inline-item">
                                                            <a href="javascript:void(0)"
                                                                onclick="deleteConfirmation({{ $item->id }})">
                                                                <i class="fa fa-trash text-danger"></i>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="6" class="text-center">No group assignments found</td>
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

        {{-- Modal --}}
        <div class="modal fade" id="group-assignment-modal" tabindex="-1" role="dialog" aria-hidden="true"></div>
    </div>
@endsection


@push('scripts')
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(document).ready(function () {

            // Add assignment
            $(document).on('click', '#add-group-assignments', function () {
                $.get("{{ route('admin.group-assignments.create') }}", function (result) {
                    if (result.success) {
                        $('#group-assignment-modal').html(result.html).modal('show');
                    }
                });
            });

            // Edit Assignment
            $(document).on('click', '.edit-group-assignment', function () {
                const id = $(this).data('id');
                $.get(`{{ url('admin/group-assignments') }}/${id}/edit`, function (result) {
                    if (result.success) {
                        $('#group-assignment-modal').html(result.html).modal('show');
                    }
                });
            });

            // Save Group Assignment
            $(document).on('click', '#save-group-btn', function () {
                const form = $('#group-assignment-form')[0];
                const formData = new FormData(form);

                $('#save-group-btn').attr('disabled', true);
                $('.validation-err').html('');

                $.ajax({
                    url: "{{ route('admin.group-assignments.store') }}", // Update this route if needed
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function (result) {
                        if (result.success) {
                            Swal.fire('Success!', result.message || '', 'success');
                            $('#group-assignment-modal').modal('hide');
                            setTimeout(() => location.reload(), 500);
                        } else {
                            $('#save-group-btn').attr('disabled', false);
                            if (result.code === 422) {
                                for (const key in result.errors) {
                                    const errId = key.replace(/\./g, '_') + '-err';
                                    $('#' + errId).html(result.errors[key][0]);
                                }
                            } else {
                                Swal.fire(result.msgText || 'Something went wrong');
                            }
                        }
                    }
                });
            });
        });

        // Update Assignment
        $(document).on('click', '#update-assignment-btn', function () {
            $(this).prop('disabled', true);
            $('.validation-err').text('');

            let id = $(this).data('id');
            let formData = new FormData(document.getElementById('group-assignment-form'));
            formData.append('_method', 'PUT');

            $.ajax({
                url: `/admin/group-assignments/${id}`,
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function (response) {
                    if (response.success) {
                        Swal.fire('Updated!', '', 'success');
                        $('#group-assignment-modal').modal('hide');
                        setTimeout(() => location.reload(), 300);
                    } else {
                        $('#update-assignment-btn').prop('disabled', false);
                        if (response.errors) {
                            $.each(response.errors, function (key, messages) {
                                const $input = $(`[name="${key}"]`);
                                const $errorSpan = $input.siblings('.' + key.replace(/\./g, '_') + '-err');
                                if ($errorSpan.length) {
                                    $errorSpan.html(messages[0]);
                                }
                            });
                        } else {
                            Swal.fire('Error', response.msgText ?? 'Something went wrong', 'error');
                        }
                    }
                }
            });
        });
        // Delete assignment
        function deleteConfirmation(id) {
            Swal.fire({
                title: 'Are you sure?',
                text: "This will permanently delete the record!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonColor: '#d33'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: `/admin/group-assignments/${id}`,
                        type: "DELETE",
                        success: function (response) {
                            if (response.success) {
                                Swal.fire('Deleted!', '', 'success');
                                setTimeout(() => location.reload(), 300);
                            } else {
                                Swal.fire('Error', response.msgText, 'error');
                            }
                        }
                    });
                }
            });
        }
    </script>
@endpush