@extends('layouts.main')

@section('content')

    <div class="bg-white shadow-md rounded-md overflow-hidden max-w-lg mx-auto mt-16">
        <div class="bg-pink-100 py-2 px-4">
            <h2 class="text-xl font-semibold text-gray-800">My Playlist</h2>
        </div>
        <ul class="divide-y divide-gray-200">
            @foreach ($playlists as $playlist)
            <li class="flex items-center py-4 px-6 hover:bg-gray-50">
                <span class="text-gray-700 text-lg font-medium mr-4">{{ $loop->iteration }}.</span>
                <div class="flex-1">
                    <h3 class="text-lg font-medium text-gray-800">{{ $playlist->name }}</h3>
                    <p class="text-gray-600 text-base">
                        ({{  $playlist->accessibility }})
                        <p class="text-gray-600 text-base">{{ $playlist->songs_count }} Songs</p>
                    </div>
                    <div class="text-gray-400">
                        <a href="{{  route('playlists.edit', ['playlist' => $playlist->id]) }}">Edit</a>
                    </div>
                </li>
                <div class="text-gray-400">
                    <a href="{{  route('playlists.create', ['playlist' => $playlist]) }}">Create Playlist</a>
                </div>
            @endforeach
        </ul>
    </div>
@endsection