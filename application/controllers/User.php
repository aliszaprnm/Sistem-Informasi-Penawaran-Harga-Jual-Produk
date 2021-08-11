<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		is_log_in();
		$this->load->model('UserModel');
	}

	public function index()
	{
		$data['title'] = 'User';
		$data['rows'] = $this->db->get('user')->result();
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar');
		$this->load->view('user', $data);
		$this->load->view('templates/footer');
	}

	public function tambah()
	{
		$this->form_validation->set_rules('nama', 'Nama', 'trim|required', [
			'required' => 'Nama tidak boleh kosong'
		]);
		$this->form_validation->set_rules('username', 'Username', 'trim|required|is_unique[user.username]', [
			'required' => 'Username tidak boleh kosong',
			'is_unique' => 'Username sudah dipakai, silakan pakai username lain'
		]);
		$this->form_validation->set_rules('level', 'Level', 'trim|required', [
			'required' => 'Level tidak boleh kosong'
		]);
		$this->form_validation->set_rules('password1', 'Password', 'trim|required', [
			'required' => 'Password tidak boleh kosong'
		]);
		$this->form_validation->set_rules('password2', 'Ulangi Password', 'trim|required|matches[password1]', [
			'required' => 'Ulangi password tidak boleh kosong',
			'matches' => 'Password yang dimasukkan tidak cocok'
		]);
		$this->form_validation->set_rules('email', 'Email', 'trim|required', [
			'required' => 'Email tidak boleh kosong'
		]);

		if ($this->form_validation->run() == FALSE) {
			$data['title'] = 'Tambah User';
			$data['user'] = $this->db->get('user')->result();

			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar');
			$this->load->view('user_tambah', $data);
			$this->load->view('templates/footer');
		} else {
			$this->UserModel->tambah();
			$this->load->view('user');

			if ($this->db->affected_rows() > 0) {
				$this->session->set_flashdata('message', '
					<div class="alert alert-warning alert-dismissible fade show" role="alert">
						<strong>Data berhasil ditambahkan!</strong>
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
				');
				redirect('user');
			}
		}
	}

	public function edit($id)
	{
		if(!empty($this->input->post('username'))){
			$original_value = $this->db->query("SELECT username FROM user WHERE id = ".$id)->row()->username;
			
			if($this->input->post('username') != $original_value) {
			   $is_unique =  '|is_unique[user.username]';
			} else {
			   $is_unique =  '';
			}
				
			$this->form_validation->set_rules('username', 'Username', 'trim|required'.$is_unique, [
				'required' => 'Username tidak boleh kosong',
				'is_unique' => 'Username sudah dipakai, silakan pakai username lain'
			]);
		}

		$this->form_validation->set_rules('nama', 'Nama', 'trim|required', [
				'required' => 'Nama tidak boleh kosong'
		]);

		$this->form_validation->set_rules('level', 'Level', 'trim|required', [
			'required' => 'Level tidak boleh kosong'
		]);

		$this->form_validation->set_rules('email', 'Email', 'trim|required', [
			'required' => 'Email tidak boleh kosong'
		]);

		if ($this->form_validation->run() == FALSE) {
			$data['title'] = 'Edit User';
			$data['row'] = $this->db->get_where('user', ['id' => $id])->row();

			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar');
			$this->load->view('user_edit', $data);
			$this->load->view('templates/footer');
		} else {
			$this->UserModel->edit($id);
			$this->load->view('user');
			$debug = $this->db->db_debug;
			$this->db->db_debug = FALSE;
			//print_r($this->db->last_query()); exit;
			//print_r($this->db->affected_rows()); exit;
			if ($this->db->affected_rows() > 0) {
				$this->db->db_debug = $debug;
				$this->session->set_flashdata('message', '
					<div class="alert alert-warning alert-dismissible fade show" role="alert">
						<strong>Data berhasil diubah!</strong>
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
				');
				redirect('user');
			}
			$this->session->set_flashdata('message', '
				<div class="alert alert-warning alert-dismissible fade show" role="alert">
					<strong>Data tidak ada yang diubah!</strong>
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
			');
			redirect('user');
			$this->db->db_debug = $debug;
		}
	}

	public function hapus($id)
	{
		$this->db->where('username', $id);
		$this->db->delete('user');
		if ($this->db->affected_rows() > 0) {
			$this->session->set_flashdata('message', '
				<div class="alert alert-warning alert-dismissible fade show" role="alert">
					<strong>Data berhasil dihapus!</strong>
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				');
			redirect('user');
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
