<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class EstimateRequest extends Model
{
    protected $fillable = [
        'name',
        'email',
        'phone',
        'project_type',
        'message',
        'read_at',
    ];

    protected function casts(): array
    {
        return [
            'read_at' => 'datetime',
        ];
    }

    public function projectTypeLabel(): string
    {
        $type = ProjectType::query()->where('slug', $this->project_type)->first();

        return $type?->name ?? str($this->project_type)->headline()->toString();
    }

    public function isUnread(): bool
    {
        return $this->read_at === null;
    }

    public function markAsRead(): void
    {
        if ($this->isUnread()) {
            $this->forceFill(['read_at' => now()])->save();
        }
    }

    public function scopeUnread(Builder $query): Builder
    {
        return $query->whereNull('read_at');
    }

    public function scopeRecent(Builder $query): Builder
    {
        return $query->latest();
    }
}
