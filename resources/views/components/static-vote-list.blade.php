@props(['votes'])

<ol>
    @foreach ($votes as $vote)
        <x-static-vote :vote="$vote" />
    @endforeach
</ol>
