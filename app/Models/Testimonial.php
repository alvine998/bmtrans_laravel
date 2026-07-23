<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    protected $fillable = ['name','company','photo','quote','rating','is_active','order'];

    protected function casts(): array
    {
        return ['is_active' => 'boolean', 'rating' => 'integer', 'order' => 'integer'];
    }

    public function scopeActive($q) { return $q->where('is_active', true); }
}
