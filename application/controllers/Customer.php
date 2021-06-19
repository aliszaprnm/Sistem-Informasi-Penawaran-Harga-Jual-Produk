<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customer extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('CustomerModel');
	}

	public function index()
	{
		$data['title'] = 'Customer';
		$data['rows'] = $this->db->get('customer')->result();
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar');
		$this->load->view('customer', $data);
		$this->load->view('templates/footer');
	}

	public function tambah()
	{
		$this->form_validation->set_rules('nama_customer', 'Nama Customer', 'trim|required', [
			'required' => 'Nama customer tidak boleh kosong'
		]);
		$this->form_validation->set_rules('alamat', 'Alamat', 'trim|required', [
			'required' => 'Alamat tidak boleh kosong'
		]);
		$this->form_validation->set_rules('jarak', 'Jarak', 'trim|required', [
			'required' => 'Jarak tidak boleh kosong'
		]);
		$this->form_validation->set_rules('telp', 'Telp', 'trim|required', [
			'required' => 'Nomor telepon tidak boleh kosong'
		]);
		$this->form_validation->set_rules('email', 'Email', 'trim|required', [
			'required' => 'Email tidak boleh kosong'
		]);

		if ($this->form_validation->run() == FALSE) {
			$data['title'] = 'Tambah Customer';
			$CekKodeCustomer = $this->db->get('customer')->num_rows();
			if ($CekKodeCustomer == 0) {
				$KodeCustomer = "CUST-000";
				$NoUrut = substr($KodeCustomer, 5, 3); //000
				$KodeCustomerBaru = $NoUrut + 1; //001
			} else {
				$KodeCustomer = $this->CustomerModel->GetKodeCustomer()->row();
				$NoUrut = substr($KodeCustomer->IDC, 5, 3);
				$KodeCustomerBaru = $NoUrut + 1;
			}

			$data['kode_customer'] = $KodeCustomerBaru;
			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar');
			$this->load->view('customer_tambah', $data);
			$this->load->view('templates/footer');
		} else {
			$this->CustomerModel->tambah();
			if ($this->db->affected_rows() > 0) {
				$this->session->set_flashdata('message', '
					<div class="alert alert-warning alert-dismissible fade show" role="alert">
						<strong>Data berhasil ditambahkan!</strong>
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
				');
				redirect('customer');
			}
		}
	}

	public function edit($kode_customer)
	{
		$this->form_validation->set_rules('nama_customer', 'Nama Customer', 'trim|required', [
			'required' => 'Nama Customer tidak boleh kosong'
		]);
		$this->form_validation->set_rules('alamat', 'Alamat', 'trim|required', [
			'required' => 'Alamat tidak boleh kosong'
		]);
		$this->form_validation->set_rules('jarak', 'Jarak', 'trim|required', [
			'required' => 'Jarak tidak boleh kosong'
		]);
		$this->form_validation->set_rules('telp', 'Telp', 'trim|required', [
			'required' => 'Nomor telepon tidak boleh kosong'
		]);
		$this->form_validation->set_rules('email', 'Email', 'trim|required', [
			'required' => 'Email tidak boleh kosong'
		]);

		if ($this->form_validation->run() == FALSE) {
			$data['title'] = 'Edit Customer';
			$data['row'] = $this->db->get_where('customer', ['kode_customer' => $kode_customer])->row();
			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar');
			$this->load->view('customer_edit', $data);
			$this->load->view('templates/footer');
		} else {
			$this->CustomerModel->edit($kode_customer);
			if ($this->db->affected_rows() > 0) {
				$this->session->set_flashdata('message', '
					<div class="alert alert-warning alert-dismissible fade show" role="alert">
						<strong>Data berhasil diubah!</strong>
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
				');
				redirect('customer');
			}
		}
	}

	public function hapus($kode_customer)
	{
		$this->db->where('kode_customer', $kode_customer);
		$this->db->delete('customer');
		if ($this->db->affected_rows() > 0) {
			$this->session->set_flashdata('message', '
				<div class="alert alert-warning alert-dismissible fade show" role="alert">
					<strong>Data berhasil dihapus!</strong>
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				');
				redirect('customer');
		}
	}

	public function pdf()
	{
		$this->load->library('dompdf_gen');
		$data['rows'] = $this->db->get('customer')->result();
		$this->load->view('customer_pdf', $data);

		$paper = 'A4';
		$orientation = 'landscape';
		$html = $this->output->get_output();

		$this->dompdf->set_paper($paper, $orientation);
		$this->dompdf->load_html($html);
		$this->dompdf->render();
		$this->dompdf->stream('List Data Customer', ['Attachment' => 0]);
	}
}