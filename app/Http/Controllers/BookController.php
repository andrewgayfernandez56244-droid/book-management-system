<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index()
    {
        $search = request('search');

        $books = Book::query()
            ->when(filled($search), function ($query) use ($search): void {
                $query->where(function ($subQuery) use ($search): void {
                    $subQuery->where('title', 'like', '%'.$search.'%')
                        ->orWhere('author', 'like', '%'.$search.'%');
                });
            })
            ->latest()
            ->get();

        return view('books.index', compact('books', 'search'));
    }

    public function create()
    {
        return view('books.create');
    }

    public function store(StoreBookRequest $request)
    {
        $data = $request->validated();

        Book::create([
            'title' => $data['title'],
            'author' => $data['author'],
            'genre' => $data['genre'],
            'publication_year' => $this->resolveYear($request),
        ]);

        return redirect()->route('books.index')->with('success', 'Book created successfully.');
    }

    public function show(Book $book)
    {
        return view('books.show', compact('book'));
    }

    public function edit(Book $book)
    {
        return view('books.edit', compact('book'));
    }

    public function update(UpdateBookRequest $request, Book $book)
    {
        $data = $request->validated();

        $book->update([
            'title' => $data['title'],
            'author' => $data['author'],
            'genre' => $data['genre'],
            'publication_year' => $this->resolveYear($request),
        ]);

        return redirect()->route('books.index')->with('success', 'Book updated successfully.');
    }

    public function destroy(Book $book)
    {
        $book->delete();

        return redirect()->route('books.index')->with('success', 'Book deleted successfully.');
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
