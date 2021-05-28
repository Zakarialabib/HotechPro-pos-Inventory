@extends('layout.main')
@section('content')
<section class="forms">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex align-items-center">
                        <h4>{{trans('file.Show Resume')}} N° {{$lims_resume_data->id}} </h4>
                    </div>
                    <div class="card-body">
                    @php 
                    $employee = \App\Employee::find($lims_resume_data->employee_id);
                    $customer = \App\Customer::find($lims_resume_data->customer_id);
                    $user = \App\User::find($lims_resume_data->user_id);
                @endphp
                <div class="row"> 
                <div class="col-6">
                <p>{{trans('file.Date')}} : {{ date($general_setting->date_format, strtotime($lims_resume_data->date)) }}</p>
                <p>{{trans('file.Object')}} : {{$lims_resume_data->object}}</p>
                </div>
                <div class="col-6">
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