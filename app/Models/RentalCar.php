<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RentalCar extends Model
{
    use HasFactory;

//    public string $name;
//
//    public int $userId;

    // attributes
    protected $fillable = ['name', 'user_id'];

//    public function __construct(string $name, int $userId)
//    {
//
////        $this->name = $name;
////        $this->userId = $userId;
//
//        $this->attributes = ['name' => $this->name, 'user_id' => $this->userId];
//    }

    // relations
    public function User() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }

}
