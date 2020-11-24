<section
    class="bg-white overflow-hidden shadow rounded-lg"
    x-data="{
        isShowingResults: {{ ! Auth::check() || Auth::user()->hasVotedIn($poll) ? 1 : 0 }},
        isShowingVoters: false,
    }"
    x-bind:class="{ 'ballot-box-hidden-results': !isShowingResults }"
    x-on:show-results.window="isShowingResults = true; isShowingVoters = false"
    x-on:show-voters.window="isShowingVoters = true; isShowingResults = false"
>
    <div class="border-b border-gray-200 px-4 py-5 sm:px-6">
        <x-media-object>
            <x-slot name="media">
                <x-image :src="$poll->image()" class="w-16 h-16" width="64" height="64" />
            </x-slot>

            <x-slot name="body">
                <h1 class="font-semibold text-xl md:text-2xl leading-tight">{{ $poll->title }}</h1>

                <div class="md:flex md:items-baseline mt-2">
                    <x-byline :author="$poll->author" :time="$poll->created_at" />

                    <div class="flex items-baseline text-sm">
                        @can('update', $poll)
                            <x-link class="mt-2 md:ml-2" href="{{ route('polls.edit', $poll) }}">{{ __('Edit Poll') }}</x-link>
                        @endcan

                        @can('delete', $poll)
                            <x-form
                                class="ml-2"
                                action="{{ route('polls.destroy', $poll) }}"
                                method="DELETE"
                                x-data="{ isOpen: false }"
                            >
                                <x-button-tertiary x-on:click="isOpen = true">{{ __('Delete Poll') }}</x-button-tertiary>

                                <x-modal>
                                    <x-slot name="heading">{{ __('Delete Poll') }}</x-slot>
                                    <x-slot name="body">{{ __('Are you sure you want to delete your poll?') }}</x-slot>
                                    <x-slot name="primary">{{ __('Delete Poll') }}</x-slot>
                                    <x-slot name="secondary">{{ __('Cancel') }}</x-slot>
                                </x-modal>
                            </x-form>
                        @endcan
                    </div>
                </div>
            </x-slot>
        </x-media-object>
    </div>

    <div class="px-4 py-5 sm:p-6 @guest pointer-events-none @endguest">
        <form>
            <fieldset>
                <legend class="sr-only">{{ $poll->title }}</legend>

                @foreach ($poll->options as $option)
                    @livewire('ballot-box-option', [
                        'index' => $loop->index,
                        'option' => $option,
                        'poll' => $poll,
                    ], key($option->id))
                @endforeach
            </fieldset>
        </form>
    </div>

    <div class="border-t border-gray-200 px-4 py-4 sm:px-6">
        <div class="flex justify-between items-start md:items-center">
            <x-badge :color="$poll->category->color()">{{ $poll->category->name }}</x-badge>

            <div class="md:flex md:items-center">
                <div class="flex md:inline-block justify-end ml-2">
                    @livewire('poll-stats', ['votes' => $poll->votes->count(), 'comments' => $poll->comments->count()])
                </div>

                @auth
                    <div class="flex mt-4 md:mt-0">
                        <x-button-tertiary class="ml-4" x-on:click="$dispatch('show-results')" x-show="! isShowingResults">
                            {{ __('Show Results') }}
                        </x-button-tertiary>

                        <x-button-tertiary class="ml-4" x-on:click="$dispatch('show-voters')" x-show="! isShowingVoters">
                            {{ __('Show Voters') }}
                        </x-button-tertiary>

                        @if (Auth::user()->hasVotedIn($poll))
                            <x-form class="ml-4" action="{{ route('votes.destroy', Auth::user()->voteIn($poll)) }}" method="DELETE" style="position: relative; top: -1px;">
                                <x-button-tertiary type="submit">{{ __('Withdraw Vote') }}</x-button-tertiary>
                            </x-form>
                        @endif
                    </div>
                @endauth
            </div>
        </div>
    </div>
</section>
