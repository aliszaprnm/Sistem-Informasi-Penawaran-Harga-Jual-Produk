<!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon">
          <i class="fas fa-industry"></i>
        </div>
        <div class="sidebar-brand-text mx-3">PT NIJU</div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item">
        <a class="nav-link" href="<?php echo site_url('dashboard') ?>">
          <i class="fas fa-fw fa-home"></i>
          <span>Halaman Utama</span></a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="<?php echo site_url('customer') ?>">
          <i class="fas fa-fw fa-users"></i>
          <span>Customer</span></a>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseProducts" aria-expanded="true" aria-controls="collapseProducts">
          <i class="fas fa-fw fa-drum-steelpan"></i>
          <span>Produk</span>
        </a>
        <div id="collapseProducts" class="collapse" aria-labelledby="headingProduk" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Kustomisasi Produk:</h6>
            <a class="collapse-item" href="<?php echo site_url('produk') ?>">Produk</a>
            <a class="collapse-item" href="<?php echo site_url('mesin') ?>">Mesin</a>
            <a class="collapse-item" href="<?php echo site_url('material') ?>">Material Produk</a>
            <a class="collapse-item" href="<?php echo site_url('proses') ?>">Proses Produk</a>
            <a class="collapse-item" href="<?php echo site_url('submaterial') ?>">Sub Material Produk</a>
          </div>
        </div>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="<?php echo site_url('pesanan') ?>">
          <i class="fas fa-fw fa-tasks"></i>
          <span>Pesanan</span></a>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseHarga" aria-expanded="true" aria-controls="collapseHarga">
          <i class="fas fa-fw fa-tag"></i>
          <span>Harga Produk</span>
        </a>
        <div id="collapseHarga" class="collapse" aria-labelledby="headingHarga" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Kustomisasi Harga:</h6>
            <a class="collapse-item" href="<?php echo site_url('processcost') ?>">Process Cost</a>
            <a class="collapse-item" href="<?php echo site_url('toolingcost') ?>">Tooling Cost</a>
            <a class="collapse-item" href="<?php echo site_url('penawaranharga') ?>">Penawaran Harga</a>
          </div>
        </div>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="index.html">
          <i class="fas fa-fw fa-user-alt"></i>
          <span>Users</span></a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="index.html">
          <i class="fas fa-fw fa-sign-out-alt"></i>
          <span>Logout</span></a>
      </li>

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>          

          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">

            <!-- Nav Item - Search Dropdown (Visible Only XS) -->
            <li class="nav-item dropdown no-arrow d-sm-none">
              <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-search fa-fw"></i>
              </a>
              <!-- Dropdown - Messages -->
              <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                <form class="form-inline mr-auto w-100 navbar-search">
                  <div class="input-group">
                    <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                      <button class="btn btn-primary" type="button">
                        <i class="fas fa-search fa-sm"></i>
                      </button>
                    </div>
                  </div>
                </form>
              </div>
            </li>

            <div class="topbar-divider d-none d-sm-block"></div>

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Valerie Luna</span>
                <img class="img-profile rounded-circle" src="https://source.unsplash.com/QAB-WJcbgJk/60x60">
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="#">
                  <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                  Profile
                </a>
                <a class="dropdown-item" href="#">
                  <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                  Settings
                </a>
                <a class="dropdown-item" href="#">
                  <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                  Activity Log
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Logout
                </a>
              </div>
            </li>

          </ul>

        </nav>
        <!-- End of Topbar -->