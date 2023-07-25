@extends("layout.home")
@section("content")
<main class="active user-edit">
    <div class="wrap">
        <div class="container">
            <div class="row">
                <form class="form-user row" action="{{ route('user.update', ['user' => $user]) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method("PUT")
                    <h1>{{ __('profile.update_profile') }}</h1>
                    <div class="card show-image">
                        @if ($user->avatar)
                            <img src="{{ Vite::asset("public/storage/").$user->avatar }}" alt="">
                        @else
                            <img src="{{ Vite::asset('resources/images/avatar-user-comment.png') }}" alt="">
                        @endif
                    </div>
                    <div class="center">
                        <div class="input-div">
                            <input class="input" name="avatar" type="file" id="uploadImage">
                            <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" stroke-linejoin="round" stroke-linecap="round" viewBox="0 0 24 24" stroke-width="2" fill="none" stroke="currentColor" class="icon"><polyline points="16 16 12 12 8 16"></polyline><line y2="21" x2="12" y1="12" x1="12"></line><path d="M20.39 18.39A5 5 0 0 0 18 9h-1.26A8 8 0 1 0 3 16.3"></path><polyline points="16 16 12 12 8 16"></polyline></svg>
                        </div>
                    </div>
                    <div class="center">
                        <button class="btn-update-profile">
                            {{ __('profile.update') }}
                        </button>
                    </div>
                    <div class="form-control">
                        <div>{{ __('message.email') }}: {{ $user->email }}</div>
                    </div>
                    <div class="form-control">
                        <input type="value" name="name" required="" value="{{ $user->name }}" autocomplete="false">
                        <label>
                            <span>{{ __('message.username') }}</span>
                        </label>
                    </div>
                    <div class="form-control">
                        <input type="value" name="phone" required="" value="{{ $user->phone }}" autocomplete="false">
                        <label>
                            <span>{{ __('profile.phone') }}</span>
                        </label>
                    </div>
                    @error('name')
                    <div class="error">{{ $message }}</div>
                    @enderror
                    @error('avatar')
                    <div class="error">{{ $message }}</div>
                    @enderror
                    @error('phone')
                    <div class="error">{{ $message }}</div>
                    @enderror
                </form>
                <div class="button-user">
                    <div class="row up">
                        <a class="btn-user btn-user1" href="{{ route('user.index') }}">
                            <svg xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 448 512" width="30px" height="30px" class="instagram"><path d="M96 0C43 0 0 43 0 96V416c0 53 43 96 96 96H384h32c17.7 0 32-14.3 32-32s-14.3-32-32-32V384c17.7 0 32-14.3 32-32V32c0-17.7-14.3-32-32-32H384 96zm0 384H352v64H96c-17.7 0-32-14.3-32-32s14.3-32 32-32zm32-240c0-8.8 7.2-16 16-16H336c8.8 0 16 7.2 16 16s-7.2 16-16 16H144c-8.8 0-16-7.2-16-16zm16 48H336c8.8 0 16 7.2 16 16s-7.2 16-16 16H144c-8.8 0-16-7.2-16-16s7.2-16 16-16z"/></svg>
                        </a>
                        <a class="btn-user btn-user2" href="{{ route('home') }}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="30px" height="30px" class="twitter" viewBox="0 0 576 512"><path d="M575.8 255.5c0 18-15 32.1-32 32.1h-32l.7 160.2c0 2.7-.2 5.4-.5 8.1V472c0 22.1-17.9 40-40 40H456c-1.1 0-2.2 0-3.3-.1c-1.4 .1-2.8 .1-4.2 .1H416 392c-22.1 0-40-17.9-40-40V448 384c0-17.7-14.3-32-32-32H256c-17.7 0-32 14.3-32 32v64 24c0 22.1-17.9 40-40 40H160 128.1c-1.5 0-3-.1-4.5-.2c-1.2 .1-2.4 .2-3.6 .2H104c-22.1 0-40-17.9-40-40V360c0-.9 0-1.9 .1-2.8V287.6H32c-18 0-32-14-32-32.1c0-9 3-17 10-24L266.4 8c7-7 15-8 22-8s15 2 21 7L564.8 231.5c8 7 12 15 11 24z"/></svg>
                        </a>
                    </div>
                    <div class="row down">
                        <a class="btn-user btn-user3" href="{{ route('user.edit.password') }}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="30px" height="30px" class="github" viewBox="0 0 512 512"><path d="M336 352c97.2 0 176-78.8 176-176S433.2 0 336 0S160 78.8 160 176c0 18.7 2.9 36.8 8.3 53.7L7 391c-4.5 4.5-7 10.6-7 17v80c0 13.3 10.7 24 24 24h80c13.3 0 24-10.7 24-24V448h40c13.3 0 24-10.7 24-24V384h40c6.4 0 12.5-2.5 17-7l33.3-33.3c16.9 5.4 35 8.3 53.7 8.3zM376 96a40 40 0 1 1 0 80 40 40 0 1 1 0-80z"/></svg>
                        </a>
                        <button class="btn-user btn-user4 delete-user-profile">
                            <svg xmlns="http://www.w3.org/2000/svg" height="30px" width="30px" viewBox="0 0 448 512" class="discord"><path d="M135.2 17.7L128 32H32C14.3 32 0 46.3 0 64S14.3 96 32 96H416c17.7 0 32-14.3 32-32s-14.3-32-32-32H320l-7.2-14.3C307.4 6.8 296.3 0 284.2 0H163.8c-12.1 0-23.2 6.8-28.6 17.7zM416 128H32L53.2 467c1.6 25.3 22.6 45 47.9 45H346.9c25.3 0 46.3-19.7 47.9-45L416 128z"/></svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@include('partials.popup', ['user' => $user])
@push('js')
    @vite(['resources/js/profile.js'])
@endpush
@endsection
