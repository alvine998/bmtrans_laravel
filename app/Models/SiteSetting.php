<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class SiteSetting extends Model
{
    protected $fillable = ['key','value','type'];

    public static function getValue(string $key, mixed $default = null): mixed
    {
        return Cache::remember("setting.{$key}", 3600, function () use ($key, $default) {
            $setting = static::where('key', $key)->first();
            if (! $setting) return $default;
            if ($setting->type === 'json') {
                return json_decode($setting->value, true) ?? $default;
            }
            return $setting->value ?? $default;
        });
    }

    public static function setValue(string $key, mixed $value, string $type = 'text'): void
    {
        $stored = $type === 'json' ? json_encode($value) : (string) $value;
        static::updateOrCreate(['key' => $key], ['value' => $stored, 'type' => $type]);
        Cache::forget("setting.{$key}");
    }
}
