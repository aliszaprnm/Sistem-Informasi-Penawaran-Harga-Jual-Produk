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
      <a href="<?php echo site_url('penawaranharga/deal') ?>" class="btn btn-info btn-sm"><i class="fas fa-arrow-left"></i> Kembali</a>
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
        <a href="<?=site_url('penawaranHarga/cetak_hasil/'. $this->uri->segment(3))?>" target='_blank' class="btn btn-success btn-xs">
            <i class=""></i> Cetak
        </a>
		<div class="table-responsive">
			<table class="table table-bordered" id="exportTable" width="100%" cellspacing="0">
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
				</tr>
              </thead>
              <tbody>
				  <?php foreach ($rows as $row) { ?>
					<tr>
						<!--<td><?= $row->kode_grup ?></td>-->
						<td><?= $row->nama_produk ?></td>
						<td><?= "Rp". floatval($row->harga_material) ?></td>
						<td><?= "Rp". floatval($row->harga_proses) ?></td>
						<td><?= "Rp". floatval($row->harga_sub_material) ?></td>
						<td><?= "Rp". ($row->harga_delivery * $row->jarak) ?></td>
						<td><?= floatval($row->harga_packing * 100) . '%' ?></td>
						<td><?= "Rp". floatval($row->harga_packing * $row->harga_proses) ?></td>
						<td><?= floatval($row->harga_qc * 100) . '%' ?></td>
						<td><?= "Rp". floatval($row->harga_qc * $row->harga_proses) ?></td>
						<td><?= floatval($row->harga_mtc_dies * 100) .'%' ?></td>
						<td><?= "Rp". floatval($row->harga_mtc_dies * $row->harga_proses) ?></td>
						<td><?= floatval($row->profit_dan_OH * 100) .'%' ?></td>
						<td><?= "Rp". floatval($row->profit_dan_OH * $row->harga_proses) ?></td>
						<td><?= "Rp". floatval($row->harga_material + $row->harga_proses + $row->harga_sub_material + ($row->harga_delivery * $row->jarak) + ($row->harga_packing * $row->harga_proses) + ($row->harga_qc * $row->harga_proses) + ($row->harga_mtc_dies * $row->harga_proses) + ($row->profit_dan_OH * $row->harga_proses)) ?></td>
						<td><?= "Rp". floatval($row->tooling_cost) ?></td>
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

<script>
	const pesanan  = "<?= $rows[0]->kode_pesanan ?>";
	const tanggal  = "<?= $rows[0]->tanggal ?>";
	const customer = "<?= $rows[0]->nama_customer ?>";
var table = $('#exportTable').DataTable({
    dom: "<'row'<'col-sm-4'l><'col-sm-4 text-center'B><'col-sm-4'f>>" +
      "<'row'<'col-sm-12'tr>>" +
      "<'row'<'col-sm-5'i><'col-sm-7'p>>",
    //"dom": 'Blfrtip',
    /*"lengthChange": false,
    "lengthMenu": [
      [50, 100, 1000, -1],
      [50, 100, 1000, "All"]
    ],*/
    "initComplete": function() {
      $("#exportTable").show();
    },
    //buttons: [ /*'copy',*/ 'excel', 'pdf', 'print' /*, 'colvis'*/ ]
    buttons: [{
      extend: 'pdfHtml5',
	  orientation: 'landscape',
	  pageSize: 'LEGAL',
      //message: "Made: 20_05-17\nMade by whom: User232\n" + "Custom message",
      title: 'PT NIJU - Penawaran Harga Detil',
      header: true,
      customize: function(doc) {
        doc.content.splice(0, 1, {
          text: [{
            text: 'PENAWARAN HARGA - PT NUSA INDAH JAYA UTAMA \n \n',
            bold: true,
            fontSize: 10,
            alignment: 'center'
          },{
            text: `Kode Pesanan: ${pesanan} \n`,
            bold: true,
            fontSize: 8
          },{
            text: `Tanggal Pesanan: ${tanggal} \n`,
            bold: true,
            fontSize: 8
          },{
            text: `Nama Customer: ${customer} \n`,
            bold: true,
            fontSize: 8
          }],
          margin: [0, 0, 0, 12],
          alignment: 'left',
          size: '2px'
        });
      }
    }]
  });
  table.buttons().container().appendTo('#exportTable_wrapper .col-md-6:eq(0)');
</script>
</script>
