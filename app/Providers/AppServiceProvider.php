<?php

namespace App\Providers;

use App\Models\HeroSlide;
use App\Models\Material;
use App\Models\PortfolioItem;
use App\Models\Service;
use App\Models\SiteSetting;
use App\Services\SiteContentService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $clearSiteContentCache = static fn () => SiteContentService::clearCache();

        foreach ([HeroSlide::class, Material::class, PortfolioItem::class, Service::class, SiteSetting::class] as $model) {
            $model::saved($clearSiteContentCache);
            $model::deleted($clearSiteContentCache);
        }
    }
}
