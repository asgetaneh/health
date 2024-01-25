<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Route extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'vehicle_id',
        'departure_time',
        'expected_arrival_time',
        'tariff',
        'service_charge',
        'departure_station',
        'arrival_station',
        'user_id',
    ];

    protected $searchableFields = ['*'];

    protected $hidden = ['user_id'];

    protected $casts = [
        'departure_time' => 'datetime',
        'expected_arrival_time' => 'datetime',
    ];

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }

    public function arrivalStation()
    {
        return $this->belongsTo(StationOrTown::class, 'arrival_station');
    }

    public function departureStation()
    {
        return $this->belongsTo(StationOrTown::class, 'departure_station');
    }

    public function CreatedBy()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
