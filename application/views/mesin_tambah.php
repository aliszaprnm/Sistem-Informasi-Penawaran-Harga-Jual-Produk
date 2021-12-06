<div class="container-fluid">
  <h1 class="h3 mb-4 text-gray-800"><?php echo $title ?></h1>
  <?php echo $this->session->flashdata('message'); ?>
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <a href="<?php echo site_url('mesin') ?>" class="btn btn-info btn-sm"><i class="fas fa-arrow-left"></i> Kembali</a>
    </div>
    <div class="card-body">
      <form action="" method="post">
        <div class="form-group">
          <label for="kode_mesin">Kode Mesin</label>
          <input type="text" name="kode_mesin" class="form-control form-control-sm" id="kode_mesin" value="<?php echo "MSN-".sprintf("%03s", $kode_mesin) ?>" readonly>
          <?php echo form_error('kode_mesin', '<span class="text-danger small pl-3">', '</span>'); ?>
        </div>
        <div class="form-group">
          <label for="nama_mesin">Nama Mesin</label>
          <input type="text" name="nama_mesin" class="form-control form-control-sm" id="nama_mesin" value="<?php echo set_value('nama_mesin') ?>">
          <?php echo form_error('nama_mesin', '<span class="text-danger small pl-3">', '</span>'); ?>
        </div>
        <div class="form-group">
          <label for="kekuatan">Kekuatan Mesin</label>
          <input type="text" name="kekuatan" class="form-control form-control-sm" id="kekuatan" value="<?php echo set_value('kekuatan') ?>">
          <?php echo form_error('kekuatan', '<span class="text-danger small pl-3">', '</span>'); ?>
        </div>

        <div class="form-group">
          <label for="vol_prod">Volume Produksi per Bulan</label>
          <input type="text" name="vol_prod" class="form-control form-control-sm" id="vol_prod" value="<?php echo set_value('vol_prod') ?>">
          <?php echo form_error('vol_prod', '<span class="text-danger small pl-3">', '</span>'); ?>
        </div>
        <div class="form-group">
          <label for="harga_dies">Harga Dies</label>
          <input type="text" name="harga_dies" class="form-control form-control-sm" id="harga_dies" value="<?php echo set_value('harga_dies') ?>">
          <?php echo form_error('harga_dies', '<span class="text-danger small pl-3">', '</span>'); ?>
        </div>
        <div class="form-group">
          <label for="depresiasi_dies">Depresiasi Dies (Bulan)</label>
          <input type="text" name="depresiasi_dies" class="form-control form-control-sm" id="depresiasi_dies" value="<?php echo set_value('depresiasi_dies') ?>">
          <?php echo form_error('depresiasi_dies', '<span class="text-danger small pl-3">', '</span>'); ?>
        </div>
        <!-- <div class="form-group">
          <label for="satuan">Satuan</label>
          <select name="satuan" class="form-control" id="satuan">
            <option value="" disabled selected>--- Pilih Satuan ---</option>
            <option value="Kg">Kg</option>
            <option value="Ton">Ton</option>
          <?php echo form_error('satuan', '<span class="text-danger small pl-3">', '</span>'); ?>
        </div> -->
        <!-- <div class="form-group">
          <label for="proses">Proses</label> <br />
          <?php foreach ($proses as $p) { ?>
            <input type="checkbox" name="proses[]" value="<?php echo $p->nama_proses ?>"> <?php echo $p->nama_proses ?>
          <?php } ?>
          <?php echo form_error('proses[]', '<span class="text-danger small pl-3">', '</span>'); ?>
        </div> -->
        <button type="submit" class="btn btn-primary btn-sm float-right"><i class="fas fa-save"></i> Simpan</button>
      </form>
    </div>
  </div>
</div>