
<html>
<head></head>
<body>
<script type="text/javascript">
	window.print();
</script>
<style>
  #approveTable {
    position: fixed;
    bottom: 0;
    right: 0;
  }

table {
	border: solid #000 !important;
	border-width: 1px 0 0 1px !important;
}
th, td {
	border: solid #000 !important;
	border-width: 0 1px 1px 0 !important;
}

.borderless {
	border: none !important;
}
</style>
 <br>
            <div align="left">
			<table class="borderless" style="border:none" width="100%">
			<tr class="borderless">
			<td class="borderless">
                <img id="logo-header" src="<?php echo base_url()?>assets/bower_components/image/logo1.png" height="50" width="100">
				</td>
				<!-- <?php echo base_url();?>images/skf.png -->
				<td class="borderless" align=right>PT NAGASAKTI COMPONENT PARTS<br>
				Jln Bintang Mas No.12 Km.47,5, <br>Nanggewer Cibinong Bogor 16912, Indonesia. <br>
				Phone: 62(21) 3801790 
				Fax: 62(21) 3811347</TD>
				</table>
                 </div>
        <br>
		<hr>

<p> Tanggal Cetak : <?php echo date('Y-m-d'); ?></p>
<h3 align="center">Form Penawaran Harga</h3> 
<table>
	<!-- <tr>
		<td>Nomor SPKP </td>
		<td>: <?php echo $record2['no_spkp'] ?></td>
	</tr>
	<tr>
		<td>Tanggal SPKP dibuat </td>
		<td>: <?php echo $record2['tanggal_dibuat'] ?></td>
	</tr> -->

</table>

</div>
<div>
	<br>
	<table id="table" class="table table-bordered table-hover table-striped cell-border" width="100%">
        <thead>
			<tr >
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

<div id="approveTable">
	<table width="300px">
			<thead>
				<tr>
					<th colspan="4">Approval</th>
				</tr>
				<tr>
					<th colspan="2">Customer</th>
					<th colspan="2">PT Nusa Indah</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td style="height:6em"></td>
					<td style="height:6em"></td>
					<td style="height:6em"></td>
					<td style="height:6em"></td>
				</tr>
				<tr>
					<td style="height:2em"></td>
					<td style="height:2em"></td>
					<td style="height:2em"></td>
					<td style="height:2em"></td>
				</tr>
			</tbody>
	</table>
</div>
</div>
</body>
</html>