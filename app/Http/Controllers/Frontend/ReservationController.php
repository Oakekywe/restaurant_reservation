<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function stepOne()
    {
        return view('reservations.step-one');
    }
    public function stepTwo()
    {
        return view('reservations.step-two');
    }
}
