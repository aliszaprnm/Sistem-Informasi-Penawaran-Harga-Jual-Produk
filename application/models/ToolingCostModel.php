<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ToolingCostModel extends CI_Model
{

	public function GetToolingCost()
	{
		$this->db->select('*, produk.nama_produk as nama_produk, sum(proses_produk.harga_dies) as harga_dies');
		// $this->db->select('*');
		$this->db->from('tooling_cost');
		$this->db->join('produk', 'produk.kode_produk = tooling_cost.kode_produk', 'left');
		$this->db->join('proses_produk', 'proses_produk.kode_produk = tooling_cost.kode_produk', 'left');
		return $this->db->get();
	}

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
