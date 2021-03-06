<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Predračun</title>
    <meta name="viewport" content="width=device-width,initial-scale=1"/>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <style type="text/css">
        @page {
            margin: 0px;
        }

        html {
            width: 100%;
        }

        body {
            margin: 0px;
            width: 100vw;
            font-family: DejaVu Sans, sans-serif;
        }

        * {
            font-family: DejaVu Sans, sans-serif;
        }

        a {
            color: #fff;
            text-decoration: none;
        }

        table {
            font-size: x-small;
            font-family: DejaVu Sans, sans-serif;
        }

        tfoot tr td {
            font-weight: bold;
            font-size: x-small;
            font-family: DejaVu Sans, sans-serif;
        }

        .invoice table, .taxes table {
            padding: 15px;
        }

        .invoice h3 {
            text-align: center;
            margin-bottom: 5px;
        }

        .invoice h4 {
            text-align: center;
            margin-top: 5px;
        }

        .information {
            background-color: #b11f22;
            color: #FFF;
        }


        .information table {
            padding: 10px;
        }
    </style>

</head>
<body>

<div class="information">
    <table width="100%">
        <tr>
            <td align="left" valign="top" style="width: 40%;font-weight: 600">
                <h3 style="margin: 0 0 3px">ROTOR d.o.o </h3>
                <h5 style="margin: 0">DUMIDRAN BB, TIVAT</h5>
                <h5 style="margin: 0">Žiro račun:<br/>530-13335-69 NLB<br/>550-6909-17 Podgorička banka<br/>510-196-34 CKB</h5>
                <h5 style="margin: 0">PDV: 91/31-00128-8</h5>
                <h5 style="margin: 0">PIB: 02047799</h5>
                <h5 style="margin: 0">Tel: +382 32 671 044</h5>
                <h5 style="margin: 0">Fax: +382 32 671 346</h5>
            </td>
            <td align="center">
                <img src="{{ url('/') }}/logo.png" alt="Logo" class="logo" height="80"/>
            </td>
            <td align="right" valign="top" style="width: 40%; font-weight: 600;font-family: DejaVu Sans, sans-serif;">
                <h3 style="margin: 0 0 3px">{{$order->name}}</h3>

                <h5 style="margin: 0">{{$order->phone}}</h5>
                <h5 style="margin: 0">{{$order->address}}</h5>
                <h5 style="margin: 0">{{$order->city}}</h5>
                <h5 style="margin: 0">{{$order->type}}</h5>
				@if($order->type == "Pravno lice")
				<h5 style="margin: 0">{{$order->company_name}}</h5>
				@endif
            </td>
        </tr>

    </table>
</div>
<br/>
<div style="margin-left: 15px">
    <p style="margin-left: 15px;font-size: 12px;margin:0"><b>Način plaćanja:</b> {{$order->payment_type}}</p>
    <p style="margin-left: 15px;font-size: 12px;margin:0"><b>Napomena:</b> {{$order->note}}</p>

</div>
<div class="invoice">
    <h3>Predračun</h3>
    <h4>{{date('d.m.Y.')}}.</h4>
    <table width="100%">
        <thead>
        <tr style="background-color: #ccc;">
            <th style="padding: 10px 5px">Šifra</th>
            <th style="padding: 10px 5px">Naziv</th>
            <th style="padding: 10px 5px">Količina</th>
            <th style="padding: 10px 5px" align="right">Cijena</th>
            <th style="padding: 10px 5px" align="right">Ukupno</th>
        </tr>
        </thead>
        <tbody>

        @foreach($order->items as $item)
            <tr>
                <td style="padding: 5px">{{$item->product_code}}</td>
                <td style="padding: 5px">{{$item->name}}</td>
                <td style="padding: 5px">{{$item->amount}}</td>
                <td style="padding: 5px" align="right">{{(double)$item->price - ($item->price * ($item->discount/100))}}</td>
                <td style="padding: 5px"
                    align="right">{{number_format((double)($item->price - ($item->price * ($item->discount/100))) *(double)$item->amount,2)}}&euro;
                </td>
            </tr>
        @endforeach

        </tbody>
        <tfoot>
        <tr>
            <td colspan="2"></td>
            <td style="padding: 5px;border-top: 1px solid #ccc" colspan="1"></td>
            <td style="padding: 5px;border-top: 1px solid #ccc" align="right">Neto</td>
            <td style="padding: 5px;border-top: 1px solid #ccc" align="right" class="gray">
                @php
                    $neto = 0;
                    $total = 0;
                @endphp
                @foreach($order->items as $item)
                    @php
                        $total += ((double)($item->price - ($item->price * ($item->discount/100))) * $item->amount)
                    @endphp
                @endforeach
                @php
                    $pdv = $total - ($total / 1.21);
                    $neto  = $total - $pdv;
                    echo number_format($neto,2)."&euro;";
                @endphp

            </td>
        </tr>
        <tr>
            <td colspan="2"></td>
            <td style="padding: 5px;" colspan="1"></td>
            <td style="padding: 5px;" align="right">PDV</td>
            <td style="padding: 5px;" align="right" class="gray">
                @php
                    echo number_format($pdv,2)."&euro;";
                @endphp
            </td>
        </tr>
        <tr>
            <td colspan="2"></td>
            <td style="padding: 5px;border-bottom: 1px solid #ccc" colspan="1"></td>
            <td style="padding: 5px;border-bottom: 1px solid #ccc" align="right">Bruto</td>
            <td style="padding: 5px;border-bottom: 1px solid #ccc" align="right" class="gray">@php
                    echo number_format($total,2)."&euro;";
                @endphp</td>
        </tr>
        </tfoot>
    </table>
</div>


</body>
</html>
