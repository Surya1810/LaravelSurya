<?php

namespace App\Http\Controllers\Admin;

use App\Models\Comment;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CommentController extends Controller
{
    public function index()
    {
        // $comments = Comment::latest()->get();
        $comments = Comment::latest()->get();
        // dd($comments);
        return view('admin.comments',compact('comments'));
    }

    public function destroy($id)
    {
        Comment::findOrFail($id)->delete();
        Alert::success('Success','Comment Successfully Deleted');
        return redirect()->back();
    }
}
