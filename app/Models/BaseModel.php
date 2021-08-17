<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{

    protected $default_pagination_limit = 5;
    protected $guarded = ['id'];
    protected $upload_path = "uploads/";
    public function created_at($format = 'M d, h:i a')
    {
        return $this->created_at->format($format);
    }

    public function updated_at($format = 'M d, h:i a')
    {
        return $this->updated_at->format($format);
    }

}
