@props(['poll'])

<a class="block hover:bg-gray-50 focus:outline-none focus:bg-gray-50 transition" href="{{ route('polls.show', $poll) }}">
    <div class="flex items-center px-4 py-4 sm:px-6">
        <div class="min-w-0 flex-1 flex items-start">
            <div class="flex-shrink-0">
                <x-image :src="$poll->image()" />
            </div>

            <div class="min-w-0 flex-1 px-4 md:grid md:grid-cols-2 md:gap-4">
                <div>
                    <div class="text-sm leading-5 font-medium text-green-600">{{ $poll->title }}</div>

                    <x-byline :author="$poll->author" :time="$poll->created_at" class="mt-2" is-linked="{{ false }}" />
                </div>

                <div class="hidden md:block">
                    <div>
                        <div class="text-sm leading-5 text-gray-900">
                            <x-badge :color="$poll->category->color()">{{ $poll->category->name }}</x-badge>
                        </div>

                        <div class="mt-2 flex items-center">
                            @livewire('poll-stats', ['votes' => $poll->votes->count(), 'comments' => $poll->comments->count()])
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="text-gray-400">
            <x-icons.chevron-right />
        </div>
    </div>
</a>
