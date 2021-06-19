<div class="container-fluid">
  <h1 class="h3 mb-4 text-gray-800"><?php echo $title ?></h1>
  <?php echo $this->session->flashdata('message'); ?>
  <div class="card shadow mb-4">
  	<div class="card-header py-3">
        <a href="<?php echo site_url('pesanan/tambah') ?>" class="btn btn-info btn-sm"><i class="fas fa-plus-square"></i> Tambah Pesanan</a>
        <a href="<?php echo site_url('pesanan/pdf') ?>" class="btn btn-info btn-sm" target="_blank"><i class="fas fa-file-pdf"></i> Cetak PDF</a>
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
                            <td>
                                <a href="<?php echo site_url('pesanan/edit/' .$row->kode_pesanan) ?>" class="btn btn-primary btn-sm"><i class="fas fa-pencil-alt"></i></a>
                                <a href="<?php echo site_url('pesanan/hapus/'.$row->kode_pesanan) ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')"class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></a>
                            </td>
                    	</tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
  </div>
</div>