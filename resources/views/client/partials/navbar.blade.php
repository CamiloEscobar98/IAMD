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


          <li class="nav-item dropdown">
              <a class="nav-link" data-toggle="dropdown" href="#">
                  Rol Actual<i class="far fa-check-circle"></i>
              </a>
              <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                  <span class="dropdown-item dropdown-header">Cambiar rol de usuario</span>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item">
                      <form action="{{ getClientRoute('client.auth.change_role_session') }}" method="post">
                          @csrf
                          @method('PATCH')

                          <select name="role_id" class="form-control custom-select-sm" onchange="this.form.submit()">
                              @foreach (current_user()->roles()->pluck('info', 'id') as $roleId => $value)
                                  <option value="{{ $roleId }}"
                                      {{ twoOptionsIsEqual($roleId, current_role()->id) }}>{{ $value }}</option>
                              @endforeach
                          </select>

                      </form>
                  </a>
              </div>
          </li>

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
                          <i class="{{ $notification->notification_type->icon }}"></i>
                          <small>{{ $notification->message }}</small>
                          <small class="float-right text-muted">Hace
                              {{ $notification->minutes }}</small>
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
