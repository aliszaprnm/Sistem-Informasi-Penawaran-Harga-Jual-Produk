<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ToolingCostModel extends CI_Model
{

	public function GetToolingCost()
	{
		$this->db->select('tooling_cost.id, pesanan_id, kode_pesanan, tooling_cost.kode_produk, customer.nama_customer as nama_customer, produk.nama_produk as nama_produk, tooling_cost.*');
		$this->db->from('tooling_cost');
		$this->db->join('pesanan', 'tooling_cost.pesanan_id = pesanan.id', 'left');
	 	$this->db->join('customer', 'customer.kode_customer = pesanan.kode_customer', 'left');
		$this->db->join('produk', 'produk.kode_produk = tooling_cost.kode_produk', 'left');
		return $this->db->get();
	}

	public function tambah()
	{
		$data = [
			'pesanan_id' => $this->input->post('kode_pesanan', true),
			'kode_produk' => $this->input->post('kode_produk', true),
			'harga_dies' => $this->input->post('harga_dies', true),
			'vol_prod' => $this->input->post('vol_prod', true),
			'depresiasi_dies' => $this->input->post('depresiasi_dies', true),
			'total' => $this->input->post('total', true),
		];
		$this->db->insert('tooling_cost', $data);
	}

	public function edit($id)
	{
		$data = [
			//'kode_produk' => $this->input->post('kode_produk', true),
			'harga_dies' => $this->input->post('harga_dies', true),
			'vol_prod' => $this->input->post('vol_prod', true),
			'depresiasi_dies' => $this->input->post('depresiasi_dies', true),
			'total' => $this->input->post('total', true),
		];
		$this->db->where('id', $id);
		$this->db->update('tooling_cost', $data);
	}
}
