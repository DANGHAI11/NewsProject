<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Admin</title>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
    @vite([
        'resources/admin/css/feather.css',
        'resources/admin/css/themify-icons.css',
        'resources/admin/css/vendor.bundle.base.css',
        'resources/admin/css/dataTables.bootstrap4.css',
        'resources/admin/css/select.dataTables.min.css',
        'resources/admin/css/styles.css',
        'resources/css/notification.css',
        'resources/scss/pagination.scss',
        'resources/scss/popup.scss'
    ])
    <link rel="shortcut icon" href="images/favicon.png" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer"/>
</head>
<body>
@if(Session::has('success') )
    <div class="noti-center">
        <div class="noti-check">
            <i class="far fa-check-circle noti-color"></i>
            &nbsp; &nbsp;
            <span>{{ Session::get('success') }}</span>
        </div>
    </div>
@endif
@if (Session::has('error'))
    <div class="noti-center">
        <div class="noti-danger">
            <i class="far fa-times-circle noti-shine"></i>
            &nbsp; &nbsp;
            <span>{{ Session::get('error') }}</span>
        </div>
    </div>
@endif
@error('content')
    <div class="noti-center">
        <div class="noti-danger">
            <i class="far fa-times-circle noti-shine"></i>
            &nbsp; &nbsp;
            <span>{{ $message }}</span>
        </div>
    </div>
@enderror
@if (Session::has('warning'))
    <div class="noti-center">
        <div class="noti-warning">
            <i class="fa fa-exclamation-triangle noti-rotate"></i>
            &nbsp; &nbsp;
            <span>{{ Session::get('warning') }}</span>
        </div>
    </div>
@endif
<div class="container-scroller">
    @include('admin.partials.header')
    <div class="container-fluid page-body-wrapper">
        @include('admin.partials.menu')
        <div class="main-panel">
            <div class="content-wrapper">
                @yield('content')
            </div>
            @include('admin.partials.footer')
        </div>
    </div>
</div>
@vite([
    'resources/admin/js/vendor.bundle.base.js',
    'resources/admin/js/jquery.dataTables.js',
    'resources/admin/js/dataTables.bootstrap4.js',
    'resources/admin/js/dataTables.select.min.js',
    'resources/admin/js/off-canvas.js',
    'resources/admin/js/main.js'
])
</body>

</html>

