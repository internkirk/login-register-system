@extends('layouts.app')

@section('links')
<script src="https://www.google.com/recaptcha/api.js?hl=fa" async defer></script>
@endsection

@section('title' , 'Login')


@section('body')
<div class="dark:bg-gray-800 mt-8 w-5/6 rounded-2xl mx-auto mb-7 sm:w-4/6 md:w-3/6 lg:w-2/6">
    <div class="p-4 md:p-5 border border-gray-200 dark:bg-slate-800 dark:border-0 rounded-xl">
        @if (session('wrong credentials'))
        <div class="text-center text-red-600 font-vazirLight">
            <p>
                @lang('auth.wrong credentials')
            </p>
        </div>
        @endif
        <form class="space-y-4" action="{{ route('auth.login') }}" method="POST">

            @csrf
            <div>
                <div class="flex justify-between">
                    <p class="text-slate-800 block pb-5 dark:text-white border-slate-600  font-vazirLight">
                        @lang('auth.login form')</p>
                    <a href="{{ route('auth.show.magic.link.form') }}" class="font-vazirLight text-sky-500 dark:hover:text-white cursor-pointer hover:text-blue-900 hover:border-b-2 border-blue-900">@lang('auth.enter without password')</a>
                </div>
                <hr>
                <label for="email"
                    class="block mb-2 text-sm font-vazirLight  text-gray-800 pt-10 dark:text-white">@lang('auth.email')</label>
                <input type="email" name="email" id="email" value="{{ old('email')}}"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                    placeholder="name@company.com">
                {{-- error --}}
                @error('email')
                <div class="flex items-center p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400"
                    role="alert">
                    <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                    </svg>
                    <span class="sr-only">Info</span>
                    <div>
                        <span class="font-vazirThin">{{ $message }}</span>
                    </div>
                </div>
                @enderror
                {{-- end error --}}
            </div>
            <div>
                <label for="password"
                    class="block mb-2 text-sm font-vazirLight text-gray-900 dark:text-white">@lang('auth.password')</label>
                <input type="password" name="password" id="password" placeholder="••••••••"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white">
                {{-- error --}}
                @error('password')
                <div class="flex items-center p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400"
                    role="alert">
                    <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                    </svg>
                    <span class="sr-only">Info</span>
                    <div>
                        <span class="font-vazirThin">{{ $message }}</span>
                    </div>
                </div>
                @enderror
                {{-- end error --}}
            </div>
            <div>
                <div class="g-recaptcha" data-sitekey="{{ config('services.recaptcha.site_key') }}"></div>
                {{-- error --}}
                @error('g-recaptcha-response')
                <div class="flex items-center p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400"
                    role="alert">
                    <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                    </svg>
                    <span class="sr-only">Info</span>
                    <div>
                        <span class="font-vazirThin">{{ $message }}</span>
                    </div>
                </div>
                @enderror
                {{-- end error --}}

            </div>
            <div class="flex justify-between">
                <div class="flex items-start">
                    <div class="flex items-center h-5">
                        <input id="remember" type="checkbox" value="" name="remember"
                            class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-blue-300 dark:bg-gray-600 dark:border-gray-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800">
                    </div>
                    <label for="remember"
                        class="ms-2 text-sm font-vazirLight text-gray-900 dark:text-gray-300">@lang('auth.remember me')</label>
                </div>
                <a href="{{ route('auth.forget.password.form')}}"
                    class="text-sm text-blue-700 hover:underline dark:text-blue-500 font-vazirLight">@lang('auth.lost password')?</a>
            </div>
            <button type="submit"
                class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-vazirLight rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">@lang('auth.login')</button>
            <div>
                <a href='{{ route('auth.redirect.to.provider', 'google' ) }}'
                    class="w-full block text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-vazirLight rounded-lg text-sm px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">@lang('auth.login with google')</a>
            </div>
            <div class="text-sm font-vazirBold text-gray-500 dark:text-gray-300">
                @lang('auth.not registered')? <a href="{{ route('auth.register.form') }}"
                    class="text-blue-700 hover:underline dark:text-blue-500">@lang('auth.Create account')</a>
            </div>
        </form>
    </div>
</div>
@endsection