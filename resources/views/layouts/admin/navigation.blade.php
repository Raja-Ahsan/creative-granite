<nav class="sticky top-0 z-50 bg-white/90 backdrop-blur-md border-b border-bone shadow-sm">
    <div class="px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center gap-3">
                <button
                    type="button"
                    class="sm:hidden inline-flex items-center justify-center p-2 rounded-md text-ink-soft hover:text-ink hover:bg-bone/60 transition"
                    @click="sidebarOpen = !sidebarOpen"
                    aria-label="Toggle sidebar"
                >
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>

                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3">
                    <img
                        src="{{ asset('images/site/update-logo.png') }}"
                        alt="{{ config('app.name') }}"
                        class="h-9 w-auto"
                    >
                    <div class="hidden sm:block leading-tight">
                        <span class="block text-sm font-semibold text-ink">Creative Granite</span>
                        <span class="block text-[11px] text-ink-soft/70 tracking-wide">Content Admin</span>
                    </div>
                </a>
            </div>

            <div class="flex items-center gap-2 sm:gap-4">
                <div class="relative" x-data="{ notificationsOpen: false }">
                    <button
                        type="button"
                        class="relative inline-flex h-10 w-10 items-center justify-center rounded-lg border border-bone bg-white text-ink-soft transition hover:bg-bone/40 hover:text-ink"
                        @click="notificationsOpen = !notificationsOpen"
                        aria-label="Notifications"
                    >
                        <i class="fa-regular fa-bell text-sm"></i>
                        @if ($unreadInquiriesCount > 0)
                            <span class="absolute -right-1 -top-1 flex h-5 min-w-[1.25rem] items-center justify-center rounded-full bg-red-600 px-1 text-[10px] font-bold text-white">
                                {{ $unreadInquiriesCount > 9 ? '9+' : $unreadInquiriesCount }}
                            </span>
                        @endif
                    </button>

                    <div
                        x-show="notificationsOpen"
                        x-transition
                        @click.outside="notificationsOpen = false"
                        class="absolute right-0 z-50 mt-2 w-80 overflow-hidden rounded-xl border border-bone bg-white shadow-lg sm:w-96"
                        style="display: none;"
                    >
                        <div class="flex items-center justify-between border-b border-bone px-4 py-3">
                            <p class="text-sm font-semibold text-ink">Notifications</p>
                            @if ($unreadInquiriesCount > 0)
                                <span class="rounded-full bg-amber-100 px-2 py-0.5 text-[10px] font-semibold uppercase tracking-wider text-amber-800">
                                    {{ $unreadInquiriesCount }} new
                                </span>
                            @endif
                        </div>

                        <div class="max-h-80 overflow-y-auto">
                            @forelse ($recentInquiries as $inquiry)
                                <a
                                    href="{{ route('admin.contact-inquiries.show', $inquiry) }}"
                                    class="block border-b border-bone/70 px-4 py-3 transition hover:bg-cream/50 {{ $inquiry->isUnread() ? 'bg-amber-50/50' : '' }}"
                                    @click="notificationsOpen = false"
                                >
                                    <div class="flex items-start justify-between gap-2">
                                        <p class="text-sm font-medium text-ink">{{ $inquiry->name }}</p>
                                        @if ($inquiry->isUnread())
                                            <span class="mt-1 h-2 w-2 shrink-0 rounded-full bg-amber-500"></span>
                                        @endif
                                    </div>
                                    <p class="mt-1 truncate text-xs text-ink-soft">{{ $inquiry->projectTypeLabel() }}</p>
                                    <p class="mt-1 text-[11px] text-ink-soft/70">{{ $inquiry->created_at->diffForHumans() }}</p>
                                </a>
                            @empty
                                <div class="px-4 py-8 text-center text-sm text-ink-soft">
                                    No contact enquiries yet.
                                </div>
                            @endforelse
                        </div>

                        <div class="border-t border-bone bg-cream/30 px-4 py-3">
                            <a href="{{ route('admin.contact-inquiries.index') }}" class="text-xs font-semibold uppercase tracking-wider text-accent hover:underline">
                                View all enquiries
                            </a>
                        </div>
                    </div>
                </div>

                <a
                    href="{{ route('home') }}"
                    target="_blank"
                    class="hidden sm:inline-flex items-center gap-2 px-3 py-1.5 text-sm text-ink-soft hover:text-ink border border-bone rounded-md hover:bg-bone/40 transition"
                >
                    <i class="fa-solid fa-arrow-up-right-from-square text-xs text-accent"></i>
                    View Site
                </a>

                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center gap-2 px-2 sm:px-3 py-1.5 rounded-lg border border-bone bg-white hover:bg-bone/30 transition focus:outline-none focus:ring-2 focus:ring-accent/30">
                            <span class="flex h-8 w-8 items-center justify-center rounded-full bg-ink text-cream text-xs font-semibold">
                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                            </span>
                            <span class="hidden sm:block text-sm font-medium text-ink">{{ Auth::user()->name }}</span>
                            <svg class="hidden sm:block h-4 w-4 text-ink-soft" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <div class="px-4 py-3 border-b border-bone">
                            <p class="text-sm font-medium text-ink">{{ Auth::user()->name }}</p>
                            <p class="text-xs text-ink-soft truncate">{{ Auth::user()->email }}</p>
                        </div>

                        <x-dropdown-link :href="route('home')" target="_blank" class="sm:hidden">
                            <i class="fa-solid fa-arrow-up-right-from-square me-2 text-accent"></i>
                            {{ __('View Site') }}
                        </x-dropdown-link>

                        <x-dropdown-link :href="route('profile.edit')">
                            <i class="fa-regular fa-user me-2 text-ink-soft"></i>
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault(); this.closest('form').submit();">
                                <i class="fa-solid fa-right-from-bracket me-2 text-ink-soft"></i>
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>
        </div>
    </div>
</nav>
