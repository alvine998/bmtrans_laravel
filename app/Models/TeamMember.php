<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TeamMember extends Model
{
    protected $fillable = ['name','position','photo','bio','socials','order','is_active'];

    protected function casts(): array
    {
        return ['socials' => 'array', 'is_active' => 'boolean', 'order' => 'integer'];
    }
}
