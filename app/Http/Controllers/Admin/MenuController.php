<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Models\Page;
use Illuminate\Http\Request;
use App\Models\Menu;

class MenuController extends BaseController
{

    public function __construct()
    {
        parent::__construct();
        $this->data['routeType'] = 'menu';
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->data['menus'] = Menu::all();

        return view('admin.menu.index',$this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->data['edit']=false;
        $this->data['menus'] = Menu::all();
        $this->data['pages'] = Page::all();
        return view('admin.menu.create',$this->data);
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
            'name'=>'required|string|max:100',
        ]);
        $menu = new Menu();
        $menu->name = $request->input('name');
        $menu->parent_id = $request->input('parent_id');
        $menu->page_id = $request->input('page_id');
        $menu->status = $request->input('status', 1);

        if($menu->save())
        {
            return redirect()->route('menu.index')->with('success_message','Data successfully save!');
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
    public function edit(Menu $menu)
    {
        $this->data['edit']=true;
        $this->data['menu'] = $menu;
        $this->data['menus'] = Menu::all();
        $this->data['pages'] = Page::all();

        return view('admin.menu.create',$this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Menu $menu)
    {
        $this->validate($request,[
            'name'=>'required|string|max:100',
        ]);

        $menu->name = $request->input('name');
        $menu->parent_id = $request->input('parent_id');
        $menu->page_id = $request->input('page_id');
        $menu->status = $request->input('status', 1);

        if($menu->save())
        {
            return redirect()->route('menu.index')->with('success_message','Data successfully updated!');
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
    public function destroy(Menu $menu)
    {
        if($menu->delete())
        {
            return redirect()->back()->with('success_message','Data successfully deleted!');

        }else
        {
            return redirect()->back()->with('error_message','Something went worng, please try again!');
        }
    }
}
