<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Download;
use App\Models\Gallery;
use App\Models\Menu;
use App\Models\News;
use App\Models\Notice;
use App\Models\Notify;
use App\Models\Page;
use App\Models\Publication;
use App\Models\Update;
use App\User;

class PageController extends Controller
{
    public function show($slug)
    {
        $this->data['menus'] = Menu::where('status', '1')->get();
        $this->data['update'] = Update::where('status',1)->latest()->first();
        $this->data['office'] = Company::all()->first();
        $this->data['notification'] = Notify::orderBy('id', 'DESC')->first();
        $this->data['company'] = Company::findorFail(1);
        $this->data['notices'] = Notice::latest()->paginate(10);
        $this->data['noticesOthers'] = Notice::skip(10)->take(10)->orderBy('id','DESC')->get();
        $this->data['publications'] = Publication::latest()->paginate(20);
        $this->data['news'] = News::latest()->paginate(12);
        $this->data['newsOthers'] = News::skip(10)->take(10)->orderBy('id','DESC')->get();
        $this->data['downloads'] = Download::latest()->paginate(20);
        $this->data['staffs'] = User::with('profile')->whereHas('roles', function ($q) {
            $q->where('name', 'user');
        })->get()->sortBy('profile.priority');
        $this->data['gallery'] = Gallery::latest()->get();

        $this->data['page'] = Page::where('slug',$slug)->first();
//        dd($this->data['page'] );
        $this->data['staffs'] = User::with('profile')->whereHas('roles', function ($q) {
            $q->where('name', 'user');
        })->get()->sortBy('profile.priority');
        $this->data['galleries'] = Gallery::latest()->get();
        // footer
        $this->data['downloadsFirstThree'] = Download::latest()->paginate(3);
        $this->data['downloadsSecondThree'] = Download::skip(3)->take(3)->orderBy('id','DESC')->get();
//        dd($this->data['gallery'][0]);
        return view()->first(
            ["frontend/{$slug}", 'default'], $this->data);
    }
}
