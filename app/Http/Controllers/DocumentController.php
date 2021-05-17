<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\Documents;


class DocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $files = Documents::latest()->get();
        return view('admin.document.index',compact('files'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.document.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $data = new Documents;
        // if ($request->file('file')) {
        //     $file = $request->file('file');
        //         $filename = time().'.'.$file->getClientOriginalExtension();
        //         $request->file->move('storage/document'.$filename);
        // }
        $this->validate($request,[
            'title' => 'required',
            'file' => 'required|file',
            'description' => 'required',
        ]);
        $data = new Documents;
        $file = $request->file('file');
        $slug = str_slug($request->title);
        if (isset($file))
        {
            $currentDate = Carbon::now()->toDateString();
            $fileName = $slug.'-'.$currentDate.'-'.uniqid().'.'.$file->getClientOriginalExtension();
            if (!Storage::disk('public')->exists('document'))
            {
            Storage::disk('public')->makeDirectory('document');
            }
            // Storage::disk('public')->put('document/'.$fileName,$file);
            $file->move('storage/document/',$fileName);

            $data->file = $fileName;
        }

        $data->title = $request->title;
        $data->description = $request->description;
        $data->save();
        
        Alert::success('Success','Your File Successfully Uploaded :)');
        return redirect()->route('admin.document.index');
    }

    public function document()
    {
        $posts = Documents::all();
        return view('admin.document.view',compact('posts'));
    }

        public function download($id)
    {
        $file = Documents::find($id);
        // dd($file);
        return Storage::download('public/document/'.$file->file);
    }

        public function downloadlogin($id)
    {
        $file = Documents::find($id);
        // dd($file);
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        return Storage::download('public/document/'.$file->file);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $file = Documents::find($id);
        return view('admin.document.detail',compact('file'))->with('id',$id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $file = Documents::find($id);
        return view('admin.document.edit',compact('file'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $file = Documents::find($id);

        if(isset($request->login))
        {
            $file->login = true;
        }else {
            $file->login = false;
        }
        $file->save();

        return redirect()->route('admin.document.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Documents $document, $id)
    {
        $document = Documents::find($id);
        if (Storage::disk('public')->exists('document/'.$document->file))
        {
            Storage::disk('public')->delete('document/'.$document->file);
        }
        $document->forceDelete();

        Alert::error('Deleted','Post Successfully Deleted !');
        return redirect()->back();
    }
}
