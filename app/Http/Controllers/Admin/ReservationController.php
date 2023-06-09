<?php

namespace App\Http\Controllers\Admin;

use App\Enums\TableStatusEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\ReservationStoreRequest;
use App\Models\Reservation;
use App\Models\Table;
use Carbon\Carbon;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reservations = Reservation::all();
        return view('admin.reservations.index', compact('reservations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tables = Table::where('status', TableStatusEnum::Available)->get();
        return view('admin.reservations.create', compact('tables'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ReservationStoreRequest $req)
    {
        //user input guest number validate with table guest number
        $table = Table::findOrFail($req->table_id);
        if ($req->guest_number > $table->guest_number) {
            return back()->with('warning', 'Please choose the table base on guests.');
        }
        //user input date validate for reserved.
        $request_date= Carbon::parse($req->res_date);
        foreach($table->reservations as $res){
            if($res->res_date->format('Y-m-d') == $request_date->format('Y-m-d')){
                return back()->with('warning', 'This table is reserved for this date. Choose another one.');
            }
        }
        //add ref num
        $reference_number = Str::random(10);
        Reservation::create([
            "first_name" => $req->first_name,
            "last_name" => $req->last_name,
            "email" => $req->email,
            "phone_number" => $req->phone_number,
            "res_date" => $req->res_date,
            "guest_number" => $req->guest_number,
            "table_id" => $req->table_id,
            "reference_number"=> $reference_number,
        ]);
        return redirect()->route('admin.reservations.index')->with('success', 'New reservation Added!');
    }

    
    public function edit(Reservation $reservation)
    {
        $tables = Table::where('status', TableStatusEnum::Available)->get();
        return view('admin.reservations.edit', compact('reservation', 'tables'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ReservationStoreRequest $req, Reservation $reservation)
    {
        //user input guest number validate with table guest number
        $table = Table::findOrFail($req->table_id);
        if ($req->guest_number > $table->guest_number) {
            return back()->with('warning', 'Please choose the table base on guests.');
        }
        //user input date validate for reserved.
        $request_date = Carbon::parse($req->res_date);
        //table issue
        $reservations= $table->reservations()->where('id', '!=', $reservation->id)->get();

        foreach ($reservations as $res) {
            if ($res->res_date->format('Y-m-d') == $request_date->format('Y-m-d')) {
                return back()->with('warning', 'This table is reserved for this date. Choose another one.');
            }
        }
        $reservation->status= $req->status;
        $reservation->update($req->validated());
        return redirect()->route('admin.reservations.index')->with('success', 'Reservation successfully Updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reservation $reservation)
    {
        $reservation->delete();
        return back()->with('danger', 'Reservation successfully deleted!');
    }
}
