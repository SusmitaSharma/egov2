<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class News extends BaseModel
{
    public function image() {
    		return $this->image != null
    			? asset($this->upload_path.'news/' . $this->image)
    			: asset("no-image.jpg");
    	}
}
