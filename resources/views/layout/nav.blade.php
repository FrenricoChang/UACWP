<nav class="flex items-center justify-between flex-wrap bg-blue-500 p-6">
    <div class="flex items-center flex-shrink-0 text-white mr-6">
        <a href="{{ route('home') }}" class="text-white text-xl font-semibold">{{ config('app.name', 'Laravel') }}</a>
    </div>
    <div class="w-full block flex-grow lg:flex lg:items-center lg:w-auto">
        <div class="lg:flex-grow">
            <!-- Add other navigation links here -->
            <a href="{{ route('home') }}" class="block mt-4 lg:inline-block lg:mt-0 text-white hover:underline mr-4">Home</a>
            <a href="{{ route('profile.friends') }}" class="block mt-4 lg:inline-block lg:mt-0 text-white hover:underline mr-4">Friends</a>
            <!-- Add other navigation links as needed -->

            @auth
                <a href="{{ route('notifications.index') }}" class="block mt-4 lg:inline-block lg:mt-0 text-white hover:underline mr-4">
                    {{ __('Notifications') }}
                    @if (Auth::user()->unreadNotifications->count() > 0)
                        <span class="bg-red-600 text-white rounded-full px-2 py-1 text-xs">{{ Auth::user()->unreadNotifications->count() }}</span>
                    @endif
                </a>
                <a href="{{ route('logout') }}" class="block mt-4 lg:inline-block lg:mt-0 text-white hover:underline">
                    {{ __('Logout') }}
                </a>
            @endauth
        </div>
    </div>
</nav>
