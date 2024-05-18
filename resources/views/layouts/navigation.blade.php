<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    @if (auth()->user()->role === 'administrator')
                        <a href="{{ route('admin.dashboard') }}">
                            <img src="{{ asset('images/INNOVX-TTP.png') }}" class="block h-9 w-auto" alt="Company Logo"/>
                        </a>
                    @elseif(auth()->user()->role === 'manager')
                        <a href="{{ route('dashboard') }}">
                            <img src="{{ asset('images/INNOVX-TTP.png') }}" class="block h-9 w-auto" alt="Company Logo"/>
                        </a>
                    @else
                        <a href="{{ route('engineers.dashboard') }}">
                            <img src="{{ asset('images/INNOVX-TTP.png') }}" class="block h-9 w-auto" alt="Company Logo"/>
                        </a>
                    @endif
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                @if (auth()->user()->role === 'administrator')
                    <x-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')">
                        {{ __('Dashboard') }}
                    </x-nav-link>
                @elseif(auth()->user()->role === 'manager')

                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('Dashboard') }}
                    </x-nav-link>
                @else
                    <x-nav-link :href="route('engineers.dashboard')" :active="request()->routeIs('engineers.dashboard')">
                        {{ __('Dashboard') }}
                    </x-nav-link>
                @endif
                </div>
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    @if (auth()->user()->role === 'administrator')
                         <x-nav-link :href="route('admin.create-user')" :active="request()->routeIs('admin.create-user')">
                            {{ __('Add User') }}
                        </x-nav-link>
                    
                    @elseif(auth()->user()->role === 'manager')
                        <x-nav-link :href="route('projects.index')" :active="request()->routeIs('projects.index')">
                            {{ __('Projects') }}
                        </x-nav-link>
                    @else

                    @endif
                </div>
            </div>
            
            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
            @if(auth()->user()->role === 'engineer')
                <div  class="m-3">
                    <a href="{{ route('tasks.pending') }}" >
                    
                        @if($pendingTasksCount > 0)
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" width="29" height="29" viewBox="0 0 256 256" xml:space="preserve">
                            <defs>
                            </defs>
                            <g style="stroke: none; stroke-width: 0; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: none; fill-rule: nonzero; opacity: 1;" transform="translate(1.4065934065934016 1.4065934065934016) scale(2.81 2.81)" >
                                <path d="M 58.47 76.439 c 0 0.029 0.004 0.057 0.004 0.087 C 58.475 83.967 52.442 90 45 90 s -13.475 -6.033 -13.475 -13.475 c 0 -0.029 0.004 -0.057 0.004 -0.087 C 40.51 69.714 49.49 69.714 58.47 76.439 z" style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(188,32,32); fill-rule: nonzero; opacity: 1;" transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round" />
                                <path d="M 75.513 56.082 V 30.513 C 75.513 13.661 61.852 0 45 0 h 0 C 28.148 0 14.487 13.661 14.487 30.513 v 25.569 c 0 3.238 -1.418 6.314 -3.88 8.417 l 0 0 c -2.462 2.103 -3.88 5.179 -3.88 8.417 v 0 c 0 1.945 1.577 3.522 3.522 3.522 h 69.503 c 1.945 0 3.522 -1.577 3.522 -3.522 v 0 c 0 -3.238 -1.418 -6.314 -3.88 -8.417 l 0 0 C 76.931 62.396 75.513 59.32 75.513 56.082 z" style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(237,38,38); fill-rule: nonzero; opacity: 1;" transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round" />
                            </g>
                        </svg>


                        @endif
                    </a>

                </div>
            @endif
            @if(auth()->user()->role === 'manager')
                <div  class="m-3">
                        <a href="{{ route('projects.overdue') }}" >
                        
                            @if($overdueProjectsCount > 0)
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" width="29" height="29" viewBox="0 0 256 256" xml:space="preserve">
                                <defs>
                                </defs>
                                <g style="stroke: none; stroke-width: 0; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: none; fill-rule: nonzero; opacity: 1;" transform="translate(1.4065934065934016 1.4065934065934016) scale(2.81 2.81)" >
                                    <path d="M 58.47 76.439 c 0 0.029 0.004 0.057 0.004 0.087 C 58.475 83.967 52.442 90 45 90 s -13.475 -6.033 -13.475 -13.475 c 0 -0.029 0.004 -0.057 0.004 -0.087 C 40.51 69.714 49.49 69.714 58.47 76.439 z" style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(188,32,32); fill-rule: nonzero; opacity: 1;" transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round" />
                                    <path d="M 75.513 56.082 V 30.513 C 75.513 13.661 61.852 0 45 0 h 0 C 28.148 0 14.487 13.661 14.487 30.513 v 25.569 c 0 3.238 -1.418 6.314 -3.88 8.417 l 0 0 c -2.462 2.103 -3.88 5.179 -3.88 8.417 v 0 c 0 1.945 1.577 3.522 3.522 3.522 h 69.503 c 1.945 0 3.522 -1.577 3.522 -3.522 v 0 c 0 -3.238 -1.418 -6.314 -3.88 -8.417 l 0 0 C 76.931 62.396 75.513 59.32 75.513 56.082 z" style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(237,38,38); fill-rule: nonzero; opacity: 1;" transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round" />
                                </g>
                            </svg>


                            @endif
                        </a>

                    </div>
            @endif


                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                            <div>{{ Auth::user()->name }}</div>

                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
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
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
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
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
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
