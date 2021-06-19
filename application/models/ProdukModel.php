<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ProdukModel extends CI_Model
{

	public function GetProduk()
	{
		$this->db->select('*, customer.nama_customer as nama_customer');
		// $this->db->select('*');
		$this->db->from('produk');
		$this->db->join('customer', 'customer.kode_customer = produk.kode_customer', 'left');
		return $this->db->get();
	}

	public function GetKodeProduk()
	{
		$this->db->select('MAX(kode_produk) as IDP');
		$this->db->from('produk');
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

	public function edit($kode_produk)
	{
		// $proses = implode(', ', $this->input->post('proses'));
		$data = [
			'kode_produk' => $this->input->post('kode_produk', true),
			'kode_grup' => $this->input->post('kode_grup', true),
			'kode_customer' => $this->input->post('kode_customer', true),
			'nama_produk' => $this->input->post('nama_produk', true),
			'cavity' => $this->input->post('cavity', true),
			// 'proses' => $proses,
		];
		$this->db->where('kode_produk', $kode_produk);
		$this->db->update('produk', $data);
	}
}
