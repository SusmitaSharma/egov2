<?php

namespace App\Models;

class Gallery extends BaseModel
{

    public function images()
    {
        return $this->hasMany(Photo::class);

    }

    public function first_image()
    {

        return $this->images->count() > 0
        ? asset($this->upload_path . 'gallery/' . $this->images[0]->image)
        : asset("no-image.jpg");
    }
}
