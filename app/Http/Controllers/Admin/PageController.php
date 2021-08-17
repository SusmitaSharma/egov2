<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Models\Page;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PageController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
        $this->data['routeType'] = 'page';

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->data['pages'] = Page::latest()->get();
        return view('admin.page.view', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->data['edit'] = false;
        $this->data['page'] = new Page();
        return view('admin.page.create', $this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $page = new Page();
        if($request->file('file'))
        {
            $file = $request->file('file');
            $filename = time() . '.' . $request->file('file')->extension();
            $filePath = public_path() . '/uploads/pagesFiles/';
            $file->move($filePath, $filename);
            $page->file = $filename;
        }

        $page->title = $request->input(['title_nepali']);
        $page->title_english = $request->input(['title_english']);

        if($request->input(['description']) != null) {
            $page->description = $request->input(['description']);
        }
        if($request->input(['page_type']) == 0){
            $page->slug = Str::slug($request->input(['title_english']));
        } else if ($request->input(['page_type']) == 1) {
            $page->slug = "about";
            $page->page_type = 1;
        } else if ($request->input(['page_type']) == 2) {
            $page->slug = "notice";
            $page->page_type = 2;
        } else if($request->input(['page_type']) == 3) {
            $page->slug = "news";
            $page->page_type = 3;
        } else if($request->input(['page_type']) == 4) {
            $page->slug = "publication";
            $page->page_type = 4;
        } else if($request->input(['page_type']) == 5) {
            $page->slug = "gallery";
            $page->page_type = 5;
        } else if($request->input(['page_type']) == 6) {
            $page->slug = "download";
            $page->page_type = 6;
        } else if ($request->input(['page_type']) == 7) {
            $page->slug = "employee_detail";
            $page->page_type = 7;
        }

        if ($page->save()) {
            return redirect()->route('page.index')->with('success_message', 'Data successfully saved!');

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
    public function edit(Page $page)
    {
        $this->data['edit'] = true;
        $this->data['page'] = $page;
//        dd($this->data['page']);
        return view('admin.page.create', $this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Page $page)
    {

        $this->validate($request, [
            'title' => 'nullable|string|max:255',
        ]);
        if($request->file('file'))
        {
            $file = $request->file('file');
            $filename = time() . '.' . $request->file('file')->extension();
            $filePath = public_path() . '/uploads/pagesFiles/';
            $file->move($filePath, $filename);
            $page->file = $filename;
        }
        $page->title = $request->input('title_nepali');
        $page->title_english = $request->input('title_english');

        if($request->input(['page_type']) == 0){
            $page->slug = Str::slug($request->input(['title_english']));
        } else if ($request->input(['page_type']) == 1) {
            $page->slug = "about";
            $page->page_type = 1;
        } else if ($request->input(['page_type']) == 2) {
            $page->slug = "notice";
            $page->page_type = 2;
        } else if($request->input(['page_type']) == 3) {
            $page->slug = "news";
            $page->page_type = 3;
        } else if($request->input(['page_type']) == 4) {
            $page->slug = "publication";
            $page->page_type = 4;
        } else if($request->input(['page_type']) == 5) {
            $page->slug = "gallery";
            $page->page_type = 5;
        } else if($request->input(['page_type']) == 6) {
            $page->slug = "download";
            $page->page_type = 6;
        } else if ($request->input(['page_type']) == 7) {
            $page->slug = "employee_detail";
            $page->page_type = 7;
        }


        if ($page->save()) {
            return redirect()->route('page.index')->with('success_message', 'Data successfully updated!');

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
    public function destroy(Page $page)
    {
        if ($page->delete()) {

            return redirect()->back()->with('success_message', 'Data successfully deleted!');

        } else {
            return redirect()->back()->with('error_message', 'Something went worng, please try again!');

        }
    }
}
