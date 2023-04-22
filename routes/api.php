<?php

use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use function GuzzleHttp\Promise\all;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('admin/reservations', function(){
    $reservatiions = Reservation::all();
    return response()->json($reservatiions);
});
Route::post('admin/reservations', function(){
    Reservation::create([
        "first_name"=> request("first_name"),
        "last_name"=> request("last_name"),
        "email"=> request("email"),
        "phone_number"=> request("phone_number"),
        "res_date"=> request("res_date"),
        "table_id"=> request("table_id"),
        "guest_number"=> request("guest_number"),
    ]);
    return response("ccreated");
});