<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ProcessCostModel extends CI_Model
{
	public function GetProcessCost()
	{
		$this->db->select('*, produk.nama_produk as nama_produk, material_produk.harga_per_produk as harga_material, proses_produk.harga_per_produk as harga_proses, sub_material_produk.harga_per_produk as harga_sub_material, customer.jarak as jarak, material_produk.berat_produk, sum(proses_produk.harga_per_produk) as total_harga_proses');
		// $this->db->select('*');
		$this->db->from('process_cost');
		$this->db->join('produk', 'produk.kode_produk = process_cost.kode_produk', 'left');
		$this->db->join('material_produk', 'material_produk.kode_produk = process_cost.kode_produk', 'left');
		$this->db->join('proses_produk', 'proses_produk.kode_produk = process_cost.kode_produk', 'left');
		$this->db->join('sub_material_produk', 'sub_material_produk.kode_produk = process_cost.kode_produk', 'left');
		$this->db->join('customer', 'customer.kode_customer = process_cost.kode_customer', 'left');
		return $this->db->get();
	}

	// public function GetHargaMaterial()
	// {
	// 	$this->db->select('*, produk.nama_produk as nama_produk, mesin.nama_mesin as nama_mesin');
	// 	// $this->db->select('*');
	// 	$this->db->from('proses_produk');
	// 	$this->db->join('produk', 'produk.kode_produk = proses_produk.kode_produk', 'left');
	// 	$this->db->join('mesin', 'mesin.kode_mesin = proses_produk.kode_mesin', 'left');
	// 	return $this->db->get();
	// }

	public function tambah()
	{
		// $proses = implode(', ', $this->input->post('proses'));
		$data = [
			'kode_produk' => $this->input->post('kode_produk', true),
			'kode_grup' => $this->input->post('kode_grup', true),
			'kode_customer' => $this->input->post('kode_customer', true),
			'nama_produk' => $this->input->post('nama_produk', true),
			'cavity' => $this->input->post('cavity', true),
		];
		$this->db->insert('produk', $data);
	}

	public function edit()
	{
		$proses = implode(', ', $this->input->post('proses'));
		$data = [
			'no_part' => $this->input->post('no_part', true),
			'no_group' => $this->input->post('no_group', true),
			'id_customer' => $this->input->post('id_customer', true),
			'nama_part' => $this->input->post('nama_part', true),
			'cavity' => $this->input->post('cavity', true),
			'proses' => $proses,
			'mesin' => $this->input->post('mesin', true),
			'std_dies_height' => $this->input->post('std_dies_height', true),
			'size_material' => $this->input->post('size_material', true),
			'jumlah_per_sheet' => $this->input->post('jumlah_per_sheet', true),
			'berat' => $this->input->post('berat', true)
		];
		$this->db->where('no_part', $this->input->post('no_part'));
		$this->db->update('produk', $data);
	}
}
