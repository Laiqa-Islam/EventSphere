<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Event extends Model
{
    use HasFactory;

    protected $casts = [
    'date' => 'date',  // ensures $event->date is always a Carbon instance
];
    protected $fillable = ['title', 'description', 'category', 'date', 'time', 'venue_id', 'organizer_id', 'status', 'max_participants', 'banner_image', 'rulebook'];

    public function venue()
    {
        return $this->belongsTo(Venue::class);
    }

    public function feedback(){
        return $this->hasMany(Feedback::class);
    }

    public function organizer()
    {
        return $this->belongsTo(User::class, 'organizer_id');
    }

    public function registrations()
    {
        return $this->hasMany(Registration::class);
    }

    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }

    public function feedbacks()
    {
        return $this->hasMany(Feedback::class);
    }

    public function certificates()
    {
        return $this->hasMany(Certificate::class);
    }

    public function media()
    {
        return $this->hasMany(MediaGallery::class);
    }

    public function seating()
    {
        return $this->hasOne(EventSeating::class);
    }

    public function waitlist()
    {
        return $this->hasMany(EventWaitlist::class);
    }
    public function bookmarkedBy()
    {
        return $this->belongsToMany(User::class, 'event_bookmarks')->withTimestamps();
    }


    public function calendarSyncs()
    {
        return $this->hasMany(CalenderSync::class);
    }

    public function shares()
    {
        return $this->hasMany(EventShareLog::class);
    }
}

