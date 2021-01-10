@props(['users'])

@if ($users->count())
    <ul class="flex">
        @foreach ($users as $user)
            <li class="{{ $loop->first ?: '-ml-2' }}">
                <a class="block" href="{{ route('users.show', $user) }}" title="{{ $user->name }}">
                    <img
                        class="inline-block w-8 h-8 rounded-full text-white bg-gray-100 ring-2 ring-white"
                        src="{{ $user->profile_photo_url }}"
                        alt="{{ $user->name }}"
                        width="32"
                        height="32"
                        loading="lazy"
                    >
                    <span class="sr-only">{{ $user->name }}</span>
                </a>
            </li>
        @endforeach
    </ul>
@endif
