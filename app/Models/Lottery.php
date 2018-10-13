<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lottery extends Model
{

    public function scopeValidateNumbers($query, $data) 
    {
        return $query->whereFirstNumber($data['first'])
            ->whereSecondNumber($data['second'])
            ->whereThirdNumber($data['third']);
    }
}
