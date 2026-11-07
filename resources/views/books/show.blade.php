@extends('layouts.app')

@section('content')
    <div class="max-w-2xl bg-white rounded shadow p-6 space-y-2">
        <h2 class="text-xl font-semibold mb-4">{{ $book->title }}</h2>
        <p><span class="font-medium">Author:</span> {{ $book->author }}</p>
        <p><span class="font-medium">Genre:</span> {{ $book->genre }}</p>
        <p><span class="font-medium">Year Published:</span> {{ $book->publication_year }}</p>

        <div class="pt-4 flex gap-2">
            <a href="{{ route('books.edit', $book) }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Edit</a>
            <a href="{{ route('books.index') }}" class="px-4 py-2 rounded border border-gray-300 hover:bg-gray-100">Back</a>
        </div>
    </div>
@endsection