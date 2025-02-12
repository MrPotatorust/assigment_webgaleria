<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Part extends Model
{
    /** @use HasFactory<\Database\Factories\PartFactory> */
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'serialnumber',
        'car_id'
    ];


    public function car(): BelongsTo
    {
        return $this->belongsTo(Car::class);
    }
}
