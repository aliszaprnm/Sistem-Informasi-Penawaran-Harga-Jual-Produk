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
    <!-- <div align="left">
		<table class="borderless" style="border:none" width="100%">
			<tr class="borderless">
			<td class="borderless">
                <img id="logo-header" src="<?php echo base_url()?>assets/img/LOGONIJU.png" height="120" width="120">
			</td> -->
				<!-- <?php echo base_url();?>images/skf.png -->
			<!-- <td class="borderless"><h3 align="center">PT NUSA INDAH JAYA UTAMA</h3>
				<h3 align="center">PENAWARAN HARGA</h3>
				<h4 align="center"><?php echo date('d F Y'); ?></h4>
			</td>
		</table>
    </div>
        <br>
		<hr> -->

<!-- <img id="logo-header" src="<?php echo base_url()?>assets/img/LOGONIJU.png" height="100" width="100"> -->
<h3 align="center">PT NUSA INDAH JAYA UTAMA</h3>
<h3 align="center">PENAWARAN HARGA</h3> 
<h4 align="center"><?php echo date('d F Y'); ?></h2>
	<hr>

<p><?php echo $rows[0]->kode_pesanan?></p>
<p><?php echo $rows[0]->nama_customer?></p>

</div>
<div>
	<br>
	<table id="table" class="table table-bordered table-hover table-striped cell-border" width="100%">
        <thead>
			<tr >
				<th>Produk</th>
				<!-- <th rowspan="2">Material</th>
				<th rowspan="2">Sub Material</th>
				<th rowspan="2">Proses</th>
				<th rowspan="2">Transportasi</th>
				<th colspan="2">Packing</th>
				<th colspan="2">Quality Control</th>
				<th colspan="2">Maintenance Dies</th>
				<th colspan="2">Profit dan OH</th> -->
				<th>Process Cost</th>
				<th>Tooling Cost</th>
				<th>Total</th>
			</tr><!-- 
			<tr>
				<th>%</th>
				<th>Harga</th>
				<th>%</th>
				<th>Harga</th>
				<th>%</th>
				<th>Harga</th>
				<th>%</th>
				<th>Harga</th>
			</tr> -->
		</thead>
		<tbody>
			<?php foreach ($rows as $row) { ?>
			<tr>
				<!--<td><?= $row->kode_grup ?></td>-->
				<td><?= $row->nama_produk ?></td>
				<!-- <td><?= "Rp". floatval($row->harga_material) ?></td>
				<td><?= "Rp". floatval($row->harga_sub_material) ?></td>
				<td><?= "Rp". floatval($row->harga_proses) ?></td>
				<td><?= "Rp". number_format(($row->harga_delivery / 12.3 * $row->berat_produk * $row->jarak), 2) ?></td>
				<td><?= floatval($row->harga_packing) . '%' ?></td>
				<td><?= "Rp". number_format(($row->harga_packing / 100 * $row->harga_proses), 2) ?></td>
				<td><?= floatval($row->harga_qc) . '%' ?></td>
				<td><?= "Rp". number_format(($row->harga_qc / 100 * $row->harga_proses), 2) ?></td>
				<td><?= floatval($row->harga_mtc_dies) .'%' ?></td>
				<td><?= "Rp". number_format(($row->harga_mtc_dies / 100 * $row->harga_proses), 2) ?></td>
				<td><?= floatval($row->profit_dan_OH) .'%' ?></td> -->
				<!-- <td><?= "Rp". number_format(($row->profit_dan_OH / 100 * $row->harga_proses), 2) ?></td> -->
				<td><?= "Rp". number_format(($row->harga_material + $row->harga_proses + $row->harga_sub_material + ($row->harga_delivery / 12.3 * $row->jarak * $row->berat_produk) + ($row->harga_packing / 100 * $row->harga_proses) + ($row->harga_qc / 100 * $row->harga_proses) + ($row->harga_mtc_dies / 100 * $row->harga_proses) + ($row->profit_dan_OH / 100 * $row->harga_proses)), 2) ?></td>
				<td><?= "Rp". floatval($row->tooling_cost) ?></td>
				<td><?= "Rp". number_format(($row->harga_material + $row->harga_proses + $row->harga_sub_material + ($row->harga_delivery / 12.3 * $row->jarak * $row->berat_produk) + ($row->harga_packing / 100 * $row->harga_proses) + ($row->harga_qc / 100 * $row->harga_proses) + ($row->harga_mtc_dies / 100 * $row->harga_proses) + ($row->profit_dan_OH / 100 * $row->harga_proses) + $row->tooling_cost), 2) ?></td>
			</tr>
			<?php } ?>
        </tbody>
</table>

<div id="approveTable">
	<table width="600px">
			<thead>
				<tr>
					<th colspan="4">Approval</th>
				</tr>
				<tr>
					<th colspan="2" width="50%">Customer</th>
					<th colspan="2" width="50%">PT Nusa Indah Jaya Utama</th>
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
					<td height="20em" align="center">H. Saipudin <br>
						(Director)
					</td>
					<td height="20em" align="center">Soetarman <br>
						(Manager)
					</td>
				</tr>
			</tbody>
	</table>
</div>
</div>
</body>
</html>