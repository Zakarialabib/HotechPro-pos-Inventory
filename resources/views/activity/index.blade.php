@extends('layout.main') @section('content')
@if(session()->has('message'))
  <div class="alert alert-success alert-dismissible text-center"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>{!! session()->get('message') !!}</div> 
@endif
@if(session()->has('not_permitted'))
  <div class="alert alert-danger alert-dismissible text-center"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>{{ session()->get('not_permitted') }}</div> 
@endif

<section>
    <div class="container-fluid">
        <button class="btn btn-info" data-toggle="modal" data-target="#activity-modal"><i class="dripicons-plus"></i> {{trans('file.Add Activity')}} </button>
    </div>
    <div class="table-responsive">
        <table id="activity-table" class="table">
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
                        <td><div class="badge badge-success">{{trans('file.Not Paid')}}</div></td>
                    @else()
                        <td><div class="badge badge-danger">{{trans('file.Paid')}}</div></td>
                    @endif
                    <td>
                        <div class="btn-group">
                        <a class="btn btn-sm btn-primary btn-edit" href="{{ route('activity.show',$activity->id) }}"><i class="dripicons-expand"></i></a>
                        <button type="button" class="btn btn-sm btn-primary btn-edit" title="{{trans('file.edit')}}" data-id="{{$activity->id}}"  data-toggle="modal" data-target="#editModal"><i class="dripicons-document-edit"></i></button>
                            {{ Form::open(['route' => ['activity.destroy', $activity->id], 'method' => 'DELETE'] ) }}
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirmDelete()" title="{{trans('file.delete')}}"><i class="dripicons-trash"></i></button>
                            {{ Form::close() }}
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</section>





<div id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
    <div role="document" class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 id="exampleModalLabel" class="modal-title">{{trans('file.Update Activity')}}</h5>
                <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true"><i class="dripicons-cross"></i></span></button>
            </div>
            <div class="modal-body">
              <p class="italic"><small>{{trans('file.The field labels marked with * are required input fields')}}.</small></p>
                {!! Form::open(['route' => ['activity.update', 1], 'method' => 'put']) !!}
                <div class="row">
                <input type="hidden" name="activity_id">
                    <div class="col-md-12 form-group">
                        <label>{{trans('file.Status')}} *</label>
                        <select id="status" name="status" class="form-control" required>
                        <option value="1">{{trans('file.Not Paid')}}</option>
                        <option value="0">{{trans('file.Paid')}}</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">{{trans('file.submit')}}</button>
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
                text: '{{trans("file.Column visibility")}}',
                columns: ':gt(0)'
            },
        ],
    } );
</script>

@endsection