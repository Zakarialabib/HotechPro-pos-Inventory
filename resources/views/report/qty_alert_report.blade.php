@extends('layout.main') @section('content')

<section class="forms">
    <div class="container-fluid">
        <div class="flex flex-wrap px-3 mx-auto">
            <div class="w-full mt-2">
                <div class="font-bold uppercase text-blue-600 float-left">
                    <h3>{{ trans('file.Product Quantity Alert') }} </h3>
                </div>
            </div>
        </div>
    </div>
    <div class="table-responsive mb-4">
        <table id="report-table" class="table table-hover">
            <thead>
                <tr>
                    <th class="not-exported"></th>
                    <th>{{trans('file.Image')}}</th>
                    <th>{{trans('file.Product Name')}}</th>
                    <th>{{trans('file.Product Code')}}</th>
                    <th>{{trans('file.Quantity')}}</th>
                    <th>{{trans('file.Alert Quantity')}}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($lims_product_data as $key=>$product)
                <tr>
                    <td>{{$key}}</td>
                    <td>
                    <?php
                        $images = explode(",", $product->image);
                        $product->base_image = $images[0];
                    ?> 
                        <img src="{{url('public/images/product',$product->base_image)}}" height="80" width="80">
                    </td>
                    <td>{{$product->name}}</td>
                    <td>{{$product->code}}</td>
                    <td>{{number_format((float)($product->qty), 2, '.', '')}}</td>
                    <td>{{number_format((float)($product->alert_quantity), 2, '.', '')}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</section>

<script type="text/javascript">
    $("ul#report").siblings('a').attr('aria-expanded','true');
    $("ul#report").addClass("show");
    $("ul#report #qtyAlert-report-menu").addClass("active");

    $('#report-table').DataTable( {
        "responsive": true,
        "order": [],
        'language': {
            'lengthMenu': '_MENU_ {{trans("file.records per page")}}',
             "info":      '<small>{{trans("file.Showing")}} _START_ - _END_ (_TOTAL_)</small>',
            "search":  '{{trans("file.Search")}}',
            'paginate': {
                    'previous': '<i class="dripicons-chevron-left"></i>',
                    'next': '<i class="dripicons-chevron-right"></i>'
            }
        },
        'columnDefs': [
            {
                "orderable": false,
                'targets': 0
            },
            {
                'render': function(data, type, row, meta){
                    if(type === 'display'){
                        data = '<div class="checkbox"><input type="checkbox" class="dt-checkboxes"><label></label></div>';
                    }

                   return data;
                },
                'checkboxes': {
                   'selectRow': true,
                   'selectAllRender': '<div class="checkbox"><input type="checkbox" class="dt-checkboxes"><label></label></div>'
                },
                'targets': [0]
            }
        ],
        'select': { style: 'multi',  selector: 'td:first-child'},
        'lengthMenu': [[10, 25, 50, -1], [10, 25, 50, "All"]],
        dom: '<"row"lfB>rtip',
        buttons: [
            {
                extend: 'pdfHtml5',
                text: '<i class="fa fa-file-pdf">',
                exportOptions: {
                    columns: ':visible:Not(.not-exported)',
                    rows: ':visible'
                },
            },
            {
                extend: 'excelHtml5',
                text: '<i class="fa fa-file-excel">',
                exportOptions: {
                    columns: ':visible:Not(.not-exported)',
                    rows: ':visible'
                },
            },
            {
                extend: 'print',
                text: '<i class="fa fa-print">',
                exportOptions: {
                    columns: ':visible:Not(.not-exported)',
                    rows: ':visible'
                },
            },
            {
                extend: 'colvis',
                text: '<i class="fa fa-eye">',
                columns: ':gt(0)'
            }
        ],
    } );

</script>
@endsection