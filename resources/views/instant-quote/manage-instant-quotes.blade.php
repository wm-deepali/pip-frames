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
                <li class="breadcrumb-item active">Instant Quotes</li>
              </ol>
            </div>
          </div>
        </div>
      </div>
      <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
        <div class="form-group breadcrumb-right">
          <div class="dropdown">
            {{-- <a href="{{ route('teams.create') }}" class="btn-icon btn btn-primary btn-round btn-sm dropdown-toggle">Add Team</a> --}}
          </div>
        </div>
      </div>
    </div>
    <div class="content-body">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <h4 class="card-title">Instant Quotes List</h4>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table" id="enquiry-table">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th width="170px">Date & Time</th>
						<th>Quote Number</th>
                      <th>Name & Email</th>
                      <th>Phone Number</th>
						<th>Qty</th>
                      <th>Book Type</th>
                      <th>Size</th>
                      <th>Ink Colour & Pages</th>
                      <th>Paper Type & Thickness</th>
                      <th>Orientation</th>
                      <th>Cover Weight and Finish</th>
                      <th>File & Proof</th>
                      <th>Extra</th>
                      <th>Delivery Address</th>
                      <th>File Status</th>
                      <th>Final Price</th>
                      <th width="70px">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                      @if (isset($instant_quotes) && count($instant_quotes)>0)
                        @foreach ($instant_quotes as $instant_quote)
                            <tr>
                                <td>#{{ $loop->iteration }}</td>
                                <td>{{ $instant_quote->created_at }}</td>
								<td>{{ $instant_quote->quote_number }}</td>
                                <td>{{ $instant_quote->name }}<br>{{ $instant_quote->email }}</td>
                                <td>{{ $instant_quote->phone_number }}</td>
								<td>{{ $instant_quote->unit }}</td>
                                <td>
                                    {{ $instant_quote->book_type }}
                                    @if ($instant_quote->foil == 'yes')
                                        -<span>Foil</span>
                                    @endif
                                    @if ($instant_quote->dust_jacket == 'yes')
                                        -<span>Dust Jacket</span>
                                    @endif
                                </td>
                                <td>{{ Str::title($instant_quote->size_of_book) }}</td>
                                <td>{{ Str::title($instant_quote->ink_colour) }}<br>{{ $instant_quote->black_and_white_page_count }} Black/White<br>{{ $instant_quote->colour_page_count }} Colour</td>
                                <td>{{ Str::title($instant_quote->paper_type) }}<br>{{ Str::title(str_replace('_', ' ', $instant_quote->paper_thickness)) }}</td>
                                <td>{{ Str::title($instant_quote->orientation) }}</td>
                                <td>{{ Str::title(str_replace('_', ' ', $instant_quote->cover_weight)) }}<br>{{ Str::title(str_replace('_', ' ', $instant_quote->cover_finish)) }}</td>
                                <td>{{ Str::title(str_replace('_', ' ', $instant_quote->supplying_file_format)) }}<br>{{ Str::title(str_replace('_', ' ', $instant_quote->want_proof_by)) }}</td>
                                <td>{{ Str::title(str_replace('_', ' ', $instant_quote->extra_option)) }}</td>
                                <td>{{ Str::title(str_replace('_', ' ', $instant_quote->delivery_location)) }}</td>
                                <td>{{ Str::title(str_replace('_', ' ', $instant_quote->file_status)) }}</td>
                                <td>{{ $instant_quote->final_price }}</td>
                                <td>
                                    <a href="javascript:void(0)" class="btn btn-danger btn-sm-custom waves-effect waves-float waves-light" onclick="deleteConfirmation({{ $instant_quote->id }})"><i class="far fa-trash-alt"></i></a>
                                </td>
                            </tr>
                        @endforeach
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

@endsection
@push('scripts')
<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    function deleteConfirmation(id) {
        $.ajax({
            url:`{{ URL::to('admin/manage-instant-quote/${id}') }}`,
            type:"DELETE",
            dataType:"json",
            success:function(result) {
                if(result.success) {
                    location.reload();
                }
            }
        });
    };

    $(document).ready( function () {
        $('#enquiry-table').DataTable();
    });
</script>
@endpush