@php
    $settings = $settings ?? \App\Models\SchoolSetting::first();
@endphp

<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('admin.dashboard') }}" class="flex items-center space-x-2">
                        <div class="h-10 w-10 bg-blue-600 rounded-lg flex items-center justify-center overflow-hidden">
                            @if($settings && $settings->logo)
                                <img src="{{ asset('storage/' . $settings->logo) }}" alt="{{ $settings->nama_sekolah ?? 'Logo' }}" class="h-full w-full object-contain bg-white">
                            @else
                                <span class="text-white font-bold text-lg">{{ strtoupper(substr($settings->nama_sekolah ?? 'A', 0, 1)) }}</span>
                            @endif
                        </div>
                        <span class="text-xl font-bold text-gray-800">Admin Panel</span>
                    </a>
                </div>

                <!-- Navigation Links -->
                @auth
                    @if(auth()->user()->role === 'admin')
                        <div class="hidden space-x-6 sm:-my-px sm:ml-10 sm:flex">
                            <x-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')">
                                {{ __('Dashboard') }}
                            </x-nav-link>
                            <x-nav-link :href="route('admin.posts.index')" :active="request()->routeIs('admin.posts.*')">
                                {{ __('Berita') }}
                            </x-nav-link>
                            <x-nav-link :href="route('admin.teachers.index')" :active="request()->routeIs('admin.teachers.*')">
                                {{ __('Data Guru') }}
                            </x-nav-link>
                            <x-nav-link :href="route('admin.galleries.index')" :active="request()->routeIs('admin.galleries.*')">
                                {{ __('Galeri') }}
                            </x-nav-link>
                            <x-nav-link :href="route('admin.ppdb.index')" :active="request()->routeIs('admin.ppdb.*')">
                                {{ __('PPDB') }}
                            </x-nav-link>
                            <x-nav-link :href="route('admin.settings.edit')" :active="request()->routeIs('admin.settings.*')">
                                {{ __('Pengaturan') }}
                            </x-nav-link>
                        </div>
                    @endif
                @endauth
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ml-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                            <div>{{ Auth::user()->name }}</div>

                            <div class="ml-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('home')" target="_blank">
                            {{ __('Lihat Website') }}
                        </x-dropdown-link>
                        
                        <x-dropdown-link :href="route('admin.settings.edit')">
                            {{ __('Pengaturan Sekolah') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>

                <form method="POST" action="{{ route('logout') }}" class="ml-3">
                    @csrf
                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 focus:bg-red-700 active:bg-red-800 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150">
                        Logout
                    </button>
                </form>
            </div>

            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            @auth
                @if(auth()->user()->role === 'admin')
                    <x-responsive-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')">
                        {{ __('Dashboard') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('admin.posts.index')" :active="request()->routeIs('admin.posts.*')">
                        {{ __('Berita') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('admin.teachers.index')" :active="request()->routeIs('admin.teachers.*')">
                        {{ __('Data Guru') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('admin.galleries.index')" :active="request()->routeIs('admin.galleries.*')">
                        {{ __('Galeri') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('admin.ppdb.index')" :active="request()->routeIs('admin.ppdb.*')">
                        {{ __('PPDB') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('admin.settings.edit')" :active="request()->routeIs('admin.settings.*')">
                        {{ __('Pengaturan') }}
                    </x-responsive-nav-link>
                @endif
            @endauth
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('home')" target="_blank">
                    {{ __('Lihat Website') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>

