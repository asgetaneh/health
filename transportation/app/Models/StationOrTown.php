<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StationOrTown extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['name', 'description'];

    protected $searchableFields = ['*'];

    protected $table = 'station_or_towns';

    public function users()
    {
        return $this->hasMany(User::class, 'stationOrTown_id');
    }

    public function routes()
    {
        return $this->hasMany(Route::class, 'departure_station');
    }

    public function routes2()
    {
        return $this->hasMany(Route::class, 'arrival_station');
    }
}
