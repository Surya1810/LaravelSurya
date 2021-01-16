<?php

namespace App\Http\Controllers;

use App\models\Subscriber;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;

class SubscriberController extends Controller
{
    public function store(Request $request)
    {
        $this->validate($request,[
            'email' => 'required|email|unique:subscribers'
        ]);

        $subscriber = new Subscriber();
        $subscriber->email = $request->email;
        $subscriber->save();
        Alert::success('Success','You Successfully added to our subscriber list');
        return redirect()->back();
    }
    
}
