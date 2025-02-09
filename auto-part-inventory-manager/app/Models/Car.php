<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    /** @use HasFactory<\Database\Factories\CarFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'registration_number',
        'is_registered',
    ];

    protected $casts = [
        'is_registered' => 'boolean',
    ];

    public function parts(){
        return $this->hasMany(Part::class);
    }
}
