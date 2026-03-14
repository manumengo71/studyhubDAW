<?php

namespace App\Http\Controllers;

use App\Models\BillingInformation;
use App\Models\CreditCardType;
use Illuminate\Http\Request;

use function PHPSTORM_META\type;

class BillingInformationController extends Controller
{
    public function getInfo()
    {
        // if(BillingInformation::where('user_id', auth()->id())->first()) {
        //     $creditCard = BillingInformation::where('user_id', auth()->id())->first();
        // }else{
        //     $creditCard = BillingInformation::create([
        //         'user_id' => '11',
        //         'credit_card_number' => '0000000000000000',
        //     ]);
        // }

        if (!BillingInformation::where('user_id', auth()->id())->first()) {
            $imgUrl = 'https://i.postimg.cc/pVnKRTPJ/logo.jpg';
            $style = "w-16 h-16 rounded-full";
            return view('shopping.billinginfo', compact('imgUrl', 'style'));
        } else {
            $creditCard = BillingInformation::where('user_id', auth()->id())->first();
            $number = $creditCard->credit_card_number;
            $number = str_split($number);
            $firstNumber = $number[0];

            if ($firstNumber != '4' && $firstNumber != '5' && $firstNumber != '3') {
                $firstNumber = '0';
            }

            $type = CreditCardType::where('type', $firstNumber)->first();

            if ($type->type == '4') {
                $imgUrl = 'https://i.postimg.cc/QMKhtNJW/visa.png';
                $style = 'w-20 h-13';
            } elseif ($type->type == '5') {
                $imgUrl = 'https://i.postimg.cc/7ZwdTH1W/mastercard.png';
                $style = 'w-20 h-16';
            } elseif ($type->type == '3') {
                $imgUrl = 'https://i.postimg.cc/4xSXsHVg/americanexpress.png';
            } elseif ($type->type == '0') {
                $imgUrl = 'https://i.postimg.cc/pVnKRTPJ/logo.jpg';
                $style = "w-16 h-16 rounded-full";
            }
            return view('shopping.billinginfo', compact('creditCard', 'imgUrl', 'style'));
        }
    }
}
