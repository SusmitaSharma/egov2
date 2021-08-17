<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Download;
use App\Models\Gallery;
use App\Models\Menu;
use App\Models\News;
use App\Models\Notice;
use App\Models\Notify;
use App\Models\Publication;
use App\Models\Slider;
use App\Models\Update;
use App\User;

class HomeController extends Controller
{

    public function __construct()
    {

        $this->data['company'] = Company::findorFail(1);

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $request = $this->data['sliders'] = Slider::latest()->get();
        $this->data['suchana_adhikari'] = User::with('profile')->whereHas('profile.designation', function ($q) {
            $q->where('id', '9');
        })->first();

        $this->data['staffs'] = User::with('profile')->whereHas('roles', function ($q) {
            $q->where('name', 'user');
        })->whereHas('profile.designation', function ($q) {
            $q->where('id', '!=', '9');
        })->limit(3)->get()->sortBy('profile.priority');
        //update notice
        $this->data['update'] = Update::where('status',1)->latest()->first();
        $this->data['galleries'] = Gallery::latest()->get();
        $this->data['menus'] =Menu::where('status','1')->get();
        $this->data['office'] = Company::all()->first();
        $this->data['notification'] = Notify::where('status', 1)->first();
        $this->data['news'] = Notice::orderBy('id','DESC')->get();
        $this->data['publication'] = Publication::latest()->paginate(5);
        $this->data['downloadsFirstThree'] = Download::latest()->paginate(3);
        $this->data['downloadsSecondThree'] = Download::skip(3)->take(3)->orderBy('id','DESC')->get();
        return view('frontend.home', $this->data);
    }

    public function about()
    {
        $this->data['office'] = Company::all()->first();
        $this->data['menus'] =Menu::where('status','1')->get();
        $this->data['notification'] = Notify::orderBy('id', 'DESC')->first();
        return view('frontend.about', $this->data);
    }

    public function employeeDetail()
    {
        $this->data['staffs'] = User::with('profile')->whereHas('roles', function ($q) {
            $q->where('name', 'user');
        })->get()->sortBy('profile.priority');
        $this->data['galleries'] = Gallery::latest()->get();
        return view('frontend.employee_detail', $this->data);

    }

    public function notice()
    {
        $this->data['notices'] = Notice::latest()->paginate(20);
        return view('frontend.notice', $this->data);

    }

    public function noticeDownload($file_name)
    {
        $file_path = public_path('uploads/notice/' . $file_name);
        return response()->download($file_path);
    }

    public function publication()
    {
        $this->data['publications'] = Publication::latest()->paginate(20);
        return view('frontend.publication', $this->data);

    }
    public function publicationDownload($file_name)
    {
        $file_path = public_path('uploads/publication/' . $file_name);
        return response()->download($file_path);
    }

    public function download()
    {
        $this->data['downloads'] = Download::latest()->paginate(20);

        return view('frontend.download', $this->data);

    }

    public function fileDownload($file_name)
    {
        $file_path = public_path('uploads/download/' . $file_name);
        return response()->download($file_path);

    }

    public function defaultFileDownload($file_name)
    {
        $file_path = public_path('uploads/pagesFiles/' . $file_name);
        return response()->download($file_path);

    }

    public function contact()
    {

        return view('frontend.contact', $this->data);

    }

    public function news()
    {
        $this->data['news'] = News::latest()->paginate(12);
        return view('frontend.news', $this->data);

    }

    public function newsDownload($fileName){
        $file_path = public_path('uploads/news/' . $fileName);
        return response()->download($file_path);
    }

    public function newsDetail($id)
    {
        $this->data['detail'] = News::find($id);
        return view('frontend.news_detail', $this->data);

    }


    public function galleryImages($gallery)
    {
        $this->data['suchana_adhikari'] = User::with('profile')->whereHas('profile.designation', function ($q) {
            $q->where('id', '9');
        })->first();
        $this->data['staffs'] = User::with('profile')->whereHas('roles', function ($q) {
            $q->where('name', 'user');
        })->whereHas('profile.designation', function ($q) {
            $q->where('id', '!=', '9');
        })->limit(3)->get()->sortBy('profile.priority');

        $this->data['galleries'] = Gallery::latest()->get();
        $this->data['menus'] =Menu::where('status','1')->get();
        $this->data['office'] = Company::all()->first();
        $this->data['notification'] = Notify::where('status', 1)->first();
        $this->data['news'] = Notice::orderBy('id','DESC')->get();

        $this->data['gallery'] = Gallery::find($gallery);
        //update notice
        $this->data['update'] = Update::where('status',1)->latest()->first();

//        dd($gallery);
        //footer
        $this->data['downloadsFirstThree'] = Download::latest()->paginate(3);
        $this->data['downloadsSecondThree'] = Download::skip(3)->take(3)->orderBy('id','DESC')->get();
        return view('frontend.home_gallery', $this->data);

    }
}
