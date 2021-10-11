@extends('layout.main') @section('content')
@if(session()->has('message'))
  <div class="relative px-3 py-3 mb-4 border rounded bg-green-200 border-green-300 text-green-800  text-center"><button type="button" class="absolute top-0 bottom-0 right-0 px-4 py-3" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>{!! session()->get('message') !!}</div> 
@endif
@if(session()->has('not_permitted'))
  <div class="relative px-3 py-3 mb-4 border rounded bg-red-200 border-red-300 text-red-800  text-center"><button type="button" class="absolute top-0 bottom-0 right-0 px-4 py-3" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>{{ session()->get('not_permitted') }}</div> 
@endif

<section>
    <div class="flex flex-wrap px-3 mx-auto">
        <div class="w-full mt-2">
            <div class="font-bold uppercase text-blue-600 float-left">
                <h3>{{trans("file.Activity")}} </h3>
            </div>
            <div class="float-right">
                <button class="align-middle text-center select-none border font-normal whitespace-no-wrap rounded py-1 px-3 leading-normal no-underline bg-blue-600 text-white hover:bg-blue-600" data-toggle="modal" data-target="#activity-modal"><i class="dripicons-plus"></i> {{trans('file.Add Activity')}} </button>
            </div>
        </div>
      </div>
    <div class="table-responsive scrolling-touch">
        <table id="activity-table" class="table bg-white">
            <thead>
                <tr>
                    <th class="not-exported"></th>
                    <th>{{trans('file.Date')}}</th>
                    <th>{{trans('file.Employee')}}</th>
                    <th>{{trans('file.Hour')}}</th>
                    <th>{{trans('file.Place')}}</th>
                    <th>{{trans('file.Expense')}}</th>
                    <th>{{trans('file.Status')}}</th>
                    <th class="not-exported">{{trans('file.action')}}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($lims_activity_all as $key=>$activity)
                @php 
                    $employee = \App\Employee::find($activity->employee_id);
                    $customer = \App\Customer::find($activity->customer_id);
                    $user = \App\User::find($activity->user_id);
                @endphp
                <tr data-id="{{$activity->id}}">
                    <td>{{$key}}</td>
                    <td>{{ date($general_setting->date_format, strtotime($activity->date)) }}</td>
                    <td>{{ $employee->name }}</td>
                    <td>{{ $activity->hour }}</td>
                    <td>{{ $activity->place }}</td>
                    <td>{{$activity->expense}}</td>
                    @if($activity->status)
                        <td><div class="inline-block p-1 text-center font-semibold text-sm align-baseline leading-none rounded bg-green-500 text-white hover:green-600">{{trans('file.Not Paid')}}</div></td>
                    @else()
                        <td><div class="inline-block p-1 text-center font-semibold text-sm align-baseline leading-none rounded bg-red-600 text-white hover:bg-red-700">{{trans('file.Paid')}}</div></td>
                    @endif
                    <td>
                        <div class="relative inline-flex align-middle">
                        <a class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap rounded  no-underline py-1 px-2 leading-tight text-xs  bg-blue-600 text-white hover:bg-blue-600 btn-edit" href="{{ route('activity.show',$activity->id) }}"><i class="dripicons-expand"></i></a>
                        <button type="button" class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap rounded  no-underline py-1 px-2 leading-tight text-xs  bg-blue-600 text-white hover:bg-blue-600 btn-edit" title="{{trans('file.edit')}}" data-id="{{$activity->id}}"  data-toggle="modal" data-target="#editModal"><i class="dripicons-document-edit"></i></button>
                            {{ Form::open(['route' => ['activity.destroy', $activity->id], 'method' => 'DELETE'] ) }}
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





<div id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal opacity-0 text-left">
    <div role="document" class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 id="exampleModalLabel" class="modal-title">{{trans('file.Update Activity')}}</h5>
                <button type="button" data-dismiss="modal" aria-label="Close" class="absolute top-0 bottom-0 right-0 px-4 py-3"><span aria-hidden="true"><i class="dripicons-cross"></i></span></button>
            </div>
            <div class="modal-body">
              <p class="italic"><small>{{trans('file.The field labels marked with * are required input fields')}}.</small></p>
                {!! Form::open(['route' => ['activity.update', 1], 'method' => 'put']) !!}
                <div class="flex flex-wrap ">
                <input type="hidden" name="activity_id">
                    <div class="md:w-full pr-4 pl-4 mb-4">
                        <label>{{trans('file.Status')}} *</label>
                        <select id="status" name="status" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded" required>
                        <option value="1">{{trans('file.Not Paid')}}</option>
                        <option value="0">{{trans('file.Paid')}}</option>
                        </select>
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
$("ul#hrm #activity-menu").addClass("active");

var activity_id = [];
var user_verified = <?php echo json_encode(env('USER_VERIFIED')) ?>;

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

    $('.edit-btn').on('click', function() {
        $("#editModal select[name='status']").val( $(this).data('status') );
    });

    
    
	$(function() {
        $('#hour').timepicker();
    });
    
	var date = $('.date');
    date.datepicker({
        format: "dd-mm-yyyy",
        autoclose: true,
        todayHighlight: true
    });
    
    function confirmDelete() {
        if (confirm("Are you sure want to delete?")) {
            return true;
        }
        return false;
    }

    var table = $('#activity-table').DataTable( {
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
                'targets': [0, 7]
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
                    rows: ':visible',
                }
            },
            {
                extend: 'excelHtml5',
                text: '<i class="fa fa-file-excel">',
                exportOptions: {
                    columns: ':visible:Not(.not-exported)',
                    rows: ':visible',
                },
            },
            {
                extend: 'print',
                text: '<i class="fa fa-print">',
                exportOptions: {
                    columns: ':visible:Not(.not-exported)',
                    rows: ':visible',
                },
            },
            {
                text: '<i class="fa fa-trash">',
                className: 'buttons-delete',
                action: function ( e, dt, node, config ) {
                    if(user_verified == '1') {
                        activity_id.length = 0;
                        $(':checkbox:checked').each(function(i){
                            if(i){
                                activity_id[i-1] = $(this).closest('tr').data('id');
                            }
                        });
                        if(activity_id.length && confirm("Are you sure want to delete?")) {
                            $.ajax({
                                type:'POST',
                                url:'activity/deletebyselection',
                                data:{
                                    activityIdArray: activity_id
                                },
                                success:function(data){
                                    alert(data);
                                }
                            });
                            dt.rows({ page: 'current', selected: true }).remove().draw(false);
                        }
                        else if(!activity_id.length)
                            alert('Nothing is selected!');
                    }
                    else
                        alert('This feature is disable for demo!');
                }
            },
            {
                extend: 'colvis',
                text: '<i class="fa fa-eye">',
                columns: ':gt(0)'
            },
        ],
    } );
</script>

@endsection