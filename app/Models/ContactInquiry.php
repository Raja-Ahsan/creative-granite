<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class ContactInquiry extends Model
{
    public const PROJECT_TYPES = [
        'new-construction' => 'New construction',
        'remodel' => 'Remodel & renovation',
        'multifamily' => 'Multifamily & commercial',
        'other' => 'Other',
    ];

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
        return self::PROJECT_TYPES[$this->project_type] ?? str($this->project_type)->headline()->toString();
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
