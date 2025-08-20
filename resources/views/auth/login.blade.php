<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0,minimal-ui">
  <meta name="description" content="Nuvem Print Ltd">
  <meta name="keywords" content="Nuvem Print Ltd">
  <title>Nuvem Print Admin</title>
  <link rel="shortcut icon" type="image/x-icon" href="{{ asset('admin_assets') }}/images/favicon.png">
  <link rel="stylesheet" type="text/css" href="{{ asset('admin_assets') }}/css/flatpickr.min.css">
  <link rel="stylesheet" type="text/css" href="{{ asset('admin_assets') }}/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="{{ asset('admin_assets') }}/css/bootstrap-extended.min.css">
  <link rel="stylesheet" type="text/css" href="{{ asset('admin_assets') }}/css/chart-apex.min.css">
  <link rel="stylesheet" type="text/css" href="{{ asset('admin_assets') }}/css/style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

</head>

<body class="horizontal-layout horizontal-menu blank-page navbar-floating footer-static" data-open="hover" data-menu="horizontal-menu" data-col="blank-page">

  <div class="app-content content">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper">
      <div class="content-header row">
      </div>
      <div class="content-body">
        <div class="auth-wrapper auth-v1 px-2">
          <div class="auth-inner py-2">
            <div class="card mb-0">
              <div class="card-body">
                <a href="javascript:void(0);" class="brand-logo"><img src="{{ asset('admin_assets') }}/images/logo.png" width="150" alt=""></a>

                <h4 class="card-title mb-1">Login Your Account!</h4>
                <p class="card-text mb-2">Please sign-in to your account and start the adventure</p>
                @include('errors.flash_message')
                <form class="auth-login-form mt-2" action="{{ route('login') }}"method="POST">
                  @csrf
                  <div class="form-group">
                    <label class="form-label">Email</label>
                    <input type="email" class="form-control" name="email" placeholder="Email Id" aria-describedby="login-email" tabindex="1" autofocus/>
                  </div>
                  <div class="form-group">
                    <div class="d-flex justify-content-between">
                      <label for="login-password">Password</label>
                      <a href="{{ route('password.request') }}">
                        <small>Forgot Password?</small>
                      </a>
                    </div>
                    <div class="input-group input-group-merge form-password-toggle">
                      <input type="password" class="form-control form-control-merge" id="login-password" name="password" tabindex="2" placeholder="Password" aria-describedby="login-password"/>
                      <div class="input-group-append">
                        <span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="custom-control custom-checkbox">
                      <input class="custom-control-input" type="checkbox" id="remember-me" tabindex="3" />
                      <label class="custom-control-label" for="remember-me"> Remember Me </label>
                    </div>
                  </div>
                  <button type="submit" class="btn btn-primary btn-block" tabindex="4">Sign in</button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>


  <div class="sidenav-overlay"></div>
  <div class="drag-target"></div>

  <footer class="footer footer-static footer-light">
    <p class="clearfix mb-0 text-center"><span class="d-block d-md-inline-block mt-25">Copyright  &copy; 2025<a class="ml-25" href="#" target="_blank">Nuvem Print Ltd</a> | <span class="d-sm-inline-block"> All rights Reserved.</span></span>
    </p>
  </footer>

  <button class="btn btn-primary btn-icon scroll-top" type="button"><i data-feather="arrow-up"></i></button>

  <script src="{{ asset('admin_assets') }}/js/jquery.min.js"></script>
  <script src="{{ asset('admin_assets') }}/js/jquery.sticky.js"></script>
  <script src="{{ asset('admin_assets') }}/js/bs-stepper.min.js"></script>
  <script src="{{ asset('admin_assets') }}/js/select2.full.min.js"></script>
  <script src="{{ asset('admin_assets') }}/js/apexcharts.min.js"></script>
  <script src="{{ asset('admin_assets') }}/js/flatpickr.min.js"></script>
  <script src="{{ asset('admin_assets') }}/js/app-menu.min.js"></script>
  <script src="{{ asset('admin_assets') }}/js/app.min.js"></script>
  <script src="{{ asset('admin_assets') }}/js/chart-apex.min.js"></script>
  <script src="{{ asset('admin_assets') }}/js/form-select2.min.js"></script>
  <script src="{{ asset('admin_assets') }}/js/custom.js"></script>
  <script src="{{ asset('admin_assets') }}/js/ckeditor.js"></script>
  <script>
    DecoupledEditor
    .create( document.querySelector( '#editor' ), {
    // toolbar: [ 'heading', '|', 'bold', 'italic', 'link' ]
  } )
    .then( editor => {
      const toolbarContainer = document.querySelector( '.toolbar-container' );

      toolbarContainer.prepend( editor.ui.view.toolbar.element );

      window.editor = editor;
    } )
    .catch( err => {
      console.error( err.stack );
    } );
  </script>
  <script>
    $(document).ready( function() {
      $(document).on('change', '.btn-file :file', function() {
        var input = $(this),
        label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
        input.trigger('fileselect', [label]);
      });
      $('.btn-file :file').on('fileselect', function(event, label) {
        var input = $(this).parents('.input-group').find(':text'),
        log = label;
        if( inalert()->success('Post Created', 'Successfully')->toToast();
put.length ) {
          input.val(log);
        }
      });
      function readURL(input) {
        if (input.files && input.files[0]) {
          var reader = new FileReader();
          reader.onload = function (e) {
            $('#upload-logo').attr('src', e.target.result);
          }
          reader.readAsDataURL(input.files[0]);
        }
      }
      $("#imgLogo").change(function(){
        readURL(this);
      });   
    });

    $(document).ready( function() {
      $(document).on('change', '.btn-file :file', function() {
        var input = $(this),
        label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
        input.trigger('fileselect', [label]);
      });
      $('.btn-file :file').on('fileselect', function(event, label) {
        var input = $(this).parents('.input-group').find(':text'),
        log = label;
        if( input.length ) {
          input.val(log);
        }
      });
      function readURL(input) {
        if (input.files && input.files[0]) {
          var reader = new FileReader();
          reader.onload = function (e) {
            $('#upload-favicon').attr('src', e.target.result);
          }
          reader.readAsDataURL(input.files[0]);
        }
      }
      $("#imgFav").change(function(){
        readURL(this);
      });   
    });

    $(document).ready( function() {
      $(document).on('change', '.btn-file :file', function() {
        var input = $(this),
        label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
        input.trigger('fileselect', [label]);
      });
      $('.btn-file :file').on('fileselect', function(event, label) {
        var input = $(this).parents('.input-group').find(':text'),
        log = label;
        if( input.length ) {
          input.val(log);
        }
      });
      function readURL(input) {
        if (input.files && input.files[0]) {
          var reader = new FileReader();
          reader.onload = function (e) {
            $('#upload-img').attr('src', e.target.result);
          }
          reader.readAsDataURL(input.files[0]);
        }
      }
      $("#imgSec").change(function(){
        readURL(this);
      });   
    });

    $("#banner-text-option").change(function () {
      var selected_option = $('#banner-text-option').val();

      if (selected_option === 'yes') {
        $('#banner-text').show();
      }
      if (selected_option != 'yes') {
        $("#banner-text").hide();
      }
    });

    $(document).ready(function() {
    var max_fields      = 20; //maximum input boxes allowed
    var wrapper       = $(".input-wrapper"); //Fields wrapper
    var add_button      = $(".add_field_button"); //Add button ID
    var counter         = 2;
    
    var x = 1; //initlal text box count
    $(add_button).click(function(e){ //on add input button click
      e.preventDefault();
      if(x < max_fields){ //max input box allowed
        x++; //text box increment
        //$(wrapper).append('<div class="inner-wrapper-upload"><input type="text" name="docname'+ counter +'" class="form-control" placeholder="Document Name"/><div class="custom-file"><input type="file"  name="docup'+ counter +'" class="custom-file-input" id="customFile" /><label class="custom-file-label" for="customFile">Choose file</label></a></div><a href="#" class="remove_field"><i class="fas fa-plus"></i></div>');
        $(wrapper).append('<div class="inner-wrapper-upload col-md-2"><input type="text" name="docname'+ counter +'" class="form-control" placeholder="Document Name"/><div class="custom-img-uploader"><div class="input-group"><span class="input-group-btn"><span class="btn-file"><input type="file" id="imgSec"><img id="upload-img" class="img-upload-block" src="images/plus-upload.jpg"/></span></span></div></div><a href="#" class="remove_field"><i class="far fa-trash-alt"></i></a></div>');
      }
    });
    
    $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
      e.preventDefault(); $(this).parent('div').remove(); x--;
    })
  });

    $(document).ready(function() {
    var max_fields      = 20; //maximum input boxes allowed
    var wrapper       = $(".input-wrapper-food"); //Fields wrapper
    var add_button      = $(".add_field_button_food"); //Add button ID
    var counter         = 2;
    
    var x = 1; //initlal text box count
    $(add_button).click(function(e){ //on add input button click
      e.preventDefault();
      if(x < max_fields){ //max input box allowed
        x++; //text box increment
        $(wrapper).append('<div class="inner-wrapper-upload col-md-2"><div class="custom-img-uploader"><div class="input-group"><span class="input-group-btn"><span class="btn-file"><input type="file" id="imgSec"><img id="upload-img" class="img-upload-block" src="images/plus-upload.jpg"/></span></span></div></div><a href="#" class="remove_field_food"><i class="far fa-trash-alt"></i></a></div>');
      }
    });
    
    $(wrapper).on("click",".remove_field_food", function(e){ //user click on remove text
      e.preventDefault(); $(this).parent('div').remove(); x--;
    })
  });

    $(document).ready(function() {
    var max_fields      = 20; //maximum input boxes allowed
    var wrapper       = $(".input-wrapper-varient"); //Fields wrapper
    var add_button      = $(".add_field_button_varient"); //Add button ID
    var counter         = 2;
    
    var x = 1; //initlal text box count
    $(add_button).click(function(e){ //on add input button click
      e.preventDefault();
      if(x < max_fields){ //max input box allowed
        x++; //text box increment
        $(wrapper).append('<div class="row align-items-end inner-wrapper-upload"><div class="col-md-2">  <div class="form-group"><label>Select Quantity Type</label><select class="form-control">  <option>Select Quantity Type</option>  <option>Full</option><option>Half</option><option>Quarter</option><option>Per Plate</option></select></div></div><div class="col-md-2"><div class="form-group"><label>MRP</label><input type="text" class="form-control" placeholder="MRP"/></div></div><div class="col-md-2"><div class="form-group"><label>Discount (%)</label><input type="text" class="form-control" placeholder="Discount (%)"/></div></div><div class="col-md-2"><div class="form-group"><label>Offer Price</label><input type="text" class="form-control" placeholder="Offer Price"/></div></div><div class="col-md-2"><div class="stock-block" style="display: none;"><div class="form-group"><label>Enter Stock Quantity</label><input type="text" class="form-control" placeholder="Enter Stock Quantity"/></div></div></div><div class="col-md-1"><div class="form-group"><a href="#" class="remove_field_varient"><i class="far fa-trash-alt"></i></a></div></div></div>');
      }
    });
    
    $(wrapper).on("click",".remove_field_varient", function(e){ //user click on remove text
      e.preventDefault(); $(this).parent().parent().parent('div').remove(); x--;
    })
  });

    $(document).ready(function() {
    var max_fields      = 20; //maximum input boxes allowed
    var wrapper       = $(".input-wrapper-product"); //Fields wrapper
    var add_button      = $(".add_field_button_product"); //Add button ID
    var counter         = 2;
    
    var x = 1; //initlal text box count
    $(add_button).click(function(e){ //on add input button click
      e.preventDefault();
      if(x < max_fields){ //max input box allowed
        x++; //text box increment
        $(wrapper).append('<div class="row align-items-end inner-wrapper-upload"><div class="col-md-3"><div class="form-group"><label>Select Product Category</label><select class="form-control"><option>Select Product Category</option><option>Spices</option><option>Dried Fruits</option><option>Nuts & Seeds</option></select></div></div><div class="col-md-3"><div class="form-group"><label>Product Name</label><input type="text" class="form-control" placeholder="Product Name"/></div></div><div class="col-md-3"><div class="form-group"><label>Product Quantity</label><input type="text" class="form-control" placeholder="Product Quantity"/></div></div><div class="col-md-1"><div class="form-group"><a href="#" class="remove_field_product"><i class="far fa-trash-alt"></i></a></div></div></div>');
      }
    });
    
    $(wrapper).on("click",".remove_field_product", function(e){ //user click on remove text
      e.preventDefault(); $(this).parent().parent().parent('div').remove(); x--;
    })
  });

    $(document).ready(function() {
    var max_fields      = 20; //maximum input boxes allowed
    var wrapper       = $(".input-wrapper-purchase"); //Fields wrapper
    var add_button      = $(".add_field_button_purchase"); //Add button ID
    var counter         = 2;
    
    var x = 1; //initlal text box count
    $(add_button).click(function(e){ //on add input button click
      e.preventDefault();
      if(x < max_fields){ //max input box allowed
        x++; //text box increment
        $(wrapper).append('<div class="row align-items-end inner-wrapper-upload"><div class="col-md-2"><div class="form-group"><label>Select Product Category</label><select class="form-control"><option>Select Product Category</option><option>Spices</option><option>Dried Fruits</option><option>Nuts & Seeds</option></select></div></div><div class="col-md-2"><div class="form-group"><label>Select Product</label><select class="form-control"><option>Select Product</option><option>Rice</option><option>Plain Flour</option><option>Wheat flour</option></select></div></div><div class="col-md-2"><div class="form-group"><label>Product Quantity</label><input type="text" class="form-control" placeholder="Product Quantity"/></div></div><div class="col-md-2"><div class="form-group"><label>Select Quantity Type</label><select class="form-control"><option>Select Quantity Type</option><option>KG</option><option>Unit</option><option>Pcs</option><option>Box</option><option>Litres</option></select></div></div><div class="col-md-1"><div class="form-group"><label>Price</label><input type="text" class="form-control" placeholder="Price"/></div></div><div class="col-md-1"><div class="form-group"><label>Discount (%)</label><input type="text" class="form-control" placeholder="Discount (%)"/></div></div><div class="col-md-1"><div class="form-group"><label>Final Price</label><input type="text" class="form-control" placeholder="Final Price"/></div></div><div class="col-md-1"><div class="form-group"><a href="#" class="remove_field_purchase"><i class="far fa-trash-alt"></i></a></div></div></div>');
      }
    });
    
    $(wrapper).on("click",".remove_field_purchase", function(e){ //user click on remove text
      e.preventDefault(); $(this).parent().parent().parent('div').remove(); x--;
    })
  });

    $(document).ready(function() {
    var max_fields      = 20; //maximum input boxes allowed
    var wrapper       = $(".input-wrapper-supplies"); //Fields wrapper
    var add_button      = $(".add_field_button_supplies"); //Add button ID
    var counter         = 2;
    
    var x = 1; //initlal text box count
    $(add_button).click(function(e){ //on add input button click
      e.preventDefault();
      if(x < max_fields){ //max input box allowed
        x++; //text box increment
        $(wrapper).append('<div class="row align-items-end inner-wrapper-upload"><div class="col-md-3"><div class="form-group"><label>Select Product</label><select class="form-control"><option>Select Product</option><option>Rice</option><option>Plain Flour</option><option>Wheat flour</option></select></div></div><div class="col-md-2"><div class="form-group"><label>Available Quantity</label><input type="text" class="form-control" placeholder="Available Quantity" readonly/></div></div><div class="col-md-2"><div class="form-group"><label>Enter Supply Qty</label><input type="text" class="form-control" placeholder="Enter Supply Qty"/></div></div><div class="col-md-2"><div class="form-group"><label>Remaining Qty</label><input type="text" class="form-control" placeholder="Remaining Qty" readonly/></div></div><div class="col-md-1"><div class="form-group"><a href="#" class="remove_field_supplies"><i class="far fa-trash-alt"></i></a></div></div></div>');
      }
    });
    
    $(wrapper).on("click",".remove_field_supplies", function(e){ //user click on remove text
      e.preventDefault(); $(this).parent().parent().parent('div').remove(); x--;
    })
  });

    $(document).ready(function() {
    var max_fields      = 20; //maximum input boxes allowed
    var wrapper       = $(".input-wrapper-orders"); //Fields wrapper
    var add_button      = $(".add_field_button_orders"); //Add button ID
    var counter         = 2;
    
    var x = 1; //initlal text box count
    $(add_button).click(function(e){ //on add input button click
      e.preventDefault();
      if(x < max_fields){ //max input box allowed
        x++; //text box increment
        $(wrapper).append('<div class="row align-items-end inner-wrapper-orders"><div class="col-md-3"><div class="form-group"><label>Search Food Item</label><input type="text" class="form-control" placeholder="Search Food Item"/></div></div><div class="col-md-2"><div class="form-group"><label>Select Quantity Type</label><select class="form-control"><option>Select Quantity Type</option><option>Full</option><option>Half</option><option>Quarter</option><option>Per Plate</option></select></div></div><div class="col-md-1"><div class="form-group"><label>Price</label><input type="text" class="form-control" placeholder="Price" readonly/></div></div><div class="col-md-1"><div class="form-group"><label>Discount</label><input type="text" class="form-control" placeholder="Discount" readonly/></div></div><div class="col-md-1"><div class="form-group"><label>Final Price</label><input type="text" class="form-control" placeholder="Final Price" readonly/></div></div><div class="col-md-1"><div class="form-group"><label>Add Qty</label><input type="text" class="form-control" placeholder="Add Qty"/></div></div><div class="col-md-1"><div class="form-group"><label>Total Price</label><input type="text" class="form-control" placeholder="Total Price" readonly/></div></div><div class="col-md-1"><div class="form-group"><a href="#" class="remove_field_orders"><i class="far fa-trash-alt"></i></a></div></div></div>');
      }
    });
    
    $(wrapper).on("click",".remove_field_orders", function(e){ //user click on remove text
      e.preventDefault(); $(this).parent().parent().parent('div').remove(); x--;
    })
  });
</script>

<script>
  $(document).ready(function() {
    // Configure/customize these variables.
    var showChar = 40;  // How many characters are shown by default
    var ellipsestext = "";
    var moretext = "...";
    var lesstext = "less";
    

    $('.more-text').each(function() {
      var content = $(this).html();
      
      if(content.length > showChar) {
       
        var c = content.substr(0, showChar);
        var h = content.substr(showChar, content.length - showChar);
        
        var html = c + '<span class="moreellipses">' + ellipsestext+ '&nbsp;</span><span class="morecontent"><span>' + h + '</span>&nbsp;&nbsp;<a href="" class="morelink">' + moretext + '</a></span>';
        
        $(this).html(html);
      }
      
    });
    
    $(".morelink").click(function(){
      if($(this).hasClass("less")) {
        $(this).removeClass("less");
        $(this).html(moretext);
      } else {
        $(this).addClass("less");
        $(this).html(lesstext);
      }
      $(this).parent().prev().toggle();
      $(this).prev().toggle();
      return false;
    });
  });

  $('.custom-switch #stockswitch').change(function(){
    if ($(this).is(':checked')) {
      $('.stock-block').show();
    }else{
      $('.stock-block').hide();
    }
  });

// $(".show-varient").click(function() {
//  $(this).next('.display-variant').slideToggle('slow');
// });

$("#foodtable").on("click",".show-varient",function(e) {
  e.preventDefault();
  $(this).closest("tr").nextUntil(".parentvariant").toggleClass("open");
});

/*
New 
Codes 
for 
dropshipper 
*/
$("#setting2").click(function() {
  if($(this).is(":checked")) {
    $("#color_option").show();
  } else {
    $("#color_option").hide();
  }
});

</script>

</body>

</html>



{{-- @extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection --}}
