<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HouseModel extends Model
{
    use HasFactory;
    protected $table = 'houses';
    protected $guarded = 'id';
    protected $fillable = [
        'name',
        'price',
        'bedrooms',         
        'bathrooms',
        'storeys',
        'garages'
    ];
}
