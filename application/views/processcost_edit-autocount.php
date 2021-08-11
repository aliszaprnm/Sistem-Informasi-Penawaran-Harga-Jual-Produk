<div class="container-fluid">
  <h1 class="h3 mb-4 text-gray-800"><?php echo $title ?></h1>
  <?php echo $this->session->flashdata('message'); ?>
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <a href="<?php echo site_url('processcost') ?>" class="btn btn-info btn-sm"><i class="fas fa-arrow-left"></i> Kembali</a>
    </div>
    <div class="card-body">
      <form action="" method="post">
		<div class="form-group">
          <label for="kode_pesanan">Pesanan</label>
          <select name="kode_pesanan" class="form-control" id="kode_pesanan" disabled>
            <option value="" disabled selected>--- Pilih Pesanan ---</option>
            <?php foreach ($pesanan as $o) { ?>
              <option value="<?php echo $o->id ?>" <?= ($row->pesanan_id == $o->id) ? 'selected' : ''; ?>> <?php echo $o->kode_pesanan ?> </option>
            <?php } ?>
          </select>
        </div>
        <div class="form-group">
          <label for="kode_produk">Produk</label>
          <select name="kode_produk" class="form-control" id="kode_produk" disabled>
            <option value="" disabled selected>--- Pilih Produk ---</option>
            <?php foreach ($produk as $p) { ?>
              <option value="<?php echo $p->kode_produk ?>" <?= ($row->kode_produk == $p->kode_produk) ? 'selected' : ''; ?>> <?php echo $p->nama_produk ?> </option>
            <?php } ?>
          </select>
        </div>
        <div class="form-group">
          <label for="material">Harga Material</label>
          <input type="text" name="material" class="form-control form-control-sm" id="material" value="<?php echo $row->harga_material ?>" readOnly>
          <?php echo form_error('material', '<span class="text-danger small pl-3">', '</span>'); ?>
        </div>
        <div class="form-group">
          <label for="process">Harga Proses</label>
          <input type="text" name="process" class="form-control form-control-sm" id="process" value="<?php echo $row->harga_proses ?>" readOnly>
          <?php echo form_error('process', '<span class="text-danger small pl-3">', '</span>'); ?>
        </div>
        <div class="form-group">
          <label for="sub_material">Harga Sub Material</label>
          <input type="text" name="sub_material" class="form-control form-control-sm" id="sub_material" value="<?php echo $row->harga_sub_material ?>" readOnly>
          <?php echo form_error('sub_material', '<span class="text-danger small pl-3">', '</span>'); ?>
        </div>
        <div class="form-group">
          <label for="transportation">Transportation</label>
          <input type="text" name="jarak" class="form-control form-control-sm" id="jarak" value="<?php echo $row->jarak ?>">
          <input type="number" min="0" lang="en" step="0.01" name="transportation" class="form-control form-control-sm" id="transportation" value="<?php echo $row->harga_delivery ?>" onblur="hitung(this)">
          <?php echo form_error('transportation', '<span class="text-danger small pl-3">', '</span>'); ?>
        </div>
        <div class="form-group">
          <label for="packing">Packing</label>
          <input type="number" min="0" lang="en" step="0.01" name="packing" class="form-control form-control-sm" id="packing" value="<?php echo $row->harga_packing ?>" onblur="hitung(this)">
          <?php echo form_error('packing', '<span class="text-danger small pl-3">', '</span>'); ?>
        </div>
        <div class="form-group">
          <label for="quality">Quality Control</label>
          <input type="number" min="0" lang="en" step="0.01" name="quality" class="form-control form-control-sm" id="quality" value="<?php echo $row->harga_qc ?>" onblur="hitung(this)">
          <?php echo form_error('quality', '<span class="text-danger small pl-3">', '</span>'); ?>
        </div>
        <div class="form-group">
          <label for="mtc_dies">Maintenance Dies</label>
          <input type="number" min="0" lang="en" step="0.01" name="mtc_dies" class="form-control form-control-sm" id="mtc_dies" value="<?php echo $row->harga_mtc_dies ?>" onblur="hitung(this)">
          <?php echo form_error('mtc_dies', '<span class="text-danger small pl-3">', '</span>'); ?>
        </div>
        <div class="form-group">
          <label for="harga_material">Profit & OH</label>
          <input type="number" min="0" lang="en" step="0.01" name="profit_oh" class="form-control form-control-sm" id="profit_oh" value="<?php echo $row->profit_dan_OH ?>" onblur="hitung(this)">
          <?php echo form_error('profit_oh', '<span class="text-danger small pl-3">', '</span>'); ?>
        </div>
        <div class="form-group">
          <label for="total">Total</label>
          <input type="number" min="0" lang="en" step="0.01" name="total" class="form-control form-control-sm" id="total" readonly value="<?php echo $row->total ?>">
          <?php echo form_error('total', '<span class="text-danger small pl-3">', '</span>'); ?>
        </div>
        <button type="submit" class="btn btn-primary btn-sm float-right"><i class="fas fa-save"></i> Simpan</button>
      </form>
    </div>
  </div>
</div>

<script>
  function hitung(arg) {
	  //$(this).val(parseFloat($(this).val()) * parseFloat($('#process').val()));
	var id = arg.getAttribute('id');
	var values = parseFloat(arg.value);
	var process = parseFloat($('#process').val());
	if(id=='transportation') process = parseFloat($('#jarak').val());
	$('#'+id).val(parseFloat(values * process).toFixed(2));
    /*let berat_material = document.getElementById('berat_material').value;
    let jml_per_sheet = document.getElementById('jml_per_sheet').value;
    let berat_produk = document.getElementById('berat_produk');
    let harga_material = document.getElementById('harga_material').value;
    let harga_per_produk = document.getElementById('harga_per_produk');

    berat_produk.value = parseFloat(berat_material)/parseInt(jml_per_sheet);
    harga_per_produk.value = parseInt(harga_material)*(parseFloat(berat_material)/parseInt(jml_per_sheet));*/
  }

  $("#kode_pesanan").change(function(){	 
	  $.get("<?= site_url() ?>processcost/get_pesanan/"+$(this).val(), function(data, status){
		  var jsonData = $.parseJSON(data);
		  var option = '<option value="" disabled selected>--- Pilih Produk ---</option>';
		  if(status == 'success') {
			for(i=0; i<jsonData.length; i++){
				option += `<option value="${jsonData[i].kode_produk}">${jsonData[i].produk}</option>`
				$("#jarak").val(jsonData[i].jarak);
			}
			$("#kode_produk").html(option);
		  } else { alert('Something wrong please contact administrator!') }
	  });
  });
  
  $("#kode_produk").change(function(){	 
	  $.get("<?= site_url() ?>processcost/get_harga/"+$(this).val(), function(data, status){
		  var jsonData = $.parseJSON(data);
		  if(status == 'success') {
			//for(i=0; i<jsonData.length; i++){
				$("#material").val(jsonData.harga_material);
				$("#sub_material").val(jsonData.total_submaterial);
				$("#process").val(jsonData.total_proses);
			//}
		  } else { alert('Something wrong please contact administrator!') }
	  });
  });

  $("#transportation").keyup(function(){
	  $("#packing, #quality").val($(this).val() * 5/100);
	  $("#mtc_dies").val($(this).val() * 10/100);
	  $("#profit_oh").val($(this).val() * 25/100);
  });
  
  $("input").keyup(function(){
	  $("#total").val(parseFloat(parseFloat($("#material").val()) + parseFloat($("#process").val()) + parseFloat($("#sub_material").val()) + parseFloat($("#transportation").val()) + parseFloat($("#packing").val()) + parseFloat($("#quality").val()) + parseFloat($("#mtc_dies").val()) + parseFloat($("#profit_oh").val())).toFixed(2));
  })
</script>
