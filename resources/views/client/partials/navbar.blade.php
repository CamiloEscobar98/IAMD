  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-dark navbar-danger">

      <!-- Left navbar links -->
      <ul class="navbar-nav">
          <li class="nav-item">
              <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
          </li>
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
                  <span class="dropdown-item dropdown-header">{{ $notifications->count() }} Notificaciones</span>
                  <div class="dropdown-divider"></div>
                  @foreach ($notifications as $notification)
                      <a href="#" class="dropdown-item">
                          <i class="{{ $notification->notification_type->icon }}"></i> {{ $notification->message }}
                          <span class="float-right text-muted text-small">Hace aproximadamente {{ $notification->minutes }} minutos</span>
                      </a>
                  @endforeach

                  <a href="{{ getClientRoute('client.notifications.index') }}" class="dropdown-item dropdown-footer">Ver
                      todas las notificaciones</a>
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
