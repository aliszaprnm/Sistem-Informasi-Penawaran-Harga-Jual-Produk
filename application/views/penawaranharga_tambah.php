<div class="container-fluid">
  <h1 class="h3 mb-4 text-gray-800"><?php echo $title ?></h1>
  <?php echo $this->session->flashdata('message'); ?>
  <div class="card shadow mb-4">
  	<div class="card-header py-3">
  			<a href="<?php echo site_url('penawaranharga') ?>" class="btn btn-info btn-sm"><i class="fas fa-arrow-left"></i> Kembali</a>
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
          <label for="customer">Customer</label>
          <select name="kode_customer" class="form-control select" id="kode_customer" required>
            <option value="" disabled selected>--- Pilih Customer ---</option>
            <?php foreach ($customer as $c) { ?>
              <option value="<?php echo $c->kode_customer ?>"> <?php echo $c->nama_customer ?> </option>
            <?php } ?>
          </select>
        </div>
        <div class="form-group">
          <label for="process_cost">Process Cost</label>
          <input type="text" name="process_cost" class="form-control form-control-sm" id="process_cost" value="<?php echo set_value('process_cost') ?>" required readOnly>
          <?php echo form_error('process_cost', '<span class="text-danger small pl-3">', '</span>'); ?>
        </div>
        <div class="form-group">
          <label for="tooling_cost">Tooling Cost</label>
          <input type="text" name="tooling_cost" class="form-control form-control-sm" id="tooling_cost" value="<?php echo set_value('tooling_cost') ?>" required readOnly>
          <?php echo form_error('tooling_cost', '<span class="text-danger small pl-3">', '</span>'); ?>
        </div>
        <div class="form-group">
          <label for="harga_jual">Harga Jual</label>
          <input type="text" name="harga_jual" class="form-control form-control-sm" id="harga_jual" value="<?php echo set_value('harga_jual') ?>" required readOnly>
          <?php echo form_error('harga_jual', '<span class="text-danger small pl-3">', '</span>'); ?>
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
		  var optionProduk = '<option value="" disabled selected>--- Pilih Produk ---</option>';
		  var optionCustomer = '<option value="" disabled selected>--- Pilih Customer ---</option>';
		  if(status == 'success') {
			for(i=0; i<jsonData.length; i++){
				optionProduk += `<option value="${jsonData[i].kode_produk}">${jsonData[i].produk}</option>`
				optionCustomer += `<option value="${jsonData[i].kode_customer}">${jsonData[i].customer}</option>`
			}
			$("#kode_produk").html(optionProduk);
			$("#kode_customer").html(optionCustomer);
			/*$(".select option").val(function(idx, val) {
			  $(this).siblings('[value="'+ val +'"]').remove();
			});*/
			var map = {};
			$('.select option').each(function () {
				if (map[this.value]) {
					$(this).remove()
				}
				map[this.value] = true;
			})
		  } else { alert('Something wrong please contact administrator!') }
	  });
	  $.get("<?= site_url() ?>penawaranharga/get_harga/"+$(this).val(), function(data, status){
		  var jsonData = $.parseJSON(data);
		  if(status == 'success') {
				$("#process_cost").val(jsonData.process_cost);
				$("#tooling_cost").val(jsonData.tooling_cost);
				$("#harga_jual").val(parseFloat(jsonData.process_cost) + parseFloat(jsonData.tooling_cost));
		  } else { alert('Something wrong please contact administrator!') }
	  });
	});

	/*$("#kode_produk").change(function(){
	  $.get("<?= site_url() ?>penawaranharga/get_harga/"+$(this).val(), function(data, status){
		  var jsonData = $.parseJSON(data);
		  if(status == 'success') {
			//for(i=0; i<jsonData.length; i++){
				$("#process_cost").val(jsonData.process_cost);
				$("#tooling_cost").val(jsonData.tooling_cost);
				$("#harga_jual").val(parseFloat(jsonData.process_cost) + parseFloat(jsonData.tooling_cost));
			//}
		  } else { alert('Something wrong please contact administrator!') }
	  });
	});*/
	
	$("input").keyup(function(){
		$("#harga_jual").val(parseFloat($("#process_cost").val()) + parseFloat($("#tooling_cost").val()));
	});
</script>
