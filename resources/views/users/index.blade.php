<x-app-layout>
    <x-slot name="title">{{ __('Members') }} - Poll Garden</x-slot>
    <x-slot name="robots">noindex,follow</x-slot>

    <x-container class="container py-10">
        <x-page-heading class="mb-4">{{ __('Members') }}</x-page-heading>

        <ol class="flex flex-wrap -m-2">
            @foreach ($users as $user)
                <li class="flex-none m-2">
                    <x-user :user="$user" />
                </li>
            @endforeach
        </ol>

        <div class="pt-6">
            {{ $users->onEachSide(0)->links() }}
        </div>
    </x-container>
</x-app-layout>
