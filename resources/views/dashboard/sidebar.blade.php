 <!-- Main Sidebar Container -->
 <aside class="main-sidebar sidebar-dark-primary elevation-4">
     <!-- Brand Logo -->
     <a href="index3.html" class="brand-link">
       <img src="{{asset('../assets/dist/img/insatsu.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8; background-color: #fff;">
       <span class="brand-text font-weight-light">Insatsu</span>
     </a>

     <!-- Sidebar -->
     <div class="sidebar">


       <!-- Sidebar Menu -->
       <nav class="mt-2">
         <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
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

           @elseif (request()->is('manager*'))
           <a href="{{ route('manager.dashboard') }}" class="nav-link {{ Route::is('manager.dashboard*') ? 'active' : '' }}">
             <i class="nav-icon fas fa-tachometer-alt"></i>
             <p>
               Dashboard
             </p>
           </a>

           <li class="nav-item">
             <a href="{{route('manager.pelanggan.index')}}" class="nav-link {{Route::is('manager.pelanggan.*') ? 'active' : ''}}">
               <i class="fa-solid fa-users"></i>
               <p class="mx-2">Pelanggan</p>
             </a>
           </li>

           <li class="nav-item">
             <a href="{{route('manager.kategori.index')}}" class="nav-link {{Route::is('manager.kategori.*') ? 'active' : ''}}">
               <i class="fas fa-tags"></i>
               <p class="mx-2">Kategori</p>
             </a>
           </li>

           <li class="nav-item">
             <a href="{{route('manager.pekerjaan.index')}}" class="nav-link {{ Route::is('manager.pekerjaan.*') ? 'active' : ''}}">
               <i class="fas fa-tools"></i>
               <p class="mx-2">Pekerjaan</p>
             </a>
           </li>

           <li class="nav-item">
             <a href="{{route('manager.stok_barang.barang')}}" class="nav-link {{Route::is('manager.stok_barang.*') ? 'active' : ''}}">
               <i class="fas fa-archive"></i>
               <p class="mx-2">Stok Barang</p>
             </a>
             <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
             </div>
           </li>

           <li class="nav-item">
             <a href="{{route('manager.invoice.index')}}" class="nav-link {{Route::is('manager.invoice.*') ? 'active' : ''}}">
               <i class="fas fa-file-invoice"></i>
               <p class="mx-2">Invoice</p>
             </a>
           </li>

           <li class="nav-item">
             <a href="{{route('manager.archive.invoice')}}" class="nav-link {{Route::is('manager.archive.*') ? 'active' : ''}}">
               <i class="fas fa-file-archive"></i>
               <p class="mx-2">Arsip Invoice</p>
             </a>
           </li>

           <li class="nav-item">
             <a href="{{route('manager.preOrder.index')}}" class="nav-link {{ Route::is('manager.preOrder.*') ? 'active' : ''}}">
               <i class="fas fa-hourglass-half"></i>
               <p class="mx-2">Pre Order</p>
             </a>
           </li>

           <li class="nav-item">
             <a href="{{route('manager.preOrderArchive.index')}}" class="nav-link {{ Route::is('manager.preOrderArchive.*') ? 'active' : ''}}">
               <i class="fas fa-file-archive"></i>
               <p class="mx-2">Arsip Pre Order</p>
             </a>
           </li>

           <li class="nav-item">
             <a href="{{route('manager.manage_user.user')}}" class="nav-link {{ Route::is('manager.manage_user.*') ? 'active' : ''}}">
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