<?php

namespace App\Http\Controllers;

use App\Models\Subscriber;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;
use Newsletter;

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

        // if (! Newsletter::isSubscribed($request->email)) {
        //     Newsletter::subscribePending($request->email);
        //     // dd($request->email);
        //     Alert::success('Success','Please check your email for next step');
        //     return redirect()->back();
        // }
        // Alert::warning('Error','Sorry, You are already subscribed !');
        // return redirect()->back();

        // if(isset($_POST['submit'])){
        //     $email = $_POST['email'];
        //     if (!empty($email) && !filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
                
        //         $apiKey = '4c301c984f030f7e761eb34cbf7f680f-us7';
        //         $audienceId = '5a6e92f631';

        //         $memberID = md5(strtolower($email));
        //         $dataCenter = substr($apiKey,strpos($apiKey,'-')+1);
        //         $url = 'https://' . $dataCenter . '.api.mailchimp.com/3.0/lists/' . $audienceId . '/members/' . $memberID;

        //         $json = json_encode([
        //             'email_address' => $email,
        //             'status' => 'subscribed'
        //         ]);

        //         $ch = curl_init($url);
        //         curl_setopt($ch, CURLOPT_USERPWD, 'user:' . $apiKey);
        //         curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-type: application/json']);
        //         curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        //         curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        //         curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
        //         curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        //         curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
        //         $result = curl_exec($ch);
        //         $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        //         curl_close($ch);
                
        //         if ($httpCode == 200) {
        //             $_SESSION['msg'] = '<p style="color: #34A853">You have successfully registered to LaravelSurya.</p>';
        //         } else {
        //             switch ($httpCode){
        //                 case 214:
        //                     $msg = 'You are already registered';
        //                     break;
        //                 default:
        //                 $msg = 'Some problem occurred, please try again';
        //                     break;
        //             }
        //             $_SESSION['msg'] = '<p style="color: #EA4335">'.$msg.'</p>';
        //         }
        //     }else{
        //         $_SESSION['msg'] = '<p style="color: #EA4335">Please enter valid email address</p>';
        //     }
        // }
        // return redirect()->back();
    }
    
}
