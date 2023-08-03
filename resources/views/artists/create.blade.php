@extends('layouts.main')

@section('content')
    <div class="w-full">
        <h2 class="text-center text-blue-400 font-bold text-2xl uppercase mb-10">Create New Artist</h2>
        <div class="bg-white p-10 rounded-lg shadow md:w-3/4 mx-auto lg:w-1/2">
            <form action="{{ route('artists.store') }}" method="POST">
                @csrf
                <div class="mb-5">
                    <label for="name" class="block mb-2 font-bold text-gray-600">Artist Name</label>
                    <input type="text" id="name" name="name" autocomplete="off" placeholder="Put in artist name" class="border border-gray-300 shadow p-3 w-full rounded mb-">
                </div>

                <button type="submit" class="block w-full bg-blue-500 text-white font-bold p-4 rounded-lg">Submit</button>
            </form>
        </div>
    </div>

@endsection
