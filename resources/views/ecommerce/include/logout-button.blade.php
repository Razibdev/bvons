<a class="dropdown-item" href="{{ route('vendor.logout') }}" onclick="event.preventDefault();document.getElementById('logout-form2').submit();">
    <i class="si si-logout mr-5"></i> {{ __('Sign Out') }}
</a>

<form id="logout-form2" action="{{ route('vendor.logout') }}" method="POST" style="display: none;">
    @csrf
</form>
