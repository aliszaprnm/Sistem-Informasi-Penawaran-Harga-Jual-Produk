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
          <label for="nama_proses">Nama Proses</label>
          <input type="text" name="nama_proses" class="form-control form-control-sm" id="nama_proses" value="<?php echo set_value('nama_proses') ?>">
          <?php echo form_error('nama_proses', '<span class="text-danger small pl-3">', '</span>'); ?>
        </div>
        <div class="form-group">
          <label for="harga">Harga Proses</label>
          <input type="text" name="harga" class="form-control form-control-sm" id="harga" value="<?php echo set_value('harga') ?>">
          <?php echo form_error('harga', '<span class="text-danger small pl-3">', '</span>'); ?>
        </div>
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