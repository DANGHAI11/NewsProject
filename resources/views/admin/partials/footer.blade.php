<footer class="footer">
    <div class="d-sm-flex justify-content-center justify-content-sm-between">
        <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">
            {{ __('admin.text_footer') }}
        </span>
        <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button class="btn btn-outline-primary btn-fw">{{ __('message.logout') }}</button>
            </form>
        </span>
    </div>
</footer>
