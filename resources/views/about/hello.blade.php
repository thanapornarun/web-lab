<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <h1 class="text-blue-600 text-3xl">ID: {{ $id }}</h1>
    <h2>Name: {{ $info['name'] }}</h2>
    <div>Address: {{ $info['address'] }}</div>

    <div>{{ now()->diffForHumans() }}</div>

    <a class="inline-block py-2 px-4 bg-green-300 hover:bg-green-400 shadow-sm" href="{{ url('/about/history') }}">History</a> |
    <a class="focus:outline-black text-white text-sm py-2.5 px-4 border-b-4 border-blue-600 bg-blue-500 hover:bg-blue-400" href="{{ route('about') }}">About</a>
</body>
</html>




