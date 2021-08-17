<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Models\Publication;
use Illuminate\Http\Request;

class PublicationController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
        $this->data['routeType'] = 'publication';

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $this->data['publications'] = Publication::latest()->get();

        return view('admin.publication.view', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->data['edit'] = false;
        return view('admin.publication.create', $this->data);
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
            'title' => 'required|string|max:100',
            'description' => 'nullable|string|max:10000',
            'file' => 'nullable',

        ]);
        $publication = new Publication();
        $publication->title = $request->input('title');
        $publication->description = $request->input('description');
        $publication->published_date=$request->input('publishedDate');
        $publication->status=$request->input('status', 1);
        $image_path_from_public = 'publication';
        if (!is_null($request->file('file'))) {
            $file_name = upload_image($request->file('file'), 'publication', $image_path_from_public);
            $publication->file = $file_name;
        }

        if ($publication->save()) {
            return redirect()->route('publication.index')->with('success_message', 'Data successfully save!');
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
    public function edit(Publication $publication)
    {
        $this->data['edit'] = true;
        $this->data['publication'] = $publication;
        return view('admin.publication.create', $this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Publication $publication)
    {
        $this->validate($request, [
            'title' => 'required|string|max:100',
            'description' => 'nullable|string|max:10000',
            'file' => 'nullable',

        ]);

        $publication->title = $request->input('title');
        $publication->description = $request->input('description');
        $publication->published_date=$request->input('publishedDate');
        $publication->status=$request->input('status', 1);
        $image_path_from_public = 'publication';
        $old_file = $publication->file;
        if (!is_null($request->file('file'))) {

            $file_name = upload_image($request->file('file'), 'publication', $image_path_from_public);
            $publication->file = $file_name;
        }

        if ($publication->save()) {
            return redirect()->route('publication.index')->with('success_message', 'Data successfully updated!');
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
    public function destroy(Publication $publication)
    {
        if ($publication->delete()) {

            return redirect()->back()->with('success_message', 'Data successfully deleted!');

        } else {
            return redirect()->back()->with('error_message', 'Something went worng, please try again!');
        }
    }

    public function download($file_name)
    {
        $file_path = public_path('uploads/publication/' . $file_name);
        return response()->download($file_path);
    }
}
