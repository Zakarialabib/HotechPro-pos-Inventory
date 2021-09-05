@extends('layout.main') @section('content')

<section>
    <div class="flex flex-wrap px-3 mx-auto">
        <div class="w-full mt-2">
            <div class="brand-text float-left">
                <h3>{{trans('file.Balance Sheet')}}</h3>
            </div>
        </div>
    </div>
            <div class="flex flex-wrap px-3 mx-auto">
                <div class="w-full mt-2">
                <p>
                    {{trans('file.Credit')}} = {{trans('file.Payment Recieved')}} + {{trans('file.Return purchase')}} + {{trans('file.money recieved via transfer')}} + {{trans('file.Initial balance')}}
                </p>
                <p> 
                    {{trans('file.Debit')}} = {{trans('file.Payment Sent')}} + {{trans('file.Return')}} + {{trans('file.Expense')}} + {{trans('file.Payroll')}} + {{trans('file.money sent via transfer')}}
                </p>
                 </div>
            </div>
     
    <div class="table-responsive mb-4">
        <table id="account-table" class="table table-hover" style="width: 100%">
            <thead>
                <tr>
                    <th class="not-exported"></th>
                    <th>{{trans('file.name')}}</th>
                    <th>{{trans('file.Account No')}}</th>
                    <th>{{trans('file.Credit')}}</th>
                    <th>{{trans('file.Debit')}}</th>
                    <th>{{trans('file.Balance')}}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($lims_account_list as $key=>$account)
                <tr>
                    <td>{{$key}}</td>
                    <td>{{$account->name}}</td>
                    <td>{{$account->account_no}}</td>
                    <td>{{number_format((float)$credit[$key], 2, '.', '')}}</td>
                    <td>{{number_format((float)($debit[$key] * -1), 2, '.', '')}}</td>
                    <td>{{number_format((float)($credit[$key] - $debit[$key]), 2, '.', '')}}</td>
                </tr>
                @endforeach
            </tbody>
            <tfoot class="tfoot active">
                <th></th>
                <th>{{trans('file.Total')}}</th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
            </tfoot>
        </table>
    </div>
</section>

<script type="text/javascript">
    $("ul#account").siblings('a').attr('aria-expanded','true');
    $("ul#account").addClass("show");
    $("ul#account #balance-sheet-menu").addClass("active");
    var table = $('#account-table').DataTable( {
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
                action: function(e, dt, button, config) {
                    datatable_sum(dt, true);
                    $.fn.dataTable.ext.buttons.pdfHtml5.action.call(this, e, dt, button, config);
                    datatable_sum(dt, false);
                },
                footer:true
            },
            {
                extend: 'excelHtml5',
                text: '<i class="fa fa-file-excel">',
                exportOptions: {
                    columns: ':visible:Not(.not-exported)',
                    rows: ':visible'
                },
                action: function(e, dt, button, config) {
                    datatable_sum(dt, true);
                    $.fn.dataTable.ext.buttons.excelHtml5.action.call(this, e, dt, button, config);
                    datatable_sum(dt, false);
                },
                footer:true
            },
            {
                extend: 'print',
                text: '<i class="fa fa-print">',
                exportOptions: {
                    columns: ':visible:Not(.not-exported)',
                    rows: ':visible'
                },
                action: function(e, dt, button, config) {
                    datatable_sum(dt, true);
                    $.fn.dataTable.ext.buttons.print.action.call(this, e, dt, button, config);
                    datatable_sum(dt, false);
                },
                footer:true
            },
            {
                extend: 'colvis',
                text: '{{trans("file.Column visibility")}}',
                columns: ':gt(0)'
            },
        ],
        drawCallback: function () {
            var api = this.api();
            datatable_sum(api, false);
        }
    } );

    function datatable_sum(dt_selector, is_calling_first) {
        if (dt_selector.rows( '.selected' ).any() && is_calling_first) {
            var rows = dt_selector.rows( '.selected' ).indexes();

            $( dt_selector.column( 3 ).footer() ).html(dt_selector.cells( rows, 3, { page: 'current' } ).data().sum().toFixed(2));
            $( dt_selector.column( 4 ).footer() ).html(dt_selector.cells( rows, 4, { page: 'current' } ).data().sum().toFixed(2));
            $( dt_selector.column( 5 ).footer() ).html(dt_selector.cells( rows, 5, { page: 'current' } ).data().sum().toFixed(2));
        }
        else {
            $( dt_selector.column( 3 ).footer() ).html(dt_selector.cells( rows, 3, { page: 'current' } ).data().sum().toFixed(2));
            $( dt_selector.column( 4 ).footer() ).html(dt_selector.cells( rows, 4, { page: 'current' } ).data().sum().toFixed(2));
            $( dt_selector.column( 5 ).footer() ).html(dt_selector.cells( rows, 5, { page: 'current' } ).data().sum().toFixed(2));
        }
    }

</script>
@endsection