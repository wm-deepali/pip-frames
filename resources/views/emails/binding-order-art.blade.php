<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Art</title>
    <style>
      * {
        box-sizing: border-box;
      }
      
      @media print {
        .page-break {
          height: 0;
          page-break-before: always;
          margin: 0;
          border-top: none;
        }
      }
      
      @page {
        margin: 10px 0;
      }
      
      body {
        max-width: 450px;
        display: block;
        margin: 0 auto;
        font-family: Helvetica, sans-serif;
      }
      
      .invoice-blk {
        margin: 20px 0;
      }
      
      table {
        width: 100%;
      }
      
      .front-image-blk {
        position: relative;
        margin-bottom: 20px;
      }
      
      .main-front-img,
      .main-spine-img,
      .main-back-img {
        width: 100%;
      }
      
      .book-ribbon-blk {
        position: absolute;
        top: 0;
        left: 25px;
      }
      
      .book-corner-blk .corner-right-top {
        position: absolute;
        top: 0;
        right: 0;
      }
      
      .book-corner-blk .corner-right-botom {
        position: absolute;
        bottom: 3px;
        right: 0;
      }
      
      .book-front-content-blk {
        position: absolute;
        top: 0;
        width: 100%;
        height: 100%;
        padding: 25px;
        text-align: center;
        color: #fff;
      }
      
      .book-top-cont {
        font-size: 14px;
        height: 38px;
        overflow: hidden;
        line-height: 1.3;
        margin-bottom: 10%;
      }
      
      .book-cover-logo {
        height: 70px;
        width: auto !important;
        margin: 0 auto 10%;
      }
      
      .book-heading {
        font-weight: bold;
        font-size: 27px;
        height: 35px;
        overflow: hidden;
        margin: 0 0 15px;
      }
      
      .book-sub-heading {
        font-size: 13px;
        line-height: 15px;
        height: 90px;
        overflow: hidden;
        margin: 0 0 10%;
        padding: 0 30px;
      }
      
      .book-foot-cont {
        font-size: 13px;
        line-height: 16px;
        margin: 0;
        position: absolute;
        width: 100%;
        left: 0;
        bottom: 15px;
      }
      
      .spine-image-blk {
        position: relative;
        margin-bottom: 20px;
      }
      
      .emboss-spine-block-cont {
        position: absolute;
        top: 0;
        left: 50%;
        height: 100%;
        width: 38px;
        transform: translateX(-50%);
      }
      
      .emboss-spine-block-cont p {
        writing-mode: vertical-lr;
        text-orientation: mixed;
        margin: 15px 12px;
        color: #fff;
        font-size: 13px;
      }
      
      .emboss-spine-author {
        min-height: 150px;
        text-align: left;
        margin-bottom: 40px !important;
      }
      
      .emboss-spine-title {
        min-height: 120px;
        text-align: center;
      }
      
      .emboss-spine-year {
        position: absolute;
        bottom: 0;
      }
      
      .back-image-blk {
        position: relative;
        margin-bottom: 20px;
      }
      
      .book-corner-blk .corner-left-top {
        position: absolute;
        top: 0;
        left: 0;
      }
      
      .book-corner-blk .corner-left-botom {
        position: absolute;
        bottom: 0;
        left: 0;
      }
      
      .price-details,
      .buyer-details {
        border: 3px solid #ddd;
        padding: 15px;
        margin-bottom: 20px;
      }
      
      .price-details h3,
      .buyer-details h3 {
        font-size: 20px;
        margin: 0 0 10px;
      }
      
      .price-details p,
      .buyer-details p {
        margin: 0 0 5px;
        font-size: 15px;
      }
    </style>
  </head>

  <body>
    <div class="invoice-blk">
      <table>
        <tbody>
          <tr>
            <td>
              <h2 style="text-align: center;margin: 0 0 10px;font-size: 25px;">{{ $binding_order->binding_type->name }}</h2>
            </td>
          </tr>
          <tr>
            <td>
              <div class="front-image-blk">
                @if (isset($binding_image->front_image) && Storage::exists($binding_image->front_image))
                <img src="{{ URL::asset('storage/'.$binding_image->front_image) }}" class="main-front-img" alt="">
                @else
                <img src="https://bookempire.co.uk/public/storage/images/binding-type-image/e4a8sdNaQj3Eb9B1zhOyEPP6RDxVxEoH62pq2BBb.png" class="main-front-img" alt="">    
                @endif

                <div class="book-ribbon-blk">
                  @if (in_array('foil',$extras))
                    <img src="https://bookempire.co.uk/public/images/online-shop/book-ribbon.png">
                  @endif
                </div>
                <div class="book-corner-blk">
                  @if (in_array('corner_protector',$extras))
                    <img src="https://bookempire.co.uk/public/images/online-shop/corner-right-top.png" class="corner-right-top">
                    <img src="https://bookempire.co.uk/public/images/online-shop/corner-right-bottom.png" class="corner-right-botom">
                  @endif
                </div>
                <div class="book-front-content-blk">
                  <h5 class="book-top-cont"
                  @if ($binding_order->embossing_colour == 'silver')
                    style="color: #C0C0C0"
                  @endif
                  @if ($binding_order->embossing_colour == 'black')
                    style="color: #000000"
                  @endif
                  @if ($binding_order->embossing_colour == 'golden')
                    style="color: #FFD700"
                  @endif
                  >{{ $binding_order->front_university }}</h5>
                  @if (isset($binding_order->university))
                    @if ($binding_order->embossing_colour == 'silver')
                      <img src="{{ URL::asset('storage/'.$binding_order->university->logo_silver) }}" class="book-cover-logo">
                    @endif
                    @if ($binding_order->embossing_colour == 'black')
                      <img src="{{ URL::asset('storage/'.$binding_order->university->logo_black) }}" class="book-cover-logo">
                    @endif
                    @if ($binding_order->embossing_colour == 'golden')
                      <img src="{{ URL::asset('storage/'.$binding_order->university->logo_gold) }}" class="book-cover-logo">                      
                    @endif
                  @endif
                  <h3 class="book-heading"
                  @if ($binding_order->embossing_colour == 'silver')
                    style="color: #C0C0C0"
                  @endif
                  @if ($binding_order->embossing_colour == 'black')
                    style="color: #000000"
                  @endif
                  @if ($binding_order->embossing_colour == 'golden')
                    style="color: #FFD700"
                  @endif>{{ $binding_order->front_art }}</h3>
                  <p class="book-sub-heading"
                  @if ($binding_order->embossing_colour == 'silver')
                    style="color: #C0C0C0"
                  @endif
                  @if ($binding_order->embossing_colour == 'black')
                    style="color: #000000"
                  @endif
                  @if ($binding_order->embossing_colour == 'golden')
                    style="color: #FFD700"
                  @endif>{{ $binding_order->front_title }}</p>
                  <p class="book-foot-cont"
                  @if ($binding_order->embossing_colour == 'silver')
                    style="color: #C0C0C0"
                  @endif
                  @if ($binding_order->embossing_colour == 'black')
                    style="color: #000000"
                  @endif
                  @if ($binding_order->embossing_colour == 'golden')
                    style="color: #FFD700"
                  @endif>{{ $binding_order->front_author }}<br>{{ $binding_order->front_year }}</p>
                </div>
              </div>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
    <div class="page-break"></div>
    <div class="invoice-blk">
      <table>
        <tbody>
          <tr>
            <td>
              <div class="spine-image-blk">
                @if (isset($binding_image->spine_image) && Storage::exists($binding_image->spine_image))
                <img src="{{ URL::asset('storage/'.$binding_image->spine_image) }}" class="main-front-img" alt="">
                @else
                <img src="https://bookempire.co.uk/public/storage/images/binding-type-image/DMhubwCr5PhS5GjQuY3ykaUebdHz9JEXCf1Kgq4G.png" class="main-back-img" alt="">
                @endif
                <div class="emboss-spine-block-cont">
                  <p class="emboss-spine-author" id="binding_spine_author"
                  @if ($binding_order->embossing_colour == 'silver')
                    style="color: #C0C0C0"
                  @endif
                  @if ($binding_order->embossing_colour == 'black')
                    style="color: #000000"
                  @endif
                  @if ($binding_order->embossing_colour == 'golden')
                    style="color: #FFD700"
                  @endif>{{ $binding_order->spine_author }}</p>
                  <p class="emboss-spine-title" id="binding_spine_title"
                  @if ($binding_order->embossing_colour == 'silver')
                    style="color: #C0C0C0"
                  @endif
                  @if ($binding_order->embossing_colour == 'black')
                    style="color: #000000"
                  @endif
                  @if ($binding_order->embossing_colour == 'golden')
                    style="color: #FFD700"
                  @endif>{{ $binding_order->spine_art }}</p>
                  <p class="emboss-spine-year" id="binding_spine_year"
                  @if ($binding_order->embossing_colour == 'silver')
                    style="color: #C0C0C0"
                  @endif
                  @if ($binding_order->embossing_colour == 'black')
                    style="color: #000000"
                  @endif
                  @if ($binding_order->embossing_colour == 'golden')
                    style="color: #FFD700"
                  @endif>{{ $binding_order->spine_year }}</p>
                </div>
              </div>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
    <div class="page-break"></div>
    <div class="invoice-blk">
      <table>
        <tbody>
          <tr>
            <td>
              <div class="back-image-blk">
                @if (isset($binding_image->back_image) && Storage::exists($binding_image->back_image))
                <img src="{{ URL::asset('storage/'.$binding_image->back_image) }}" class="main-front-img" alt="">
                @else
                <img src="https://bookempire.co.uk/public/storage/images/binding-type-image/fcDaxkhffdLliOjMAY54dg5vo7T8KK4PLaNZpK0h.png" class="main-back-img" alt="">
                @endif
                
                <div class="book-corner-blk">
                  @if (in_array('corner_protector',$extras))
                    <img src="https://bookempire.co.uk/public/images/online-shop/corner-left-top.png" class="corner-left-top binding_image_corner_protection">
                    <img src="https://bookempire.co.uk/public/images/online-shop/corner-left-bottom.png" class="corner-left-botom binding_image_corner_protection">
                  @endif
                </div>
              </div>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
    <div class="page-break"></div>
    <div class="invoice-blk">
      <table>
        <tbody>
          <tr>
            <td>
              <div class="price-details">
                <h3>Price Details</h3>
                <p><b>Total Price:</b>£ {{ $binding_order->final_price }}</p>
                <p><b>Delivery Type:</b>{{ Str::title(str_replace('_', ' ', $binding_order->delivery_type)) }}</p>
                <p><b>Date of Delivery:</b>{{ Str::title(str_replace('_', ' ', $binding_order->delivery_date)) }}</p>
              </div>
              <div class="buyer-details">
                <h3>Buyer Details</h3>
                <p><b>name:</b> {{ $binding_order->name }}</p>
                <p><b>Email:</b> {{ $binding_order->email }}</p>
                <p><b>Phone:</b> {{ $binding_order->phone_number }}</p>
                <p><b>Address:</b> {{ $binding_order->address }}</p>
              </div>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </body>

</html>