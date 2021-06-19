<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ProcessCost extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('ProcessCostModel');
	}

	public function index()
	{
		$data['title'] = 'Process Cost';
		$data['rows'] = $this->ProcessCostModel->GetProcessCost()->result();
		// $data['rows'] = $this->ProcessCostModel->GetHargaMaterial()->result();
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar');
		$this->load->view('processcost', $data);
		$this->load->view('templates/footer');
	}

	public function tambah()
	{
		$this->form_validation->set_rules('kode_produk', 'Kode Produk', 'trim|required', [
			'required' => 'Kode produk tidak boleh kosong'
		]);
		$this->form_validation->set_rules('kode_grup', 'Kode Grup', 'trim|required', [
			'required' => 'Kode grup tidak boleh kosong'
		]);
		$this->form_validation->set_rules('nama_produk', 'Nama Produk', 'trim|required', [
			'required' => 'Nama produk tidak boleh kosong'
		]);
		$this->form_validation->set_rules('cavity', 'Cavity', 'trim|required', [
			'required' => 'Cavity tidak boleh kosong'
		]);

		if ($this->form_validation->run() == FALSE) {
			$data['title'] = 'Tambah Produk';
			$data['customer'] = $this->db->get('customer')->result();
			$data['proses'] = $this->db->get('proses')->result();
			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar');
			$this->load->view('produk_tambah', $data);
			$this->load->view('templates/footer');
		} else {
			$this->ProdukModel->tambah();
			// if (is_array($_POST['proses'])) {
			// 	// $produk = implode(", ", $_POST['proses']);
			// 	$proses = implode(', ', $this->input->post('proses'));

			// 	$this->ProdukModel->tambah(array(
			// 		'proses'		=>	$proses
			// 	));
			// }
			$this->load->view('produk');

			if ($this->db->affected_rows() > 0) {
				$this->session->set_flashdata('message', '
					<div class="alert alert-warning alert-dismissible fade show" role="alert">
						<strong>Data berhasil ditambahkan!</strong>
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
				');
				redirect('produk');
			}
		}
	}

	public function edit($no_part)
	{
		$this->form_validation->set_rules('no_part', 'Part Number', 'trim|required', [
			'required' => 'Part number tidak boleh kosong'
		]);
		$this->form_validation->set_rules('no_group', 'Group Number', 'trim|required', [
			'required' => 'Group number tidak boleh kosong'
		]);
		$this->form_validation->set_rules('nama_part', 'Nama Part', 'trim|required', [
			'required' => 'Nama part tidak boleh kosong'
		]);
		$this->form_validation->set_rules('cavity', 'Cavity', 'trim|required', [
			'required' => 'Cavity tidak boleh kosong'
		]);
		// $this->form_validation->set_rules('proses', 'Proses', 'trim|required', [
		// 	'required' => 'Proses tidak boleh kosong'
		// ]);
		$this->form_validation->set_rules('proses[]', 'Proses', 'required', [
			'required' => 'Proses tidak boleh kosong',
		]);
		$this->form_validation->set_rules('mesin', 'Mesin', 'trim|required', [
			'required' => 'Mesin tidak boleh kosong'
		]);
		$this->form_validation->set_rules('size_material', 'Size Material', 'trim|required', [
			'required' => 'Size material tidak boleh kosong'
		]);
		$this->form_validation->set_rules('jumlah_per_sheet', 'Jumlah/Sheet', 'trim|required', [
			'required' => 'Jumlah per sheet tidak boleh kosong'
		]);
		$this->form_validation->set_rules('berat', 'Berat/Kg', 'trim|required', [
			'required' => 'Berat per kg tidak boleh kosong'
		]);

		if ($this->form_validation->run() == FALSE) {
			$data['title'] = 'Edit Produk';
			$data['customer'] = $this->db->get('customer')->result();
			$data['proses'] = $this->db->get('proses')->result();
			$data['row'] = $this->db->get_where('produk', ['no_part' => $no_part])->row();
			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar');
			$this->load->view('produk_edit', $data);
			$this->load->view('templates/footer');
		} else {
			$this->ProdukModel->edit();
			// if (is_array($_POST['proses'])) {
			// 	// $produk = implode(", ", $_POST['proses']);
			// 	$proses = implode(', ', $this->input->post('proses'));

			// 	$this->ProdukModel->tambah(array(
			// 		'proses'		=>	$proses
			// 	));
			// }
			$this->load->view('produk');

			if ($this->db->affected_rows() > 0) {
				$this->session->set_flashdata('message', '
					<div class="alert alert-warning alert-dismissible fade show" role="alert">
						<strong>Data berhasil diubah!</strong>
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
				');
				redirect('produk');
			}
		}
	}

	public function hapus($no_part)
	{
		$this->db->where('no_part', $no_part);
		$this->db->delete('produk');
		if ($this->db->affected_rows() > 0) {
			$this->session->set_flashdata('message', '
				<div class="alert alert-warning alert-dismissible fade show" role="alert">
					<strong>Data berhasil dihapus!</strong>
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				');
			redirect('produk');
		}
	}

	public function pdf()
	{
		$this->load->library('dompdf_gen');
		$data['rows'] = $this->ProdukModel->GetProduk()->result();
		$this->load->view('produk_pdf', $data);

		$paper = 'A4';
		$orientation = 'landscape';
		$html = $this->output->get_output();

		$this->dompdf->set_paper($paper, $orientation);
		$this->dompdf->load_html($html);
		$this->dompdf->render();
		$this->dompdf->stream('List Data Produk', ['Attachment' => 0]);
	}
}
