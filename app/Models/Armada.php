<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Armada extends Model
{
    protected $fillable = [
        'name', 'type', 'price_start', 'price_label', 'price_note',
        'description', 'image', 'order', 'is_active',
    ];

    protected function casts(): array
    {
        return [
            'price_start' => 'integer',
            'is_active' => 'boolean',
            'order' => 'integer',
        ];
    }

    public function scopeActive($q) { return $q->where('is_active', true); }
    public function scopeOrdered($q) { return $q->orderBy('order')->orderBy('name'); }

    public function getDisplayPriceAttribute(): string
    {
        if ($this->price_label) return $this->price_label;
        $v = (int) $this->price_start;
        if ($v >= 1000000000) return number_format($v / 1000000000, $v % 1000000000 == 0 ? 0 : 1).'M';
        if ($v >= 1000000) return number_format($v / 1000000, $v % 1000000 == 0 ? 0 : 1, ',', '.').'jt';
        if ($v >= 1000) return number_format($v / 1000, 0).'rb';
        return (string) $v;
    }

    public function getImageUrlAttribute(): ?string
    {
        if (! $this->image) return null;
        // stored as "armada/xxxxx.webp" inside public disk
        if (Storage::disk('public')->exists($this->image)) {
            return Storage::url($this->image);
        }
        // fallback legacy full path
        return asset('storage/'.$this->image);
    }
}
