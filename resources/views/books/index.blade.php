@extends('layouts.app')

@section('content')
    <form method="GET" action="{{ route('books.index') }}" class="mb-4 flex gap-2">
        <input type="text" name="search" value="{{ $search }}" placeholder="Search by title or author" class="flex-1 rounded border border-gray-300 px-3 py-2">
        <button type="submit" class="bg-gray-800 text-white px-4 py-2 rounded hover:bg-gray-900">Search</button>
    </form>

    <div class="overflow-x-auto bg-white rounded shadow">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Title</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Author</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Genre</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Year Published</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse ($books as $book)
                    <tr>
                        <td class="px-4 py-2">{{ $book->title }}</td>
                        <td class="px-4 py-2">{{ $book->author }}</td>
                        <td class="px-4 py-2">{{ $book->genre }}</td>
                        <td class="px-4 py-2">{{ $book->publication_year }}</td>
                        <td class="px-4 py-2 flex gap-2">
                            <a href="{{ route('books.edit', $book) }}" class="text-blue-600 hover:underline">Edit</a>
                            <form method="POST" action="{{ route('books.destroy', $book) }}" onsubmit="return confirm('Delete this book?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-4 py-4 text-center text-gray-500">No books found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection