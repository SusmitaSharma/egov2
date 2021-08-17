<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Models\Notify;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use File;

class NotifyController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
        $this->data['routeType'] = 'notify';

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->data['notifications'] = Notify::latest()->get();
        return view('admin.notification.view', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->data['edit'] = false;
        return view('admin.notification.create', $this->data);
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
            'remarks' => 'nullable|string|max:255',
            'image' => 'nullable',

        ]);
        $notification = new Notify();
        $notification->title = $request->input('title');
        $notification->company_id = $request->input('company_id');
        $notification->remarks = $request->input('remarks');
        $image_path_from_public = 'notification';
        if (!is_null($request->file('image'))) {
            $image_name = upload_image($request->file('image'), 'notification', $image_path_from_public);
            $notification->image = $image_name;
        }

        if ($notification->save()) {
            return redirect()->route('notification.index')->with('success_message', 'Data successfully save!');
        } else {
            return redirect()->back()->with('error_message', 'Something went wrong, please try again!');

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
    public function edit(Notify $notification)
    {
        $this->data['edit'] = true;
        $this->data['notification'] = $notification;
        return view('admin.notification.create', $this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Notify $notification)
    {

        $this->validate($request, [
            'title' => 'required|string|max:255',
            'remarks' => 'nullable|string|max:255',
            'image' => 'nullable',

        ]);

        $notification->title = $request->input('title');
        $notification->remarks = $request->input('remarks');
        $image_path_from_public = 'notification';
        $old_image = $notification->image;
        if (!is_null($request->file('image'))) {
            if (!is_null($old_image)) {
                $location = public_path('uploads/notification/' . $old_image);
                File::delete($location);
            }
            $image_name = upload_image($request->file('image'), 'notification', $image_path_from_public);
            $notification->image = $image_name;
        }

        if ($notification->save()) {
            return redirect()->route('notification.index')->with('success_message', 'Data successfully updated!');
        } else {
            return redirect()->back()->with('error_message', 'Something went wrong, please try again!');

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Notify $notification)
    {
        if ($notification->delete()) {
            $location = public_path('uploads/notification/' . $notification->image);
            File::delete($location);
            return redirect()->back()->with('success_message', 'Data successfully deleted!');

        } else {
            return redirect()->back()->with('error_message', 'Something went wrong, please try again!');
        }
    }

        public function changeStatus($id)
        {
            $modal = Notify::findorfail($id);
            if($modal->status == 0){
                $modal->status = 1;
            }
            else{
                $modal->status = 0;
            }
            $modal->save();
            return json_encode($modal);
        }
}
