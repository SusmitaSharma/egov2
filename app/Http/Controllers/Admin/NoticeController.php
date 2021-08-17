<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Models\Notice;
use File;
use Illuminate\Http\Request;

class NoticeController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
        $this->data['routeType'] = 'notice';

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->data['notices'] = Notice::latest()->get();
        return view('admin.notice.view', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->data['edit'] = false;
        return view('admin.notice.create', $this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:10000',
            'image' => 'nullable',
            'published_date' => 'nullable',

        ]);
        $notice = new Notice();
        $notice->title = $request->input('title');
        $notice->description = $request->input('description');
        $notice->published_date = $request->input('publishedDate');
        $notice->status = $request->input('status', 1);
        $image_path_from_public = 'notice';
        if (!is_null($request->file('image'))) {
            $image_name = upload_image($request->file('image'), 'notice', $image_path_from_public);
            $notice->image = $image_name;
        }

        if ($notice->save()) {
            return redirect()->route('notice.index')->with('success_message', 'Data successfully save!');
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
    public function edit(Notice $notice)
    {
        $this->data['edit'] = true;
        $this->data['notice'] = $notice;
        return view('admin.notice.create', $this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Notice $notice)
    {

        $this->validate($request, [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:10000',
            'image' => 'nullable',
            'published_date' => 'nullable',

        ]);

        $notice->title = $request->input('title');
        $notice->description = $request->input('description');
        $notice->published_date = $request->input('publishedDate');
        $notice->status = $request->input('status', 1);
        $image_path_from_public = 'notice';
        $old_image = $notice->image;
        if (!is_null($request->file('image'))) {
            if (!is_null($old_image)) {
                $location = public_path('uploads/notice/' . $old_image);
                File::delete($location);
            }
            $image_name = upload_image($request->file('image'), 'news', $image_path_from_public);
            $notice->image = $image_name;
        }

        if ($notice->save()) {
            return redirect()->route('notice.index')->with('success_message', 'Data successfully updated!');
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
    public function destroy(Notice $notice)
    {
        if ($notice->delete()) {
            $location = public_path('uploads/notice/' . $notice->image);
            File::delete($location);
            return redirect()->back()->with('success_message', 'Data successfully deleted!');

        } else {
            return redirect()->back()->with('error_message', 'Something went worng, please try again!');
        }
    }

    public function download($file_name)
    {
        $file_path = public_path('uploads/notice/' . $file_name);
        return response()->download($file_path);
    }

}
