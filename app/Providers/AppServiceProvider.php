<?php

namespace App\Providers;

use App\Models\ContactInquiry;
use App\Models\EstimateRequest;
use App\Models\GalleryAlbum;
use App\Models\GalleryAlbumImage;
use App\Models\HeroSlide;
use App\Models\InstagramPost;
use App\Models\Material;
use App\Models\PortfolioItem;
use App\Models\ProcessStep;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductImage;
use App\Models\ProjectType;
use App\Models\Service;
use App\Models\ServicePageSection;
use App\Models\ServicePageSectionImage;
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

        foreach ([GalleryAlbum::class, GalleryAlbumImage::class, HeroSlide::class, InstagramPost::class, Material::class, Product::class, ProductCategory::class, ProductImage::class, ProcessStep::class, ProjectType::class, PortfolioItem::class, Service::class, ServicePageSection::class, ServicePageSectionImage::class, SiteSetting::class] as $model) {
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
            $recentNotifications = collect();

            if (auth()->check() && auth()->user()->role === 'admin') {
                $contacts = collect();
                $estimates = collect();

                if (Schema::hasTable('contact_inquiries')) {
                    $unreadCount += ContactInquiry::unread()->count();
                    $contacts = ContactInquiry::recent()->limit(8)->get()->map(fn (ContactInquiry $item) => [
                        'type' => 'contact',
                        'name' => $item->name,
                        'label' => $item->projectTypeLabel(),
                        'url' => route('admin.contact-inquiries.show', $item),
                        'unread' => $item->isUnread(),
                        'created_at' => $item->created_at,
                    ]);
                }

                if (Schema::hasTable('estimate_requests')) {
                    $unreadCount += EstimateRequest::unread()->count();
                    $estimates = EstimateRequest::recent()->limit(8)->get()->map(fn (EstimateRequest $item) => [
                        'type' => 'estimate',
                        'name' => $item->name,
                        'label' => 'Estimate — '.$item->projectTypeLabel(),
                        'url' => route('admin.estimate-requests.show', $item),
                        'unread' => $item->isUnread(),
                        'created_at' => $item->created_at,
                    ]);
                }

                $recentNotifications = $contacts
                    ->concat($estimates)
                    ->sortByDesc(fn (array $item) => $item['created_at']?->timestamp ?? 0)
                    ->take(10)
                    ->values();
            }

            $view->with([
                'unreadInquiriesCount' => $unreadCount,
                'recentNotifications' => $recentNotifications,
            ]);
        });
    }
}
