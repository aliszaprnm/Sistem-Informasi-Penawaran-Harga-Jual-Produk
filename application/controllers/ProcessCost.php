<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ProcessCost extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		is_log_in();
		$this->load->model('ProcessCostModel');
	}

	public function index()
	{
		$data['title'] = 'Process Cost';
		$data['rows'] = $this->ProcessCostModel->GetProcessCost()->result();
		//print_r($this->db->last_query()); exit;
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar');
		$this->load->view('processcost', $data);
		$this->load->view('templates/footer');
	}
	
	public function get_pesanan($orderId)
	{
		$query = $this->db->query("select *,(select nama_produk from produk where kode_produk = b.kode_produk) as produk, (select nama_customer from customer where kode_customer = a.kode_customer) as customer, (select jarak from customer where kode_customer = a.kode_customer) as jarak from pesanan a inner join pesanan_detil b on a.id = b.pesanan_id where a.id = $orderId");
		$data = $query->result();
		echo json_encode($data);
	}

	public function get_pesananV2($orderId, $kodeProduk)
	{
		$syntax = "
		SELECT pesanan.* , pesanan_detil.*, customer.jarak , customer.nama_customer as customer, produk.nama_produk as produk
		FROM pesanan
		JOIN pesanan_detil ON pesanan.id = pesanan_detil.pesanan_id
		JOIN customer ON customer.kode_customer = pesanan.kode_customer 
		JOIN produk ON produk.kode_produk = pesanan_detil.kode_produk
		WHERE pesanan.id = $orderId AND pesanan_detil.kode_produk = '$kodeProduk'";
		$query = $this->db->query($syntax);
		$data = $query->result();
		echo json_encode($data);
	}
	
	public function get_harga($produkId){
		echo json_encode($this->ProcessCostModel->getHargaProduk($produkId));
	}

	public function tambah()
	{
		if (!$this->input->post('kode_pesanan')) {
			$data['title'] = 'Tambah Process Cost';
			$data['pesanan'] = $this->db->get('pesanan')->result();
			$data['produk'] = $this->db->get('produk')->result();
			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar');
			$this->load->view('processcost_tambah', $data);
			$this->load->view('templates/footer');
		} else {
			$this->ProcessCostModel->tambah();
			$this->load->view('processcost');

			if ($this->db->affected_rows() > 0) {
				$this->session->set_flashdata('message', '
					<div class="alert alert-warning alert-dismissible fade show" role="alert">
						<strong>Data berhasil ditambahkan!</strong>
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
				');
				redirect('processcost');
			}
		}
	}

	public function edit($id)
	{
		if (!($this->input->post('total'))) {
			$data['title'] = 'Edit Process Cost';
			$data['pesanan'] = $this->db->get('pesanan')->result();
			$data['produk'] = $this->db->get('produk')->result();
			$data['row'] = $this->ProcessCostModel->GetProcessCost(['process_cost.id' => $id])->row();
			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar');
			$this->load->view('processcost_edit', $data);
			$this->load->view('templates/footer');
		} else {
			$this->ProcessCostModel->edit($id);

			if ($this->db->affected_rows() > 0) {
				$this->session->set_flashdata('message', '
					<div class="alert alert-warning alert-dismissible fade show" role="alert">
						<strong>Data berhasil diubah!</strong>
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
				');
				redirect('processcost');
			}
		}
	}

	public function hapus($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('process_cost');
		if ($this->db->affected_rows() > 0) {
			$this->session->set_flashdata('message', '
				<div class="alert alert-warning alert-dismissible fade show" role="alert">
					<strong>Data berhasil dihapus!</strong>
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				');
			redirect('processcost');
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
