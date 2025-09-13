<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CalenderSync extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'event_id', 'calendar_type', 'calendar_url'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CalendarSync extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'event_id', 'calendar_type', 'calendar_url'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
