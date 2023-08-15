<?php

	class Auth extends CI_Controller
	{

		function __construct()
		{
			parent::__construct();
			$this->load->model('model_user');
			$this->load->model('model_guru');
		}
		
		function index()
		{
			$this->load->view('auth/login');
		}

		function check_login()
		{
			if (isset($_POST['submit'])) {
				
				$username	= $this->input->post('username');
				$password 	= $this->input->post('password');
				// proses pengecekan username dan password di database beradi di model_user dengan memparsing $username dan $password
				// $loginUser untuk mengecek user pada tbl_user sedangkan $loginGuru memerika ke dalam tbl_guru
				$loginUser		= $this->model_user->login($username, $password);
				
				// $loginUser-> mengambil nilai dari $user yang ada di function login pada model_user, apabila data salah maka user tidak berisi dan $loginUser menjadi kosong
				// apablia $loginUser tidak kosong (memiliki data) maka akan membuat session dan redirect ke tampilan_utama
				if (!empty($loginUser)) {

					// $this->session->set_userdata($loginUser); -> maksudnya mengset userdata yang mana datanya diambil dari $loginUser
					$this->session->set_userdata($loginUser);

					if ($loginUser['id_level_user'] == 3) {
						$guru = $this->db->where('id_user', $loginUser['id_user'])->get('tbl_guru')->row();

						$this->session->set_userdata('id_guru', $guru->id_guru);
					} else if ($loginUser['id_level_user'] == 2) {
						$siswa = $this->db->where('id_user', $loginUser['id_user'])->get('tbl_siswa')->row();

						$this->session->set_userdata('nim', $siswa->nim);
						$this->session->set_userdata('kelas', $siswa->kd_kelas);
					}
					redirect('tampilan_utama');

				} else {
					redirect('auth');
				}
			} else {
				redirect('auth');
			}
		}

		function logout()
		{
			$this->session->sess_destroy();
			redirect('auth');
		}

	}

?>