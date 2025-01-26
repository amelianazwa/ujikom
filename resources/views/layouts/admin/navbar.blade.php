<nav
  class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme shadow-sm"
  id="layout-navbar">
  <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
    <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
      <i class="bx bx-menu bx-sm text-primary"></i>
    </a>
  </div>

  <div class="navbar-nav-right d-flex align-items-center w-100" id="navbar-collapse">
    <!-- Search -->
    
    <!-- /Search -->

    <ul class="navbar-nav flex-row align-items-center ms-auto">
      <!-- User -->
      <li class="nav-item navbar-dropdown dropdown-user dropdown">
        <a class="nav-link dropdown-toggle d-flex align-items-center gap-2" href="javascript:void(0);" data-bs-toggle="dropdown">
          <span class="avatar-initial bg-primary text-white d-flex justify-content-center align-items-center" style="border-radius: 50%; width: 40px; height: 40px;">
            <i class='bx bxs-user'></i>
          </span>
          <span class="d-none d-md-block text-dark">Hello, User</span>
        </a>
        <ul class="dropdown-menu dropdown-menu-end shadow-lg">
          <li>
            <a class="dropdown-item d-flex align-items-center gap-2" href="{{url('register')}}">
              <i class="mdi mdi-account-plus-outline mdi-20px text-primary"></i>
              <span>Register</span>
            </a>
          </li>
          <li>
            <div class="dropdown-divider"></div>
          </li>
          <li>
            <a class="dropdown-item d-flex align-items-center gap-2" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#logoutModal">
              <i class="mdi mdi-power mdi-20px text-danger"></i>
              <span>Log Out</span>
            </a>
          </li>
        </ul>
      </li>
      <!--/ User -->
    </ul>
  </div>
</nav>

<!-- Logout Confirmation Modal -->
<div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header border-0">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body text-center">
        <img src="/images/group.svg" alt="Konfirmasi Logout" style="width: 150px;" class="mb-3">
        <i class="fas fa-exclamation-circle fa-3x text-danger"></i>
        <h5 class="mt-3"><b>ANDA YAKIN INGIN KELUAR?</b></h5>
      </div>
      <div class="modal-footer d-flex justify-content-center">
        <button type="button" class="btn btn-secondary rounded-pill px-4" data-bs-dismiss="modal">TIDAK</button>
        <button type="button" class="btn btn-danger rounded-pill px-4" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">YA</button>
        <form action="{{ route('logout') }}" method="post" id="logout-form">
          @csrf
        </form>
      </div>
    </div>
  </div>
</div>
