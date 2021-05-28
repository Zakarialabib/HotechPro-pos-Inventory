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
                        <h4>{{trans('file.SMS Setting')}}</h4>
                    </div>
                    <div class="flex-auto p-6">
                        <p class="italic"><small>{{trans('file.The field labels marked with * are required input fields')}}.</small></p>
                        {!! Form::open(['route' => 'setting.smsStore', 'method' => 'post']) !!}
                            <div class="flex flex-wrap ">
                                <div class="md:w-1/2 pr-4 pl-4">
                                    <div class="mb-4">
                                        <input type="hidden" name="gateway_hidden" value="{{env('SMS_GATEWAY')}}">
                                        <label>{{trans('file.Gateway')}} *</label>
                                        <select class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded" name="gateway">
                                            <option selected disabled>{{trans('file.Select SMS gateway...')}}</option>
                                            <option value="twilio">Twilio</option>
                                            <option value="clickatell">Clickatell</option>
                                        </select>
                                    </div>
                                    <div class="mb-4 twilio">
                                        <label>ACCOUNT SID *</label>
                                        <input type="text" name="account_sid" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded twilio-option" value="{{env('ACCOUNT_SID')}}" />
                                    </div>
                                    <div class="mb-4 twilio">
                                        <label>AUTH TOKEN *</label>
                                        <input type="text" name="auth_token" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded twilio-option" value="{{env('AUTH_TOKEN')}}" />
                                    </div>
                                    <div class="mb-4 twilio">
                                        <label>Twilio Number *</label>
                                        <input type="text" name="twilio_number" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded twilio-option" value="{{env('Twilio_Number')}}" />
                                    </div>
                                    <div class="mb-4 clickatell">
                                        <label>API Key *</label>
                                        <input type="text" name="api_key" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded clickatell-option" value="{{env('CLICKATELL_API_KEY')}}" />
                                    </div>
                                    <div class="mb-4">
                                        <input type="submit" value="{{trans('file.submit')}}" class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap rounded py-1 px-3 leading-normal no-underline bg-blue-600 text-white hover:bg-blue-600">
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
    $("ul#setting #sms-setting-menu").addClass("active");

    if( $('input[name="gateway_hidden"]').val() == 'twilio' ){
        $('select[name="gateway"]').val('twilio');
        $('.clickatell').hide();
    }
    else if( $('input[name="gateway_hidden"]').val() == 'clickatell' ){
        $('select[name="gateway"]').val('clickatell');
        $('.twilio').hide();
    }
    else{
        $('.clickatell').hide();
        $('.twilio').hide();
    }

    $('select[name="gateway"]').on('change', function(){
        if( $(this).val() == 'twilio' ){
            $('.clickatell').hide();
            $('.twilio').show(500);
            $('.twilio-option').prop('required',true);
            $('.clickatell-option').prop('required',false);
        }
        else if( $(this).val() == 'clickatell' ){
            $('.twilio').hide();
            $('.clickatell').show(500);
            $('.twilio-option').prop('required',false);
            $('.clickatell-option').prop('required',true);
        }
    });

</script>
@endsection