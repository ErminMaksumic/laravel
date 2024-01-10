<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RentalCar extends Model
{
    use HasFactory;

    // attributes
    protected $fillable = ['name', 'user_id', 'price'];

    // relations
    public function User() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }

}
