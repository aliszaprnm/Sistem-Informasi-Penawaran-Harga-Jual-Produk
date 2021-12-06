<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SubMaterial extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		is_log_in();
		$this->load->model('SubMaterialModel');
	}

	public function index()
	{
		$data['title'] = 'Sub Material Produk';
		$data['rows'] = $this->SubMaterialModel->GetSubMaterialProduk()->result();
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar');
		$this->load->view('submaterial', $data);
		$this->load->view('templates/footer');
	}

	public function tambah_master()
	{
		$this->form_validation->set_rules('nama_submaterial', 'Nama Submaterial', 'trim|required', [
			'required' => 'Nama submaterial tidak boleh kosong'
		]);
		$this->form_validation->set_rules('harga', 'Harga Submaterial', 'trim|required|numeric|greater_than[0]', [
			'required' => 'Harga submaterial tidak boleh kosong',
			'numeric' => 'Harga submaterial harus menggunakan angka',
			'greater_than' => 'Harga submaterial harus lebih dari 0'
		]);

		if ($this->form_validation->run() == FALSE) {
			$data['title'] = 'Tambah Data Master Sub Material';
			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar');
			$this->load->view('submaterial_master_tambah', $data);
			$this->load->view('templates/footer');
		} else {
			$this->SubMaterialModel->tambah_master();
			$this->load->view('submaterial');
			if ($this->db->affected_rows() > 0) {
				$this->session->set_flashdata('message', '
					<div class="alert alert-warning alert-dismissible fade show" role="alert">
						<strong>Data master berhasil ditambahkan!</strong>
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
				');
				redirect('submaterial');
			}
		}
	}

	public function tambah()
	{
		$this->form_validation->set_rules('pemakaian', 'Pemakaian', 'trim|required', [
			'required' => 'Pemakaian sub material tidak boleh kosong'
		]);
		$this->form_validation->set_rules('harga_sub_material', 'Harga Sub Material', 'trim|required', [
			'required' => 'Harga sub material tidak boleh kosong'
		]);

		if ($this->form_validation->run() == FALSE) {
			$data['title'] = 'Tambah Sub Material Produk';
			$data['sub_material'] = $this->db->get('sub_material')->result();
			$data['produk'] = $this->db->get('produk')->result();
			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar');
			$this->load->view('submaterial_tambah', $data);
			$this->load->view('templates/footer');
		} else {
			$this->SubMaterialModel->tambah();
			if ($this->db->affected_rows() > 0) {
				$this->session->set_flashdata('message', '
					<div class="alert alert-warning alert-dismissible fade show" role="alert">
						<strong>Data berhasil ditambahkan!</strong>
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
				');
				redirect('submaterial');
			}
		}
	}

	public function edit($id, $produkId)
	{
		$this->form_validation->set_rules('pemakaian', 'Pemakaian', 'trim|required|numeric|greater_than[0]', [
			'required' => 'Pemakaian submaterial tidak boleh kosong',
			'numeric' => 'Pemakaian submaterial ditulis dalam bentuk angka',
			'greater_than' => 'Pemakaian submaterial harus lebih dari 0'
		]);

		if ($this->form_validation->run() == FALSE) {
			$data['title'] = 'Edit Sub Material Produk';
			$data['produk'] = $this->db->get('produk')->result();
			$data['sub_material'] = $this->db->get('sub_material')->result();
			//$data['row'] = $this->db->get_where('sub_material_produk', ['id' => $id])->row();
			$data['row'] = $this->SubMaterialModel->GetSubMaterialProduk(array('sub_material.id' => $id, 'produk.kode_produk' => $produkId))->row();
			//print_r($data['row']->kode_produk); exit;
			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar');
			$this->load->view('submaterial_edit', $data);
			$this->load->view('templates/footer');
		} else {
			$this->SubMaterialModel->edit($id, $produkId);
			if ($this->db->affected_rows() > 0) {
				$this->session->set_flashdata('message', '
					<div class="alert alert-warning alert-dismissible fade show" role="alert">
						<strong>Data berhasil diubah!</strong>
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
				');
			}
			redirect('submaterial');
		}
	}

	public function hapus($id, $produkId)
	{
		$this->db->where(array('id_submaterial' => $id, 'kode_produk' => $produkId));
		$this->db->delete('sub_material_produk');
		if ($this->db->affected_rows() > 0) {
			$this->session->set_flashdata('message', '
				<div class="alert alert-warning alert-dismissible fade show" role="alert">
					<strong>Data berhasil dihapus!</strong>
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				');
		}
		redirect('submaterial');
	}

	public function getSubmaterial($id)
	{
		$query = $this->db->query("
		SELECT nama_submaterial, harga
		FROM sub_material
		WHERE id = $id
		");
		$data = $query->result();
		echo json_encode($data);
	}
}
