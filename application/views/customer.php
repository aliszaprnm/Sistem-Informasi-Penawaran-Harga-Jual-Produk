<div class="container-fluid">
  <h1 class="h3 mb-4 text-gray-800"><?php echo $title ?></h1>
  <?php echo $this->session->flashdata('message'); ?>
  <div class="card shadow mb-4">
  	<div class="card-header py-3">
  		<a href="<?php echo site_url('customer/tambah') ?>" class="btn btn-info btn-sm"><i class="fas fa-plus-square"></i> Tambah Customer</a>
        <a href="<?php echo site_url('customer/pdf') ?>" class="btn btn-info btn-sm" target="_blank"><i class="fas fa-file-pdf"></i> Cetak PDF</a>
    </div>
    <div class="card-body">
    	<div class="table-responsive">
    		<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
    			<thead>
    				<tr>
    					<th>Kode Customer</th>
    					<th>Nama Customer</th>
    					<th>Alamat</th>
						<th>Telp</th>
						<th>Email</th>
						<th colspan="2">Aksi</th>
                  	</tr>
                </thead>
                <tbody>
                	<?php foreach ($rows as $row) { ?>
                		<tr>
                    		<td><?php echo $row->kode_customer ?></td>
                    		<td><?php echo $row->nama_customer ?></td>
                    		<td><?php echo $row->alamat ?></td>
                    		<td><?php echo $row->telp ?></td>
                    		<td><?php echo $row->email ?></td>
                    		<td>
                    			<a href="<?php echo site_url('customer/edit/' .$row->kode_customer) ?>" class="btn btn-primary btn-sm"><i class="fas fa-pencil-alt"></i></a>
                    		</td>
                            <td>
                                <a href="<?php echo site_url('customer/hapus/'.$row->kode_customer) ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')"class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></a>
                    		</td>
                    	</tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
  </div>
</div>