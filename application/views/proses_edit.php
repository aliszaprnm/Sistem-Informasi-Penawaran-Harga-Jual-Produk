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
          <label for="kode_produk">Produk</label>
          <select name="kode_produk" class="form-control" id="kode_produk" disabled>
            <?php foreach ($produk as $p) { ?>
              <option value="<?php echo $p->kode_produk ?>" <?php echo $row->kode_produk == $p->kode_produk ? 'selected' : '' ?>> <?php echo $p->nama_produk ?> </option>
            <?php } ?>
          </select>
        </div>
        <!--<div class="form-group">
          <label for="nama_proses">Proses</label>
          <input type="text" name="nama_proses" class="form-control form-control-sm" id="nama_proses" value="<?php echo $row->nama_proses ?>">
          <?php echo form_error('nama_proses', '<span class="text-danger small pl-3">', '</span>'); ?>
        </div>-->
        <div class="form-group">
          <label for="nama_proses">Proses</label>
          <select name="id_proses" class="form-control" id="proses">
            <option value="" disabled selected>--- Pilih Proses ---</option>
            <?php foreach ($proses as $pros) { ?>
              <option value="<?php echo $pros->id ?>" <?= $row->id_proses == $pros->id ? 'selected' : '';?>> <?php echo $pros->nama_proses ?> </option>
            <?php } ?>
          </select>
          <?php echo form_error('nama_proses', '<span class="text-danger small pl-3">', '</span>'); ?>
        </div>
        <div class="form-group">
          <label for="kode_mesin">Mesin</label>
          <select name="kode_mesin" class="form-control" id="mesin">
            <option value="" disabled selected>--- Pilih Mesin ---</option>
            <?php foreach ($mesin as $m) { ?>
              <option value="<?php echo $m->kode_mesin ?>" <?php echo $row->kode_mesin == $m->kode_mesin ? 'selected' : '' ?>> <?php echo $m->nama_mesin ." - ". floatval($m->kekuatan) ." Ton" ?> </option>
            <?php } ?>
          </select>
          <!-- <input type="text" name="kode_mesin" class="form-control form-control-sm" id="kode_mesin" value="<?php echo $row->kode_mesin ?>"> -->
          <?php echo form_error('kode_mesin', '<span class="text-danger small pl-3">', '</span>'); ?>
        </div>
        <!-- <div class="form-group">
          <label for="std_dies_height">Standard Dies Height</label>
          <input type="text" name="std_dies_height" class="form-control form-control-sm" id="std_dies_height" value="<?php echo $row->std_dies_height ?>">
          <?php echo form_error('std_dies_height', '<span class="text-danger small pl-3">', '</span>'); ?>
        </div> -->
        <div class="form-group">
          <label for="harga_dies">Harga Dies</label>
          <input type="text" name="harga_dies" class="form-control form-control-sm" id="harga_dies" readonly value="<?php echo $row->harga_dies ?>">
          <?php echo form_error('harga_dies', '<span class="text-danger small pl-3">', '</span>'); ?>
        </div>
        <div class="form-group">
          <label for="harga_proses">Harga Proses</label>
          <input type="text" name="harga_proses" class="form-control form-control-sm" id="harga_proses" readonly value="<?php echo $row->harga_proses ?>">
          <?php echo form_error('harga_proses', '<span class="text-danger small pl-3">', '</span>'); ?>
        </div>
        <div class="form-group">
          <label for="harga_per_produk">Harga Proses per Produk</label>
          <input type="number" name="harga_per_produk" class="form-control form-control-sm" id="harga_per_produk" readonly value="<?php echo $row->harga_per_produk ?>">
          <?php echo form_error('harga_per_produk', '<span class="text-danger small pl-3">', '</span>'); ?>
        </div>
        <button type="submit" class="btn btn-primary btn-sm float-right"><i class="fas fa-save"></i> Simpan</button>
      </form>
    </div>
  </div>
</div>

<script>
$("#proses").change(function(){ 
      $.get("<?= site_url() ?>proses/getProses/"+$(this).val(), function(data, status){
        var jsonData = $.parseJSON(data);
        var option = '<option value="" disabled selected>--- Pilih Proses ---</option>';
        if(status == 'success') {
      if (jsonData.length > 0) {
        var harga = jsonData[0].harga
        document.getElementById("harga_proses").value = Number(jsonData[0].harga);
        document.getElementById("mesin").focus()
      }
        } else { alert('Something wrong!') }
      });
    });

  $("#mesin").on('input',function(){
    var kekuatan = $("select[id='mesin'] option:selected").text().split("-").pop().split(" ")[1] || 1;
    var harga = $("#harga_proses").val()
    document.getElementById("harga_per_produk").value = Number(kekuatan) * Number(harga)
    });

  $("#mesin").change(function(){ 
     $.get("<?= site_url() ?>mesin/getMesin/"+$(this).val(), function(data, status){
       var jsonData = $.parseJSON(data);
       var option = '<option value="" disabled selected>--- Pilih Mesin ---</option>';
       if(status == 'success') {
     if (jsonData.length > 0) {
       var harga_dies = jsonData[0].harga_dies
       document.getElementById("harga_dies").value = Number(jsonData[0].harga_dies);
     }
       } else { alert('Something wrong!') }
     });
  });
</script>
