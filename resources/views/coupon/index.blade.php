@extends('layout.main') @section('content')
@if($errors->has('coupon_no'))
<div class="relative px-3 py-3 mb-4 border rounded bg-red-200 border-red-300 text-red-800  text-center">
    <button type="button" class="absolute top-0 bottom-0 right-0 px-4 py-3" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>{{ $errors->first('coupon_no') }}</div>
@endif
@if(session()->has('message'))
  <div class="relative px-3 py-3 mb-4 border rounded bg-green-200 border-green-300 text-green-800  text-center"><button type="button" class="absolute top-0 bottom-0 right-0 px-4 py-3" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>{!! session()->get('message') !!}</div> 
@endif
@if(session()->has('not_permitted'))
  <div class="relative px-3 py-3 mb-4 border rounded bg-red-200 border-red-300 text-red-800  text-center"><button type="button" class="absolute top-0 bottom-0 right-0 px-4 py-3" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>{{ session()->get('not_permitted') }}</div> 
@endif

<section>
    <div class="container mx-auto sm:px-4 max-w-full mx-auto sm:px-4">
        <button class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap rounded py-1 px-3 leading-normal no-underline bg-teal-500 text-white hover:bg-teal-600" data-toggle="modal" data-target="#create-modal"><i class="dripicons-plus"></i> {{trans('file.Add Coupon')}}</button>
    </div>
    <div class="block w-full overflow-auto scrolling-touch">
        <table id="coupon-table" class="w-full max-w-full mb-4 bg-transparent">
            <thead>
                <tr>
                    <th class="not-exported"></th>
                    <th>{{trans('file.Coupon Code')}}</th>
                    <th>{{trans('file.Type')}}</th>
                    <th>{{trans('file.Amount')}}</th>
                    <th>{{trans('file.Minimum Amount')}}</th>
                    <th>Qty</th>
                    <th>{{trans('file.Available')}}</th>
                    <th>{{trans('file.Expired Date')}}</th>
                    <th>{{trans('file.Created By')}}</th>
                    <th class="not-exported">{{trans('file.action')}}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($lims_coupon_all as $key=>$coupon)
                <?php 
                    $created_by = DB::table('users')->find($coupon->user_id);
                ?>
                <tr data-id="{{$coupon->id}}">
                    <td>{{$key}}</td>
                    <td>{{ $coupon->code }}</td>
                    @if($coupon->type == 'percentage')
                    <td><div class="inline-block p-1 text-center font-semibold text-sm align-baseline leading-none rounded bg-blue-500 text-white hover:bg-blue-600">{{$coupon->type}}</div></td>
                    @else
                    <td><div class="inline-block p-1 text-center font-semibold text-sm align-baseline leading-none rounded bg-teal-500 text-white hover:bg-teal-600">{{$coupon->type}}</div></td>
                    @endif
                    <td>{{ $coupon->amount }}</td>
                    @if($coupon->minimum_amount)
                    <td>{{ $coupon->minimum_amount }}</td>
                    @else
                    <td>N/A</td>
                    @endif
                    <td>{{ $coupon->quantity }}</td>
                    @if($coupon->quantity - $coupon->used)
                    <td class="text-center"><div class="inline-block p-1 text-center font-semibold text-sm align-baseline leading-none rounded bg-green-500 text-white hover:green-600">{{ $coupon->quantity - $coupon->used }}</div></td>
                    @else
                    <td class="text-center"><div class="inline-block p-1 text-center font-semibold text-sm align-baseline leading-none rounded bg-red-600 text-white hover:bg-red-700">{{ $coupon->quantity - $coupon->used }}</div></td>
                    @endif
                    @if($coupon->expired_date >= date("Y-m-d"))
                      <td><div class="inline-block p-1 text-center font-semibold text-sm align-baseline leading-none rounded bg-green-500 text-white hover:green-600">{{date('d-m-Y', strtotime($coupon->expired_date))}}</div></td>
                    @else
                      <td><div class="inline-block p-1 text-center font-semibold text-sm align-baseline leading-none rounded bg-red-600 text-white hover:bg-red-700">{{date('d-m-Y', strtotime($coupon->expired_date))}}</div></td>
                    @endif
                    <td>{{ $created_by->name }}</td>
                    <td>
                        <div class="relative inline-flex align-middle">
                            <button type="button" class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap rounded  no-underline btn-default py-1 px-2 leading-tight text-xs   inline-block w-0 h-0 ml-1 align border-b-0 border-t-1 border-r-1 border-l-1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{trans('file.action')}}
                                <span class="caret"></span>
                                <span class="sr-only">Toggle Dropdown</span>
                            </button>
                            <ul class=" absolute left-0 z-50 float-left hidden list-reset	 py-2 mt-1 text-base bg-white border border-gray-300 rounded edit-options dropdown-menu-right dropdown-default" user="menu">
                                <li><button type="button" data-id="{{$coupon->id}}" data-code="{{$coupon->code}}" data-type="{{$coupon->type}}" data-amount="{{$coupon->amount}}" data-minimum_amount="{{$coupon->minimum_amount}}" data-quantity="{{$coupon->quantity}}" data-expired_date="{{$coupon->expired_date}}" class="edit-btn inline-block align-middle text-center select-none border font-normal whitespace-no-wrap rounded py-1 px-3 leading-normal no-underline font-normal text-blue-700 bg-transparent" data-toggle="modal" data-target="#editModal"><i class="dripicons-document-edit"></i> {{trans('file.edit')}}</button></li>
                                {{ Form::open(['route' => ['coupons.destroy', $coupon->id], 'method' => 'DELETE'] ) }}
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
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
            </tfoot>
        </table>
    </div>
</section>

<div id="create-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal opacity-0 text-left">
    <div role="document" class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 id="exampleModalLabel" class="modal-title">{{trans('file.Add Coupon')}}</h5>
                <button type="button" data-dismiss="modal" aria-label="Close" class="absolute top-0 bottom-0 right-0 px-4 py-3"><span aria-hidden="true"><i class="dripicons-cross"></i></span></button>
            </div>
            <div class="modal-body">
              <p class="italic"><small>{{trans('file.The field labels marked with * are required input fields')}}.</small></p>
                {!! Form::open(['route' => 'coupons.store', 'method' => 'post']) !!}
                  <div class="flex flex-wrap ">
                      <div class="md:w-1/2 pr-4 pl-4 mb-4">
                          <label>{{trans('file.Coupon Code')}} *</label>
                          <div class="relative flex items-stretch w-full">
                              {{Form::text('code',null,array('required' => 'required', 'class' => 'form-control'))}}
                              <div class="input-group-append">
                                  <button type="button" class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap rounded  no-underline btn-default py-1 px-2 leading-tight text-xs  genbutton">{{trans('file.Generate')}}</button>
                              </div>
                          </div>
                      </div>
                      <div class="md:w-1/2 pr-4 pl-4 mb-4">
                          <label>{{trans('file.Type')}} *</label>
                          <select class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded" name="type">
                            <option value="percentage">Percentage</option>
                            <option value="fixed">Fixed Amount</option>
                          </select>
                      </div>
                      <div class="md:w-1/2 pr-4 pl-4 mb-4 minimum-amount">
                          <label>{{trans('file.Minimum Amount')}} *</label>
                          <input type="number" name="minimum_amount" step="any" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded">
                      </div>
                      <div class="md:w-1/2 pr-4 pl-4 mb-4">
                          <label>{{trans('file.Amount')}} *</label>
                          <div class="relative flex items-stretch w-full">
                              <input type="number" name="amount" step="any" required class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded">&nbsp;&nbsp;
                              <div class="input-group-append mt-1">
                                  <span class="icon-text" style="font-size: 22px;"><strong>%</strong></span>
                              </div>
                          </div>
                      </div>
                      <div class="md:w-1/2 pr-4 pl-4 mb-4">
                          <label>Qty *</label>
                          <input type="number" name="quantity" step="any" required class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded">
                      </div>
                      <div class="md:w-1/2 pr-4 pl-4 mb-4">
                          <label>{{trans('file.Expired Date')}}</label>
                          <input type="text" name="expired_date" class="expired_date block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded">
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

<div id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal opacity-0 text-left">
  <div role="document" class="modal-dialog">
      <div class="modal-content">
          <div class="modal-header">
              <h5 id="exampleModalLabel" class="modal-title">{{trans('file.Update Coupon')}}</h5>
              <button type="button" data-dismiss="modal" aria-label="Close" class="absolute top-0 bottom-0 right-0 px-4 py-3"><span aria-hidden="true"><i class="dripicons-cross"></i></span></button>
          </div>
          <div class="modal-body">
            <p class="italic"><small>{{trans('file.The field labels marked with * are required input fields')}}.</small></p>
              {!! Form::open(['route' => ['coupons.update', 1], 'method' => 'put']) !!}
              <div class="flex flex-wrap ">
                <div class="md:w-1/2 pr-4 pl-4 mb-4">
                    <label>{{trans('file.Coupon')}} {{trans('file.Code')}} *</label>
                    <div class="relative flex items-stretch w-full">
                        <input type="hidden" name="coupon_id">
                        {{Form::text('code',null,array('required' => 'required', 'class' => 'form-control'))}}
                        <div class="input-group-append">
                            <button type="button" class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap rounded  no-underline btn-default py-1 px-2 leading-tight text-xs  genbutton">{{trans('file.Generate')}}</button>
                        </div>
                    </div>
                </div>
                <div class="md:w-1/2 pr-4 pl-4 mb-4">
                    <label>{{trans('file.Type')}} *</label>
                    <select class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded" name="type">
                      <option value="percentage">Percentage</option>
                      <option value="fixed">Fixed Amount</option>
                    </select>
                </div>
                <div class="md:w-1/2 pr-4 pl-4 mb-4 minimum-amount">
                    <label>{{trans('file.Minimum Amount')}} *</label>
                    <input type="number" name="minimum_amount" step="any" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded">
                </div>
                <div class="md:w-1/2 pr-4 pl-4 mb-4">
                    <label>{{trans('file.Amount')}} *</label>
                    <div class="relative flex items-stretch w-full">
                        <input type="number" name="amount" step="any" required class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded">&nbsp;&nbsp;
                        <div class="input-group-append mt-1">
                            <span class="icon-text" style="font-size: 22px;"><strong>%</strong></span>
                        </div>
                    </div>
                </div>
                <div class="md:w-1/2 pr-4 pl-4 mb-4">
                    <label>Qty *</label>
                    <input type="number" name="quantity" step="any" required class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded">
                </div>
                <div class="md:w-1/2 pr-4 pl-4 mb-4">
                    <label>{{trans('file.Expired Date')}}</label>
                    <input type="text" name="expired_date" class="expired_date block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded">
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

    $("ul#sale").siblings('a').attr('aria-expanded','true');
    $("ul#sale").addClass("show");
    $("ul#sale #coupon-menu").addClass("active");

    var coupon_id = [];
    var user_verified = <?php echo json_encode(env('USER_VERIFIED')) ?>;
    
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $("#create-modal .expired_date").val($.datepicker.formatDate('yy-mm-dd', new Date()));
    $(".minimum-amount").hide();

    $("#create-modal select[name='type']").on("change", function() {
      if ($(this).val() == 'fixed') {
          $("#create-modal .minimum-amount").show();
          $("#create-modal .minimum-amount").prop('required',true);
          $("#create-modal .icon-text").text('$');
      } 
      else {
          $("#create-modal .minimum-amount").hide();
          $("#create-modal .minimum-amount").prop('required',false);
          $("#create-modal .icon-text").text('%');
      }
    });

    $("#editModal select[name='type']").on("change", function() {
      if ($(this).val() == 'fixed') {
          $("#editModal .minimum-amount").show();
          $("#editModal .minimum-amount").prop('required',true);
          $("#editModal .icon-text").text('$');
      } 
      else {
          $("#editModal .minimum-amount").hide();
          $("#editModal .minimum-amount").prop('required',false);
          $("#editModal .icon-text").text('%');
      }
    });

    $('#create-modal .genbutton').on("click", function(){
      $.get('coupons/gencode', function(data){
        $("input[name='code']").val(data);      
      });
    });

    $('#editModal .genbutton').on("click", function(){
      $.get('coupons/gencode', function(data){
        $("#editModal input[name='code']").val(data);
      });
    });

    $(document).ready(function() {
        $('.edit-btn').on('click', function() {
            $("#editModal input[name='code']").val($(this).data('code'));
            $("#editModal select[name='type']").val($(this).data('type'));
            $("#editModal input[name='amount']").val($(this).data('amount'));
            $("#editModal input[name='minimum_amount']").val($(this).data('minimum_amount'));
            $("#editModal input[name='quantity']").val($(this).data('quantity'));
            $("#editModal input[name='expired_date']").val($(this).data('expired_date'));
            $("#editModal input[name='coupon_id']").val($(this).data('id'));
            if($(this).data('type') == 'fixed'){
                $("#editModal .minimum-amount").show();
                $("#editModal .minimum-amount").prop('required',true);
                $("#editModal .icon-text").text('$');
            }
        });
    });

    var expired_date = $('.expired_date');
    expired_date.datepicker({
     format: "yyyy-mm-dd",
     startDate: "<?php echo date('Y-m-d'); ?>",
     autoclose: true,
     todayHighlight: true
     });

function confirmDelete() {
    if (confirm("Are you sure want to delete?")) {
        return true;
    }
    return false;
}

    var table = $('#coupon-table').DataTable( {
        responsive: true,
        fixedHeader: {
            header: true,
            footer: true
        },
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
                'targets': [0, 9]
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
                }
            },
            {
                extend: 'csv',
                text: '{{trans("file.CSV")}}',
                exportOptions: {
                    columns: ':visible:Not(.not-exported)',
                    rows: ':visible'
                }
            },
            {
                extend: 'print',
                text: '{{trans("file.Print")}}',
                exportOptions: {
                    columns: ':visible:Not(.not-exported)',
                    rows: ':visible'
                }
            },
            {
                text: '{{trans("file.delete")}}',
                className: 'buttons-delete',
                action: function ( e, dt, node, config ) {
                    if(user_verified == '1') {
                        coupon_id.length = 0;
                        $(':checkbox:checked').each(function(i){
                            if(i){
                                coupon_id[i-1] = $(this).closest('tr').data('id');
                            }
                        });
                        if(coupon_id.length && confirm("Are you sure want to delete?")) {
                            $.ajax({
                                type:'POST',
                                url:'coupons/deletebyselection',
                                data:{
                                    couponIdArray: coupon_id
                                },
                                success:function(data){
                                    alert(data);
                                }
                            });
                            dt.rows({ page: 'current', selected: true }).remove().draw(false);
                        }
                        else if(!coupon_id.length)
                            alert('No coupon is selected!');
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
        ]
    } );

</script>
@endsection