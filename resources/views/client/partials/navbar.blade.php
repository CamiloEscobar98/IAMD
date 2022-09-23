  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-dark navbar-danger">

      <!-- Left navbar links -->
      <ul class="navbar-nav">
          <li class="nav-item">
              <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
          </li>
          {{-- <li class="nav-item d-none d-sm-inline-block">
              <a href="../../index3.html" class="nav-link">Home</a>
          </li> --}}
      </ul>
      <!-- ./Left navbar links -->

      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">


          <!-- Notifications Dropdown Menu -->
          <li class="nav-item dropdown">
              <a class="nav-link" data-toggle="dropdown" href="#">
                  <i class="far fa-bell"></i>
                  <span class="badge badge-warning navbar-badge">{{ $notifications->count() }}</span>
              </a>
              <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                  <span class="dropdown-item dropdown-header">{{ $notifications->count() }} Notifications</span>
                  <div class="dropdown-divider"></div>
                  @foreach ($notifications as $notification)
                      <a href="#" class="dropdown-item">
                          <i class="{{ $notification->notification_type->icon }} mr-2"></i> {{ $notification->message }}
                          <span class="float-right text-muted text-sm">3 mins</span>
                      </a>
                  @endforeach

                  <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
              </div>
          </li>
          <!-- Notifications Dropdown Menu -->

          <li class="nav-item">
              <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                  <i class="fas fa-expand-arrows-alt"></i>
              </a>
          </li>

          <li class="nav-item">
              <a class="nav-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                  <i class="fas fa-sign-out-alt"></i>
              </a>

              <form action="{{ route('client.loggout', $client->name) }}" method="post" id="logout-form">@csrf</form>
          </li>
      </ul>
      <!-- ./Right navbar links -->
  </nav>
  <!-- /.navbar -->
