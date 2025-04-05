<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Prunable;


class Url extends Model
{
    use HasFactory;
    use Prunable;

    protected $guarded = [];

    public function getShortUrlAttribute(): string
    {
        return request()->root() . '/' . $this->code;
    }

    public function resolveRouteBinding($value, $field = null)
    {
        $url = null;
        if (!cache()->has('url:' . $value)) {
            $url = $this->where($field, $value)->firstOrFail();
        }

        return cache()->rememberForever('url' . $value, function () use ($url) {
            return $url;
        });
    }

    public function prunable(): Builder
    {
        return static::where('expires_at', '<', now())->whereNotNull('expires_at');
    }

}
