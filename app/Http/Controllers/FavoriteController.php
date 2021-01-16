<?php

namespace App\Http\Controllers;

use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    public function add($post)
    {
        $user = Auth::user();
        $isFavorite = $user->favorite_posts()->where('post_id',$post)->count();

        if ($isFavorite == 0)
        {
            $user->favorite_posts()->attach($post);
            Alert::success('Success','Post successfully added to your favorite list !');
            return redirect()->back();
        } else {
            $user->favorite_posts()->detach($post);
            Alert::success('Success','Post successfully removed form your favorite list');
            return redirect()->back();
        }
    }
}
