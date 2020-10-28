<div class="relative flex items-center {{ $index === 0 ?: 'mt-2' }}">
    <label class="ballot-box-option relative flex-grow flex justify-between py-5 pl-12 pr-4 font-medium leading-tight bg-gray-100 hover:bg-gray-200 rounded-md cursor-pointer base-transition" for="{{ $option->id }}">
        <input
            class="ballot-box-chad"
            id="{{ $option->id }}"
            name="option_id"
            type="radio"
            value="{{ $option->id }}"
            required
            {{ Auth::check() && Auth::user()->hasVotedIn($poll) && $option->id === Auth::user()->votedOptionIn($this->poll)->id ?'checked' : '' }}
            @if (Auth::check() && ! Auth::user()->hasVotedIn($poll))
            wire:change="$emit('submitVote', {{ $option->id }})"
            @elseif (Auth::check() && Auth::user()->hasVotedIn($poll))
            wire:change="$emit('updateVote', {{ $option->id }})"
            @endif
        >

        <span class="relative z-10">{{ $option->name }}</span>

        <span class="ballot-box-result-stats relative z-10 whitespace-no-wrap">
            <span class="inline-block ml-4">{{ $numberOfVotes }} {{ Str::plural('vote', $numberOfVotes) }}</span>
            <span class="inline-block ml-2">{{ $option->percentage($numberOfVotes, $totalVotes) }}</span>
        </span>

        <span
            class="ballot-box-result-bar"
            style="background: {{ $option->color() }}; max-width: {{ Auth::check() ? (Auth::user()->hasVotedIn($poll) ? $option->percentage($numberOfVotes, $totalVotes) : '0%') : $option->percentage($numberOfVotes, $totalVotes) }};"
            data-percentage="{{ $option->percentage($numberOfVotes, $totalVotes) }}"
            x-data="{}"
            x-on:show-results.window="setTimeout(() => $el.style.maxWidth = $el.dataset.percentage, 50)"
        ></span>
    </label>

    <template x-if="isShowingVoters">
        <div class="absolute right-2 z-10 ml-5 text-gray-500">
            <x-avatar-group :users="$option->voters()" />
        </div>
    </template>
</div>
