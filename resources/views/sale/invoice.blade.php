<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="icon" type="image/png" href="{{url('public/logo', $general_setting->site_logo)}}" />
    <title>{{$general_setting->site_title}}</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">

    <style type="text/css">
        * {
            font-size: 14px;
            line-height: 24px;
            font-family: 'Ubuntu', sans-serif;
            text-transform: capitalize;
        }
        .btn {
            padding: 7px 10px;
            text-decoration: none;
            border: none;
            display: block;
            text-align: center;
            margin: 7px;
            cursor:pointer;
        }

        .btn-info {
            background-color: #999;
            color: #FFF;
        }

        .btn-primary {
            background-color: #6449e7;
            color: #FFF;
            width: 100%;
        }
        .col-1, .col-2, .col-3, .col-4, .col-5, .col-6, .col-7, .col-8, .col-9, .col-10, .col-11, .col-12, .col,
.col-auto, .col-sm-1, .col-sm-2, .col-sm-3, .col-sm-4, .col-sm-5, .col-sm-6, .col-sm-7, .col-sm-8, .col-sm-9, .col-sm-10, .col-sm-11, .col-sm-12, .col-sm,
.col-sm-auto, .col-md-1, .col-md-2, .col-md-3, .col-md-4, .col-md-5, .col-md-6, .col-md-7, .col-md-8, .col-md-9, .col-md-10, .col-md-11, .col-md-12, .col-md,
.col-md-auto, .col-lg-1, .col-lg-2, .col-lg-3, .col-lg-4, .col-lg-5, .col-lg-6, .col-lg-7, .col-lg-8, .col-lg-9, .col-lg-10, .col-lg-11, .col-lg-12, .col-lg,
.col-lg-auto, .col-xl-1, .col-xl-2, .col-xl-3, .col-xl-4, .col-xl-5, .col-xl-6, .col-xl-7, .col-xl-8, .col-xl-9, .col-xl-10, .col-xl-11, .col-xl-12, .col-xl,
.col-xl-auto {
  position: relative;
  width: 100%;
  min-height: 1px;
}
        .col-6 {
  -webkit-box-flex: 0;
  -ms-flex: 0 0 50%;
  flex: 0 0 50%;
  max-width: 50%;
  text-align: left;
        }
.col-12 {
  -webkit-box-flex: 0;
  -ms-flex: 0 0 100%;
  flex: 0 0 100%;
  max-width: 100%;
display: grid;
}
.right{ 
text-align: right; padding-right: 20px;
}
        td,
        th,
        tr,
        table {
            border-collapse: collapse;
            border: 1px solid #eeeeee91;
        }
        tr {border-bottom: 1px dotted #ddd;}
        td,th {padding: 7px 0}

        table {width: 100%;}
        tfoot tr th:first-child {text-align: left;}
        .row {
            display:flex;
            text-align: center;
            align-content: center;
        }
        .invoice-buttom{
        -webkit-box-flex: 0;
        -ms-flex: 0 0 100%;
         flex: 0 0 100%;
         max-width: 100%;
         justify-content: center;
         display: grid;
         padding: 10px 0 10px 0;
        }
        .centered {
            text-align: center;
            align-content: center;
        }
        small{font-size:11px;}
        hr {
        width: 100%;
        margin-left: auto;
        margin-right: auto;
        color: #eee;
      }
        @media print {
            * {
                font-size:12px;
                line-height: 20px;
            }
            td,th {padding: 5px 0;}
            .hidden-print {
                display: none !important;
            }
            @page { margin: 0; } body { margin: 0.5cm; margin-bottom:1.6cm; } 
        }
    </style>
  </head>
<body>

<div style="max-width:600px;margin:0 auto">
    @if(preg_match('~[0-9]~', url()->previous()))
        @php $url = '../../pos'; @endphp
    @else
        @php $url = url()->previous(); @endphp
    @endif
    <div class="hidden-print">
        <table>
            <tr>
                <td><a href="{{$url}}" class="btn btn-info"><i class="fa fa-arrow-left"></i> {{trans('file.Back')}}</a> </td>
                <td><button onclick="window.print();" class="btn btn-primary"><i class="dripicons-print"></i> {{trans('file.Print')}}</button></td>
            </tr>
        </table>
        <br>
    </div>
        
    <div id="receipt-data" style="max-height:29.7cm;">
    <div class="row">
        <div class="col-6">
            @if($general_setting->site_logo)
                <img src="{{url('public/logo', $general_setting->site_logo)}}" width="120" height="70" style="margin:10px 0">
            @endif
            <p>
            {{trans('file.reference')}}: {{$lims_sale_data->reference_no}}<br>
            Date d’émission: {{$lims_sale_data->created_at->toDateString()}}<br>
            </p>
        </div>
        <div class="col-6" style="text-align: center;">
        <?php echo '<img style="margin-top:50px;" src="data:image/png;base64,' . DNS2D::getBarcodePNG($lims_sale_data->reference_no, 'QRCODE') . '" alt="barcode"   />';?>    
        </div>
        </div>
        <hr />
        <div class="row">
        <div class="col-6">
               {{$lims_warehouse_data->address}}
            <br>{{trans('file.VAT Number')}}: {{$lims_general_setting_data->vat_number}}
            <br>{{trans('file.Email')}}: {{$lims_general_setting_data->email}}
            <br>{{trans('file.Phone Number')}}: {{$lims_general_setting_data->phone}}
            </p>
        </div>
        <div class="col-6">
         <p>
            {{trans('file.customer')}}: {{$lims_customer_data->name}}<br>
            {{$lims_customer_data->address}}<br>
            {{trans('file.Tax Number')}}: {{$lims_customer_data->tax_no}}
        </p>
        </div>
        </div>
        <table>
            <tbody>
                <?php $total_product_tax = 0;?>
                @foreach($lims_product_sale_data as $product_sale_data)
                <?php 
                    $lims_product_data = \App\Product::find($product_sale_data->product_id);
                    if($product_sale_data->variant_id) {
                        $variant_data = \App\Variant::find($product_sale_data->variant_id);
                        $product_name = $lims_product_data->name.' ['.$variant_data->name.']';
                    }
                    else
                        $product_name = $lims_product_data->name;
                ?>
                <tr style="background: #c0c0c045;">
                <td class="centered">Objet</td>
                <td class="centered">Details</td>
				<td class="centered">{{trans('file.Unit Price')}}</td>
                <td class="centered">Qté.</td>
                <td class="centered">{{trans('file.Order Tax')}}</td>
				<td  class="right" >Total HT</td>
                </tr>
                <tr>
                <td class="centered">{{$product_name}}</td>
                <td class="centered">{{$product_sale_data->sale_note}}</td>
                <td class="centered">{{number_format((float) ($product_sale_data->total / $product_sale_data->qty), 2, '.', '')}}</td>
                <td class="centered">{{$product_sale_data->qty}}</td>
                <td class="centered">{{number_format((float)$lims_sale_data->order_tax, 2, '.', '')}}</td>
            	<td class="right"  >{{number_format((float)$product_sale_data->total, 2, '.', '')}}</td>
                </tr>
                @endforeach
            </tbody>
            </table>
            <div class="row">
        <div class="col-6">
        <p></p>
        </div>
        <div class="col-6" style="background: #c0c0c045;padding-bottom: 50px;">
            <p class="right">Total HT : {{number_format((float)$lims_sale_data->order_tax, 2, '.', '')}}<br>
            TVA :  {{number_format((float)$lims_sale_data->order_tax, 2, '.', '')}}<br>
            TOTAL TTC : {{number_format((float)$lims_sale_data->grand_total, 2, '.', '')}}</p>
            <img  src="{{url('public/images/alphaboost.png')}}" style="height: 100px;width: 300px;" />

       </div>
       </div>
       <div 
       class="col-12 centered"
       style="position: fixed;
       bottom: 20px;
       width: 600px;">
       ALPHABOOST SARL
9, Rue Abou Maachar, Bureau N°11, Quartier Les Hôpitaux, 20360 Casablanca
Tél: +212 5 22 86 27 51 - Mail: contact@alphaboost.ma - Site: www.alphaboost.ma
ICE 002271601000067 - RC 435203 - IF 37528652 - TP 34100605
</div>
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
