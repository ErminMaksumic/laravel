<?php

namespace App\Models;

use DateTime;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'rental_car_id', 'from', 'to'];

    // relations
    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function rentalCar() : BelongsTo
    {
        return $this->belongsTo(RentalCar::class);
    }
}


