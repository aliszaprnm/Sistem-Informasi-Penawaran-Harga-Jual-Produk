<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SubMaterial extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
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

	public function tambah()
	{
		$this->form_validation->set_rules('sub_material', 'Sub Material', 'trim|required', [
			'required' => 'Sub material tidak boleh kosong'
		]);
		$this->form_validation->set_rules('pemakaian', 'Pemakaian', 'trim|required', [
			'required' => 'Pemakaian sub material tidak boleh kosong'
		]);
		$this->form_validation->set_rules('harga_sub_material', 'Harga Sub Material', 'trim|required', [
			'required' => 'Harga sub material tidak boleh kosong'
		]);

		if ($this->form_validation->run() == FALSE) {
			$data['title'] = 'Tambah Sub Material Produk';
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

	// ini brubah
	public function edit($id)
	{
		$this->form_validation->set_rules('sub_material', 'Sub Material', 'trim|required', [
			'required' => 'Sub material tidak boleh kosong'
		]);
		$this->form_validation->set_rules('pemakaian', 'Pemakaian', 'trim|required', [
			'required' => 'Pemakaian sub material tidak boleh kosong'
		]);
		$this->form_validation->set_rules('harga_sub_material', 'Harga Sub Material', 'trim|required', [
			'required' => 'Harga sub material tidak boleh kosong'
		]);

		if ($this->form_validation->run() == FALSE) {
			$data['title'] = 'Edit Sub Material Produk';
			$data['produk'] = $this->db->get('produk')->result();
			$data['row'] = $this->db->get_where('sub_material_produk', ['id' => $id])->row();
			
			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar');
			$this->load->view('submaterial_edit', $data);
			$this->load->view('templates/footer');
		} else {
			$this->SubMaterialModel->edit($id);
			if ($this->db->affected_rows() > 0) {
				$this->session->set_flashdata('message', '
					<div class="alert alert-warning alert-dismissible fade show" role="alert">
						<strong>Data berhasil diubah!</strong>
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
				');
				redirect('submaterial');
			}
		}
	}

	public function hapus($id)
	{
		$this->db->where('id', $id);
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
				redirect('submaterial');
		}
	}
}