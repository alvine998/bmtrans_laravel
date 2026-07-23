<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $fillable = ['slug','title','sections','seo_title','seo_description','og_image'];

    protected function casts(): array
    {
        return ['sections' => 'array'];
    }
}
