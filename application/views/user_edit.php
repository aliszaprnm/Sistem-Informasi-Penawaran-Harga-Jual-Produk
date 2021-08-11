<div class="container-fluid">
  <h1 class="h3 mb-4 text-gray-800"><?php echo $title ?></h1>
  <?php echo $this->session->flashdata('message'); ?>
  <div class="card shadow mb-4">
  	<div class="card-header py-3">
  			<a href="<?php echo site_url('user') ?>" class="btn btn-info btn-sm"><i class="fas fa-arrow-left"></i> Kembali</a>
    </div>
    <div class="card-body">
      <form action="" method="post">
        <div class="form-group">
          <label for="nama">Nama</label>
          <input type="text" name="nama" class="form-control form-control-sm" id="nama" value="<?php echo $row->nama?>">
          <?php echo form_error('nama', '<span class="text-danger small pl-3">', '</span>'); ?>
        </div>
        <div class="form-group">
          <label for="username">Username</label>
          <input type="text" name="username" class="form-control form-control-sm" id="username" value="<?php echo $row->username?>">
          <?php echo form_error('username', '<span class="text-danger small pl-3">', '</span>'); ?>
        </div>
        <div class="form-group">
          <label for="level">Level</label>
          <select name="level" class="form-control" id="level">
            <option value="Administrator" <?php echo $row->level == "Administrator" ? 'selected' : '' ?>>Administrator </option>
            <option value="Bagian Marketing" <?php echo $row->level == "Bagian Marketing" ? 'selected' : '' ?>>Bagian Marketing </option>
            <option value="Operational Manager" <?php echo $row->level == "Operational Manager" ? 'selected' : '' ?>>Operational Manager </option>
          </select>
          <?php echo form_error('level', '<span class="text-danger small pl-3">', '</span>'); ?>
        </div>
        <div class="form-group">
          <label for="email">Email</label>
          <input type="text" name="email" class="form-control form-control-sm" id="email" value="<?php echo $row->email?>">
          <?php echo form_error('email', '<span class="text-danger small pl-3">', '</span>'); ?>
        </div>
        <button type="submit" class="btn btn-primary btn-sm float-right"><i class="fas fa-save"></i> Simpan</button>
      </form>
    </div>
  </div>
</div>