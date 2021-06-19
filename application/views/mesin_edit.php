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
          <input type="text" name="kode_mesin" readonly class="form-control form-control-sm" id="kode_mesin" value="<?php echo $row->kode_mesin ?>">
          <?php echo form_error('kode_mesin', '<span class="text-danger small pl-3">', '</span>'); ?>
        </div>
        <div class="form-group">
          <label for="nama_mesin">Nama Mesin</label>
          <input type="text" name="nama_mesin" class="form-control form-control-sm" id="nama_mesin" value="<?php echo $row->nama_mesin ?>">
          <?php echo form_error('nama_mesin', '<span class="text-danger small pl-3">', '</span>'); ?>
        </div>
        <div class="form-group">
          <label for="kekuatan">Kekuatan Mesin</label>
          <!-- <input type="number" min="0" name="cavity" value="<?=$row->cavity?>" class="form-control"> -->
          <input type="text" name="kekuatan" class="form-control form-control-sm" id="kekuatan" value="<?php echo $row->kekuatan ?>">
          <?php echo form_error('kekuatan', '<span class="text-danger small pl-3">', '</span>'); ?>
        </div>
        <div class="form-group">
          <label for="satuan">Satuan</label>
          <select name="satuan" class="form-control" id="satuan">
            <option value="Kg" <?php if($row->satuan == "Kg") { echo "selected";} ?>>Kg </option>
            <option value="Ton" <?php if($row->satuan == "Ton") { echo "selected";} ?>>Ton </option>
          </select>
          <?php echo form_error('satuan', '<span class="text-danger small pl-3">', '</span>'); ?>
        </div>
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