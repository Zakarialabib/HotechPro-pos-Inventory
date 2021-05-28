@extends('layout.main') @section('content')

@if($errors->has('unit_code'))
<div class="relative px-3 py-3 mb-4 border rounded bg-red-200 border-red-300 text-red-800  text-center">
    <button type="button" class="absolute top-0 bottom-0 right-0 px-4 py-3" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>{{ $errors->first('unit_code') }}</div>
@endif
@if($errors->has('unit_name'))
<div class="relative px-3 py-3 mb-4 border rounded bg-red-200 border-red-300 text-red-800  text-center">
    <button type="button" class="absolute top-0 bottom-0 right-0 px-4 py-3" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>{{ $errors->first('unit_name') }}</div>
@endif
@if(session()->has('message'))
  <div class="relative px-3 py-3 mb-4 border rounded bg-green-200 border-green-300 text-green-800  text-center"><button type="button" class="absolute top-0 bottom-0 right-0 px-4 py-3" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>{{ session()->get('message') }}</div> 
@endif
@if(session()->has('not_permitted'))
  <div class="relative px-3 py-3 mb-4 border rounded bg-red-200 border-red-300 text-red-800  text-center"><button type="button" class="absolute top-0 bottom-0 right-0 px-4 py-3" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>{{ session()->get('not_permitted') }}</div> 
@endif

<section>
    <div class="container mx-auto sm:px-4 max-w-full mx-auto sm:px-4">
        <a href="#" data-toggle="modal" data-target="#createModal" class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap rounded py-1 px-3 leading-normal no-underline bg-teal-500 text-white hover:bg-teal-600"><i class="dripicons-plus"></i> {{trans('file.Add Unit')}}</a>&nbsp;
        <a href="#" data-toggle="modal" data-target="#importUnit" class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap rounded py-1 px-3 leading-normal no-underline bg-blue-600 text-white hover:bg-blue-600"><i class="dripicons-copy"></i> {{trans('file.Import Unit')}}</a>
    </div>
    <div class="block w-full overflow-auto scrolling-touch">
        <table id="unit-table" class="w-full max-w-full mb-4 bg-transparent">
            <thead>
                <tr>
                    <th class="not-exported"></th>
                    <th>{{trans('file.Code')}}</th>
                    <th>{{trans('file.name')}}</th>
                    <th>{{trans('file.Base Unit')}}</th>                 
                    <th>{{trans('file.Operator')}}</th>
                    <th>{{trans('file.Operation Value')}}</th>
                    <th class="not-exported">{{trans('file.action')}}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($lims_unit_all as $key=>$unit)
                <tr data-id="{{$unit->id}}">
                    <td>{{$key}}</td>
                    <td>{{ $unit->unit_code }}</td>
                    <td>{{ $unit->unit_name }}</td>
                    @if($unit->base_unit)
                        <?php $base_unit = DB::table('units')->where('id', $unit->base_unit)->first(); ?>
                        <td>{{ $base_unit->unit_name }}</td>
                    @else
                        <td>N/A</td>
                    @endif
                    @if($unit->operator)
                        <td>{{ $unit->operator }}</td>
                    @else
                        <td>N/A</td>
                    @endif
                    @if($unit->operation_value)
                        <td>{{ $unit->operation_value }}</td>
                    @else
                        <td>N/A</td>
                    @endif
                    <td>
                        <div class="relative inline-flex align-middle">
                            <button type="button" class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap rounded  no-underline btn-default py-1 px-2 leading-tight text-xs   inline-block w-0 h-0 ml-1 align border-b-0 border-t-1 border-r-1 border-l-1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{trans('file.action')}}
                                <span class="caret"></span>
                                <span class="sr-only">Toggle Dropdown</span>
                            </button>
                            <ul class=" absolute left-0 z-50 float-left hidden list-reset	 py-2 mt-1 text-base bg-white border border-gray-300 rounded edit-options dropdown-menu-right dropdown-default" user="menu">
                                <li>
                                    <button type="button" data-id="{{$unit->id}}" class="open-EditUnitDialog inline-block align-middle text-center select-none border font-normal whitespace-no-wrap rounded py-1 px-3 leading-normal no-underline font-normal text-blue-700 bg-transparent" data-toggle="modal" data-target="#editModal"><i class="dripicons-document-edit"></i> {{trans('file.edit')}}
                                </button>
                                </li>
                                <li class="divider"></li>
                                {{ Form::open(['route' => ['unit.destroy', $unit->id], 'method' => 'DELETE'] ) }}
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
        </table>
    </div>
</section>
<!-- Modal -->

<div id="createModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal opacity-0 text-left">
    <div role="document" class="modal-dialog">
        <div class="modal-content">
            {!! Form::open(['route' => 'unit.store', 'method' => 'post']) !!}
            <div class="modal-header">
                <h5 id="exampleModalLabel" class="modal-title">{{trans('file.Add Unit')}}</h5>
                <button type="button" data-dismiss="modal" aria-label="Close" class="absolute top-0 bottom-0 right-0 px-4 py-3"><span aria-hidden="true"><i class="dripicons-cross"></i></span></button>
            </div>
            <div class="modal-body">
                <p class="italic"><small>{{trans('file.The field labels marked with * are required input fields')}}.</small></p>
                <form>
                    <div class="mb-4">
                    <label>{{trans('file.Code')}} *</label>
                    {{Form::text('unit_code',null,array('required' => 'required', 'class' => 'form-control'))}}
                    </div>
                    <div class="mb-4">
                        <label>{{trans('file.name')}} *</label>
                        {{Form::text('unit_name',null,array('required' => 'required', 'class' => 'form-control'))}}
                    </div>
                    <div class="mb-4">
                        <label>{{trans('file.Base Unit')}}</label>
                        <select class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded selectpicker" id="base_unit_create" name="base_unit">
                            <option value="">No Base Unit</option>
                            @foreach($lims_unit_all as $unit)
                                @if($unit->base_unit==null)
                                <option value="{{$unit->id}}">{{$unit->unit_name}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-4 operator">
                        <label>{{trans('file.Operator')}}</label> <input type="text" name="operator" placeholder="Enter your Name" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded" />
                    </div>
                    <div class="mb-4 operation_value">
                        <label>{{trans('file.Operation Value')}}</label><input type="number" name="operation_value" placeholder="Enter operation value" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded" step="any"/>
                    </div>
                    <input type="submit" value="{{trans('file.submit')}}" class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap rounded py-1 px-3 leading-normal no-underline bg-blue-600 text-white hover:bg-blue-600">
            </form>
        </div>
        {{ Form::close() }}
    </div>
</div>
</div>

<div id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal opacity-0 text-left">
    <div role="document" class="modal-dialog">
      <div class="modal-content">
        {!! Form::open(['route' => ['unit.update',1], 'method' => 'put']) !!}
        <div class="modal-header">
          <h5 id="exampleModalLabel" class="modal-title"> {{trans('file.Update Unit')}}</h5>
          <button type="button" data-dismiss="modal" aria-label="Close" class="absolute top-0 bottom-0 right-0 px-4 py-3"><span aria-hidden="true"><i class="dripicons-cross"></i></span></button>
        </div>
        <div class="modal-body">
          <p class="italic"><small>{{trans('file.The field labels marked with * are required input fields')}}.</small></p>
            <form>
                <input type="hidden" name="unit_id">
                <div class="mb-4">
                <label>{{trans('file.Code')}} *</label>
                {{Form::text('unit_code',null,array('required' => 'required', 'class' => 'form-control'))}}
                </div>
                <div class="mb-4">
                    <label>{{trans('file.name')}} *</label>
                    {{Form::text('unit_name',null,array('required' => 'required', 'class' => 'form-control'))}}
                </div>
                <div class="mb-4">
                    <label>{{trans('file.Base Unit')}}</label>
                    <select class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded selectpicker" id="base_unit_edit" name="base_unit">
                        <option value="">No Base Unit</option>
                        @foreach($lims_unit_all as $unit)
                            @if($unit->base_unit==null)
                            <option value="{{$unit->id}}">{{$unit->unit_name}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <div class="mb-4 operator">
                    <label>{{trans('file.Operator')}}</label> <input type="text" name="operator" placeholder="Enter your Name" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded" />
                </div>
                <div class="mb-4 operation_value">
                    <label>{{trans('file.Operation Value')}}</label><input type="number" name="operation_value" placeholder="Enter operation value" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded" step="any"/>
                </div>
                <input type="submit" value="{{trans('file.submit')}}" class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap rounded py-1 px-3 leading-normal no-underline bg-blue-600 text-white hover:bg-blue-600">
            </form>
        </div>
        {{ Form::close() }}
      </div>
    </div>
</div>

<div id="importUnit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal opacity-0 text-left">
    <div role="document" class="modal-dialog">
      <div class="modal-content">
        {!! Form::open(['route' => 'unit.import', 'method' => 'post', 'files' => true]) !!}
        <div class="modal-header">
          <h5 id="exampleModalLabel" class="modal-title"> {{trans('file.Import Unit')}}</h5>
          <button type="button" data-dismiss="modal" aria-label="Close" class="absolute top-0 bottom-0 right-0 px-4 py-3"><span aria-hidden="true"><i class="dripicons-cross"></i></span></button>
        </div>
        <div class="modal-body">
            <p class="italic"><small>{{trans('file.The field labels marked with * are required input fields')}}.</small></p>
            <p>{{trans('file.The correct column order is')}} (unit_code*, unit_name*, base_unit [unit code], operator, operation_value) {{trans('file.and you must follow this')}}.</p>
            <div class="flex flex-wrap ">
                <div class="md:w-1/2 pr-4 pl-4">
                    <div class="mb-4">
                        <label>{{trans('file.Upload CSV File')}} *</label>
                        {{Form::file('file', array('class' => 'form-control','required'))}}
                    </div>
                </div>
                <div class="md:w-1/2 pr-4 pl-4">
                    <div class="mb-4">
                        <label> {{trans('file.Sample File')}}</label>
                        <a href="public/sample_file/sample_unit.csv" class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap rounded py-1 px-3 leading-normal no-underline bg-teal-500 text-white hover:bg-teal-600 block w-full btn-md"><i class="dripicons-download"></i>  {{trans('file.Download')}}</a>
                    </div>
                </div>
            </div>
            <input type="submit" value="{{trans('file.submit')}}" class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap rounded py-1 px-3 leading-normal no-underline bg-blue-600 text-white hover:bg-blue-600">
        </div>
        {{ Form::close() }}
      </div>
    </div>
</div>

<script type="text/javascript">
    $("ul#setting").siblings('a').attr('aria-expanded','true');
    $("ul#setting").addClass("show");
    $("ul#setting #unit-menu").addClass("active");

    var unit_id = [];
    var user_verified = <?php echo json_encode(env('USER_VERIFIED')) ?>;
    
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(".operator").hide();
    $(".operation_value").hide();
     function confirmDelete() {
        if (confirm("Are you sure want to delete?")) {
            return true;
        }
        return false;
    }
$(document).ready(function() {
    $('.open-EditUnitDialog').on('click', function() {
        var url = "unit/"
        var id = $(this).data('id').toString();
        url = url.concat(id).concat("/edit");

        $.get(url, function(data) {
            $("input[name='unit_code']").val(data['unit_code']);
            $("input[name='unit_name']").val(data['unit_name']);
            $("input[name='operator']").val(data['operator']);
            $("input[name='operation_value']").val(data['operation_value']);
            $("input[name='unit_id']").val(data['id']);
            $("#base_unit_edit").val(data['base_unit']);
            if(data['base_unit']!=null)
            {
                $(".operator").show();
                $(".operation_value").show();
            }
            else
            {
                $(".operator").hide();
                $(".operation_value").hide();
            }
            $('.selectpicker').selectpicker('refresh');

        });
    });

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $( "#select_all" ).on( "change", function() {
        if ($(this).is(':checked')) {
            $("tbody input[type='checkbox']").prop('checked', true);
        } 
        else {
            $("tbody input[type='checkbox']").prop('checked', false);
        }
    });

    $("#export").on("click", function(e){
        e.preventDefault();
        var unit = [];
        $(':checkbox:checked').each(function(i){
          unit[i] = $(this).val();
        });
        $.ajax({
           type:'POST',
           url:'/exportunit',
           data:{

                unitArray: unit
            },
           success:function(data){
            alert('Exported to CSV file successfully! Click Ok to download file');
            window.location.href = data;
           }
        });
    });

    $('.open-CreateUnitDialog').on('click', function() {
        $(".operator").hide();
        $(".operation_value").hide();
        
    });

    $('#base_unit_create').on('change', function() {
        if($(this).val()){
            $("#createModal .operator").show();
            $("#createModal .operation_value").show();
        }
        else{
            $("#createModal .operator").hide();
            $("#createModal .operation_value").hide();
        }
    });

    $('#base_unit_edit').on('change', function() {
        if($(this).val()){
            $("#editModal .operator").show();
            $("#editModal .operation_value").show();
        }
        else{
            $("#editModal .operator").hide();
            $("#editModal .operation_value").hide();
        }
    });
});

    $('#unit-table').DataTable( {
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
                        unit_id.length = 0;
                        $(':checkbox:checked').each(function(i){
                            if(i){
                                unit_id[i-1] = $(this).closest('tr').data('id');
                            }
                        });
                        if(unit_id.length && confirm("Are you sure want to delete?")) {
                            $.ajax({
                                type:'POST',
                                url:'unit/deletebyselection',
                                data:{
                                    unitIdArray: unit_id
                                },
                                success:function(data){
                                    alert(data);
                                }
                            });
                            dt.rows({ page: 'current', selected: true }).remove().draw(false);
                        }
                        else if(!unit_id.length)
                            alert('No unit is selected!');
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