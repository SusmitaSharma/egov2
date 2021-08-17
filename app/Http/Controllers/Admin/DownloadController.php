<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use App\Models\Download;

class DownloadController extends BaseController
{

    public function __construct() {
        parent::__construct();
        $this->data['routeType'] = 'download';

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->data['downloads'] = Download::latest()->get();

        return view('admin.download.view',$this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $this->data['edit']=false;
        return view('admin.download.create',$this->data);
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
            'title'=>'required|string|max:100',
            'image'=>'nullable',
        ]);
        $download=new Download();
        $download->title=$request->input('title');
        $image_path_from_public = 'download';
        if (!is_null($request->file('image'))) {
            $file_name = upload_image($request->file('image'), 'download', $image_path_from_public);
            $download->image=$file_name;
        }

        if($download->save())
        {
              return redirect()->route('download.index')->with('success_message','Data successfully save!');
         }else
        {
            return redirect()->back()->with('error_message','Something went worng, please try again!');

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Download $download)
    {
        $this->data['edit']=true;
        $this->data['download']=$download;
        return view('admin.download.create',$this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Download $download)
    {
        $this->validate($request,[
            'title'=>'required|string|max:100',
            'image'=>'nullable',


        ]);

        $download->title=$request->input('title');
        $image_path_from_public = 'download';
        $old_file=$download->image;
        if (!is_null($request->file('image'))) {

            $file_name = upload_image($request->file('image'), 'download', $image_path_from_public);
            $download->image=$file_name;
        }

        if($download->save())
        {
              return redirect()->route('download.index')->with('success_message','Data successfully updated!');
         }else
        {
            return redirect()->back()->with('error_message','Something went worng, please try again!');

        }
    }

     public function destroy(Download $download)
    {
        if($download->delete())
        {

             return redirect()->back()->with('success_message','Data successfully deleted!');

        }else
        {
            return redirect()->back()->with('error_message','Something went worng, please try again!');
        }
    }

    public function download($file_name) {
          $file_path = public_path('uploads/download/'.$file_name);
          return response()->download($file_path);
    }
}
