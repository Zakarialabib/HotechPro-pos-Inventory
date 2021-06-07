@extends('layout.main')
@section('content')
<section class="forms">
    <div class=" px-2 max-w-full mx-auto">
        <div class="flex flex-wrap ">
            <div class="md:w-full pr-4 pl-4">
                <div class="relative flex flex-col min-w-0 rounded break-words border bg-white border-1 border-gray-300">
                    <div class="py-3 px-6 mb-0 bg-gray-200 border-b-1 border-gray-300 text-gray-900 flex items-center">
                        <h4>{{trans('file.Show Activity')}} N° {{$lims_activity_data->id}} </h4>
                    </div>
                    <div class="flex-auto p-6">
                    @php 
                    $employee = \App\Employee::find($lims_activity_data->employee_id);
                    $customer = \App\Customer::find($lims_activity_data->customer_id);
                    $user = \App\User::find($lims_activity_data->user_id);
                @endphp
                <div class="flex flex-wrap "> 
                <div class="w-1/2">
                <p>{{trans('file.Date')}} : {{ date($general_setting->date_format, strtotime($lims_activity_data->date)) }}</p>
                <p>{{trans('file.Hour')}} : {{ $lims_activity_data->hour }}</p>
                <p>{{trans('file.Place')}} : {{$lims_activity_data->place }}</p>
                <p>{{trans('file.Transportation')}} : {{$lims_activity_data->transportation}}</p>
                <p>{{trans('file.Duration')}} : {{$lims_activity_data->duration}}</p>
                </div>
                <div class="w-1/2">
                    <p>{{trans('file.Employee')}} : {{ $employee->name }}</p>
                    <p>{{trans('file.Expense')}} : {{$lims_activity_data->expense}}</p>
                    <p>{{trans('file.Object')}} : {{$lims_activity_data->object}}</p>
                    </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>   
</section>
@endsection