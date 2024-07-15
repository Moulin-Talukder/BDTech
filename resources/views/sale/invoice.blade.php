<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/34590e0ca8.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="">
    <title>invoice</title>


    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            /* text-transform: uppercase; */
        }


        html {
            font-size: 100%;
        }


        .sm-font{
            font-size: 80%;
        }


        .header {
            position: relative;
            height: 30vh;
            background-position: center;
        }


        .container {
            max-width: 1200px;
            margin: 0 auto;
            width: 95%;
            background-image:url({{url('public/logo/b.png')}});
            background-repeat:no-repeat;
            background-position: center;
            background-size: 1207px 837px;

        }

        .container::after{
            content: "";
            display: block;
            clear: both;
        }


        .header img {
            float: right;
            margin-top: 5rem;
        }


        .header::after {
            content: "";
            display: block;
            clear: both;
        }


        .md-heading {
            font-size: 1.6rem;
        }

        .sm-heading {
            font-size: 75%;
            margin-bottom: 0.5rem;
        }

        /* .row1 {
            border: 1px solid black;
        } */

        .row1 .div1 {
            float: left;
            width: 40%;
        }

        .row1 .div2 {
            float: left;
            width: 20%;
            border: 1px solid black;
            text-align: center;
        }

        .row1 .div3 {
            float: left;
            width: 40%;
            text-align: right;
        }



        .row1::after {
            content: "";
            display: block;
            clear: both;
        }


        table {
            /* font-family: arial, sans-serif; */
            border-collapse: collapse;
            width: 100%;
            margin-bottom: 5rem;
            min-height: 240px;
        }

        td,
        th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }


        th.non_border {
            border: none;
        }


        .name {
            /* float: right; */
            margin-left: 10px;
        }

        .l9 {
            margin-bottom: 2rem;
        }

        .page-footer {
            /* position: fixed;
            bottom: 0; */
            width: 100%;
        }


        @media print {


            .row1 {
                margin-top: -8rem;
            }

            .page-footer {
                position: fixed;
                bottom: 0;
                width: 100%;
            }

            .container {
                background-image:url({{url('public/logo/b.png')}});
                background-repeat:no-repeat;
                background-position-x: 0px;
                background-position-y: 80px;
                background-size: 750px 850px;
            }

            .container::after{
                opacity: 0.06;
            }
        }
    </style>

</head>

<body>


<div class="container">

    <header class="header">
        <img src="{{url('public/logo/logo.png')}}" height="100" width="300" alt="logo1">
    </header>

    <div class="row1">

        <div class="div1 sm-heading">

            <div class="l1">
                <label for="">To</label>
                <p>{{ $lims_sale_data->customer->company_name }}</p>
            </div>

            <div class="l2">
                <label for="">Address: {{ $lims_sale_data->customer->head_office_address }}</label>
            </div>

            <div class="l4">
                <label for="">Email: {{ $lims_sale_data->customer->email }}</label>
            </div>
            <div class="l5">
                <label for="">Phone: {{ $lims_sale_data->customer->phone_number }}</label>
            </div>


        </div>

        <div class="div2">

            <div class="l6">
                <label for="">Invoice</label>
            </div>

        </div>

        <div class="div3 sm-heading">

            <div class="l7">
                <label for="">Date: {{$date}}</label>
            </div>
            <div class="l8">
                <label for="">Invoice No: {{$invoice_no}}</label>
            </div>

        </div>

    </div>
    
    <div class="table">
        <table>

            <tr >
                <th style="text-align:center">SL NO</th>
                <th style="text-align:center">Item Code</th>
                <th style="text-align:center">Description</th>
                <th style="text-align:center">Quantity</th>
                <th style="text-align:center">Unit</th>
                <th style="text-align:center">Rate</th>
                <th style="text-align:center">Amount</th>
            </tr>

            @php
                $product_tax = 0;$service_tax = 0; $product_net =0;$service_net =0;$service_discount = 0;$product_discount = 0;$product_qty=0;$product_unit=0;$total_price=0;$service_qty=0;$service_unit=0;$total_price_ser=0;
            @endphp
            @foreach ($lims_product_sale_data as $key => $product)
                <?php
                $lims_product_data = \App\Product::find($product->product_id);

                if($product->variant_id) {
                    $variant_data = \App\Variant::find($product->variant_id);
                    $product_name = $lims_product_data->name.' ['.$variant_data->name.']';
                }
                else
                    $product_name = $lims_product_data->name.' ['.$lims_product_data->code.']';
                ?>
                <tr>
                    <td style="text-align:center">{{ $loop->iteration }}</td>
                    <td style="text-align:center">{{ $product->product->product_item_code }}</td>
                    <td>
                        <strong>{{ $product->product->name }}</strong>
                        <em><p>Sr No :{{ $product->product->code }} : Warranty : {{ $product->product->warranty }}</p></em>
                    </td>
                    <td style="text-align:center">{{ $product->qty }}</td>
                    @php
                        $product_qty +=$product->qty;
                    @endphp
                    <td style="text-align:center">{{$product->product->unit->unit_name}}</td>
                    @php
                        $product_net +=$product->net_unit_price;
                    @endphp
                    <td style="text-align:center">{{number_format((float)($product->total / $product->qty), 2, '.', '')}}</td>
                    @php
                        $product_unit += ($product->total / $product->qty);
                    @endphp
                    <td style="text-align:right">{{number_format((float)$product->total, 2, '.', '')}}</td>
                    @php
                        $total_price += $product->total;
                    @endphp
                </tr>
            @endforeach
            <tfoot>
            <tr>
                <th class="non_border sm-font" colspan="3" width="70%">Bill Amount in WORD : "{{\App\helper\NumberToWord::get($lims_sale_data->grand_total)}} "TAKA ONLY</th>

                <th colspan="3" style="text-align:right;">
                    <p>Total Amount : </p>
                    <p>[-] Order Discount : </p>
                    <p>[-] Commision : </p>
                    <p>[+] Vat {{$lims_sale_data->order_tax_rate}}% : </p>
                    <p>[+] Shipping Cost : </p>
                    <p>Net Payable : </p>
                    <p>Paid Amount : </p>
                    <p>Bill Due :</p>
                </th>
                <th style="text-align:right;">
                    <p>{{number_format((float)$total_price_ser + $total_price, 2, '.', '')}}</p>
                    <p>{{number_format((float)$lims_sale_data->commission_amount, 2, '.', '')}}</p>
                    <p>{{number_format((float)$lims_sale_data->order_discount, 2, '.', '')}}</p>
                    <p>{{number_format((float)$lims_sale_data->order_tax, 2, '.', '')}}</p>
                    <p>{{number_format((float)$lims_sale_data->shipping_cost, 2, '.', '')}}</p>
                    <p>{{number_format((float)$lims_sale_data->grand_total, 2, '.', '')}}</p>
                    @if($lims_sale_data->paid_amount == '')
                        <p>0.00</p>
                        <p>{{number_format((float)$lims_sale_data->grand_total, 2, '.', '')}}</p>
                    @else
                        <p>{{number_format((float)$lims_sale_data->paid_amount, 2, '.', '')}}</p>
                        <p>{{number_format((float)$lims_sale_data->grand_total-$lims_sale_data->paid_amount, 2, '.', '')}}</p>
                    @endif
                </th>
            </tr>
            </tfoot>

        </table>

    </div>


    <p>Note.: New Sale, Carry By {{$lims_sale_data->carried_by}}</p>
    <br><br><br><br>

    <div class="name">
        <div class="l9">
            <label for="">Best Regards</label>
        </div>

        <div class="l10">
            <p>Managing Director</p>
            <p>BDTech Solution</p>
            <p>Mobile: +8801837283923</p>
        </div>
    </div>

    <div class="page-footer" style="margin-bottom:20px;">
        <img src="{{url('public/logo/f.png')}}" alt="Side Image" style="width:100%;">
    </div>

</div>

<script type="text/javascript">
    function auto_print() {
        window.print()
    }
    setTimeout(auto_print, 1000);
</script>



</body>

</html>