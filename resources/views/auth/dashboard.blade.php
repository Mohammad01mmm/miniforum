<h1>Welcome, {{ Auth::user()->name }}</h1>
<form action="{{ route('logout') }}" method="POST">
    @csrf
    <button type="submit">Logout</button>
</form>
