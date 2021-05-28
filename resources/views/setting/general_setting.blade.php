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
                        <h4>{{trans('file.General Setting')}}</h4>
                    </div>
                    <div class="flex-auto p-6">
                        <p class="italic"><small>{{trans('file.The field labels marked with * are required input fields')}}.</small></p>
                        {!! Form::open(['route' => 'setting.generalStore', 'files' => true, 'method' => 'post']) !!}
                            <div class="flex flex-wrap ">
                                <div class="md:w-1/2 pr-4 pl-4">
                                    <div class="mb-4">
                                        <label>{{trans('file.System Title')}} *</label>
                                        <input type="text" name="site_title" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded" value="@if($lims_general_setting_data){{$lims_general_setting_data->site_title}}@endif" required />
                                    </div>
                                </div>
                                <div class="md:w-1/2 pr-4 pl-4">
                                    <div class="mb-4">
                                        <label>{{trans('file.System Logo')}} *</label>
                                        <input type="file" name="site_logo" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded" value=""/>
                                    </div>
                                    @if($errors->has('site_logo'))
                                   <span>
                                       <strong>{{ $errors->first('site_logo') }}</strong>
                                    </span>
                                    @endif
                                </div>

                                <div class="md:w-1/2 pr-4 pl-4">
                                <div class="mb-4">
                                    <label>{{trans('file.VAT Number')}}</label>
                                    <input type="text" name="vat_number" value="{{$lims_general_setting_data->vat_number}}" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded">
                                </div>
                            </div>
                            <div class="md:w-1/2 pr-4 pl-4">
                                <div class="mb-4">
                                    <label>{{trans('file.Email')}} *</label>
                                    <input type="email" name="email" value="{{$lims_general_setting_data->email}}" required class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded">
                                </div>
                            </div>
                            <div class="md:w-1/2 pr-4 pl-4">
                                <div class="mb-4">
                                    <label>{{trans('file.Phone Number')}} *</label>
                                    <input type="text" name="phone_number" value="{{$lims_general_setting_data->phone_number}}" required class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded">
                                </div>
                            </div>

                                <div class="md:w-1/2 pr-4 pl-4">
                                    <div class="mb-4">
                                        <label>{{trans('file.Currency')}} *</label>
                                        <select name="currency" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded" required>
                                            @foreach($lims_currency_list as $key => $currency)
                                                @if($lims_general_setting_data->currency == $currency->id)
                                                    <option value="{{$currency->id}}" selected>{{$currency->name}}</option>
                                                @else
                                                    <option value="{{$currency->id}}">{{$currency->name}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="md:w-1/2 pr-4 pl-4">
                                    <div class="mb-4">
                                        <label>{{trans('file.Currency Position')}} *</label><br>
                                        @if($lims_general_setting_data->currency_position == 'prefix')
                                        <label class="radio-inline">
                                            <input type="radio" name="currency_position" value="prefix" checked> {{trans('file.Prefix')}}
                                        </label>
                                        <label class="radio-inline">
                                          <input type="radio" name="currency_position" value="suffix"> {{trans('file.Suffix')}}
                                        </label>
                                        @else
                                        <label class="radio-inline">
                                            <input type="radio" name="currency_position" value="prefix"> {{trans('file.Prefix')}}
                                        </label>
                                        <label class="radio-inline">
                                          <input type="radio" name="currency_position" value="suffix" checked> {{trans('file.Suffix')}}
                                        </label>
                                        @endif
                                    </div>
                                </div>
                                <div class="md:w-1/2 pr-4 pl-4">
                                    <div class="mb-4">
                                        <label>{{trans('file.Time Zone')}}</label>
                                        @if($lims_general_setting_data)
                                        <input type="hidden" name="timezone_hidden" value="{{env('APP_TIMEZONE')}}">
                                        @endif
                                        <select name="timezone" class="selectpicker block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded" data-live-search="true" title="Select TimeZone...">
                                            @foreach($zones_array as $zone)
                                            <option value="{{$zone['zone']}}">{{$zone['diff_from_GMT'] . ' - ' . $zone['zone']}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="md:w-1/2 pr-4 pl-4 hidden">
                                    <div class="mb-4">
                                        <label>{{trans('file.Theme')}} *</label>
                                        <div class="flex flex-wrap  ml-1">
                                            <div class="md:w-1/4 pr-4 pl-4 theme-option" data-color="default.css" style="background: #7c5cc4; min-height: 40px; max-width: 50px;" title="Purple"></div>&nbsp;&nbsp;
                                            <div class="md:w-1/4 pr-4 pl-4 theme-option" data-color="green.css" style="background: #1abc9c; min-height: 40px;max-width: 50px;" title="Green"></div>&nbsp;&nbsp;
                                            <div class="md:w-1/4 pr-4 pl-4 theme-option" data-color="blue.css" style="background: #3498db; min-height: 40px;max-width: 50px;" title="Blue"></div>&nbsp;&nbsp;
                                            <div class="md:w-1/4 pr-4 pl-4 theme-option" data-color="dark.css" style="background: #34495e; min-height: 40px;max-width: 50px;" title="Dark"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="md:w-1/2 pr-4 pl-4">
                                    <div class="mb-4">
                                        <label>{{trans('file.Staff Access')}} *</label>
                                        @if($lims_general_setting_data)
                                        <input type="hidden" name="staff_access_hidden" value="{{$lims_general_setting_data->staff_access}}">
                                        @endif
                                        <select name="staff_access" class="selectpicker block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded">
                                            <option value="all"> {{trans('file.All Records')}}</option>
                                            <option value="own"> {{trans('file.Own Records')}}</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="md:w-1/2 pr-4 pl-4">
                                    <div class="mb-4">
                                        <label>{{trans('file.Invoice Format')}} *</label>
                                        @if($lims_general_setting_data)
                                        <input type="hidden" name="invoice_format_hidden" value="{{$lims_general_setting_data->invoice_format}}">
                                        @endif
                                        <select name="invoice_format" class="selectpicker block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded" required>
                                            <option value="standard">Standard</option>
                                        </select>
                                    </div>
                                </div>
                                <div id="state" class="md:w-1/2 pr-4 pl-4 hidden">
                                    <div class="mb-4">
                                        <label>{{trans('file.State')}} *</label>
                                        @if($lims_general_setting_data)
                                        <input type="hidden" name="state_hidden" value="{{$lims_general_setting_data->state}}">
                                        @endif
                                        <select name="state" class="selectpicker block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded">
                                            <option value="1">Home State</option>
                                            <option value="2">Buyer State</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="md:w-1/2 pr-4 pl-4">
                                    <div class="mb-4">
                                        <label>{{trans('file.Date Format')}} *</label>
                                        @if($lims_general_setting_data)
                                        <input type="hidden" name="date_format_hidden" value="{{$lims_general_setting_data->date_format}}">
                                        @endif
                                        <select name="date_format" class="selectpicker block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded">
                                            <option value="d-m-Y"> dd-mm-yyy</option>
                                            <option value="d/m/Y"> dd/mm/yyy</option>
                                            <option value="d.m.Y"> dd.mm.yyy</option>
                                            <option value="m-d-Y"> mm-dd-yyy</option>
                                            <option value="m/d/Y"> mm/dd/yyy</option>
                                            <option value="m.d.Y"> mm.dd.yyy</option>
                                            <option value="Y-m-d"> yyy-mm-dd</option>
                                            <option value="Y/m/d"> yyy/mm/dd</option>
                                            <option value="Y.m.d"> yyy.mm.dd</option>
                                        </select>
                                    </div>
                                </div> 
                            </div>
                            <div class="mb-4">
                                <input type="submit" value="{{trans('file.submit')}}" class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap rounded py-1 px-3 leading-normal no-underline bg-blue-600 text-white hover:bg-blue-600">
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
    $("ul#setting #general-setting-menu").addClass("active");

    $("select[name=invoice_format]").on("change", function (argument) {
        if($(this).val() == 'standard') {
            $("#state").addClass('d-none');
            $("input[name=state]").prop("required", false);
        }
        else if($(this).val() == 'gst') {
            $("#state").removeClass('d-none');
            $("input[name=state]").prop("required", true);
        }
    })
    if($("input[name='timezone_hidden']").val()){
        $('select[name=timezone]').val($("input[name='timezone_hidden']").val());
        $('select[name=staff_access]').val($("input[name='staff_access_hidden']").val());
        $('select[name=date_format]').val($("input[name='date_format_hidden']").val());
        $('select[name=invoice_format]').val($("input[name='invoice_format_hidden']").val());
        if($("input[name='invoice_format_hidden']").val() == 'gst') {
            $('select[name=state]').val($("input[name='state_hidden']").val());
            $("#state").removeClass('d-none');
        }
        $('.selectpicker').selectpicker('refresh');
    }

    $('.theme-option').on('click', function() {
        $.get('general_setting/change-theme/' + $(this).data('color'), function(data) {
        });
        var style_link= $('#custom-style').attr('href').replace(/([^-]*)$/, $(this).data('color') );
        $('#custom-style').attr('href', style_link);
    });

    
</script>
@endsection