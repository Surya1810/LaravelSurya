<?php

namespace App\Http\Controllers;


use Auth;
use Nexmo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OtpController extends Controller
{
    public function send()
    {
        $basic  = new \Nexmo\Client\Credentials\Basic('082dffac', 'TKzpefuAgI3lk5Zm');
        $client = new \Nexmo\Client($basic);
        $data = Auth::user();

        // dd($data['phone']);
        $verification = $client->verify()->start([ 
        'number' => '6289512776878',
        'brand'  => 'LaravelSurya',
        'code_length'  => '6',
        ]);
        session (['nexmo_request_id' => $verification->getRequestId()]);

        return view('auth.otp');
    }
            // 'number' => $data['phone'],

    public function verify(Request $request)
    {
        $this->validate($request, [
            'code' => 'size:6'
        ]);

        $basic  = new \Nexmo\Client\Credentials\Basic('082dffac', 'TKzpefuAgI3lk5Zm');
        $client = new \Nexmo\Client($basic);

        $request_id = session('nexmo_request_id');
        $verification = new \Nexmo\Verify\Verification($request_id);

        $result = $client->verify()->check($verification, $request->code);

        $date = date_create();
        DB::table('users')->where('id', Auth::id())->update(['email_verified_at' => date_format($date, 'Y-m-d H:i:s')]);

        return redirect()->route('/');
    }

    public function resend()
    {
        $basic  = new \Nexmo\Client\Credentials\Basic('082dffac', 'TKzpefuAgI3lk5Zm');
        $client = new \Nexmo\Client($basic);
        $verification = new \Nexmo\Verify\Verification($request_id);
        $data = Auth::user();

        $result = $client->verify()->cancel($verification);

        // dd($data['phone']);
        $verification = $client->verify()->start([ 
        'number' => '6289512776878',
        'brand'  => 'LaravelSurya',
        'code_length'  => '6',
        ]);
        session (['nexmo_request_id' => $verification->getRequestId()]);

        return view('auth.otp');
    }

    public function show()
    {
        return view('auth.otp');
    }
}
