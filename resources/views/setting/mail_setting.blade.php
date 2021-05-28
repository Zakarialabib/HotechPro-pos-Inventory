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
                        <h4>{{trans('file.Mail Setting')}}</h4>
                    </div>
                    <div class="flex-auto p-6">
                        <p class="italic"><small>{{trans('file.The field labels marked with * are required input fields')}}.</small></p>
                        {!! Form::open(['route' => 'setting.mailStore', 'files' => true, 'method' => 'post']) !!}
                            <div class="flex flex-wrap ">
                                <div class="md:w-1/2 pr-4 pl-4">
                                    <div class="mb-4">
                                        <label>{{trans('file.Mail Host')}} *</label>
                                        <input type="text" name="mail_host" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded" value="{{env('MAIL_HOST')}}" required />
                                    </div>
                                    <div class="mb-4">
                                        <label>{{trans('file.Mail Address')}} *</label>
                                        <input type="text" name="mail_address" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded" value="{{env('MAIL_FROM_ADDRESS')}}" required />
                                    </div>
                                    <div class="mb-4">
                                        <label>{{trans('file.Mail From Name')}} *</label>
                                        <input type="text" name="mail_name" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded" value="{{env('MAIL_FROM_NAME')}}" required />
                                    </div>
                                    <div class="mb-4">
                                        <input type="submit" value="{{trans('file.submit')}}" class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap rounded py-1 px-3 leading-normal no-underline bg-blue-600 text-white hover:bg-blue-600">
                                    </div>
                                </div>
                                <div class="md:w-1/2 pr-4 pl-4">
                                    <div class="mb-4">
                                        <label>{{trans('file.Mail Port')}} *</label>
                                        <input type="text" name="port" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded" value="{{env('MAIL_PORT')}}" required />
                                    </div>
                                    <div class="mb-4">
                                        <label>{{trans('file.Password')}} *</label>
                                        <input type="password" name="password" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded" value="{{env('MAIL_PASSWORD')}}" required />
                                    </div>
                                    <div class="mb-4">
                                        <label>{{trans('file.Encryption')}} *</label>
                                        <input type="text" name="encryption" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded" value="{{env('MAIL_ENCRYPTION')}}" required />
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
    $("ul#setting #mail-setting-menu").addClass("active");

    

</script>
@endsection