<?php

namespace App\Http\Controllers\Admin;

use App\Models\PageType;
use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;

class PageTypeController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
        $this->data['routeType'] = 'pageType';

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->data['pageTypes'] = PageType::latest()->get();
        return view('admin.pageType.view', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->data['edit'] = false;
        return view('admin.pageType.create', $this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $pageType = new PageType();

        $pageType->name = $request->input(['name']);
        $pageType->status = 1;


        if ($pageType->save()) {
            return redirect()->route('pageType.index')->with('success_message', 'Data successfully saved!');

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
    public function edit(PageType $pageType)
    {
        $this->data['edit'] = true;
        $this->data['pageType'] = $pageType;
        return view('admin.pageType.create', $this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PageType $pageType)
    {
        $this->validate($request, [
            'name' => 'nullable|string|max:255',
        ]);

        $pageType->name= $request->input('name');
        $pageType->status = 1;


        if ($pageType->save()) {
            return redirect()->route('pageType.index')->with('success_message', 'Data successfully updated!');

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
    public function destroy(PageType $pageType)
    {
        if ($pageType->delete()) {

            return redirect()->back()->with('success_message', 'Data successfully deleted!');

        } else {
            return redirect()->back()->with('error_message', 'Something went worng, please try again!');

        }
    }
}
