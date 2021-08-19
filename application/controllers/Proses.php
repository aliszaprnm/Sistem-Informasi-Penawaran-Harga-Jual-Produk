<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Proses extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		is_log_in();
		$this->load->model('ProsesModel');
		$this->load->model('MesinModel');
		$this->load->model('MaterialModel');
	}

	public function index()
	{
		$data['title'] = 'Proses Produk';
		$data['rows'] = $this->ProsesModel->GetProsesProduk()->result();
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar');
		$this->load->view('proses', $data);
		$this->load->view('templates/footer');
	}

	public function tambah()
	{
		$this->form_validation->set_rules('nama_proses', 'Proses', 'trim|required', [
			'required' => 'Proses tidak boleh kosong'
		]);
		// $this->form_validation->set_rules('std_dies_height', 'Standard Dies Height', 'trim|required', [
		// 	'required' => 'Standard dies height tidak boleh kosong'
		// ]);
		// $this->form_validation->set_rules('harga_dies', 'Harga Dies', 'trim|required', [
		// 	'required' => 'Harga dies tidak boleh kosong'
		// ]);
		$this->form_validation->set_rules('harga_proses', 'Harga Proses', 'trim|required', [
			'required' => 'Harga proses tidak boleh kosong'
		]);

		if ($this->form_validation->run() == FALSE) {
			$data['title'] = 'Tambah Proses Produk';
			$data['produk'] = $this->db->get('produk')->result();
			$data['mesin'] = $this->db->get('mesin')->result();
			// $data['proses'] = $this->db->get('proses')->result();
			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar');
			$this->load->view('proses_tambah', $data);
			$this->load->view('templates/footer');
		} else {
			$kodeMesin = $this->input->post('kode_mesin');
			$hargaProses = $this->input->post('harga_proses');
			$kodeProduk = $this->input->post('kode_produk');
			$dataMesin = $this->MesinModel->getDataMesin($kodeMesin)->row();
			$kekuatanMesin = $dataMesin->kekuatan;
			$hargaPerProduk = $kekuatanMesin * $hargaProses;

			$this->ProsesModel->tambah($hargaPerProduk);
			// if (is_array($_POST['proses'])) {
			// 	// $produk = implode(", ", $_POST['proses']);
			// 	$proses = implode(', ', $this->input->post('proses'));

			// 	$this->ProdukModel->tambah(array(
			// 		'proses'		=>	$proses
			// 	));
			// }
			$this->load->view('proses');

			if ($this->db->affected_rows() > 0) {
				$this->session->set_flashdata('message', '
					<div class="alert alert-warning alert-dismissible fade show" role="alert">
						<strong>Data berhasil ditambahkan!</strong>
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
				');
				redirect('proses');
			}
		}
	}

	public function edit($id)
	{
		$this->form_validation->set_rules('nama_proses', 'Proses', 'trim|required', [
			'required' => 'Proses tidak boleh kosong'
		]);
		// $this->form_validation->set_rules('std_dies_height', 'Standard Dies Height', 'trim|required', [
		// 	'required' => 'Standard dies height tidak boleh kosong'
		// ]);
		// $this->form_validation->set_rules('harga_dies', 'Harga Dies', 'trim|required', [
		// 	'required' => 'Harga dies tidak boleh kosong'
		// ]);
		$this->form_validation->set_rules('harga_proses', 'Harga Proses', 'trim|required', [
			'required' => 'Harga proses tidak boleh kosong'
		]);

		if ($this->form_validation->run() == FALSE) {
			$data['title'] = 'Edit Proses Produk';
			$data['produk'] = $this->db->get('produk')->result();
			$data['mesin'] = $this->db->get('mesin')->result();
			$data['row'] = $this->db->get_where('proses_produk', ['id' => $id])->row();
			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar');
			$this->load->view('proses_edit', $data);
			$this->load->view('templates/footer');
		} else {
			$this->ProsesModel->edit($id);
			// if (is_array($_POST['proses'])) {
			// 	// $produk = implode(", ", $_POST['proses']);
			// 	$proses = implode(', ', $this->input->post('proses'));

			// 	$this->ProdukModel->tambah(array(
			// 		'proses'		=>	$proses
			// 	));
			// }
			

			$this->load->view('proses');

			if ($this->db->affected_rows() > 0) {
				$this->session->set_flashdata('message', '
					<div class="alert alert-warning alert-dismissible fade show" role="alert">
						<strong>Data berhasil diubah!</strong>
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
				');
				redirect('proses');
			}
		}
	}

	public function hapus($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('proses_produk');
		if ($this->db->affected_rows() > 0) {
			$this->session->set_flashdata('message', '
				<div class="alert alert-warning alert-dismissible fade show" role="alert">
					<strong>Data berhasil dihapus!</strong>
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				');
			redirect('proses');
		}
	}

	public function getProses($id)
	{
		$query = $this->db->query("
		SELECT nama_proses, harga
		FROM proses
		WHERE id = $id
		");
		$data = $query->result();
		echo json_encode($data);
	}

}
