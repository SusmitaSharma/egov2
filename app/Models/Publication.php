<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Publication extends BaseModel
{
	use SoftDeletes;
    protected $table = 'publications';

     public function image() {
    		return $this->file!= null
    			? asset($this->upload_path.'publication/' . $this->file)
    			: asset("no-image.jpg");
    	}


     public function isImage()
    	{
    		$ext = pathinfo($this->file, PATHINFO_EXTENSION);
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
