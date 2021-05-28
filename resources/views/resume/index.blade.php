@extends('layout.main')
@section('content')
@if($errors->has('name'))
<div class="alert alert-danger alert-dismissible text-center">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>{{ $errors->first('name') }}</div>
@endif
@if(session()->has('message'))
  <div class="alert alert-success alert-dismissible text-center"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>{{ session()->get('message') }}</div> 
@endif
@if(session()->has('not_permitted'))
  <div class="alert alert-danger alert-dismissible text-center"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>{{ session()->get('not_permitted') }}</div> 
@endif

<section>
    <div class="container-fluid">
        <a href="#" data-toggle="modal" data-target="#createModal" class="btn btn-info"><i class="dripicons-plus"></i> {{trans('file.Add Resume')}}</a>
    </div>
    <div class="table-responsive">
        <table id="resume-table" class="table">
            <thead>
                <tr>
                    <th class="not-exported"></th>
                    <th>{{trans('file.Employee')}}</th>
                    <th>{{trans('file.Date')}}</th>
                    <th>{{trans('file.Object')}}</th>
                    <th>{{trans('file.customer')}}</th>
                    <th>{{trans('file.Next Action')}}</th>
                    <th class="not-exported">{{trans('file.action')}}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($lims_resume_all as $key=>$resume)
                @php 
                    $employee = \App\Employee::find($resume->employee_id);
                    $customer = \App\Customer::find($resume->customer_id);
                    $user = \App\User::find($resume->user_id);
                @endphp
                <tr data-id="{{$resume->id}}">
                    <td>{{$key}}</td>
                    <td>{{ $employee->name }}</td>
                    <td>{{ $resume->date }}</td>
                    <td>{{ $resume->object}}</td>
                    <td>{{ $customer->name}}</td>
                    <td>{{ $resume->action}}</td>
                    <td>
                        <div class="btn-group">
                            <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{trans('file.action')}}
                                <span class="caret"></span>
                                <span class="sr-only">Toggle Dropdown</span>
                            </button>
                            <ul class="dropdown-menu edit-options dropdown-menu-right dropdown-default" user="menu">
                            <li>
                            <a class="btn btn-link" href="{{ route('resume.show',$resume->id) }}"><i class="dripicons-expand"></i> {{trans('file.Show')}}</a>
                            </li>
                            <li class="divider"></li>
                                <li>
                                    <button type="button" data-id="{{$resume->id}}" class="open-EditResumeDialog btn btn-link" data-toggle="modal" data-target="#editModal"><i class="dripicons-document-edit"></i> {{trans('file.edit')}}
                                    </button>
                                </li>
                                <li class="divider"></li>
                                {{ Form::open(['route' => ['resume.destroy', $resume->id], 'method' => 'DELETE'] ) }}
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

<div id="createModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
<div role="document" class="modal-dialog">
  <div class="modal-content">
    {!! Form::open(['route' => 'resume.store', 'method' => 'post']) !!}
    <div class="modal-header">
      <h5 id="exampleModalLabel" class="modal-title">{{trans('file.Add Resume')}}</h5>
      <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true"><i class="dripicons-cross"></i></span></button>
    </div>
    <div class="modal-body">
      <p class="italic"><small>{{trans('file.The field labels marked with * are required input fields')}}.</small></p>
      <form>
      <div class="row">
      <div class="col-md-6 form-group">
                  <label>{{trans('file.Employee')}} *</label>
                  <select class="form-control selectpicker" name="employee_id[]" required data-live-search="true" data-live-search-style="begins" title="Selecti..." multiple>
                      @foreach($lims_employee_list as $employee)
                      <option value="{{$employee->id}}">{{$employee->name}}</option>
                      @endforeach
                  </select>
              </div>
      <div class="col-md-6 form-group">
                <label>{{trans('file.customer')}} *</label>
                <select class="form-control selectpicker" name="customer_id[]" required data-live-search="true" data-live-search-style="begins" title="Selecti..." multiple>
                    @foreach($lims_customer_list as $customer)
                    <option value="{{$customer->id}}">{{$customer->name}}</option>
                    @endforeach
                </select>
            </div>
         
        <div class="col-md-6 form-group">
          <label>{{trans('file.date')}} *</label>
          <input type="date" name="date" required="required" class="form-control">
        </div>
        <div class="col-md-6 form-group">       
          <label>{{trans('file.Object')}}</label>
          <select id="object" name="object" class="form-control" required>
        <option value="Prospection">Prospection</option>
        <option value="Contrat">Contrat</option>
        <option value="Gestion">Gestion</option>
         </select>
        </div>  
        <div class="col-md-12 form-group">       
          <label>{{trans('file.Next Action')}}</label>
          <input type="text" name="action" required="required" class="form-control">
        </div>            
        <div class="col-md-12 form-group">       
          <label>{{trans('file.Resume')}}</label>
          <textarea name="note" rows="3" required="required" class="form-control"></textarea>
        </div>                          
        <div class="form-group">       
          <input type="submit" value="{{trans('file.submit')}}" class="btn btn-primary">
        </div>
        </div>
      </form>
    </div>

    {{ Form::close() }}
  </div>
</div>
</div>

<div id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
<div role="document" class="modal-dialog">
  <div class="modal-content">
    {!! Form::open(['route' => ['resume.update',1], 'method' => 'put']) !!}
    <div class="modal-header">
      <h5 id="exampleModalLabel" class="modal-title">{{trans('file.Update Resume')}}</h5>
      <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true"><i class="dripicons-cross"></i></span></button>
    </div>
    <div class="modal-body">
      <p class="italic"><small>{{trans('file.The field labels marked with * are required input fields')}}.</small></p>
      <div class="row">
      <div class="col-md-6 form-group">
      <input type="hidden" name="resume_id">
          <label>{{trans('file.date')}} *</label>
          <input type="date" name="date" required="required" class="form-control">
        </div>
        <div class="col-md-6 form-group">       
          <label>{{trans('file.object')}}</label>
          <select id="object" name="object" class="form-control" required>
        <option value="Prospection">Prospection</option>
        <option value="Contrat">Contrat</option>
        <option value="Gestion">Gestion</option>
         </select>        </div>  
        <div class="col-md-12 form-group">       
          <label>{{trans('file.Next Action')}}</label>
          <input type="text" name="action" required="required" class="form-control">
        </div>            
        <div class="col-md-12 form-group">       
          <label>{{trans('file.Resume')}}</label>
          <textarea name="note" rows="4" class="form-control" required="required"></textarea>
        </div>          
        <div class="form-group">       
          <input type="submit" value="{{trans('file.submit')}}" class="btn btn-primary">
        </div>
    </div>
    </div>
    {{ Form::close() }}
  </div>
</div>
</div>


<script type="text/javascript">
    $("ul#hrm").siblings('a').attr('aria-expanded','true');
    $("ul#hrm").addClass("show");
    $("ul#hrm #resume-menu").addClass("active");

    
    function confirmDelete() {
      if (confirm("Are you sure want to delete?")) {
          return true;
      }
      return false;
  }

    var resume_id = [];
    var user_verified = <?php echo json_encode(env('USER_VERIFIED')) ?>;
    
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    var date = $('.date');
    date.datepicker({
     format: "dd-mm-yyyy",
     autoclose: true,
     todayHighlight: true
     });


    $(document).ready(function() {
        
        $('.open-EditResumeDialog').on('click', function() {
            var url = "resume/"
            var id = $(this).data('id').toString();
            url = url.concat(id).concat("/edit");

            $.get(url, function(data) {
                $("input[name='date']").val(data['date']);
                $("select[name='employee_id']").val(data['employee_id']);
                $("input[name='object']").val(data['object']);
                $("input[name='action']").val(data['action']);
                $("input[name='note']").val(data['note']);
                $("input[name='resume_id']").val(data['id']);
            });
        });
    });

    var table = $('#resume-table').DataTable( {
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
                'targets': [0, 3]
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
            },
            {
                extend: 'csv',
                text: '{{trans("file.CSV")}}',
                exportOptions: {
                    columns: ':visible:Not(.not-exported)',
                    rows: ':visible'
                },
            },
            {
                extend: 'print',
                text: '{{trans("file.Print")}}',
                exportOptions: {
                    columns: ':visible:Not(.not-exported)',
                    rows: ':visible'
                },
            },
            {
                text: '{{trans("file.delete")}}',
                className: 'buttons-delete',
                action: function ( e, dt, node, config ) {
                    if(user_verified == '1') {
                        resume_id.length = 0;
                        $(':checkbox:checked').each(function(i){
                            if(i){
                                resume_id[i-1] = $(this).closest('tr').data('id');
                            }
                        });
                        if(resume_id.length && confirm("Are you sure want to delete?")) {
                            $.ajax({
                                type:'POST',
                                url:'resume/deletebyselection',
                                data:{
                                    resumeIdArray: resume_id
                                },
                                success:function(data){
                                    alert(data);
                                }
                            });
                            dt.rows({ page: 'current', selected: true }).remove().draw(false);
                        }
                        else if(!resume_id.length)
                            alert('No resume is selected!');
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