<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
// use App\Notifications\AuthorPostApproved;
// use App\Notifications\NewPostNotify;
use App\Models\Subscriber;
use App\Models\Tag;
use App\Models\Post;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
// use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use RealRashid\SweetAlert\Facades\Alert;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::latest()->get();
        return view('admin.post.index',compact('posts'));
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
        $User = User::all();
        return view('admin.post.create',compact('categories','tags','User'));
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
        $post->is_approved = true;
        $post->save();

        $post->categories()->attach($request->categories);
        $post->tags()->attach($request->tags);

        // $subscribers = Subscriber::all();
        // foreach ($subscribers as $subscriber)
        // {
        //     Notification::route('mail',$subscriber->email)
        //         ->notify(new NewPostNotify($post));
        // }

        Alert::success('Success','Post Successfully Saved !');
        return redirect()->route('admin.post.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {        
        // Alert::info('Upsss', 'Sorry, this page under maintenance');
        // return redirect()->back();
        $post = Post::find($id);

        // dd($post);
        return view('admin.post.show',compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);
        $categories = Category::all();
        $tags = Tag::all();
        // Alert::info('Upsss', 'Sorry, this page under maintenance');
        // return redirect()->back();
        // dd($post);
        return view('admin.post.edit',compact('post','categories','tags'));
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
        $post->is_approved = true;
        $post->save();

        $post->categories()->sync($request->categories);
        $post->tags()->sync($request->tags);

        Alert::warning('Updated','Post Successfully Updated');
        return redirect()->route('admin.post.index');
    }

    public function pending()
    {
        $posts = Post::where('is_approved',false)->get();
        return view('admin.post.pending',compact('posts'));
    }

    public function approval(Post $post, $id)
    {
        // $post = Post::find($id);
        $post = Post::findorfail($id);
        
        if ($post->is_approved == false)
        {
            $post->is_approved = true;
            $post->save();
            // $post->user->notify(new AuthorPostApproved($post));

        // $subscribers = Subscriber::all();
        // foreach ($subscribers as $subscriber)
        // {
        //     Notification::route('mail',$subscriber->email)
        //         ->notify(new NewPostNotify($post));
        // }

            Alert::success('Approved','Post Successfully Approved !');
        } else {
            Alert::info('Upsss','This Post is already approved');
        }
        return redirect()->back();
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
        // return redirect()->route('admin.post.trashed');
        return redirect()->back();
    }

    public function trashed()
    {
        $posts = Post::onlyTrashed()->get();

        return view ('admin.post.trashed',compact('posts'));
    }

    public function restore($id)
    {
        $post = Post::withTrashed()->where('id', $id)->first();
        $post->restore();

        Alert::success('Restored','Post Successfully Restored !');
        return redirect()->route('admin.post.index');
    }

    public function kill(Post $post, $id)
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

    // public function post()
    // {
    //     $posts = Post::latest()->approved()->published()->paginate(6);
    //     return view('posts',compact('posts'));
    // }
}
