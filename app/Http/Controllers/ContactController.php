<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\Contact;

use App\Mail\ContactMail;
use Mail;

class ContactController extends Controller
{
    public function about()
    {
        // Alert::info('Upsss', 'Sorry, this page under maintenance');
        // return redirect()->route('home');
        return view('contact.about');
    }

    public function email()
    {
        // Alert::info('Upsss', 'Sorry, this page under maintenance');
        // return redirect()->route('home');
        return view('contact.email');
    }

    public function message()
    {
        $messages = Contact::latest()->get();
        return view('contact.message',compact('messages'));
    }

    public function reply($id)
    {
        $message = Contact::find($id);
        return view('contact.reply',compact('message'));
    }

    public function destroy($id)
    {
        Contact::find($id)->delete();

        Alert::error('Deleted','Message Deleted Successfully !');
        return redirect()->back();
    }
    
    public function submit(Request $request)
    {
        // dd($request);
        $this->validate($request,[
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required',
        ]);
        $details = [
            'name' => $request->name,
            'email' => $request->email,
            'subject' => $request->subject,
            'message' => $request->message
        ];

        // Mail::to('surya.10rpl1.2019@gmail.com')->send(new ContactMail($details));
        // Alert::success('Success','Your Message Successfully Sent :)');
        // return back();

        // Mail::send('Contact.emailview',[
        //     'name' => $request->name,
        //     'email' => $request->email,
        //     'message' => $request->message
        // ],function($mail) use($request){
        //     $mail->from(env('MAIL_FROM_ADDRESS'),$request->name);
        //     $mail->to("kantor@gmail.com")->subject('Contact Us Message');
        // });

        $contact = new Contact();
        $contact->name = $request->name;
        $contact->email = $request->email;
        $contact->subject = $request->subject;
        $contact->message = $request->message;
        $contact->save();

        Alert::success('Success','Your Message Successfully Sent :)');
        return back();
    }

    public function send(Request $request)
    {
        $data = array(
            'name' => $request->name,
            'email' => $request->email,
            'message' => $request->message
        );

        // Mail::send('Contact.emailview',[
        //     'message' => $request->message
        // ],function($mail) use($request){
        //     $mail->from('example@gmail.com',$request->name);
        //     $mail->to('kantor@gmail.com')->subject('Contact Us Message');
        // });

        Mail::send('Contact.emailview', compact('data'), function($message) use ($data){
            $message->from('kantor@gmail.com');
            $message->to($data['email']);
            $message->subject('Contact Us Reply');
        });

        Alert::success('Success','Your Message Successfully Sent :)');
        return redirect()->route('admin.message');
    }
}
