@foreach ($replies as $reply)
    <div class="comment-list ms-4 mb-3">
        <div class="comment p-3 rounded">
            <div class="fw-semibold mb-1">{{ $reply->commenter_name }}</div>
            <div>{!! nl2br(e($reply->content)) !!}</div>
            <div>
                <span class="text-muted small font-monospace">
                    {{ $reply->created_at->format('F j, Y, g:i a') }}
                </span>
            </div>

            <!-- Nested reply form -->
            <form action="{{ route('comments.store') }}" method="POST" class="mt-3">
                @csrf
                <input type="hidden" name="post_id" value="{{ $postId }}">
                <input type="hidden" name="parent_id" value="{{ $reply->id }}">
                <div class="mb-2 ms-2">
                    <textarea class="form-control" name="content" rows="2" placeholder="Write a reply..." required></textarea>
                </div>
                <button type="submit" class="btn btn-sm btn-outline-primary ms-2">Reply</button>
            </form>

            {{-- Recursively show more replies --}}
            @if ($reply->replies->isNotEmpty())
                @include('posts.partials.replies', ['replies' => $reply->replies, 'postId' => $postId])
            @endif
        </div>
    </div>
@endforeach
