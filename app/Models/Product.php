<?php

namespace App\Models;

use Database\Factories\ProductFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\Factory;
use Database\Factories\Administration\FlightFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $fillable = [
        'name',
        'image',
        'serial_number',
        'price',
        'description',
        'category_id',
    ];


    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    protected static function newFactory(): Factory
    {
        return ProductFactory::new();
    }

}
