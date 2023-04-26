<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use Illuminate\Http\Request;

class CheckReservationController extends Controller
{
    public function index()
    {
        return view('reservations.check');
    }
    public function check(Request $req)
    {
        $ref_num= $req->reference_number;
        $reservation= Reservation::where('reference_number', $ref_num)->first();

        if(!$reservation){
            return back()->with("error", "Invaild Reference Number");
        }
        return view('reservations.results', compact("reservation"));          
        
    }
}
