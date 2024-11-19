 <!-- Main Sidebar Container -->
 <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="{{asset('../assets/dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Sistem POS</span>
    </a>
    
    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{asset('../assets/dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Alexander Pierce</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
              with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="{{route('dashboard')}}" class="nav-link {{Route::is('dashboard') ? 'active' : ''}}">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{route('pelanggan.index')}}" class="nav-link {{Route::is('pelanggan.*') ? 'active' : ''}}">
                <i class="fa-solid fa-users"></i>
              <p class="mx-2">Pelanggan</p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{route('kategori.index')}}" class="nav-link {{Route::is('kategori.*') ? 'active' : ''}}">
                <i class="fas fa-tags"></i>
              <p class="mx-2">Kategori</p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{route('stok_barang.barang')}}" class="nav-link {{Route::is('stok_barang.*') ? 'active' : ''}}">
                <i class="fas fa-archive"></i>
              <p class="mx-2">Stok Barang</p>
            </a>
            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            </div>
          </li>

          <li class="nav-item">
            <a href="{{route('invoice.index')}}" class="nav-link {{Route::is('invoice.*') ? 'active' : ''}}">
                <i class="fas fa-file-invoice"></i>
              <p class="mx-2">Invoice</p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{route('preOrder.index')}}" class="nav-link {{ Route::is('preOrder.*') ? 'active' : ''}}">
                <i class="fas fa-hourglass-half"></i>
              <p class="mx-2">Pre Order</p>
            </a>
          </li>

          <li class="nav-item">
            <a href="#" class="nav-link {{Route::currentRouteName() == 'manager_user.user' ? 'active' : ''}}">
                <i class="fas fa-address-card"></i>
              <p class="mx-2">Manage User</p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>