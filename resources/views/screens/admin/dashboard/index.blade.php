@extends('layouts.admin.master')
@section('content')
    @include('screens.admin.partials.alerts')

    @php
        use App\Models\HeroSlide;
        use App\Models\Material;
        use App\Models\PortfolioItem;
        use App\Models\Service;

        $stats = [
            [
                'label' => 'Hero Slides',
                'value' => HeroSlide::count(),
                'icon' => 'fa-solid fa-images',
                'color' => 'bg-accent/10 text-accent',
                'route' => route('admin.hero-slides.index', absolute: false),
            ],
            [
                'label' => 'Materials',
                'value' => Material::count(),
                'icon' => 'fa-solid fa-gem',
                'color' => 'bg-accent/10 text-accent',
                'route' => route('admin.materials.index'),
            ],
            [
                'label' => 'Portfolio',
                'value' => PortfolioItem::count(),
                'icon' => 'fa-solid fa-camera',
                'color' => 'bg-ink/10 text-ink',
                'route' => route('admin.portfolio-items.index'),
            ],
            [
                'label' => 'Services',
                'value' => Service::count(),
                'icon' => 'fa-solid fa-briefcase',
                'color' => 'bg-ink-soft/10 text-ink-soft',
                'route' => route('admin.services.index'),
            ],
        ];

        $quickLinks = [
            ['Hero Slides', 'fa-solid fa-images', route('admin.hero-slides.index', absolute: false), HeroSlide::count()],
            ['Materials', 'fa-solid fa-gem', route('admin.materials.index'), Material::count()],
            ['Portfolio', 'fa-solid fa-camera', route('admin.portfolio-items.index'), PortfolioItem::count()],
            ['Services', 'fa-solid fa-briefcase', route('admin.services.index'), Service::count()],
            ['Site Settings', 'fa-solid fa-gear', route('admin.site-settings.edit'), null],
        ];

        $recentActivity = [
            ['action' => 'Portfolio gallery updated', 'time' => 'This week', 'icon' => 'fa-solid fa-camera'],
            ['action' => 'Materials library reviewed', 'time' => 'This week', 'icon' => 'fa-solid fa-gem'],
            ['action' => 'Hero slides reviewed', 'time' => 'Recently', 'icon' => 'fa-solid fa-images'],
            ['action' => 'Site settings checked', 'time' => 'Recently', 'icon' => 'fa-solid fa-gear'],
        ];

        $chartBars = [62, 78, 55, 88, 70, 92, 65];
        $chartLabels = ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'];
    @endphp

    {{-- Page header --}}
    <div class="mb-8 flex flex-col sm:flex-row sm:items-end sm:justify-between gap-4">
        <div>
            <p class="text-xs uppercase tracking-[0.2em] text-ink-soft/60">Overview</p>
            <h1 class="mt-1 font-display text-3xl text-ink">Dashboard</h1>
            <p class="mt-2 text-sm text-ink-soft">
                Welcome back, {{ Auth::user()->name }}. Manage your Creative Granite site content.
            </p>
        </div>
        <div class="text-sm text-ink-soft bg-white border border-bone rounded-lg px-4 py-2 shadow-sm">
            <i class="fa-regular fa-calendar me-2 text-accent"></i>{{ now()->format('l, F j, Y') }}
        </div>
    </div>

    {{-- Stats cards --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-4 mb-8">
        @foreach ($stats as $stat)
            <a href="{{ $stat['route'] }}" class="group block bg-white rounded-xl border border-bone shadow-sm hover:shadow-md hover:border-accent/30 transition-all duration-200 overflow-hidden">
                <div class="p-5">
                    <div class="flex items-start justify-between">
                        <div>
                            <p class="text-xs font-medium uppercase tracking-wider text-ink-soft/70">{{ $stat['label'] }}</p>
                            <p class="mt-2 text-3xl font-semibold text-ink">{{ $stat['value'] }}</p>
                        </div>
                        <span class="flex h-11 w-11 items-center justify-center rounded-xl {{ $stat['color'] }} group-hover:scale-105 transition-transform">
                            <i class="{{ $stat['icon'] }}"></i>
                        </span>
                    </div>
                    <p class="mt-4 text-xs text-accent font-medium group-hover:underline">Manage &rarr;</p>
                </div>
            </a>
        @endforeach
    </div>

    {{-- Widgets row --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
        {{-- Chart placeholder --}}
        <div class="lg:col-span-2 bg-white rounded-xl border border-bone shadow-sm">
            <div class="px-6 py-4 border-b border-bone flex items-center justify-between">
                <div>
                    <h2 class="text-sm font-semibold text-ink">Content Activity</h2>
                    <p class="text-xs text-ink-soft mt-0.5">Weekly overview (placeholder)</p>
                </div>
                <span class="text-xs px-2 py-1 rounded-full bg-bone text-ink-soft">Last 7 days</span>
            </div>
            <div class="p-6">
                <div class="flex items-end justify-between gap-2 h-40">
                    @foreach ($chartBars as $i => $height)
                        <div class="flex-1 flex flex-col items-center gap-2">
                            <div
                                class="w-full rounded-t-md bg-gradient-to-t from-ink to-accent/80 opacity-90 hover:opacity-100 transition-opacity"
                                style="height: {{ $height }}%"
                            ></div>
                            <span class="text-[10px] text-ink-soft">{{ $chartLabels[$i] }}</span>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- Quick stats widget --}}
        <div class="bg-white rounded-xl border border-bone shadow-sm">
            <div class="px-6 py-4 border-b border-bone">
                <h2 class="text-sm font-semibold text-ink">Quick Stats</h2>
                <p class="text-xs text-ink-soft mt-0.5">At a glance</p>
            </div>
            <div class="p-4 space-y-3">
                <div class="flex items-center justify-between p-3 rounded-lg bg-cream/60">
                    <span class="text-sm text-ink-soft">Hero Slides</span>
                    <span class="text-sm font-semibold text-ink">{{ HeroSlide::count() }}</span>
                </div>
                <div class="flex items-center justify-between p-3 rounded-lg bg-cream/60">
                    <span class="text-sm text-ink-soft">Services</span>
                    <span class="text-sm font-semibold text-ink">{{ Service::count() }}</span>
                </div>
                <div class="flex items-center justify-between p-3 rounded-lg bg-cream/60">
                    <span class="text-sm text-ink-soft">Portfolio Items</span>
                    <span class="text-sm font-semibold text-ink">{{ PortfolioItem::count() }}</span>
                </div>
                <div class="flex items-center justify-between p-3 rounded-lg bg-ink text-cream">
                    <span class="text-sm text-cream/80">Total Content Items</span>
                    <span class="text-sm font-semibold">{{ Material::count() + PortfolioItem::count() + HeroSlide::count() }}</span>
                </div>
            </div>
        </div>
    </div>

    {{-- Recent activity + quick actions --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        {{-- Recent activity --}}
        <div class="lg:col-span-1 bg-white rounded-xl border border-bone shadow-sm">
            <div class="px-6 py-4 border-b border-bone">
                <h2 class="text-sm font-semibold text-ink">Recent Activity</h2>
                <p class="text-xs text-ink-soft mt-0.5">Latest updates</p>
            </div>
            <ul class="divide-y divide-bone">
                @foreach ($recentActivity as $item)
                    <li class="px-6 py-4 flex items-start gap-3">
                        <span class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-bone text-ink-soft">
                            <i class="{{ $item['icon'] }} text-sm"></i>
                        </span>
                        <div class="min-w-0">
                            <p class="text-sm text-ink">{{ $item['action'] }}</p>
                            <p class="text-xs text-ink-soft/70 mt-0.5">{{ $item['time'] }}</p>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>

        {{-- Quick actions --}}
        <div class="lg:col-span-2 bg-white rounded-xl border border-bone shadow-sm">
            <div class="px-6 py-4 border-b border-bone">
                <h2 class="text-sm font-semibold text-ink">Quick Actions</h2>
                <p class="text-xs text-ink-soft mt-0.5">Jump to any content module</p>
            </div>
            <div class="p-4 grid grid-cols-1 sm:grid-cols-2 gap-3">
                @foreach ($quickLinks as [$label, $icon, $url, $count])
                    <a
                        href="{{ $url }}"
                        class="group flex items-center gap-3 p-4 rounded-xl border border-bone hover:border-accent/40 hover:bg-cream/40 transition-all duration-150"
                    >
                        <span class="flex h-10 w-10 shrink-0 items-center justify-center rounded-lg bg-ink text-cream group-hover:bg-accent transition-colors">
                            <i class="{{ $icon }} text-sm"></i>
                        </span>
                        <div class="min-w-0 flex-1">
                            <p class="text-sm font-medium text-ink truncate">{{ $label }}</p>
                            @if (! is_null($count))
                                <p class="text-xs text-ink-soft">{{ $count }} items</p>
                            @else
                                <p class="text-xs text-ink-soft">Manage</p>
                            @endif
                        </div>
                        <i class="fa-solid fa-chevron-right text-xs text-ink-soft/40 group-hover:text-accent transition-colors"></i>
                    </a>
                @endforeach
            </div>
        </div>
    </div>
@endsection
