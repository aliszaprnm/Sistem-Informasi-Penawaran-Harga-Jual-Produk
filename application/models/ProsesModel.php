<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ProsesModel extends CI_Model
{

	public function GetProsesProduk()
	{
		$this->db->select('*, produk.kode_produk as kode, produk.nama_produk as nama_produk, mesin.nama_mesin as nama_mesin, mesin.kekuatan as kekuatan, proses.harga as harga_proses');
		// $this->db->select('*');
		$this->db->from('proses_produk');
		$this->db->join('proses', 'proses.id = proses_produk.id_proses', 'left');
		$this->db->join('produk', 'produk.kode_produk = proses_produk.kode_produk', 'left');
		$this->db->join('mesin', 'mesin.kode_mesin = proses_produk.kode_mesin', 'left');
		return $this->db->get();
	}

	public function tambah_master()
	{
		// $proses = implode(', ', $this->input->post('proses'));
		$data = [
			'nama_proses' => $this->input->post('nama_proses', true),
			'harga' => $this->input->post('harga', true),
		];
		$this->db->insert('proses', $data);
	}

	public function tambah($hargaPerProduk)
	{
		// $proses = implode(', ', $this->input->post('proses'));
		$data = [
			'kode_produk' => $this->input->post('kode_produk', true),
			'id_proses' => $this->input->post('id_proses', true),
			'kode_mesin' => $this->input->post('kode_mesin', true),
			'harga_per_produk' => $hargaPerProduk,
		];
		$this->db->insert('proses_produk', $data);
	}

	public function edit($id)
	{
		// $proses = implode(', ', $this->input->post('proses'));
		$kodeMesin = $this->input->post('kode_mesin');
		$hargaProses = $this->input->post('harga_proses');
		$kodeProduk = $this->input->post('kode_produk');
		$dataMesin = $this->MesinModel->getDataMesin($kodeMesin)->row();
		$kekuatanMesin = $dataMesin->kekuatan;
		$hargaPerProduk = $kekuatanMesin * $hargaProses;
		$data = [
			'kode_produk' => $this->input->post('kode_produk', true),
			'id_proses' => $this->input->post('id_proses', true),
			'kode_mesin' => $this->input->post('kode_mesin', true),
			'std_dies_height' => $this->input->post('std_dies_height', true),
			'harga_dies' => $this->input->post('harga_dies', true),
			'harga_proses' => $this->input->post('harga_proses', true),
			'harga_per_produk' => $hargaPerProduk
		];
		$this->db->where('id', $id);
		$this->db->update('proses_produk', $data);
	}
}
