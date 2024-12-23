 <!-- Main Sidebar Container -->
 <aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="index3.html" class="brand-link">
    <img src="{{asset('../assets/dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light">Sistem POS</span>
  </a>
  
  <!-- Sidebar -->
  <div class="sidebar">
    

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
            with font-awesome or any other icon font library -->
        {{-- <li class="nav-item">
          <a href="{{route('dashboard')}}" class="nav-link {{Route::is('dashboard') ? 'active' : ''}}">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              Dashboard
            </p>
          </a>
        </li> --}}
        {{-- @php
            $prefix = auth()->user()->role === 'admin' ? 'admin' : 'produksi';
        @endphp
        <li class="nav-item">
            <a href="{{ route($prefix . '.dashboard') }}" class="nav-link {{ Route::is($prefix . '.dashboard') ? 'active' : '' }}">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                    Dashboard
                </p>
            </a>
        </li> --}}

        <li class="nav-item">
          @if (request()->is('admin*'))
              <a href="{{ route('admin.dashboard') }}" class="nav-link {{ Route::is('admin.dashboard*') ? 'active' : '' }}">
                  <i class="nav-icon fas fa-tachometer-alt"></i>
                  <p>
                      Dashboard
                  </p>
              </a>

              <li class="nav-item">
                <a href="{{route('admin.pelanggan.index')}}" class="nav-link {{Route::is('admin.pelanggan.*') ? 'active' : ''}}">
                  <i class="fa-solid fa-users"></i>
                  <p class="mx-2">Pelanggan</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{route('admin.kategori.index')}}" class="nav-link {{Route::is('admin.kategori.*') ? 'active' : ''}}">
                    <i class="fas fa-tags"></i>
                  <p class="mx-2">Kategori</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{route('admin.pekerjaan.index')}}" class="nav-link {{ Route::is('admin.pekerjaan.*') ? 'active' : ''}}">
                    <i class="fas fa-tools"></i>
                  <p class="mx-2">Pekerjaan</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{route('admin.stok_barang.barang')}}" class="nav-link {{Route::is('admin.stok_barang.*') ? 'active' : ''}}">
                    <i class="fas fa-archive"></i>
                  <p class="mx-2">Stok Barang</p>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                </div>
              </li>

              <li class="nav-item">
                <a href="{{route('admin.invoice.index')}}" class="nav-link {{Route::is('admin.invoice.*') ? 'active' : ''}}">
                    <i class="fas fa-file-invoice"></i>
                  <p class="mx-2">Invoice</p>
                </a>
              </li>
      
              <li class="nav-item">
                <a href="{{route('admin.archive.invoice')}}" class="nav-link {{Route::is('admin.archive.*') ? 'active' : ''}}">
                    <i class="fas fa-file-archive"></i>
                  <p class="mx-2">Arsip Invoice</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{route('admin.preOrder.index')}}" class="nav-link {{ Route::is('admin.preOrder.*') ? 'active' : ''}}">
                    <i class="fas fa-hourglass-half"></i>
                  <p class="mx-2">Pre Order</p>
                </a>
              </li>
      
              <li class="nav-item">
                <a href="{{route('admin.preOrderArchive.index')}}" class="nav-link {{ Route::is('admin.preOrderArchive.*') ? 'active' : ''}}">
                    <i class="fas fa-file-archive"></i>
                  <p class="mx-2">Arsip Pre Order</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{route('admin.manage_user.user')}}" class="nav-link {{ Route::is('admin.manage_user.*') ? 'active' : ''}}">
                    <i class="fas fa-address-card"></i>
                  <p class="mx-2">Manage User</p>
                </a>
              </li>

              
          @elseif (request()->is('produksi*'))
              <a href="{{ route('produksi.dashboard') }}" class="nav-link {{ Route::is('produksi.dashboard') ? 'active' : '' }}">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                  Dashboard 
                </p>
              </a>

              <li class="nav-item">
                <a href="{{route('produksi.preOrder.index')}}" class="nav-link {{ Route::is('produksi.preOrder.*') ? 'active' : ''}}">
                    <i class="fas fa-hourglass-half"></i>
                  <p class="mx-2">Pre Order</p>
                </a>
              </li>

              {{-- <li class="nav-item">
                <a href="{{route('produksi.preOrderArchive.index')}}" class="nav-link {{ Route::is('produksi.preOrderArchive.*') ? 'active' : ''}}" >
                    <i class="fas fa-file-archive"></i>
                  <p class="mx-2">Arsip Pre Order</p>
                </a>
              </li> --}}
          @endif
        </li>
{{-- 
        @if(auth()->user()->role === 'admin' || auth()->user()->role === 'produksi')
          
        @endif --}}
  
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>