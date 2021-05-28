@extends('layout.main') @section('content')
<section class="forms">
    <div class="container mx-auto sm:px-4 max-w-full mx-auto sm:px-4">
        <div class="flex flex-wrap ">
            <div class="md:w-full pr-4 pl-4">
                <div class="relative flex flex-col min-w-0 rounded break-words border bg-white border-1 border-gray-300">
                    <div class="py-3 px-6 mb-0 bg-gray-200 border-b-1 border-gray-300 text-gray-900 flex items-center">
                        <h4>{{trans('file.Update Biller')}}</h4>
                    </div>
                    <div class="flex-auto p-6">
                        <p class="italic"><small>{{trans('file.The field labels marked with * are required input fields')}}.</small></p>
                        {!! Form::open(['route' => ['biller.update', $lims_biller_data->id], 'method' => 'put', 'files' => true]) !!}
                        <div class="flex flex-wrap ">
                            <div class="md:w-1/2 pr-4 pl-4">
                                <div class="mb-4">
                                    <label>{{trans('file.name')}} *</strong> </label>
                                    <input type="text" name="name" value="{{$lims_biller_data->name}}" required class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded">
                                </div>
                            </div>
                            <div class="md:w-1/2 pr-4 pl-4">
                                <div class="mb-4">
                                    <label>{{trans('file.Image')}}</label>
                                    <input type="file" name="image" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded">
                                    @if($errors->has('image'))
                                   <span>
                                       <strong>{{ $errors->first('image') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="md:w-1/2 pr-4 pl-4">   
                                <div class="mb-4">
                                    <label>{{trans('file.Company Name')}} *</label>
                                    <input type="text" name="company_name" value="{{$lims_biller_data->company_name}}" required class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded">
                                    @if($errors->has('company_name'))
                                   <span>
                                       <strong>{{ $errors->first('company_name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="md:w-1/2 pr-4 pl-4">
                                <div class="mb-4">
                                    <label>{{trans('file.VAT Number')}}</label>
                                    <input type="text" name="vat_number" value="{{$lims_biller_data->vat_number}}" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded">
                                </div>
                            </div>
                            <div class="md:w-1/2 pr-4 pl-4">
                                <div class="mb-4">
                                    <label>{{trans('file.Email')}} *</label>
                                    <input type="email" name="email" value="{{$lims_biller_data->email}}" required class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded">
                                    @if($errors->has('email'))
                                   <span>
                                       <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="md:w-1/2 pr-4 pl-4">
                                <div class="mb-4">
                                    <label>{{trans('file.Phone Number')}} *</label>
                                    <input type="text" name="phone_number" value="{{$lims_biller_data->phone_number}}" required class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded">
                                </div>
                            </div>
                            <div class="md:w-1/2 pr-4 pl-4">
                                <div class="mb-4">
                                    <label>{{trans('file.Address')}} *</label>
                                    <input type="text" name="address" value="{{$lims_biller_data->address}}" required class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded">
                                </div>
                            </div>
                            <div class="md:w-1/2 pr-4 pl-4">
                                <div class="mb-4">
                                    <label>{{trans('file.City')}} *</label>
                                    <input type="text" name="city"  value="{{$lims_biller_data->city}}" required class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded">
                                </div>
                            </div>
                            <div class="md:w-1/2 pr-4 pl-4">
                                <div class="mb-4">
                                    <label>{{trans('file.State')}}</label>
                                    <input type="text" name="state" value="{{$lims_biller_data->state}}" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded">
                                </div>
                            </div>
                            <div class="md:w-1/2 pr-4 pl-4">
                                <div class="mb-4">
                                    <label>{{trans('file.Postal Code')}}</label>
                                    <input type="text" name="postal_code" value="{{$lims_biller_data->postal_code}}" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded">
                                </div>
                            </div>
                            <div class="md:w-1/2 pr-4 pl-4">
                                <div class="mb-4">
                                    <label>{{trans('file.Country')}}</label>
                                    <input type="text" name="country" value="{{$lims_biller_data->country}}" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded">
                                </div>
                            </div>
                            <div class="md:w-full pr-4 pl-4">
                                <div class="mb-4 mt-3">
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
    $("ul#people").siblings('a').attr('aria-expanded','true');
    $("ul#people").addClass("show");
</script>
@endsection
