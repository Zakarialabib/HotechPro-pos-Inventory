<?php $general_setting = DB::table('general_settings')->find(1); ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ $general_setting->site_title }}</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">
    <link rel="manifest" href="{{ url('manifest.json') }}">
    <link rel="icon" type="image/png" href="{{ url('public/logo', $general_setting->site_logo) }}" />
    <!-- CSS-->
    <link href="{{ asset('public/css/app.css') }}" rel="stylesheet">
    <!-- Google fonts - Roboto -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700">
    <!-- Custom stylesheet - for your changes-->
    <link rel="stylesheet"
        href="<?php echo asset('public/css/custom-' . $general_setting->theme); ?>"
        type="text/css">
</head>

<body>
    <div class="min-h-screen bg-gray-50 flex flex-col justify-center py-12 sm:px-6 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-md">
            <img class="mx-auto h-10 w-auto" src="{{url('public/logo', $general_setting->site_logo)}}" width="120" alt="{{ $general_setting->site_title }}" />
            <div class="text-center">{{ $general_setting->site_title }}</div>
        </div>
        @if (session()->has('delete_message'))
            <div class="relative px-3 py-3 mb-4 border rounded bg-red-200 border-red-300 text-red-800  text-center">
                <button type="button" class="absolute top-0 bottom-0 right-0 px-4 py-3" data-dismiss="alert"
                    aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>{{ session()->get('delete_message') }}</div>
        @endif

        <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
            <div class="bg-white py-8 px-4 shadow sm:rounded-lg sm:px-10">
                <form method="POST" action="{{ route('login') }}" id="login-form">
                    @csrf
                    <div class="mt-6">
                        <label for="login-username"
                            class="block text-sm font-medium leading-5 text-gray-700">{{ trans('file.UserName') }}</label>
                        <input id="login-username" type="text" name="name" required
                            class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5"
                            value="">
                        @if ($errors->has('name'))
                            <p>
                                <strong>{{ $errors->first('name') }}</strong>
                            </p>
                        @endif
                    </div>

                    <div class="mt-6">
                        <label for="login-password"
                            class="block text-sm font-medium leading-5 text-gray-700">{{ trans('file.Password') }}</label>
                        <input id="login-password" type="password" name="password" required
                            class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5"
                            value="">
                        @if ($errors->has('password'))
                            <p>
                                <strong>{{ $errors->first('password') }}</strong>
                            </p>
                        @endif
                    </div>
                    <button type="submit"
                        class="align-middle text-center select-none border font-normal whitespace-no-wrap rounded py-1 px-3 leading-normal no-underline bg-blue-600 text-white hover:bg-blue-600">{{ trans('file.LogIn') }}</button>
                </form>
                <div class="w-full text-center text-lg mt-5">
                <a href="{{ route('password.request') }}"
                    class="">{{ trans('file.Forgot Password?') }}</a>
                  
                <p>{{ trans('file.Do not have an account?') }}</p>
                <a href="{{ url('register') }}"
                    class="">{{ trans('file.Register') }}</a>
                  </div>
            </div>
        </div>
        <div class="copyrights text-center">
          <p>{{ trans('file.Developed By') }} <span class="external">Zakaria Labib</span></p>
      </div>
    </div>
</body>
</html>


