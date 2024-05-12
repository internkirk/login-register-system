@extends('layouts.app')

@section('title' , 'reset password')


@section('body')
<div class="dark:bg-gray-800 mt-8 w-5/6 rounded-2xl mx-auto mb-7 sm:w-4/6 md:w-3/6 lg:w-2/6">
    <div class="p-4 md:p-5 border border-gray-200 dark:bg-slate-800 dark:border-0 rounded-xl">
        @if (session('token is invalid'))
        <div class="text-center text-red-600 font-vazirLight">
            <p>
                @lang('validation.token is invalid')
            </p>
        </div>
        @endif
        @if (session('there is a problem'))
        <div class="text-center text-red-600 font-vazirLight">
            <p>
                @lang('validation.there is a problem')
            </p>
        </div>
        @endif
        <form class="space-y-4" action="{{ route('auth.reset.password') }}" method="POST">
            @csrf
            <input name="token" value="{{ $request->query('token') }}" type="hidden">
            <div>
                <p class="text-slate-800 border-b-2 pb-5 dark:text-white border-slate-600  font-vazirLight">@lang('auth.reset password form')</p>
                <label for="email"
                    class="block mb-2 text-sm font-vazirLight  text-gray-800 pt-10 dark:text-white">@lang('auth.email')</label>
                <input type="email" name="email" id="email" value="{{ $request->query('email') }}" readonly
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                    placeholder="name@company.com" >
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
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                    >
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
                <label for="password_confirmation"
                    class="block mb-2 text-sm font-vazirLight text-gray-900 dark:text-white">@lang('auth.password confirm')</label>
                <input type="password" name="password_confirmation" id="password_confirmation"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                    >
                {{-- error --}}
                @error('password_confirmation')
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
            <button type="submit"
                class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-vazirLight rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">@lang('auth.submit')</button>
        </form>
    </div>
</div>
@endsection