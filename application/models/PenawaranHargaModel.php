<?php
defined('BASEPATH') or exit('No direct script access allowed');

class PenawaranHargaModel extends CI_Model
{

	public function GetPenawaranHarga()
	{
		$this->db->select('*, customer.nama_customer as nama_customer, produk.nama_produk as nama_produk, process_cost.total as process_cost, tooling_cost.total as tooling_cost');
		// $this->db->select('*');
		$this->db->from('penawaran_harga');
		$this->db->join('customer', 'customer.kode_customer = penawaran_harga.kode_customer', 'left');
		$this->db->join('produk', 'produk.kode_produk = penawaran_harga.kode_produk', 'left');
		$this->db->join('process_cost', 'process_cost.kode_produk = penawaran_harga.kode_produk', 'left');
		$this->db->join('tooling_cost', 'tooling_cost.kode_produk = penawaran_harga.kode_produk', 'left');
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
