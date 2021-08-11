<div class="container-fluid">
  <h1 class="h3 mb-4 text-gray-800"><?php echo $title ?></h1>
  <?php echo $this->session->flashdata('message'); ?>
  <div class="card shadow mb-4">
  	<div class="card-header py-3">
		<?php if(!($this->uri->segment(2)) || in_array($this->uri->segment(2), array('index'))){ ?>
			<a href="<?php echo site_url('penawaranharga/tambah') ?>" class="btn btn-info btn-sm"><i class="fas fa-plus-square"></i> Tambah Penawaran Harga</a>
        <?php } ?>
        <!--<a href="<?php echo site_url('penawaranharga/pdf') ?>" class="btn btn-info btn-sm" target="_blank"><i class="fas fa-file-pdf"></i> Cetak PDF</a>-->
    </div>
    <div class="card-body">
    	<div class="table-responsive">
    		<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
    			<thead>
    				<tr>
    					<th>Pesanan</th>
    					<th>Customer</th>
                        <th>Process Cost</th>
    					<th>Tooling Cost</th>
                        <th>Harga Jual</th>
						<th>Aksi</th>
                  	</tr>
                </thead>
                <tbody>
                	<?php foreach ($rows as $row) { ?>
                		<tr>
                    		<td><?php echo $row->kode_pesanan ?></td>
                    		<td><?php echo $row->nama_customer ?></td>
                            <td><?php echo "Rp". $row->process_cost ?></td>
                    		<td><?php echo "Rp". $row->tooling_cost ?></td>
                            <td><?php echo "Rp". $row->total ?></td>
							<td><a href="<?= site_url('penawaranharga/detil/' .$row->pesanan_id) ?>" class="btn btn-warning btn-sm"><i class="fas fa-eye"></i></a></td>
                    	</tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
  </div>
</div>
