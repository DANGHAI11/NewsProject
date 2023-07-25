@extends("layout.main")
@section('content')
    @if($postDetail)
        <main class="active">
            <div class="wrap">
                <div class="container">
                    <div class="row">
                        <ul class="breadcrumb @if(Route::is('detail')) details @endif">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('message.home') }}</a></li>
                            <li class="breadcrumb-item active">{{ __('message.detail_blog') }}</li>
                        </ul>
                        <div class="detail">
                            <div class="title">
                                <h1>{{ $postDetail->title }}</h1>
                            </div>
                            <div class="detail-profile">
                                <div class="row">
                                    <div class="avatar">
                                        <div class="row">
                                            <div class="avatar-user">
                                                @if ($postDetail->user->avatar)
                                                    <img src="{{ Vite::asset("public/storage/").$postDetail->user->avatar }}" alt="{{ $postDetail->user->name }}">
                                                @else
                                                    <img src="{{ Vite::asset("resources/images/avatar-user.png") }}" alt="??">
                                                @endif
                                            </div>
                                            <div class="user">
                                                <div class="name-user">{{ $postDetail->user->name }}</div>
                                                <div class="time-create-post">{{ $postDetail->created_at }}</div>
                                            </div>
                                        </div>
                                    </div>
                                    @if (Auth::check())
                                        @if(Auth::id() == $postDetail->user_id || Auth::user()->role== \App\Models\User::ROLE_ADMIN)
                                            <div class="button-approve">
                                                @if($postDetail->status == \App\Models\Post::STATUS_INACTIVE)
                                                    <div class="approve_active not-approve">{{ __('message.not_approved') }}</div>
                                                @else
                                                    <div class="approve_active">{{ __('message.approved') }}</div>
                                                @endif
                                                <a class="approve_active edit-post" href="{{ route('post.edit',['postEdit' => $postDetail]) }}">
                                                    {{ __('message.edit_blog') }}
                                                </a>
                                                <div class="delete-post">{{ __('message.delete_blog') }}</div>
                                            </div>
                                        @endif
                                    @endif
                                </div>
                            </div>
                            <div class="image-post">
                                <img src="{{ Vite::asset("public/storage/").$postDetail->image }}" alt="{{ $postDetail->title }}">
                            </div>
                            <div class="content">{!! nl2br(e($postDetail->content)) !!}</div>
                            <div class="release-heart" @if(Auth::check()) data-url="{{ route('post.like', ['post' => $postDetail]) }}" @endif>
                                <i class="fa-solid fa-heart @if($statusLike) active @endif"></i> <span>{{ $totalLike }}</span>
                            </div>
                        </div>
                        @if($postRelated)
                            <div class="related">
                                <div class="title-post-detail">{{ __('message.related') }}</div>
                                <div class="row related-slider">
                                    @foreach ($postRelated as $related)
                                        <div class="card">
                                            <a href="{{ route('detail',['postDetail' => $related]) }}">
                                                <div class="card-img">
                                                    <img src="{{ Vite::asset("public/storage/").$related->image }}" alt="{{ $related->title }}">
                                                </div>
                                                <div class="card-content">
                                                    <div class="card-title">{{ $related->title }}</div>
                                                </div>
                                            </a>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                        <div class="comment">
                            <div class="title-post-detail">{{ __('message.comment') }} <span class="count-comment">({{ $postDetail->comments()->count() }})</span></div>
                            @if(Auth::check())
                                <form class="form-comment" method="POST" action="{{ route('comment.store') }}" >
                                    <div class="row">
                                        <div class="avatar-user">
                                            @if (Auth::user()->avatar)
                                                <img src="{{ Vite::asset("public/storage/").Auth::user()->avatar }}" alt="">
                                            @else
                                                <img src="{{ Vite::asset('resources/images/avatar-user-comment.png') }}" alt="">
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            @csrf
                                            <input type="hidden" name="post_id" value="{{ $postDetail->id }}">
                                            <input
                                                type="text"
                                                name="content"
                                                id="contentComment"
                                                placeholder="{{ __('comment.text_comment') }}"
                                                required
                                            >
                                            <button>{{ __('message.send') }}</button>
                                        </div>
                                    </div>
                                </form>
                            @endif
                            <div class="search-comment">
                                <div class="comment-message"></div>
                                <select class="order-comment" data-url="{{ route('comment.view.more') }}" data-post="{{ $postDetail->id }}">
                                    <option value="DESC">{{ __('comment.latest') }}</option>
                                    <option value="ASC">{{ __('comment.oldest') }}</option>
                                </select>
                            </div>
                            <div class="comment-list">
                                <div class="row user-comment">
                                    @include('partials.comment', ['comments' => $comments])
                                </div>
                            </div>
                            @if($postDetail->comments()->count() > \App\Models\Post::HOME_LIMIT )
                            <div class="comment-load-more"
                                data-post="{{ $postDetail->id }}"
                                data-url="{{ route('comment.view.more') }}"
                                data-last-page="{{ $comments->lastPage() }}"
                                >
                                {{ __('comment.load_more') }}(<span class="comment-page">{{ $comments->lastPage() - 1}}</span>)
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </main>
    @endif
    @include("partials.popup",['postDelete' => $postDetail])
@endsection
@push('js')
    @vite(['resources/js/like.js','resources/js/comment.js'])
@endpush

