<?php

namespace App\Http\Controllers\Frontend;

use App\Enums\TableStatusEnum;
use App\Http\Controllers\Controller;
use App\Models\Reservation;
use App\Models\Table;
use App\Rules\DateBetween;
use App\Rules\TimeBetween;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function stepOne(Request $req)
    {
        $reservation= $req->session()->get('reservation');
        $min_date= Carbon::today();
        $max_date= Carbon::now()->addWeek();

        return view('reservations.step-one', compact('reservation', 'min_date', 'max_date'));
    }

    public function storeStepOne(Request $req)
    {
        $validated= $req->validate([
            "first_name" => ['required'],
            "last_name" => ['required'],
            "email" => ['required', 'email'],
            "phone_number" => ['required'],
            "res_date" => ['required', 'date', new DateBetween, new TimeBetween],
            "guest_number" => ['required'],
        ]);
        //logic
        if(empty($req->session()->get('reservation'))){
            $reservation= new Reservation();
            $reservation->fill($validated);
            $req->session()->put('reservation', $reservation);
        }else{
            $reservation= $req->session()->get('reservation');
            $reservation->fill($validated);
            $req->session()->put('reservation', $reservation);
        }
        return redirect()->route('reservations.step.two');
    }

    public function stepTwo(Request $req)
    {
        $reservation = $req->session()->get('reservation');
        $res_table_id = Reservation::orderBy('res_date')->get()->filter(function ($value) use ($reservation){
            return $value->res_date->format('Y-m-d') == $reservation-> res_date->format('Y-m-d');
        })->pluck('table_id');

        //show table
        $tables = Table::where('status', TableStatusEnum::Available)
            ->where('guest_number', '>=', $reservation->guest_number)
            ->whereNotIn('id', $res_table_id)->get();
        return view('reservations.step-two', compact('reservation', 'tables'));
    }
    public function storeStepTwo(Request $req)
    {
        $validated= $req->validate([
            'table_id'=> ['required']
        ]);
        $reservation= $req->session()->get('reservation');
        $reservation->fill($validated);
        $reservation->save();
        $req->session()->forget('reservation');

        return redirect()->route('thankyou');
    }
}
