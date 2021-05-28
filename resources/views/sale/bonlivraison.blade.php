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
            line-height: 35px;
            font-family: 'Ubuntu', sans-serif;
            text-transform: capitalize;
        }
        .body{
            background:#2E9AF9;
        }
        .body-invoice{
            background: white;
            max-width: 600px;
            margin: 0 auto;
            padding: 0px 20px 0px 10px;
            border-radius: 10px;
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
  padding: 50px 0 30px 0;
}
.col-12 {
  -webkit-box-flex: 0;
  -ms-flex: 0 0 100%;
  flex: 0 0 100%;
  max-width: 100%;
  justify-content: center;
display: grid;
}
.data-box{
border-radius:10px;
border:1px #00000029 solid;
}
        .btn-primary {
            background-color: #2E9AF9;
            color: #FFF;
            width: 100%;
            font-weight: 900;
        }
        td,
        th,
        tr,
        table {
            border-collapse: collapse;
            border: 1px dotted #ddd;
        }
        tr {border-bottom: 1px dotted #ddd;}
        td,th {padding: 7px 10px}

        table {width: 100%;}
        tfoot tr th:first-child {text-align: left;}

        .row {
            display:flex;
            text-align: center;
            align-content: center;
        }
        small{font-size:11px;}

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
  <body class="body">

<div class="body-invoice">
    @if(preg_match('~[0-9]~', url()->previous()))
        @php $url = '../../pos'; @endphp
    @else
        @php $url = url()->previous(); @endphp
    @endif
    <div class="hidden-print">
        <table class="print-back">
            <tr>
                <td><a href="{{$url}}" class="btn btn-info"><i class="fa fa-arrow-left"></i> {{trans('file.Back')}}</a> </td>
                <td><button onclick="window.print();" class="btn btn-primary"><i class="dripicons-print"></i> {{trans('file.Print')}}</button></td>
            </tr>
        </table>
        <br>
    </div>
    <div id="receipt-data">
            <div class="col-12">
            @if($general_setting->site_logo)
                <img src="{{url('public/logo', $general_setting->site_logo)}}" width="150">
            @endif
            </div>
     <div class="row">
        <div class="col-6">
            <div class="data-box">
                {{trans('file.Date')}}: {{$lims_sale_data->created_at->toDateString()}}<br>
                {{trans('file.Phone Number')}}: {{$lims_warehouse_data->phone}}<br>
                {{trans('file.Biller')}} {{$lims_biller_data->name}} : {{$lims_biller_data->phone_number}}
            </div>
        </div>
       <div class="col-6">
            <div class="data-box">
                        {{trans('file.reference')}}: {{$lims_sale_data->reference_no}}<br>
                        {{trans('file.customer')}}: {{$lims_customer_data->name}}
           </div>
       </div>
    </div> 
        </div> 
        <table>

            <tbody>
			         <tr style="background: #c0c0c045;">
                <td colspan="1">{{trans('file.Product Name')}}</td>
                <td colspan="2">{{trans('file.modify here 2')}}</td>
                <td colspan="1">{{trans('file.Quantity')}}</td>
                </tr>
                @foreach($lims_product_sale_data as $product_sale_data)
                @php 
                    $lims_product_data = \App\Product::find($product_sale_data->product_id);
                    if($product_sale_data->variant_id) {
                        $variant_data = \App\Variant::find($product_sale_data->variant_id);
                        $product_name = $lims_product_data->name.' ['.$variant_data->name.']';
                    }
                    else
                        $product_name = $lims_product_data->name;
                @endphp
                <tr>
                <td colspan="1">{{$product_name}}</td>
                <td colspan="2"></td>
                <td colspan="1">{{$product_sale_data->qty}} </td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                @if($lims_sale_data->shipping_cost)
             <th colspan="1"  style="text-align:left">{{trans('file.Shipping Cost')}} : {{number_format((float)$lims_sale_data->shipping_cost, 2, '.', '')}}</th>
				<td class="centered" colspan="2">{{trans('file.Total')}} : {{number_format((float)$lims_sale_data->grand_total, 2, '.', '')}} </td>
                <td class="centered" colspan="1"> {{number_format((float)$lims_sale_data->total_qty)}}</td>
                </tr>
                @endif
                <tr>
            </tfoot>
        </table>
     
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
