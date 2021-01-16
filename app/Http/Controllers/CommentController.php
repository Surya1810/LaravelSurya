<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request,$post)
    {
        $this->validate($request,[
            'comment' => 'required'
        ]);

        $comment = new Comment();
        $comment->post_id = $post;
        $comment->user_id = Auth::id();
        $comment->comment = $request->comment;
        $comment->save();
        Alert::success('Success','Comment Successfully Published');
        return redirect()->back();
    }
}