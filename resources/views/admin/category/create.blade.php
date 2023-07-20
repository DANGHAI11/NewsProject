@extends('admin.layout.index')
@section('content')
<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">{{ __('admin.create_category') }}</h4>
                <form class="forms-sample" method="POST" action="{{ route('admin.category.store') }}">
                    @csrf
                    <div class="form-group">
                        <label for="NameCategory">{{ __('admin.name') }}</label>
                        <input type="text" class="form-control" id="NameCategory" placeholder="Category Name" name="name">
                    </div>
                    <button type="submit" class="btn btn-primary mr-2">{{ __('admin.create') }}</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
