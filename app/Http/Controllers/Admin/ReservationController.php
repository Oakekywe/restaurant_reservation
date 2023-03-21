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

        Reservation::create($req->validated());
        return redirect()->route('admin.reservations.index')->with('success', 'New reservation Added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
