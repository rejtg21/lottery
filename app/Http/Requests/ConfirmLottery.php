<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Lottery;
use Carbon\Carbon;

use Exception;

class ConfirmLottery extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $input = [
            $this->first,
            $this->second,
            $this->third
        ];
        
        return $this->_validateRepetitive($input) && $this->_validateExist($input);
        // return $this->_validateRepetitive($first, $second, $third);
    }

    public function _validateExist($input) {
        $result = Lottery::validateNumbers($input)->first();


        if(!EMPTY($result)) {
            throw new Exception(trans('lottery.error.exists', [
                'date' => $result->created_at->format('M d Y h:i:s A')
            ]));
        }
        return true;
    }

    public function _validateRepetitive($input) 
    {
        $length = count($input) - 1;

        // dynamically compare the number of input
        // if in case the setup is 4 numbers this program is ready 
        for($x = 0; $x <= $length; $x++) {
            for($y = $x+1;$y <= $length; $y++) {
                if($input[$x] == $input[$y])
                    throw new Exception('There is a repetitive number');
            }
        }
        // if there is no repetitive number allow
        return true;
        // it is the same setup as this 
        // 1 = 1-2, 1-3, 1-4, 1-5, 1-6
        // 2 = 2-3, 2-4, 2-5, 2-6,
        // 3 = 3-4, 3-5, 3-6
        // 4 = 4-5, 4-6
        // 5 = 5-6,
        // 6 = 
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $config = config('lottery.numbers');
        $condition = "required|numeric|min:{$config['min']}|max:{$config['max']}";

        return [
            'first' => $condition,
            'second' => $condition,
            'third' => $condition,
        ];
    }

    public function messages() 
    {
        $validation = trans('lottery.validation.required');
        return [
            'first.required' => $validation,
            'second.required' => $validation, 
            'third.required' => $validation 
        ];
    }
}
