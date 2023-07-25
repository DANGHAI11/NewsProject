@if ($comments)
    @foreach ($comments as $comment)
        <div class="avatar-user" data-delete="{{ $comment->id }}">
            @if (isset($comment->user->avatar))
                <img src="{{ Vite::asset("public/storage/").$comment->user->avatar }}" alt="">
            @else
                <img src="{{ Vite::asset('resources/images/avatar-user-comment.png') }}" alt="">
            @endif
        </div>
        <div class="content" data-delete="{{ $comment->id }}">
            <div class="content-card">
                <div class="user-name">{{ $comment->user->name }}</div>
                <div class="comment-user">{{ $comment->content }}</div>
                <div class="time">{{ $comment->created_at->diffForHumans() }}</div>
                @canany(['update','delete'], $comment)
                    <div class="icon-comment">
                        <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 128 512">
                            <path d="M64 360a56 56 0 1 0 0 112 56 56 0 1 0 0-112zm0-160a56 56 0 1 0 0 112 56 56 0 1 0 0-112zM120 96A56 56 0 1 0 8 96a56 56 0 1 0 112 0z"/>
                        </svg>
                    </div>
                    <div class="button-comment">
                        <div class="comment-edit">{{ __('comment.edit') }}</div>
                        <button class="comment-delete comment-delete{{ $comment->id }}" data-id="{{ $comment->id }}">{{ __('message.delete') }}</button>
                    </div>
                    <form action="{{ route('comment.delete',['comment' => $comment]) }}" method="post" data-id="{{ $comment->id }}" id="commentDelete{{ $comment->id }}">
                        @method("DELETE")
                        @csrf
                        <button type="submit">{{ __('message.send') }}</button>
                    </form>
                    <form action="{{ route('comment.update',['comment' => $comment]) }}" method="post" class="comment-update">
                        @method("PUT")
                        @csrf
                        <textarea name="content" id="editCommentText" placeholder="{{ __('comment.text_comment') }}" required>{{ $comment->content }}</textarea>
                        <button>{{ __('comment.edit') }}</button>
                    </form>
                @endcan
            </div>
        </div>
    @endforeach
@endif

