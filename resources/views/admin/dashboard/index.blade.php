@extends('admin.layout.index')
@section('content')
<div class="row">
    <div class="col-md-12 grid-margin">
        <div class="row">
            <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                <h3 class="font-weight-bold">{{ __('admin.title_dashboard') }}</h3>
                <h6 class="font-weight-normal mb-0">{{ __('admin.content') }}</h6>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12 grid-margin transparent">
        <div class="row">
            <div class="col-md-3 mb-4 stretch-card transparent">
                <div class="card card-tale">
                    <div class="card-body">
                        <p class="mb-4">{{ __('admin.total_user') }}</p>
                        <p class="fs-30 mb-2">{{ $totalUser }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-4 stretch-card transparent">
                <div class="card card-dark-blue">
                    <div class="card-body">
                        <p class="mb-4">{{ __('admin.total_post') }}</p>
                        <p class="fs-30 mb-2">{{ $totalPost }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-4 stretch-card transparent">
                <div class="card card-light-blue">
                    <div class="card-body">
                        <p class="mb-4">{{ __('admin.total_comment') }}</p>
                        <p class="fs-30 mb-2">{{ $totalComment }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-4 stretch-card transparent">
                <div class="card card-light-danger">
                    <div class="card-body">
                        <p class="mb-4">{{ __('admin.total_category') }}</p>
                        <p class="fs-30 mb-2">{{ $totalCategory }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
