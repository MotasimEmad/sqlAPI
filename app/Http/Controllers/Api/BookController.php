<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Author;
use App\Models\Book;

class BookController extends Controller
{
    public function books() {
        $books = Book::get();
        $authors = Author::get();
        if (count($books) > 0) {
            return response()->json(
                [
                    'statusCode' => 200,
                    'error' => false,
                    'message' => '',
                    'books' => $books,
                ],
                200
            );
        }else {
            return response()->json(
                [
                    'statusCode' => 404,
                    'error' => true,
                    'message' => 'Sorry, There Are No Books Currently',
                    'books' => $books,
                ],
                404
            );
        }
    }

    public function authorBooks($id) {
        $books = Book::where('author_id', '=', $id)->get();
        if (count($books) > 0) {
            return response()->json(
                [
                    'statusCode' => 200,
                    'error' => false ,
                    'message' => '' ,
                    'books' => $books,
                ],
                200
            );
        }else {
            return response()->json(
                [
                    'statusCode' => 404,
                    'error' => true,
                    'message' => 'Sorry, There Are No Books Currently' ,
                    'books' => $books,
                ],
                404
            );
        }
    }

    public function addBook(Request $request){ 
        $book = new Book;
        $book->title = $request->title;
        $book->pages = $request->pages;
        $book->date = $request->date;
        $book->type = $request->type;
        $book->author_id = $request->author_id;
        $result = $book->save();
        if ($result) {
            return response()->json
            (
                [
                    'statusCode' => 200,
                    'error' => false ,
                    'message' => '' ,
                    'book' => $book,
                ],
                200
            );   
        }else {
            return response()->json
            (
                [
                    'statusCode' => 404,
                    'error' => true,
                    'message' => '' ,
                    'book' => $book,
                ],
                500
            );     
        }
    }

    public function updateBook(Request $request, $id){ 
        $book = Book::find($id);
        $book->title = $request->title;
        $book->pages = $request->pages;
        $book->date = $request->date;
        $book->type = $request->type;
        $book->author_id = $request->author_id;
        $result = $book->save();
        if ($result) {
            return response()->json
            (
                [
                    'statusCode' => 200,
                    'error' => false ,
                    'message' => '' ,
                    'author' => $book,
                ],
                200
            );   
        }else {
            return response()->json
            (
                [
                    'statusCode' => 404,
                    'error' => true,
                    'message' => '' ,
                    'author' => $book,
                ],
                500
            );     
        }
    }

    public function deleteBook($id)
    {
        $deleteRequest = Book::findOrFail($id);
        $deleteRequest->delete();
        return response()->json($deleteRequest::all());
    }
}
