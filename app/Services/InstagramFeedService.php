<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Throwable;

class InstagramFeedService
{
    public const CACHE_KEY = 'instagram.feed.posts';

    /**
     * Latest Instagram posts for the homepage grid.
     * Falls back to an empty array when the API is not configured or fails.
     *
     * @return list<array{src: string, alt: string, url: string}>
     */
    public function getPosts(int $limit = 8): array
    {
        if (! $this->isConfigured()) {
            return [];
        }

        $ttlMinutes = max(5, (int) config('services.instagram.cache_minutes', 60));

        return Cache::remember(self::CACHE_KEY, now()->addMinutes($ttlMinutes), function () use ($limit) {
            try {
                return $this->fetchFromApi($limit);
            } catch (Throwable $e) {
                Log::warning('Instagram feed fetch failed.', [
                    'message' => $e->getMessage(),
                ]);

                return [];
            }
        });
    }

    public function isConfigured(): bool
    {
        return filled(config('services.instagram.access_token'));
    }

    public static function clearCache(): void
    {
        Cache::forget(self::CACHE_KEY);
    }

    /**
     * Force a fresh pull from Instagram and store it in cache.
     *
     * @return list<array{src: string, alt: string, url: string}>
     */
    public function refresh(int $limit = 8): array
    {
        self::clearCache();

        return $this->getPosts($limit);
    }

    /**
     * @return list<array{src: string, alt: string, url: string}>
     */
    private function fetchFromApi(int $limit): array
    {
        $token = (string) config('services.instagram.access_token');
        $userId = config('services.instagram.user_id');
        $fields = 'id,caption,media_type,media_url,permalink,thumbnail_url,timestamp';

        // Instagram Login tokens use graph.instagram.com / me
        // Facebook Page tokens use graph.facebook.com / {ig-user-id}
        if (filled($userId)) {
            $endpoint = 'https://graph.facebook.com/v21.0/'.$userId.'/media';
        } else {
            $endpoint = 'https://graph.instagram.com/v21.0/me/media';
        }

        $response = Http::timeout(15)
            ->acceptJson()
            ->get($endpoint, [
                'fields' => $fields,
                'limit' => max($limit * 2, 12),
                'access_token' => $token,
            ]);

        if (! $response->successful()) {
            throw new \RuntimeException(
                'Instagram API error: '.$response->status().' '.$response->body()
            );
        }

        $items = $response->json('data') ?? [];
        $posts = [];

        foreach ($items as $item) {
            $mediaType = $item['media_type'] ?? '';
            $src = null;

            if ($mediaType === 'IMAGE' || $mediaType === 'CAROUSEL_ALBUM') {
                $src = $item['media_url'] ?? null;
            } elseif ($mediaType === 'VIDEO') {
                $src = $item['thumbnail_url'] ?? $item['media_url'] ?? null;
            }

            if (! filled($src)) {
                continue;
            }

            $caption = trim((string) ($item['caption'] ?? ''));
            $alt = $caption !== ''
                ? \Illuminate\Support\Str::limit($caption, 120)
                : 'Creative Granite & Design on Instagram';

            $posts[] = [
                'src' => $src,
                'alt' => $alt,
                'url' => $item['permalink'] ?? (config('services.instagram.profile_url') ?: '#'),
            ];

            if (count($posts) >= $limit) {
                break;
            }
        }

        return $posts;
    }
}
