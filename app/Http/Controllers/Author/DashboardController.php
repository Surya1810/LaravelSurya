<?php

namespace App\Http\Controllers\Author;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $posts = $user->posts;
        $popular_posts = $user->posts()
            ->withCount('comments')
            ->withCount('favorite_to_users')
            ->orderBy('view_count','desc')
            ->orderBy('comments_count')
            ->orderBy('favorite_to_users_count')
            ->take(5)->get();
        $total_trashed = Post::onlyTrashed()->count();
        $all_views = $posts->sum('view_count');
        return view('author.dashboard',compact('posts','popular_posts','total_trashed','all_views'));
    }
}
