<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Photo extends BaseModel
{
    public function image() {
    		return $this->image != null
    			? asset($this->upload_path.'gallery/' . $this->image)
    			: asset("no-image.jpg");
    	}



    public function gallery()
    {
    	return $this->belongsTo(Gallery::class);

    }
}
