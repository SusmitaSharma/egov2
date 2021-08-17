<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Models\Slider;
use File;
use Illuminate\Http\Request;

class SliderController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
        $this->data['routeType'] = 'slider';

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->data['sliders'] = Slider::latest()->get();
        return view('admin.slider.view', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->data['edit'] = false;
        return view('admin.slider.create', $this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//        dd($request->all());
        $data = $request->all();
        if($request->hasFile('image')){
            $this->validate($request, [
                'image' => 'required|mimes:jpg,png,jpeg,gif,svg|max:2048',
            ]);
            $mytime = date('Ymd_His');
            $image = $request->file('image');
            $getimageName = $mytime.'.'.$request->file('image')->getClientOriginalExtension();

            $image->move(public_path('uploads/sliders'), $getimageName);
            $data['image'] = $getimageName;
        }
//        $this->validate($request, [
//            'title' => 'nullable|string|max:255',
//            'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:10000',
//        ]);

        $slider = new Slider();
        $slider->title = $data['title'];
        $slider->image = $data['image'];
        $image_path_from_public = "sliders";
//        if ($image) {
//
//            $image_name = upload_image($image, 'slider', $image_path_from_public);
//            $slider->image = $image_name;
//
//        }

        if ($slider->save()) {
            return redirect()->route('slider.index')->with('success_message', 'Data successfully saved!');

        } else {
            return redirect()->back()->with('error_message', 'Something went worng, please try again!');

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
    public function edit(Slider $slider)
    {
        $this->data['edit'] = true;
        $this->data['model'] = $slider;
        return view('admin.slider.create', $this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Slider $slider)
    {
        $this->validate($request, [
            'title' => 'nullable|string|max:255',
            'image' => 'nullable|image',
        ]);

        $slider->title = $request->input('title');
        $old_image = $slider->image;
        $image = $request->file('image');
        $image_path_from_public = "sliders";
        if ($image) {
            if (!is_null($old_image)) {
                $location = public_path('uploads/sliders/' . $old_image);
                File::delete($location);

            }

            $image_name = upload_image($image, 'slider', $image_path_from_public);
            $slider->image = $image_name;

        }

        if ($slider->save()) {
            return redirect()->route('slider.index')->with('success_message', 'Data successfully updated!');

        } else {
            return redirect()->back()->with('error_message', 'Something went worng, please try again!');

        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Slider $slider)
    {
        if ($slider->delete()) {
            $location = public_path('uploads/sliders/' . $slider->image);
            File::delete($location);
            return redirect()->back()->with('success_message', 'Data successfully deleted!');

        } else {
            return redirect()->back()->with('error_message', 'Something went worng, please try again!');

        }
    }
}
