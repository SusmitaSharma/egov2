<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Designation extends BaseModel
{
   use SoftDeletes;



    public function getData($requestData = []) {

        $limit = $this->default_pagination_limit;
        $page = 1;
        $output = [];
        if (isset($requestData['page']) && !empty($requestData['page'])) {
            $page = $requestData['page'];
        }
        $offset = ($page-1)*$limit;
        $query = $this->query();

        if (isset($requestData['name']) && !empty($requestData['name'])) {
            $name = '%'.$requestData['name'].'%';
            $query->where('name','like',$name);
        }
        $totalData = $query->count();

        $result = $query->offset($offset)->limit($limit)->orderBy('created_at','DESC')->get();
        $output['result'] = $result;
        $output['totalData'] = $totalData;
        return $output;
    }


    public function profile()
    {
        return $this->hasMany(UserProfile::class,'designation_id');
    }
}
