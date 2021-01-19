<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
</head>

<body class="bg-gray-100 h-screen antialiased leading-none font-sans">

<div class="w-full h-96 p-6 banner-bg text-center shadow-md">

    {{-- LOGIN & REGIS --}}
    <div class="absolute text-white right-4">
        @auth
            <a href="{{ url('/dashboard') }}" class="no-underline hover:underline text-sm mx-2 font-normal text-cool-gray-50 uppercase">{{ __('Home') }}</a>
        @else
            <a href="{{ route('login') }}" class="no-underline hover:underline text-sm font-normal mx-2 text-cool-gray-50 uppercase">{{ __('Login') }}</a>
        @if (Route::has('register'))
            <a href="{{ route('register') }}" class="no-underline hover:underline text-sm font-normal mx-2 text-cool-gray-50 uppercase">{{ __('Register') }}</a>
        @endif
        @endauth
    </div>

    {{-- BANNER --}}
    <div class="flex flex-col h-full justify-center">
        <h1 class="text-cool-gray-100 font-bold text-6xl my-2">Informasi Hotel</h1>
        <p class="text-cool-gray-300 text-2xl my-2">Pusat informasi hotel!</p>
    </div>
    
    {{-- SEARCH BAR --}}
    <form class="flex flex-row h-14 w-full justify-center" action="search" method="GET">
        <input class="form-input rounded-l-md rounded-r-none border-none shadow-md w-7/12 p-4" type="search" name="search" placeholder="Cari Hotel">
        <button class="bg-red-700 text-white p-3 rounded-r-md rounded-l-none shadow-md sm:px-10 px-4 hover:bg-red-500 transition duration-300 ease-in-out" type="submit">Search</button>
    </form>

</div>

<div class="bg-white w-9/12 p-6 mt-13 mb-4 mx-auto rounded-sm shadow-md grid sm:grid-cols-3 sm:grid-rows-2 grid-cols-1 gap-6">
    @foreach ($hotels as $hotel)
    <a class="block h-96 bg-white p-4 shadow-md rounded-sm transition duration-300 ease-in-out transform hover:-translate-y-1 hover:scale-105 cursor-pointer" href="{{ route('home.show', $hotel->id) }}">
        <img src="{{ $hotel->images }}" alt="{{ $hotel->name }}" class="h-1/2 w-full">
        <div class="h-1/2">
            <h1 class="text-lg font-bold text-cool-gray-900 mt-8 mb-5">{{ $hotel->name }}</h1>
            <p class="text-cool-gray-600 mb-3">{{ \Illuminate\Support\Str::limit($hotel->description, 100, $end='...') }}</p>
            <p class="text-cool-gray-600 mb-3">{{ $hotel->email }}</p>
            <p class="text-cool-gray-600">{{ $hotel->phone }}</p>
        </div>
    </a>
    @endforeach
    <div class="col-span-3 mt-auto">
        {!! $hotels->links() !!}
    </div>
</div>

{{-- BOTTOM --}}
<div class="bg-cool-gray-700 text-white px-4 py-2 mt-auto">
    <small>&copy; Copyright 2020, Kelompok 5. All Rights Reserved</small>
</div>


</body>

</html>
