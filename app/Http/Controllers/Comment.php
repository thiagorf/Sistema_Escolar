<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment as C;
use App\Models\Content;

class Comment extends Controller
{
    public function write(Request $req)
    {
        
        $input = $req->all();
        
        $comment = new C;
        $comment->comment = $input['comentario'];
        $comment->user()->associate(auth()->user()->id);
        $comment->save();
        
       
        $cmt = C::latest()->first();
        $cmt->contents()->attach($input['id']);
        $content = Content::find($input['id']);
        

        return response()->view('contents.comment', ['content' => $content]);
    }
    
    
}
