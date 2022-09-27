  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-dark navbar-danger">

      <!-- Left navbar links -->
      <ul class="navbar-nav">
          <li class="nav-item">
              <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
          </li>
          <li class="nav-item">
            <a  class="nav-link text-white font-weight-bold">Menú Administrativo</a>
          </li>
      </ul>
      <!-- ./Left navbar links -->

      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">

          <li class="nav-item">
              <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                  <i class="fas fa-expand-arrows-alt"></i>
              </a>
          </li>

          <li class="nav-item">
              <a class="nav-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                  <i class="fas fa-sign-out-alt"></i>
              </a>

              <form action="{{ route('admin.loggout') }}" method="post" id="logout-form">@csrf</form>
          </li>
      </ul>
      <!-- ./Right navbar links -->
  </nav>
  <!-- /.navbar -->
