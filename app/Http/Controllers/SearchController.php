<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->input('cari');
        $posts = Post::where('title','LIKE',"%$query%")->approved()->published()->get();
        return view('search',compact('posts','query'));
    }

    public function loadData(Request $request)
    {
        if ($request->has('q')) {
            $cari = $request->q;
            $posts = Post::where('title','LIKE',"%$cari%")->approved()->published()->get();
            return response()->json($posts);
        }
    }
}
