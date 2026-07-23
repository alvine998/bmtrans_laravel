<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GalleryItem extends Model
{
    protected $fillable = ['title','type','file_path','thumbnail','category','caption','alt_text','order','is_active'];

    protected function casts(): array
    {
        return ['is_active' => 'boolean', 'order' => 'integer'];
    }

    public function scopeActive($q) { return $q->where('is_active', true); }
    public function scopeImages($q) { return $q->where('type', 'image'); }
    public function scopeVideos($q) { return $q->where('type', 'video'); }
}
