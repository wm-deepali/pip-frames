<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Invoice</title>
    <style>
      body {
        font-family: Arial, Helvetica, sans-serif;
        padding: 60px;
        margin: 0;
      }
      
      tr td {
        vertical-align: top;
      }
      
      .invoice-blk {
        border: 2px solid #ddd;
        padding: 20px;
      }
      
      table {
        width: 100%;
        border: none;
        margin: 0;
      }
      
      .conpany-details {
        text-align: right;
      }
      
      .conpany-details h3,
      .user-details h3,
      .order-details h3 {
        margin: 0 0 10px;
        color: #ab8818;
        font-size: 22px;
      }
      
      .conpany-details p,
      .user-details p,
      .order-details p {
        margin: 0 0 9px;
        line-height: 1.4;
        font-size: 16px;
      }
      
      .order-details {
        text-align: right;
      }
    </style>
  </head>

  <body>
    <div class="invoice-blk">
      <table>
        <thead>
          <tr>
            <td style="width:50%;border-bottom: 2px solid #ddd;padding-bottom: 20px;"><img src="https://bookempire.co.uk/public/site_assets/images/logo.png" alt=""></td>
            <td style="width:50%;border-bottom: 2px solid #ddd;padding-bottom: 20px;">
              <div class="conpany-details">
                <h3>Book Empire</h3>
                <p>Unit 7, Lotherton Way,<br> Leeds, West Yorkshire, LS2S 2JY</p>
                <p><b>Phone: </b> 0113 2874724</p>
                <p><b>Email: </b> info@bookempire.co.uk</p>
              </div>
            </td>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td style="padding-top: 20px;">
              <div class="user-details">
                <h3>Customer Details</h3>
                <p><b>Name:</b> {{ $binding_order->name }}</p>
                <p><b>Phone:</b> {{ $binding_order->phone_number }}</p>
                <p><b>Email:</b> {{ $binding_order->email }}</p>
              </div>
            </td>
            <td style="padding-top: 20px;">
              <div class="order-details">
                <h3>Binding Order Payment</h3>
                <p><b>Date of Order:</b> {{ $binding_order->created_at }}</p>
                <p><b>Order Number:</b> {{ $binding_order->order_number }}</p>
              </div>
            </td>
          </tr>
          <tr style="padding-top: 20px;">
            <td colspan="2">
              <div class="user-details">
                <h3>Payment</h3>
                <p><b>Amount: </b>£{{ $binding_order->final_price }}</p>
                <p><b>Status: </b>{{ $binding_order->payment_status }}</p>
              </div>
            </td>
          </tr>
        </tbody>
      </table>
      <table>
      </table>
    </div>
  </body>
</html>