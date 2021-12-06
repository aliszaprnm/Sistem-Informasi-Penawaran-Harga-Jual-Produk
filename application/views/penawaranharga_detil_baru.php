<script src="<?php echo base_url('assets/') ?>vendor/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url('assets/') ?>vendor/datatables/dataTables.bootstrap4.min.js"></script>
<script src="<?php echo base_url('assets/') ?>vendor/datatables/dataTables.buttons.min.js"></script>
<script src="<?php echo base_url('assets/') ?>vendor/datatables/buttons.bootstrap4.min.js"></script>
<script src="<?php echo base_url('assets/') ?>vendor/datatables/jszip.min.js"></script>
<script src="<?php echo base_url('assets/') ?>vendor/datatables/pdfmake.min.js"></script>
<script src="<?php echo base_url('assets/') ?>vendor/datatables/vfs_fonts.js"></script>
<script src="<?php echo base_url('assets/') ?>vendor/datatables/buttons.html5.min.js"></script>
<script src="<?php echo base_url('assets/') ?>vendor/datatables/buttons.print.min.js"></script>
<script src="<?php echo base_url('assets/') ?>vendor/datatables/buttons.colVis.min.js"></script>
<div class="container-fluid">
  <h1 class="h3 mb-4 text-gray-800"><?php echo $title ?></h1>
  <?php echo $this->session->flashdata('message'); ?>
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <a href="<?php echo site_url('penawaranharga') ?>" class="btn btn-info btn-sm"><i class="fas fa-arrow-left"></i> Kembali</a>
      <!-- <a href="<?php echo site_url('penawaranharga/pdf') ?>" class="btn btn-info btn-sm" target="_blank"><i class="fas fa-file-pdf"></i> Cetak PDF</a> -->
      <?php if($this->session->userdata('role') == 'Marketing'){ ?>
        <a href="<?=site_url('penawaranharga/cetak_hasil_baru/'. $this->uri->segment(3). '/'. $this->uri->segment(4))?>" target='_blank' class="btn btn-info btn-sm"><i class="fas fa-file-pdf"></i> Cetak PDF</a>
      <?php } ?>
    </div>
    <div class="card-body">
      <form action="" method="post" enctype="multipart/form-data">
        <div class="form-group">
          <label for="kode_pesanan">Kode Pesanan</label>
          <input type="text" name="kode_pesanan" readonly class="form-control form-control-sm" id="kode_pesanan" value="<?php echo $rows[0]->kode_pesanan ?>">
        </div>
        <div class="form-group">
          <label for="tanggal">Tanggal Pesanan</label>
          <input type="date" data-format="dd-mm-yyyy" name="tanggal" readonly class="form-control form-control-sm" value="<?php echo $rows[0]->tanggal ?>">
          <?php echo form_error('tanggal', '<span class="text-danger small pl-3">', '</span>'); ?>
        </div>
        <div class="form-group">
          <label for="kode_customer">Customer</label>
          <input type="text" data-format="dd-mm-yyyy" name="customer" readonly class="form-control form-control-sm" value="<?php echo $rows[0]->nama_customer ?>">
        </div>
		<div class="table-responsive">
			<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
				<tr>
					<!--<th>Kode Group</th>-->
					<th>Produk</th>
					<th>Material</th>
					<th>Sub Material</th>
					<th>Proses</th>
					<th>Transportasi</th>
					<th>% Packing</th>
					<th>Total Packing</th>
					<th>% QC</th>
					<th>Total QC</th>
					<th>% Mtc. Dies</th>
					<th>Mtc. Dies</th>
					<th>% Profit</th>
					<th>Total Profit</th>
					<th>Process Cost</th>
					<th>Tooling Cost</th>
					<th>Harga Jual</th>
				</tr>
              </thead>
              <tbody>
				  <?php foreach ($rows as $row) { ?>
					<tr>
						<!--<td><?= $row->kode_grup ?></td>-->
						<td><?= $row->nama_produk ?></td>
						<td><?= "Rp". floatval($row->harga_material) ?></td>
						<td><?= "Rp". floatval($row->harga_sub_material) ?></td>
						<td><?= "Rp". floatval($row->harga_proses) ?></td>
						<td><?= "Rp". number_format(($row->harga_delivery / 12.3 * $row->berat_produk * $row->jarak), 2) ?></td>
						<td><?= floatval($row->harga_packing) . '%' ?></td>
						<td><?= "Rp". number_format(($row->harga_packing / 100 * $row->harga_proses), 2) ?></td>
						<td><?= floatval($row->harga_qc) . '%' ?></td>
						<td><?= "Rp". number_format(($row->harga_qc / 100  * $row->harga_proses), 2) ?></td>
						<td><?= floatval($row->harga_mtc_dies) .'%' ?></td>
						<td><?= "Rp". number_format(($row->harga_mtc_dies / 100  * $row->harga_proses), 2) ?></td>
						<td><?= floatval($row->profit_dan_OH) .'%' ?></td>
						<td><?= "Rp". number_format(($row->profit_dan_OH / 100  * $row->harga_proses), 2) ?></td>
						<td><?= "Rp". floatval($row->total) ?></td>
						<td><?= "Rp". floatval($row->tooling_cost) ?></td>
						<td><?= "Rp". floatval((floatval($row->total))+(floatval($row->tooling_cost))) ?></td>
					</tr>
				  <?php } ?>
              </tbody>
			</table>
        </div>
            <br>
            <hr style="height:2px;border-width:0;color:#1E90FF;background-color:#1E90FF">
        </form>
    </div>
  </div>
</div>

