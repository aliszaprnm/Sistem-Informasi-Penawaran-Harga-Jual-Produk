<?php
defined('BASEPATH') or exit('No direct script access allowed');

class UserModel extends CI_Model
{
	public function tambah()
	{
		$data = [
			'nama' => $this->input->post('nama', true),
			'username' => $this->input->post('username', true),
			'level' => $this->input->post('level', true),
			'password' => sha1($this->input->post('password1', true)),
			'email' => $this->input->post('email', true),
		];
		$this->db->insert('user', $data);
	}

	public function edit($id)
	{
		$data = [
			'nama' => $this->input->post('nama', true),
			'username' => $this->input->post('username', true),
			'level' => $this->input->post('level', true),
			'password' => sha1($this->input->post('password1', true)),
			'email' => $this->input->post('email', true),
		];
		$this->db->where('id', $id);
		$this->db->update('user', $data);
	}
}
