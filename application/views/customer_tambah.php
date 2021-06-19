<div class="container-fluid">
  <h1 class="h3 mb-4 text-gray-800"><?php echo $title ?></h1>
  <?php echo $this->session->flashdata('message'); ?>
  <div class="card shadow mb-4">
  	<div class="card-header py-3">
  			<a href="<?php echo site_url('customer') ?>" class="btn btn-info btn-sm"><i class="fas fa-arrow-left"></i> Kembali</a>
    </div>
    <div class="card-body">
      <form action="" method="post">
        <div class="form-group">
          <label for="kode_customer">Kode Customer</label>
          <input type="text" name="kode_customer" class="form-control form-control-sm" id="kode_customer" value="<?php echo "CUST-".sprintf("%03s", $kode_customer) ?>" readonly>
          <?php echo form_error('kode_customer', '<span class="text-danger small pl-3">', '</span>'); ?>
        </div>
        <div class="form-group">
          <label for="nama_customer">Nama Customer</label>
          <input type="text" name="nama_customer" class="form-control form-control-sm" id="nama_customer" value="<?php echo set_value('nama_customer') ?>">
          <?php echo form_error('nama_customer', '<span class="text-danger small pl-3">', '</span>'); ?>
        </div>
        <div class="form-group">
          <label for="alamat">Alamat</label>
          <input type="text" name="alamat" class="form-control form-control-sm" id="alamat" value="<?php echo set_value('alamat') ?>">
          <?php echo form_error('alamat', '<span class="text-danger small pl-3">', '</span>'); ?>
        </div>
        <div class="form-group">
          <label for="jarak">Jarak</label>
          <input type="text" name="jarak" class="form-control form-control-sm" id="jarak" value="<?php echo set_value('jarak') ?>">
          <?php echo form_error('jarak', '<span class="text-danger small pl-3">', '</span>'); ?>
        </div>
        <div class="form-group">
          <label for="telp">Telp</label>
          <input type="text" name="telp" class="form-control form-control-sm" id="telp" value="<?php echo set_value('telp') ?>">
          <?php echo form_error('telp', '<span class="text-danger small pl-3">', '</span>'); ?>
        </div>
        <div class="form-group">
          <label for="email">Email</label>
          <input type="text" name="email" class="form-control form-control-sm" id="email" value="<?php echo set_value('email') ?>">
          <!-- <?php echo form_error('email', '<span class="text-danger small pl-3">', '</span>'); ?> -->
        </div>
        <button type="submit" class="btn btn-primary btn-sm float-right"><i class="fas fa-save"></i> Simpan</button>
      </form>
    </div>
  </div>
</div>