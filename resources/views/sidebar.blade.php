<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('home') }}" class="brand-link">
      <img src="<?php echo asset('public/adminlte/dist/img/AdminLTELogo.png') ?>" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Personnel Portal</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="<?php echo asset('public/adminlte/dist/img/user2-160x160.jpg')?>" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="{{ route('personnel.profile',Auth::user()->id) }}" class="d-block">{{ Auth::user()->firstname ." ".  substr(Auth::user()->middlename, 0, 1) ." ". Auth::user()->lastname }}</a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <!-- <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div> -->

      <!-- Sidebar Menu -->
      @if(Auth::user()->account_type == 'Division Chief')
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          
          <li class="nav-item menu-open">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Travel Orders
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('travel.chiefindex') }}" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Travel Orders For Approval</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('travel.chiefapproved') }}" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Approved Travel Orders</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('travel.chiefcancelled') }}" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Disapproved Travel Orders</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('travel.chiefcompleted') }}" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Completed Travel Orders</p>
                </a>
              </li>
              <!-- <li class="nav-item">
                <a href="#" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Inactive Page</p>
                </a>
              </li> -->
            </ul>
          </li>
          <!-- <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Simple Link
                <span class="right badge badge-danger">New</span>
              </p>
            </a>
          </li> -->
        </ul>
      </nav>
      @endif
      @if(Auth::user()->account_type == 'CENRO')
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          
          <li class="nav-item menu-open">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Travel Orders
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('travel.cenroindex') }}" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Travel Orders For Approval</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('travel.cenroapproved') }}" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Approved Travel Orders</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('travel.cenrocancelled') }}" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Disapproved Travel Orders</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('travel.cenrocompleted') }}" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Completed Travel Orders</p>
                </a>
              </li>
              <!-- <li class="nav-item">
                <a href="#" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Inactive Page</p>
                </a>
              </li> -->
            </ul>
          </li>
          <!-- <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Simple Link
                <span class="right badge badge-danger">New</span>
              </p>
            </a>
          </li> -->
        </ul>
      </nav>
      @endif
      @if(Auth::user()->account_type == 'PENRO')
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          
          <li class="nav-item menu-open">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Travel Orders
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('travel.penroindex') }}" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Travel Orders For Approval</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('travel.penroapproved') }}" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Approved Travel Orders</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('travel.penrocancelled') }}" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Disapproved Travel Orders</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('travel.penrocompleted') }}" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Completed Travel Orders</p>
                </a>
              </li>
              <!-- <li class="nav-item">
                <a href="#" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Inactive Page</p>
                </a>
              </li> -->
            </ul>
          </li>
          <!-- <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Simple Link
                <span class="right badge badge-danger">New</span>
              </p>
            </a>
          </li> -->
        </ul>
      </nav>
      @endif

      @if(Auth::user()->account_type == 'ARED TS')
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          
          <li class="nav-item menu-open">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Travel Orders
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('travel.aredtsindex') }}" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Travel Orders For Approval</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('travel.aredtsapproved') }}" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Approved Travel Orders</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('travel.aredtscancelled') }}" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Disapproved Travel Orders</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('travel.aredtscompleted') }}" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Completed Travel Orders</p>
                </a>
              </li>
              <!-- <li class="nav-item">
                <a href="#" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Inactive Page</p>
                </a>
              </li> -->
            </ul>
          </li>
          <!-- <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Simple Link
                <span class="right badge badge-danger">New</span>
              </p>
            </a>
          </li> -->
        </ul>
      </nav>
      @endif

      @if(Auth::user()->account_type == 'ARED MS')
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          
          <li class="nav-item menu-open">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Travel Orders
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('travel.aredmsindex') }}" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Travel Orders For Approval</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('travel.aredmsapproved') }}" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Approved Travel Orders</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('travel.aredmscancelled') }}" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Disapproved Travel Orders</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('travel.aredmscompleted') }}" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Completed Travel Orders</p>
                </a>
              </li>
              <!-- <li class="nav-item">
                <a href="#" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Inactive Page</p>
                </a>
              </li> -->
            </ul>
          </li>
          <!-- <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Simple Link
                <span class="right badge badge-danger">New</span>
              </p>
            </a>
          </li> -->
        </ul>
      </nav>
      @endif
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>