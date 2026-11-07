@extends('layouts.app')

@section('content')
    <div class="max-w-2xl bg-white rounded shadow p-6">
        <h2 class="text-xl font-semibold mb-4">Add Book</h2>

        <form method="POST" action="{{ route('books.store') }}" class="space-y-4">
            @csrf

            <div>
                <label class="block text-sm font-medium mb-1" for="title">Title</label>
                <input type="text" name="title" id="title" value="{{ old('title') }}" class="w-full rounded border border-gray-300 px-3 py-2">
            </div>

            <div>
                <label class="block text-sm font-medium mb-1" for="author">Author</label>
                <input type="text" name="author" id="author" value="{{ old('author') }}" class="w-full rounded border border-gray-300 px-3 py-2">
            </div>

            <div>
                <label class="block text-sm font-medium mb-1" for="genre">Genre</label>
                <input type="text" name="genre" id="genre" value="{{ old('genre') }}" class="w-full rounded border border-gray-300 px-3 py-2">
            </div>

            <div>
                <label class="block text-sm font-medium mb-1" for="publication_year">Year Published</label>
                <input type="number" name="publication_year" id="publication_year" value="{{ old('publication_year') }}" class="w-full rounded border border-gray-300 px-3 py-2">
            </div>

            <div class="flex gap-2">
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Save</button>
                <a href="{{ route('books.index') }}" class="px-4 py-2 rounded border border-gray-300 hover:bg-gray-100">Cancel</a>
            </div>
        </form>
    </div>
@endsection