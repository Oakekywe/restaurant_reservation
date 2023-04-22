<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Reservation;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index()
    {
        $specials= Category::where('name', 'specials', 'Specials')->first();
        return view('welcome', compact('specials'));
    }
    public function thankyou($id)
    {
        $res= Reservation::find($id);
        return view('thankyou', compact('res'));
    }
}
