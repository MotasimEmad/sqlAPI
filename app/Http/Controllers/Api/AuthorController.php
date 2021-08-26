<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Author;

class AuthorController extends Controller
{
    public function authors() {
        $authors = Author::get();
        if (count($authors) > 0) {
            return response()->json(
                [
                    'statusCode'=> 200,
                    'error'=> false ,
                    'message'=> '' ,
                    'authors'=> $authors,
                ],
                200
            );
        }else {
            return response()->json(
                [
                    'statusCode' => 404,
                    'error' => true,
                    'message' => 'Sorry, There Are No Authors Currently' ,
                ],
                404
            );
        }
    }

    public function addAuthor(Request $request){ 
        $author = new Author;
        $author->author_name = $request->author_name;
        $result = $author->save();
        if ($result) {
            return response()->json
            (
                [
                    'statusCode' => 200,
                    'error' => false ,
                    'message' => '' ,
                    'author' => $author,
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
                    'author' => $author,
                ],
                500
            );     
        }
    }

    public function updateAuthor(Request $request, $id){ 
        $author = Author::find($id);
        $author->author_name = $request->author_name;
        $result = $author->save();
        if ($result) {
            return response()->json
            (
                [
                    'statusCode' => 200,
                    'error' => false ,
                    'message' => '' ,
                    'author' => $author,
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
                    'author' => $author,
                ],
                500
            );     
        }
    }

    public function deleteAuthor($id)
    {
        $deleteRequest = Author::findOrFail($id);
        $deleteRequest->delete();
        return response()->json($deleteRequest::all());
    }
}
