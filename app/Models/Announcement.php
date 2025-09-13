<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Announcement extends Model
{
    use HasFactory;

    protected $fillable = [
        'event_id',
        'organizer_id',
        'admin_id',
        'title',
        'message',
        'sent_at',
        'target_role',
        'target_users',
    ];

    protected $casts = [
        'target_users' => 'array',
    ];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function organizer()
    {
        return $this->belongsTo(User::class, 'organizer_id');
    }

    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }
}

