<div class="container-fluid">
  <h1 class="h3 mb-4 text-gray-800"><?php echo $title ?></h1>
  <?php echo $this->session->flashdata('message'); ?>
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <a href="<?php echo site_url('submaterial') ?>" class="btn btn-info btn-sm"><i class="fas fa-arrow-left"></i> Kembali</a>
    </div>
    <div class="card-body">
      <form action="" method="post">
        <div class="form-group">
          <label for="kode_produk">Produk</label>
          <select name="kode_produk" class="form-control" id="kode_produk">
            <option value="" disabled selected>--- Pilih Produk ---</option>
            <?php foreach ($produk as $p) { ?>
              <option value="<?php echo $p->kode_produk ?>" <?php echo $row->kode_produk == $p->kode_produk ? 'selected' : '' ?>> <?php echo $p->nama_produk ?> </option>
            <?php } ?>
          </select>
        </div>
        <div class="form-group">
          <label for="sub_material">Sub Material</label>
          <input type="text" name="sub_material" class="form-control form-control-sm" id="sub_material" value="<?php echo $row->sub_material ?>">
          <?php echo form_error('sub_material', '<span class="text-danger small pl-3">', '</span>'); ?>
        </div>
        <div class="form-group">
          <label for="pemakaian">Pemakaian (kg)</label>
          <input type="text" name="pemakaian" class="form-control form-control-sm" id="pemakaian" onkeyup="hitung()" value="<?php echo $row->pemakaian ?>">
          <?php echo form_error('pemakaian', '<span class="text-danger small pl-3">', '</span>'); ?>
        </div>
        <div class="form-group">
          <label for="harga_sub_material">Harga Sub Material</label>
          <input type="text" name="harga_sub_material" class="form-control form-control-sm" id="harga_sub_material" onkeyup="hitung()" value="<?php echo $row->harga_sub_material ?>">
          <?php echo form_error('harga_sub_material', '<span class="text-danger small pl-3">', '</span>'); ?>
        </div>
        <div class="form-group">
          <label for="harga_per_produk">Harga Sub Material per Produk</label>
          <input type="text" name="harga_per_produk" class="form-control form-control-sm" id="harga_per_produk" readonly value="<?php echo $row->harga_per_produk ?>">
          <?php echo form_error('harga_per_produk', '<span class="text-danger small pl-3">', '</span>'); ?>
        </div>
        <button type="submit" class="btn btn-primary btn-sm float-right"><i class="fas fa-save"></i> Simpan</button>
      </form>
    </div>
  </div>
</div>

<script>
  function hitung() {
    let pemakaian = document.getElementById('pemakaian').value;
    let harga_sub_material = document.getElementById('harga_sub_material').value;
    let harga_per_produk = document.getElementById('harga_per_produk');

    harga_per_produk.value = parseInt(harga_sub_material)*parseFloat(pemakaian);
  }
</script>