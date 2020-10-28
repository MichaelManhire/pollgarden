@props(['comments'])

<ol>
    @foreach ($comments as $comment)
        <x-static-comment :comment="$comment" />
    @endforeach
</ol>
