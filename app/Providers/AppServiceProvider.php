<?php

namespace App\Providers;

use App\Models\ContactInquiry;
use App\Models\HeroSlide;
use App\Models\Material;
use App\Models\PortfolioItem;
use App\Models\ProcessStep;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProjectType;
use App\Models\Service;
use App\Models\SiteSetting;
use App\Services\MailSettingsService;
use App\Services\SiteContentService;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(MailSettingsService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $clearSiteContentCache = static fn () => SiteContentService::clearCache();

        foreach ([HeroSlide::class, Material::class, Product::class, ProductImage::class, ProcessStep::class, ProjectType::class, PortfolioItem::class, Service::class, SiteSetting::class] as $model) {
            $model::saved($clearSiteContentCache);
            $model::deleted($clearSiteContentCache);
        }

        try {
            $this->app->make(MailSettingsService::class)->applyToConfig();
        } catch (\Throwable) {
            // Database may not be ready during install/migrate.
        }

        View::composer('layouts.admin.navigation', function ($view) {
            $unreadCount = 0;
            $recentInquiries = collect();

            if (
                auth()->check()
                && auth()->user()->role === 'admin'
                && Schema::hasTable('contact_inquiries')
            ) {
                $unreadCount = ContactInquiry::unread()->count();
                $recentInquiries = ContactInquiry::recent()->limit(8)->get();
            }

            $view->with([
                'unreadInquiriesCount' => $unreadCount,
                'recentInquiries' => $recentInquiries,
            ]);
        });
    }
}
