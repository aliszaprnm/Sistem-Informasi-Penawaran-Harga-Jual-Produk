<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Produk extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		is_log_in();
		$this->load->model('ProdukModel');
	}

	public function index()
	{
		$data['title'] = 'Produk';
		$data['rows'] = $this->ProdukModel->GetProduk()->result();
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar');
		$this->load->view('produk', $data);
		$this->load->view('templates/footer');
	}

	public function get_customer($kodeCustomer)
	{
		$query = $this->db->query("select *,(select nama_customer from customer where kode_customer = a.kode_customer) as customer from material a inner join customer b on a.kode_customer = b.kode_customer where a.kode_customer = '$kodeCustomer'");
		$data = $query->result();
		echo json_encode($data);
	}

	public function get_customerV2($kodeCustomer, $materialId)
	{
		$syntax = "
		SELECT customer.nama_customer as customer , material.*
		FROM customer
		JOIN material ON customer.kode_customer = material.kode_customer
		WHERE customer.kode_customer = $kodeCustomer AND material.id = '$materialId'";
		$query = $this->db->query($syntax);
		$data = $query->result();
		echo json_encode($data);
	}

	public function get_harga($materialId){
		// $this->db->select('(select sum(total) from process_cost where pesanan_id = a.id) as process_cost, (select sum(total) from tooling_cost where pesanan_id = a.id) as tooling_cost')
		// ->from('pesanan a')
		// ->where('id',$orderId);
	 	// echo json_encode($this->db->get()->row());
	 	$this->db->select('(select tebal from material where kode_customer = a.kode_customer) as tebal')
		->from('material a')
		->where('id',$materialId);
	 	echo json_encode($this->db->get()->row());
	}

	// public function get_harga($idMaterial){
	// 	echo json_encode($this->ProdukModel->getHargaMaterial($idMaterial));
	// }

	public function tambah()
	{
		$this->form_validation->set_rules('kode_customer', 'Customer', 'trim|required', [
			'required' => 'Customer harus dipilih'
		]);
		$this->form_validation->set_rules('kode_grup', 'Kode Grup', 'trim|required', [
			'required' => 'Kode grup tidak boleh kosong'
		]);
		$this->form_validation->set_rules('nama_produk', 'Nama Produk', 'trim|required', [
			'required' => 'Nama produk tidak boleh kosong'
		]);
		
		if (!($this->input->post('kode_produk'))) {
			$data['title'] = 'Tambah Produk';
			$data['customer'] = $this->db->get('customer')->result();
			$data['material'] = $this->db->get('material')->result();
			$data['sub_material'] = $this->db->get('sub_material')->result();
			$data['proses'] = $this->db->get('proses')->result();
			$data['mesin'] = $this->db->get('mesin')->result();
			
			$CekKodeProduk = $this->db->get('produk')->num_rows();
			if ($CekKodeProduk == 0) {
				$KodeProduk = "PROD-000";
				$NoUrut = substr($KodeProduk, 5, 3); //000
				$KodeProdukBaru = $NoUrut + 1; //001
			} else {
				$KodeProduk = $this->ProdukModel->GetKodeProduk()->row();
				$NoUrut = substr($KodeProduk->IDP, 5, 3);
				$KodeProdukBaru = $NoUrut + 1;
			}

			$data['kode_produk'] = $KodeProdukBaru;

			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar');
			$this->load->view('produk_tambah', $data);
			$this->load->view('templates/footer');
		} else {
			$this->ProdukModel->tambah();
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

	public function edit($kode_produk)
	{
		$this->form_validation->set_rules('kode_grup', 'Kode Grup', 'trim|required', [
			'required' => 'Kode grup tidak boleh kosong'
		]);
		$this->form_validation->set_rules('nama_produk', 'Nama Produk', 'trim|required', [
			'required' => 'Nama produk tidak boleh kosong'
		]);

		if ($this->form_validation->run() == FALSE) {
			$data['title'] = 'Edit Produk';
			$data['customer'] = $this->db->get('customer')->result();
			// $data['proses'] = $this->db->get('proses')->result();
			$data['row'] = $this->db->get_where('produk', ['kode_produk' => $kode_produk])->row();
			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar');
			$this->load->view('produk_edit', $data);
			$this->load->view('templates/footer');
		} else {
			$this->ProdukModel->edit($kode_produk);
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

	public function hapus($kode_produk)
	{
		$this->db->where('kode_produk', $kode_produk);
		$this->db->delete('proses_produk');
		$this->db->where('kode_produk', $kode_produk);
		$this->db->delete('sub_material_produk');
		$this->db->where('kode_produk', $kode_produk);
		$this->db->delete('material_produk');
		$this->db->where('kode_produk', $kode_produk);
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
