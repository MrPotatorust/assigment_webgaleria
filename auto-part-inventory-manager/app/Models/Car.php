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
    ];

    protected $casts = [
        'is_registered' => 'boolean',
        'is_private' => 'boolean'
    ];

    public function parts(){
        return $this->hasMany(Part::class);
    }
}