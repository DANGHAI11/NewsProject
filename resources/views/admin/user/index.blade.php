@extends('admin.layout.index')
@section('content')
<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="row justify-content-between align-items-center align-content-center m-0">
                    <h4 class="card-title col-2 m-0">{{ __('admin.list_user') }} ({{ $users->total() }})</h4>
                    <form action="" method="get" class="row m-0 col-8 w-100">
                        <div class="form-group m-0 col-3">
                            <input class="form-control" type="text" name="name" placeholder="name or email" value="{{ request()->name }}">
                        </div>
                        <select class="form-control m-0 col-2 mr-3" name="role">
                            <option value="all" @if(request()->role == "all") selected @endif>All</option>
                            <option value={{ \App\Models\User::ROLE_ADMIN }} @if(request()->role == \App\Models\User::ROLE_ADMIN) selected @endif>{{ __('admin.admin') }}</option>
                            <option value={{ \App\Models\User::ROLE_USER }} @if(request()->role == \App\Models\User::ROLE_USER) selected @endif>{{ __('admin.user') }}</option>
                        </select>
                        <select class="form-control m-0 col-1 p-1" name="limit_page" id="limitPage" >
                            @foreach ($pageLimit as $value)
                                <option value={{ $value }} @if(request()->limit_page == $value) selected @endif>{{ $value }}</option>
                            @endforeach
                        </select>
                        <div class="form-group m-0 col-3">
                            <select class="form-control" name="status" id="">
                                <option value="all" @if(request()->status == "all") selected @endif>All</option>
                                <option value={{ \App\Models\User::STATUS_ACTIVE }} @if(request()->status && request()->status == \App\Models\User::STATUS_ACTIVE) selected @endif>{{ __('admin.active') }}</option>
                                <option value={{ \App\Models\User::STATUS_INACTIVE }} @if(request()->status == \App\Models\User::STATUS_INACTIVE) selected @endif>{{ __('admin.inactive') }}</option>
                            </select>
                        </div>
                        <div class="form-group m-0 col-2 p-0">
                            <button class="btn btn-primary">{{ __('admin.search') }}</button>
                        </div>
                    </form>
                    <form action="{{ route('admin.user.active.all') }}" method="post" class="row col-2 justify-content-end align-content-end m-0">
                        @csrf
                        @method('PUT')
                        <button class="btn btn-success">{{ __('admin.active_all') }}</button>
                    </form>
                </div>
            <div class="table-responsive">
                <table class="table mb-5">
                    <thead>
                        <tr>
                            <th class="col-1">ID</th>
                            <th class="col-1">Avatar</th>
                            <th class="col-1">Name</th>
                            <th class="col-2">Email</th>
                            <th class="col-1">Phone</th>
                            <th class="col-1">Role</th>
                            <th class="col-1">Status</th>
                            <th class="col-1">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td>
                                        @if (isset($user->avatar))
                                            <img src="{{ Vite::asset('public/storage/') . $user->avatar }}" alt="{{ $user->name }}">
                                        @else
                                            <img src="{{ Vite::asset('resources/admin/images/faces/face28.jpg') }}" alt="{{ $user->name }}">
                                        @endif
                                    </td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->phone ? $user->phone : "NULL" }}</td>
                                    <td>
                                        @if($user->role == \App\Models\User::ROLE_ADMIN)
                                            {{ __('admin.admin') }}
                                        @else
                                            {{ __('admin.user') }}
                                        @endif
                                    </td>
                                    <td>
                                        @if ($user->id == Auth::id())
                                            @if($user->status == \App\Models\User::STATUS_INACTIVE)
                                                <div class="btn-approved badge badge-danger">{{ __('admin.inactive') }}</div>
                                            @else
                                                <div class="btn-approved badge badge-success">{{ __('admin.active') }}</div>
                                            @endif
                                        @else
                                            <form action="{{ route('admin.user.active', ['user' => $user]) }}" method="post">
                                                @csrf
                                                @method("PUT")
                                                @if($user->status == \App\Models\User::STATUS_INACTIVE)
                                                    <button class="btn-approved badge badge-danger">{{ __('admin.inactive') }}</button>
                                                @else
                                                    <button class="btn-approved badge badge-success">{{ __('admin.active') }}</button>
                                                @endif
                                            </form>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($user->id !== Auth::id())
                                            <div class="row-icon">
                                                <div class="col-4">
                                                    <a href="{{ route('user.edit') }}" target="_blank" class="icon badge-info"><i class="fa-solid fa-eye"></i></a>
                                                </div>
                                                <div class="col-4">
                                                    <a class="icon badge-success view-profile-user" data-url= {{ route('admin.user.edit', ['user' => $user]) }}>
                                                        <i class="fa-solid fa-pen-to-square"></i>
                                                    </a>
                                                </div>
                                                <div class="col-4">
                                                    <a class="icon badge-danger view-delete-user" data-url={{ route('admin.user.view.delete', ['user' => $user]) }}><i class="fa-solid fa-trash"></i></a>
                                                </div>
                                            </div>
                                        @endif
                                        
                                    </td>
                                </tr>
                            @endforeach
                    </tbody>
                </table>
                {{ $users->links('partials.pagination', ['data' => $users]) }}
            </div>
            </div>
            @error('name')
            <span class="error">{{ $message }}</span>
            @enderror
            @error('email')
            <span class="error">{{ $message }}</span>
            @enderror
            @error('phone')
            <span class="error">{{ $message }}</span>
            @enderror
        </div>
    </div>
</div>
<div id="popupProfile"></div>
@endsection
