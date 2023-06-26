@extends("layout.main")
@section("content")
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
                                                    {{ __('message.edit_blog') }}</a>
                                                <div class="delete-post">{{ __('message.delete_blog') }}</div>
                                            </div>
                                        @endif
                                    @endif
                                </div>
                            </div>
                            <div class="image-post">
                                <img src="{{ Vite::asset("public/storage/").$postDetail->image }}" alt="{{ $postDetail->title }}">
                            </div>
                            <div class="content">{!! $postDetail->content !!}</div>
                            <div class="relase-heart">{{ __('message.related_heart') }}</div>
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
                            <div class="title-post-detail">{{ __('message.comment') }}</div>
                            @if(Auth::check())
                                 <form class="form-comment">
                                    <div class="row">
                                        <div class="avatar-user">
                                            @if (Auth::user()->avatar)
                                                <img src="{{ Vite::asset("public/storage/").Auth::user()->avatar }}" alt="">
                                            @else
                                                <img src="{{ Vite::asset('resources/images/avatar-user-comment.png') }}" alt="">
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <input type="text" name="content" id="content-comment">
                                            <button>{{ __('message.send') }}</button>
                                        </div>
                                    </div>
                                </form>
                            @endif
                            <div class="comment-list">
                                <div class="row user-commit">
                                    @if ($comments)
                                        @foreach ($comments as $comment)
                                        <div class="avatar-user">
                                            @if ($comment->user->avatar)
                                                <img src="{{ Vite::asset("public/storage/").$comment->user->avatar }}" alt="">
                                            @else
                                                <img src="{{ Vite::asset('resources/images/avatar-user-comment.png') }}" alt="">
                                            @endif
                                        </div>
                                        <div class="content">
                                            <div class="content-card">
                                                <div class="user-name">{{ $comment->user->name }}</div>
                                                <div class="comment-user">{{ $comment->content }}</div>
                                                <div class="time">{{ $comment->created_at->diffForHumans() }}</div>
                                            </div>
                                        </div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    @endif
@endsection

@include("partials.popup",['postDelete' => $postDetail])
