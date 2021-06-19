<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CustomerModel extends CI_Model {

	public function GetKodeCustomer()
	{
		$this->db->select('MAX(kode_customer) as IDC');
		$this->db->from('customer');
		return $this->db->get();
	}

	public function tambah()
	{
		$data = [
			'kode_customer' => $this->input->post('kode_customer', true),
			'nama_customer' => $this->input->post('nama_customer', true),
			'alamat' => $this->input->post('alamat', true),
			'jarak' => $this->input->post('jarak', true),
			'telp' => $this->input->post('telp', true),
			'email' => $this->input->post('email', true)
		];
		$this->db->insert('customer', $data);
	}

	public function edit($kode_customer)
	{
		$data = [
			'kode_customer' => $this->input->post('kode_customer', true),
			'nama_customer' => $this->input->post('nama_customer', true),
			'alamat' => $this->input->post('alamat', true),
			'telp' => $this->input->post('telp', true),
			'email' => $this->input->post('email', true)
		];
		
		$this->db->where('kode_customer', $kode_customer);
		$this->db->update('customer', $data);
	}

}