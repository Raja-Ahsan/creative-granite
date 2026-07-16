<?php

namespace App\Console\Commands;

use App\Services\InstagramFeedService;
use App\Services\SiteContentService;
use Illuminate\Console\Command;

class RefreshInstagramFeed extends Command
{
    protected $signature = 'instagram:refresh {--limit=8 : Number of posts to fetch}';

    protected $description = 'Refresh the cached Instagram feed for the homepage';

    public function handle(InstagramFeedService $feed): int
    {
        if (! $feed->isConfigured()) {
            $this->warn('INSTAGRAM_ACCESS_TOKEN is not set. Add it to your .env file.');
            $this->line('Until configured, the homepage uses the local fallback images.');

            return self::FAILURE;
        }

        $limit = max(1, (int) $this->option('limit'));
        $posts = $feed->refresh($limit);
        SiteContentService::clearCache();

        $this->info('Instagram feed refreshed: '.count($posts).' post(s) cached.');

        return self::SUCCESS;
    }
}
