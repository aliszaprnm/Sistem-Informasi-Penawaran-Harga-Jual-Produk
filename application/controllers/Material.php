<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Material extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		is_log_in();
		$this->load->model('MaterialModel');
	}

	public function index()
	{
		$data['title'] = 'Material Produk';
		$data['rows'] = $this->MaterialModel->GetMaterialProduk()->result();
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar');
		$this->load->view('material', $data);
		$this->load->view('templates/footer');
	}

	public function tambah()
	{
		$this->form_validation->set_rules('jenis_material', 'Jenis Material', 'trim|required', [
			'required' => 'Jenis material tidak boleh kosong'
		]);
		$this->form_validation->set_rules('tebal_material', 'Tebal Material', 'trim|required', [
			'required' => 'Tebal material tidak boleh kosong'
		]);
		$this->form_validation->set_rules('lebar_material', 'Lebar Material', 'trim|required', [
			'required' => 'Lebar material tidak boleh kosong'
		]);
		$this->form_validation->set_rules('panjang_material', 'Panjang Material', 'trim|required', [
			'required' => 'Panjang material tidak boleh kosong'
		]);
		$this->form_validation->set_rules('berat_material', 'Berat Material', 'trim|required', [
			'required' => 'Berat material tidak boleh kosong'
		]);
		$this->form_validation->set_rules('jml_per_sheet', 'Jumlah/Sheet', 'trim|required', [
			'required' => 'Jumlah per sheet tidak boleh kosong'
		]);
		$this->form_validation->set_rules('harga_material', 'Harga Material', 'trim|required', [
			'required' => 'Harga material tidak boleh kosong'
		]);

		if ($this->form_validation->run() == FALSE) {
			$data['title'] = 'Tambah Material Produk';
			$data['produk'] = $this->db->get('produk')->result();
			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar');
			$this->load->view('material_tambah', $data);
			$this->load->view('templates/footer');
		} else {
			$this->MaterialModel->tambah();
			if ($this->db->affected_rows() > 0) {
				$this->session->set_flashdata('message', '
					<div class="alert alert-warning alert-dismissible fade show" role="alert">
						<strong>Data berhasil ditambahkan!</strong>
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
				');
				redirect('material');
			}
		}
	}

	// ini brubah
	public function edit($id)
	{
		$this->form_validation->set_rules('jenis_material', 'Jenis Material', 'trim|required', [
			'required' => 'Jenis material tidak boleh kosong'
		]);
		$this->form_validation->set_rules('tebal_material', 'Tebal Material', 'trim|required', [
			'required' => 'Tebal material tidak boleh kosong'
		]);
		$this->form_validation->set_rules('lebar_material', 'Lebar Material', 'trim|required', [
			'required' => 'Lebar material tidak boleh kosong'
		]);
		$this->form_validation->set_rules('panjang_material', 'Panjang Material', 'trim|required', [
			'required' => 'Panjang material tidak boleh kosong'
		]);
		$this->form_validation->set_rules('berat_material', 'Berat Material', 'trim|required', [
			'required' => 'Berat material tidak boleh kosong'
		]);
		$this->form_validation->set_rules('jml_per_sheet', 'Jumlah/Sheet', 'trim|required', [
			'required' => 'Jumlah per sheet tidak boleh kosong'
		]);
		$this->form_validation->set_rules('harga_material', 'Harga Material', 'trim|required', [
			'required' => 'Harga material tidak boleh kosong'
		]);

		if ($this->form_validation->run() == FALSE) {
			$data['title'] = 'Edit Material Produk';
			$data['produk'] = $this->db->get('produk')->result();
			$data['material'] = $this->db->get('material')->result;
			$data['row'] = $this->db->get_where('material_produk', ['id' => $id])->row();
			
			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar');
			$this->load->view('material_edit', $data);
			$this->load->view('templates/footer');
		} else {
			$this->MaterialModel->edit($id);
			if ($this->db->affected_rows() > 0) {
				$this->session->set_flashdata('message', '
					<div class="alert alert-warning alert-dismissible fade show" role="alert">
						<strong>Data berhasil diubah!</strong>
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
				');
				redirect('material');
			}
		}
	}

	public function hapus($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('material_produk');
		if ($this->db->affected_rows() > 0) {
			$this->session->set_flashdata('message', '
				<div class="alert alert-warning alert-dismissible fade show" role="alert">
					<strong>Data berhasil dihapus!</strong>
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				');
				redirect('material');
		}
	}

	public function getMaterial($id)
	{
		$query = $this->db->query("
		SELECT jenis_material, kode_customer, harga, tebal, panjang, lebar
		FROM material
		WHERE id = $id
		");
		$data = $query->result();
		echo json_encode($data);
	}

}
