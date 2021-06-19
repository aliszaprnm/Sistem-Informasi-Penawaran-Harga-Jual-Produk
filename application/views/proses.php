<div class="container-fluid">
  <h1 class="h3 mb-4 text-gray-800"><?php echo $title ?></h1>
  <?php echo $this->session->flashdata('message'); ?>
  <div class="card shadow mb-4">
  	<div class="card-header py-3">
        <a href="<?php echo site_url('proses/tambah') ?>" class="btn btn-info btn-sm"><i class="fas fa-plus-square"></i> Tambah Proses</a>
    </div>
    <div class="card-body">
    	<div class="table-responsive">
    		<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
    			<thead>
    				<tr>
    					<th>Produk</th>
    					<th>Proses</th>
                        <th>Mesin</th>
    					<th>Standard Dies Height</th>
                        <th>Harga</th>
						<th>Aksi</th>
                  	</tr>
                </thead>
                <tbody>
                	<?php foreach ($rows as $row) { ?>
                		<tr>
                    		<td><?php echo $row->nama_produk ?></td>
                    		<td><?php echo $row->nama_proses ?></td>
                            <td><?php echo $row->nama_mesin ." - ". floatval($row->kekuatan) ." ". $row->satuan ?></td>
                    		<td><?php echo $row->std_dies_height ?></td>
                            <td><?php echo "Rp". $row->harga_proses * $row->kekuatan ?></td>
                            <td>
                                <a href="<?php echo site_url('proses/edit/' .$row->id) ?>" class="btn btn-primary btn-sm"><i class="fas fa-pencil-alt"></i></a>
                                <a href="<?php echo site_url('proses/hapus/'.$row->id) ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')"class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></a>
                            </td>
                    	</tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
  </div>
</div>