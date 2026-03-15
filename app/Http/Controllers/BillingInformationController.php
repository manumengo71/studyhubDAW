<?php

namespace App\Http\Controllers;

use App\Http\Requests\BillingInformationController\StoreCardRequest;
use App\Models\BillingHistory;
use App\Models\BillingInformation;
use App\Models\Course;
use App\Models\CreditCardType;
use Barryvdh\DomPDF\PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

        $coursesHistory = auth()->user()->billingHistories()->latest()->with(['course.owner', 'billing', 'buyer'])->paginate(5);

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
                $style = 'w-20 h-13';
            } elseif ($type->type == '0') {
                $imgUrl = 'https://i.postimg.cc/pVnKRTPJ/logo.jpg';
                $style = "w-16 h-16 rounded-full";
            }

            if ($coursesHistory->isEmpty()) {
                return view('shopping.billinginfo', compact('creditCard', 'imgUrl', 'style'));
            } else {
                // $coursesHistory = Course::join('users_courses', 'courses.id', '=', 'users_courses.courses_id')
                //     ->join('users', 'courses.owner_id', '=', 'users.id')
                //     ->where('users_courses.users_id', auth()->id())
                //     ->select('courses.*', 'users.username as owner_name')
                //     ->paginate(5);

                return view('shopping.billinginfo', compact('creditCard', 'imgUrl', 'style', 'coursesHistory'));
            }
        }
    }

    public function storeCreditCard(StoreCardRequest $request)
    {
        $request->safe();

        $primerDigito = substr($request->input('input-number-card'), 0, 1);



        if ($primerDigito != '4' && $primerDigito != '5' && $primerDigito != '3') {
            $type_id = 0;
        } else {
            $type_id = CreditCardType::where('type', $primerDigito)->first()->id;
        }

        BillingInformation::updateOrCreate(
            ['user_id' => auth()->id()],
            [
                'owner_name' => $request->input('name'),
                'owner_surname' => $request->input('surname'),
                'owner_second_surname' => $request->input('second-surname'),
                'credit_card_number' => $request->input('input-number-card'),
                'expiration_date' => $request->input('input-expire-date-card'),
                'cvv' => $request->input('input-cvv-card'),
                'type_id' => $type_id,
            ]
        );

        return redirect()->route('billinginfo');
    }
}
