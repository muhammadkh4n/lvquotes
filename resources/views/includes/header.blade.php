<header>
  <nav class="navbar navbar-default">
    <div class="container">
      <div class="navbar-header">
        <a href="{{ route('index') }}" class="navbar-brand">Quotes</a>
      </div>
      <ul class="nav navbar-nav">
        <li class="active"><a href="{{ route('index') }}">Home</a></li>
      </ul>

      <ul class="nav navbar-nav navbar-right">
        @if (!Auth::check())
          <li><a href="{{ route('login') }}"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
        @elseif (Auth::check())
          <li><a href="{{ route('dashboard') }}"><span class="glyphicon glyphicon-list"></span> Dashboard</a></li>
          <li><a href="{{ route('logout') }}"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
        @endif
      </ul>
    </div>
  </nav>
</header>