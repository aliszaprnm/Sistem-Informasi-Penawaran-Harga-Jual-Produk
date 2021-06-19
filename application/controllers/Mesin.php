<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mesin extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('MesinModel');
	}

	public function index()
	{
		$data['title'] = 'Mesin';
		$data['rows'] = $this->db->get('mesin')->result();
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar');
		$this->load->view('mesin', $data);
		$this->load->view('templates/footer');
	}

	public function tambah()
	{
		$this->form_validation->set_rules('nama_mesin', 'Nama Mesin', 'trim|required', [
			'required' => 'Nama Mesin tidak boleh kosong'
		]);
		$this->form_validation->set_rules('kekuatan', 'Kekuatan Mesin', 'trim|required', [
			'required' => 'Kekuatan Mesin tidak boleh kosong'
		]);
		$this->form_validation->set_rules('satuan', 'Satuan', 'trim|required', [
			'required' => 'Satuan tidak boleh kosong'
		]);

		if ($this->form_validation->run() == FALSE) {
			$data['title'] = 'Tambah Mesin';
			$CekKodeMesin = $this->db->get('mesin')->num_rows();
			if ($CekKodeMesin == 0) {
				$KodeMesin = "MSN-000";
				$NoUrut = substr($KodeMesin, 5, 3); //000
				$KodeMesinBaru = $NoUrut + 1; //001
			} else {
				$KodeMesin = $this->MesinModel->GetKodeMesin()->row();
				$NoUrut = substr($KodeMesin->IDM, 5, 3);
				$KodeMesinBaru = $NoUrut + 1;
			}

			$data['kode_mesin'] = $KodeMesinBaru;
			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar');
			$this->load->view('mesin_tambah', $data);
			$this->load->view('templates/footer');
		} else {
			$this->MesinModel->tambah();
			if ($this->db->affected_rows() > 0) {
				$this->session->set_flashdata('message', '
					<div class="alert alert-warning alert-dismissible fade show" role="alert">
						<strong>Data berhasil ditambahkan!</strong>
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
				');
				redirect('mesin');
			}
		}
	}

	public function edit($kode_mesin)
	{
		$this->form_validation->set_rules('nama_mesin', 'Nama Mesin', 'trim|required', [
			'required' => 'Nama Mesin tidak boleh kosong'
		]);
		$this->form_validation->set_rules('kekuatan', 'Kekuatan Mesin', 'trim|required', [
			'required' => 'Kekuatan Mesin tidak boleh kosong'
		]);

		if ($this->form_validation->run() == FALSE) {
			$data['title'] = 'Edit Mesin';
			$data['row'] = $this->db->get_where('mesin', ['kode_mesin' => $kode_mesin])->row();
			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar');
			$this->load->view('mesin_edit', $data);
			$this->load->view('templates/footer');
		} else {
			$this->MesinModel->edit($kode_mesin);
			if ($this->db->affected_rows() > 0) {
				$this->session->set_flashdata('message', '
					<div class="alert alert-warning alert-dismissible fade show" role="alert">
						<strong>Data berhasil diubah!</strong>
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
				');
				redirect('mesin');
			}
		}
	}

	public function hapus($kode_mesin)
	{
		$this->db->where('kode_mesin', $kode_mesin);
		$this->db->delete('mesin');
		if ($this->db->affected_rows() > 0) {
			$this->session->set_flashdata('message', '
				<div class="alert alert-warning alert-dismissible fade show" role="alert">
					<strong>Data berhasil dihapus!</strong>
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				');
				redirect('mesin');
		}
	}

	public function pdf()
	{
		$this->load->library('dompdf_gen');
		$data['rows'] = $this->db->get('mesin')->result();
		$this->load->view('mesin_pdf', $data);

		$paper = 'A4';
		$orientation = 'potrait';
		$html = $this->output->get_output();

		$this->dompdf->set_paper($paper, $orientation);
		$this->dompdf->load_html($html);
		$this->dompdf->render();
		$this->dompdf->stream('List Data Mesin', ['Attachment' => 0]);
	}
}