<div class="container-fluid">
  <h1 class="h3 mb-4 text-gray-800"><?php echo $title ?></h1>
  <?php echo $this->session->flashdata('message'); ?>
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <a href="<?php echo site_url('material') ?>" class="btn btn-info btn-sm"><i class="fas fa-arrow-left"></i> Kembali</a>
    </div>
    <div class="card-body">
      <form action="" method="post">
        <div class="form-group">
          <label for="kode_customer">Customer</label>
          <select name="kode_customer" class="form-control" id="kode_customer" disabled>
            <?php foreach ($customer as $c) { ?>
              <option value="<?php echo $c->kode_customer ?>" <?= ($row->kode_customer == $c->kode_customer) ? 'selected' : ''; ?>> <?php echo $c->nama_customer ?> </option>
            <?php } ?>
          </select>
        </div>
        <div class="form-group">
          <label for="kode_produk">Produk</label>
          <select name="kode_produk" class="form-control" id="kode_produk" disabled>
            <?php foreach ($produk as $p) { ?>
              <option value="<?php echo $p->kode_produk ?>" <?= ($row->kode_produk == $p->kode_produk) ? 'selected' : ''; ?>> <?php echo $p->nama_produk ?> </option>
            <?php } ?>
          </select>
        </div>
        <div class="form-group">
          <label for="jenis_material">Jenis Material</label>
          <select name="id_material" class="form-control" id="id_material">
            <?php foreach ($material as $mat) { ?>
              <option value="<?php echo $mat->id ?>" <?php echo $row->id_material == $mat->id ? 'selected' : '' ?>> <?php echo $mat->jenis_material ?> </option>
            <?php } ?>
          </select>
        </div>
        <div class="form-group">
          <label for="tebal_material">Tebal Material</label>
          <input type="number" lang="en" step="0.001" name="tebal_material" class="form-control form-control-sm" id="tebal_material" value="<?php echo $row->tebal_material ?>" required>
          <?php echo form_error('tebal_material', '<span class="text-danger small pl-3">', '</span>'); ?>
        </div>
        <div class="form-group">
          <label for="lebar_material">Lebar Material</label>
          <input type="number" lang="en" step="0.001" name="lebar_material" class="form-control form-control-sm" id="lebar_material" value="<?php echo $row->lebar_material ?>" required>
          <?php echo form_error('lebar_material', '<span class="text-danger small pl-3">', '</span>'); ?>
        </div>
        <div class="form-group">
          <label for="panjang_material">Panjang Material</label>
          <input type="number" lang="en" step="0.001" name="panjang_material" class="form-control form-control-sm" id="panjang_material" value="<?php echo $row->panjang_material ?>" required>
          <?php echo form_error('panjang_material', '<span class="text-danger small pl-3">', '</span>'); ?>
        </div>
        <div class="form-group">
          <label for="berat_material">Berat Material</label>
          <input type="number" lang="en" step="0.001" name="berat_material" class="form-control form-control-sm" id="berat_material" value="<?php echo $row->berat_material ?>" required>
          <?php echo form_error('berat_material', '<span class="text-danger small pl-3">', '</span>'); ?>
        </div>
        <div class="form-group">
          <label for="jml_per_sheet">Jumlah/Sheet</label>
          <input type="number" min="1" name="jml_per_sheet" class="form-control form-control-sm" id="jml_per_sheet" onkeyup="hitung(this)" value="<?php echo $row->jml_per_sheet ?>" required onkeyup="hitung(this)" onmouseup="hitung(this)">
          <?php echo form_error('jml_per_sheet', '<span class="text-danger small pl-3">', '</span>'); ?>
        </div>
        <div class="form-group">
          <label for="berat_produk">Berat Produk</label>
          <input type="number" min="0" name="berat_produk" readonly class="form-control form-control-sm" id="berat_produk" onkeyup="hitung(this)" value="<?php echo $row->berat_produk ?>" required onkeyup="hitung(this)" onmouseup="hitung(this)">
          <?php echo form_error('berat_produk', '<span class="text-danger small pl-3">', '</span>'); ?>
        </div>
        <div class="form-group">
          <label for="harga_material">Harga Material</label>
          <input type="number" min="1" name="harga_material" class="form-control form-control-sm" id="harga_material" onkeyup="hitung(this)"value="<?php echo $row->harga_material ?>" required onkeyup="hitung(this)" onmouseup="hitung(this)">
          <?php echo form_error('harga_material', '<span class="text-danger small pl-3">', '</span>'); ?>
        </div>
        <div class="form-group">
          <label for="harga_per_produk">Harga Material per Produk</label>
          <input type="number" min="1" name="harga_per_produk" class="form-control form-control-sm" id="harga_per_produk" readonly value="<?php echo $row->harga_per_produk ?>">
          <?php echo form_error('harga_per_produk', '<span class="text-danger small pl-3">', '</span>'); ?>
        </div>
        <button type="submit" class="btn btn-primary btn-sm float-right"><i class="fas fa-save"></i> Simpan</button>
      </form>
    </div>
  </div>
</div>

<script>
  $("#kode_customer").change(function(){ 
      $.get("<?= site_url() ?>produk/get_customer/"+$(this).val(), function(data, status){
        var jsonData = $.parseJSON(data);
        var option = '<option value="" disabled selected>--- Pilih Material ---</option>';
        if(status == 'success') {
        for(i=0; i<jsonData.length; i++){
      var data = `${jsonData[i].jenis_material} - ${Number(jsonData[i].tebal)} X ${jsonData[i].lebar} X ${jsonData[i].panjang}`
          option += `<option value="${jsonData[i].id}">${data}</option>`
        }
        $("#material0").html(option);
        } else { alert('Something wrong!') }
      });
    });

  // $("#kode_produk").change(function(){   
  //   $.get("<?= site_url() ?>processcost/get_harga/"+$(this).val(), function(data, status){
  //     var jsonData = $.parseJSON(data);
  //     if(status == 'success') {
  //     //for(i=0; i<jsonData.length; i++){
  //       $("#material").val(jsonData.harga_material);
  //       $("#sub_material").val(jsonData.total_submaterial);
  //       $("#process").val(jsonData.total_proses);
  //     //}
  //     } else { alert('Something wrong please contact administrator!') }
  //   });
  // });

  function hitung() {
    let berat_material = document.getElementById('berat_material').value;
    let jml_per_sheet = document.getElementById('jml_per_sheet').value;
    let berat_produk = document.getElementById('berat_produk');
    let harga_material = document.getElementById('harga_material').value;
    let harga_per_produk = document.getElementById('harga_per_produk');

    berat_produk.value = parseFloat(berat_material)/parseInt(jml_per_sheet);
    harga_per_produk.value = parseInt(harga_material)*(parseFloat(berat_material)/parseInt(jml_per_sheet));
  }
</script>
