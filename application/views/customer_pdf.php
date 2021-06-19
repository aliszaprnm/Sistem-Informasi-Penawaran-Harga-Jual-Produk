<!DOCTYPE html>
<html><head>
	<title>Data Customer</title>
	<style>
		* {
			font-family: helvetica;
		}
	</style>
</head><body>

	<h2><center>List Data Customer</center></h2>
	<br>
	<br>
	<table border="1" width="100%" style="border-collapse: collapse;">
		<tr>
			<th>Kode Customer</th>
			<th>Nama Customer</th>
			<th>Alamat</th>
			<th>Jarak</th>
			<th>Telp</th>
			<th>Email</th>
		</tr>
		<?php foreach ($rows as $row) { ?>
			<tr>
				<td align="center"><?php echo $row->kode_customer ?></td>
				<td align="justify"><?php echo $row->nama_customer ?></td>
				<td align="justify"><?php echo $row->alamat ?></td>
				<td align="center"><?php echo $row->jarak ?></td>
				<td align="center"><?php echo $row->telp ?></td>
				<td align="center"><?php echo $row->email ?></td>
			</tr>
		<?php } ?>
	</table>

</body></html>