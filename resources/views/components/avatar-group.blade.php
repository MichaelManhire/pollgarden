@props(['users'])

@if ($users->count())
    <ul class="flex overflow-hidden">
        @foreach ($users as $user)
            <li class="{{ $loop->first ?: '-ml-2' }}">
                <a href="{{ route('users.show', $user) }}" title="{{ $user->name }}">
                    <img
                        class="inline-block rounded-full text-white shadow-solid"
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
