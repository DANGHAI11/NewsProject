@extends('admin.layout.index')
@section('content')
<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="row justify-content-between align-items-center align-content-center m-0">
                    <h4 class="card-title col-2 m-0">{{ __('admin.list_categories') }} ({{ $categories->total() }})</h4>
                    <form action="" method="get" class="row m-0 col-7 w-100">
                        <div class="form-group m-0 col-5">
                            <input class="form-control" type="text" name="name" placeholder="Category name" value="{{ request()->name }}">
                        </div>
                        <select class="form-control m-0 col-2 mr-3" name="limit_page" id="limitPage" >
                            @foreach ($pageLimit as $value)
                                <option value={{ $value }} @if(request()->limit_page == $value) selected @endif>{{ $value }}</option>
                            @endforeach
                        </select>
                        <div class="form-group m-0 col-2 p-0">
                            <button class="btn btn-primary">{{ __('admin.search') }}</button>
                        </div>
                    </form>
                    <a class="btn btn-success" href="{{ route('admin.category.create') }}">{{ __('admin.create') }}</a>
                </div>
                <div class="table-responsive">
                    <table class="table mb-5">
                        <thead>
                            <tr>
                                <th class="col-1">ID</th>
                                <th class="col-1">Name</th>
                                <th class="col-2">Posts</th>
                                <th class="col-1">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                                @foreach ($categories as $category)
                                    <tr>
                                        <td>{{ $category->id }}</td>
                                        <td>{{ $category->name }}</td>
                                        <td>{{ $category->posts()->count() }}</td>
                                        <td>
                                            <div class="row-icon">
                                                <div class="col-4">
                                                    <a href="{{ route('admin.post.index') }}?category={{ $category->id }}" target="_blank" class="icon badge-info"><i class="fa-solid fa-eye"></i></a>
                                                </div>
                                                <div class="col-4">
                                                    <a href="{{ route('admin.category.edit', ['category' => $category]) }}" class="icon badge-success"><i class="fa-solid fa-pen-to-square"></i></a>
                                                </div>
                                                <div class="col-4">
                                                    <form action="{{ route('admin.category.delete', ['category' => $category]) }}" method="post" id="formCategoryDelete">
                                                        @csrf
                                                        @method("DELETE")
                                                        <button class="icon badge-danger" id="categoryDelete"><i class="fa-solid fa-trash"></i></button>
                                                    </form>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                        </tbody>
                    </table>
                    {{ $categories->links('partials.pagination', ['data' => $categories]) }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
