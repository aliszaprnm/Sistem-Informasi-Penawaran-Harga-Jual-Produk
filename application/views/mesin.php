<div class="container-fluid">
  <h1 class="h3 mb-4 text-gray-800"><?php echo $title ?></h1>
  <?php echo $this->session->flashdata('message'); ?>
  <div class="card shadow mb-4">
    <div class="card-header py-3">
        <a href="<?php echo site_url('mesin/tambah') ?>" class="btn btn-info btn-sm"><i class="fas fa-plus-square"></i> Tambah Mesin</a>
        <a href="<?php echo site_url('mesin/pdf') ?>" class="btn btn-info btn-sm" target="_blank"><i class="fas fa-file-pdf"></i> Cetak PDF</a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Kode Mesin</th>
                        <th>Nama Mesin</th>
                        <th>Kekuatan Mesin</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($rows as $row) { ?>
                        <tr>
                            <td><?php echo $row->kode_mesin ?></td>
                            <td><?php echo $row->nama_mesin ?></td>
                            <td><?php echo floatval($row->kekuatan) ." ". $row->satuan ?></td>
                            <td>
                                <a href="<?php echo site_url('mesin/edit/' .$row->kode_mesin) ?>" class="btn btn-primary btn-sm"><i class="fas fa-pencil-alt"></i></a>
                                <a href="<?php echo site_url('mesin/hapus/'.$row->kode_mesin) ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')"class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
  </div>
</div>