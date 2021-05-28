@extends('layout.main') @section('content')
@if(session()->has('not_permitted'))
  <div class="relative px-3 py-3 mb-4 border rounded bg-red-200 border-red-300 text-red-800  text-center"><button type="button" class="absolute top-0 bottom-0 right-0 px-4 py-3" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>{{ session()->get('not_permitted') }}</div> 
@endif
<section class="forms">
    <div class="container mx-auto sm:px-4 max-w-full mx-auto sm:px-4">
        <div class="flex flex-wrap ">
            <div class="md:w-full pr-4 pl-4">
                <div class="relative flex flex-col min-w-0 rounded break-words border bg-white border-1 border-gray-300">
                    <div class="py-3 px-6 mb-0 bg-gray-200 border-b-1 border-gray-300 text-gray-900 flex items-center">
                        <h4>{{trans('file.Import Transfer')}}</h4>
                    </div>
                    <div class="flex-auto p-6">
                        <p class="italic"><small>{{trans('file.The field labels marked with * are required input fields')}}</small></p>
                        {!! Form::open(['route' => 'transfer.import', 'method' => 'post', 'files' => true, 'id' => 'transfer-form']) !!}
                        <div class="flex flex-wrap ">
                            <div class="md:w-full pr-4 pl-4">
                                <div class="flex flex-wrap ">
                                    <div class="md:w-1/3 pr-4 pl-4">
                                        <div class="mb-4">
                                            <label>{{trans('file.From Warehouse')}} *</label>
                                            <select required name="from_warehouse_id" class="selectpicker block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded" data-live-search="true" data-live-search-style="begins" title="Select warehouse...">
                                                @foreach($lims_warehouse_list as $warehouse)
                                                <option value="{{$warehouse->id}}">{{$warehouse->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="md:w-1/3 pr-4 pl-4">
                                        <div class="mb-4">
                                            <label>{{trans('file.To Warehouse')}} *</label>
                                            <select required name="to_warehouse_id" class="selectpicker block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded" data-live-search="true" data-live-search-style="begins" title="Select warehouse...">
                                                @foreach($lims_warehouse_list as $warehouse)
                                                <option value="{{$warehouse->id}}">{{$warehouse->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="md:w-1/3 pr-4 pl-4">
                                        <div class="mb-4">
                                            <label>{{trans('file.Status')}}</label>
                                            <select name="status" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded selectpicker">
                                                <option value="1">{{trans('file.Completed')}}</option>
                                                <option value="2">{{trans('file.Pending')}}</option>
                                                <option value="3">{{trans('file.Sent')}}</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex flex-wrap  mt-3">
                                    <div class="md:w-1/2 pr-4 pl-4">
                                        <div class="mb-4">
                                            <label>{{trans('file.Upload CSV File')}} *</label>
                                            <input type="file" name="file" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded" required />
                                            <p>{{trans('file.The correct column order is')}} (product_code, quantity, product_unit, product_cost, tax_name) {{trans('file.and you must follow this')}}. {{trans('file.All columns are required')}}</p>
                                        </div>
                                    </div>
                                    <div class="md:w-1/2 pr-4 pl-4">
                                        <div class="mb-4">
                                            <label></label><br>
                                            <a href="../public/sample_file/sample_transfer_products.csv" class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap rounded  no-underline bg-blue-600 text-white hover:bg-blue-600 block w-full py-3 px-4 leading-tight text-xl"><i class="dripicons-download"></i> {{trans('file.Download Sample File')}}</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex flex-wrap ">
                                    <div class="md:w-1/5 pr-4 pl-4">
                                        <div class="mb-4">
                                            <input type="hidden" name="total_qty" value="0" />
                                        </div>
                                    </div>
                                    <div class="md:w-1/5 pr-4 pl-4">
                                        <div class="mb-4">
                                            <input type="hidden" name="total_tax" value="0" />
                                        </div>
                                    </div>
                                    <div class="md:w-1/5 pr-4 pl-4">
                                        <div class="mb-4">
                                            <input type="hidden" name="total_cost" value="0" />
                                        </div>
                                    </div>
                                    <div class="md:w-1/5 pr-4 pl-4">
                                        <div class="mb-4">
                                            <input type="hidden" name="item" value="0" />
                                        </div>
                                    </div>
                                    <div class="md:w-1/5 pr-4 pl-4">
                                        <div class="mb-4">
                                            <input type="hidden" name="grand_total" value="0" />
                                        </div>
                                    </div>
                                </div>
                                <div class="flex flex-wrap  mt-3">
                                    <div class="md:w-1/3 pr-4 pl-4">
                                        <div class="mb-4">
                                            <label>
                                                <strong>{{trans('file.Shipping Cost')}}</strong>
                                            </label>
                                            <input type="number" name="shipping_cost" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded" />
                                        </div>
                                    </div>
                                    <div class="md:w-1/3 pr-4 pl-4">
                                        <div class="mb-4">
                                            <label>{{trans('file.Attach Document')}}</label>
                                            <i class="dripicons-question" data-toggle="tooltip" title="Only jpg, jpeg, png, gif, pdf, csv, docx, xlsx and txt file is supported"></i> 
                                            <input type="file" name="document" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded" />
                                            @if($errors->has('extension'))
                                                <span>
                                                   <strong>{{ $errors->first('extension') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="flex flex-wrap ">
                                    <div class="md:w-full pr-4 pl-4">
                                        <div class="mb-4">
                                            <label>{{trans('file.Note')}}</label>
                                            <textarea rows="5" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded" name="note"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-4">
                                    <input type="submit" value="{{trans('file.submit')}}" class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap rounded py-1 px-3 leading-normal no-underline bg-blue-600 text-white hover:bg-blue-600" id="submit-button">
                                </div>
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>    
</section>
<script type="text/javascript">
    $("ul#transfer").siblings('a').attr('aria-expanded','true');
    $("ul#transfer").addClass("show");
    $("ul#transfer #transfer-import-menu").addClass("active");
// array data depend on warehouse
var lims_product_array = [];
var product_code = [];
var product_name = [];
var product_qty = [];

// array data with selection
var product_cost = [];
var tax_rate = [];
var tax_name = [];
var tax_method = [];
var unit_name = [];
var unit_operator = [];
var unit_operation_value = [];

// temporary array
var temp_unit_name = [];
var temp_unit_operator = [];
var temp_unit_operation_value = [];

var rowindex;
var row_product_cost;

$('.selectpicker').selectpicker({
    style: 'btn-link',
});

$('[data-toggle="tooltip"]').tooltip();

$('#transfer-form').on('submit',function(e){
    if($('select[name="from_warehouse_id"]').val() == $('select[name="to_warehouse_id"]').val()){
        alert('Both Warehouse can not be same!');
        e.preventDefault();
    }
});
</script>
@endsection