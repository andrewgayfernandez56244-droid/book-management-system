<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }} - Book Management</title>
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
</head>
<body class="bg-gray-100 text-gray-900 min-h-screen">
    <div class="max-w-6xl mx-auto p-6">
        <header class="mb-6 flex items-center justify-between">
            <h1 class="text-2xl font-bold">
                <a href="{{ route('books.index') }}">Book Management System</a>
            </h1>
            <a href="{{ route('books.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Add Book</a>
        </header>

        @if (session('success'))
            <x-alert type="success" :message="session('success')" />
        @endif

        @if ($errors->any())
            <div class="mb-4 rounded border border-red-300 bg-red-50 p-4 text-red-700">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <main>
            @yield('content')
        </main>
    </div>
</body>
</html>