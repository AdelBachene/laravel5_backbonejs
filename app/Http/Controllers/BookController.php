<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Requests\EditBookRequest;
use App\Models\Book;

class BookController extends Controller
{
  public function index(Request $request) {
    $books = Book::all();
    return $this->view('books.list', $request, compact('books'));
  }

  public function create(Request $request) {
    $book = new Book;
    return $this->view('books.edit', $request, compact('book'));
  }

  public function store(EditBookRequest $request) {
    $book = new Book;
    $book->fill($request->only($book->getFillable()));
    $book->save();
    return redirect()->route('book.index')->with('success_message', 'The book has been successfully added.');
  }

  public function edit(Request $request, $id) {
    $book = Book::findOrFail($id);
    return $this->view('books.edit', $request, compact('book'));
  }

  public function update(EditBookRequest $request, $id) {
    $book = Book::findOrFail($id);
    $book->fill($request->only($book->getFillable()));
    $book->save();
    return redirect()->route('book.index')->with('success_message', 'The book has been successfully saved.');
  }

  public function destroy(Request $request, $id) {
    Book::findOrFail($id)->delete();
    return redirect()->route('book.index')->with('success_message', 'The book has been successfully deleted.');
  }
}