<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Models\Notice;
use App\Models\Update;
use File;
use Illuminate\Http\Request;

class UpdateController extends BaseController
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
        $this->data['notices'] = Update::latest()->get();
        return view('admin.update.view', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->data['edit'] = false;
        return view('admin.update.create', $this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $notice = new Update();
        $notice->update_title = $request->input('title');

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
    public function edit(Update $update)
    {
        $this->data['edit'] = true;
        $this->data['notice'] = $update;
        return view('admin.update.create', $this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Update $update)
    {
        $update->update_title = $request->input('title');
        $update->status = $request->input('status');

        if ($update->save()) {
            return redirect()->route('update.index')->with('success_message', 'Data successfully updated!');
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
