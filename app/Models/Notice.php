<?php

namespace App\Models;

class Notice extends BaseModel
{
    public function image()
    {
        return $this->image != null
        ? asset($this->upload_path . 'notice/' . $this->image)
        : asset("no-image.jpg");
    }

    public function isImage()
    {
        $ext = pathinfo($this->image, PATHINFO_EXTENSION);
        $image_extension = ['tif', 'bmp', 'jpg', 'jpeg', 'gif', 'png'];
        if (in_array($ext, $image_extension)) {
            return true;
        } else {
            return false;
        }

    }

}
