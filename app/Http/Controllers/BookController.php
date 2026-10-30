<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index(Request $request)
    {
        $query = Book::latest();

        if ($request->has('status') && in_array($request->status, ['to-read', 'reading', 'finished'])) {
            $query->where('status', $request->status);
        }

        $books = $query->get();
        return view('books.index', compact('books'));
    }

    public function create()
    {
        return view('books.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'status' => 'required|in:to-read,reading,finished',
        ]);

        Book::create($validated);

        return redirect()->route('books.index')->with('success', 'Book added successfully!');
    }

    public function update(Request $request, Book $book)
    {
        $validated = $request->validate([
            'status' => 'required|in:to-read,reading,finished',
        ]);

        $book->update($validated);

        return redirect()->route('books.index')->with('success', 'Book status updated successfully!');
    }

    public function destroy(Book $book)
    {
        $book->delete();

        return redirect()->route('books.index')->with('success', 'Book removed successfully!');
    }
}