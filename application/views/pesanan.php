<div class="container-fluid">
  <h1 class="h3 mb-4 text-gray-800"><?php echo $title ?></h1>
  <?php echo $this->session->flashdata('message'); ?>
  <div class="card shadow mb-4">
  	<div class="card-header py-3">
        <?php if($this->session->userdata('role') == 'Marketing'){ ?> 
    		<?php if(!($this->uri->segment(2)) || in_array($this->uri->segment(2), array('index'))){ ?>
    			<a href="<?php echo site_url('pesanan/tambah') ?>" class="btn btn-info btn-sm"><i class="fas fa-plus-square"></i> Buat Informasi Order</a>
            <?php } ?>
        <?php } ?>
        <!-- <a href="<?php echo site_url('pesanan/pdf') ?>" class="btn btn-info btn-sm" target="_blank"><i class="fas fa-file-pdf"></i> Cetak PDF</a> -->
    </div>
    <div class="card-body">
    	<div class="table-responsive">
    		<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
    			<thead>
    				<tr>
    					<th>Tanggal Dibuat</th>
    					<th>Kode Pesanan</th>
                        <th>Customer</th>
    					<th>Produk</th>
                        <th>Jumlah Pesanan</th>
                        <th>Keterangan</th>
					<?php if(!($this->uri->segment(2)) || in_array($this->uri->segment(2), array('index'))){ ?>
                        <th>Status</th>
					<?php } ?>
						<th>Aksi</th>
                  	</tr>
                </thead>
                <tbody>
                	<?php foreach ($rows as $row) { ?>
                		<tr>
                    		<td><?php echo $row->tanggal ?></td>
                    		<td><?php echo $row->kode_pesanan ?></td>
                            <td><?php echo $row->nama_customer ?></td>
                    		<td><?php echo $row->nama_produk ?></td>
                            <td><?php echo $row->qty . " pcs" ?></td>
                            <td><?php echo $row->keterangan ?></td>
                            <?php if(!($this->uri->segment(2)) || in_array($this->uri->segment(2), array('index'))){ ?>
							<td><?php echo $row->status ?></td>
							<?php } ?>
                            <?php if($this->session->userdata('role') == 'Marketing'){ ?>
                                <td>
    							<?php if($row->status == 'Baru') {
    								if($row->created_by == $this->session->userdata('userid')) { ?>
    									<a href="<?= site_url('pesanan/edit/' .$row->id) ?>" class="btn btn-primary btn-sm"><i class="fas fa-pencil-alt"></i></a>
    								<?php } else { ?>
    									<a href="<?= site_url('processcost/tambah') ?>" class="btn btn-warning btn-sm"><i class="fas fa-cog"></i></a>
                                    <?php }
    							} else if($row->status == 'Proses') { ?>
    									<a href="<?= site_url('pesanan/detil/' .$row->id) ?>" class="btn btn-warning btn-sm"><i class="fas fa-eye"></i></a>
    							<?php } else { ?>
    									<a href="<?= site_url('pesanan/detil/' .$row->id) ?>" class="btn btn-success btn-sm"><i class="fas fa-eye"></i></a>
    							<?php } ?>
    							<?php if((!($this->uri->segment(2)) || in_array($this->uri->segment(2), array('index'))) && ($row->created_by == $this->session->userdata('userid')) && $row->status == 'Baru') { ?>
    							<a href="<?= site_url('pesanan/hapus/'.$row->id) ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')"class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></a>
    							<?php } ?>
                                </td>
                            <?php } else { ?>
                                <td>
                                    <a href="<?= site_url('pesanan/detil/' .$row->id) ?>" class="btn btn-warning btn-sm"><i class="fas fa-eye"></i></a>
                                </td>
                            <?php } ?>
                    	</tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
  </div>
</div>
