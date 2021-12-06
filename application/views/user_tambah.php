<div class="container-fluid">
  <h1 class="h3 mb-4 text-gray-800"><?php echo $title ?></h1>
  <?php echo $this->session->flashdata('message'); ?>
  <div class="card shadow mb-4">
  	<div class="card-header py-3">
  			<a href="<?php echo site_url('user') ?>" class="btn btn-info btn-sm"><i class="fas fa-arrow-left"></i> Kembali</a>
    </div>
    <div class="card-body">
      <form action="" method="post" enctype="multipart/form-data">
        <div class="form-group">
          <label for="nama">Official Name</label>
          <input type="text" name="nama" class="form-control form-control-sm" id="nama" value="<?php echo set_value('nama') ?>">
          <?php echo form_error('nama', '<span class="text-danger small pl-3">', '</span>'); ?>
        </div>
        <div class="form-group">
          <label for="username">Username</label>
          <input type="text" name="username" class="form-control form-control-sm" id="username" value="<?php echo set_value('username') ?>">
          <?php echo form_error('username', '<span class="text-danger small pl-3">', '</span>'); ?>
        </div>
        <div class="form-group">
          <label for="level">Level</label>
          <select name="level" class="form-control" id="level">
            <option value="" disabled selected>--- Pilih Level ---</option>
            <option value="Administrator"> Administrator </option>
            <option value="Marketing"> Marketing </option>
            <option value="Operational Manager"> Operational Manager </option>
          </select>
          <?php echo form_error('level', '<span class="text-danger small pl-3">', '</span>'); ?>
        </div>
        <div class="form-group">
          <label for="password">Password</label>
          <input type="password" name="password1" class="form-control form-control-sm" id="password1" value="<?php echo set_value('password1') ?>">
          <?php echo form_error('password1', '<span class="text-danger small pl-3">', '</span>'); ?>
        </div>
        <div class="form-group">
          <label for="password">Password Confirmation</label>
          <input type="password" name="password2" class="form-control form-control-sm" id="password2" value="<?php echo set_value('password2') ?>">
          <?php echo form_error('password2', '<span class="text-danger small pl-3">', '</span>'); ?>
        </div>
        <div class="form-group">
          <label for="email">Email</label>
          <input type="text" name="email" class="form-control form-control-sm" id="email" value="<?php echo set_value('email') ?>">
          <?php echo form_error('email', '<span class="text-danger small pl-3">', '</span>'); ?>
        </div>
        <button type="submit" class="btn btn-primary btn-sm float-right"><i class="fas fa-save"></i> Simpan</button>
      </form>
    </div>
  </div>
</div>
