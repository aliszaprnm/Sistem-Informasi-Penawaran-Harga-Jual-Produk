<div class="container-fluid">
  <h1 class="h3 mb-4 text-gray-800"><?php echo $title ?></h1>
  <?php echo $this->session->flashdata('message'); ?>
  <div class="card shadow mb-4">
  	<div class="card-header py-3">
		<?php if($this->session->userdata('role') == 'Operational Manager'){ ?>
            <?php if(!($this->uri->segment(2)) || in_array($this->uri->segment(2), array('index'))){ ?>
			<a href="<?php echo site_url('penawaranharga/tambah') ?>" class="btn btn-info btn-sm"><i class="fas fa-plus-square"></i> Tambah Penawaran Harga</a>
            <?php } ?>
        <?php } ?>
        <!-- <a href="<?php echo site_url('penawaranharga/pdf') ?>" class="btn btn-info btn-sm" target="_blank"><i class="fas fa-file-pdf"></i> Cetak PDF</a> -->
    </div>
    <div class="card-body">
    	<div class="table-responsive">
    		<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
    			<thead>
    				<tr>
    					<th>Pesanan</th>
    					<th>Produk</th>
    					<th>Customer</th>
                        <th>Process Cost</th>
    					<th>Tooling Cost</th>
                        <th>Harga Jual</th>
					<?php if(!($this->uri->segment(2)) || in_array($this->uri->segment(2), array('index'))){ ?>
                        <th>Status</th>
						<th>Aksi</th>
    				<?php } if(($this->uri->segment(2)) && in_array($this->uri->segment(2), array('validasi'))){ ?>
    					   <th>Proses</th>
                    <?php } ?>
                  	</tr>
                </thead>
                <tbody>
                	<?php foreach ($rows as $row) {
						$getProcessCost = $this->db->query("select id from process_cost where pesanan_id = $row->pesanan_id and kode_produk = '$row->kode_produk' limit 1");
						$idProcessCost = $getProcessCost->row('id'); ?>
                		<tr>
                    		<td><?php echo $row->kode_pesanan ?></td>
                    		<td><?php echo $row->nama_produk ?></td>
                    		<td><?php echo $row->nama_customer ?></td>
                            <td><?php echo "Rp". $row->process_cost ?></td>
                    		<td><?php echo "Rp". $row->tooling_cost ?></td>
                            <td><?php echo "Rp". $row->total ?></td>
						<?php if(!($this->uri->segment(2)) || in_array($this->uri->segment(2), array('index'))){ ?>
                            <td><?php echo $row->status ?></td>
                            <?php if($this->session->userdata('role') == 'Operational Manager'){ ?>
                                <td>
                                    <?php if($row->status == 'Negotiating') { ?>
    									<a href="<?php echo site_url('processcost/edit/' .$idProcessCost) ?>" class="btn btn-primary btn-sm"><i class="fas fa-pencil-alt"></i></a>
    									<a href="<?php echo site_url('penawaranharga/proses/reject/'.$row->id) ?>" onclick="return confirm('Apakah Anda yakin ingin menolak penawaran ini?')"class="btn btn-warning btn-sm"><i class="fas fa-minus-circle"></i></a>
    								<?php } else { ?>
    									<!-- <a href="<?php echo site_url('penawaranharga/edit/' .$row->id) ?>" class="btn btn-primary btn-sm"><i class="fas fa-pencil-alt"></i></a> -->
                                        <a href="<?= site_url('penawaranharga/detil_baru/' .$row->pesanan_id .'/'.$row->status) ?>" class="btn btn-warning btn-sm"><i class="fas fa-eye"></i></a>
    									<!-- <a href="<?php echo site_url('penawaranharga/hapus/'.$row->id) ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')"class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></a> -->
                                    <?php } ?>
                                </td>
                            <?php } else { ?>
                                <td>
                                    <a href="<?= site_url('penawaranharga/detil_baru/' .$row->pesanan_id .'/'.$row->status) ?>" class="btn btn-warning btn-sm"><i class="fas fa-eye"></i></a>
                                </td>
                            <?php } ?>
						<?php } if(($this->uri->segment(2)) && in_array($this->uri->segment(2), array('validasi'))){ ?>
                            <?php if($this->session->userdata('role') == 'Marketing'){ ?>
    							<td>
                                    <a href="<?php echo site_url('penawaranharga/proses/deal/' .$row->id) ?>" class="btn btn-success btn-sm"><i class="fas fa-check"></i></a>
                                    <?php if($row->status == 'Negotiating'|| $row->status == 'Reject by OM') { ?>
    									<a href="<?php echo site_url('penawaranharga/proses/reject/'.$row->id) ?>" onclick="return confirm('Apakah Anda yakin customer menolak penawaran ini?')"class="btn btn-warning btn-sm"><i class="fas fa-minus-circle"></i></a>
    								<?php } if($row->status == 'New') { ?>
    									<a href="<?php echo site_url('penawaranharga/proses/nego/' .$row->id) ?>" onclick="return confirm('Apakah Anda yakin customer melakukan negosiasi untuk penawaran ini?')"class="btn btn-warning btn-sm"><i class="fas fa-cog"></i></a>
    								<?php } ?>
                                </td>
                            <?php } ?>
						<?php }?>
                    	</tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
  </div>
</div>
