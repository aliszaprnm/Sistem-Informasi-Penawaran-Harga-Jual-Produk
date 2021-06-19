<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ProsesModel extends CI_Model
{

	public function GetProsesProduk()
	{
		$this->db->select('*, produk.nama_produk as nama_produk, mesin.nama_mesin as nama_mesin, mesin.kekuatan as kekuatan, mesin.satuan as satuan');
		// $this->db->select('*');
		$this->db->from('proses_produk');
		$this->db->join('produk', 'produk.kode_produk = proses_produk.kode_produk', 'left');
		$this->db->join('mesin', 'mesin.kode_mesin = proses_produk.kode_mesin', 'left');
		return $this->db->get();
	}

	public function tambah()
	{
		// $proses = implode(', ', $this->input->post('proses'));
		$data = [
			'kode_produk' => $this->input->post('kode_produk', true),
			'nama_proses' => $this->input->post('nama_proses', true),
			'kode_mesin' => $this->input->post('kode_mesin', true),
			'std_dies_height' => $this->input->post('std_dies_height', true),
			'harga_dies' => $this->input->post('harga_dies', true),
			'harga_proses' => $this->input->post('harga_proses', true),
			'harga_per_produk' => $this->input->post('harga_per_produk', true),
		];
		$this->db->insert('proses_produk', $data);
	}

	public function edit($id)
	{
		// $proses = implode(', ', $this->input->post('proses'));
		$data = [
			'kode_produk' => $this->input->post('kode_produk', true),
			'nama_proses' => $this->input->post('nama_proses', true),
			'kode_mesin' => $this->input->post('kode_mesin', true),
			'std_dies_height' => $this->input->post('std_dies_height', true),
			'harga_dies' => $this->input->post('harga_dies', true),
			'harga_proses' => $this->input->post('harga_proses', true),
			'harga_per_produk' => $this->input->post('harga_per_produk', true)
		];
		$this->db->where('id', $id);
		$this->db->update('proses_produk', $data);
	}
}
