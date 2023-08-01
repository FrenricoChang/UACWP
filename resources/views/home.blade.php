@extends('layout.master')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Welcome to ConnectFriend</h1>

    <!-- Display user photos based on the selected theme -->
    <div class="grid grid-cols-2 gap-4">
        @foreach ($users as $user)
            <div class="bg-white rounded-lg shadow p-4">
                <img src="{{ $user->profile_photo_url }}" alt="{{ $user->name }}" class="w-full h-40 object-cover rounded-lg mb-4">
                <p class="text-lg font-semibold">{{ $user->name }}</p>
                <p class="text-sm">{{ $user->theme === 'casual' ? 'Casual Friend' : 'Job Friend' }}</p>
                <!-- Add other user information as needed -->

                @auth
                    <form action="{{ route('wishlist.add') }}" method="post">
                        @csrf
                        <input type="hidden" name="user_id" value="{{ $user->id }}">
                        <button type="submit" class="mt-4 bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded-lg">Add to Wishlist</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="block mt-4 bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded-lg">Login to Add to Wishlist</a>
                @endauth
            </div>
        @endforeach
    </div>
@endsection
