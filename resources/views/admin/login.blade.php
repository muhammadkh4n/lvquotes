<link rel="stylesheet" href="{{ @url()->to('src/css/bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ @url()->to('src/css/bootstrap-theme.min.css') }}">
<link rel="stylesheet" href="{{ @url()->to('src/css/style.css') }}">

<form action="{{ route('login') }}" method="post" class="form-horizontal col-sm-6" id="admin-form">
  @if (count($errors) > 0)
    <div class="col-centered">
      <div class="alert alert-danger">
        @foreach ($errors->all() as $error)
          {{ $error }}
        @endforeach
      </div>
    </div>
  @endif

  @if (Session::has('fail'))
    <div class="col-centered">
      <div class="alert alert-danger">
        {{ Session::get('fail') }}
      </div>
    </div>
  @endif
  <div class="panel panel-default">
    <div class="form-group row">
      <label for="name" class="col-sm-2 control-label">Username</label>
      <div class="col-sm-10">
        <input type="text" name="name" class="form-control" id="name" placeholder="Username">
      </div>
    </div>
    <div class="form-group row">
      <label for="password" class="col-sm-2 control-label">Password</label>
      <div class="col-sm-10">
        <input type="password" name="password" class="form-control" id="password" placeholder="Password">
      </div>
    </div>
    <div class="form-group row">
      <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" class="btn btn-primary">Sign in</button>
      </div>
    </div>
    {{ csrf_field() }}
  </div>
</form>

<script src="{{ @url()->to('src/js/jquery-2.2.4.min.js') }}"></script>
<script>
  var winHeight = window.innerHeight / 2;
  var winWidth = window.innerWidth / 2;

  var formWidth = $('#admin-form').width() / 2;
  var formHeight = $('#admin-form').height() / 2;
  $('#admin-form').css('top', winHeight - formHeight);
  $('#admin-form').css('left', winWidth - formWidth);
</script>