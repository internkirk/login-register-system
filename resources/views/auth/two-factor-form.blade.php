@extends('layouts.app')

@section('title' , 'two factor authenticate')

@section('body')
@if (session('two factor authentication activated'))
<div class="text-center text-green-600 font-semibold font-vazirLight bg-green-100 w-3/6 mx-auto mt-6 py-8 rounded-xl">
    <p>
        @lang('auth.two factor authentication activated')
    </p>
</div>
@endif
@if (session('two factor authentication failed'))
<div class="text-center text-red-600 font-semibold font-vazirLight bg-red-100 w-3/6 mx-auto mt-6 py-8 rounded-xl">
    <p>
        @lang('auth.two factor authentication failed')
    </p>
</div>
@endif
@if (session('two factor authentication deactivated'))
<div class="text-center text-green-600 font-semibold font-vazirLight bg-green-100 w-3/6 mx-auto mt-6 py-8 rounded-xl">
    <p>
        @lang('auth.two factor authentication deactivated')
    </p>
</div>
@endif
<div class="dark:bg-gray-800 mt-8 w-5/6 rounded-2xl mx-auto mb-7 sm:w-4/6 md:w-3/6 lg:w-2/6">
    <div class="p-4 md:p-5 border border-gray-200 dark:bg-slate-800 dark:border-0 rounded-xl">
        @if (Auth::user()->has_two_factor)
        <form class="space-y-4" action="{{ route('auth.two.factor.deactivate') }}" method="POST">
            @csrf
            <div>
                <p class="text-slate-800 border-b-2 pb-5 dark:text-white border-slate-600  font-vazirLight">
                    @lang('auth.two factor authenticate')</p>
                <button type="submit"
                    class="w-full text-white mt-6 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-vazirLight rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">@lang('auth.deactivate')</button>

        </form>
        @else
        <form class="space-y-4" action="{{ route('auth.two.factor.activate') }}" method="POST">
            @csrf
            <div>
                <p class="text-slate-800 border-b-2 pb-5 dark:text-white border-slate-600  font-vazirLight">
                    @lang('auth.two factor authenticate')</p>
                <label for="password"
                    class="block mb-2 text-sm font-vazirLight  text-gray-800 pt-10 dark:text-white">@lang('auth.password')</label>
                <input type="password" name="password" id="password"
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
            <button type="submit"
                class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-vazirLight rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">@lang('auth.activate')</button>

        </form>
        @endif
    </div>
</div>
@endsection