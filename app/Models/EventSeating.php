<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EventSeating extends Model
{
    use HasFactory;

    protected $fillable = ['event_id', 'venue_id', 'total_seats', 'seats_booked', 'waitlist_enabled'];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function venue()
    {
        return $this->belongsTo(Venue::class);
    }
}

