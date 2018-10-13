<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Lottery;

use App\Http\Requests\ConfirmLottery;

class LotteryController extends Controller
{
    public function index() 
    {
        $numbers = config('lottery.numbers');

        return view('lottery', compact('numbers'));
    }

    public function generate() 
    {
        // fetch all lottery from sql
        $lotteries = Lottery::get();

        $randomNumbers = [
            'first' => $this->_generateNumber('first_number', $lotteries),
            'second' => $this->_generateNumber('second_number', $lotteries),
            'third' => $this->_generateNumber('third_number', $lotteries),
        ];

        return $randomNumbers;
    }

    private function _generateNumber($column, $data) 
    {
        $recordedNumbers = $data->pluck($column)->toArray();
        $limit = config('lottery.numbers');

        $generatedNumber = $this->_regenerateNumber($limit);

        return (in_array($generatedNumber, $recordedNumbers)) 
            // if in array regenerate again
            ? $this->_regenerateNumber($limit)
            // if not in array display the generated number
            : $generatedNumber;
    }

    private function _regenerateNumber($limit) 
    {
        return rand($limit['min'], $limit['max']);
    }

    public function submit(ConfirmLottery $request) 
    {
        $lottery = new Lottery;
        $lottery->first_number = $request->first;
        $lottery->second_number = $request->second;
        $lottery->third_number = $request->third;
        $lottery->save();

        $message = trans('lottery.success.saved');
        return compact('message');
    }
}
