<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Diver extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['full_name', 'licence'];

    protected $searchableFields = ['*'];

    public function vehicles()
    {
        return $this->hasMany(Vehicle::class);
    }
}
