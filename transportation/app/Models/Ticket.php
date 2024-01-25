<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ticket extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'route_id',
        'ticket_number',
        'customer_name',
        'user_id',
    ];

    protected $searchableFields = ['*'];

    protected $hidden = ['user_id'];

    public function route()
    {
        return $this->belongsTo(Route::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
