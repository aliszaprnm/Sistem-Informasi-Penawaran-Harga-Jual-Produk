<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('AuthModel');
	}

	public function index()
	{
		$this->form_validation->set_rules('username', 'Username', 'trim|required', [
			'required' => 'Username harus diisi'
		]);
		$this->form_validation->set_rules('password', 'Password', 'trim|required', [
			'required' => 'Password harus diisi'
		]);

		if ($this->form_validation->run() == FALSE) {
			$this->load->view('login');
		} else {
			$username = $this->input->post('username', true);
			$password = $this->input->post('password', true);
			$user = $this->db->get_where('user', ['username' => $username])->row();

			if ($user) {
				if (sha1($password) == $user->password) {
					$this->session->set_userdata([
						'userid' => $user->id,
						'username' => $user->username,
						'role' => $user->level
					]);
					redirect('dashboard');
				} else {
					$this->session->set_flashdata('message', '
						<div class="alert alert-warning alert-dismissible fade show" role="alert">
							Password salah.
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
				');
					redirect('auth');
				}
			} else {
				$this->session->set_flashdata('message', '
					<div class="alert alert-warning alert-dismissible fade show" role="alert">
						Username tidak terdaftar, silakan coba lagi.
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
				');
				redirect('auth');
			}
		}		
	}

	public function logout()
	{
		$this->session->sess_destroy();
		redirect('auth');
	}

}

/* End of file Auth.php */
/* Location: ./application/controllers/Auth.php */
