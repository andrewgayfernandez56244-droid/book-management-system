<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBookRequest;
use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index(Request $request)
    {
        $books = Book::query()
            ->when($request->filled('search'), function ($query) use ($request): void {
                $search = $request->string('search')->toString();

                $query->where(function ($subQuery) use ($search): void {
                    $subQuery->where('title', 'like', '%'.$search.'%')
                        ->orWhere('author', 'like', '%'.$search.'%');
                });
            })
            ->latest()
            ->get();

        return response()->json($books);
    }

    public function store(StoreBookRequest $request)
    {
        $data = $request->validated();
        $data['publication_year'] = $this->resolveYear($request);

        $book = Book::create([
            'title' => $data['title'],
            'author' => $data['author'],
            'genre' => $data['genre'],
            'publication_year' => $data['publication_year'],
        ]);

        return response()->json(array_merge($book->toArray(), [
            'message' => 'Book created successfully.',
            'data' => $book,
        ]), 201);
    }

    public function show(int $id)
    {
        $book = Book::find($id);

        if (! $book) {
            return response()->json(['message' => 'Book not found.'], 404);
        }

        return response()->json(array_merge($book->toArray(), [
            'data' => $book,
        ]));
    }

    public function update(Request $request, int $id)
    {
        $book = Book::find($id);

        if (! $book) {
            return response()->json(['message' => 'Book not found.'], 404);
        }

        $maxYear = (int) date('Y') + 10;

        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'author' => ['required', 'string', 'max:255'],
            'genre' => ['required', 'string', 'max:255'],
            'publication_year' => ['required_without_all:published_year,year_published,year', 'nullable', 'integer', 'min:1000', 'max:'.$maxYear],
            'published_year' => ['required_without_all:publication_year,year_published,year', 'nullable', 'integer', 'min:1000', 'max:'.$maxYear],
            'year_published' => ['required_without_all:publication_year,published_year,year', 'nullable', 'integer', 'min:1000', 'max:'.$maxYear],
            'year' => ['required_without_all:publication_year,published_year,year_published', 'nullable', 'integer', 'min:1000', 'max:'.$maxYear],
        ]);

        $publicationYear = $this->resolveYear($request);

        $book->update([
            'title' => $validated['title'],
            'author' => $validated['author'],
            'genre' => $validated['genre'],
            'publication_year' => $publicationYear,
        ]);

        return response()->json(array_merge($book->fresh()->toArray(), [
            'message' => 'Book updated successfully.',
            'data' => $book->fresh(),
        ]));
    }

    public function destroy(int $id)
    {
        $book = Book::find($id);

        if (! $book) {
            return response()->json(['message' => 'Book not found.'], 404);
        }

        $book->delete();

        return response()->json([
            'message' => 'Book deleted successfully.',
        ]);
    }

    private function resolveYear(Request $request): int
    {
        foreach (['publication_year', 'published_year', 'year_published', 'year'] as $key) {
            if ($request->filled($key)) {
                return (int) $request->input($key);
            }
        }

        return (int) $request->input('publication_year');
    }
}
