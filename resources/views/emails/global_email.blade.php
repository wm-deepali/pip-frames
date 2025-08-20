<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Welcome to Book Empire</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<style type="text/css">
    table {
      font-family: arial, sans-serif;
      border-collapse: collapse;
      width: 100%;
    }

    td, th {
      border: 1px solid #dddddd;
      text-align: left;
      padding: 8px;
    }

    tr:nth-child(even) {
      background-color: #dddddd;
    }
</style>
</head>
<body style="margin: 0; padding: 0;">
    <table border="0" cellpadding="0" cellspacing="0" width="100%"> 
        <tr>
            <td style="padding: 10px 0 30px 0;">
                <table align="center" border="0" cellpadding="0" cellspacing="0" width="600" style="border: 1px solid #cccccc; border-collapse: collapse;">
                    <tr>
                        <td bgcolor="#ffffff" style="padding: 10px;">
                            <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                <tr>
                                    <td style="color: #153643; font-family: Arial, sans-serif; font-size: 16px;">
                                        <p>
                                            Dear <span style="color:red;">{{ $data['name'] }}</span><br><br>
                                            {!! $data['message_one'] !!}<br><br>
                                            @if($data['message_two']) {!! $data['message_two'] !!}<br><br> @endif
                                            @if($data['message_three']) {!! $data['message_three'] !!}<br><br> @endif
                                            Thanks & Regards<br><br>
                                            @if($data['logo'])
                                                <img src="{{ $data['logo'] }}" alt="lOGO" width="200px" height="auto" style="display: block;" />
                                            @endif
                                            Admin<br><br>
                                            Book Empire<br><br>
                                            {{ $data['address'] }} || {{ $data['mobile_number'] }}<br><br>
                                        </p>

                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>