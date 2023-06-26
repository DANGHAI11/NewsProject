@extends("layout.main")
@section("content")
    @if($postEdit)
        <main class="active">
            <div class="wrap">
                <div class="container">
                    <div class="row">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item active">Update Blog</li>
                        </ul>
                        <form class="form-create-post" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="title">
                                <p>Update Blog</p>
                            </div>
                            <div class="form-group">
                                <label for="category-id">Category<span>*</span></label>
                                <select name="categiory_id" id="category-id" class="category" value={{ $postEdit->categiory_id }}>
                                    @if ($categories )
                                        @foreach ($categories as $cate )
                                            <option value="{{ $cate->id }}" @if ($postEdit->categiory_id == $cate->id) selected @endif>{{ $cate->name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="title-id">Title<span>*</span></label>
                                <input type="text" placeholder="Title" id="title-id" name="title" value="{{ $postEdit->title }}"/>
                                @error('title')
                                <div class="error">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="">Upload image</label>
                                <div class="upload-image">Upload image</div>
                                <input type="file" name="image" class="hidden" id="image-file">
                                @error('image')
                                <div class="error">{{ $message }}</div>
                                @enderror
                                <div class="show-image">
                                    @if($postEdit->image)
                                        <img src="{{ Vite::asset('public/images/') . $postEdit->image }}" alt=""{{ $postEdit->name }} />
                                    @else
                                        <img src="{{ Vite::asset('resources/images/anh_create_post.png') }}" alt=""{{ $postEdit->name }} />
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="content">Description<span>*</span></label>
                                <textarea name="content" id="content" placeholder="Description">{{ $postEdit->content }}</textarea>
                                @error('content')
                                <div class="error">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="button">
                                <button class="button-create">Update post</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </main>
    @endif
@endsection
