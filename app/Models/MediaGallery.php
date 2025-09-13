<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MediaGallery extends Model
{
    use HasFactory;

    protected $table = 'media_gallery';
    protected $fillable = ['event_id', 'file_type', 'file_url', 'uploaded_by', 'caption'];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function uploader()
    {
        return $this->belongsTo(User::class, 'uploaded_by');
    }
    public function favoritedBy()
    {
        return $this->belongsToMany(User::class, 'media_favorites')
            ->withTimestamps();
    }


}


