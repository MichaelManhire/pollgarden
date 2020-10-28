<nav x-data="{ open: false }" class="bg-white border-b border-gray-100 shadow">
    <!-- Primary Navigation Menu -->
    <div class="container">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="flex-shrink-0 flex items-center">
                    <a href="/">
                        <x-jet-application-mark class="block h-9 w-auto" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-jet-nav-link href="{{ route('polls.create') }}" :active="request()->routeIs('polls.create')">
                        {{ __('Create Poll') }}
                    </x-jet-nav-link>

                    <x-jet-nav-link href="{{ route('polls.index') }}" :active="request()->routeIs('polls.index')">
                        {{ __('Polls') }}
                    </x-jet-nav-link>

                    <x-jet-nav-link href="{{ route('users.index') }}" :active="request()->routeIs('users.index')">
                        {{ __('Members') }}
                    </x-jet-nav-link>
                </div>
            </div>

            @guest
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-jet-nav-link href="{{ route('login') }}" :active="request()->routeIs('login')">
                        {{ __('Login') }}
                    </x-jet-nav-link>

                    <x-jet-nav-link href="{{ route('register') }}" :active="request()->routeIs('register')">
                        {{ __('Register') }}
                    </x-jet-nav-link>
                </div>
            @endguest

            @auth
                <div class="flex items-center ml-auto mr-6 sm:mr-0">
                    <a class="relative mr-6 {{ Auth::user()->hasMessages() ? 'text-green-400 hover:text-green-500' : 'text-gray-400 hover:text-gray-500' }}"
                       href="{{ route('messages.index') }}"
                       title="{{ __('Messages') }}">
                        <x-icons.message-large />
                        <span class="sr-only">{{ __('Messages') }}</span>
                        @if (Auth::user()->hasMessages())
                            <span class="absolute top-0 right-0 block h-1.5 w-1.5 rounded-full text-white shadow-solid bg-green-400"></span>
                        @endif
                    </a>

                    <a class="relative {{ Auth::user()->hasNotifications() ? 'text-green-400 hover:text-green-500' : 'text-gray-400 hover:text-gray-500' }}"
                       href="{{ route('notifications.index') }}"
                       title="{{ __('Notifications') }}">
                        <x-icons.bell />
                        <span class="sr-only">{{ __('Notifications') }}</span>
                        @if (Auth::user()->hasNotifications())
                            <span class="absolute top-0 right-0 block h-1.5 w-1.5 rounded-full text-white shadow-solid bg-green-400"></span>
                        @endif
                    </a>
                </div>
            @endauth

            <!-- Settings Dropdown -->
            @auth
                <div class="hidden sm:flex sm:items-center sm:ml-6">
                    <x-jet-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 base-transition">
                                <img class="h-8 w-8 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <!-- Account Management -->
                            <div class="block px-4 py-2 text-xs text-gray-400">
                                {{ __('Manage Account') }}
                            </div>

                            <x-jet-dropdown-link href="{{ route('users.show', Auth::user()) }}">
                                {{ __('My Profile') }}
                            </x-jet-dropdown-link>

                            <x-jet-dropdown-link href="{{ route('profile.show') }}">
                                {{ __('Edit Profile') }}
                            </x-jet-dropdown-link>

                            <div class="border-t border-gray-100"></div>

                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <x-jet-dropdown-link href="{{ route('logout') }}"
                                                    onclick="event.preventDefault();
                                                                this.closest('form').submit();">
                                    {{ __('Logout') }}
                                </x-jet-dropdown-link>
                            </form>
                        </x-slot>
                    </x-jet-dropdown>
                </div>
            @endauth

            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 base-transition">
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
            <x-jet-responsive-nav-link href="{{ route('polls.create') }}" :active="request()->routeIs('polls.create')">
                {{ __('Create Poll') }}
            </x-jet-responsive-nav-link>

            <x-jet-responsive-nav-link href="{{ route('polls.index') }}" :active="request()->routeIs('polls.index')">
                {{ __('Polls') }}
            </x-jet-responsive-nav-link>

            <x-jet-responsive-nav-link href="{{ route('users.index') }}" :active="request()->routeIs('users.index')">
                {{ __('Members') }}
            </x-jet-responsive-nav-link>

            @guest
                <x-jet-responsive-nav-link href="{{ route('login') }}" :active="request()->routeIs('login')">
                    {{ __('Login') }}
                </x-jet-responsive-nav-link>
                <x-jet-responsive-nav-link href="{{ route('register') }}" :active="request()->routeIs('register')">
                    {{ __('Register') }}
                </x-jet-responsive-nav-link>
            @endguest
        </div>

        <!-- Responsive Settings Options -->
        @auth
            <div class="pt-4 pb-1 border-t border-gray-200">
                <div class="flex items-center px-4">
                    <div class="flex-shrink-0">
                        <img class="h-10 w-10 rounded-full" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                    </div>

                    <div class="ml-3">
                        <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                    </div>
                </div>

                <div class="mt-3 space-y-1">
                    <x-jet-responsive-nav-link href="{{ route('users.show', Auth::user()) }}">
                        {{ __('My Profile') }}
                    </x-jet-responsive-nav-link>

                    <!-- Account Management -->
                    <x-jet-responsive-nav-link href="{{ route('profile.show') }}" :active="request()->routeIs('profile.show')">
                        {{ __('Edit Profile') }}
                    </x-jet-responsive-nav-link>

                    <!-- Authentication -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <x-jet-responsive-nav-link href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                    this.closest('form').submit();">
                            {{ __('Logout') }}
                        </x-jet-responsive-nav-link>
                    </form>
                </div>
            </div>
        @endauth
    </div>
</nav>
