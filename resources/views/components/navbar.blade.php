<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
      <a class="navbar-brand" href="/">
          <img src="{{ Voyager::setting('logo') }}" alt="logo">
      </a>
    </div>
    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        {!! Menu::display('main', 'bootstrap') !!}
        <form class="navbar-form navbar-left">
            <div class="form-group">
                <input type="text" class="form-control" placeholder="Search">
            </div>
            <button type="submit" class="btn btn-default">Submit</button>
        </form>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="#">通知</a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
              <!-- The user image in the navbar-->
              <img src="" class="user-image" alt="User Image"/>
              <!-- hidden-xs hides the username on small devices so only the image appears. -->
              <span class="hidden-xs">{!! Auth::user()->name !!}</span>
          </a>
          <ul class="dropdown-menu">
              <li><a href="#">Action</a></li>
            <li><a href="#">Action</a></li>
            <li><a href="#">Another action</a></li>
            <li><a href="#">Something else here</a></li>
            <li role="separator" class="divider"></li>
            <li>
                <a href="{!! url('/logout') !!}" class="btn btn-default btn-flat"
                     onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    Sign out
                </a> w3
          </ul>
        </li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
