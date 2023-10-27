@extends('layouts.main')

@section('content')
    <div class="w-full">
        <h2 class="text-center text-blue-400 font-bold text-2xl uppercase mb-10">Edit Playlist</h2>
        <div class="bg-white p-10 rounded-lg shadow md:w-3/4 mx-auto lg:w-1/2">
            <form action="{{ route('playlists.store', ['playlist' => $playlist]) }}" method="POST">
                @csrf
                <div class="mb-5">
                    <label for="name" class="block mb-2 font-bold text-gray-600">Playlist Name</label>
                    @error('name')
                        <div class="text-red-600">
                            {{ $message }}
                        </div>
                    @enderror
                    value="{{ old('name', $playlist->name) }}"
                </div>
                <button type="submit" class="block w-full bg-blue-500 text-white font-bold p-4 rounded-lg">Submit</button>
            </form>
            </form>
@endsection