<?php

namespace App\Http\Controllers\Author;

use App\Models\Comment;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function index()
    {
        $posts = Auth::user()->posts;
        // $posts = Auth::user()->posts();
        // dd($posts);
        return view('author.comments',compact('posts'));
    }

    public function destroy($id)
    {
        $comment = Comment::findOrFail($id);
        if ($comment->post->user->id == Auth::id())
        {
            $comment->delete();
            Alert::success('Success','Comment Successfully Deleted');
        } else {
            Alert::error('Access Denied !!!','You are not authorized to delete this comment :(');
        }
        return redirect()->back();
    }
}
