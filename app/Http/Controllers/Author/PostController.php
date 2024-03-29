<?php

namespace App\Http\Controllers\Author;

use App\Models\Category;
// use App\Notifications\NewAuthorPost;
use App\Models\Tag;
use App\Models\Post;
use App\Models\User;
use RealRashid\SweetAlert\Facades\Alert;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
// use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Auth::user()->posts()->latest()->get();
        return view('author.post.index',compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('author.post.create',compact('categories','tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'title' => 'required',
            'image' => 'required',
            'categories' => 'required',
            'tags' => 'required',
            'body' => 'required',
        ]);
        $image = $request->file('image');
        $slug = str_slug($request->title);
        if(isset($image))
        {
//            make unipue name for image
            $currentDate = Carbon::now()->toDateString();
            $imageName  = $slug.'-'.$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();

            if(!Storage::disk('public')->exists('post'))
            {
                Storage::disk('public')->makeDirectory('post');
            }

            $postImage = Image::make($image)->resize(1600,1066)->stream();
            Storage::disk('public')->put('post/'.$imageName,$postImage);

        } else {
            $imageName = "default.png";
        }
        $post = new Post();
        $post->user_id = Auth::id();
        $post->title = $request->title;
        $post->slug = $slug;
        $post->image = $imageName;
        $post->body = $request->body;
        if(isset($request->status))
        {
            $post->status = true;
        }else {
            $post->status = false;
        }
        $post->is_approved = false;
        $post->save();

        $post->categories()->attach($request->categories);
        $post->tags()->attach($request->tags);

        $users = User::role('admin')->get();
        // Notification::send($users, new NewAuthorPost($post));
        Alert::success('Success','Post Successfully Approved !');
        return redirect()->route('author.post.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // if ($post->user_id != Auth::id())
        // {
        //     Alert::error('Error','You are not authorized to access this post');
        //     return redirect()->back();
        // }
        $post = Post::find($id);
        // dd($post);
        return view('author.post.show',compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // if ($post->user_id != Auth::id())
        // {
        //     Alert::error('Error','You are not authorized to access this post');
        //     return redirect()->back();
        // }
        $post = Post::find($id);
        $categories = Category::all();
        $tags = Tag::all();

        return view('author.post.edit',compact('post','categories','tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // if ($post->user_id != Auth::id())
        // {
        //     Alert::error('Error','You are not authorized to access this post');
        //     return redirect()->back();
        // }
        $post = Post::find($id);
        $this->validate($request,[
            'title' => 'required',
            'image' => 'image',
            'categories' => 'required',
            'tags' => 'required',
            'body' => 'required',
        ]);
        $image = $request->file('image');
        $slug = str_slug($request->title);
        if(isset($image))
        {
//            make unipue name for image
            $currentDate = Carbon::now()->toDateString();
            $imageName  = $slug.'-'.$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();

            if(!Storage::disk('public')->exists('post'))
            {
                Storage::disk('public')->makeDirectory('post');
            }
//            delete old post image
            if(Storage::disk('public')->exists('post/'.$post->image))
            {
                Storage::disk('public')->delete('post/'.$post->image);
            }
            $postImage = Image::make($image)->resize(1600,1066)->stream();
            Storage::disk('public')->put('post/'.$imageName,$postImage);

        } else {
            $imageName = $post->image;
        }

        $post->user_id = Auth::id();
        $post->title = $request->title;
        $post->slug = $slug;
        $post->image = $imageName;
        $post->body = $request->body;
        if(isset($request->status))
        {
            $post->status = true;
        }else {
            $post->status = false;
        }
        $post->is_approved = false;
        $post->save();

        $post->categories()->sync($request->categories);
        $post->tags()->sync($request->tags);

        Alert::warning('Updated','Post Successfully Updated');
        return redirect()->route('author.post.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post, $id)
    {
        $post = Post::findorfail($id);
        $post->delete();
        
        Alert::error('Deleted','Post Successfully Deleted !');
        return redirect()->route('author.post.trashed');

        // if ($post->user_id != Auth::id())
        // {
        //     Toastr::error('You are not authorized to access this post','Error');
        //     return redirect()->back();
        // }
        // if (Storage::disk('public')->exists('post/'.$post->image))
        // {
        //     Storage::disk('public')->delete('post/'.$post->image);
        // }
        // $post->categories()->detach();
        // $post->tags()->detach();
        // $post->delete();
        // Toastr::success('Post Successfully Deleted :)','Success');
        // return redirect()->back();
    }

    // public function destroy(Post $post, $id)
    // {
    //     $post = Post::findorfail($id);
    //     $post->delete();
        
    //     Alert::error('Deleted','Post Successfully Deleted !');
    //     return redirect()->route('author.post.trashed');
    // }

    public function trashed()
    {
        $posts = Post::onlyTrashed()->paginate(10);

        return view ('author.post.trashed',compact('posts'));
    }

    public function restore($id)
    {
        $post = Post::withTrashed()->where('id', $id)->first();
        $post->restore();

        Alert::success('Restored','Post Successfully Restored !');
        return redirect()->route('author.post.index');
    }

    public function kill(Post $post)
    {
        if (Storage::disk('public')->exists('post/'.$post->image))
        {
            Storage::disk('public')->delete('post/'.$post->image);
        }
        $post = Post::withTrashed()->where('id', $id)->first();
        $post->categories()->detach();
        $post->tags()->detach();
        $post->forceDelete();

        Alert::error('Deleted','Post Successfully Deleted !');
        return redirect()->back();
    }

}
