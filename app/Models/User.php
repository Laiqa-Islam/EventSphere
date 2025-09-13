<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'full_name',
        'mobile',
        'department',
        'enrollment_no',
        'role',
    ];

    public function eventsOrganized()
    {
        return $this->hasMany(Event::class, 'organizer_id');
    }

    public function registrations()
    {
        return $this->hasMany(Registration::class, 'student_id');
    }

    public function attendances()
    {
        return $this->hasMany(Attendance::class, 'student_id');
    }

    public function feedbacks()
    {
        return $this->hasMany(Feedback::class, 'student_id');
    }

    public function certificates()
    {
        return $this->hasMany(Certificate::class, 'student_id');
    }

    public function uploads()
    {
        return $this->hasMany(MediaGallery::class, 'uploaded_by');
    }

    public function waitlistEntries()
    {
        return $this->hasMany(EventWaitlist::class);
    }

    public function calendarSyncs()
    {
        return $this->hasMany(CalenderSync::class);
    }

    public function shares()
    {
        return $this->hasMany(EventShareLog::class);
    }

    public function favorites()
    {
        return $this->belongsToMany(MediaGallery::class, 'media_favorites')
            ->withTimestamps();
    }
    public function bookmarkedEvents()
{
    return $this->belongsToMany(Event::class, 'event_bookmarks')->withTimestamps();
}
}
