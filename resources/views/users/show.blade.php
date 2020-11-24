<x-app-layout>
    <x-slot name="title">{{ $user->name }} - Poll Garden</x-slot>
    <x-slot name="robots">noindex,follow</x-slot>

    <x-container>
        <div class="bg-white overflow-hidden shadow rounded-lg">
            <div class="sm:flex sm:items-start px-4 py-5 sm:p-6">
                <x-media-object>
                    <x-slot name="media">
                        <x-avatar :user="$user" is-large="{{ true }}" />
                    </x-slot>

                    <x-slot name="body">
                        <div class="flex items-center">
                            <x-page-heading class="mr-2">{{ $user->name }}</x-page-heading>
                            <x-user-badge :user="$user" />
                        </div>

                        <x-profile-stats :user="$user" />
                    </x-slot>
                </x-media-object>

                <x-profile-activity :user="$user" />
            </div>
        </div>

        <x-tabs x-data="{ tab: '#polls' }" x-init="function () { if (window.location.hash) { tab = window.location.hash } }">
                <x-slot name="tabs">
                    <x-tab
                        href="#polls"
                        x-bind:class="{ 'border-green-500 text-green-600 hover:border-green-500 hover:text-green-600 focus:text-green-800 focus:border-green-700 cursor-default': tab === '#polls' }"
                        x-on:click.prevent="tab = '#polls'; history.replaceState(undefined, undefined, '#polls')"
                    >
                        {{ __('Polls') }}
                    </x-tab>

                    <x-tab
                        href="#votes"
                        x-bind:class="{ 'border-green-500 text-green-600 hover:border-green-500 hover:text-green-600 focus:text-green-800 focus:border-green-700 cursor-default': tab === '#votes' }"
                        x-on:click.prevent="tab = '#votes'; history.replaceState(undefined, undefined, '#votes')"
                    >
                        {{ __('Votes') }}
                    </x-tab>

                    <x-tab
                        href="#comments"
                        x-bind:class="{ 'border-green-500 text-green-600 hover:border-green-500 hover:text-green-600 focus:text-green-800 focus:border-green-700 cursor-default': tab === '#comments' }"
                        x-on:click.prevent="tab = '#comments'; history.replaceState(undefined, undefined, '#comments')"
                    >
                        {{ __('Comments') }}
                    </x-tab>
                </x-slot>

                <x-slot name="content">
                    <section x-show="tab === '#polls'">
                        <h2 class="sr-only">{{ __('Polls') }}</h2>

                        @if ($polls->count())
                            <x-poll-list :polls="$polls" />

                            <div class="pt-6">
                                {{ $polls->onEachSide(0)->fragment('polls')->links() }}
                            </div>
                        @else
                            <p class="mt-4">{{ __('This member hasn\'t created any polls yet!') }}</p>
                        @endif
                    </section>

                    <section x-show="tab === '#votes'">
                        <h2 class="sr-only">{{ __('Votes') }}</h2>

                        @if ($votes->count())
                            <x-static-vote-list :votes="$votes" />

                            <div class="pt-6">
                                {{ $votes->onEachSide(0)->fragment('votes')->links() }}
                            </div>
                        @else
                            <p class="mt-4">{{ __('This member hasn\'t voted on any polls yet!') }}</p>
                        @endif
                    </section>

                    <section x-show="tab === '#comments'">
                        <h2 class="sr-only">{{ __('Comments') }}</h2>

                        @if ($comments->count())
                            <x-static-comment-list :comments="$comments" />

                            <div class="pt-6">
                                {{ $comments->onEachSide(0)->fragment('comments')->links() }}
                            </div>
                        @else
                            <p class="mt-4">{{ __('This member hasn\'t posted any comments yet!') }}</p>
                        @endif
                    </section>
                </x-slot>
        </x-tabs>
    </x-container>
</x-app-layout>
