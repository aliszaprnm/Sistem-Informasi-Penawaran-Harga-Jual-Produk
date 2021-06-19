<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pesanan extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('PesananModel');
	}

	public function index()
	{
		$data['title'] = 'Pesanan Customer';
		$data['rows'] = $this->PesananModel->GetPesanan()->result();
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar');
		$this->load->view('pesanan', $data);
		$this->load->view('templates/footer');
	}

	public function tambah()
	{
		$this->form_validation->set_rules('qty', 'Jumlah Pesanan', 'trim|required', [
			'required' => 'Jumlah pesanan tidak boleh kosong'
		]);
		$this->form_validation->set_rules('keterangan', 'Keterangan', 'trim|required', [
			'required' => 'Keterangan tidak boleh kosong'
		]);
		
		if ($this->form_validation->run() == FALSE) {
			$data['title'] = 'Tambah Pesanan Customer';
			$data['customer'] = $this->db->get('customer')->result();
			$data['produk'] = $this->db->get('produk')->result();

			$CekKodePesanan = $this->db->get('pesanan')->num_rows();
			if ($CekKodePesanan == 0) {
				$KodePesanan = "ORDER-00000";
				$NoUrut = substr($KodePesanan, 6, 5); //000
				$KodePesananBaru = $NoUrut + 1; //001
			} else {
				$KodePesanan = $this->PesananModel->GetKodePesanan()->row();
				$NoUrut = substr($KodePesanan->IDO, 6, 5);
				$KodePesananBaru = $NoUrut + 1;
			}

			$data['kode_pesanan'] = $KodePesananBaru;

			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar');
			$this->load->view('pesanan_tambah', $data);
			$this->load->view('templates/footer');
		} else {
			$this->PesananModel->tambah();
			// if (is_array($_POST['proses'])) {
			// 	// $produk = implode(", ", $_POST['proses']);
			// 	$proses = implode(', ', $this->input->post('proses'));

			// 	$this->ProdukModel->tambah(array(
			// 		'proses'		=>	$proses
			// 	));
			// }
			$this->load->view('pesanan');

			if ($this->db->affected_rows() > 0) {
				$this->session->set_flashdata('message', '
					<div class="alert alert-warning alert-dismissible fade show" role="alert">
						<strong>Data berhasil ditambahkan!</strong>
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
				');
				redirect('pesanan');
			}
		}
	}

	public function edit($id)
	{
		$this->form_validation->set_rules('qty', 'Jumlah Pesanan', 'trim|required', [
			'required' => 'Jumlah pesanan tidak boleh kosong'
		]);
		$this->form_validation->set_rules('keterangan', 'Keterangan', 'trim|required', [
			'required' => 'Keterangan tidak boleh kosong'
		]);

		if ($this->form_validation->run() == FALSE) {
			$data['title'] = 'Edit Pesanan Customer';
			$data['customer'] = $this->db->get('customer')->result();
			$data['produk'] = $this->db->get('produk')->result();

			$data['row'] = $this->db->get_where('pesanan', ['id' => $id])->row();
			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar');
			$this->load->view('pesanan_edit', $data);
			$this->load->view('templates/footer');
		} else {
			$this->PesananModel->edit($id);
			if ($this->db->affected_rows() > 0) {
				$this->session->set_flashdata('message', '
					<div class="alert alert-warning alert-dismissible fade show" role="alert">
						<strong>Data berhasil diubah!</strong>
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
				');
				redirect('pesanan');
			}
		}
	}

	public function hapus($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('pesanan');
		if ($this->db->affected_rows() > 0) {
			$this->session->set_flashdata('message', '
				<div class="alert alert-warning alert-dismissible fade show" role="alert">
					<strong>Data berhasil dihapus!</strong>
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				');
			redirect('pesanan');
		}
	}

	public function pdf()
	{
		$this->load->library('dompdf_gen');
		$data['rows'] = $this->PesananModel->GetPesanan()->result();
		$this->load->view('pesanan_pdf', $data);

		$paper = 'A4';
		$orientation = 'landscape';
		$html = $this->output->get_output();

		$this->dompdf->set_paper($paper, $orientation);
		$this->dompdf->load_html($html);
		$this->dompdf->render();
		$this->dompdf->stream('List Data Pesanan', ['Attachment' => 0]);
	}
}
