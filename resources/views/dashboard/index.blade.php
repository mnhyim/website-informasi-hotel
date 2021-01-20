@extends('layouts.app')
@section('content')
<?php   use \App\Http\Controllers\DashboardController; ?>
<main class="w-screen sm:container mx-auto py-6">

    <div class="w-full grid grid-cols-c1 gap-4">

        {{-- Status --}}
        @if ($message = Session::get('success'))
            <div class="text-sm border border-t-8 rounded text-green-700 border-green-600 bg-green-100 px-3 py-4 mb-4 col-span-2" role="alert">
                {{ $message }}
            </div>
        @endif

        {{-- Sisi kiri --}}
        <div class="flex flex-col">

            {{-- Profile --}}
            <div class="bg-white p-5 row-span-2 shadow-lg mb-2">
                <h1 class="text-2xl font-bold mb-5"> {{ Auth::user()->name }} </h1>
    
                @if (Auth::user()->images)
                    <img class="rounded-full h-40 w-40 mb-6 mx-auto" src="{{ Auth::user()->images }}" alt="{{ Auth::user()->name }}" >
                @else
                    <div class="block bg-green-700 hover:bg-green-500 text-white leading-normal rounded-full h-40 w-40 p-4 mb-6 mx-auto shadow-sm transition duration-300 ease-in-out"></div>
                @endif
    
            </div>

            @if ($has_hotel ?? '')
                {{-- Status hotel stuff --}}
                <div class="bg-white p-5 shadow-lg leading-normal text-xl">
                    <h1 class="text-cool-gray-900">Jumlah pengunjung: <span class="font-bold">{{ $has_hotel  -> click_counter }}</span></h1>
                </div>

                {{-- Administrator buttons --}}
                <div class="bg-white p-5 shadow-lg mt-2">
                    <button type="submit" title="Edit Data Hotel" class="w-full bg-yellow-400 hover:bg-yellow-300 text-white px-8 py-4 my-1 font-bold transition duration-300 ease-in-out">
                        <a href="{{ route('dashboard.edit',$has_hotel->id) }}">
                            Edit Data Hotel
                        </a>
                    </button>
                    <form action="{{ route('dashboard.destroy', $has_hotel->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" title="Delete Hotel" class="w-full bg-red-800 hover:bg-red-600 text-white px-8 py-4 my-1 font-bold transition duration-300 ease-in-out"  onclick="return confirm('Apakah Anda yakin ingin menghapus hotel ini?')">Delete Hotel</button>
                    </form>
                </div>

                {{-- Create Announcement --}}
                <div class="bg-white p-5 shadow-lg mt-2">
                    <h1 class="text-2xl font-bold"> Create Announcement </h1>
                    <hr class="divide-cool-gray-900 mt-4 mb-4">
                    <p class="text-cool-gray-500 mb-3 italic text-sm">Sampaikan pesan kepada pengunjung web, maksimal 200 karakter</p>

                    <form class="flex flex-col mx-auto" action="{{ route('announce.store') }} "method="post">
                        @csrf
                        <textarea name="messages" rows="3" class="form-input shadow-sm w-full mb-2 rounded-sm" placeholder="Announcement" required autocomplete="messages"></textarea>
                        <button type="submit" class="bg-red-700 text-white p-3 w-full shadow-md hover:bg-red-500 transition duration-300 ease-in-out rounded-sm">Submit</button>
                    </form>
                </div>

            @endif
        </div>

        {{-- Sisi kanan --}}
        <div class="flex flex-col">
            {{-- Hotel stuff --}}
            <div class="bg-white p-5 shadow-sm mb-2 flex flex-grow">
                @if ($has_hotel ?? '')
                    <img class="mr-2 w-1/2" src="{{ $has_hotel -> images }}" alt="{{ $has_hotel -> name }}">
                    <div class="ml-2 w-1/2">
                        {{-- Data hotel --}}
                        <h1 class="mb-4 text-xl font-bold">{{ $has_hotel -> name }}</h1>
                        <p class="mb-4 text-gray-900">{{ $has_hotel -> description }}</p>
                        <p class="mb-4 text-gray-900">{{ $has_hotel -> address }}</p>
                        <p class="mb-4 text-gray-900">{{ $has_hotel -> phone }}</p>
                        <p class="text-gray-900">{{ $has_hotel -> email }}</p>
                    </div>
                @else
                    {{-- Input hotel form --}}
                    @include('layouts.forms')
                @endif
            </div>

            @if ($has_hotel ?? '')
                {{-- Bottom panel --}}
                <div class="max-h-64 overflow-auto mt-2 flex">

                    {{-- Announcement List --}}
                    <div class="w-1/2 bg-white p-5 shadow-lg overflow-y-auto flex flex-col mr-2 border border-gray-100">
                        <h1 class="text-2xl font-bold"> Announcement </h1>
                        <hr class="divide-cool-gray-900 my-4">  
                        @if (count($announcement))
                            @foreach ($announcement as $an)
                                <div class="mb-4 flex border border-gray-100 p-4 shadow-sm transition duration-300 ease-in-out transform hover:-translate-y-1 cursor-pointer">
                                    <img src="{{ $an->hotel->images }}" alt="{{ $an->hotel->name }}" class="h-10 w-10 rounded-full">
                                    <div class="flex flex-col ml-3">
                                        <h1 class="text-xl font-bold mb-2">{{ $an->hotel->name }}</h1>
                                        <p>{{ $an->messages }}</p>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <h1 class="font-bold text-md mx-auto my-auto">TIDAK ADA ANNOUNCEMENT</h1>
                        @endif
                    </div>

                    {{-- Comment List --}}
                    <div class="w-1/2 bg-white p-5 shadow-lg overflow-y-auto flex flex-col ml-2 border border-gray-100">
                        <h1 class="text-2xl font-bold"> Comment </h1>
                        <hr class="divide-cool-gray-900 my-4">  
                            @if (count($comments))
                                @foreach ($comments as $cmt)
                                <div class="flex flex-col p-6 mb-4 border border-gray-100 shadow-md">
                                    <div class="flex flex-row justify-between mb-3">
                                        <h1 class="font-bold text-xl text-blue-900">{{ $cmt->name}}</h1>
                                        <h2 class="font-bold text-md ">{{ $cmt->created_at}}</h2>
                                    </div>
                                    <h1 class="font-bold mb-4 text-yellow-400">Rate : {{ $cmt->rate }}/5 </h1>
                                    <p>{{ $cmt->comment}}</p>
                                </div>
                                @endforeach                                
                            @else
                                <h1 class="font-bold text-md mx-auto my-auto">TIDAK ADA KOMENTAR</h1>
                            @endif
                            {!! $comments->links() !!}
                    </div>
                </div>
            @endif
                
        </div>
    </div>

</main>
@endsection
