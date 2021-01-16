<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use App\Models\Subscriber;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;


class DashboardController extends Controller
{
    public function index()
    {

        $user = User::all();
        $subscribers = Subscriber::all();
        $posts = Post::all();
        $popular_posts = Post::withCount('comments')
                            ->withCount('favorite_to_users')
                            ->orderBy('view_count','desc')
                            ->orderBy('comments_count','desc')
                            ->orderBy('favorite_to_users_count','desc')
                            ->take(5)->get();
        $total_pending_posts = Post::where('is_approved',false)->count();
        $all_views = Post::sum('view_count');
        $new_authors_today = User::where('role_id',2)
                                ->whereDate('created_at',Carbon::today())->count();
        $active_authors = User::where('role_id',2)
                                ->withCount('posts')
                                ->withCount('comments')
                                ->withCount('favorite_posts')
                                ->orderBy('posts_count','desc')
                                ->orderBy('comments_count','desc')
                                ->orderBy('favorite_posts_count','desc')
                                ->take(10)->get();
        $category_count = Category::all()->count();
        $tag_count = Tag::all()->count();
        $role = Role::all();
        $permission = Permission::all();

        return view('admin.dashboard',compact('new_authors_today','active_authors','new_authors_today','user','role','permission','posts','subscribers','popular_posts','total_pending_posts','all_views','category_count','tag_count'));
    }
}
//'new_authors_today','active_authors'
