<div style="width: 100%; padding: 60px 0; background: #fff; margin: 0; font-family: 'Roboto Condensed', sans-serif;">
    <table border-spacing="0" style="width: 21cm; margin: 0 auto; background: #fff; font-size: 14px; padding:15px 30px; border:1px solid #eee; font-family: 'Roboto Condensed', sans-serif;">
    <tbody>
    <tr>
    <td>
    <table border-spacing="0" style=" background: #fff; padding-bottom: 15px; border-bottom:1px solid #eee" width="100%" cellspacing="0" cellpadding="0">
     <tbody>
    <tr>
    <td align="left" width="30%">
    <img src="{{ URL::asset('site_assets/images/logo.png') }}" height="150">
    </td>
    <td align="right" width="70%" style="text-align: right;">
    <h2 style="font-size: 1.4em;font-weight: normal; margin: 0; color: #AB8818;">Book Empire</h2>
    <p style="color:#555; font-size:24px; margin:5px 0;">Book Empire,</p>
    <p style="color:#555; font-size:24px; margin: 0;">Unit 7,Lotherton Way,</p>
    <p style="color:#555; font-size:24px; margin: 0;">Leeds , West Yorkshire, LS2S 2JY</p>
    <p style="color:#555; font-size:24px; margin: 0;">Phone: 0113 2874 724</p>
    <a href="mailto:info@bookempire.co.uk">info@bookempire.co.uk</a>
    </td>
    </tr>
    </tbody>
    </table>
    </td>
    </tr>
    <tr>
    <td>
    <table border-spacing="0" style=" background: #fff; padding: 15px 0;" width="100%" cellspacing="0" cellpadding="0">
    <tbody>
    <tr>
    <td align="left" width="50%" style="text-align: left; border-left:6px solid #AB8818; padding-left: 6px; ">
    <p style="color:#555; font-size:24px; margin:0 0 5px 0;">User Details</p>
    <h2 style="font-size: 1.4em;font-weight: normal; margin: 0; color: #AB8818;">{{ $details['name'] }}</h2>
    <p style="color:#555; font-size:24px; margin:5px 0;">{{ $details['phone_number'] }}</p>
    <a href="mailto:company@example.com">{{ $details['email'] }}</a>
    </td>
    <td align="right" width="50%" style="text-align: right;">
    <h2 style="font-size: 2.4em;font-weight: normal; margin: 0 0 10px 0; color: #AB8818;">Instant Quote</h2>
    <p style="color:#777; font-size:1.1em; margin:5px 0;">Quote Number: {{ $details['quote_number'] }}</p>
    <p style="color:#777; font-size:1.1em; margin: 0;">Date of Quotation: {{ $details['created_at'] }}</p>
    </td>
    </tr>
    </tbody>
    </table>
    </td>
    </tr>   
    <tr>
    <td>
    <table border-spacing="0" style=" background: #fff; padding: 15px 0;" width="100%" cellspacing="0" cellpadding="0">
    <tbody>
    <tr>
    <td align="left" width="50%" style="text-align: left; border-left:6px solid #AB8818; padding-left: 6px; ">
    <h2 style="font-size: 1.4em;font-weight: normal; margin: 0; color: #AB8818;">Book Binding and Type </h2>
    <p style="color:#000; font-size:24px; margin:8px 0;">{{ $details['book_type'] }} 
        @if ($details['foil'] == 'yes')
        <span style="color: #888;">- Foil</span>
        @endif
        @if ($details['dust_jacket'] == 'yes')
        <span style="color: #888;">- Dust Jacket</span>
        @endif
    </p>
    </td>
    </tr>
    </tbody>
    </table>
    </td>
    </tr>
    <tr>
    <td>
    <table border-spacing="0" style=" background: #fff; padding: 15px 0;" width="100%" cellspacing="0" cellpadding="0">
    <tbody>
    <tr>
    <td align="left" width="50%" style="text-align: left; border-left:6px solid #AB8818; padding-left: 6px; ">
    <h2 style="font-size: 1.4em;font-weight: normal; margin: 0; color: #AB8818;">Paper Type and Size</h2>
    <p style="color:#000; font-size:24px; margin:8px 0;">Size of Your Book - <span style="color: #888;">{{ $details['size_of_book'] }}</span></p>
    <p style="color:#000; font-size:24px; margin:8px 0;">Ink Colour - <span>{{ $details['ink_colour'] }}</span></p>
	{{--	<p style="color:#000; font-size:24px; margin:8px 0;">Number of Books - <span>{{ $details['unit'] }}</span></p> --}}


    <p style="color:#000; font-size:24px; margin:8px 0;">Page Counts - <span style="color: #888;">{{ $details['black_and_white_page_count'] }} Black/White pages , {{ $details['colour_page_count'] }} Colour Pages</span></p>
    <p style="color:#000; font-size:24px; margin:8px 0;">Paper Type - <span style="color: #888;">{{ $details['paper_type'] }}</span></p>
     <p style="color:#000; font-size:24px; margin:8px 0;">Paper Thickness - <span style="color: #888;"> {{ $details['paper_thickness'] }}</span></p>
    <p style="color:#000; font-size:24px; margin:8px 0;">Orientation - <span style="color: #888;">{{ $details['orientation'] }}</span></p>
    </td>
    </tr>
    </tbody>
    </table>
    </td>
    </tr>
    <tr>
    <td>
    <table border-spacing="0" style=" background: #fff; padding: 15px 0;" width="100%" cellspacing="0" cellpadding="0">
    <tbody>
    <tr>
    <td align="left" width="50%" style="text-align: left; border-left:6px solid #AB8818; padding-left: 6px; ">
    <h2 style="font-size: 1.4em;font-weight: normal; margin: 0; color: #AB8818;">Cover Options </h2>
     <p  style="color:#000; font-size:24px; margin:8px 0;">Cover Weight - <span style="color: #888;">{{ $details['cover_weight'] }}</span></p>
    <p  style="color:#000; font-size:24px; margin:8px 0;">Cover Finishing - <span style="color: #888;">{{ $details['cover_finish'] }}</span></p>
    </td>
    </tr>
    </tbody>
    </table>
    </td>
    </tr>
    <tr>
    <td>
    <table border-spacing="0" style=" background: #fff; padding: 15px 0;" width="100%" cellspacing="0" cellpadding="0">
    <tbody>
    <tr>
    <td align="left" width="50%" style="text-align: left; border-left:6px solid #AB8818; padding-left: 6px; ">
    <h2 style="font-size: 1.4em;font-weight: normal; margin: 0; color: #AB8818;">Files & Content </h2>
    <p  style="color:#000; font-size:24px; margin:8px 0;">Files - <span style="color: #888;">{{ $details['supplying_file_format'] }}</span></p>
    <p  style="color:#000; font-size:24px; margin:8px 0;">Proof - <span style="color: #888;">{{ $details['want_proof_by'] }}</span></p>
		<p  style="color:#000; font-size:24px; margin:8px 0;" style="display:none">Proof - <span style="color: #888;">
			  @if($details['want_proof_by']==" Hard Copy Via Post")
			 £40
			  @elseif($details['want_proof_by']=="Pdf Via Email")
			  £10
			  @else
			  £0
			  @endif
			  </span></p>
    </td>
    </tr>
    </tbody>
    </table>
    </td>
    </tr>
    <tr>
    <td>
    <table border-spacing="0" style=" background: #fff; padding: 15px 0;" width="100%" cellspacing="0" cellpadding="0">
    <tbody>
    <tr>
    <td align="left" width="50%" style="text-align: left; border-left:6px solid #AB8818; padding-left: 6px; ">
    <h2 style="font-size: 1.4em;font-weight: normal; margin: 0; color: #AB8818;">Extra Options </h2>
    <p  style="color:#000; font-size:24px; margin:8px 0;">Extra Options - <span style="color: #888;">{{ $details['extra_option'] }}</span></p>
    </td>
    </tr>
    </tbody>
    </table>
    </td>
    </tr>
    <tr>
    <td>
    <table border-spacing="0" style=" background: #fff; padding: 15px 0;" width="100%" cellspacing="0" cellpadding="0">
    <tbody>
    <tr>
    <td align="left" width="50%" style="text-align: left; border-left:6px solid #AB8818; padding-left: 6px; ">
    <h2 style="font-size: 1.4em;font-weight: normal; margin: 0; color: #AB8818;">Delivery</h2>
    <p  style="color:#000; font-size:24px; margin:8px 0;">Address - <span style="color: #888;">{{ $details['delivery_location'] }}</span></p>
    </td>
    </tr>
    </tbody>
    </table>
    </td>
    </tr>
    <tr>
    <td>
    <table border-spacing="0" style=" background: #fff; padding: 15px 0;" width="100%" cellspacing="0" cellpadding="0">
    <tbody>
    <tr>
    <td align="left" width="50%" style="text-align: left; border-left:6px solid #AB8818; padding-left: 6px; ">
    <h2 style="font-size: 1.4em;font-weight: normal; margin: 0; color: #AB8818;">Your Details</h2>
    <p  style="color:#000; font-size:24px; margin:8px 0;">Details - <span style="color: #888;">Name - {{ $details['name'] }} / Email - {{ $details['email'] }} / Phone Number - {{ $details['phone_number'] }}</span></p>
    <p  style="color:#000; font-size:24px; margin:8px 0;">Are your files ready to print - <span style="color: #888;">{{ $details['file_status'] }}</span></p>
    </td>
    </tr>
    </tbody>
    </table>
    </td>
    </tr>
    <tr>
    <td>
    <table border-spacing="0" style=" background: #fff; padding: 15px 0;" width="100%" cellspacing="0" cellpadding="0">
    <tbody>
    <tr>
 {{--   <td align="right" width="50%" style="text-align: right;">
	<h2 style="font-size: 2em;font-weight: normal; margin: 0 0 10px 0; color: #AB8818;">Total Price :<span style="margin-left: 15px; color: #000;">£{{ $details['final_price'] }}</span></h2>
    </td> --}}
    </tr>
    </tbody>
    </table>
    </td>
    </tr>  
		<tr>
<td>
    <table border-spacing="0" style=" background: #fff; padding: 15px 0;" width="100%" cellspacing="0" cellpadding="0">
        <thead align="left" width="50%" style="text-align: left; border-left:6px solid #AB8818; padding-left: 6px; ">
            <td   align="left" width="50%" style="text-align: left; border-left:6px solid #AB8818; padding-left: 6px; "><h4>Number of Books</h4></td>
            <td  ><h4>Total Price</h4></td>
        </thead>
        <tbody align="left" width="50%" style="text-align: left; border-left:6px solid #AB8818; padding-left: 6px; ">
            <tr>
                <td  align="left" width="50%" style="text-align: left; border-left:6px solid #AB8818; padding-left: 6px; "><h4>{{ $details['unit'] }} Books </h4></td>
                <td>£{{ $details['final_price'] }}</td>
            </tr>
            <tr>
            @if($details['unit2'] >=1)
            <td  align="left" width="50%" style="text-align: left; border-left:6px solid #AB8818; padding-left: 6px; "><h4>{{ $details['unit2'] }} Books </h4></td>
            @endif
                @if($details['unit2'] >=1)
            <td>£{{ $details['final_price2'] }}</td>
            @endif
            </tr>
            <tr>
            @if($details['unit3'] >=1)
            <td  align="left" width="50%" style="text-align: left; border-left:6px solid #AB8818; padding-left: 6px; "><h4>{{ $details['unit3'] }} Books </h4></td>
            @endif
                @if($details['unit3'] >=1)
            <td>£{{ $details['final_price3'] }}</td>
            @endif
            </tr>
            
            
            
        </tbody>
    </table>
			</td>
		</tr>
      </div>