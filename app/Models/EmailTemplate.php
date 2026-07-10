<?php

namespace App\Models;

use App\Services\EmailTemplateService;
use Illuminate\Database\Eloquent\Model;

class EmailTemplate extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'subject',
        'body',
        'description',
        'sort_order',
        'is_active',
        'is_system',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
            'is_system' => 'boolean',
        ];
    }

    public function placeholders(): array
    {
        return app(EmailTemplateService::class)->extractPlaceholders($this->subject, $this->body);
    }

    public function placeholderListText(): string
    {
        return app(EmailTemplateService::class)->formatPlaceholderList($this->placeholders());
    }
}
