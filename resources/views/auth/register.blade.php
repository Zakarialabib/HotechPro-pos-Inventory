@extends('layouts.auth')
@section('content')
    
    <div class="min-h-screen bg-gray-50 flex flex-col justify-center py-12 sm:px-6 lg:px-8">
      <div class="container mx-auto sm:px-4">
            <div class="sm:mx-auto sm:w-full sm:max-w-md">
              <img class="mx-auto h-10 w-auto" src="{{url('public/logo', $general_setting->site_logo)}}" width="120" alt="{{ $general_setting->site_title }}" />
              <div class="text-center">{{ $general_setting->site_title }}</div>
          </div>
          <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
            <div class="bg-white py-8 px-4 shadow sm:rounded-lg sm:px-10">
              <form method="POST" action="{{ route('register') }}">
                @csrf
              <div class="mt-2">
                <label for="register-username" class="block text-sm font-medium leading-5 text-gray-700">{{trans('file.UserName')}} *</label>
                <input id="register-username" type="text" name="name" required class="appearance-none block w-full mt-2  px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5">
                @if ($errors->has('name'))
                    <p>
                        <strong>{{ $errors->first('name') }}</strong>
                    </p>
                @endif
              </div>
              <div class="mt-2">
                <label for="register-email" class="block text-sm font-medium leading-5 text-gray-700">{{trans('file.Email')}} *</label>
                <input id="register-email" type="email" name="email" required class="appearance-none block w-full mt-2  px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5">
                @if ($errors->has('email'))
                    <p>
                        <strong>{{ $errors->first('email') }}</strong>
                    </p>
                @endif
              </div>
              <div class="mt-2">
                <label for="register-phone" class="block text-sm font-medium leading-5 text-gray-700">{{trans('file.Phone Number')}} *</label>
                <input id="register-phone" type="text" name="phone_number" required class="appearance-none block w-full mt-2  px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5">
              </div>

              <div class="mt-2">
                <label for="passowrd" class="block text-sm font-medium leading-5 text-gray-700">{{trans('file.Role')}} *</label>
                <select name="role_id" id="role-id" required class="selectpicker block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded" data-live-search="true" data-live-search-style="begins" title="Select Role...">
                  @foreach($lims_role_list as $role)
                      <option value="{{$role->id}}">{{$role->name}}</option>
                  @endforeach
                </select>
              </div>
              <div id="customer-section">
                  <div class="mt-2">
                    <label for="customer-name" class="block text-sm font-medium leading-5 text-gray-700">{{trans('file.name')}} *</label>
                    <input id="customer-name" type="text" name="customer_name" class="appearance-none block w-full mt-2  px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5 customer-field">
                  </div>
                  <div class="mt-2">
                    <label for="passowrd" class="block text-sm font-medium leading-5 text-gray-700">{{trans('file.Customer Group')}} *</label>
                    <select name="customer_group_id" required class="selectpicker block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded customer-field" data-live-search="true" data-live-search-style="begins" title="Select customer group...">
                      @foreach($lims_customer_group_list as $customer_group)
                          <option value="{{$customer_group->id}}">{{$customer_group->name}}</option>
                      @endforeach
                    </select>
                  </div>
              </div>
              <div class="mt-2" id="biller-id">
                <label for="passowrd" class="block text-sm font-medium leading-5 text-gray-700">{{trans('file.Biller')}} *</label>
                <select name="biller_id" class="selectpicker block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded" data-live-search="true" data-live-search-style="begins" title="{{trans('file.Select Biller*...')}}">
                  @foreach($lims_biller_list as $biller)
                      <option value="{{$biller->id}}">{{$biller->name}} ({{$biller->phone_number}})</option>
                  @endforeach
                </select>
              </div>
              <div class="mt-2" id="warehouse-id">
                <label for="passowrd" class="block text-sm font-medium leading-5 text-gray-700">{{trans('file.Warehouse')}} *</label>
                <select name="warehouse_id" class="selectpicker block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded" data-live-search="true" data-live-search-style="begins" title="{{trans('file.Select Warehouse*...')}}">
                  @foreach($lims_warehouse_list as $warehouse)
                      <option value="{{$warehouse->id}}">{{$warehouse->name}}</option>
                  @endforeach
                </select>
              </div>
              <div class="mt-2">
                <label for="passowrd" class="block text-sm font-medium leading-5 text-gray-700">{{trans('file.Password')}} *</label>
                <input id="password" type="password" class="appearance-none block w-full mt-2  px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5" name="password" required>
                @if ($errors->has('password'))
                    <p>
                        <strong>{{ $errors->first('password') }}</strong>
                    </p>
                @endif
              </div>
              <div class="mt-2">
                <label for="password-confirm" class="block text-sm font-medium leading-5 text-gray-700">{{trans('file.Confirm Password')}} *</label>
              <input id="password-confirm" type="password" name="password_confirmation" required class="appearance-none block w-full mt-2  px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5">
              </div>
              <input id="register" type="submit" value="Register" class="inline-block align-middle text-center w-full select-none border mt-2 font-normal whitespace-no-wrap rounded py-1 px-3 leading-normal no-underline bg-blue-600 text-white hover:bg-blue-600">
            </form>
            <div class="w-full text-center text-sm mt-2">
              <p>{{trans('file.Already have an account')}}? </p><a href="{{url('login')}}" class="">{{trans('file.LogIn')}}</a>
             </div>
            </div>
        </div>
      </div>
    </div>
    <script type="text/javascript">
      // ------------------------------------------------------- //
    // Material Inputs
    // ------------------------------------------------------ //

        var materialInputs = $('input.appearance-none block w-full mt-2  px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5');

        // activate labels for prefilled values
        materialInputs.filter(function() { return $(this).val() !== ""; }).siblings('.block text-sm font-medium leading-5 text-gray-700').addClass('active');

        // move label on focus
        materialInputs.on('focus', function () {
            $(this).siblings('.block text-sm font-medium leading-5 text-gray-700').addClass('active');
        });

        // remove/keep label on blur
        materialInputs.on('blur', function () {
            $(this).siblings('.block text-sm font-medium leading-5 text-gray-700').removeClass('active');

            if ($(this).val() !== '') {
                $(this).siblings('.block text-sm font-medium leading-5 text-gray-700').addClass('active');
            } else {
                $(this).siblings('.block text-sm font-medium leading-5 text-gray-700').removeClass('active');
            }
        });
        $("#biller-id").hide();
        $("#warehouse-id").hide();
        $("#customer-section").hide();

        $("#role-id").on("change", function () {
            if($(this).val() == '5') {
              $("#customer-section").show(300);
              $(".customer-field").prop('required', true);
              $("#biller-id").hide(300);
              $("#warehouse-id").hide(300);
              $("select[name='biller_id']").prop('required', false);
              $("select[name='warehouse_id']").prop('required', false);
            }
            else if($(this).val() > 2) {
              $("#customer-section").hide(300);
              $("#biller-id").show(300);
              $("#warehouse-id").show(300);
              $("select[name='biller_id']").prop('required', true);
              $("select[name='warehouse_id']").prop('required', true);
              $(".customer-field").prop('required', false);
            }
            else {
              $("#biller-id").hide(300);
              $("#warehouse-id").hide(300);
              $("#customer-section").hide(300);
              $("select[name='biller_id']").prop('required', false);
              $("select[name='warehouse_id']").prop('required', false);
              $(".customer-field").prop('required', false);
            }
        });
    </script>

@endsection