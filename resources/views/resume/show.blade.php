@extends('layout.main')
@section('content')
<section class="forms">
    <div class="container mx-auto sm:px-4 max-w-full mx-auto sm:px-4">
        <div class="flex flex-wrap ">
            <div class="md:w-full pr-4 pl-4">
                <div class="relative flex flex-col min-w-0 rounded break-words border bg-white border-1 border-gray-300">
                    <div class="py-3 px-6 mb-0 bg-gray-200 border-b-1 border-gray-300 text-gray-900 flex items-center">
                        <h4>{{trans('file.Show Resume')}} N° {{$lims_resume_data->id}} </h4>
                    </div>
                    <div class="flex-auto p-6">
                    @php 
                    $employee = \App\Employee::find($lims_resume_data->employee_id);
                    $customer = \App\Customer::find($lims_resume_data->customer_id);
                    $user = \App\User::find($lims_resume_data->user_id);
                @endphp
                <div class="flex flex-wrap "> 
                <div class="w-1/2">
                <p>{{trans('file.Date')}} : {{ date($general_setting->date_format, strtotime($lims_resume_data->date)) }}</p>
                <p>{{trans('file.Object')}} : {{$lims_resume_data->object}}</p>
                </div>
                <div class="w-1/2">
                    <p>{{trans('file.Employee')}} : {{ $employee->name }}</p>
                    <p>{{trans('file.Next Action')}} : {{$lims_resume_data->action}}</p>
                    <p>{{trans('file.Note')}} : {{$lims_resume_data->note}}</p>
                    </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>   
</section>
@endsection