<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ToolingCost extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		is_log_in();
		$this->load->model('ToolingCostModel');
	}

	public function index()
	{
		$data['title'] = 'Tooling Cost';
		$data['rows'] = $this->ToolingCostModel->GetToolingCost()->result();
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar');
		$this->load->view('toolingcost', $data);
		$this->load->view('templates/footer');
	}
	
	public function get_harga($produkId){
		$this->db->select('sum(harga_dies) as harga_dies')->from('proses_produk')->where('kode_produk',$produkId);
	 	echo json_encode($this->db->get()->row());
	}

	public function tambah()
	{
		if (!($this->input->post('kode_produk'))) {
			$data['title'] = 'Tambah Tooling Cost';
			$data['pesanan'] = $this->db->get('pesanan')->result();
			$data['produk'] = $this->db->get('produk')->result();
			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar');
			$this->load->view('toolingcost_tambah', $data);
			$this->load->view('templates/footer');
		} else {
			$this->ToolingCostModel->tambah();

			if ($this->db->affected_rows() > 0) {
				$this->session->set_flashdata('message', '
					<div class="alert alert-warning alert-dismissible fade show" role="alert">
						<strong>Data berhasil ditambahkan!</strong>
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
				');
				redirect('toolingcost');
			}
		}
	}

	public function edit($id)
	{
		if (!($this->input->post('total'))) {
			$data['title'] = 'Edit Tooling Cost';
			$data['pesanan'] = $this->db->get('pesanan')->result();
			$data['produk'] = $this->db->get('produk')->result();
			$data['row'] = $this->db->get_where('tooling_cost', ['id' => $id])->row();
			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar');
			$this->load->view('toolingcost_edit', $data);
			$this->load->view('templates/footer');
		} else {
			$this->ToolingCostModel->edit($id);
			if ($this->db->affected_rows() > 0) {
				$this->session->set_flashdata('message', '
					<div class="alert alert-warning alert-dismissible fade show" role="alert">
						<strong>Data berhasil diubah!</strong>
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
				');
				redirect('toolingcost');
			}
		}
	}

	public function hapus($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('tooling_cost');
		if ($this->db->affected_rows() > 0) {
			$this->session->set_flashdata('message', '
				<div class="alert alert-warning alert-dismissible fade show" role="alert">
					<strong>Data berhasil dihapus!</strong>
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				');
			redirect('toolingcost');
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
