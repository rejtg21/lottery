<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Lottery;
use Carbon\Carbon;

class ConfirmLottery extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $result = Lottery::validateNumbers($this->all())->first();

        if(!EMPTY($result)) {
            throw new \Exception(trans('lottery.error.exists', [
                'date' => $result->created_at->format('M d Y h:i:s A')
            ]));
        }
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'first' => 'required',
            'second' => 'required',
            'third' => 'required',
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
