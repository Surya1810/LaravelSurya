<?php

namespace App\Http\Controllers\Admin;

use App\Models\Subscriber;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SubscriberController extends Controller
{
    public function index()
    {
        $subscribers = Subscriber::latest()->get();
        return view('admin.subscriber',compact('subscribers'));
    }

    public function destroy($subscriber)
    {
        $subscriber = Subscriber::findOrFail($subscriber);
        $subscriber->delete();
        Alert::success('Subscriber Successfully Deleted :)','Success');
        return redirect()->back();
    }
}
