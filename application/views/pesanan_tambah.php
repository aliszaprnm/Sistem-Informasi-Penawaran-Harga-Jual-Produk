<div class="container-fluid">
  <h1 class="h3 mb-4 text-gray-800"><?php echo $title ?></h1>
  <?php echo $this->session->flashdata('message'); ?>
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <a href="<?php echo site_url('pesanan') ?>" class="btn btn-info btn-sm"><i class="fas fa-arrow-left"></i> Kembali</a>
    </div>
    <div class="card-body">
      <form method="post" action="" enctype="multipart/form-data">
            <div class="form-row">
              <div class="form-group col-md-4">
                <label for="kode_pesanan">Kode Pesanan</label>
				  <input type="text" name="kode_pesanan" class="form-control" id="kode_pesanan" value="<?php echo "ORDER-".sprintf("%05s", $kode_pesanan) ?>" readonly>
              </div>
              <div class="form-group col-md-4">
				<label for="tanggal">Tanggal Pesanan</label>
				  <input type="date" data-format="yyyy-mm-dd" name="tanggal" class="form-control" value="<?php echo set_value('tanggal', date('Y-m-d')) ?>" required>
				  <?php echo form_error('tanggal', '<span class="text-danger small pl-3">', '</span>'); ?>
              </div>
              <div class="form-group col-md-4">
                <label for="kode_customer">Customer</label>
				  <select name="kode_customer" class="form-control" id="kode_customer" required>
					<option value="" disabled selected>--- Pilih Customer ---</option>
					<?php foreach ($customer as $c) { ?>
					  <option value="<?php echo $c->kode_customer ?>"> <?php echo $c->nama_customer ?> </option>
					<?php } ?>
				  </select>
              </div>
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
                <tr id="detail0" class="cloned-row">
                  <td>
					  <select name="kode_produk[]" class="form-control" id="kode_produk0" required>
						<option value="" disabled selected>--- Pilih Produk ---</option>
						<!-- <?php foreach ($produk as $p) { ?>
						  <option value="<?php echo $p->kode_produk ?>"> <?php echo $p->nama_produk ?> </option>
						<?php } ?> -->
					  </select>
                  </td>
                  <td>
					<input type="number" min="3000" name="qty[]" class="form-control form-control" id="qty0" value="<?php echo set_value('qty') ?>" required>
                  </td>
                  <td>
                      <textarea name="keterangan[]" id="keterangan0" class="md-textarea form-control" rows="1"><?php echo set_value('keterangan') ?></textarea>
                  </td>
                </tr>
                <tr id="detail1" class="cloned-row">
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
			<button type="submit" class="btn btn-primary btn-sm float-right"><i class="fas fa-save"></i> Simpan</button>
        </form>
    </div>
  </div>
</div>

<script>
  $("#kode_customer").change(function(){ 
      $.get("<?= site_url() ?>pesanan/get_produk/"+$(this).val(), function(data, status){
        var jsonData = $.parseJSON(data);
        var option = '<option value="" disabled selected>--- Pilih Produk ---</option>';
        if(status == 'success') {
        for(i=0; i<jsonData.length; i++){
      var data = `${jsonData[i].nama_produk}`
          option += `<option value="${jsonData[i].kode_produk}">${data}</option>`
        }
        $("#kode_produk0").html(option);
        } else { alert('Something wrong!') }
      });
    });

$(document).ready(function() {
	let row_number = 1;
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
