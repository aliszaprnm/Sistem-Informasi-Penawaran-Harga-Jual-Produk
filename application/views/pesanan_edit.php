<div class="container-fluid">
  <h1 class="h3 mb-4 text-gray-800"><?php echo $title ?></h1>
  <?php echo $this->session->flashdata('message'); ?>
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <a href="<?php echo site_url('pesanan') ?>" class="btn btn-info btn-sm"><i class="fas fa-arrow-left"></i> Kembali</a>
    </div>
    <div class="card-body">
      <form action="" method="post" enctype="multipart/form-data">
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
              <option value="<?php echo $c->kode_customer ?>" <?php echo $row->kode_customer == $c->kode_customer ? 'selected' : '' ?>> <?php echo $c->nama_customer ?> </option>
            <?php } ?>
          </select>
        </div>
            <table class="table table-bordered table-sm" id="detail_table">
              <thead style="text-align:center">
                <tr style="background: #F8F8FF">
					<th width="333px" scope="col">Produk</th>
					<th width="333px" scope="col">Jumlah Pesanan</th>
					<th width="333px" scope="col">Keterangan</th>
                  <!--<th scope="col" colspan="2"><img src="{{ asset('icon/Actions.png') }}" width="16" height="16"></th>-->
                </tr>
              </thead>
              <tbody style="text-align:center">
				<?php if(count($detil) > 0) {
					$i = 0; foreach($detil as $rows) { ?>
					<tr id="detail<?= $i; ?>" class="cloned-row">
					  <td>
						  <select name="kode_produk[]" class="form-control" id="kode_produk<?= $i; ?>">
							<option value="" disabled selected>--- Pilih Produk ---</option>
							<?php foreach ($produk as $p) { ?>
							  <option value="<?php echo $p->kode_produk ?>" <?= $p->kode_produk == $rows->kode_produk ? 'selected' : null; ?>> <?php echo $p->nama_produk ?> </option>
							<?php } ?>
						  </select>
					  </td>
					  <td>
						<input type="number" min="3000" name="qty[]" class="form-control form-control" id="qty<?= $i; ?>" value="<?php echo $rows->qty ?>">
					  </td>
					  <td>
						  <textarea name="keterangan[]" id="keterangan<?= $i; ?>" class="md-textarea form-control" rows="1" required><?php echo $rows->keterangan ?></textarea>
					  </td>
					</tr>
					<?php $i++; } ?>
					<tr id="detail<?= $i; ?>" class="cloned-row">
				<?php } else { ?>
					<tr id="detail0" class="cloned-row">
					  <td>
						<select name="kode_produk[]" class="form-control" id="kode_produk0">
						  <option value="" disabled selected>--- Pilih Produk ---</option>
						  <?php foreach ($produk as $p) { ?>
						    <option value="<?php echo $p->kode_produk ?>"> <?php echo $p->nama_produk ?> </option>
						  <?php } ?>
						</select>
					  </td>
					  <td>
						<input type="number" min="3000" name="qty[]" class="form-control form-control" id="qty0" value="<?php echo set_value('qty') ?>">
					  </td>
					  <td>
						<textarea name="keterangan[]" id="keterangan0" class="md-textarea form-control" rows="1" required><?php echo set_value('keterangan') ?></textarea>
					  </td>
					</tr>
					<tr id="detail1" class="cloned-row">
				<?php } ?>
              </tbody>
            </table>
            
			<div class="row">
				<div class="col-md-12">
					<button id="add_row" class="btn btn-success pull-left">+ Add Row</button>
					<button id='delete_row' class="pull-right btn btn-danger">- Delete Row</button>
				</div>
            </div>

            <br>
            <hr style="height:2px;border-width:0;color:#1E90FF;background-color:#1E90FF">
			<button type="submit" class="btn btn-primary btn-sm float-right"><i class="fas fa-save"></i> Update</button>
        </form>
    </div>
  </div>
</div>

<script>
$(document).ready(function() {
	let row_number = <?= count($detil); ?>;
    if(row_number <= 1) {
		$("#delete_row").prop('disabled', true);
	}
    $("#add_row").click(function(e){
      e.preventDefault();
      let new_row_number = row_number - 1;
      
      $('#detail' + row_number).html($('#detail' + new_row_number).html()).find('td:first-child');
      $('#detail_table').append('<tr id="detail' + (row_number + 1) + '" class=cloned-row></tr>');
      $("#kode_produk"+new_row_number, 'tr#detail'+row_number+'.cloned-row').attr('id', 'kode_produk'+row_number);
      $("#qty"+new_row_number, 'tr#detail'+row_number+'.cloned-row').attr('id', 'qty'+ row_number);
      $("#keterangan"+new_row_number, 'tr#detail'+row_number+'.cloned-row').attr('id', 'keterangan'+ row_number);

      row_number++;
      if(row_number > 1) {
		$("#delete_row").prop('disabled', false);
	  }
    });

    $("#delete_row").click(function(e){
      e.preventDefault();
      if(row_number > 1) {
        $("#detail" + (row_number - 1)).html('');
        row_number--;
        if(row_number <= 1) {
			$("#delete_row").prop('disabled', true);
		}
      }
    });
});
</script>
