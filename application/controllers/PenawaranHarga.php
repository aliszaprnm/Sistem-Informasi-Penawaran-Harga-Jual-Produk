<?php
defined('BASEPATH') or exit('No direct script access allowed');

class PenawaranHarga extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		is_log_in();
		$this->load->model('PenawaranHargaModel');
	}

	public function index()
	{
		$data['title'] = 'Penawaran Harga';
		$where = array();
		if($this->session->userdata('role') == 'Operational Manager')
		$where = array_merge($where,['penawaran_harga.created_by' => $this->session->userdata('userid')]);
		$data['rows'] = $this->PenawaranHargaModel->GetPenawaranHarga($where)->result();
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar');
		$this->load->view('penawaranharga', $data);
		$this->load->view('templates/footer');
	}
	
	public function detil($id)
	{
		$data['title'] = 'Penawaran Harga Detil';
		$where = array('penawaran_harga.status' => 'New' AND 'Deal');
		if($this->session->userdata('role') == 'Operational Manager')
		$where = array_merge($where,['penawaran_harga.created_by' => $this->session->userdata('userid')]);
		//$data['rows'] = $this->PenawaranHargaModel->GetPenawaranHarga($where)->result();
		$getData = $this->db->query(" SELECT a.id, a.pesanan_id, b.tanggal, b.kode_pesanan, a.kode_produk, c.nama_customer as nama_customer, c.jarak, d.kode_grup, d.nama_produk as nama_produk, process_cost, tooling_cost, a.total, a.status, e.*
							FROM penawaran_harga a
							LEFT JOIN pesanan b ON a.pesanan_id = b.id
							LEFT JOIN customer c ON a.kode_customer = c.kode_customer
							LEFT JOIN produk d ON a.kode_produk = d.kode_produk
							LEFT JOIN process_cost e ON a.pesanan_id = e.pesanan_id AND a.kode_produk = e.kode_produk
							WHERE a.pesanan_id = $id AND a.status = 'Deal'
						");
		if ($this->session->userdata('role') == 'Marketing')
		$where = array_merge($where,['penawaran_harga.created_by' => $this->session->userdata('userid')]);
		//$data['rows'] = $this->PenawaranHargaModel->GetPenawaranHarga($where)->result();
		$getData = $this->db->query(" SELECT a.id, a.pesanan_id, b.tanggal, b.kode_pesanan, a.kode_produk, c.nama_customer as nama_customer, c.jarak, d.kode_grup, d.nama_produk as nama_produk, process_cost, tooling_cost, a.total, a.status, e.*
							FROM penawaran_harga a
							LEFT JOIN pesanan b ON a.pesanan_id = b.id
							LEFT JOIN customer c ON a.kode_customer = c.kode_customer
							LEFT JOIN produk d ON a.kode_produk = d.kode_produk
							LEFT JOIN process_cost e ON a.pesanan_id = e.pesanan_id AND a.kode_produk = e.kode_produk
							WHERE a.pesanan_id = $id AND a.status = 'New'
						");
		$data['rows'] = $getData->result();
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar');
		$this->load->view('penawaranharga_detil', $data);
		$this->load->view('templates/footer');
	}

	public function validasi()
	{
		$data['title'] = 'Validasi Penawaran Harga';
		$where = array('penawaran_harga.status' => 'Negotiating');
		if($this->session->userdata('role') == 'Operational Manager')
		$where = array_merge($where,['penawaran_harga.created_by' => $this->session->userdata('userid')]);
		$data['rows'] = $this->PenawaranHargaModel->GetPenawaranHarga($where)->result();
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar');
		$this->load->view('penawaranharga', $data);
		$this->load->view('templates/footer');
	}

	public function deal()
	{
		$data['title'] = 'Penawaran Harga OK';
		$where = array('penawaran_harga.status' => 'Deal');
		if($this->session->userdata('role') == 'Operational Manager')
		$where = array_merge($where,['penawaran_harga.created_by' => $this->session->userdata('userid')]);
		//$data['rows'] = $this->PenawaranHargaModel->GetPenawaranHarga($where)->result();
		$getData = $this->db->query(" SELECT a.id, a.pesanan_id, b.kode_pesanan, a.kode_produk, c.nama_customer as nama_customer, d.nama_produk as nama_produk, sum(a.process_cost) as process_cost, sum(a.tooling_cost) as tooling_cost, sum(a.total) as total, a.status
							FROM penawaran_harga a
							LEFT JOIN pesanan b ON a.pesanan_id = b.id
							LEFT JOIN customer c ON a.kode_customer = c.kode_customer
							LEFT JOIN produk d ON a.kode_produk = d.kode_produk
							WHERE a.status = 'Deal' /* AND a.created_by = '".$this->session->userdata('userid')."' */
							GROUP BY a.pesanan_id
						");
		$data['rows'] = $getData->result();
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar');
		$this->load->view('penawaranharga_ok', $data);
		$this->load->view('templates/footer');
	}

	public function reject()
	{
		$data['title'] = 'Penawaran Harga Tidak OK';
		$where = array('penawaran_harga.status' => 'Reject');
		if($this->session->userdata('role') == 'Operational Manager')
		$where = array_merge($where,['penawaran_harga.created_by' => $this->session->userdata('userid')]);
		$data['rows'] = $this->PenawaranHargaModel->GetPenawaranHarga($where)->result();
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar');
		$this->load->view('penawaranharga', $data);
		$this->load->view('templates/footer');
	}
	
	public function get_harga($kodeProduk){
		// $this->db->select('(select sum(total) from process_cost where pesanan_id = a.id) as process_cost, (select sum(total) from tooling_cost where pesanan_id = a.id) as tooling_cost')
		// ->from('pesanan a')
		// ->where('id',$orderId);
	 	// echo json_encode($this->db->get()->row());
	 	$this->db->select('(select total from process_cost where kode_produk = a.kode_produk) as process_cost, (select total from tooling_cost where kode_produk = a.kode_produk) as tooling_cost')
		->from('produk a')
		->where('kode_produk',$kodeProduk);
	 	echo json_encode($this->db->get()->row());
	}

	public function tambah()
	{
		if (!$this->input->post('kode_pesanan')) {
			$data['title'] = 'Tambah Penawaran Harga';
			$data['pesanan'] = $this->db->get('pesanan')->result();
			$data['produk'] = $this->db->get('produk')->result();
			$data['customer'] = $this->db->get('customer')->result();
			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar');
			$this->load->view('penawaranharga_tambah', $data);
			$this->load->view('templates/footer');
		} else {
			$this->PenawaranHargaModel->tambah();

			if ($this->db->affected_rows() > 0) {
				$this->session->set_flashdata('message', '
					<div class="alert alert-warning alert-dismissible fade show" role="alert">
						<strong>Data berhasil ditambahkan!</strong>
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
				');
				redirect('penawaranharga');
			}
		}
	}

	public function proses($confirm,$id)
	{
		if($confirm && $id) {
			$dataBefore = $this->db->select('status,created_by,mod_by')->from('penawaran_harga')->where('id', $id)->limit(1)->get()->row();
			$statusBefore = $dataBefore->status;
			$creator = $dataBefore->created_by;
			$modByBefore = $dataBefore->mod_by;
			//if($status == 'Baru') {
				if($confirm == 'deal') $message = ['status' => 'Deal', 'success' => 'Penawaran harga berhasil diupdate!', 'error' => 'Terjadi kesalahan!', 'message' => 'deal'];
				if($confirm == 'nego') $message = ['status' => 'Negotiating', 'success' => 'Penawaran harga akan di negosiasi kembali!', 'error' => 'Terjadi kesalahan!', 'message' => 'negotiating'];
				if($confirm == 'reject') $message = ['status' => 'Reject', 'success' => 'Penawaran harga berhasil di tolak!', 'error' => 'Terjadi kesalahan!', 'message' => 'reject'];
				$this->db->where('id', $id);
				$this->db->update('penawaran_harga', array('status' => $message['status'], 'mod_by' => $this->session->userdata('userid'), 'mod_date' => date('Y-m-d H:i:s')));
				if($this->db->affected_rows() > 0 && ($confirm == 'nego' || ($confirm == 'reject' && $creator == $this->session->userdata('userid')))) {
					$dataAfter = $this->db->select('status,created_by,mod_by')->from('penawaran_harga')->where('id', $id)->limit(1)->get()->row();
					$statusAfter = $dataAfter->status;
					$modByAfter = $dataAfter->mod_by;
					/*$this->db->select('MIN(id) as uid');
					$this->db->from('user');
					$this->db->where('level','Marketing');
					$toUser = $this->db->get();*/
					$dataNotif = [
						'request_id' => $id,
						'type' => ($confirm == 'reject') ? 'Reject' : 'Negotiate',
						'message' => 'There is new '. $message['message'],
						'from_user_id' => $this->session->userdata('userid'),
						'to_user_id' => ($confirm == 'reject') ? $modByBefore : $creator,
						'date' => date('Y-m-d H:i:s'),
						'status' => 'unread'
					];

					$this->db->insert('notification', $dataNotif);
				} if($confirm == 'deal' || $confirm == 'reject') {
					$pesananId = $this->db->select('pesanan_id')->from('penawaran_harga')->where('id', $id)->limit(1)->get()->row('pesanan_id');
					$this->db->where('id', $pesananId);
					$this->db->update('pesanan', ['status' => 'Selesai', 'mod_by' => $this->session->userdata('userid'), 'mod_date' => date('Y-m-d H:i:s')]);
				}
			/*} else if($status == 'Validasi'){
				$this->db->select('*');
				$this->db->from('pesanan');
				$this->db->join('process_cost', 'process_cost.pesanan_id = pesanan.id', 'inner');
				$this->db->where('pesanan.id', $id);
				$get = $this->db->get();
				$message = ['success' => 'Pesanan berhasil dilanjutkan ke penawaran!', 'error' => 'Harap isi process cost!'];
				$redirect = 'pesanan/proses';
				if($get->num_rows() > 0) {
					
				}
			}*/
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
			redirect('penawaranharga/validasi');
		}
	}

	public function edit($id)
	{
		if (!$this->input->post('harga_jual')) {
			$data['title'] = 'Edit Penawaran Harga';
			$data['pesanan'] = $this->db->get('pesanan')->result();
			$data['customer'] = $this->db->get('customer')->result();
			$data['produk'] = $this->db->get('produk')->result();
			$data['row'] = $this->db->get_where('penawaran_harga', ['id' => $id])->row();
			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar');
			$this->load->view('penawaranharga_edit', $data);
			$this->load->view('templates/footer');
		} else {
			$this->PenawaranHargaModel->edit($id);
			if ($this->db->affected_rows() > 0) {
				$this->session->set_flashdata('message', '
					<div class="alert alert-warning alert-dismissible fade show" role="alert">
						<strong>Data berhasil diubah!</strong>
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
				');
				redirect('penawaranharga');
			}
		}
	}

	public function hapus($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('penawaran_harga');
		if ($this->db->affected_rows() > 0) {
			$this->session->set_flashdata('message', '
				<div class="alert alert-warning alert-dismissible fade show" role="alert">
					<strong>Data berhasil dihapus!</strong>
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				');
			redirect('penawaranharga');
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

	public function cetak_hasil($id) {
		$data['title'] = 'Penawaran Harga Detil';
		$where = array('penawaran_harga.status' => 'New' AND 'Deal');
		if($this->session->userdata('role') == 'Operational Manager')
		$where = array_merge($where,['penawaran_harga.created_by' => $this->session->userdata('userid')]);
		//$data['rows'] = $this->PenawaranHargaModel->GetPenawaranHarga($where)->result();
		$getData = $this->db->query(" SELECT a.id, a.pesanan_id, b.tanggal, b.kode_pesanan, a.kode_produk, c.nama_customer as nama_customer, c.jarak, d.kode_grup, d.nama_produk as nama_produk, process_cost, tooling_cost, a.total, a.status, e.*
							FROM penawaran_harga a
							LEFT JOIN pesanan b ON a.pesanan_id = b.id
							LEFT JOIN customer c ON a.kode_customer = c.kode_customer
							LEFT JOIN produk d ON a.kode_produk = d.kode_produk
							LEFT JOIN process_cost e ON a.pesanan_id = e.pesanan_id AND a.kode_produk = e.kode_produk
							WHERE a.pesanan_id = $id AND a.status = 'Deal'
						");
		if ($this->session->userdata('role') == 'Marketing')
		$where = array_merge($where,['penawaran_harga.created_by' => $this->session->userdata('userid')]);
		//$data['rows'] = $this->PenawaranHargaModel->GetPenawaranHarga($where)->result();
		$getData = $this->db->query(" SELECT a.id, a.pesanan_id, b.tanggal, b.kode_pesanan, a.kode_produk, c.nama_customer as nama_customer, c.jarak, d.kode_grup, d.nama_produk as nama_produk, process_cost, tooling_cost, a.total, a.status, e.*
							FROM penawaran_harga a
							LEFT JOIN pesanan b ON a.pesanan_id = b.id
							LEFT JOIN customer c ON a.kode_customer = c.kode_customer
							LEFT JOIN produk d ON a.kode_produk = d.kode_produk
							LEFT JOIN process_cost e ON a.pesanan_id = e.pesanan_id AND a.kode_produk = e.kode_produk
							WHERE a.pesanan_id = $id AND a.status = 'New'
						");
		$data['rows'] = $getData->result();
        $this->load->view('cetak_laporan_hasil_produksi', $data);
    }
}
