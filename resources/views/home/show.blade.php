@extends('layouts.app')
@section('content')

<div class="w-screen sm:container mx-auto py-4 bg-gray-100 font-sans grid grid-cols-c2 gap-5">

    <!-- INFO HOTEL -->
    <div class="bg-white text-cool-gray-900 shadow-md p-5">
        <img src="{{asset($hotel->images)}}" alt="{{ $hotel->name }}" class="w-full">
        <h1 class="text-3xl font-bold text-cool-gray-900 mt-4 mb-3">
            {{ $hotel->name }}
        </h1>
        <p class="text-md text-cool-gray-600 mb-4">
            <span class="font-bold">Desc:</span> {{ $hotel->description }}
        </p>
        <p class="text-md text-cool-gray-600 mb-4">
            <span class="font-bold">Address:</span> {{ $hotel->address }}
        </p>
        <p class="text-md text-cool-gray-600 mb-4">
            <span class="font-bold">Email:</span> {{ $hotel->email }}
        </p>
    </div>

    <!-- Maps -->
    <div>
        <div class="bg-white p-4 shadow-lg ">
            <h1 class="text-2xl font-bold mb-4">Location:</h1>
            <hr>
            <iframe class="my-4" width="100%" height="450" frameborder="0" style="border:0" src="https://www.google.com/maps/embed/v1/place?q={{ $hotel->latitude }},{{ $hotel->longitude }}&amp;key={{ env("GOOGLE_API",null )}}"></iframe>
        </div>
    </div>

    <!-- Komentar Stuff -->
    <div class="shadow-md col-span-2">
        
        <!-- Form Komentar -->
        <div class="bg-white text-cool-gray-900 p-5">
            <h1 class="text-2xl font-bold mb-4">Comment</h1>
            <hr class="mb-4">
            <form class="flex flex-col" action="{{ route('comment.store') }} " method="post">
                @csrf
                <div class="flex flex-wrap my-4">
                    <label for="email" class="block text-gray-700 text-md font-bold mb-4">Name:</label>
                    <input class="form-input shadow-sm w-full" type="text" placeholder="Nama" name="name">
                </div>
                <div class="flex flex-wrap my-4">
                    <label for="rate" class="block text-gray-700 text-md font-bold mb-4">Rate:</label>
                    <select name="rate" id="rate" class="bg-white border border-gray-300 rounded-md w-full p-3">
                        @for ($i = 1; $i < 6; $i++)
                        <option value="{{ $i }}">{{ $i }}</option>
                        @endfor
                    </select>
                </div>
                <div class="flex flex-wrap my-4">
                    <label for="email" class="block text-gray-700 text-md font-bold mb-4">Comment:</label>
                    <textarea class="form-input shadow-sm w-full" name="comment" placeholder="Comment" cols="15" rows="4"></textarea>
                </div>
                <input type="hidden" value="{{ $hotel->id }}" name="hotel_id">
                <button class="bg-blue-800 hover:bg-blue-600 text-white w-48 px-8 py-4 shadow-md rounded-sm ml-auto transition duration-300 ease-in-out" type="submit" title="Submit">Submit</button>
            </form>
        </div>

        <!-- List Komentar -->
        <div class="bg-white text-cool-gray-900 p-5 mt-4">
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
        {!! $comments->links() !!}
        </div>
    </div>

</div>

@endsection