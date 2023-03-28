  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-light-danger elevation-3">
      <!-- Brand Logo -->
      <a href="{{ getClientRoute('client.home') }}" class="brand-link">
          <div class="row justify-content-center">
              @if ($client->name == 'ufps')
                  <span class="brand-text font-weight-bold text-small"><img
                          src="{{ asset('assets/images/Logoufpsc.jpg') }}" width="220em" class="img-fluid"></span>
              @else
                  <span class="brand-text font-weight-bold text-small"><img
                          src="{{ asset('assets/images/LogoufpsoMen17.png') }}" width="220em" class="img-fluid"></span>
              @endif
          </div>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
          <!-- Sidebar user (optional) -->
          <div class="user-panel mt-3 pb-3 mb-3 d-flex">
              <div class="image">
                  <img src="{{ current_user()->profile_image_url }}" class="img-circle elevation-2"
                      alt="User Image">
              </div>
              <div class="info">
                  <a href="{{ getClientRoute('client.profile') }}" class="d-block">{{ current_user()->name }}</a>
                  <small class="font-weight-bold">{{ current_role()->info }}</small>
              </div>
          </div>

          <!-- SidebarSearch Form -->
          {{-- <div class="form-inline">
              <div class="input-group" data-widget="sidebar-search">
                  <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                      aria-label="Search">
                  <div class="input-group-append">
                      <button class="btn btn-sidebar">
                          <i class="fas fa-search fa-fw"></i>
                      </button>
                  </div>
              </div>
          </div> --}}

          <!-- Sidebar Menu -->
          <nav class="mt-2">
              <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                  data-accordion="false">
                  <!-- Add icons to the links using the .nav-icon class
                    with font-awesome or any other icon font library -->

                  @include('client.partials.menu')
              </ul>
          </nav>
          <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
  </aside>
  <!-- ./Main Sidebar Container -->
