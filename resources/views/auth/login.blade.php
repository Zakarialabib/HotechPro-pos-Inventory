@extends('layouts.auth')
@section('content')
    <div class="min-h-screen bg-gray-50 flex flex-col justify-center py-12 sm:px-6 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-md">
            <img class="mx-auto h-10 w-auto" src="{{ url('public/logo', $general_setting->site_logo) }}" width="120"
                alt="{{ $general_setting->site_title }}" />
            <div class="text-center">{{ $general_setting->site_title }}</div>
        </div>
        @if (session()->has('delete_message'))
            <div class="relative px-3 py-3 mb-4 border rounded bg-red-200 border-red-300 text-red-800  text-center">
                <button type="button" class="absolute top-0 bottom-0 right-0 px-4 py-3" data-dismiss="alert"
                    aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>{{ session()->get('delete_message') }}
            </div>
        @endif
        <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
            <div class="bg-white py-8 px-4 shadow sm:rounded-lg sm:px-10">
                <form method="POST" action="{{ route('login') }}" id="login-form">
                    @csrf
                    <div class="mt-2">
                        <label for="name"
                            class="block text-sm font-medium leading-5 text-gray-700">{{ trans('file.UserName') }}</label>
                        <input type="text" name="name" required
                            class="appearance-none block w-full mt-4  px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5"
                            value="">
                        @if ($errors->has('name'))
                            <p>
                                <strong>{{ $errors->first('name') }}</strong>
                            </p>
                        @endif
                    </div>

                    <div class="mt-2">
                        <label for="password"
                            class="block text-sm font-medium mt-4 leading-5 text-gray-700">{{ trans('file.Password') }}</label>
                        <input type="password" name="password" required
                            class="appearance-none block w-full mt-4  px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5"
                            value="">
                        @if ($errors->has('password'))
                            <p>
                                <strong>{{ $errors->first('password') }}</strong>
                            </p>
                        @endif
                    </div>
                    <button type="submit"
                        class="align-middle text-center w-full mt-6 select-none border font-normal whitespace-no-wrap rounded py-1 px-3 leading-normal no-underline bg-blue-600 text-white hover:bg-blue-600">{{ trans('file.LogIn') }}</button>
                </form>
                <div class="w-full text-center text-sm mt-2">
                    <a href="{{ route('password.request') }}"
                        class="">{{ trans('file.Forgot Password?') }}</a>
                  
                <p>{{ trans('file.Do not have an account?') }}</p>
                <a href="
                        {{ url('register') }}"
                        class="">{{ trans('file.Register') }}</a>
                  </div>
            </div>
        </div>
        <div class="copyrights text-center">
                        <p>{{ trans('file.Developed By') }} <span class="external">Zakaria Labib</span></p>
                </div>
            </div>

        @endsection
