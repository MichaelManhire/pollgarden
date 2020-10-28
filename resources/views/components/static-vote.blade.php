@props(['vote'])

<li class="mt-8">
    <div class="bg-white shadow overflow-hidden sm:rounded-md">
        <x-poll :poll="$vote->poll()" />
    </div>

    <article class="mt-3 ml-4 md:ml-8">
        <div class="bg-white overflow-hidden shadow rounded-lg">
            <div class="px-2 py-2.5 sm:p-3">
                <p class="flex items-center text-sm font-medium">
                    <span style="color: {{ $vote->caster->votedOptionIn($vote->poll())->color() }};">
                        <x-icons.vote />
                    </span>
                    <span class="inline-block ml-1">{{ $vote->caster->votedOptionIn($vote->poll())->name }}</span>
                </p>
            </div>
        </div>
    </article>
</li>
