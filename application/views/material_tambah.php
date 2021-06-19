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
          <label for="kode_produk">Produk</label>
          <select name="kode_produk" class="form-control" id="kode_produk">
            <option value="" disabled selected>--- Pilih Produk ---</option>
            <?php foreach ($produk as $p) { ?>
              <option value="<?php echo $p->kode_produk ?>"> <?php echo $p->nama_produk ?> </option>
            <?php } ?>
          </select>
        </div>
        <div class="form-group">
          <label for="jenis_material">Jenis Material</label>
          <input type="text" name="jenis_material" class="form-control form-control-sm" id="jenis_material" value="<?php echo set_value('jenis_material') ?>">
          <?php echo form_error('jenis_material', '<span class="text-danger small pl-3">', '</span>'); ?>
        </div>
        <div class="form-group">
          <label for="tebal_material">Tebal Material</label>
          <input type="text" name="tebal_material" class="form-control form-control-sm" id="tebal_material" value="<?php echo set_value('tebal_material') ?>">
          <?php echo form_error('tebal_material', '<span class="text-danger small pl-3">', '</span>'); ?>
        </div>
        <div class="form-group">
          <label for="lebar_material">Lebar Material</label>
          <input type="text" name="lebar_material" class="form-control form-control-sm" id="lebar_material" value="<?php echo set_value('lebar_material') ?>">
          <?php echo form_error('lebar_material', '<span class="text-danger small pl-3">', '</span>'); ?>
        </div>
        <div class="form-group">
          <label for="panjang_material">Panjang Material</label>
          <input type="text" name="panjang_material" class="form-control form-control-sm" id="panjang_material" value="<?php echo set_value('panjang_material') ?>">
          <?php echo form_error('panjang_material', '<span class="text-danger small pl-3">', '</span>'); ?>
        </div>
        <div class="form-group">
          <label for="berat_material">Berat Material</label>
          <input type="text" name="berat_material" class="form-control form-control-sm" id="berat_material" value="<?php echo set_value('berat_material') ?>">
          <?php echo form_error('berat_material', '<span class="text-danger small pl-3">', '</span>'); ?>
        </div>
        <div class="form-group">
          <label for="jml_per_sheet">Jumlah/Sheet</label>
          <input type="number" min="1" name="jml_per_sheet" class="form-control form-control-sm" id="jml_per_sheet" onkeyup="hitung()" value="<?php echo set_value('jml_per_sheet') ?>">
          <?php echo form_error('jml_per_sheet', '<span class="text-danger small pl-3">', '</span>'); ?>
        </div>
        <div class="form-group">
          <label for="berat_produk">Berat Produk</label>
          <input type="text" name="berat_produk" readonly class="form-control form-control-sm" id="berat_produk" onkeyup="hitung()" value="<?php echo set_value('berat_produk') ?>">
          <?php echo form_error('berat_produk', '<span class="text-danger small pl-3">', '</span>'); ?>
        </div>
        <div class="form-group">
          <label for="harga_material">Harga Material</label>
          <input type="text" name="harga_material" class="form-control form-control-sm" id="harga_material" onkeyup="hitung()"value="<?php echo set_value('harga_material') ?>">
          <?php echo form_error('harga_material', '<span class="text-danger small pl-3">', '</span>'); ?>
        </div>
        <div class="form-group">
          <label for="harga_per_produk">Harga Material per Produk</label>
          <input type="text" name="harga_per_produk" class="form-control form-control-sm" id="harga_per_produk" readonly value="<?php echo set_value('harga_per_produk') ?>">
          <?php echo form_error('harga_per_produk', '<span class="text-danger small pl-3">', '</span>'); ?>
        </div>
        <button type="submit" class="btn btn-primary btn-sm float-right"><i class="fas fa-save"></i> Simpan</button>
      </form>
    </div>
  </div>
</div>

<script>
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