<a class="dropdown-item"
   href="{{ route('admin.logout') }}"
   onclick="event.preventDefault();document.getElementById('logout-form2').submit();"
>
    <i class="si si-logout mr-5"></i> {{ __('Sign Out') }}
</a>

<form id="logout-form2" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
    @csrf
</form>
