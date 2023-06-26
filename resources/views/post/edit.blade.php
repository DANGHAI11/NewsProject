@extends("layout.main")
@section("content")
    @if($postEdit)
        <main class="active">
            <div class="wrap">
                <div class="container">
                    <div class="row">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('message.home') }}</a></li>
                            <li class="breadcrumb-item active">{{ __('message.update_blog') }}</li>
                        </ul>
                        <form class="form-create-post" method="POST" enctype="multipart/form-data" action="{{ route('post.update',['postUpdate' => $postEdit]) }}">
                            @csrf
                            @method('PUT')
                            <div class="title">
                                <p>{{ __('message.update_blog') }}</p>
                            </div>
                            <div class="form-group">
                                <label for="category-id">{{ __('message.category') }}<span>*</span></label>
                                <select name="categiory_id" id="category-id" class="category">
                                    @if ($categories )
                                        @foreach ($categories as $cate )
                                            <option value="{{ $cate->id }}" @if ($postEdit->categiory_id == $cate->id) selected @endif>{{ $cate->name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="title-id">{{ __('message.title') }}<span>*</span></label>
                                <input type="text" placeholder="{{ __('message.title') }}" id="title-id" name="title" value="{{ $postEdit->title }}"/>
                                @error('title')
                                <div class="error">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="">{{ __('message.upload_image') }}</label>
                                <div class="btn-upload-image">{{ __('message.upload_image') }}</div>
                                <input type="file" name="image" class="hidden" id="upload-image">
                                @error('image')
                                <div class="error">{{ $message }}</div>
                                @enderror
                                <div class="show-image">
                                    @if($postEdit->image)
                                        <img src="{{Vite::asset("public/storage/") . $postEdit->image }}" alt=""{{ $postEdit->name }} />
                                    @else
                                        <img src="{{ Vite::asset('resources/images/anh_create_post.png') }}" alt=""{{ $postEdit->name }} />
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="content">{{ __('message.description') }}<span>*</span></label>
                                <textarea name="content" id="content" placeholder="Description">{{ $postEdit->content }}</textarea>
                                @error('content')
                                <div class="error">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="button">
                                <button class="button-create">{{ __('message.update_blog') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </main>
    @endif
@endsection
