@extends('layout.master')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <h2 class="text-3xl font-semibold mb-4">{{ __('Friends') }}</h2>

        <!-- Search and Filter Form -->
        <form action="{{ route('profile.friends') }}" method="GET" class="mb-4">
            <div class="flex items-center">
                <div class="flex-shrink-0 mr-2">
                    <label for="gender_filter" class="block text-gray-700 text-sm font-bold">{{ __('Gender') }}</label>
                    <select name="gender_filter" id="gender_filter" class="form-select block w-full mt-1">
                        <option value="all" @if ($genderFilter === 'all') selected @endif>{{ __('All') }}</option>
                        <option value="male" @if ($genderFilter === 'male') selected @endif>{{ __('Male') }}</option>
                        <option value="female" @if ($genderFilter === 'female') selected @endif>{{ __('Female') }}</option>
                    </select>
                </div>
                <div class="flex-shrink-0">
                    <label for="hobby_filter" class="block text-gray-700 text-sm font-bold">{{ __('Hobby/Job') }}</label>
                    <input type="text" name="hobby_filter" id="hobby_filter" class="form-input block w-full mt-1" placeholder="{{ __('Enter hobby/job') }}" value="{{ $hobbyFilter }}">
                </div>
                <div class="ml-4">
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                        {{ __('Apply Filter') }}
                    </button>
                </div>
            </div>
        </form>

        <!-- Friend List -->
        @if ($friends->isEmpty())
            <p class="text-gray-600">{{ __('You have no friends yet.') }}</p>
        @else
            <ul class="grid gap-4">
                @foreach ($friends as $friend)
                    <li class="p-4 bg-white rounded-lg shadow-md">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 mr-4">
                                <!-- Add user profile picture here if available -->
                                <img class="h-12 w-12 rounded-full object-cover" src="https://via.placeholder.com/150" alt="{{ $friend->name }}">
                            </div>
                            <div>
                                <h3 class="text-lg font-semibold">{{ $friend->name }}</h3>
                                <!-- Add additional friend information here, if available -->
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>
@endsection
