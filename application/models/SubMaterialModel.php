<?php
defined('BASEPATH') or exit('No direct script access allowed');

class SubMaterialModel extends CI_Model
{

	public function GetSubMaterialProduk($where=array())
	{
		$this->db->select('*, sub_material.*, sub_material.harga as harga_sub_material, produk.nama_produk as nama_produk');
		// $this->db->select('*');
		$this->db->from('sub_material_produk');
		$this->db->join('sub_material', 'sub_material.id = sub_material_produk.id_submaterial', 'left');
		$this->db->join('produk', 'produk.kode_produk = sub_material_produk.kode_produk', 'left');
		if(count($where) > 0) $this->db->where($where);
		return $this->db->get();
	}

	public function tambah_master()
	{
		$data = [
			'nama_submaterial' => $this->input->post('nama_submaterial', true),
			'harga' => $this->input->post('harga', true),
		];
		$this->db->insert('sub_material', $data);
	}

	public function tambah()
	{
		$data = [
			'kode_produk' => $this->input->post('kode_produk', true),
			'id_submaterial' => $this->input->post('id_submaterial', true),
			'pemakaian' => $this->input->post('pemakaian', true),
			// 'harga_sub_material' => $this->input->post('harga_sub_material', true),
			'harga_per_produk' => $this->input->post('harga_per_produk', true),
		];
		$this->db->insert('sub_material_produk', $data);
	}

	public function edit($id, $produkId)
	{
		$dataSubMaterial = [
			'nama_submaterial' => $this->input->post('sub_material', true),
			'harga' => $this->input->post('harga_sub_material', true)
		];
		$dataSubMaterialProduk = [
			//'kode_produk' => $this->input->post('kode_produk', true),
			'id_submaterial' => $this->input->post('id_submaterial', true),
			'pemakaian' => $this->input->post('pemakaian', true),
			'harga_per_produk' => $this->input->post('harga_per_produk', true),
		];
		/*$this->db->where('id', $id);
		$this->db->update('sub_material', $dataSubMaterial);*/
		$this->db->where(array('id_submaterial' => $id, 'kode_produk' => $produkId));
		$this->db->update('sub_material_produk', $dataSubMaterialProduk);
	}
}
