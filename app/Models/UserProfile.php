<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserProfile extends BaseModel
{
	protected $guarded=['id'];

    use SoftDeletes;

	public function image() {
    		return $this->image != null
    			? asset($this->upload_path.'users/' . $this->image)
    			: asset("default.png");
    	}


    public function user()
    {
    	return $this->belongsTo(User::class);
    }

    public function designation()
    {
        return $this->belongsTo(Designation::class);
    }
}
