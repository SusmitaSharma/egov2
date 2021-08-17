<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use App\Models\Gallery;
use Illuminate\Validation\Rule;

class GalleryController extends BaseController
{
    public function __construct() {
        parent::__construct();
        $this->data['routeType'] = 'gallery';
         $this->data['galleries'] = Gallery::latest()->get();


    }
    /**
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $this->data['edit']=false;

        return view('admin.gallery.view',$this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'name'=>'required|string|max:100|unique:galleries'
        ]);

        $gallery=new Gallery();
        $gallery->name=$request->input('name');
        if($gallery->save())
        {
            return redirect()->back()->with('success_message','Data successfully saved!');

        }else
        {
            return redirect()->back()->with('error_message','Something went wrong, please try again!');

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
    public function edit(Gallery $gallery)
    {
        $this->data['edit']=true;
        $this->data['model']=$gallery;
        return view('admin.gallery.view',$this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Gallery $gallery)
    {
        $this->validate($request,[
            'name'=>['required','string','max:100',
            Rule::unique('galleries')->ignore($gallery->id)
            ],
        ]);

        $gallery->name=$request->input('name');
        if($gallery->save())
        {
            return redirect()->route('gallery.index')->with('success_message','Data successfully updated!');

        }else
        {
            return redirect()->back()->with('error_message','Something went wrong, please try again!');

        }


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Gallery $gallery)
    {
        if($gallery->delete())
        {
            return redirect()->route('gallery.index')->with('success_message','Data successfully deleted!');

        }else
        {
            return redirect()->back()->with('error_message','Something went wrong, please try again!');

        }

    }
}
