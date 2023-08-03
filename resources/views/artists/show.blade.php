@extends('layouts.main')

@section('content')
    <h1 class = "text-5xl">
        {{ $artist->name }}
    </h1>

    <div>
        <a class="w-full border-l border-t border-b text-base font-medium rounded-l-md text-black bg-pink-300 hover:bg-gray-100 px-2 py-0.5"
            href=" {{ route('artists.edit', [ 'artist' => $artist ]) }}" >
            Edit Artist
        </a>
        
        @if($artist->songs->isEmpty())
        <form class="inline-block" 
        action=" {{ route('artists.destroy', [ 'artist' => $artist ]) }}" method="POST">
        @csrf
        @method("DELETE")
        <button 
        class="inline-block py-2 px-4 bordr border-gray-600 bg-red-300"
        type="submit">
        Delete Artist
    </button>
</form>
        @endif
    </div>

    <div class="bg-white shadow-md rounded-md overflow-hidden max-w-lg mx-auto mt-16">
        <div class="bg-pink-100 py-2 px-4">
            <h2 class="text-xl font-semibold text-gray-800">Songs</h2>
            <a class="w-full border-l border-t border-b text-base font-medium rounded-l-md text-black bg-pink-300 hover:bg-gray-100 px-2 py-0.5"
                href=" {{ route('artists.songs.create', [ 'artist' => $artist ]) }}" >
                Add New Song
            </a>
        </div>
    <ul class="divide-y divide-gray-200">
            @foreach ($artist->songs as $song)
            <li class="flex items-center py-4 px-6 hover:bg-gray-50">
                <span class="text-gray-700 text-lg font-medium mr-4">{{ $loop->iteration }}.</span>
                <div class="flex-1">
                    <h3 class="text-lg font-medium text-gray-800">{{ $song->title }}</h3>
                    <p class="text-gray-600 text-base">{{ $song->artist->name }}</p>
                </div>
                <span class="text-gray-400">{{ $song->duration }}</span>
            </li>
            @endforeach
        </ul>
    </div>
@endsection