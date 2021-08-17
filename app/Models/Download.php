<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Download extends BaseModel
{
	use SoftDeletes;
    public function image() {
    		return $this->image!= null
    			? asset($this->upload_path.'download/' . $this->image)
    			: asset("no-image.jpg");
    	}


    public function isImage()
    	{
    		$ext = pathinfo($this->image, PATHINFO_EXTENSION);
    		$image_extension=['tif','bmp','jpg','jpeg','gif','png'];
    		if(in_array($ext, $image_extension))
    		{
    			return true;
    		}else
    		{
    			return false;
    		}

    	}

}
