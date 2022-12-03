<nav class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <x-application-logo class="block h-10 w-auto fill-current text-gray-600" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class=" space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('Dashboard') }}
                    </x-nav-link>

                    <x-nav-link :href="route('items.index')" :active="request()->routeIs('items.*')">
                        {{ __('Items') }}
                    </x-nav-link>
                    <x-nav-link :href="route('users.index')" :active="request()->routeIs('users.*')">
                        {{ __('Users') }}
                    </x-nav-link>
                    <x-nav-link :href="route('admins.index')" :active="request()->routeIs('admins.*')">
                        {{ __('Admins') }}
                    </x-nav-link>
                    <x-nav-link :href="route('roles.index')" :active="request()->routeIs('roles.*')">
                        {{ __('Roles') }}
                    </x-nav-link>
                    <x-nav-link :href="route('categories.index')" :active="request()->routeIs('categories.*')">
                        {{ __('category.title') }}
                    </x-nav-link>
                    <x-nav-link :href="route('subcategories.index')" :active="request()->routeIs('subcategories.*')">
                        {{ __('Sub Categories') }}
                    </x-nav-link>
                </div>
            </div>


            <div class="hidden sm:flex sm:items-center sm:ml-6">
                <div class="mr-4">{{ Auth::user()->name }}</div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-button class="capitalize">
                        {{ __('Log Out') }}
                    </x-button>
                </form>
            </div>



        </div>
    </div>

</nav>
