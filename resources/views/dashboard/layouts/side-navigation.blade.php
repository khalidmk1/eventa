  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="{{Route('dashboard.home')}}" class="brand-link text-center ">
          <span class="brand-text font-weight-bold  ">EVENTA</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
          <!-- Sidebar user panel (optional) -->
          <div class="user-panel align-items-center mt-3 pb-3 mb-3 d-flex flex-column ">
              <div class="image">
                  <img src="{{asset('storage/avatars/'. auth()->user()->image)}}" class="rounded avatar-costume elevation-2" alt="User Image">
              </div>
              <div class="info">
                  <a href="#" class="d-block">{{auth()->user()->first_name . " ". auth()->user()->last_name}}</a>
              </div>
          </div>

          <!-- SidebarSearch Form -->
          <div class="form-inline">
              <div class="input-group" data-widget="sidebar-search">
                  <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                      aria-label="Search">
                  <div class="input-group-append">
                      <button class="btn btn-sidebar">
                          <i class="fas fa-search fa-fw"></i>
                      </button>
                  </div>
              </div>
          </div>

          <!-- Sidebar Menu -->
          <nav class="mt-2">
              <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                  data-accordion="false">
                  <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                  <li class="nav-item">
                      <a href="{{Route('dashboard.home')}}" class="nav-link active">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Home</p>
                      </a>
                  </li>


                  <li class="nav-header">Event</li>
                  <li class="nav-item">
                      <a href="{{Route('dashboard.event.create')}}" class="nav-link">
                          <i class="nav-icon far fa-calendar-alt"></i>
                          <p>
                              Create
                          </p>
                      </a>
                  </li>
                  <li class="nav-item">
                      <a href="{{route("dashboard.event.show")}}" class="nav-link">
                        <i class="nav-icon fa fa-calendar" aria-hidden="true"></i>
                          <p>
                              All 
                          </p>
                      </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{Route('dashboard.profile.edit')}}" class="nav-link active">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Profile</p>
                    </a>
                </li>
                <li class="nav-item">
                     <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button  class="nav-link active">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Log out</p>
                    </button>

                   {{--  <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link> --}}
                </form>
                   
                </li>
                 
                </ul>
            </nav>
          <!-- /.sidebar-menu -->
        </div>
      <!-- /.sidebar -->
    </aside>
