<h1>Admin Dashboard</h1>
<button onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
    class="flex items-center text-white/70 hover:text-white text-sm font-medium">
    <i class="fas fa-sign-out-alt mr-2"></i> Logout
</button>

<form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
    @csrf
</form>