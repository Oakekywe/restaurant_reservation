<?php

namespace App\Models;

use App\Enums\TableLocationEnum;
use App\Enums\TableStatusEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Table extends Model
{
    use HasFactory;
    protected $fillable= ['name', 'guest_number', 'location', 'status'];

    protected $casts= [
        "status" => TableStatusEnum::class,
        "location" => TableLocationEnum::class
    ];

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
}
