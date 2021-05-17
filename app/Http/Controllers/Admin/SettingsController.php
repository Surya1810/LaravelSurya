<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Spatie\Permission\Models\Role;
use RealRashid\SweetAlert\Facades\Alert;



class SettingsController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $roles = $user->getRoleNames();
// dd($roles);
        return view('admin.settings',compact('user','roles'));
    }

    public function updateProfile(Request $request)
    {
        $this->validate($request,[
            'name' => 'required',
            'email' => 'required|email',
            'username' => 'required',
            'phone' => 'required',
            'image' => 'required|image',
        ]);
        $image = $request->file('image');
        $slug = str_slug(Auth::user()->name);
        $user = User::findOrFail(Auth::id());
        // dd($image);
        if (isset($image))
        {
            $currentDate = Carbon::now()->toDateString();
            $imageName = $slug.'-'.$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();
            if (!Storage::disk('public')->exists('profile'))
            {
            Storage::disk('public')->makeDirectory('profile');
            }
//            Delete old image form profile folder
            if (Storage::disk('public')->exists('profile/'.$user->image))
            {
                Storage::disk('public')->delete('profile/'.$user->image);
            }
            $profile = Image::make($image)->resize(500,500)->stream();
            Storage::disk('public')->put('profile/'.$imageName,$profile);
        } else {
            $imageName = $user->image;
        }
        $user->name = $request->name;
        $user->username = $request->username;
        $user->phone = $request->phone;
        $user->email = $request->email;
        $user->image = $imageName;
        $user->about = $request->about;
        $user->save();
        // $user = User::findOrFail(Auth::id());
        // $user->update($request->all());
        
        Alert::success('Success','Your Profile Successfully Updated :)');
        return redirect()->back();
    }

    public function updatePassword(Request $request)
    {
        $this->validate($request,[
            'old_password' => 'required',
            'password' => 'required|confirmed',
        ]);

        $hashedPassword = Auth::user()->password;
        if (Hash::check($request->old_password,$hashedPassword))
        {
            if (!Hash::check($request->password,$hashedPassword))
            {
                $user = User::find(Auth::id());
                $user->password = Hash::make($request->password);
                $user->save();
                Alert::success('Password Successfully Changed','Success');
                Auth::logout();
                return redirect('/login');
            } else {
                Alert::error('Error','New password cannot be the same as old password');
                return redirect()->back();
            }
        } else {
            Alert::error('Error','Current password not match.');
            return redirect()->back();
        }

    }
    
    public function profileimage(Request $request)
    {
        $this->validate($request,[
            'image' => 'required',
        ]);

        $image = $request->file('image');
        $slug = str_slug($request->name);
        $user = User::findOrFail(Auth::id());
        if (isset($image))
        {
            $currentDate = Carbon::now()->toDateString();
            $imageName = $slug.'-'.$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();
            if (!Storage::disk('public')->exists('profile'))
            {
            Storage::disk('public')->makeDirectory('profile');
            }
//            Delete old image form profile folder
            if (Storage::disk('public')->exists('profile/'.$user->image))
            {
                Storage::disk('public')->delete('profile/'.$user->image);
            }
            $profile = Image::make($image)->resize(500,500)->stream();
            Storage::disk('public')->put('profile/'.$imageName,$profile);
        } else {
            $imageName = $user->image;
        }

        $user->image = $imageName;
        $user->save();

        Alert::success('Success','Your Profile Successfully Updated :)');
        return redirect()->back();
    }

}
