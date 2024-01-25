<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Vehicle extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'name',
        'plante_number',
        'level',
        'total_seats',
        'description',
        'diver_id',
    ];

    protected $searchableFields = ['*'];

    public function routes()
    {
        return $this->hasMany(Route::class);
    }

    public function diver()
    {
        return $this->belongsTo(Diver::class);
    }
}
