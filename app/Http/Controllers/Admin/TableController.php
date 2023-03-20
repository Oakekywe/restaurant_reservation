<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\TableStoreRequest;
use App\Models\Table;
use Illuminate\Http\Request;

class TableController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tables = Table::all();
        return view('admin.tables.index', compact('tables'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.tables.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TableStoreRequest $req)
    {
        Table::create([
            "name" => $req->name,
            "location" => $req->location,
            "status" => $req->status,
            "guest_number" => $req->guest_number,
        ]);
        return redirect()->route('admin.tables.index')->with('message', 'New table Added!');
    }

    
    public function edit(Table $table)
    {
        return view('admin.tables.edit', compact('table'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $req, Table $table)
    {
        $req->validate([
            'name' => ['required'],
            'guest_number' => ['required'],
            'location' => ['required'],
            'status' => ['required'],
        ]);
        $table->update([
            "name"=> $req->name,
            "guest_number"=> $req->guest_number,
            "location"=> $req->location,
            "status"=> $req->status,
        ]);
        return redirect()->route('admin.tables.index')->with('message', 'Table successfully updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Table $table)
    {
        $table->delete();
        return back()->with('message', 'Table successfully deleted!');
    }
}
