<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Page extends BaseModel
{
    protected $table = 'pages';
    protected $guarded = [];

    public static function findBySlug($slug){
        return new Page([
           'title' => Str::title(str_replace('-','',$slug)),
            'content' => "This is sample dynamic page for testing. On bended knee is no way to be free, Lifting up and empty cup i ask silently.",
            'slug'=>$slug
        ]);
    }

    public function menu()
    {
        return $this->hasOne('App\Models\Menu', 'page_id', 'id');
    }

//    public function image() {
//        return $this->image != null
//            ? asset($this->upload_path.'pagesFiles/' . $this->image)
//            : asset("no-image.jpg");
//    }


}
