<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    public function get_province()
    {
        $pradesh = $this->province_no;
        if (!is_null($pradesh)) {
            switch ($pradesh) {
                case 1:
                    return '१';
                    break;
                case 2:
                    return '२';
                    break;
                case 3:
                    return '३';
                    break;
                case 4:
                    return '४';
                    break;
                case 5:
                    return '५';
                    break;
                case 6:
                    return '६';
                    break;
                case 7:
                    return '७';
                    break;
                default:
                    return '१';

            }

        }

    }
}
