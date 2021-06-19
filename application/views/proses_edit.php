<div class="container-fluid">
  <h1 class="h3 mb-4 text-gray-800"><?php echo $title ?></h1>
  <?php echo $this->session->flashdata('message'); ?>
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <a href="<?php echo site_url('proses') ?>" class="btn btn-info btn-sm"><i class="fas fa-arrow-left"></i> Kembali</a>
    </div>
    <div class="card-body">
      <form action="" method="post">
        <div class="form-group">
          <label for="kode_produk">Produk</label>
          <select name="kode_produk" class="form-control" id="kode_produk">
            <?php foreach ($produk as $p) { ?>
              <option value="<?php echo $p->kode_produk ?>" <?php echo $row->kode_produk == $p->kode_produk ? 'selected' : '' ?>> <?php echo $p->nama_produk ?> </option>
            <?php } ?>
          </select>
        </div>
        <div class="form-group">
          <label for="nama_proses">Proses</label>
          <input type="text" name="nama_proses" class="form-control form-control-sm" id="nama_proses" value="<?php echo $row->nama_proses ?>">
          <?php echo form_error('nama_proses', '<span class="text-danger small pl-3">', '</span>'); ?>
        </div>
        <div class="form-group">
          <label for="kode_mesin">Mesin</label>
          <select name="kode_mesin" class="form-control" id="kode_mesin">
            <option value="" disabled selected>--- Pilih Mesin ---</option>
            <?php foreach ($mesin as $m) { ?>
              <option value="<?php echo $m->kode_mesin ?>" <?php echo $row->kode_mesin == $m->kode_mesin ? 'selected' : '' ?>> <?php echo $m->nama_mesin ." - ". floatval($m->kekuatan) ." ". $m->satuan ?> </option>
            <?php } ?>
          </select>
          <!-- <input type="text" name="kode_mesin" class="form-control form-control-sm" id="kode_mesin" value="<?php echo $row->kode_mesin ?>"> -->
          <?php echo form_error('kode_mesin', '<span class="text-danger small pl-3">', '</span>'); ?>
        </div>
        <div class="form-group">
          <label for="std_dies_height">Standard Dies Height</label>
          <input type="text" name="std_dies_height" class="form-control form-control-sm" id="std_dies_height" value="<?php echo $row->std_dies_height ?>">
          <?php echo form_error('std_dies_height', '<span class="text-danger small pl-3">', '</span>'); ?>
        </div>
        <div class="form-group">
          <label for="harga_dies">Harga Dies</label>
          <input type="text" name="harga_dies" class="form-control form-control-sm" id="harga_dies" value="<?php echo $row->harga_dies ?>">
          <?php echo form_error('harga_dies', '<span class="text-danger small pl-3">', '</span>'); ?>
        </div>
        <div class="form-group">
          <label for="harga_proses">Harga Proses</label>
          <input type="text" name="harga_proses" class="form-control form-control-sm" id="harga_proses" value="<?php echo $row->harga_proses ?>">
          <?php echo form_error('harga_proses', '<span class="text-danger small pl-3">', '</span>'); ?>
        </div><!-- 
        <div class="form-group">
          <label for="harga_per_produk">Harga Proses per Produk</label>
          <input type="text" name="harga_per_produk" class="form-control form-control-sm" id="harga_per_produk" readonly value="<?php echo $row->harga_proses ?>">
          <?php echo form_error('harga_per_produk', '<span class="text-danger small pl-3">', '</span>'); ?>
        </div> -->
        <button type="submit" class="btn btn-primary btn-sm float-right"><i class="fas fa-save"></i> Simpan</button>
      </form>
    </div>
  </div>
</div>

<!-- <script>
  function hitung() {
    let berat_material = document.getElementById('berat_material').value;
    let jml_per_sheet = document.getElementById('jml_per_sheet').value;
    let berat_produk = document.getElementById('berat_produk');
    let harga_material = document.getElementById('harga_material').value;
    let harga_per_produk = document.getElementById('harga_per_produk');

    berat_produk.value = parseFloat(berat_material)/parseInt(jml_per_sheet);
    harga_per_produk.value = parseInt(harga_material)*(parseFloat(berat_material)/parseInt(jml_per_sheet));
  }
</script> -->