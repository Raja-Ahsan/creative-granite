<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiteSetting extends Model
{
    protected $fillable = [
        'key',
        'value',
        'type',
        'group',
    ];

    public static function getValue(string $key, mixed $default = null): mixed
    {
        return static::query()->where('key', $key)->value('value') ?? $default;
    }

    public static function faviconPath(): string
    {
        $path = static::getValue('favicon_path');

        return filled($path) ? (string) $path : '/favicon.ico';
    }

    public static function faviconUrl(): string
    {
        $path = static::faviconPath();
        $url = str_starts_with($path, 'http') ? $path : url($path);

        $updated = static::query()->where('key', 'favicon_path')->value('updated_at');
        if ($updated) {
            $url .= (str_contains($url, '?') ? '&' : '?').'v='.strtotime((string) $updated);
        }

        return $url;
    }

    public static function faviconMimeType(): string
    {
        $path = parse_url(static::faviconPath(), PHP_URL_PATH) ?: static::faviconPath();
        $ext = strtolower(pathinfo($path, PATHINFO_EXTENSION));

        return match ($ext) {
            'png' => 'image/png',
            'jpg', 'jpeg' => 'image/jpeg',
            'gif' => 'image/gif',
            'webp' => 'image/webp',
            'svg' => 'image/svg+xml',
            default => 'image/x-icon',
        };
    }
}
