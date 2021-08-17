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
          <input type="text" name="kode_produk" class="form-control form-control-sm" id="kode_produk" value="<?php echo "PROD-".sprintf("%03s", $kode_produk) ?>" readonly>
        </div>
        <div class="form-group">
          <label for="kode_customer">Customer</label>
          <select name="kode_customer" class="form-control" id="kode_customer">
            <option value="" disabled selected>--- Pilih Customer ---</option>
            <?php foreach ($customer as $c) { ?>
              <option value="<?php echo $c->kode_customer ?>"> <?php echo $c->nama_customer ?> </option>
            <?php } ?>
          </select>
        </div>
        <div class="form-group">
          <label for="kode_grup">Kode Grup</label>
          <input type="text" name="kode_grup" class="form-control form-control-sm" id="kode_grup" value="<?php echo set_value('kode_grup') ?>" required>
          <?php echo form_error('kode_grup', '<span class="text-danger small pl-3">', '</span>'); ?>
        </div>
        <!--<div class="form-group">
          <label for="kode_customer">Customer</label>
          <select name="kode_customer" class="form-control" id="kode_customer">
            <option value="" disabled selected>--- Pilih Customer ---</option>
            <?php foreach ($customer as $c) { ?>
              <option value="<?php echo $c->kode_customer ?>"> <?php echo $c->nama_customer ?> </option>
            <?php } ?>
          </select>
        </div>-->
        <div class="form-group">
          <label for="nama_produk">Nama Produk</label>
          <input type="text" name="nama_produk" class="form-control form-control-sm" id="nama_produk" value="<?php echo set_value('nama_produk') ?>" required>
          <?php echo form_error('nama_produk', '<span class="text-danger small pl-3">', '</span>'); ?>
        </div>
        <!--<div class="form-group">
          <label for="cavity">Cavity</label>
          <input type="number" min="0" name="cavity" class="form-control form-control-sm" id="cavity" value="<?php echo set_value('cavity') ?>" required>
          <?php echo form_error('cavity', '<span class="text-danger small pl-3">', '</span>'); ?>
        </div>-->
        <!-- <div class="form-group">
          <label for="proses">Proses</label> <br />
          <?php foreach ($proses as $p) { ?>
            <input type="checkbox" name="proses[]" value="<?php echo $p->nama_proses ?>"> <?php echo $p->nama_proses ?>
          <?php } ?>
          <?php echo form_error('proses[]', '<span class="text-danger small pl-3">', '</span>'); ?>
        </div> -->
        
		<table class="table table-bordered table-sm" id="material_detail_table">
		  <thead style="text-align:center">
			<tr style="background: #F8F8FF">
				<th width="333px" scope="col">Material</th>
				<th width="333px" scope="col">Tebal</th>
				<th width="333px" scope="col">Lebar</th>
				<th width="333px" scope="col">Panjang</th>
				<th width="333px" scope="col">Berat</th>
				<th width="333px" scope="col">Jumlah/Sheet</th>
				<th width="333px" scope="col">Berat/Pcs</th>
				<th width="333px" scope="col">Harga</th>
				<th width="333px" scope="col">Harga/Pcs</th>
			  <!--<th scope="col" colspan="2"><img src="{{ asset('icon/Actions.png') }}" width="16" height="16"></th>-->
			</tr>
		  </thead>
		  <tbody style="text-align:center">
			<tr id="material_detail0" class="material_cloned-row">
			  <td>
				  <!-- <input type="text" name="material[]" class="form-control" id="material0" required> -->
				  <select name="material[]" class="form-control" id="material0" required>
					<option value="" disabled selected>--- Pilih Material ---</option>
					<?php foreach ($material as $mat) { ?>
					  <option value="<?php echo $mat->id ?>"> <?php echo $mat->jenis_material. ' - ' .floatval($mat->tebal). ' x ' .$mat->lebar. ' x ' .$mat->panjang?> </option>
					<?php } ?>
				</select>
			  </td>
			  <td>
				  <input type="number" min="0" lang="en" step="0.001" name="tebal[]" class="form-control" id="tebal0" value="<?php echo set_value('tebal')?>" required onkeyup="calculate_material(this)" onmouseup="calculate_material(this)">
			  </td>
			  <td>
				  <input type="number" min="0" lang="en" step="0.001" name="lebar[]" class="form-control" id="lebar0" value="<?php echo set_value('lebar')?>" required onkeyup="calculate_material(this)" onmouseup="calculate_material(this)">
			  </td>
			  <td>
				  <input type="number" min="0" lang="en" step="0.001" name="panjang[]" class="form-control" id="panjang0" value="<?php echo set_value('panjang')?>" required onkeyup="calculate_material(this)" onmouseup="calculate_material(this)">
			  </td>
			  <td>
				  <input type="number" min="0" lang="en" step="0.001" name="berat[]" readonly class="form-control calc_material" id="berat0" required>
			  </td>
			  <td>
				  <input type="number" min="1" name="jumlah_sheet[]" class="form-control calc_material" id="jumlah_sheet0" required onkeyup="calculate_material(this)" onmouseup="calculate_material(this)">
			  </td>
			  <td>
				  <input type="number" min="0" lang="en" step="0.001" name="berat_pcs[]" readonly class="form-control" id="berat_pcs0" required>
			  </td>
			  <td>
				  <input type="number" min="1" name="harga[]" readonly class="form-control calc_material" id="harga0" value="<?php echo set_value('harga') ?>" required onkeyup="calculate_material(this)" onmouseup="calculate_material(this)">
			  </td>
			  <td>
				  <input type="number" min="1" name="harga_pcs[]" readonly class="form-control" id="harga_pcs0" required>
			  </td>
			</tr>
			<tr id="material_detail1" class="material_cloned-row">
		  </tbody>
		</table>
		<!-- <div class="row">
			<div class="col-md-12">
				<button id="material_add_row" class="btn btn-success pull-left">+ Add Material</button>
				<button id='material_delete_row' class="pull-right btn btn-danger">- Delete Material</button>
			</div>
		</div> -->
		<br />
		<table class="table table-bordered table-sm" id="submaterial_detail_table">
		  <thead style="text-align:center">
			<tr style="background: #F8F8FF">
				<th width="333px" scope="col">Sub Material</th>
				<th width="333px" scope="col">Pemakaian</th>
				<th width="333px" scope="col">Harga Sub Material</th>
				<th width="333px" scope="col">Harga/Pcs</th>
			  <!--<th scope="col" colspan="2"><img src="{{ asset('icon/Actions.png') }}" width="16" height="16"></th>-->
			</tr>
		  </thead>
		  <tbody style="text-align:center">
			<tr id="submaterial_detail0" class="submaterial_cloned-row">
			  <td>
				  <input type="text" name="sub_material[]" class="form-control" id="sub_material0">
			  </td>
			  <td>
				  <input type="number" min="0" lang="en" step="0.001" name="pemakaian[]" class="form-control calc_submaterial" id="pemakaian0" onkeyup="calculate_submaterial(this)" onmouseup="calculate_submaterial(this)">
			  </td>
			  <td>
				  <input type="number" min="1" name="submaterial_harga[]" class="form-control calc_submaterial" id="submaterial_harga0" onkeyup="calculate_submaterial(this)" onmouseup="calculate_submaterial(this)">
			  </td>
			  <td>
				  <input type="number" min="0" name="submaterial_harga_pcs[]" readonly class="form-control" id="submaterial_harga_pcs0">
			  </td>
			</tr>
			<tr id="submaterial_detail1" class="submaterial_cloned-row">
		  </tbody>
		</table>
		<div class="row">
			<div class="col-md-12">
				<button id="submaterial_add_row" class="btn btn-success pull-left">+ Add Sub</button>
				<button id='submaterial_delete_row' class="pull-right btn btn-danger">- Delete Sub</button>
			</div>
		</div>
		<br />		
		<table class="table table-bordered table-sm" id="proses_detail_table">
		  <thead style="text-align:center">
			<tr style="background: #F8F8FF">
				<th width="333px" scope="col">Proses</th>
				<th width="333px" scope="col">Mesin</th>
				<!-- <th width="333px" scope="col">Std Dies Height</th> -->
				<th width="333px" scope="col">Harga Dies</th>
				<th width="333px" scope="col">Harga Proses</th>
				<th width="333px" scope="col">Harga/Pcs</th>
			  <!--<th scope="col" colspan="2"><img src="{{ asset('icon/Actions.png') }}" width="16" height="16"></th>-->
			</tr>
		  </thead>
		  <tbody style="text-align:center">
			<tr id="proses_detail0" class="proses_cloned-row">
			  <td>
				  <input type="text" name="proses[]" class="form-control" id="proses0" required>
			  </td>
			  <td>
				<select name="mesin[]" class="form-control" id="mesin0" onchange="calculate_proses(this)" required>
					<option value="" disabled selected>--- Pilih Mesin ---</option>
					<?php foreach ($mesin as $m) { ?>
					  <option value="<?php echo $m->kode_mesin ?>"> <?php echo $m->nama_mesin. ' - ' .floatval($m->kekuatan). ' ' .$m->satuan ?> </option>
					<?php } ?>
				</select>
			  </td>
			  <!-- <td>
				  <input type="number" lang="en" step="0.01" name="std_dies_height[]" class="form-control calc_proses" id="std_dies_height0">
			  </td> -->
			  <td>
				  <input type="number" min="1" name="harga_dies[]" class="form-control calc_proses" id="harga_dies0" required>
			  </td>
			  <td>
				  <input type="number" lang="en" step="0.01" name="proses_harga[]" class="form-control" id="proses_harga0" required onkeyup="calculate_proses(this)" onmouseup="calculate_proses(this)">
			  </td>
			  <td>
				  <input type="number" lang="en" step="0.01" name="proses_harga_pcs[]" readonly class="form-control" id="proses_harga_pcs0" required>
			  </td>
			</tr>
			<tr id="proses_detail1" class="proses_cloned-row">
		  </tbody>
		</table>
		<div class="row">
			<div class="col-md-12">
				<button id="proses_add_row" class="btn btn-success pull-left">+ Add Proses</button>
				<button id='proses_delete_row' class="pull-right btn btn-danger">- Delete Proses</button>
			</div>
		</div>
        <button type="submit" class="btn btn-primary btn-sm float-right"><i class="fas fa-save"></i> Simpan</button>
      </form>
    </div>
  </div>
</div>

<script>
	$("#kode_customer").change(function(){  
	    $.get("<?= site_url() ?>produk/get_customer/"+$(this).val(), function(data, status){
	      var jsonData = $.parseJSON(data);
	      var option = '<option value="" disabled selected>--- Pilih Material ---</option>';
	      if(status == 'success') {
	      for(i=0; i<jsonData.length; i++){
	        option += `<option value="${jsonData[i].id}">${jsonData[i].material}</option>`
	      }
	      $("#id").html(option);
	      } else { alert('Something wrong!') }
	    });
  	});
  
	$("#id").change(function(){
    const kodeCustomer = $("#kode_customer").val()
    const materialId = $("#id").val()
	  $.get("<?= site_url() ?>produk/get_customerV2/"+kodeCustomer+"/"+materialId, function(data, status){
		  var jsonData = $.parseJSON(data);
		  var optionMaterial = '<option value="" disabled selected>--- Pilih Material ---</option>';
		  var tebalMaterial = 'readonly';
		  if(status == 'success') {
			// for(i=0; i<jsonData.length; i++){
			// 	optionProduk += `<option value="${jsonData[i].kode_produk}">${jsonData[i].produk}</option>`
			// 	optionCustomer += `<option value="${jsonData[i].kode_customer}">${jsonData[i].customer}</option>`
			// }
			// $("#kode_produk").html(optionProduk);
			$("#kode_customer").val(jsonData[0].kode_customer);
			/*$(".select option").val(function(idx, val) {
			  $(this).siblings('[value="'+ val +'"]').remove();
			});*/
			var map = {};
			$('.select option').each(function () {
				if (map[this.value]) {
					$(this).remove()
				}
				map[this.value] = true;
			})
		  } else { alert('Something wrong!') }
	  });
	  $.get("<?= site_url() ?>produk/get_harga/"+materialId, function(data, status){
		  var jsonData = $.parseJSON(data);
		  if(status == 'success') {
				$("#tebal").val(jsonData.tebal);
		  } else { alert('Something wrong!') }
	  });
	});

	$("input").keyup(function(){
		$("#tebal");
	});

	function calculate_material(arg){
		var $tr = $(arg).closest('tr').attr('id'); // get tr which contains the input
		var tebal = Number($("input[id^='tebal']", 'tr#'+$tr+'.material_cloned-row').val()) || 1;
		var lebar = Number($("input[id^='lebar']", 'tr#'+$tr+'.material_cloned-row').val()) || 1;
		var panjang = Number($("input[id^='panjang']", 'tr#'+$tr+'.material_cloned-row').val()) || 1;
		var berat = Number($("input[id^='berat']", 'tr#'+$tr+'.material_cloned-row').val()) || 1;
		var jumlah = Number($("input[id^='jumlah_sheet']", 'tr#'+$tr+'.material_cloned-row').val()) || 1;

		var id = arg.getAttribute('id');
		//var value = arg.value;
		//console.log(parseFloat(berat / jumlah).toFixed(2));
		$("input[id^='berat']", 'tr#'+$tr+'.material_cloned-row').val(parseFloat((tebal * lebar * panjang * 7.85) / 1000000).toFixed(2));
		$("input[id^='berat_pcs']", 'tr#'+$tr+'.material_cloned-row').val(parseFloat(berat / jumlah).toFixed(2));
		if (id.toLowerCase().indexOf("harga") >= 0){
			$("input[id^='harga_pcs']", 'tr#'+$tr+'.material_cloned-row').val(parseFloat(Number($("input[id^='berat_pcs']", 'tr#'+$tr+'.material_cloned-row').val()) * Number($("input[id^='harga']", 'tr#'+$tr+'.material_cloned-row').val())).toFixed(2));
		}
		//total(arg);
	}

	function calculate_submaterial(arg){
		var $tr = $(arg).closest('tr').attr('id'); // get tr which contains the input
		var pemakaian = Number($("input[id^='pemakaian']", 'tr#'+$tr+'.submaterial_cloned-row').val()) || 1;
		var harga = Number($("input[id^='submaterial_harga']", 'tr#'+$tr+'.submaterial_cloned-row').val()) || 1;

		var id = arg.getAttribute('id');
		console.log(id);
		var value = arg.value;
		//console.log(parseFloat(berat / jumlah).toFixed(2));
		$("input[id^='submaterial_harga_pcs']", 'tr#'+$tr+'.submaterial_cloned-row').val(parseFloat(pemakaian * harga).toFixed(2));
		//total(arg);
	}
	
	function calculate_proses(arg){
		var $tr = $(arg).closest('tr').attr('id'); // get tr which contains the input
		/*var std_dies = Number($("input[id^='std_dies_height']", 'tr#'+$tr+'.proses_cloned-row').val()) || 1;
		var harga_dies = Number($("input[id^='harga_dies']", 'tr#'+$tr+'.proses_cloned-row').val()) || 1;

		var id = arg.getAttribute('id');
		console.log(id);
		var value = arg.value;
		$("input[id^='proses_harga_pcs']", 'tr#'+$tr+'.proses_cloned-row').val(parseFloat(std_dies * harga_dies).toFixed(2));*/
		//total(arg);
		//var $tr = $(arg).closest('tr').attr('id'); // get tr which contains the input
		//var txt = (arg.options[arg.selectedIndex].text);
		var kekuatan_msn = parseFloat($("select[id^='mesin'] option:selected", 'tr#'+$tr+'.proses_cloned-row').text().split("-").pop().split(" ")[1]) || 0;
		var proses_harga = Number($("input[id^='proses_harga']", 'tr#'+$tr+'.proses_cloned-row').val()) || 1;
		/*txt = txt.split("-").pop();
		kekuatan = Number(txt.split(" ")[1]) || 1;*/
		//console.log(parseFloat(kekuatan * proses_harga).toFixed(2));
		$("input[id^='proses_harga_pcs']", 'tr#'+$tr+'.proses_cloned-row').val(parseFloat(kekuatan_msn * proses_harga).toFixed(2));
	}

	/*function total(arg) {
		var nominal = Number($("#proses_harga_pcs").val()) || 1;
		var sum = 0;
		var tot = 0;

		$.each($(".total"), function() {
			sum = sum + Number($(this).val());
		});

		tot = Number(nominal - sum);
		
		$("#proses_harga_pcs").val(sum);
		$("#proses_harga_pcs").val(tot);
		
		if(sum > nominal) {
			alert('transaction cant more than nominals');
			$(arg).val('');
			//$('#reimbursement_total_nom_transaksi').val('');
			//$('#reimbursement_nom_pengembalian').val('');
		}
	}*/
$(document).ready(function() {
	let material_row_number = 1;
	let submaterial_row_number = 1;
	let proses_row_number = 1;

    if(material_row_number <= 1) $("#material_delete_row").prop('disabled', true);
    if(submaterial_row_number <= 1) $("#submaterial_delete_row").prop('disabled', true);
    if(proses_row_number <= 1) $("#proses_delete_row").prop('disabled', true);

    $("#material_add_row").click(function(e){
    //$('material_add_row').on('click.myNamespace', function(ev) {
      e.preventDefault();
      let new_row_number = material_row_number - 1;
      /*var events = $("#berat"+new_row_number).data('events');
      console.dir($._data($(ev.target), 'events')); // undefined -- Why?
      console.dir(jQuery._data("#berat"+new_row_number, "events"));*/
	  //$('#material_detail' + new_row_number).clone(true).insertAfter('#material_detail' + material_row_number);
      $('#material_detail' + material_row_number).html($('#material_detail' + new_row_number).html()).find('td:first-child');
      $('#material_detail_table').append('<tr id="material_detail' + (material_row_number + 1) + '" class=material_cloned-row></tr>');
      $("#material"+new_row_number, 'tr#material_detail'+material_row_number+'.material_cloned-row').attr('id', 'material'+material_row_number);
      $("#tebal"+new_row_number, 'tr#material_detail'+material_row_number+'.material_cloned-row').attr('id', 'tebal'+material_row_number);
      $("#lebar"+new_row_number, 'tr#material_detail'+material_row_number+'.material_cloned-row').attr('id', 'lebar'+material_row_number);
      $("#panjang"+new_row_number, 'tr#material_detail'+material_row_number+'.material_cloned-row').attr('id', 'panjang'+material_row_number);
      $("#berat"+new_row_number, 'tr#material_detail'+material_row_number+'.material_cloned-row').attr('id', 'berat'+material_row_number);
      $("#jumlah_sheet"+new_row_number, 'tr#material_detail'+material_row_number+'.material_cloned-row').attr('id', 'jumlah_sheet'+material_row_number);
      $("#berat_pcs"+new_row_number, 'tr#material_detail'+material_row_number+'.material_cloned-row').attr('id', 'berat_pcs'+material_row_number);
      $("#harga"+new_row_number, 'tr#material_detail'+material_row_number+'.material_cloned-row').attr('id', 'harga'+material_row_number);
      $("#harga_pcs"+new_row_number, 'tr#material_detail'+material_row_number+'.material_cloned-row').attr('id', 'harga_pcs'+material_row_number);
      
      
		/*$(".calc_material").bind('keyup mouseup', function () {
			calculate_material(this);
		});*/

      /*$.each($("#berat"+new_row_number).data('events'), function() {
		  // iterate registered handler of original
		 $.each(this, function() {
			$("#berat"+material_row_number).bind(this.type, this.handler);
		 });
	  });*/
	  /*var events = $("#berat"+new_row_number).data('events');
		var $other_link = $("#berat"+material_row_number);
		if ( events ) {
			for ( var eventType in events ) {
				for ( var idx in events[eventType] ) {
					// this will essentially do $other_link.click( fn ) for each bound event
					$other_link[ eventType ]( events[eventType][idx].handler );
				}
			}
		}*/

      material_row_number++;
      if(material_row_number > 1) {
		$("#material_delete_row").prop('disabled', false);
	  }
    });

    $("#material_delete_row").click(function(e){
      e.preventDefault();
      if(material_row_number > 1) {
        $("#material_detail" + (material_row_number - 1)).html('');
        material_row_number--;
        if(material_row_number <= 1) {
			$("#material_delete_row").prop('disabled', true);
		}
      }
    });

    $("#submaterial_add_row").click(function(e){
      e.preventDefault();
      let new_row_number = submaterial_row_number - 1;

      $('#submaterial_detail' + submaterial_row_number).html($('#submaterial_detail' + new_row_number).html()).find('td:first-child');
      $('#submaterial_detail_table').append('<tr id="submaterial_detail' + (submaterial_row_number + 1) + '" class=submaterial_cloned-row></tr>');
      $("#sub_material"+new_row_number, 'tr#submaterial_detail'+submaterial_row_number+'.submaterial_cloned-row').attr('id', 'sub_material'+submaterial_row_number);
      $("#pemakaian"+new_row_number, 'tr#submaterial_detail'+submaterial_row_number+'.submaterial_cloned-row').attr('id', 'pemakaian'+submaterial_row_number);
      $("#submaterial_harga"+new_row_number, 'tr#submaterial_detail'+submaterial_row_number+'.submaterial_cloned-row').attr('id', 'submaterial_harga'+submaterial_row_number);
      $("#submaterial_harga_pcs"+new_row_number, 'tr#submaterial_detail'+submaterial_row_number+'.submaterial_cloned-row').attr('id', 'submaterial_harga_pcs'+submaterial_row_number);

      submaterial_row_number++;
      if(submaterial_row_number > 1) {
		$("#submaterial_delete_row").prop('disabled', false);
	  }
    });

    $("#submaterial_delete_row").click(function(e){
      e.preventDefault();
      if(submaterial_row_number > 1) {
        $("#submaterial_detail" + (submaterial_row_number - 1)).html('');
        submaterial_row_number--;
        if(submaterial_row_number <= 1) {
			$("#submaterial_delete_row").prop('disabled', true);
		}
      }
    });
    
    $("#proses_add_row").click(function(e){
      e.preventDefault();
      let new_row_number = proses_row_number - 1;

      $('#proses_detail' + proses_row_number).html($('#proses_detail' + new_row_number).html()).find('td:first-child');
      $('#proses_detail_table').append('<tr id="proses_detail' + (proses_row_number + 1) + '" class=proses_cloned-row></tr>');
      $("#proses"+new_row_number, 'tr#proses_detail'+proses_row_number+'.proses_cloned-row').attr('id', 'proses'+proses_row_number);
      $("#mesin"+new_row_number, 'tr#proses_detail'+proses_row_number+'.proses_cloned-row').attr('id', 'mesin'+proses_row_number);
      $("#std_dies_height"+new_row_number, 'tr#proses_detail'+proses_row_number+'.proses_cloned-row').attr('id', 'std_dies_height'+proses_row_number);
      $("#harga_dies"+new_row_number, 'tr#proses_detail'+proses_row_number+'.proses_cloned-row').attr('id', 'harga_dies'+proses_row_number);
      $("#proses_harga"+new_row_number, 'tr#proses_detail'+proses_row_number+'.proses_cloned-row').attr('id', 'proses_harga'+proses_row_number);
      $("#proses_harga_pcs"+new_row_number, 'tr#proses_detail'+proses_row_number+'.proses_cloned-row').attr('id', 'proses_harga_pcs'+proses_row_number);

      proses_row_number++;
      if(proses_row_number > 1) {
		$("#proses_delete_row").prop('disabled', false);
	  }
    });

    $("#proses_delete_row").click(function(e){
      e.preventDefault();
      if(proses_row_number > 1) {
        $("#proses_detail" + (proses_row_number - 1)).html('');
        proses_row_number--;
        if(proses_row_number <= 1) {
			$("#proses_delete_row").prop('disabled', true);
		}
      }
    });

});

	/*$(".calc_material").bind('keyup mouseup', function () {
		calculate_material(this);
	});

    $(".calc_submaterial").bind('keyup mouseup', function () {
		calculate_submaterial(this);
	});

    $(".calc_proses").bind('keyup mouseup', function () {
		calculate_proses(this);
	});*/

</script>
