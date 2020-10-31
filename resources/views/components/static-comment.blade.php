@props(['comment'])

<li class="mt-8">
    <div class="bg-white shadow overflow-hidden sm:rounded-md">
        <x-poll :poll="$comment->poll" />
    </div>

    <article class="mt-3 ml-4 md:ml-8">
        <div class="bg-white overflow-hidden shadow rounded-lg">
            <div class="flex items-start px-2 py-2.5 sm:p-3">
                <div class="flex-shrink-0">
                    <x-avatar :user="$comment->author" />
                </div>

                <div class="ml-4 text-sm">
                    <p>{{ $comment->body }}</p>
                </div>
            </div>
        </div>
    </article>
</li>
