<body onload=javascript:window:print();>
<?php include "../../library/koneksi.php";?>
<center><h2>Laporan Konfirmasi Perbaikan</h2><hr></center>

<table width="90%" border="1" align="center">
  <tr>
    <th width="24">No</th>
    <th width="50">Tgl</th>
    <th>Nama Inspector</th>
    <th>Vin Number</th>
    <th>Jenis Mobil</th>
    <th>Repair Man</th>
    <th>Gangguan</th>
    <th>Kerusakan</th>
    <th>Solusi</th>
    <th>Waktu Perbaikan</th>
  </tr>
  <?php
  
	if(isset($_GET['tanggal_awal']) && isset($_GET['tanggal_akhir'])) {
		$awal  = !empty($_GET['tanggal_awal']) ? $_GET['tanggal_awal'] : date('Y-01-01');
		$akhir = !empty($_GET['tanggal_akhir']) ? $_GET['tanggal_akhir'] : date('Y-m-t');
		$sql = mysql_query("SELECT *, (select nama_lengkap from user b where b.id_user = a.id_user) as inspector, (select nama_lengkap from user b where b.id_user = a.pic) as pic
							FROM tblperbaikan a where tgl BETWEEN '$awal' AND '$akhir' AND status = 'Done'");
	} else {
		$sql = mysql_query("SELECT *, (select nama_lengkap from user b where b.id_user = a.id_user) as inspector, (select nama_lengkap from user b where b.id_user = a.pic) as pic
							FROM tblperbaikan a WHERE status = 'Done'");
	}

  $no=0;
  while ($r=mysql_fetch_array($sql))
  {	  
	  $no++;
	  $mulai = $r['mulai'];
	  $selesai = $r['selesai'];
	  $idkon = null;
	  $rskk = 'kerusakan tidak dapat diidentifikasi';
	  $slsi = 'butuh investigasi lebih lanjut';
	  $kerusakan = null;
	  $gangguan_other = $r['gangguan_other'];
	  $kerusakan_other = $r['kerusakan_other'];
	  $solusi_other = $r['solusi_other'];

   ?>
  <tr valign="top">
    <td><?php echo"$no";?></td>
    <td><?php echo"$r[tgl]";?></td>
    <td><?php echo"$r[inspector]";?></td>
    <td><?php echo"$r[vin_number]";?></td>
    <td><?php echo"$r[jenis_mobil]";?></td>
    <td><?php echo"$r[pic]";?></td>
    <td valign="top">
	<?php
		$querygx = "SELECT * FROM tblperbaikan_detail where idperbaikan = '$r[id]' ";
		$resultgx = mysql_query($querygx) or die('Error');
		while($datagx = mysql_fetch_array($resultgx))
		{
			$idkon[] = $datagx['idgangguan'];
			$queryg = "SELECT * FROM tblgangguan where idgangguan = '$datagx[idgangguan]' ";
			$resultg = mysql_query($queryg) or die('Error');
			while($datag = mysql_fetch_array($resultg))
			{
				//echo "$datag[idgangguan]. $datag[namagangguan] <br>";
				echo "- $datag[namagangguan] <br>";
				if($datagx['idgangguan'] == 'G15') {
					echo "$gangguan_other <br>";	
				}
			}
		}
		$idgangguan = implode("','", $idkon); 
	?>	
	</td>

	<td valign="top">
	<?php
	$query4 = " SELECT count(idgangguan), idkerusakan FROM tbl_gangguan_kerusakan where idgangguan IN ('$idgangguan')
				GROUP BY idkerusakan
				HAVING COUNT(id) >= 3";
	$result4 = mysql_query($query4) or die('Error');
	while($data4 = mysql_fetch_array($result4))
	{
		$kerusakan = $data4['idkerusakan'];

	}

	$query5 = mysql_query("SELECT * FROM tblkerusakan WHERE idkerusakan = '$kerusakan' ORDER BY idkerusakan ASC LIMIT 1");
	while($result5=mysql_fetch_array($query5))
	{
		$idk = $result5['idkerusakan'];
		$namak = $result5['namakerusakan'];
		//echo "$idk. $namak <br>";
		echo "$namak <br>";
	}
	
	if(mysql_num_rows($query5) == 0) {
		echo empty($kerusakan_other) ? "$rskk" : $kerusakan_other;
	}
	?>
	</td>

    <td valign="top">
		<?php
		$sqlgt = mysql_query("SELECT * FROM tbl_solusi_kerusakan where idkerusakan='$kerusakan'");
		while($hasilgt=mysql_fetch_array($sqlgt))
		{
			$idgt = $hasilgt['idsolusi'];
			$sqlt = mysql_query("SELECT * FROM tblsolusi where id='$idgt'");
			while($hasilt=mysql_fetch_array($sqlt))
			{
				$idt = $hasilt['id'];
				$namat = $hasilt['keterangan'];

				//echo "$idt. $namat <br>";
				echo "$namat <br>";
			}
		}
		
		if(mysql_num_rows($sqlgt) == 0) {
			echo empty($solusi_other) ? "$slsi" : $solusi_other;
		}
		?>
	</td>
	<td> <?= (date_diff(date_create($selesai),date_create($mulai))->i). " Menit";?> </td>
 
    </tr>
    <!-- <td><?php echo "<a href=./aksi.php?module=datakonsul&act=hapus&id=$r[id]>Hapus</a>";?></td> -->
<?php }?>
</table>
<br>
