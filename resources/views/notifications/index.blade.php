@extends('layout.master')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <h2 class="text-3xl font-semibold mb-4">{{ __('Notifications') }}</h2>

        @if ($notifications->isEmpty())
            <p class="text-gray-600">{{ __('You have no notifications.') }}</p>
        @else
            <ul>
                @foreach ($notifications as $notification)
                    <li class="mb-4">
                        <a href="{{ $notification->data['link'] }}" class="text-blue-500 hover:underline">{{ $notification->data['message'] }}</a>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>
@endsection
