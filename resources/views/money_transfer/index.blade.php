@extends('layout.main') @section('content')
@if(session()->has('message'))
  <div class="relative px-3 py-3 mb-4 border rounded bg-green-200 border-green-300 text-green-800  text-center"><button type="button" class="absolute top-0 bottom-0 right-0 px-4 py-3" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>{{ session()->get('message') }}</div> 
@endif
@if(session()->has('not_permitted'))
  <div class="relative px-3 py-3 mb-4 border rounded bg-red-200 border-red-300 text-red-800  text-center"><button type="button" class="absolute top-0 bottom-0 right-0 px-4 py-3" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>{{ session()->get('not_permitted') }}</div> 
@endif

<section>
    <div class="container mx-auto sm:px-4 max-w-full mx-auto sm:px-4">
        <button class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap rounded py-1 px-3 leading-normal no-underline bg-teal-500 text-white hover:bg-teal-600" data-toggle="modal" data-target="#create-money-transfer-modal"><i class="dripicons-plus"></i> {{trans('file.Add Money Transfer')}}</button>
    </div>
    <div class="block w-full overflow-auto scrolling-touch">
        <table id="money-transfer-table" class="w-full max-w-full mb-4 bg-transparent">
            <thead>
                <tr>
                    <th class="not-exported"></th>
                    <th>{{trans('file.Date')}}</th>
                    <th>{{trans('file.Reference No')}}</th>
                    <th>{{trans('file.From Account')}}</th>
                    <th>{{trans('file.To Account')}}</th>
                    <th>{{trans('file.Amount')}}</th>
                    <th class="not-exported">{{trans('file.action')}}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($lims_money_transfer_all as $key=>$money_transfer)
                <tr data-id="{{$money_transfer->id}}">
                    <td>{{$key}}</td>
                    <td>{{date($general_setting->date_format, strtotime($money_transfer->created_at->toDateString())) . ' '. $money_transfer->created_at->toTimeString() }}</td>
                    <td>{{ $money_transfer->reference_no }}</td>
                    <td>{{ $money_transfer->fromAccount->name }}</td>
                    <td>{{ $money_transfer->toAccount->name }}</td>
                    <td>{{ number_format((float)$money_transfer->amount, 2, '.', '') }}</td>
                    <td>
                        <div class="relative inline-flex align-middle">
                            <button type="button" class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap rounded  no-underline btn-default py-1 px-2 leading-tight text-xs   inline-block w-0 h-0 ml-1 align border-b-0 border-t-1 border-r-1 border-l-1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{trans('file.action')}}
                                <span class="caret"></span>
                                <span class="sr-only">Toggle Dropdown</span>
                            </button>
                            <ul class=" absolute left-0 z-50 float-left hidden list-reset	 py-2 mt-1 text-base bg-white border border-gray-300 rounded edit-options dropdown-menu-right dropdown-default" user="menu">
                                <li><button type="button" id="edit-btn" data-id="{{$money_transfer->id}}" data-from_id="{{$money_transfer->from_account_id}}" data-to_id="{{$money_transfer->to_account_id}}" data-amount="{{$money_transfer->amount}}"  class=" inline-block align-middle text-center select-none border font-normal whitespace-no-wrap rounded py-1 px-3 leading-normal no-underline font-normal text-blue-700 bg-transparent" data-toggle="modal" data-target="#edit-money-transfer-modal"><i class="dripicons-document-edit"></i> {{trans('file.edit')}}</button></li>
                                <li class="divider"></li>
                                {{ Form::open(['route' => ['money-transfers.destroy', $money_transfer->id], 'method' => 'DELETE'] ) }}
                                <li>
                                    <button type="submit" class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap rounded py-1 px-3 leading-normal no-underline font-normal text-blue-700 bg-transparent" onclick="return confirmDelete()"><i class="dripicons-trash"></i> {{trans('file.delete')}}</button>
                                </li>
                                {{ Form::close() }}
                            </ul>
                        </div>
                    </td>
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
                <th></th>
            </tfoot>
        </table>
    </div>
</section>

<!-- Create Money Transfer modal -->
<div id="create-money-transfer-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal opacity-0 text-left">
    <div role="document" class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 id="exampleModalLabel" class="modal-title">{{trans('file.Add Money Transfer')}}</h5>
                <button type="button" data-dismiss="modal" aria-label="Close" class="absolute top-0 bottom-0 right-0 px-4 py-3"><span aria-hidden="true"><i class="dripicons-cross"></i></span></button>
            </div>
            <div class="modal-body">
              <p class="italic"><small>{{trans('file.The field labels marked with * are required input fields')}}.</small></p>
                {!! Form::open(['route' => 'money-transfers.store', 'method' => 'post']) !!}
                  <div class="flex flex-wrap ">
                      <div class="md:w-1/2 pr-4 pl-4 mb-4">
                          <label> {{trans('file.From Account')}} *</label>
                          <select class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded selectpicker" name="from_account_id" data-live-search="true" data-live-search-style="begins" title="Select from account..." required>
                          @foreach($lims_account_list as $account)
                              <option value="{{$account->id}}">{{$account->name}} [{{$account->account_no}}]</option>
                          @endforeach
                          </select>
                      </div>
                      <div class="md:w-1/2 pr-4 pl-4 mb-4">
                          <label> {{trans('file.To Account')}} *</label>
                          <select class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded selectpicker" name="to_account_id" data-live-search="true" data-live-search-style="begins" title="Select to account..." required>
                          @foreach($lims_account_list as $account)
                              <option value="{{$account->id}}">{{$account->name}} [{{$account->account_no}}]</option>
                          @endforeach
                          </select>
                      </div>
                      
                      <div class="md:w-1/2 pr-4 pl-4 mb-4">
                          <label>{{trans('file.Amount')}} *</label>
                          <input type="number" name="amount" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded" step="any" required>
                      </div>
                  </div>
                  <div class="mb-4">
                      <button type="submit" class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap rounded py-1 px-3 leading-normal no-underline bg-blue-600 text-white hover:bg-blue-600">{{trans('file.submit')}}</button>
                  </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>

<!-- Edit Money Transfer modal -->
<div id="edit-money-transfer-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal opacity-0 text-left">
    <div role="document" class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 id="exampleModalLabel" class="modal-title">{{trans('file.Update Money Transfer')}}</h5>
                <button type="button" data-dismiss="modal" aria-label="Close" class="absolute top-0 bottom-0 right-0 px-4 py-3"><span aria-hidden="true"><i class="dripicons-cross"></i></span></button>
            </div>
            <div class="modal-body">
                <p class="italic"><small>{{trans('file.The field labels marked with * are required input fields')}}.</small></p>
                {!! Form::open(['route' => ['money-transfers.update', 1], 'method' => 'put']) !!}
                  <div class="flex flex-wrap ">
                        <input type="hidden" name="id">
                      <div class="md:w-1/2 pr-4 pl-4 mb-4">
                          <label> {{trans('file.From Account')}} *</label>
                          <select class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded selectpicker" name="from_account_id" data-live-search="true" data-live-search-style="begins" title="Select from account..." required>
                          @foreach($lims_account_list as $account)
                              <option value="{{$account->id}}">{{$account->name}} [{{$account->account_no}}]</option>
                          @endforeach
                          </select>
                      </div>
                      <div class="md:w-1/2 pr-4 pl-4 mb-4">
                          <label> {{trans('file.To Account')}} *</label>
                          <select class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded selectpicker" name="to_account_id" data-live-search="true" data-live-search-style="begins" title="Select to account..." required>
                          @foreach($lims_account_list as $account)
                              <option value="{{$account->id}}">{{$account->name}} [{{$account->account_no}}]</option>
                          @endforeach
                          </select>
                      </div>
                      
                      <div class="md:w-1/2 pr-4 pl-4 mb-4">
                          <label>{{trans('file.Amount')}} *</label>
                          <input type="number" name="amount" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded" step="any" required>
                      </div>
                  </div>
                  <div class="mb-4">
                      <button type="submit" class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap rounded py-1 px-3 leading-normal no-underline bg-blue-600 text-white hover:bg-blue-600">{{trans('file.submit')}}</button>
                  </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">

    $("ul#account").siblings('a').attr('aria-expanded','true');
    $("ul#account").addClass("show");
    $("ul#account #money-transfer-menu").addClass("active");

    var money_transfer_id = [];
    var user_verified = <?php echo json_encode(env('USER_VERIFIED')) ?>;
    
    
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).ready(function() {
        $('#edit-btn').on('click', function() {
            $("#edit-money-transfer-modal select[name='from_account_id']").val($(this).data('from_id'));
            $("#edit-money-transfer-modal select[name='to_account_id']").val($(this).data('to_id'));
            $("#edit-money-transfer-modal input[name='id']").val($(this).data('id'));
            $("#edit-money-transfer-modal input[name='amount']").val($(this).data('amount'));
            $('.selectpicker').selectpicker('refresh');
        });
    })

function confirmDelete() {
    if (confirm("Are you sure want to delete?")) {
        return true;
    }
    return false;
}

    $('#money-transfer-table').DataTable( {
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
                'targets': [0, 6]
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
                extend: 'pdf',
                text: '{{trans("file.PDF")}}',
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
                extend: 'csv',
                text: '{{trans("file.CSV")}}',
                exportOptions: {
                    columns: ':visible:Not(.not-exported)',
                    rows: ':visible'
                },
                action: function(e, dt, button, config) {
                    datatable_sum(dt, true);
                    $.fn.dataTable.ext.buttons.csvHtml5.action.call(this, e, dt, button, config);
                    datatable_sum(dt, false);
                },
                footer:true
            },
            {
                extend: 'print',
                text: '{{trans("file.Print")}}',
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
                text: '{{trans("file.delete")}}',
                className: 'buttons-delete',
                action: function ( e, dt, node, config ) {
                    if(user_verified == '1') {
                        money_transfer_id.length = 0;
                        $(':checkbox:checked').each(function(i){
                            if(i){
                                money_transfer_id[i-1] = $(this).closest('tr').data('id');
                            }
                        });
                        if(money_transfer_id.length && confirm("Are you sure want to delete?")) {
                            $.ajax({
                                type:'POST',
                                url:'money_transfers/deletebyselection',
                                data:{
                                    money_transferIdArray: money_transfer_id
                                },
                                success:function(data){
                                    alert(data);
                                }
                            });
                            dt.rows({ page: 'current', selected: true }).remove().draw(false);
                        }
                        else if(!money_transfer_id.length)
                            alert('No money_transfer is selected!');
                    }
                    else
                        alert('This feature is disable for demo!');
                }
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
            $( dt_selector.column( 5 ).footer() ).html(dt_selector.cells( rows, 5, { page: 'current' } ).data().sum().toFixed(2));
        }
        else {
            $( dt_selector.column( 5 ).footer() ).html(dt_selector.cells( rows, 5, { page: 'current' } ).data().sum().toFixed(2));
        }
    }

    /*if(all_permission.indexOf("money_transfers-delete") == -1)
        $('.buttons-delete').addClass('d-none');*/

</script>
@endsection