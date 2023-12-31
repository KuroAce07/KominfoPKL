<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15">
        </div>
        <div class="sidebar-brand-text mx-3">Aplikasi E-CASH</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="{{ route('home') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>
    
    <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#arsipLamaDropDown"
        aria-expanded="true" aria-controls="arsipLamaDropDown">
        <i class="fas fa-folder-open"></i>


        <span>Dokumen Keuangan</span>
    </a>
    <div id="arsipLamaDropDown" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Dokumen:</h6>
            <a class="collapse-item" href="{{ route('Arsip.index') }}">List Dokumen</a>
            <a class="collapse-item" href="{{ route('Arsip.create') }}">Tambahkan Dokumen</a>
            <a class="collapse-item" href="{{ route('Arsip.importfile') }}">Import Dokumen</a>
        </div>
    </div>
</li>

    <!-- Divider -->
    
    <!-- <hr class="sidebar-divider">-->

    <!-- Heading -->
    <!--
    <div class="sidebar-heading">
        Management
    </div>
-->
    <!-- Nav Item - Pages Collapse Menu -->
    <!-- Divider -->
    <hr class="sidebar-divider">

    @hasrole('Admin')
        <!-- Heading -->
        <div class="sidebar-heading">
            Bagian Admin
        </div>
        <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#taTpDropDown"
            aria-expanded="true" aria-controls="taTpDropDown">
            <i class="fas fa-user-alt"></i>
            <span>User Management</span>
        </a>
        <div id="taTpDropDown" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">User Management:</h6>
                <a class="collapse-item" href="{{ route('users.index') }}">List</a>
                <a class="collapse-item" href="{{ route('users.create') }}">Buat User</a>
                <a class="collapse-item" href="{{ route('users.import') }}">Import User</a>
            </div>
        </div>
    </li> 
        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
                aria-expanded="true" aria-controls="collapsePages">
                <i class="fas fa-fw fa-folder"></i>
                <span>Masters</span>
            </a>
            <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Role & Permissions</h6>
                    <a class="collapse-item" href="{{ route('roles.index') }}">Roles</a>
                    <a class="collapse-item" href="{{ route('permissions.index') }}">Permissions</a>
                </div>
            </div>
            <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">DPA</h6>
                    <a class="collapse-item" href="{{ route('UploadDPA.index') }}">Upload DPA</a>
                    <a class="collapse-item" href="{{ route('ViewDPA.index') }}">Lihat List DPA</a>
                    <a class="collapse-item" href="{{ route('ViewDPA.track') }}">Tracking DPA</a>
                </div>
            </div>
            <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Rekanan</h6>
                    <a class="collapse-item" href="{{ route('rekanan.create') }}">Buat Rekanan</a>
                    <a class="collapse-item" href="{{ route('rekanan.index') }}">Lihat List Rekanan</a>
                </div>
            </div>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block">
    @endhasrole

    @hasrole('Pembantu PPTK')
        <!-- Pembantu PPTK Form Dropdown -->
        <div class="sidebar-heading">
            Pembantu PPTK
        </div>

        <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
                aria-expanded="true" aria-controls="collapsePages">
                <i class="fas fa-fw fa-folder"></i>
                <span>DPA</span>
            </a>
            <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">DPA</h6>
                    <a class="collapse-item" href="{{ route('ViewDPA.index') }}">Lihat List DPA</a>
                </div>
            </div>
            {{-- <a class="nav-link" href="{{ route('PembantuPPTKView.dokumenpembantupptk') }}">
                <i class="fas fa-folder"></i>
                <span>Dokumen Pembantu PPTK</span>
            </a> --}}
        </li>
    @endhasrole

    @hasrole('Bendahara')
    <div class="sidebar-heading">
        Bendahara
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
            aria-expanded="true" aria-controls="collapsePages">
            <i class="fas fa-fw fa-folder"></i>
            <span>DPA</span>
        </a>
        <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">DPA</h6>
                <a class="collapse-item" href="{{ route('ViewDPA.index') }}">Lihat List DPA</a>
            </div>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">
    @endhasrole

    @hasrole('Pejabat Pengadaan')
    <div class="sidebar-heading">
        Pejabat Pengadaan
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
            aria-expanded="true" aria-controls="collapsePages">
            <i class="fas fa-fw fa-folder"></i>
            <span>DPA</span>
        </a>
        <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">DPA</h6>
                <a class="collapse-item" href="{{ route('ViewDPA.index') }}">Lihat List DPA</a>
            </div>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" href="{{ route('pengadaan.index') }}"
            aria-expanded="true" aria-controls="collapsePages">
            <i class="fas fa-fw fa-folder"></i>
            <span>Dokumen Pemilihan</span>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">
    @endhasrole

    @hasrole('PPTK')
      <!-- Heading -->
      <div class="sidebar-heading">
            PPTK
        </div>

        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
                aria-expanded="true" aria-controls="collapsePages">
                <i class="fas fa-fw fa-folder"></i>
                <span>DPA</span>
            </a>
            <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">DPA</h6>
                    <a class="collapse-item" href="{{ route('ViewDPA.index') }}">Lihat List DPA</a>
                </div>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block">
    @endhasrole
    
    <li class="nav-item">
        <a class="nav-link" href="#" data-toggle="modal" data-target="#logoutModal">
            <i class="fas fa-sign-out-alt"></i>
            <span>Logout</span>
        </a>
    </li>
    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>


</ul>