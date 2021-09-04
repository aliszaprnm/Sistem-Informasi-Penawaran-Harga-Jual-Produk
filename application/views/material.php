<div class="container-fluid">
  <h1 class="h3 mb-4 text-gray-800"><?php echo $title ?></h1>
  <?php echo $this->session->flashdata('message'); ?>
  <div class="card shadow mb-4">
  	<!-- <div class="card-header py-3">
  		<a href="<?php echo site_url('material/tambah') ?>" class="btn btn-info btn-sm"><i class="fas fa-plus-square"></i> Tambah Material</a>
    </div> -->
    <div class="card-header py-3">
        <a href="<?php echo site_url('material/tambah_master') ?>" class="btn btn-info btn-sm"><i class="fas fa-plus-square"></i> Tambah Data Master Material</a>
    </div>
    <div class="card-body">
    	<div class="table-responsive">
    		<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
    			<thead>
    				<tr>
    					<th>Produk</th>
    					<th>Jenis Material</th>
    					<th>Tebal Material</th>
						<th>Lebar Material</th>
						<th>Panjang Material</th>
                        <th>Berat Material</th>
                        <th>Jumlah/Sheet</th>
                        <th>Harga</th>
						<th>Aksi</th>
                  	</tr>
                </thead>
                <tbody>
                	<?php foreach ($rows as $row) { ?>
                		<tr>
                    		<td><?php echo $row->nama_produk ?></td>
                    		<td><?php echo $row->jenis_material ?></td>
                    		<td><?php echo floatval($row->tebal) ." mm" ?></td>
                    		<td><?php echo floatval($row->lebar) ." mm" ?></td>
                    		<td><?php echo floatval($row->panjang) ." mm" ?></td>
                            <td><?php echo $row->berat_material ." kg" ?></td>
                            <td><?php echo $row->jml_per_sheet ." pcs" ?></td>
                            <td><?php echo "Rp" . floatval($row->harga_per_produk) ?></td>
                    		<td>
                    			<a href="<?php echo site_url('material/edit/' .$row->id. '/' . $row->kode_produk) ?>" class="btn btn-primary btn-sm"><i class="fas fa-pencil-alt"></i></a>
                                <a href="<?php echo site_url('material/hapus/'.$row->id. '/'. $row->kode_produk) ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')"class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></a>
                    		</td>
                    	</tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
  </div>
</div>
