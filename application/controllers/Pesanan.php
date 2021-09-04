<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pesanan extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		is_log_in();
		$this->load->model('PesananModel');
	}

	public function index()
	{
		$data['title'] = 'Daftar Pesanan';
		$where = array();
		if($this->session->userdata('role') == 'Marketing')
		$where = array('pesanan.created_by' => $this->session->userdata('userid'));
		$data['rows'] = $this->PesananModel->GetPesanan($where)->result();
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar');
		$this->load->view('pesanan', $data);
		$this->load->view('templates/footer');
	}

	public function get_produk($kodeCustomer)
	{
		/*$query = $this->db->query("select *,(select nama_customer from customer where kode_customer = a.kode_customer) as customer from produk a inner join customer b on a.kode_customer = b.kode_customer where a.kode_customer = '$kodeCustomer'");*/
		$query = $this->db->query("
			SELECT produk.*, customer.*, customer.nama_customer as customer 
			FROM produk JOIN customer ON produk.kode_customer = customer.kode_customer 
			WHERE UPPER(customer.kode_customer) = UPPER('$kodeCustomer') AND status = ''");
		$data = $query->result();
		echo json_encode($data);
	}
	
	public function baru()
	{
		$data['title'] = 'Pesanan Masuk';
		$where = array('pesanan.status' => 'Baru');
		if($this->session->userdata('role') == 'Marketing')
		$where = array_merge($where,['pesanan.created_by' => $this->session->userdata('userid')]);
		$data['rows'] = $this->PesananModel->GetPesanan($where)->result();
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar');
		$this->load->view('pesanan', $data);
		$this->load->view('templates/footer');
	}

	public function proses($id=0)
	{
		if($id == 0) {
			$data['title'] = 'Pesanan Dalam Proses';
			$where = array('pesanan.status' => 'Proses');
			if($this->session->userdata('role') == 'Marketing')
			$where = array_merge($where,array('pesanan.created_by' => $this->session->userdata('userid')));
			$data['rows'] = $this->PesananModel->GetPesanan($where)->result();
			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar');
			$this->load->view('pesanan', $data);
			$this->load->view('templates/footer');
		} else {
			$status = $this->db->select('status')->from('pesanan')->where('id', $id)->limit(1)->get()->row();
			$status = $status->status;
			if($status == 'Baru') {
				$this->db->select('*');
				$this->db->from('pesanan');
				$this->db->join('pesanan_detil', 'pesanan_detil.pesanan_id = pesanan.id', 'inner');
				$this->db->join('produk', 'pesanan_detil.kode_produk = produk.kode_produk', 'inner');
				$this->db->where('pesanan.id', $id);
				$get_detil = $this->db->get();
				$message = ['success' => 'Pesanan berhasil diproses!', 'error' => 'Harap isi produk detil!'];
				$redirect = 'pesanan/baru';
				if($get_detil->num_rows() > 0) {
					$this->db->select('*');
					$this->db->from('pesanan');
					$this->db->join('process_cost', 'process_cost.pesanan_id = pesanan.id', 'inner');
					$this->db->where('pesanan.id', $id);
					$get_cost = $this->db->get();
					$message = ['success' => 'Pesanan berhasil dilanjutkan ke penawaran!', 'error' => 'Harap isi process cost!'];
					if($get_cost->num_rows() > 0) {
						$this->db->where('pesanan.id', $id);
						$this->db->update('pesanan', array('status' => 'Proses', 'mod_by' => $this->session->userdata('userid'), 'mod_date' => date('Y-m-d H:i:s')));
						/*$this->db->select('MIN(id) as uid');
						$this->db->from('user');
						$this->db->where('level','Marketing');
						$toUser = $this->db->get();*/
						$this->db->select('*, (select sum(total) from process_cost where pesanan_id = pesanan.id) as process_cost, (select sum(total) from tooling_cost where pesanan_id = pesanan.id) as tooling_cost');
						$this->db->from('pesanan');
						$this->db->where('pesanan.id', $id);
						$dataOrder = $this->db->get();
						$data = [
							'pesanan_id' => $id,
							'kode_produk' => $get_detil->row()->kode_produk,
							'kode_customer' => $get_detil->row()->kode_customer,
							'process_cost' => (float)$dataOrder->row()->process_cost,
							'tooling_cost' => (float)$dataOrder->row()->tooling_cost,
							'total' => (float)$dataOrder->row()->process_cost + (float)$dataOrder->row()->tooling_cost,
							'status' => 'Baru',
							'created_by' => $this->session->userdata('userid'),
							'created_date' => date('Y-m-d H:i:s')
						];
						$this->db->insert('penawaran_harga', $data);
						$headerId = $this->db->insert_id();

						$dataNotif = [
							'request_id' => $headerId,
							'type' => 'Offer',
							'message' => 'There is new offering',
							'from_user_id' => $this->session->userdata('userid'),
							'to_user_id' => $get_detil->row()->created_by,
							'date' => date('Y-m-d H:i:s'),
							'status' => 'unread'
						];

						$this->db->insert('notification', $dataNotif);
					}
				}
			} /*else if($status == 'Proses'){
				$this->db->select('*');
				$this->db->from('pesanan');
				$this->db->join('process_cost', 'process_cost.pesanan_id = pesanan.id', 'inner');
				$this->db->where('pesanan.id', $id);
				$get = $this->db->get();
				$message = ['success' => 'Pesanan berhasil dilanjutkan ke penawaran!', 'error' => 'Harap isi process cost!'];
				$redirect = 'pesanan/proses';
				if($get->num_rows() > 0) {
					$this->db->where('pesanan.id', $id);
					$this->db->update('pesanan', array('status' => 'Penawaran', 'mod_by' => $this->session->userdata('userid'), 'mod_date' => date('Y-m-d H:i:s')));
				}
			} */
			//print_r($message); exit;
			if($this->db->affected_rows() > 0) {
				$this->session->set_flashdata('message', '
					<div class="alert alert-success alert-dismissible fade show" role="alert">
						<strong>'.$message['success'].'</strong>
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
				');
			} else {
				$this->session->set_flashdata('message', '
					<div class="alert alert-danger alert-dismissible fade show" role="alert">
						<strong>'.$message['error'].'</strong>
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
				');
			}
			redirect('pesanan/baru');
		}
	}

	public function selesai()
	{
		$data['title'] = 'Pesanan Selesai';
		$where = array('pesanan.status' => 'Selesai');
		if($this->session->userdata('role') == 'Marketing')
		$where = array_merge($where,array('pesanan.created_by' => $this->session->userdata('userid')));
		$data['rows'] = $this->PesananModel->GetPesanan($where)->result();
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar');
		$this->load->view('pesanan', $data);
		$this->load->view('templates/footer');
	}
	
	public function detil($id) {
		$data['title'] = 'Detil Pesanan Customer';
		$data['customer'] = $this->db->get('customer')->result();
		$data['produk'] = $this->db->get('produk')->result();
		$data['row'] = $this->db->get_where('pesanan', ['id' => $id])->row();
		$data['detil'] = $this->db->get_where('pesanan_detil', ['pesanan_id' => $id])->result();

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar');
		$this->load->view('pesanan_detil', $data);
		$this->load->view('templates/footer');
	}

	public function tambah()
	{
		if (!($this->input->post('kode_pesanan'))) {
			$data['title'] = 'Tambah Pesanan Customer';
			$data['customer'] = $this->db->get('customer')->result();
			$data['produk'] = $this->db->get_where('produk', ['status !=' => 'Used'])->result();

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
		if (!($this->input->post('kode_pesanan'))) {
			$data['title'] = 'Edit Pesanan Customer';
			$data['customer'] = $this->db->get('customer')->result();
			//$data['produk'] = $this->db->get_where('produk')->result();
			$produk = $this->db->query("SELECT kode_produk, nama_produk 
								FROM produk
								WHERE status != 'Used' 
								OR kode_produk IN (select kode_produk from pesanan_detil a inner join pesanan b on a.pesanan_id = b.id where b.id = $id)"
							);
			$data['produk'] = $produk->result();
			$data['row'] = $this->db->get_where('pesanan', ['id' => $id])->row();
			$data['detil'] = $this->db->get_where('pesanan_detil', ['pesanan_id' => $id])->result();

			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar');
			$this->load->view('pesanan_edit', $data);
			$this->load->view('templates/footer');
		} else {
			$this->PesananModel->edit($id);
			$this->load->view('pesanan');

			if ($this->db->affected_rows() > 0) {
				$this->session->set_flashdata('message', '
					<div class="alert alert-warning alert-dismissible fade show" role="alert">
						<strong>Data berhasil diperbarui!</strong>
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
		$this->db->where('pesanan_id', $id);
		$this->db->delete('pesanan_detil');
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
