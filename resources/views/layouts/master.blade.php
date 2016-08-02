<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>@yield('title')</title>
  <link rel="stylesheet" href="{{ URL::to('src/css/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ URL::to('src/css/bootstrap-theme.min.css') }}">
  <link rel="stylesheet" href="{{ URL::to('src/css/style.css') }}">
  @yield('styles')
</head>
<body>

@include("includes.header")
<div class="main container">
  @yield('content')
</div>
@include("includes.footer")

<script src="{{ @url()->to('src/js/jquery-2.2.4.min.js') }}"></script>
<script src="{{ @url()->to('src/js/bootstrap.min.js') }}"></script>
<script src="{{ @url()->to('src/js/app.js') }}"></script>
</body>
</html>