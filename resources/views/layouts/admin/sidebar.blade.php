@php
    $modules = dynamic_sidebar();

    $placeholderModules = [
            'site-content-module',
            'home-module',
            'gallery-module',
            'services-module',
            'process-module',
            'contact-module',
            'settings-module',
    ];

    $adminUrl = function (string $routeName) use ($placeholderModules): string {
        if (in_array($routeName, $placeholderModules, true)) {
            return '#';
        }

        if (in_array($routeName, ['admin.dashboard', 'dashboard'], true)) {
            return '/admin';
        }

        $name = str_starts_with($routeName, 'admin.')
            ? substr($routeName, 6)
            : $routeName;

        if ($name === 'dashboard') {
            return '/admin';
        }

        if (str_ends_with($name, '.index')) {
            return '/admin/'.str_replace('.index', '', $name);
        }

        if (str_ends_with($name, '.edit')) {
            return '/admin/'.str_replace('.edit', '', $name);
        }

        if (str_ends_with($name, '.create')) {
            return '/admin/'.str_replace('.create', '', $name).'/create';
        }

        return '/admin/'.$name;
    };

    $adminRoutePattern = function (string $routeName): string {
        $name = str_starts_with($routeName, 'admin.')
            ? $routeName
            : 'admin.'.$routeName;

        return preg_replace('/\.(index|edit|create)$/', '.*', $name);
    };

    $linkClasses = function (bool $active): string {
        return $active
            ? 'bg-accent/15 text-cream border-l-[3px] border-accent font-medium'
            : 'text-cream/70 border-l-[3px] border-transparent hover:bg-white/5 hover:text-cream';
    };
@endphp

<aside
    class="hidden sm:block w-64 shrink-0 bg-ink text-cream min-h-[calc(100vh-4rem)] shadow-xl"
    :class="{ '!block fixed inset-y-0 left-0 top-16 z-40 w-64': sidebarOpen }"
    @click.outside="sidebarOpen = false"
>
    <div class="px-4 py-5 border-b border-cream/10">
        <p class="text-[10px] uppercase tracking-[0.2em] text-cream/40">Navigation</p>
        <p class="mt-1 text-sm font-medium text-cream">Site Manager</p>
    </div>

    <nav class="p-3 space-y-1 overflow-y-auto max-h-[calc(100vh-8rem)]">
        @foreach ($modules as $module)
            @php
                $hasChildren = $module->children && $module->children->count() > 0;
                $groupOpen = false;
                if ($hasChildren) {
                    foreach ($module->children as $child) {
                        if (request()->routeIs($adminRoutePattern($child->route_name))) {
                            $groupOpen = true;
                            break;
                        }
                    }
                }
            @endphp

            @if ($hasChildren)
                <div class="pt-2" x-data="{ open: {{ $groupOpen ? 'true' : 'false' }} }">
                    <button
                        type="button"
                        class="flex w-full items-center gap-3 rounded-md px-3 py-2.5 text-left text-sm text-cream/80 transition hover:bg-white/5 hover:text-cream"
                        @click="open = !open"
                        :aria-expanded="open.toString()"
                    >
                        <span class="flex h-8 w-8 shrink-0 items-center justify-center rounded-md bg-white/5 text-accent">
                            <i class="{{ $module->icon ?? 'fa-solid fa-folder' }} text-sm"></i>
                        </span>
                        <span class="flex-1 truncate font-medium">{{ $module->name }}</span>
                        <i
                            class="fa-solid fa-chevron-down text-[10px] text-cream/40 transition-transform duration-200"
                            :class="{ 'rotate-180': open }"
                        ></i>
                    </button>

                    <div
                        x-show="open"
                        x-cloak
                        class="mt-1 space-y-0.5 border-l border-cream/10 ml-5 pl-2"
                    >
                        @foreach ($module->children as $child)
                            @php
                                $childActive = request()->routeIs($adminRoutePattern($child->route_name));
                            @endphp
                            <a
                                href="{{ $adminUrl($child->route_name) }}"
                                class="group flex items-center gap-3 px-3 py-2 rounded-r-md text-sm transition-all duration-150 {{ $linkClasses($childActive) }}"
                            >
                                <span class="flex h-7 w-7 shrink-0 items-center justify-center rounded-md {{ $childActive ? 'bg-accent/20 text-accent' : 'bg-white/5 text-cream/60 group-hover:bg-white/10 group-hover:text-cream' }} transition">
                                    <i class="{{ $child->icon ?? 'fa-solid fa-circle' }} text-xs"></i>
                                </span>
                                <span class="truncate">{{ $child->name }}</span>
                            </a>
                        @endforeach
                    </div>
                </div>
            @else
                @php
                    $linkActive = request()->routeIs($adminRoutePattern($module->route_name));
                @endphp
                <a
                    href="{{ $adminUrl($module->route_name) }}"
                    class="group flex items-center gap-3 px-3 py-2.5 rounded-r-md text-sm transition-all duration-150 {{ $linkClasses($linkActive) }}"
                >
                    <span class="flex h-8 w-8 shrink-0 items-center justify-center rounded-md {{ $linkActive ? 'bg-accent/20 text-accent' : 'bg-white/5 text-cream/60 group-hover:bg-white/10 group-hover:text-cream' }} transition">
                        <i class="{{ $module->icon ?? 'fa-solid fa-house' }} text-sm"></i>
                    </span>
                    <span class="truncate">{{ $module->name }}</span>
                </a>
            @endif
        @endforeach
    </nav>
</aside>
