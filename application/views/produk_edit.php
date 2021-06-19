<div class="container-fluid">
  <h1 class="h3 mb-4 text-gray-800"><?php echo $title ?></h1>
  <?php echo $this->session->flashdata('message'); ?>
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <a href="<?php echo site_url('produk') ?>" class="btn btn-info btn-sm"><i class="fas fa-arrow-left"></i> Kembali</a>
    </div>
    <div class="card-body">
      <form action="" method="post">
        <div class="form-group">
          <label for="kode_produk">Kode Produk</label>
          <input type="text" name="kode_produk" readonly class="form-control form-control-sm" id="kode_produk" value="<?php echo $row->kode_produk ?>">
          <?php echo form_error('kode_produk', '<span class="text-danger small pl-3">', '</span>'); ?>
        </div>
        <div class="form-group">
          <label for="kode_grup">Kode Grup</label>
          <input type="text" name="kode_grup" class="form-control form-control-sm" id="kode_grup" value="<?php echo $row->kode_grup ?>">
          <?php echo form_error('kode_grup', '<span class="text-danger small pl-3">', '</span>'); ?>
        </div>
        <div class="form-group">
          <label for="kode_customer">Customer</label>
          <select name="kode_customer" class="form-control" id="kode_customer">
            <?php foreach ($customer as $c) { ?>
              <option value="<?php echo $c->kode_customer ?>" <?php echo $row->kode_customer == $c->kode_customer ? 'selected' : '' ?>> <?php echo $c->nama_customer ?> </option>
            <?php } ?>
          </select>
        </div>
        <div class="form-group">
          <label for="nama_produk">Nama Produk</label>
          <input type="text" name="nama_produk" class="form-control form-control-sm" id="nama_produk" value="<?php echo $row->nama_produk ?>">
          <?php echo form_error('nama_produk', '<span class="text-danger small pl-3">', '</span>'); ?>
        </div>
        <div class="form-group">
          <label for="cavity">Cavity</label>
          <input type="text" name="cavity" class="form-control form-control-sm" id="cavity" value="<?php echo $row->cavity ?>">
          <?php echo form_error('cavity', '<span class="text-danger small pl-3">', '</span>'); ?>
        </div>
        <!-- <div class="form-group">
          <label for="proses">Proses</label> <br />
          <?php foreach ($proses as $p) { ?>
            <input type="checkbox" name="proses[]" value="<?php echo $p->nama_proses ?>" <?php echo $row->proses == $p->nama_proses ? 'checked' : '' ?>> <?php echo $p->nama_proses ?>
          <?php } ?>
          <?php echo form_error('proses[]', '<span class="text-danger small pl-3">', '</span>'); ?>
        </div> -->
        <button type="submit" class="btn btn-primary btn-sm float-right"><i class="fas fa-save"></i> Simpan</button>
      </form>
    </div>
  </div>
</div>