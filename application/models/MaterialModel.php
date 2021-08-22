<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MaterialModel extends CI_Model
{

	public function GetMaterialProduk()
	{
		// $this->db->select('*, produk.*, produk.nama_produk as nama_produk, material.*, customer.*, customer.nama_customer as nama_customer');
		// $this->db->from('material_produk');
		// $this->db->join('produk', 'produk.kode_produk = material_produk.kode_produk', 'left');
		// $this->db->join('material', 'material.id = material_produk.id_material', 'left');
		// $this->db->join('customer', 'customer.kode_customer = material.kode_customer', 'left');
		// return $this->db->get();
		$this->db->select('material_produk.*, customer.nama_customer as nama_customer, produk.nama_produk as nama_produk, material.*');
	 	$this->db->from('material_produk');
	 	$this->db->join('material', 'material_produk.id_material = material.id', 'left');
	 	$this->db->join('customer', 'customer.kode_customer = material.kode_customer', 'left');
		$this->db->join('produk', 'produk.kode_produk = material_produk.kode_produk', 'left');
		return $this->db->get();
	}

	public function tambah_master()
	{
		$data = [
			'kode_customer' => $this->input->post('kode_customer', true),
			'jenis_material' => $this->input->post('jenis_material', true),
			'tebal' => $this->input->post('tebal', true),
			'lebar' => $this->input->post('lebar', true),
			'panjang' => $this->input->post('panjang', true),
			// 'berat_material' => $this->input->post('berat_material', true),
			// 'jml_per_sheet' => $this->input->post('jml_per_sheet', true),
			// 'berat_produk' => $this->input->post('berat_produk', true),
			'harga' => $this->input->post('harga', true),
			// 'harga_per_produk' => $this->input->post('harga_per_produk', true),
		];
		$this->db->insert('material', $data);
	}

	public function tambah()
	{
		$data = [
			'kode_produk' => $this->input->post('kode_produk', true),
			'id_material' => $this->input->post('id_material', true),
			// 'tebal_material' => $this->input->post('tebal_material', true),
			// 'lebar_material' => $this->input->post('lebar_material', true),
			// 'panjang_material' => $this->input->post('panjang_material', true),
			'berat_material' => $this->input->post('berat_material', true),
			'jml_per_sheet' => $this->input->post('jml_per_sheet', true),
			'berat_produk' => $this->input->post('berat_produk', true),
			// 'harga_material' => $this->input->post('harga_material', true),
			'harga_per_produk' => $this->input->post('harga_per_produk', true),
		];
		$this->db->insert('material_produk', $data);
	}

	// ada yg brubah
	public function edit($id)
	{
		$data = [
			'kode_produk' => $this->input->post('kode_produk', true),
			'id_material' => $this->input->post('id_material', true),
			'berat_material' => $this->input->post('berat_material', true),
			'jml_per_sheet' => $this->input->post('jml_per_sheet', true),
			'berat_produk' => $this->input->post('berat_produk', true),
			'harga_per_produk' => $this->input->post('harga_per_produk', true),
		];
		$this->db->where('id', $id);
		$this->db->update('material_produk', $data);
	}
}
