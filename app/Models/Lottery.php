<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lottery extends Model
{

//     1 2 3
//     2 3 1
//     3 1 2
    
//     3 2 1
//     2 1 3
//     1 3 2

    // 1 2 3 4
    // 2 3 4 1
    // 3 4 1 2
    // 4 1 2 3

    // 4 3 2 1
    // 3 2 1 4
    // 2 1 4 3
    // 1 4 3 2

    public function scopeValidateNumbers($query, $data) 
    {
        $length = count($data);
        $bindings = [];

        $whereString = '';
        $suffix = 'OR ';
        // the sequence is if 3 numbers there are 6 combinations
        
        // first 3 combination
        $originalData = $data;
        for($x = 0; $x < $length; $x++) {
            $whereString .= '(first_number = ? AND second_number = ? AND third_number = ?) ';
        
            $bindings = array_merge($bindings, $originalData);
            // get the last data and remove in array
            $lastData = array_pop($originalData);
            // then put it in front
            array_unshift($originalData, $lastData);
            
            $whereString.=$suffix;
        }

        // then the other 3 is reverse
        $reverse = array_reverse($data);
        for($x = 0; $x < $length; $x++) {
            $whereString .= '(first_number = ? AND second_number = ? AND third_number = ?) ';
            $bindings = array_merge($bindings, $reverse);

            // get the last data and remove in array
            $lastData = array_pop($reverse);
            // then put it in front
            array_unshift($reverse, $lastData);

            // if the last array do not and suffix
            if($x!=$length - 1 )
                $whereString.=$suffix;
        }

        // utilize bindings when using a mysql raw query
        return $query->whereRaw($whereString, $bindings);
    }
}
