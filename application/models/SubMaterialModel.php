<?php
defined('BASEPATH') or exit('No direct script access allowed');

class SubMaterialModel extends CI_Model
{

	public function GetSubMaterialProduk()
	{
		$this->db->select('*, produk.nama_produk as nama_produk');
		// $this->db->select('*');
		$this->db->from('sub_material_produk');
		$this->db->join('produk', 'produk.kode_produk = sub_material_produk.kode_produk', 'left');
		return $this->db->get();
	}

	public function tambah()
	{
		$data = [
			'kode_produk' => $this->input->post('kode_produk', true),
			'sub_material' => $this->input->post('sub_material', true),
			'pemakaian' => $this->input->post('pemakaian', true),
			'harga_sub_material' => $this->input->post('harga_sub_material', true),
			'harga_per_produk' => $this->input->post('harga_per_produk', true),
		];
		$this->db->insert('sub_material_produk', $data);
	}

	public function edit($id)
	{
		$data = [
			'kode_produk' => $this->input->post('kode_produk', true),
			'sub_material' => $this->input->post('sub_material', true),
			'pemakaian' => $this->input->post('pemakaian', true),
			'harga_sub_material' => $this->input->post('harga_sub_material', true),
			'harga_per_produk' => $this->input->post('harga_per_produk', true),
		];
		$this->db->where('id', $id);
		$this->db->update('sub_material_produk', $data);
	}
}
