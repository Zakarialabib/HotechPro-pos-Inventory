@extends('layout.main') @section('content')
@if(session()->has('message'))
  <div class="alert alert-success alert-dismissible text-center"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>{!! session()->get('message') !!}</div> 
@endif
@if(session()->has('not_permitted'))
  <div class="alert alert-danger alert-dismissible text-center"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>{{ session()->get('not_permitted') }}</div> 
@endif

<section>
    <div class="flex flex-wrap px-3 mx-auto">
        <div class="w-full mt-2">
            <div class="brand-text float-left">
                <h3>{{trans("file.Message")}} </h3>
            </div>
            <div class="float-right">
            </div>
        </div>
      </div>
    <div class="table-responsive">
        <table id="message-table" class="table" style="width: 100%">
            <thead>
                <tr>
                    <th class="not-exported"></th>
                    <th>{{trans('file.Message Reference')}}</th>
                    <th>{{trans('file.Sale Reference')}}</th>
                    <th>{{trans('file.customer')}}</th>
                    <th>{{trans('file.Biller')}}</th>
                    <th>{{trans('file.Status')}}</th>
                    <th class="not-exported">{{trans('file.action')}}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($lims_message_all as $key=>$message)
                <?php 
                    $customer_sale = DB::table('sales')->join('customers', 'sales.customer_id', '=', 'customers.id')->where('sales.id', $message->sale_id)->select('sales.reference_no','customers.name')->get();
                    $biller_sale = DB::table('sales')->join('billers', 'sales.biller_id', '=', 'billers.id')->where('sales.id', $message->sale_id)->select('sales.reference_no','billers.name')->get();

                    if($message->status == 1)
                        $status = trans('file.Packing');
                    elseif($message->status == 2)
                        $status = trans('file.Delivering');
                    else
                        $status = trans('file.Delivered');
                    
                    $barcode = \DNS2D::getBarcodePNG($message->reference_no, 'QRCODE');
                ?>
                <tr class="message-link" data-barcode="{{$barcode}}" data-message='["{{date($general_setting->date_format, strtotime($message->created_at->toDateString()))}}", "{{$message->reference_no}}", "{{$message->sale->reference_no}}", "{{$status}}", "{{$message->id}}", "{{$message->sale->customer->name}}", "{{$message->sale->customer->phone_number}}", "{{$message->sale->customer->address}}", "{{$message->sale->customer->city}}", "{{$message->note}}", "{{$message->user->name}}"]'>
                    <td>{{$key}}</td>
                    <td>{{ $message->reference_no }}</td>
                    <td>{{ $customer_sale[0]->reference_no }}</td>
                    <td>{{ $customer_sale[0]->name }}</td>
                    <td>{{ $biller_sale[0]->name }}</td>
                    @if($message->status == 1)
                    <td><div class="badge badge-info">{{$status}}</div></td>
                    @elseif($message->status == 2)
                    <td><div class="badge badge-primary">{{$status}}</div></td>
                    @else
                    <td><div class="bg-green-600 text-white p-2 rounded  leading-none">{{$status}}</div></td>
                    @endif
                    <td>
                        <div class="btn-group">
                            <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{trans('file.action')}}
                              <span class="caret"></span>
                              <span class="sr-only">Toggle Dropdown</span>
                            </button>
                            <ul class="dropdown-menu edit-options dropdown-menu-right dropdown-default" user="menu">
                                <li>
                                    <button type="button" data-id="{{$message->id}}" class="open-EditCategoryDialog btn btn-link"><i class="dripicons-document-edit"></i> {{trans('file.edit')}}</button>
                                </li>
                                <li class="divider"></li>
                                {{ Form::open(['route' => ['message.delete', $message->id], 'method' => 'post'] ) }}
                                <li>
                                  <button type="submit" class="btn btn-link" onclick="return confirmDelete()"><i class="dripicons-trash"></i> {{trans('file.delete')}}</button> 
                                </li>
                                {{ Form::close() }}
                            </ul>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</section>

<!-- Modal -->
<div id="message-details" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
    <div role="document" class="modal-dialog">
      <div class="modal-content">
        <div class="container mt-3 pb-2 border-bottom">
            <div class="row">
                <div class="col-md-3">
                    <button id="print-btn" type="button" class="btn btn-default btn-sm d-print-none"><i class="dripicons-print"></i> {{trans('file.Print')}}</button>

                    {{ Form::open(['route' => 'message.sendMail', 'method' => 'post', 'class' => 'sendmail-form'] ) }}
                        <input type="hidden" name="message_id">
                        <button class="btn btn-default btn-sm d-print-none"><i class="dripicons-mail"></i> {{trans('file.Email')}}</button>
                    {{ Form::close() }}
                </div>
                <div class="col-md-6">
                    <h3 id="exampleModalLabel" class="modal-title text-center container-fluid">
                        <img src="{{url('public/logo', $general_setting->site_logo)}}" width="30">
                        {{$general_setting->site_title}}
                    </h3>
                </div>
                <div class="col-md-3">
                    <button type="button" id="close-btn" data-dismiss="modal" aria-label="Close" class="close d-print-none"><span aria-hidden="true"><i class="dripicons-cross"></i></span></button>
                </div>
                <div class="col-md-12 text-center">
                    <i style="font-size: 15px;">{{trans('file.Message Details')}}</i>
                </div>
            </div>
        </div>
        <div class="modal-body">
            <table class="table table-bordered" id="message-content">
                <tbody></tbody>
            </table>
            <br>
            <table class="table table-bordered product-message-list">
                <thead>
                    <th>No</th>
                    <th>Code</th>
                    <th>Description</th>
                    <th>Qty</th>
                </thead>
                <tbody>
                </tbody>
            </table>
            <div id="message-footer" class="row">
            </div>            
        </div>    
      </div>
    </div>
</div>

<div id="edit-message" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
    <div role="document" class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 id="exampleModalLabel" class="modal-title">{{trans('file.Update Message')}}</h5>
                <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true"><i class="dripicons-cross"></i></span></button>
            </div>
            <div class="modal-body">
                {!! Form::open(['route' => 'message.update', 'method' => 'post', 'files' => true]) !!}
                <div class="row">
                    <div class="col-md-6 form-group">
                        <label>{{trans('file.Message Reference')}}</label>
                        <p id="dr"></p>
                    </div>
                    <div class="col-md-6 form-group">
                        <label>{{trans('file.Sale Reference')}}</label>
                        <p id="sr"></p>
                    </div>
                    <div class="col-md-12 form-group">
                        <label>{{trans('file.Status')}} *</label>
                        <select name="status" required class="form-control selectpicker">
                            <option value="1">{{trans('file.Packing')}}</option>
                            <option value="2">{{trans('file.Delivering')}}</option>
                            <option value="3">{{trans('file.Delivered')}}</option>
                        </select>
                    </div>
                    <div class="col-md-6 form-group">
                        <label>{{trans('file.customer')}} *</label>
                        <p id="customer"></p>
                    </div>
                    <div class="col-md-6 form-group">
                        <label>{{trans('file.Attach File')}}</label>
                        <input type="file" name="file" class="form-control">
                    </div>
                    <div class="col-md-6 form-group">
                        <label>{{trans('file.Biller')}} *</label>
                        <select required name="biller_id" class="selectpicker form-control" data-live-search="true" data-live-search-style="begins" title="Select Biller...">
                            @foreach($lims_biller_list as $biller)
                            <option value="{{$biller->id}}">{{$biller->name . ' (' . $biller->company_name . ')'}}</option>
                            @endforeach
                        </select>                    
                    </div>
                    <div class="col-md-6 form-group">
                        <label>{{trans('file.Message')}}</label>
                        <textarea rows="3" name="message" class="form-control"></textarea>
                    </div>
                </div>
                <input type="hidden" name="reference_no">
                <input type="hidden" name="message_id">
                <button type="submit" class="btn btn-primary">{{trans('file.submit')}}</button>
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">

    $("ul#sale").siblings('a').attr('aria-expanded','true');
    $("ul#sale").addClass("show");
    $("ul#sale #message-menu").addClass("active");

    var message_id = [];
    var user_verified = <?php echo json_encode(env('USER_VERIFIED')) ?>;
    
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $("#print-btn").on("click", function(){
          var divToPrint=document.getElementById('message-details');
          var newWin=window.open('','Print-Window');
          newWin.document.open();
          newWin.document.write('<link rel="stylesheet" href="<?php echo asset('public/vendor/bootstrap/css/bootstrap.min.css') ?>" type="text/css"><style type="text/css">@media print {.modal-dialog { max-width: 1000px;} }</style><body onload="window.print()">'+divToPrint.innerHTML+'</body>');
          newWin.document.close();
          setTimeout(function(){newWin.close();},10);
    });

    function confirmDelete() {
      if (confirm("Are you sure want to delete?")) {
          return true;
      }
      return false;
    }

    $("tr.message-link td:not(:first-child, :last-child)").on("click", function() {
        var message = $(this).parent().data('message');
        var barcode = $(this).parent().data('barcode');
        messageDetails(message, barcode);
    });

    function messageDetails(message, barcode) {
        $('input[name="message_id"]').val(message[4]);
        $("#message-content tbody").remove();
        var newBody = $("<tbody>");
        var rows = '';
        rows += '<tr><td>Date</td><td>'+message[0]+'</td></tr>';
        rows += '<tr><td>Message Reference</td><td>'+message[1]+'</td></tr>';
        rows += '<tr><td>Sale Reference</td><td>'+message[2]+'</td></tr>';
        rows += '<tr><td>Status</td><td>'+message[3]+'</td></tr>';
        rows += '<tr><td>Customer Name</td><td>'+message[5]+'</td></tr>';
        rows += '<tr><td>Biller</td><td>'+message[7]+', '+message[8]+'</td></tr>';
        rows += '<tr><td>Phone Number</td><td>'+message[6]+'</td></tr>';
        rows += '<tr><td>Message</td><td>'+message[9]+'</td></tr>';

        newBody.append(rows);
        $("table#message-content").append(newBody);

        $.get('message/product_message/' + message[4], function(data) {
            $(".product-message-list tbody").remove();
            var code = data[0];
            var description = data[1];
            var qty = data[2];
            var newBody = $("<tbody>");
            $.each(code, function(index) {
                var newRow = $("<tr>");
                var cols = '';
                cols += '<td><strong>' + (index+1) + '</strong></td>';
                cols += '<td>' + code[index] + '</td>';
                cols += '<td>' + description[index] + '</td>';
                cols += '<td>' + qty[index] + '</td>';
                newRow.append(cols);
                newBody.append(newRow);
            });
            $("table.product-message-list").append(newBody);
        });

        var htmlfooter = '<div class="col-md-4 form-group"><p>Prepared By: '+message[10]+'</p></div>';
        htmlfooter += '<div class="col-md-4 form-group"><p>Delivered By: '+message[11]+'</p></div>';
        htmlfooter += '<div class="col-md-4 form-group"><p>Recieved By: '+message[12]+'</p></div>';
        htmlfooter += '<br><br><br><br>';
        htmlfooter += '<div class="col-md-2 offset-md-5"><img style="max-width:850px;height:100%;max-height:130px" src="data:image/png;base64,'+barcode+'" alt="barcode" /></div>';

        $('#message-footer').html(htmlfooter);
        $('#message-details').modal('show');
    }

    $(document).ready(function() {
        $('.open-EditCategoryDialog').on('click', function(){
          var url ="message/"  
          var id = $(this).data('id').toString();
          url = url.concat(id).concat("/edit");
          
          $.get(url, function(data){
                $('#dr').text(data[0]);
                $('#sr').text(data[1]);
                $('select[name="status"]').val(data[2]);
                $('.selectpicker').selectpicker('refresh');
                $('#customer').text(data[5]);
                $('textarea[name="address"]').val(data[6]);
                $('textarea[name="message"]').val(data[7]);
                $('input[name="reference_no"]').val(data[0]);
                $('input[name="message_id"]').val(id);
          });
          $("#edit-message").modal('show');
        });
    });

    $('#message-table').DataTable( {
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
                text: '<i class="fa fa-trash">',
                className: 'buttons-delete',
                action: function ( e, dt, node, config ) {
                    if(user_verified == '1') {
                        message_id.length = 0;
                        $(':checkbox:checked').each(function(i){
                            if(i){
                                message_id[i-1] = $(this).closest('tr').data('id');
                            }
                        });
                        if(message_id.length && confirm("Are you sure want to delete?")) {
                            $.ajax({
                                type:'POST',
                                url:'message/deletebyselection',
                                data:{
                                    messageIdArray: message_id
                                },
                                success:function(data){
                                    alert(data);
                                }
                            });
                            dt.rows({ page: 'current', selected: true }).remove().draw(false);
                        }
                        else if(!message_id.length)
                            alert('Nothing is selected!');
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
    } );
</script>
@endsection