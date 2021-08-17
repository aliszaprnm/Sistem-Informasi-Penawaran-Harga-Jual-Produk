<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ProdukModel extends CI_Model
{

	public function GetProduk()
	{
		$this->db->select('*');
		// $this->db->select('*');
		$this->db->from('produk');
		//$this->db->join('customer', 'customer.kode_customer = produk.kode_customer', 'left');
		return $this->db->get();
	}

	public function GetKodeProduk()
	{
		$this->db->select('MAX(kode_produk) as IDP');
		$this->db->from('produk');
		return $this->db->get();
	}

	public function GetHargaMaterial($material)
	{
	 	$this->db->select('harga'
						);
	 	$this->db->from('material');
	 	$this->db->where('id',$material);
	 	return $this->db->get()->row();
	}

	public function tambah()
	{
		$arg = $this->input->post();

		$this->db->select('MIN(id) as uid');
		$this->db->from('user');
		$this->db->where('level','Administrator');
		$toUser = $this->db->get();

		$data = [
			'kode_produk' => $this->input->post('kode_produk', true),
			'kode_grup' => $this->input->post('kode_grup', true),
			'nama_produk' => $this->input->post('nama_produk', true),
			//'cavity' => $this->input->post('cavity', true),
			//'status' => 'Used',
			'mod_by' => $this->session->userdata('userid'),
			'mod_date' => date('Y-m-d H:i:s')
		];
		$this->db->insert('produk', $data);
		//$headerId = $this->db->insert_id();
		$headerId = $data['kode_produk'];

        $material = ($arg['material']) ? $arg['material'] : null;
		for ($i=0; $i < count($material); $i++) {
			if ($material[$i] != '') {
				$detil_material[$i]['kode_produk'] = $headerId;
				$detil_material[$i]['jenis_material'] = $arg['jenis_material'][$i];
				$detil_material[$i]['tebal_material'] = $arg['tebal'][$i];
				$detil_material[$i]['lebar_material'] = $arg['lebar'][$i];
				$detil_material[$i]['panjang_material'] = $arg['panjang'][$i];
				$detil_material[$i]['berat_material'] = $arg['berat'][$i];
				$detil_material[$i]['jml_per_sheet'] = $arg['jumlah_sheet'][$i];
				$detil_material[$i]['berat_produk'] = $arg['berat_pcs'][$i];
				$detil_material[$i]['harga_material'] = $arg['harga'][$i];
				$detil_material[$i]['harga_per_produk'] = $arg['harga_pcs'][$i];
			}
		}

        $material_sub = ($arg['sub_material']) ? $arg['sub_material'] : null;
		for ($i=0; $i < count($material_sub); $i++) {
			if ($material_sub[$i] != '') {
				$detil_material_sub[$i]['kode_produk'] = $headerId;
				$detil_material_sub[$i]['sub_material'] = $arg['sub_material'][$i];
				$detil_material_sub[$i]['pemakaian'] = $arg['pemakaian'][$i];
				$detil_material_sub[$i]['harga_sub_material'] = $arg['submaterial_harga'][$i];
				$detil_material_sub[$i]['harga_per_produk'] = $arg['submaterial_harga_pcs'][$i];
			}
		}
		
		$proses_produk = ($arg['proses']) ? $arg['proses'] : null;
		for ($i=0; $i < count($proses_produk); $i++) {
			if ($proses_produk[$i] != '') {
				$detil_proses_produk[$i]['kode_produk'] = $headerId;
				$detil_proses_produk[$i]['nama_proses'] = $arg['proses'][$i];
				$detil_proses_produk[$i]['kode_mesin'] = $arg['mesin'][$i];
				// $detil_proses_produk[$i]['std_dies_height'] = ($arg['std_dies_height'][$i]) ? $arg['std_dies_height'][$i] : null;
				$detil_proses_produk[$i]['harga_dies'] = ($arg['harga_dies'][$i]) ? $arg['harga_dies'][$i] : null;
				$detil_proses_produk[$i]['harga_proses'] = $arg['proses_harga'][$i];
				$detil_proses_produk[$i]['harga_per_produk'] = $arg['proses_harga_pcs'][$i];
			}
		}

		$this->db->insert_batch('material_produk', $detil_material);
		if(count($material_sub) > 0 && isset($detil_material_sub)) { $this->db->insert_batch('sub_material_produk', $detil_material_sub); }
		$this->db->insert_batch('proses_produk', $detil_proses_produk);
		
		//return $this->db->where('id', $id)->update('pesanan', $data['header']);
	}

	public function edit($kode_produk)
	{
		$data = [
			//'kode_produk' => $this->input->post('kode_produk', true),
			'kode_grup' => $this->input->post('kode_grup', true),
			'nama_produk' => $this->input->post('nama_produk', true),
			//'cavity' => $this->input->post('cavity', true)
		];
		$this->db->where('kode_produk', $kode_produk);
		$this->db->update('produk', $data);
	}
}
