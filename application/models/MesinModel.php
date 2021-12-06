<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MesinModel extends CI_Model {

	public function GetKodeMesin()
	{
		$this->db->select('MAX(kode_mesin) as IDM');
		$this->db->from('mesin');
		return $this->db->get();
	}

	public function GetDataMesin($kode_mesin)
	{
		$this->db->select('kode_mesin, nama_mesin, kekuatan');
		$this->db->from('mesin');
		$this->db->where('kode_mesin', $kode_mesin);
		return $this->db->get();
	}

	public function tambah()
	{
		$data = [
			'kode_mesin' => $this->input->post('kode_mesin', true),
			'nama_mesin' => $this->input->post('nama_mesin', true),
			'kekuatan' => $this->input->post('kekuatan', true),
			'vol_prod' => $this->input->post('vol_prod', true),
			'harga_dies' => $this->input->post('harga_dies', true),
			'depresiasi_dies' => $this->input->post('depresiasi_dies', true)
		];
		$this->db->insert('mesin', $data);
	}

	public function edit($kode_mesin)
	{
		$data = [
			'kode_mesin' => $this->input->post('kode_mesin', true),
			'nama_mesin' => $this->input->post('nama_mesin', true),
			'kekuatan' => $this->input->post('kekuatan', true),
			'vol_prod' => $this->input->post('vol_prod', true),
			'harga_dies' => $this->input->post('harga_dies', true),
			'depresiasi_dies' => $this->input->post('depresiasi_dies', true)
		];
		
		$this->db->where('kode_mesin', $kode_mesin);
		$this->db->update('mesin', $data);
	}

}