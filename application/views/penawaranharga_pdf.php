<!DOCTYPE html>
<html>
<head>
	<title>PT NIJU - Penawaran Harga</title>
	<style>
		* {
			font-family: helvetica;
		}
	</style>
</head>
<body>
	<h2><center>PENAWARAN HARGA - PT NUSA INDAH JAYA UTAMA</center></h2>
	<br>
	<br>
	<table border="1" width="100%" style="border-collapse: collapse;">
		<tr >
			<th rowspan="2">Produk</th>
			<th rowspan="2">Material</th>
			<th rowspan="2">Sub Material</th>
			<th rowspan="2">Proses</th>
			<th rowspan="2">Transportasi</th>
			<th colspan="2">Packing</th>
			<th colspan="2">Quality Control</th>
			<th colspan="2">Maintenance Dies</th>
			<th colspan="2">Profit dan OH</th>
			<th rowspan="2">Process Cost</th>
			<th rowspan="2">Tooling Cost</th>
			<th rowspan="2">Total</th>
		</tr>
		<tr>
			<th>%</th>
			<th>Harga</th>
			<th>%</th>
			<th>Harga</th>
			<th>%</th>
			<th>Harga</th>
			<th>%</th>
			<th>Harga</th>
		</tr>
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
				<td><?= "Rp". floatval($row->harga_material + $row->harga_proses + $row->harga_sub_material + ($row->harga_delivery * $row->jarak) + ($row->harga_packing * $row->harga_proses) + ($row->harga_qc * $row->harga_proses) + ($row->harga_mtc_dies * $row->harga_proses) + ($row->profit_dan_OH * $row->harga_proses) + $row->tooling_cost) ?></td>
			</tr>
		<?php } ?>
	</table>

</body></html>