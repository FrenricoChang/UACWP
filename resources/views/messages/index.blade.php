@extends('layout.master')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <h2 class="text-3xl font-semibold mb-4">{{ __('Messages') }}</h2>

        <ul class="mb-8">
            @foreach ($messages as $message)
                <li class="mb-4">
                    <strong class="text-blue-500">{{ $message->sender->name }}:</strong> {{ $message->message }}
                </li>
            @endforeach
        </ul>

        <form action="{{ route('messages.send') }}" method="post">
            @csrf
            <div class="mb-4">
                <label for="receiver_id" class="block text-gray-700 text-sm font-bold mb-2">{{ __('Receiver ID') }}</label>
                <input type="number" name="receiver_id" id="receiver_id" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
            </div>

            <div class="mb-4">
                <label for="message" class="block text-gray-700 text-sm font-bold mb-2">{{ __('Message') }}</label>
                <textarea name="message" id="message" rows="3" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required></textarea>
            </div>

            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                {{ __('Send Message') }}
            </button>
        </form>
    </div>
@endsection
