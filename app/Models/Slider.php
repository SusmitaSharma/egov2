<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Slider extends BaseModel
{
    public function image() {
    		return $this->image != null
    			? asset($this->upload_path.'sliders/' . $this->image)
    			: asset("no-image.png");
    	}
}
