<div class="container-fluid">
  <h1 class="h3 mb-4 text-gray-800"><?php echo $title ?></h1>
  <?php echo $this->session->flashdata('message'); ?>
  <div class="card shadow mb-4">
  	<div class="card-header py-3">
  			<a href="<?php echo site_url('toolingcost') ?>" class="btn btn-info btn-sm"><i class="fas fa-arrow-left"></i> Kembali</a>
    </div>
    <div class="card-body">
      <form action="" method="post" enctype="multipart/form-data">
		<div class="form-group">
          <label for="kode_pesanan">Pesanan</label>
          <select name="kode_pesanan" class="form-control" id="kode_pesanan" required>
            <option value="" disabled selected>--- Pilih Pesanan ---</option>
            <?php foreach ($pesanan as $o) { ?>
              <option value="<?php echo $o->id ?>"> <?php echo $o->kode_pesanan ?> </option>
            <?php } ?>
          </select>
        </div>
        <div class="form-group">
          <label for="kode_produk">Produk</label>
          <select name="kode_produk" class="form-control" id="kode_produk" required>
            <option value="" disabled selected>--- Pilih Produk ---</option>
            <?php foreach ($produk as $p) { ?>
              <option value="<?php echo $p->kode_produk ?>"> <?php echo $p->nama_produk ?> </option>
            <?php } ?>
          </select>
        </div>
        <div class="form-group">
          <label for="harga_dies">Harga Dies</label>
          <input type="text" name="harga_dies" class="form-control form-control-sm" id="harga_dies" value="<?php echo set_value('harga_dies') ?>" readOnly>
          <?php echo form_error('harga_dies', '<span class="text-danger small pl-3">', '</span>'); ?>
        </div>
        <div class="form-group">
          <label for="vol_prod">Volume Produksi</label>
          <input type="text" name="vol_prod" class="form-control form-control-sm" id="vol_prod" value="<?php echo set_value('vol_prod') ?>" required>
          <?php echo form_error('vol_prod', '<span class="text-danger small pl-3">', '</span>'); ?>
        </div>
        <div class="form-group">
          <label for="depresiasi_dies">Depresiasi Dies</label>
          <input type="text" name="depresiasi_dies" class="form-control form-control-sm" id="depresiasi_dies" value="<?php echo set_value('depresiasi_dies') ?>" required>
          <?php echo form_error('depresiasi_dies', '<span class="text-danger small pl-3">', '</span>'); ?>
        </div>
        <div class="form-group">
          <label for="total">Total</label>
          <input type="text" name="total" class="form-control form-control-sm" id="total" value="<?php echo set_value('total') ?>" readOnly>
          <?php echo form_error('total', '<span class="text-danger small pl-3">', '</span>'); ?>
        </div>
        <button type="submit" class="btn btn-primary btn-sm float-right"><i class="fas fa-save"></i> Simpan</button>
      </form>
    </div>
  </div>
</div>
<script>
	$("#kode_pesanan").change(function(){
	  $.get("<?= site_url() ?>processcost/get_pesanan/"+$(this).val(), function(data, status){
		  var jsonData = $.parseJSON(data);
		  var option = '<option value="" disabled selected>--- Pilih Produk ---</option>';
		  if(status == 'success') {
			for(i=0; i<jsonData.length; i++){
				option += `<option value="${jsonData[i].kode_produk}">${jsonData[i].produk}</option>`
			}
			$("#kode_produk").html(option);
		  } else { alert('Something wrong please contact administrator!') }
	  });
	});

	$("#kode_produk").change(function(){
	  $.get("<?= site_url() ?>toolingcost/get_harga/"+$(this).val(), function(data, status){
		  var jsonData = $.parseJSON(data);
		  if(status == 'success') {
			//for(i=0; i<jsonData.length; i++){
				$("#harga_dies").val(jsonData.harga_dies);
			//}
		  } else { alert('Something wrong please contact administrator!') }
	  });
	});
	
	$("input").keyup(function(){
	  const harga_dies = parseFloat($("#harga_dies").val()) || 1;
	  $("#total").val(parseFloat(parseFloat(harga_dies) / (parseFloat($("#vol_prod").val()) * parseFloat($("#depresiasi_dies").val()))).toFixed(2));
	});
</script>
