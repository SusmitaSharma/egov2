<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use App\Models\Photo;
use App\Models\Gallery;
use File;

class PhotoController extends BaseController
{

    public function __construct() {
        parent::__construct();
        $this->data['routeType'] = 'photo';
         $this->data['galleries'] = Gallery::latest()->get();


    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->data['photos']=Photo::latest()->get();
        return view('admin.photo.view',$this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->data['edit']=false;
        return view('admin.photo.create',$this->data);
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
            'gallery_id'=>'required|integer'
        ]);



        if($request->has('checkbox'))
        {
            $photo=new Photo();
            $photo->url=$request->input('url');
             $photo->gallery_id=$request->input('gallery_id');
            $photo->save();

        }else
        {
            $images = $request->file('images');
            $image_path_from_public = "gallery";
            if ($images) {


                foreach ($images as $image) {

                    $image_name = upload_image($image,'gallery', $image_path_from_public);

                    $photo=new Photo();
                    $photo->image=$image_name;
                     $photo->gallery_id=$request->input('gallery_id');
                    $photo->save();



                }
        }

        }

        return redirect()->route('photo.index')->with('success_message','Data successfully saved!');




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
    public function edit(Photo $photo)
    {
        $this->data['edit']=true;
        $this->data['model']=$photo;
        return view('admin.photo.create',$this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Photo $photo)
    {
        $this->validate($request,[
            'gallery_id'=>'required|integer'
        ]);
      $photo->gallery_id=$request->input('gallery_id');

      if($request->has('checkbox'))
        {
            $photo->url=$request->input('url');
            $photo->image=null;

        }else
        {
            $photo->url=null;
            $image= $request->file('image');
            $image_path_from_public = "gallery";
            if ($image) {
                  $location=public_path('uploads/gallery/'.$photo->image);
                  File::delete($location);

                    $image_name = upload_image($image,'gallery', $image_path_from_public);
                    $photo->image=$image_name;




        }

        }

         if($photo->save())
        {
            return redirect()->route('photo.index')->with('success_message','Data successfully saved!');

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
    public function destroy(Photo $photo)
    {
       if($photo->delete())
        {
            $location=public_path('uploads/gallery/'.$photo->image);
            File::delete($location);
            return redirect()->route('photo.index')->with('success_message','Data successfully deleted!');

        }else
        {
            return redirect()->back()->with('error_message','Something went wrong, please try again!');

        }
    }
}
