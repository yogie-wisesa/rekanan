<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
	}

	public function index()
	{
		if ($this->session->userdata('email')) {
			redirect('dashboard');
		}

		
		$this->form_validation->set_rules('password', 'Password', 'required|trim');
		if ($this->form_validation->run() == false) {
			$data['title'] = 'Masuk ke E-Rekanan';
			$this->load->view('templates/auth_header', $data);
			$this->load->view('auth/login');
			$this->load->view('templates/auth_footer');
		} else {
			$this->_login();
		}
	}

	private function _login()
	{
		$email = $this->input->post('email');
		$password = $this->input->post('password');

		$user = $this->db->get_where('tb_user', ['email' => $email])->row_array();

		if ($user) {
			if ($user['is_active'] == 1) {
				if (password_verify($password, $user['password'])) {
					$data = [
						'email' => $user['email'],
						'role_id' => $user['role_id']
					];
					$this->session->set_userdata($data);
					if ($user['role_id'] == 1) {
						$check_date = $this->db->query("SELECT * FROM tb_periode ORDER BY date DESC LIMIT 1")->result();
						foreach ($check_date as $cd) {
							$latest_date = $cd->date;
						}

						$today = date('Y-m');
						if ($latest_date !== $today) {
							$today_exp = explode("-", $today);
							if ($today_exp[1] == '01') {
								$month = 'Januari ';
							}
							if ($today_exp[1] == '02') {
								$month = 'Februari ';
							}
							if ($today_exp[1] == '03') {
								$month = 'Maret ';
							}
							if ($today_exp[1] == '04') {
								$month = 'April ';
							}
							if ($today_exp[1] == '05') {
								$month = 'Mei ';
							}
							if ($today_exp[1] == '06') {
								$month = 'Juni ';
							}
							if ($today_exp[1] == '07') {
								$month = 'Juli ';
							}
							if ($today_exp[1] == '08') {
								$month = 'Agustus ';
							}
							if ($today_exp[1] == '09') {
								$month = 'September ';
							}
							if ($today_exp[1] == '10') {
								$month = 'Oktober ';
							}
							if ($today_exp[1] == '11') {
								$month = 'November ';
							}
							if ($today_exp[1] == '12') {
								$month = 'Desember ';
							}

							$input = $month . $today_exp[0];
							$ins_array = array(
								'date' => $today,
								'keterangan' => $input
							);
							$ins = $this->db->insert('tb_periode', $ins_array);
							redirect('dashboard');
						} else {
							redirect('dashboard');
						}
					} else {
						$check_date = $this->db->query("SELECT * FROM tb_periode ORDER BY date ASC LIMIT 1")->result();
						foreach ($check_date as $cd) {
							$latest_date = $cd->date;
						}

						$today = date('Y-m');
						if ($latest_date != $today) {
							$today_exp = explode("-", $today);
							if ($today_exp[1] == '01') {
								$month = 'Januari ';
							}
							if ($today_exp[1] == '02') {
								$month = 'Februari ';
							}
							if ($today_exp[1] == '03') {
								$month = 'Maret ';
							}
							if ($today_exp[1] == '04') {
								$month = 'April ';
							}
							if ($today_exp[1] == '05') {
								$month = 'Mei ';
							}
							if ($today_exp[1] == '06') {
								$month = 'Juni ';
							}
							if ($today_exp[1] == '07') {
								$month = 'Juli ';
							}
							if ($today_exp[1] == '08') {
								$month = 'Agustus ';
							}
							if ($today_exp[1] == '09') {
								$month = 'September ';
							}
							if ($today_exp[1] == '10') {
								$month = 'Oktober ';
							}
							if ($today_exp[1] == '11') {
								$month = 'November ';
							}
							if ($today_exp[1] == '12') {
								$month = 'Desember ';
							}

							$input = $month . $today_exp[0];
							$ins_array = array(
								'date' => $today,
								'keterangan' => $input
							);
							$ins = $this->db->insert('tb_periode', $ins_array);
							redirect('dashboard');
						} else {
							redirect('dashboard');
						}
					}
				} else {
					$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Wrong password!</div>');
					redirect('auth');
				}
			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">This email has not activated!</div>');
				redirect('auth');
			}
		} else {
			$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Email is not registered!</div>');
			redirect('auth');
		}
	}

	public function registration()
	{
		if ($this->session->userdata('email')) {
			redirect('user/home');
		}

		$this->form_validation->set_rules('name', 'Name', 'required|trim');
		$this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[tb_user.email]', [
			'is_unique' => 'This email has already registered!'
		]);
		$this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[8]|matches[password2]', [
			'matches' => 'Password dont match!',
			'min_length' => 'Password too short'
		]);
		$this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');

		if ($this->form_validation->run() == false) {
			$data['title'] = 'Appraisal Registration';
			$this->load->view('templates/auth_header', $data);
			$this->load->view('auth/registration');
			$this->load->view('templates/auth_footer');
		} else {
			$data = [
				'name' => htmlspecialchars($this->input->post('name', true)),
				'email' => htmlspecialchars($this->input->post('email', true)),
				'image' => 'default.jpg',
				'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
				'role_id' => 2,
				'is_active' => 1,
				'date_created' => time()
			];

			$this->db->insert('tb_user', $data);
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Congratulation! your account has been created. Please Login</div>');
			redirect('auth');
		}
	}

	public function logout()
	{
		$this->session->unset_userdata('email');
		$this->session->unset_userdata('role_id');
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">You have been logged out!</div>');
		redirect('auth');
	}

	public function blocked()
	{
		$this->load->view('auth/blocked');
	}
}
