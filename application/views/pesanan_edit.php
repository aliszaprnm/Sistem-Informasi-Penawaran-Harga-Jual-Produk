<div class="container-fluid">
  <h1 class="h3 mb-4 text-gray-800"><?php echo $title ?></h1>
  <?php echo $this->session->flashdata('message'); ?>
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <a href="<?php echo site_url('pesanan') ?>" class="btn btn-info btn-sm"><i class="fas fa-arrow-left"></i> Kembali</a>
    </div>
    <div class="card-body">
      <form action="" method="post">
        <div class="form-group">
          <label for="kode_pesanan">Kode Pesanan</label>
          <input type="text" name="kode_pesanan" readonly class="form-control form-control-sm" id="kode_pesanan" value="<?php echo $row->kode_pesanan ?>">
        </div>
        <div class="form-group">
          <label for="tanggal">Tanggal Pesanan</label>
          <input type="date" data-format="dd-mm-yyyy" name="tanggal" class="form-control" value="<?php echo $row->tanggal ?>">
          <?php echo form_error('tanggal', '<span class="text-danger small pl-3">', '</span>'); ?>
        </div>
        <div class="form-group">
          <label for="kode_customer">Customer</label>
          <select name="kode_customer" class="form-control" id="kode_customer">
            <?php foreach ($customer as $c) { ?>
              <option value="<?php echo $p->kode_customer ?>" <?php echo $row->kode_customer == $c->kode_customer ? 'selected' : '' ?>> <?php echo $c->nama_customer ?> </option>
            <?php } ?>
          </select>
        </div>
        <div class="form-group">
          <label for="kode_produk">Produk</label>
          <select name="kode_produk" class="form-control" id="kode_produk">
            <?php foreach ($produk as $p) { ?>
              <option value="<?php echo $p->kode_produk ?>" <?php echo $row->kode_produk == $p->kode_produk ? 'selected' : '' ?>> <?php echo $p->nama_produk ?> </option>
            <?php } ?>
          </select>
        </div>
        <div class="form-group">
          <label for="qty">Jumlah Pesanan</label>
          <input type="number" min="3000" name="qty" class="form-control form-control-sm" id="qty" value="<?php echo $row->qty ?>">
          <?php echo form_error('qty', '<span class="text-danger small pl-3">', '</span>'); ?>
        </div>
        <div class="form-group">
          <label for="keterangan">Keterangan</label>
          <input type="text" name="keterangan" class="form-control form-control-sm" id="keterangan" value="<?php echo $row->keterangan ?>">
          <?php echo form_error('keterangan', '<span class="text-danger small pl-3">', '</span>'); ?>
        </div>
        <button type="submit" class="btn btn-primary btn-sm float-right"><i class="fas fa-save"></i> Simpan</button>
      </form>
    </div>
  </div>
</div>