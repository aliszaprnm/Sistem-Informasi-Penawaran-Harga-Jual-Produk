<!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
        <div class="sidebar-brand-icon">
          <i class="fas fa-industry"></i>
        </div>
        <div class="sidebar-brand-text mx-3">PT NIJU</div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item <?= $this->uri->segment(1) == 'dashboard' ? 'active' : '' ?>">
        <a class="nav-link" href="<?= site_url('dashboard') ?>">
          <i class="fas fa-fw fa-home"></i>
          <span>Halaman Utama</span></a>
      </li>

	  <?php if($this->session->userdata('role') == 'Administrator'){
			$listMenus = array("customer", "produk", "mesin", "material", "submaterial", "proses");
			$active = ''; $show = ''; $collapsed = 'collapsed'; $expanded = 'true';
			if (in_array(strtolower($this->uri->segment(1)), $listMenus)) { $active = 'active'; $show = 'show'; $collapsed = ''; $expanded = 'false'; }
		  ?>
			<li class="nav-item <?= $active; ?>">
				<a class="nav-link <?= $collapsed; ?>" href="master" data-toggle="collapse" data-target="#collapseData" aria-expanded="<?= $expanded; ?>" aria-controls="collapseData">
				<i class="fas fa-fw fa-drum-steelpan"></i>
				<span>Data Master</span>
				</a>
				<div id="collapseData" class="collapse <?= $show; ?>" aria-labelledby="headingData" data-parent="#accordionSidebar">
				  <div class="bg-white py-2 collapse-inner rounded">
					<h6 class="collapse-header">Kustomisasi Data:</h6>
					<a class="collapse-item <?= $this->uri->segment(1) == 'customer' ? 'active' : '' ?>" href="<?= site_url('customer') ?>">Customer</a>
					<a class="collapse-item <?= $this->uri->segment(1) == 'mesin' ? 'active' : '' ?>" href="<?= site_url('mesin') ?>">Mesin</a>
					<a class="collapse-item <?= $this->uri->segment(1) == 'produk' ? 'active' : '' ?>" href="<?= site_url('produk') ?>">Produk</a>
					<a class="collapse-item <?= $this->uri->segment(1) == 'material' ? 'active' : '' ?>" href="<?= site_url('material') ?>">Material Produk</a>
					<a class="collapse-item <?= $this->uri->segment(1) == 'submaterial' ? 'active' : '' ?>" href="<?= site_url('submaterial') ?>">Sub Material Produk</a>
					<a class="collapse-item <?= $this->uri->segment(1) == 'proses' ? 'active' : '' ?>" href="<?= site_url('proses') ?>">Proses Produk</a>
				  </div>
				</div>
			</li>
	  <?php } ?>

	  <?php
			$listMenus = array("pesanan");
			$active = ''; $show = ''; $collapsed = 'collapsed'; $expanded = 'true';
			if (in_array(strtolower($this->uri->segment(1)), $listMenus)) { $active = 'active'; $show = 'show'; $collapsed = ''; $expanded = 'false'; }
	  ?>
      <li class="nav-item <?= $active; ?>">
        <a class="nav-link <?= $collapsed; ?>" href="#" data-toggle="collapse" data-target="#collapsePesanan" aria-expanded="<?= $expanded; ?>" aria-controls="collapsePesanan">
          <i class="fas fa-fw fa-tasks"></i>
          <span>Pesanan</span>
        </a>
        <div id="collapsePesanan" class="collapse <?= $show; ?>" aria-labelledby="headingPesanan" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Kustomisasi Pesanan:</h6>
            <a class="collapse-item <?= $this->uri->segment(1) == 'pesanan' && (!($this->uri->segment(2)) || in_array($this->uri->segment(2), array('detil','edit','tambah'))) ? 'active' : '' ?>" href="<?= site_url('pesanan') ?>">Daftar Pesanan</a>
            <?php if($this->session->userdata('role') == 'Administrator' || $this->session->userdata('role') == 'Operational Manager'){ ?>
				<a class="collapse-item <?= $this->uri->segment(1) == 'pesanan' && $this->uri->segment(2) == 'baru' ? 'active' : '' ?>" href="<?= site_url('pesanan/baru') ?>">Pesanan Masuk</a>
            <?php } if($this->session->userdata('role') == 'Administrator' || $this->session->userdata('role') == 'Marketing'){ ?>
				<a class="collapse-item <?= $this->uri->segment(1) == 'pesanan' && $this->uri->segment(2) == 'proses' ? 'active' : '' ?>" href="<?= site_url('pesanan/proses') ?>">Pesanan Dalam Proses</a>
				<a class="collapse-item <?= $this->uri->segment(1) == 'pesanan' && $this->uri->segment(2) == 'selesai' ? 'active' : '' ?>" href="<?= site_url('pesanan/selesai') ?>">Pesanan Selesai</a>
            <?php } ?>
          </div>
        </div>
      </li>

	  <?php
			$listMenus = array("processcost","toolingcost","penawaranharga");
			$active = ''; $show = ''; $collapsed = 'collapsed'; $expanded = 'true';
			if (in_array(strtolower($this->uri->segment(1)), $listMenus)) { $active = 'active'; $show = 'show'; $collapsed = ''; $expanded = 'false'; }
	  ?>
      <li class="nav-item <?= $active; ?>">
        <a class="nav-link <?= $collapsed; ?>" href="#" data-toggle="collapse" data-target="#collapseHarga" aria-expanded="<?= $expanded; ?>" aria-controls="collapseHarga">
          <i class="fas fa-fw fa-tag"></i>
          <span>Harga Jual Produk</span>
        </a>
        <div id="collapseHarga" class="collapse <?= $show; ?>" aria-labelledby="headingHarga" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Kustomisasi Harga:</h6>
            <?php if($this->session->userdata('role') == 'Administrator' || $this->session->userdata('role') == 'Operational Manager'){ ?>
				<a class="collapse-item <?= $this->uri->segment(1) == 'processcost' ? 'active' : '' ?>" href="<?= site_url('processcost') ?>">Process Cost</a>
				<a class="collapse-item <?= $this->uri->segment(1) == 'toolingcost' ? 'active' : '' ?>" href="<?= site_url('toolingcost') ?>">Tooling Cost</a>
            <?php } if($this->session->userdata('role') == 'Administrator' || $this->session->userdata('role') == 'Operational Manager'){ ?>
				<a class="collapse-item <?= $this->uri->segment(1) == 'penawaranharga' && (!($this->uri->segment(2)) || in_array($this->uri->segment(2), array('detil','edit','tambah'))) ? 'active' : '' ?>" href="<?= site_url('penawaranharga') ?>">Penawaran Harga</a>
            <?php } if($this->session->userdata('role') == 'Administrator'){ ?> 
				<a class="collapse-item <?= $this->uri->segment(1) == 'penawaranharga' && $this->uri->segment(2) == 'validasi' ? 'active' : '' ?>" href="<?= site_url('penawaranharga/validasi') ?>">Validasi Penawaran Harga</a>
				<a class="collapse-item <?= $this->uri->segment(1) == 'penawaranharga' && $this->uri->segment(2) == 'deal' ? 'active' : '' ?>" href="<?= site_url('penawaranharga/deal') ?>">Penawaran OK</a>
				<a class="collapse-item <?= $this->uri->segment(1) == 'penawaranharga' && $this->uri->segment(2) == 'reject' ? 'active' : '' ?>" href="<?= site_url('penawaranharga/reject') ?>">Penawaran Tidak OK</a>
			<?php } if($this->session->userdata('role') == 'Marketing'){ ?>
        <a class="collapse-item <?= $this->uri->segment(1) == 'penawaranharga' && (!($this->uri->segment(2)) || in_array($this->uri->segment(2), array('detil'))) ? 'active' : '' ?>" href="<?= site_url('penawaranharga') ?>">Penawaran Harga</a>
				<a class="collapse-item <?= $this->uri->segment(1) == 'penawaranharga' && $this->uri->segment(2) == 'validasi' ? 'active' : '' ?>" href="<?= site_url('penawaranharga/validasi') ?>">Validasi Penawaran Harga</a>
				<a class="collapse-item <?= $this->uri->segment(1) == 'penawaranharga' && $this->uri->segment(2) == 'deal' ? 'active' : '' ?>" href="<?= site_url('penawaranharga/deal') ?>">Penawaran OK</a>
				<a class="collapse-item <?= $this->uri->segment(1) == 'penawaranharga' && $this->uri->segment(2) == 'reject' ? 'active' : '' ?>" href="<?= site_url('penawaranharga/reject') ?>">Penawaran Tidak OK</a>
            <?php } if($this->session->userdata('role') == 'Operational Manager'){ ?>
				<a class="collapse-item <?= $this->uri->segment(1) == 'penawaranharga' && $this->uri->segment(2) == 'deal' ? 'active' : '' ?>" href="<?= site_url('penawaranharga/deal') ?>">Penawaran OK</a>
				<a class="collapse-item <?= $this->uri->segment(1) == 'penawaranharga' && $this->uri->segment(2) == 'reject' ? 'active' : '' ?>" href="<?= site_url('penawaranharga/reject') ?>">Penawaran Tidak OK</a>
			<?php } ?>
          </div>
        </div>
      </li>
	
	<?php if($this->session->userdata('role') == 'Administrator'){  ?>
		<li class="nav-item <?= $this->uri->segment(1) == 'user' ? 'active' : '' ?>">
        <a class="nav-link" href="<?= site_url('user') ?>">
          <i class="fas fa-fw fa-user-alt"></i>
          <span>Users</span></a>
      </li>
	<?php } ?>

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
            
            <!-- Nav Item - Alerts -->
            <li class="nav-item dropdown no-arrow mx-1">
              <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-bell fa-fw"></i>
                <!-- Counter - Alerts -->
                <span class="badge badge-danger badge-counter" id="notification-count"></span>
              </a>
              <!-- Dropdown - Alerts -->
              <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
                <h6 class="dropdown-header">
                  Notifications
                </h6>
                <div id="notification-section">
                </div>
                <a class="dropdown-item text-center small text-gray-500" id="notif_null" href="#">There is no notification yet</a>
              </div>
            </li>

            <div class="topbar-divider d-none d-sm-block"></div>

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?= $this->session->userdata('username'); ?></span>
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="<?= site_url('auth/logout') ?>">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Logout
                </a>
              </div>
            </li>

          </ul>

        </nav>
        <!-- End of Topbar -->

<script>
      const baseUrl = "<?= base_url() ?>";
      let count = 0;
      const getNotification = (type) => {
        $.ajax({
          url: baseUrl + "dashboard/ajx_get_notification",
          type: 'POST',
          dataType: 'JSON',
          success: function(data){
            let j, notification = '', notification_icon;
			console.log(data);
            for(j = 0; j < data.result.length; j++){
              notification_icon = getNotificationIcon(data.result[j]['type']);
              notification += `<a class="dropdown-item d-flex align-items-center" href="javascript:void(0)" onClick="updateReadNotification('${data.result[j]['notification_link']}' ,'${data.result[j]['type']}')">
								  <div class="mr-3">
									<div class="icon-circle ${notification_icon[0]}">
									  <i class="${notification_icon[1]}"></i>
									</div>
								  </div>
								  <div>
									<span class="font-weight-bold">${data.result[j]['notification_message']}</span>
								  </div>
								</a>`;
            }

            if(data.count > 0){
              if(type == 'checking' && data.count > count){
                toastr.info('New notifications!');
              }
              $('#notification-count').text(data.count);
              $('#notif_null').hide();
              /* $('#notification_header').html(`You have ${data.count} new notifications`); */
            } else {
			  $('#notification-count').text('');
			  $('#notif_null').show();
			}
            $('#notification-section').html(notification);

            setTimeout(() => {
              getNotification('checking');
            }, 3000);
            count = data.count;
          }
        });
      }

      const getNotificationIcon = (type) => {
        let retVal;
        switch(type){
          case 'Order':
            retVal = ['bg-primary','fas fa-file-alt text-white'];
          break;

          case 'Offer':
          case 'Negotiate':
            retVal = ['bg-success','fas fa-donate text-white'];
          break;

          case 'Reject':
            retVal = ['bg-warning','fas fa-exclamation-triangle text-white'];
          break;
          
          default:
			retVal = ['bg-primary','fas fa-ellipsis-h text-white'];
          break;
        }

        return retVal;
      }

      const updateReadNotification = (url, id) => {
        $.ajax({
          url: baseUrl + "/dashboard/ajx_read_message",
          type: 'POST',
          dataType: 'JSON',
          data:{
            message_id: id
          },
          success: function(data){
            if(data.status == 'ok'){
			  toastr.success('Update data success!');
              console.log('update data success!');
              (url != 'null') ? window.location.replace(baseUrl+url) : '';
              getNotification('onload');
            }
          }
        })
      }

      getNotification('onload');
</script>
