<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use App\Models\News;
use File;

class NewsController extends BaseController
{

      public function __construct() {
        parent::__construct();
        $this->data['routeType'] = 'news';

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->data['news'] = News::latest()->get();

        return view('admin.news.view',$this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->data['edit']=false;
        return view('admin.news.create',$this->data);
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
            'title'=>'required|string|max:1000',
//            'description'=>'string|max:10000',
//            'image'=>'nullable|image',
        ]);
        $news=new News();
        $news->title=$request->input('title');
        $news->published_date=$request->input('publishedDate');
        $news->status = $request->input('status', 1);
        if($request->input('description')){
            $news->description=$request->input('description');
        }
        $image_path_from_public = 'news';
        if (!is_null($request->file('image'))) {
            $image_name = upload_image($request->file('image'), 'news', $image_path_from_public);
            $news->image=$image_name;
        }

        if($news->save())
        {
              return redirect()->route('news.index')->with('success_message','Data successfully save!');
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
    public function edit(News $news)
    {
        $this->data['edit']=true;
        $this->data['news']=$news;
        return view('admin.news.create',$this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, News $news)
    {
        $this->validate($request,[
            'title'=>'required|string|max:100',
            'description'=>'string|max:10000',
            'image'=>'nullable|image',


        ]);

        $news->title=$request->input('title');
        $news->description=$request->input('description');
        $news->published_date=$request->input('publishedDate');
        $news->status = $request->input('status', 1);
        $image_path_from_public = 'news';
        $old_image=$news->image;
        if (!is_null($request->file('image'))) {
            if(!is_null($old_image))
            {
                $location=public_path('uploads/news/'.$old_image);
                File::delete($location);
            }
            $image_name = upload_image($request->file('image'), 'news', $image_path_from_public);
            $news->image=$image_name;
        }

        if($news->save())
        {
              return redirect()->route('news.index')->with('success_message','Data successfully updated!');
         }else
        {
            return redirect()->back()->with('error_message','Something went worng, please try again!');

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(News $news)
    {
        if($news->delete())
        {
            $location=public_path('uploads/news/'.$news->image);
            File::delete($location);
             return redirect()->back()->with('success_message','Data successfully deleted!');

        }else
        {
            return redirect()->back()->with('error_message','Something went worng, please try again!');
        }
    }
}
