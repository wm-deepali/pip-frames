
<div class="sidenav-overlay"></div>
<div class="drag-target"></div>

<footer class="footer footer-static footer-light">
  <title>Pip Frames</title>
  <p class="clearfix mb-0 text-center"><span class="d-block d-md-inline-block mt-25">Copyright  &copy; 2025<a class="ml-25" href="#" target="_blank">Nuvem Print </a> | <span class="d-sm-inline-block"> All rights Reserved.</span></span>
  </p>
</footer>

<button class="btn btn-primary btn-icon scroll-top" type="button"><i data-feather="arrow-up"></i></button>

<script src="<?php echo e(URL::asset('admin_assets/js/jquery.min.js')); ?>"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>  
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/additional-methods.min.js"></script>
<script src="<?php echo e(URL::asset('admin_assets/js/jquery.sticky.js')); ?>"></script>
<script src="<?php echo e(URL::asset('admin_assets/js/bs-stepper.min.js')); ?>"></script>
<script src="<?php echo e(URL::asset('admin_assets/js/select2.full.min.js')); ?>"></script>
<script src="<?php echo e(URL::asset('admin_assets/js/apexcharts.min.js')); ?>"></script>
<script src="<?php echo e(URL::asset('admin_assets/js/flatpickr.min.js')); ?>"></script>
<script src="<?php echo e(URL::asset('admin_assets/js/app-menu.min.js')); ?>"></script>
<script src="<?php echo e(URL::asset('admin_assets/js/app.min.js')); ?>"></script>
<script src="<?php echo e(URL::asset('admin_assets/js/chart-apex.min.js')); ?>"></script>
<script src="<?php echo e(URL::asset('admin_assets/js/form-select2.min.js')); ?>"></script>
<script src="<?php echo e(URL::asset('admin_assets/js/custom.js')); ?>"></script>
<script src="<?php echo e(URL::asset('admin_assets/js/ckeditor.js')); ?>"></script>
<script type="text/javascript" charset="utf8" src="//cdn.datatables.net/1.11.1/js/jquery.dataTables.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?php echo $__env->yieldPushContent('scripts'); ?>
<script>
	// Custom Scripts ( This is used for get page ranges based on page type and page ranges )
	function renderPageRanges(page_name, book_name) {
		var page_type = $('#'+page_name).val();
	    var book_type = $('#'+book_name).val();
	    $("#page_range").html('');
		$("#up_page_range").html('');
	    $.ajax({
	        url:"<?php echo e(url('admin/get/page/ranges')); ?>",
	        type: "POST",
	        data: {
	            page_type: page_type,
	            book_type: book_type,
	            _token: '<?php echo e(csrf_token()); ?>',
	        },
	        dataType : 'json',
	        success: function(result){
	        	if(result.length > 0) {
	        		$.each(result,function(key,page){
	        			$("#page_range").append('<option value="'+page.id+'" >'+page.name+'</option>');
	        		});
	        	}else{
	        		$('#page_range').html('<option value="">No any record(s) found.</option>');
	        	}
	        },
	        error: function(error) {
	        	alert('Something Happned Wrong.');
	        }
	    }); 
	}
	
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

	DecoupledEditor
	.create( document.querySelector( '#product_detail_editor' ), {
		// toolbar: [ 'heading', '|', 'bold', 'italic', 'link' ]
	} )
	.then( product_detail_editor => {
		const toolbarContainer = document.querySelector( '.product_detail_toolbar_container' );

		toolbarContainer.prepend( product_detail_editor.ui.view.toolbar.element );

		window.product_detail_editor = product_detail_editor;
	} )
	.catch( err => {
		console.error( err.stack );
	} );

	DecoupledEditor
	.create( document.querySelector( '#additional_feature_editor' ), {
		// toolbar: [ 'heading', '|', 'bold', 'italic', 'link' ]
	} )
	.then( additional_feature_editor => {
		const toolbarContainer = document.querySelector( '.additional_feature_toolbar_container' );

		toolbarContainer.prepend( additional_feature_editor.ui.view.toolbar.element );

		window.additional_feature_editor = additional_feature_editor;
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
		    if( input.length ) {
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
		var wrapper   		= $(".input-wrapper"); //Fields wrapper
		var add_button      = $(".add_field_button"); //Add button ID
		var counter         = 2;
		
		var x = 1; //initlal text box count
		$(add_button).click(function(e){ //on add input button click
			e.preventDefault();
			if(x < max_fields){ //max input box allowed
				x++; //text box increment
				//$(wrapper).append('<div class="inner-wrapper-upload"><input type="text" name="docname'+ counter +'" class="form-control" placeholder="Document Name"/><div class="custom-file"><input type="file"  name="docup'+ counter +'" class="custom-file-input" id="customFile" /><label class="custom-file-label" for="customFile">Choose file</label></a></div><a href="#" class="remove_field"><i class="fas fa-plus"></i></div>');
				$(wrapper).append('<div class="inner-wrapper-upload col-md-2"><input type="text" name="docname'+ counter +'" class="form-control" placeholder="Document Name"/><div class="custom-img-uploader"><div class="input-group"><span class="input-group-btn"><span class="btn-file"><input type="file" id="imgSec"><img id="upload-img" class="img-upload-block" src="<?php echo e(asset('admin_assets')); ?>/images/plus-upload.jpg"/></span></span></div></div><a href="#" class="remove_field"><i class="far fa-trash-alt"></i></a></div>');
			}
		});
		
		$(wrapper).on("click",".remove_field", function(e){ //user click on remove text
			e.preventDefault(); $(this).parent('div').remove(); x--;
		})
	});

	$(document).ready(function() {
		var max_fields      = 20; //maximum input boxes allowed
		var wrapper   		= $(".input-wrapper-food"); //Fields wrapper
		var add_button      = $(".add_field_button_food"); //Add button ID
		var counter         = 2;
		
		var x = 1; //initlal text box count
		$(add_button).click(function(e){ //on add input button click
			e.preventDefault();
			if(x < max_fields){ //max input box allowed
				x++; //text box increment
				$(wrapper).append('<div class="inner-wrapper-upload col-md-2"><div class="custom-img-uploader"><div class="input-group"><span class="input-group-btn"><span class="btn-file"><input type="file" id="imgSec" class="image_file"><img id="upload-img" class="img-upload-block" src="<?php echo e(asset('admin_assets')); ?>/images/plus-upload.jpg"/></span></span></div></div><a href="#" class="remove_field_food"><i class="far fa-trash-alt"></i></a></div>');
			}
		});
		
		$(wrapper).on("click",".remove_field_food", function(e){ //user click on remove text
			e.preventDefault(); $(this).parent('div').remove(); x--;
		})
	});

	$(document).ready(function() {
		var max_fields      = 20; //maximum input boxes allowed
		var wrapper   		= $(".input-wrapper-varient"); //Fields wrapper
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
		var wrapper   		= $(".input-wrapper-product"); //Fields wrapper
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
		var wrapper   		= $(".input-wrapper-purchase"); //Fields wrapper
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
		var wrapper   		= $(".input-wrapper-supplies"); //Fields wrapper
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
		var wrapper   		= $(".input-wrapper-orders"); //Fields wrapper
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
// 	$(this).next('.display-variant').slideToggle('slow');
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
        //alert('you');
    } else {
        $("#color_option").hide();
    }
});

$("#freeshipping").click(function() {
    if($(this).is(":checked")) {
        $("#amount-box-block").show();
    } else {
        $("#amount-box-block").hide();
    }
});

</script>

</body>

</html><?php /**PATH D:\web-mingo-project\new\resources\views/partials/footer.blade.php ENDPATH**/ ?>