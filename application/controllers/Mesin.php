<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mesin extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		is_log_in();
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
			'required' => 'Nama mesin tidak boleh kosong'
		]);
		$this->form_validation->set_rules('kekuatan', 'Kekuatan Mesin', 'trim|required|numeric|integer|greater_than[0]', [
			'required' => 'Kekuatan mesin tidak boleh kosong',
			'numeric' => 'Kekuatan mesin hanya dapat diisi dengan angka',
			'integer' => 'Kekuatan mesin hanya dapat diisi dengan bilangan bulat',
			'greater_than' => 'Kekuatan mesin harus lebih dari 0'
		]);
		$this->form_validation->set_rules('vol_prod', 'Volume Produksi per Bulan', 'trim|required|numeric|integer|greater_than[0]', [
			'required' => 'Volume produksi per bulan tidak boleh kosong',
			'numeric' => 'Volume produksi per bulan hanya dapat diisi dengan angka',
			'integer' => 'Volume produksi per bulan hanya dapat diisi dengan bilangan bulat',
			'greater_than' => 'Volume produksi per bulan harus lebih dari 0'
		]);
		$this->form_validation->set_rules('harga_dies', 'Harga Dies', 'trim|required|numeric|integer|greater_than[0]', [
			'required' => 'Harga dies tidak boleh kosong',
			'numeric' => 'Harga dies hanya dapat diisi dengan angka',
			'integer' => 'Harga dies hanya dapat diisi dengan bilangan bulat',
			'greater_than' => 'Harga dies harus lebih dari 0'
		]);
		$this->form_validation->set_rules('depresiasi_dies', 'Depresiasi Dies', 'trim|required|numeric|integer|greater_than[0]', [
			'required' => 'Depresiasi dies tidak boleh kosong',
			'numeric' => 'Depresiasi dies hanya dapat diisi dengan angka',
			'integer' => 'Depresiasi dies hanya dapat diisi dengan bilangan bulat',
			'greater_than' => 'Depresiasi dies harus lebih dari 0'
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
			'required' => 'Nama mesin tidak boleh kosong'
		]);
		$this->form_validation->set_rules('kekuatan', 'Kekuatan Mesin', 'trim|required|numeric|integer|greater_than[0]', [
			'required' => 'Kekuatan mesin tidak boleh kosong',
			'numeric' => 'Kekuatan mesin hanya dapat diisi dengan angka',
			'integer' => 'Kekuatan mesin hanya dapat diisi dengan bilangan bulat',
			'greater_than' => 'Kekuatan mesin harus lebih dari 0'
		]);
		$this->form_validation->set_rules('vol_prod', 'Volume Produksi per Bulan', 'trim|required|numeric|integer|greater_than[0]', [
			'required' => 'Volume produksi per bulan tidak boleh kosong',
			'numeric' => 'Volume produksi per bulan hanya dapat diisi dengan angka',
			'integer' => 'Volume produksi per bulan hanya dapat diisi dengan bilangan bulat',
			'greater_than' => 'Volume produksi per bulan harus lebih dari 0'
		]);
		$this->form_validation->set_rules('harga_dies', 'Harga Dies', 'trim|required|numeric|integer|greater_than[0]', [
			'required' => 'Harga dies tidak boleh kosong',
			'numeric' => 'Harga dies hanya dapat diisi dengan angka',
			'integer' => 'Harga dies hanya dapat diisi dengan bilangan bulat',
			'greater_than' => 'Harga dies harus lebih dari 0'
		]);
		$this->form_validation->set_rules('depresiasi_dies', 'Depresiasi Dies', 'trim|required|numeric|integer|greater_than[0]', [
			'required' => 'Depresiasi dies tidak boleh kosong',
			'numeric' => 'Depresiasi dies hanya dapat diisi dengan angka',
			'integer' => 'Depresiasi dies hanya dapat diisi dengan bilangan bulat',
			'greater_than' => 'Depresiasi dies harus lebih dari 0'
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

	public function getMesin($kodeMesin)
	{
		$query = $this->db->query("
		SELECT *
		FROM mesin
		WHERE kode_mesin = '$kodeMesin'
		");
		$data = $query->result();
		echo json_encode($data);
	}

}
