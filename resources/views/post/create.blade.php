@extends("layout.main")
@section("content")
    <main class="active">
        <div class="wrap">
            <div class="container">
                <div class="row">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('message.home') }}</a></li>
                        <li class="breadcrumb-item active">{{ __('message.create_blog') }}</li>
                    </ul>
                    <form class="form-create-post" method="POST" enctype="multipart/form-data" action="{{ route('post.store') }}">
                        @csrf
                        <div class="title">
                            <p>{{ __('message.create_blog') }}</p>
                        </div>
                        <div class="form-group">
                            <label for="category-id">{{ __('message.category') }}<span>*</span></label>
                            <select name="categiory_id" id="category-id" class="category">
                                @if ($categories )
                                    @foreach ($categories as $cate )
                                        <option value="{{ $cate->id }}">{{ $cate->name }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="title-id">{{ __('message.title') }}<span>*</span></label>
                            <input type="text" placeholder="{{ __('message.title') }}" id="title-id" name="title"/>
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
                                <img src="{{ Vite::asset('resources/images/anh_create_post.png') }}" alt=""/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="content">{{ __('message.description') }}<span>*</span></label>
                            <textarea name="content" id="content" placeholder="{{ __('message.description') }}"></textarea>
                            @error('content')
                            <div class="error">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="button">
                            <button class="button-create">{{ __('message.create_blog') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>

@endsection
