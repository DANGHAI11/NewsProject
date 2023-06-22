@extends("layout.main")
@section("content")
@if($postDetail)
<main class="active">
    <div class="wrap">
      <div class="container">
        <div class="row">
          <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item active">Detail Blog</li>
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
                         <img src="{{ Vite::asset("public/images/").$postDetail->user->avatar }}" alt="{{ $postDetail->user->name }}">
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
                @if(Auth::check())
                <div class="button-approve">
                  @if($postDetail->status == 0)
                  <div class="approve_active not-approve">Not approved</div>
                  @else
                  <div class="approve_active">Approved</div>
                  @endif
                  <div class="delete-post">Delete Blog</div>
                </div>
                @endif
              </div>
            </div>
            <div class="image-post"><img src="{{ Vite::asset("public/images/").$postDetail->image }}" alt="{{ $postDetail->title }}"></div>
            <div class="content">{{ $postDetail->content }}</div>
          </div>
          @if($postRelated)
          <div class="related">
            <div class="title-post-detail">Related</div>
            <div class="row">
              @foreach ($postRelated as $related)
              <div class="card">
                <a href="{{ route('detail',['id' => $related->id]) }}">
                  <div class="card-img">
                    <img src="{{ Vite::asset('public/images/').$related->image }}" alt="{{ $related->title }}">
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
            <div class="title-post-detail">Comment</div>
            <form class="form-comment">
              <div class="row">
                <div class="avatar-user">
                  <img src="{{ Vite::asset('resources/images/avatar-user-comment.png') }}" alt="">
                </div>
                <div class="form-group">
                  <input type="text" name="content" id="content-comment">
                  <button>Send</button>
                </div>
              </div>
            </form>
            <div class="comment-list">
              <div class="row">
                <div class="avatar-user">
                  <img src="{{ Vite::asset('resources/images/avatar-user-comment.png') }}" alt="">
                </div>
                <div class="content">
                  <div class="content-card">
                    <div class="user-name">YourName</div>
                    <div class="comment">Yes, it’s right</div>
                    <div class="time">30 phút trước</div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
</main>
<script>
  var idPost = {{ $postDetail->id }};
</script>
@endif
@endsection
