@extends('layout.main') @section('content')
@if(session()->has('message'))
  <div class="relative px-3 py-3 mb-4 border rounded bg-green-200 border-green-300 text-green-800  text-center"><button type="button" class="absolute top-0 bottom-0 right-0 px-4 py-3" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>{!! session()->get('message') !!}</div> 
@endif
@if(session()->has('not_permitted'))
  <div class="relative px-3 py-3 mb-4 border rounded bg-red-200 border-red-300 text-red-800  text-center"><button type="button" class="absolute top-0 bottom-0 right-0 px-4 py-3" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>{{ session()->get('not_permitted') }}</div> 
@endif
<section>
    <div class="container mx-auto sm:px-4 max-w-full mx-auto sm:px-4">
        <button class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap rounded py-1 px-3 leading-normal no-underline bg-teal-500 text-white hover:bg-teal-600" data-toggle="modal" data-target="#createModal"><i class="dripicons-plus"></i> {{trans('file.Add Holiday')}} </button>
    </div>
    <div class="block w-full overflow-auto scrolling-touch">
        <table id="holiday-table" class="w-full max-w-full mb-4 bg-transparent">
            <thead>
                <tr>
                    <th class="not-exported"></th>
                    <th>{{trans('file.date')}}</th>
                    <th>{{trans('file.Employee')}}</th>
                    <th>{{trans('file.From')}}</th>
                    <th>{{trans('file.To')}}</th>
                    <th>{{trans('file.Note')}}</th>
                    <th class="not-exported">{{trans('file.action')}}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($lims_holiday_list as $key=>$holiday)
                <tr data-id="{{$holiday->id}}">
                    <td>{{$key}}</td>
                    <td>{{ date($general_setting->date_format, strtotime($holiday->created_at->toDateString())) }}</td>
                    <td>{{ $holiday->user->name }}</td>
                    <td>{{ date($general_setting->date_format, strtotime($holiday->from_date)) }}</td>
                    <td>{{ date($general_setting->date_format, strtotime($holiday->to_date)) }}</td>
                    <td>{{$holiday->note}}</td>
                    <td>
                        <div class="relative inline-flex align-middle">
                        	@if(!$holiday->is_approved && $approve_permission)
                        	<button type="button" class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap rounded  no-underline py-1 px-2 leading-tight text-xs  bg-green-500 text-white hover:bg-green-600 btn-approve" title="{{trans('file.Approve')}}" data-id="{{$holiday->id}}"><i class="fa fa-check"></i></button>
                        	@endif
                        	<button type="button" class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap rounded  no-underline py-1 px-2 leading-tight text-xs  bg-blue-600 text-white hover:bg-blue-600 btn-edit" title="{{trans('file.edit')}}" data-id="{{$holiday->id}}" data-from="{{date($general_setting->date_format, strtotime($holiday->from_date))}}" data-to="{{date($general_setting->date_format, strtotime($holiday->to_date))}}" data-note="{{$holiday->note}}" data-toggle="modal" data-target="#editModal"><i class="dripicons-document-edit"></i></button>
                            {{ Form::open(['route' => ['holidays.destroy', $holiday->id], 'method' => 'DELETE'] ) }}
                            <button type="submit" class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap rounded  no-underline py-1 px-2 leading-tight text-xs  bg-red-600 text-white hover:bg-red-700" onclick="return confirmDelete()" title="{{trans('file.delete')}}"><i class="dripicons-trash"></i></button>
                            {{ Form::close() }}
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</section>

<div id="createModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal opacity-0 text-left">
    <div role="document" class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 id="exampleModalLabel" class="modal-title">{{trans('file.Add Holiday')}}</h5>
                <button type="button" data-dismiss="modal" aria-label="Close" class="absolute top-0 bottom-0 right-0 px-4 py-3"><span aria-hidden="true"><i class="dripicons-cross"></i></span></button>
            </div>
            <div class="modal-body">
              <p class="italic"><small>{{trans('file.The field labels marked with * are required input fields')}}.</small></p>
                {!! Form::open(['route' => 'holidays.store', 'method' => 'post']) !!}
                <div class="flex flex-wrap ">
                    <div class="md:w-1/2 pr-4 pl-4 mb-4">
                        <label>{{trans('file.From')}} *</label>
                        <input type="text" name="from_date" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded date" value="{{date($general_setting->date_format)}}" required>
                    </div>
                    <div class="md:w-1/2 pr-4 pl-4 mb-4">
                        <label>{{trans('file.To')}} *</label>
                        <input type="text" name="to_date" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded date" value="{{date($general_setting->date_format)}}" required>
                    </div>
                    <div class="md:w-full pr-4 pl-4 mb-4">
                        <label>{{trans('file.Note')}}</label>
                        <textarea name="note" rows="3" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded"></textarea>
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
                <h5 id="exampleModalLabel" class="modal-title">{{trans('file.Update Holiday')}}</h5>
                <button type="button" data-dismiss="modal" aria-label="Close" class="absolute top-0 bottom-0 right-0 px-4 py-3"><span aria-hidden="true"><i class="dripicons-cross"></i></span></button>
            </div>
            <div class="modal-body">
              <p class="italic"><small>{{trans('file.The field labels marked with * are required input fields')}}.</small></p>
                {!! Form::open(['route' => ['holidays.update', 1], 'method' => 'put']) !!}
                <div class="flex flex-wrap ">
                    <div class="md:w-1/2 pr-4 pl-4 mb-4">
                        <label>{{trans('file.From')}} *</label>
                        <input type="hidden" name="id">
                        <input type="text" name="from_date" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded date" required>
                    </div>
                    <div class="md:w-1/2 pr-4 pl-4 mb-4">
                        <label>{{trans('file.To')}} *</label>
                        <input type="text" name="to_date" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded date" required>
                    </div>
                    <div class="md:w-full pr-4 pl-4 mb-4">
                        <label>{{trans('file.Note')}}</label>
                        <textarea name="note" rows="3" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded"></textarea>
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

	$("ul#hrm").siblings('a').attr('aria-expanded','true');
    $("ul#hrm").addClass("show");
    $("ul#hrm #holiday-menu").addClass("active");

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    function confirmDelete() {
        if (confirm("Are you sure want to delete?")) {
            return true;
        }
        return false;
    }

    var holiday_id = [];
    var user_verified = <?php echo json_encode(env('USER_VERIFIED')) ?>;
    
	var date = $('.date');
    date.datepicker({
     format: "dd-mm-yyyy",
     startDate: "<?php echo date('d-m-Y'); ?>",
     autoclose: true,
     todayHighlight: true
     });

    $('.btn-approve').on('click', function() {
	    var id = $(this).data('id');
	    $.get('approve-holiday/'+id, function(data) {
	        $('.btn-approve').addClass('d-none');
	    });
	});

    $('.btn-edit').on('click', function() {
        $("input[name='id']").val($(this).data('id'));
        $("input[name='from_date']").val($(this).data('from'));
        $("input[name='to_date']").val($(this).data('to'));
        $("textarea[name='note']").val($(this).data('note'));        
    });    

    $('#holiday-table').DataTable( {
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
                    rows: ':visible',
                }
            },
            {
                extend: 'csv',
                text: '{{trans("file.CSV")}}',
                exportOptions: {
                    columns: ':visible:Not(.not-exported)',
                    rows: ':visible',
                },
            },
            {
                extend: 'print',
                text: '{{trans("file.Print")}}',
                exportOptions: {
                    columns: ':visible:Not(.not-exported)',
                    rows: ':visible',
                },
            },
            {
                text: '{{trans("file.delete")}}',
                className: 'buttons-delete',
                action: function ( e, dt, node, config ) {
                    if(user_verified == '1') {
                        holiday_id.length = 0;
                        $(':checkbox:checked').each(function(i){
                            if(i){
                                holiday_id[i-1] = $(this).closest('tr').data('id');
                            }
                        });
                        if(holiday_id.length && confirm("Are you sure want to delete?")) {
                            $.ajax({
                                type:'POST',
                                url:'holidays/deletebyselection',
                                data:{
                                    holidayIdArray: holiday_id
                                },
                                success:function(data){
                                    alert(data);
                                }
                            });
                            dt.rows({ page: 'current', selected: true }).remove().draw(false);
                        }
                        else if(!holiday_id.length)
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