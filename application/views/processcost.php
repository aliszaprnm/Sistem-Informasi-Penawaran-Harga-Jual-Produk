<div class="container-fluid">
  <h1 class="h3 mb-4 text-gray-800"><?php echo $title ?></h1>
  <?php echo $this->session->flashdata('message'); ?>
  <div class="card shadow mb-4">
  	<div class="card-header py-3">
        <?php if($this->session->userdata('role') == 'Operational Manager'){ ?>
            <a href="<?php echo site_url('processcost/tambah') ?>" class="btn btn-info btn-sm"><i class="fas fa-plus-square"></i> Tambah Process Cost</a>
        <?php } ?>
        <!-- <a href="<?php echo site_url('processcost/pdf') ?>" class="btn btn-info btn-sm" target="_blank"><i class="fas fa-file-pdf"></i> Cetak PDF</a> -->
    </div>
    <div class="card-body">
    	<div class="table-responsive">
    		<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
    			<thead>
    				<tr>
    					<th>Pesanan</th>
    					<th>Produk</th>
    					<th>Customer</th>
    					<th>Harga Material</th>
                        <th>Harga Proses</th>
                        <th>Harga Sub Material</th>
                        <th>Tarif Delivery</th>
    					<th>Packing</th>
                        <th>Quality Control</th>
                        <th>Maintenance Dies</th>
                        <th>Profit & OH</th>
                        <th>Total</th>
                        <?php if($this->session->userdata('role') == 'Operational Manager'){ ?>
						  <th>Aksi</th>
                        <?php } ?>
                  	</tr>
                </thead>
                <tbody>
                	<?php foreach ($rows as $row) { ?>
                		<tr>
                    		<td><?php echo $row->kode_pesanan ?></td>
                    		<td><?php echo $row->nama_produk ?></td>
                    		<td><?php echo $row->nama_customer ?></td>
                    		<td><?php echo "Rp". floatval($row->harga_material) ?></td>
                            <td><?php echo "Rp". floatval($row->harga_proses) ?></td>
                            <td><?php echo "Rp". floatval($row->harga_sub_material) ?></td>
                            <td><?php echo "Rp". number_format(($row->harga_delivery / 12.3 * $row->berat_produk * $row->jarak), 2)?></td>
                            <td><?php echo "Rp". number_format(($row->harga_packing / 100 * $row->total_harga_proses), 2) ?></td>
                            <td><?php echo "Rp". number_format(($row->harga_qc / 100  * $row->total_harga_proses), 2) ?></td>
                            <td><?php echo "Rp". number_format(($row->harga_mtc_dies / 100  * $row->total_harga_proses), 2) ?></td>
                            <td><?php echo "Rp". number_format(($row->profit_dan_OH / 100  * $row->total_harga_proses), 2) ?></td>
                            <td><?php echo "Rp". number_format(($row->total), 2) ?></td>
                            <!--<td><?php echo "Rp". floatval($row->total) ?></td>-->
                            <?php if($this->session->userdata('role') == 'Operational Manager'){ ?>
                                <td>
                                    <a href="<?php echo site_url('processcost/edit/' .$row->id) ?>" class="btn btn-primary btn-sm"><i class="fas fa-pencil-alt"></i></a>
                                    <a href="<?php echo site_url('processcost/hapus/'.$row->id) ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')"class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></a>
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

<!-- <script>
    function hitung() {
        
    }
</script>
 -->