<!DOCTYPE html>
<html><head>
	<title>Data Produk</title>
	<style>
		* {
			font-family: helvetica;
		}
	</style>
</head><body>

	<h2><center>List Data Produk</center></h2>
	<br>
	<br>
	<table border="1" width="100%" style="border-collapse: collapse;">
		<tr>
			<th>Kode Produk</th>
    		<th>Kode Grup</th>
            <th>Customer</th>
    		<th>Nama Produk</th>
			<th>Cavity</th>
		</tr>
		<?php foreach ($rows as $row) { ?>
			<tr>
				<td align="center"><?php echo $row->kode_produk ?></td>
				<td align="center"><?php echo $row->kode_grup ?></td>
				<td align="justify"><?php echo $row->nama_customer ?></td>
				<td align="justify"><?php echo $row->nama_produk ?></td>
				<td align="center"><?php echo $row->cavity ?></td>
				<!-- <td align="justify">
					<ul>
						<li><?php echo $row->proses1 ?></li>
						<li><?php echo $row->proses2 ?></li>
						<li><?php echo $row->proses3 ?></li>
						<li><?php echo $row->proses4 ?></li>
						<li><?php echo $row->proses5 ?></li>
						<li><?php echo $row->proses6 ?></li>
						<li><?php echo $row->proses7 ?></li>
						<li><?php echo $row->proses8 ?></li>
					</ul>
				</td> -->
			</tr>
		<?php } ?>
	</table>

</body></html>