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
          <select name="kode_customer" class="form-control" id="kode_customer">
            <option value="" disabled selected>--- Pilih Customer ---</option>
            <?php foreach ($customer as $c) { ?>
              <option value="<?php echo $c->kode_customer ?>"> <?php echo $c->nama_customer ?> </option>
            <?php } ?>
          </select>
        </div>
        <div class="form-group">
          <label for="jenis_material">Jenis Material</label>
          <input type="text" name="jenis_material" class="form-control form-control-sm" id="jenis_material" value="<?php echo set_value('jenis_material') ?>">
          <?php echo form_error('jenis_material', '<span class="text-danger small pl-3">', '</span>'); ?>
        </div>
        <div class="form-group">
          <label for="tebal">Tebal Material</label>
          <input type="number" lang="en" step="0.001" name="tebal" class="form-control form-control-sm" id="tebal" value="<?php echo set_value('tebal') ?>">
          <?php echo form_error('tebal', '<span class="text-danger small pl-3">', '</span>'); ?>
        </div>
        <div class="form-group">
          <label for="lebar">Lebar Material</label>
          <input type="number" min="0" lang="en" step="0.001" name="lebar" class="form-control form-control-sm" id="lebar" value="<?php echo set_value('lebar') ?>">
          <?php echo form_error('lebar', '<span class="text-danger small pl-3">', '</span>'); ?>
        </div>
        <div class="form-group">
          <label for="panjang">Panjang Material</label>
          <input type="number" min="0" lang="en" step="0.001" name="panjang" class="form-control form-control-sm" id="panjang" value="<?php echo set_value('panjang') ?>">
          <?php echo form_error('panjang', '<span class="text-danger small pl-3">', '</span>'); ?>
        </div>
        <div class="form-group">
          <label for="harga">Harga Material</label>
          <input type="number" min="1" name="harga" class="form-control form-control-sm" id="harga" value="<?php echo set_value('harga') ?>">
          <?php echo form_error('harga', '<span class="text-danger small pl-3">', '</span>'); ?>
        </div>
        <button type="submit" class="btn btn-primary btn-sm float-right"><i class="fas fa-save"></i> Simpan</button>
      </form>
    </div>
  </div>
</div>

<!-- <script>
  function hitung(arg) {
    let tebal_material = document.getElementById('tebal_material').value;
    let lebar_material = document.getElementById('lebar_material').value;
    let panjang_material = document.getElementById('panjang_material').value;
    let berat_material = document.getElementById('berat_material');
    let jml_per_sheet = document.getElementById('jml_per_sheet').value;
    let berat_produk = document.getElementById('berat_produk');
    let harga_material = document.getElementById('harga_material').value;
    let harga_per_produk = document.getElementById('harga_per_produk');

    berat_material.value = (parseFloat(tebal_material)*parseFloat(lebar_material)*parseFloat(panjang_material)*(7.85))/1000000;
    berat_produk.value = ((parseFloat(tebal_material)*parseFloat(lebar_material)*parseFloat(panjang_material)*(7.85))/1000000)/parseInt(jml_per_sheet);
    harga_per_produk.value = parseInt(harga_material)*(((parseFloat(tebal_material)*parseFloat(lebar_material)*parseFloat(panjang_material)*(7.85))/1000000)/parseInt(jml_per_sheet));
  }
</script> -->
