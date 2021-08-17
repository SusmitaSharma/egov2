<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notify extends BaseModel
{
    protected $table = 'notifies';

    protected  $guarded = [];

    public function image() {
        return $this->image != null
            ? asset($this->upload_path.'notification/' . $this->image)
            : asset("no-image.png");
    }
}
