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
                                    <h2 style="font-size: 1.4em;font-weight: normal; margin: 0; color: #AB8818;">THESIS ONLINE ORDER</h2>
                                    <p style="color:#555; font-size:24px; margin:5px 0;">BOOK EMPIRE</p>
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
                                    <h2 style="font-size: 1.4em;font-weight: normal; margin: 0; color: #AB8818;">{{ $binding_order->name }}</h2>
                                    <p style="color:#555; font-size:24px; margin:5px 0;">{{ $binding_order->phone_number }}</p>
                                    <a href="mailto:company@example.com">{{ $binding_order->email }}</a>
                                    <p style="color:#555; font-size:24px; margin:5px 0;">{{ $binding_order->address }}</p>
                                </td>
                                <td align="right" width="50%" style="text-align: right;">
                                    <h2 style="font-size: 2.4em;font-weight: normal; margin: 0 0 10px 0; color: #AB8818;">Thesis Order</h2>
                                    <p style="color:#777; font-size:1.1em; margin:5px 0;">Order Number: {{ $binding_order->order_number }}</p>
                                    <p style="color:#777; font-size:1.1em; margin: 0;">Date of Quotation: {{ $binding_order->created_at }}</p>
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
                                    <h2 style="font-size: 1.4em;font-weight: normal; margin: 0; color: #AB8818;">Binding Type </h2>
                                    <p style="color:#000; font-size:24px; margin:8px 0;">
                                        {{ $binding_order->binding_type->name ?? '-' }}-<span style="color: #888;">{{ $binding_order->colour->name ?? '-' }}</span>
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
                                    <h2 style="font-size: 1.4em;font-weight: normal; margin: 0; color: #AB8818;">Number of Copies</h2>
                                    <p style="color:#000; font-size:24px; margin:8px 0;">{{ $binding_order->binding_quantity }} </p>
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
                                    <h2 style="font-size: 1.4em;font-weight: normal; margin: 0; color: #AB8818;">Foil Details</h2>
                                    <p style="color:#000; font-size:24px; margin:8px 0;">{{ Str::title(str_replace('_', ' ', $binding_order->embossing_type)) }}-<span style="color: #888;">{{ Str::title(str_replace('_', ' ', $binding_order->embossing_colour)) }}</span></p>
                                    <p style="color:#000; font-size:24px; margin:8px 0;">Spine Embossing - <span style="color: #888;">{{ Str::title(str_replace('_', ' ', $binding_order->has_embossed_spine)) }}</span></p>
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
                                    <h2 style="font-size: 1.4em;font-weight: normal; margin: 0; color: #AB8818;">Printing Type & Paper Grade</h2>
                                    <p style="color:#000; font-size:24px; margin:8px 0;">Printing Type-<span style="color: #888;">{{ Str::title(str_replace('_', ' ', $binding_order->printing_type)) }}</span></p>
                                    <p style="color:#000; font-size:24px; margin:8px 0;">Paper Grade-<span style="color: #888;">{{ Str::title($binding_order->paper_grade->name ?? '-') }}</span></p>
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
                                    <h2 style="font-size: 1.4em;font-weight: normal; margin: 0; color: #AB8818;">Extra & Accessories</h2>
                                    @php
                                        $extra_accessories = json_decode($binding_order->extra_accessories_json);
                                    @endphp
                                    @if (is_array($extra_accessories))
                                        @foreach ($extra_accessories as $extra_accessory)
                                            <p style="color:#000; font-size:24px; margin:8px 0;">Extra Options-<span style="color: #888;">{{ Str::title(str_replace('_', ' ', $extra_accessory->name)) }}</span></p>
                                        @endforeach
                                    @else
                                        <p style="color:#000; font-size:24px; margin:8px 0;">Extra Option-<span style="color: #888;">None</span></p>
                                    @endif
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
                                    <h2 style="font-size: 1.4em;font-weight: normal; margin: 0; color: #AB8818;">Data Check</h2>
                                    <p style="color:#000; font-size:24px; margin:8px 0;">Check for printability-<span style="color: #888;">{{ Str::title($binding_order->check_data_for_printability) }}</span></p>
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
                                    <p style="color:#000; font-size:24px; margin:8px 0;">Delivery-<span style="color: #888;">{{ Str::title(str_replace('_', ' ', $binding_order->delivery_type)) }}</span></p>
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
                                    <p  style="color:#000; font-size:24px; margin:8px 0;">Details - <span style="color: #888;">Name - {{ $binding_order->name }} / Email - {{ $binding_order->email }} / Phone Number - {{ $binding_order->phone_number }}</span></p>
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
                                <td align="right" width="50%" style="text-align: right;">
                                    <h2 style="font-size: 2em;font-weight: normal; margin: 0 0 10px 0; color: #AB8818;">Total Price :<span style="margin-left: 15px; color: #000;">£ {{ $binding_order->final_price }}</span></h2>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>  
        </tbody>
    </table>
</div>