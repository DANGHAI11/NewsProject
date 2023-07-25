@extends('admin.layout.index')
@section('content')
<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="row justify-content-between align-items-center align-content-center m-0">
                    <h4 class="card-title col-md-2 m-0">{{ __('admin.list_post') }} ({{ $posts->total() }})</h4>
                    <form action="" method="get" class="row m-0 col-md-8 w-100">
                        <div class="form-group m-0 col-md-3 px-2">
                            <input class="form-control p-1" type="text" name="title" placeholder="Title" value="{{ request()->title }}">
                        </div>
                        <div class="form-group m-0 col-md-1 p-0 pr-2">
                            <input class="form-control p-1" type="text" name="id" placeholder="ID" value="{{ request()->id }}">
                        </div>
                        <select class="form-control m-0 col-md-2 mr-2 px-1" name="category" >
                            <option value="all" @if(request()->status == "all") selected @endif>All</option>
                            @foreach ($categories as $item)
                                <option value={{ $item->id }} @if(request()->category == $item->id) selected @endif>{{ $item->name }}</option>
                            @endforeach
                        </select>
                        <select class="form-control m-0 col-md-1 p-1 px-2 mr-1" name="limit_page" id="limitPage">
                            @foreach ($pageLimit as $value)
                                <option value={{ $value }} @if(request()->limit_page == $value) selected @endif>{{ $value }}</option>
                            @endforeach
                        </select>
                        <div class="form-group m-0 col-md-3 px-1">
                            <select class="form-control" name="status" id="">
                                <option value="all" @if(request()->status == 'all') selected @endif>All</option>
                                <option value={{ \App\Models\Post::STATUS_ACTIVE }} @if(request()->status == \App\Models\Post::STATUS_ACTIVE) selected @endif>{{ __('admin.approved') }}</option>
                                <option value={{ \App\Models\Post::STATUS_INACTIVE }} @if(request()->status == \App\Models\Post::STATUS_INACTIVE) selected @endif>{{ __('admin.not_approved') }}</option>
                            </select>
                        </div>
                        <div class="form-group m-0 col-md-1 p-0">
                            <button class="btn btn-primary">Search</button>
                        </div>
                    </form>
                    <form action="{{ route('admin.post.approved.all') }}" method="post" class="row col-md-2 justify-content-end align-content-end m-0" id="formApprovedAll">
                        @csrf
                        @method('PUT')
                        <button class="btn btn-success" id="approvedAll">{{ __('admin.approved_all') }}</button>
                    </form>
                </div>
            <div class="table-responsive">
                <table class="table mb-5">
                    <thead>
                        <tr>
                            <th class="col-1">ID</th>
                            <th class="col-1">Image</th>
                            <th class="col-1">Title</th>
                            <th class="col-1">User</th>
                            <th class="col-1">Category</th>
                            <th class="col-1">Status</th>
                            <th class="col-1">Comment & Like</th>
                            <th class="col-1">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                            @foreach ($posts as $post)
                                <tr>
                                    <td content="post-id">{{ $post->id }}</td>
                                    <td content="post-image"> <img src="{{ Vite::asset('public/storage/').$post->image }}" alt=""></td>
                                    <td content="post-title">{{ Str::limit($post->title, 30, '...') }}</td>
                                    <td content="post-content">{{ $post->user->name }}</td>
                                    <td>{{ $post->categories->name }}</td>
                                    <td content="post-status">
                                        <form action="{{ route('admin.post.approved', ['post' => $post]) }}" method="post">
                                            @csrf
                                            @method("PUT")
                                            @if($post->status === \App\Models\Post::STATUS_INACTIVE)
                                                <button class="btn-approved badge badge-danger">{{ __('admin.not_approved') }}</button>
                                            @else
                                                <button class="btn-approved badge badge-success">{{ __('admin.approved') }}</button>
                                            @endif
                                        </form>
                                    </td>
                                    <th>
                                        <div class="row-icon">
                                            <div class="col-12 icon-comment-heart">
                                                <i class="fa-solid fa-comment icon-comment"></i><span>{{ $post->comments()->count() }}</span>
                                            </div>
                                            <div class="col-12 icon-comment-heart">
                                                <i class="fa-solid fa-heart icon-heart"></i><span>{{ $post->likes()->count() }}</span>
                                            </div>
                                        </div>
                                    </th>
                                    <td>
                                        <div class="row-icon">
                                            <div class="col-4">
                                                <a href="{{ route('detail', ['postDetail' => $post]) }}" target="_blank" class="icon badge-info"><i class="fa-solid fa-eye"></i></a>
                                            </div>
                                            <div class="col-4">
                                                <a href="{{ route('post.edit', ['postEdit' => $post]) }}" target="_blank" class="icon badge-success"><i class="fa-solid fa-pen-to-square"></i></a>
                                            </div>
                                            <div class="col-4">
                                                <form action="{{ route('admin.post.delete', ['post' => $post]) }}" method="post" id="formPostDelete">
                                                    @csrf
                                                    @method("DELETE")
                                                    <button class="icon badge-danger" id="postDelete"><i class="fa-solid fa-trash"></i></button>
                                                </form>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                    </tbody>
                </table>
                {{ $posts->links('partials.pagination', ['data' => $posts]) }}
            </div>
            </div>
        </div>
    </div>
</div>
@endsection
