<?php
defined('BASEPATH') or exit('No direct script access allowed');

class PesananModel extends CI_Model
{

	public function GetPesanan()
	{
		$this->db->select('*, customer.nama_customer as nama_customer, produk.nama_produk as nama_produk');
		// $this->db->select('*');
		$this->db->from('pesanan');
		$this->db->join('customer', 'customer.kode_customer = pesanan.kode_customer', 'left');
		$this->db->join('produk', 'produk.kode_produk = pesanan.kode_produk', 'left');
		return $this->db->get();
	}

	public function GetKodePesanan()
	{
		$this->db->select('MAX(kode_pesanan) as IDO');
		$this->db->from('pesanan');
		return $this->db->get();
	}

	public function tambah()
	{
		// $proses = implode(', ', $this->input->post('proses'));
		$data = [
			'kode_pesanan' => $this->input->post('kode_pesanan', true),
			'tanggal' => $this->input->post('tanggal', true),
			'kode_customer' => $this->input->post('kode_customer', true),
			'kode_produk' => $this->input->post('kode_produk', true),
			'qty' => $this->input->post('qty', true),
			'keterangan' => $this->input->post('keterangan', true),
		];
		$this->db->insert('pesanan', $data);
	}

	public function edit($id)
	{
		$data = [
			'kode_pesanan' => $this->input->post('kode_pesanan', true),
			'tanggal' => $this->input->post('tanggal', true),
			'kode_customer' => $this->input->post('kode_customer', true),
			'kode_produk' => $this->input->post('kode_produk', true),
			'qty' => $this->input->post('qty', true),
			'keterangan' => $this->input->post('keterangan', true),
		];
		$this->db->where('id', $id);
		$this->db->update('pesanan', $data);
	}
}
