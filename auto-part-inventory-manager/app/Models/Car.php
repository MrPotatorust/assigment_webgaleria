<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Car extends Model
{
    /** @use HasFactory<\Database\Factories\CarFactory> */
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'registration_number',
        'is_registered'
    ];

    protected $casts = [
        'is_registered' => 'boolean',
    ];

    public function parts(){
        return $this->hasMany(Part::class);
    }
}