@extends('layout.main') @section('content')

@if(session()->has('message'))
  <div class="relative px-3 py-3 mb-4 border rounded bg-green-200 border-green-300 text-green-800  text-center"><button type="button" class="absolute top-0 bottom-0 right-0 px-4 py-3" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>{{ session()->get('message') }}</div> 
@endif

@if(session()->has('not_permitted'))
  <div class="relative px-3 py-3 mb-4 border rounded bg-red-200 border-red-300 text-red-800  text-center"><button type="button" class="absolute top-0 bottom-0 right-0 px-4 py-3" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>{{ session()->get('not_permitted') }}</div> 
@endif
<section class="forms">
    <div class="container mx-auto sm:px-4 max-w-full mx-auto sm:px-4">
        <div class="flex flex-wrap ">
            <div class="md:w-full pr-4 pl-4">
                <div class="relative flex flex-col min-w-0 rounded break-words border bg-white border-1 border-gray-300">
                    <div class="py-3 px-6 mb-0 bg-gray-200 border-b-1 border-gray-300 text-gray-900 flex items-center">
                        <h4>{{trans('file.POS Setting')}}</h4>
                    </div>
                    <div class="flex-auto p-6">
                        <p class="italic"><small>{{trans('file.The field labels marked with * are required input fields')}}.</small></p>
                        {!! Form::open(['route' => 'setting.posStore', 'method' => 'post']) !!}
                            <div class="flex flex-wrap ">
                                <div class="md:w-1/2 pr-4 pl-4">
                                    <div class="mb-4">
                                        <label>{{trans('file.Default Customer')}} *</label>
                                        @if($lims_pos_setting_data)
                                        <input type="hidden" name="customer_id_hidden" value="{{$lims_pos_setting_data->customer_id}}">
                                        @endif
                                        <select required name="customer_id" id="customer_id" class="selectpicker block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded" data-live-search="true" data-live-search-style="begins" title="Select customer...">
                                            @foreach($lims_customer_list as $customer)
                                            <option value="{{$customer->id}}">{{$customer->name . ' (' . $customer->phone_number . ')'}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-4">
                                        <label>{{trans('file.Default Biller')}} *</label>
                                        @if($lims_pos_setting_data)
                                        <input type="hidden" name="biller_id_hidden" value="{{$lims_pos_setting_data->biller_id}}">
                                        @endif
                                        <select required name="biller_id" class="selectpicker block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded" data-live-search="true" data-live-search-style="begins" title="Select Biller...">
                                            @foreach($lims_biller_list as $biller)
                                            <option value="{{$biller->id}}">{{$biller->name . ' (' . $biller->company_name . ')'}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-4">
                                        <label>Stripe Publishable key</label>
                                        <input type="text" name="stripe_public_key" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded" value="@if($lims_pos_setting_data){{$lims_pos_setting_data->stripe_public_key}}@endif" required />
                                    </div>
                                    <div class="mb-4">
                                        <label>Paypal Pro API Username</label>
                                        <input type="text" name="paypal_username" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded" value="{{env('PAYPAL_SANDBOX_API_USERNAME')}}" />
                                    </div>
                                    <div class="mb-4">
                                        <label>Paypal Pro API Signature</label>
                                        <input type="text" name="paypal_signature" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded" value="{{env('PAYPAL_SANDBOX_API_SECRET')}}" />
                                    </div>
                                    <div class="mb-4">
                                        <input type="submit" value="{{trans('file.submit')}}" class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap rounded py-1 px-3 leading-normal no-underline bg-blue-600 text-white hover:bg-blue-600">
                                    </div>
                                </div>
                                <div class="md:w-1/2 pr-4 pl-4">
                                    <div class="mb-4">
                                        <label>{{trans('file.Default Warehouse')}} *</label>
                                        @if($lims_pos_setting_data)
                                        <input type="hidden" name="warehouse_id_hidden" value="{{$lims_pos_setting_data->warehouse_id}}">
                                        @endif
                                        <select required name="warehouse_id" class="selectpicker block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded" data-live-search="true" data-live-search-style="begins" title="Select warehouse...">
                                            @foreach($lims_warehouse_list as $warehouse)
                                            <option value="{{$warehouse->id}}">{{$warehouse->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-4">
                                        <label>{{trans('file.Displayed Number of Product Row')}} *</label>
                                        <input type="number" name="product_number" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded" value="@if($lims_pos_setting_data){{$lims_pos_setting_data->product_number}}@endif" required />
                                    </div>
                                    <div class="mb-4">
                                        <label>Stripe Secret key *</label>
                                        <input type="text" name="stripe_secret_key" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded" value="@if($lims_pos_setting_data){{$lims_pos_setting_data->stripe_secret_key}}@endif"required />
                                    </div>
                                    <div class="mb-4">
                                        <label>Paypal Pro API Password</label>
                                        <input type="password" name="paypal_password" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded" value="{{env('PAYPAL_SANDBOX_API_PASSWORD')}}" />
                                    </div>
                                    <div class="mb-4">
                                        @if($lims_pos_setting_data && $lims_pos_setting_data->keybord_active)
                                        <input class="mt-2" type="checkbox" name="keybord_active" value="1" checked>
                                        @else
                                        <input class="mt-2" type="checkbox" name="keybord_active" value="1">
                                        @endif
                                        <label class="mt-2"><strong>{{trans('file.Touchscreen keybord')}}</label>
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

    $("ul#setting").siblings('a').attr('aria-expanded','true');
    $("ul#setting").addClass("show");
    $("ul#setting #pos-setting-menu").addClass("active");

    

    $('select[name="customer_id"]').val($("input[name='customer_id_hidden']").val());
    $('select[name="biller_id"]').val($("input[name='biller_id_hidden']").val());
    $('select[name="warehouse_id"]').val($("input[name='warehouse_id_hidden']").val());
    $('.selectpicker').selectpicker('refresh');

</script>
@endsection