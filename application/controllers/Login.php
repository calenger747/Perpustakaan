<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model("M_Admin", "admin");
		$this->load->model("M_Login", "auth");
	}

	public function index()
	{
		if ($this->session->has_userdata('logged_in') == TRUE) {
			if ($this->session->userdata('level_user') == '1') {
				redirect('Dashboard_Admin');
			}
			else if ($this->session->userdata('level_user') == '2') {
				redirect('Dashboard_User');
			}
			else if ($this->session->userdata('level_user') == '3') {
				redirect('Dashboard_Kepala');
			}
		} else {
			$this->load->view('login-page');
		}
	}

	// Auth Login
	public function auth()
	{
		try {

			$username = $this->input->post('username');
			$password = md5($this->input->post('password'));
			$data = $this->auth->login($username, $password);

			if($data){
				$newdata = array(
					'username'  => $data->username,
					'nama'  => $data->nama,
					'level_user' => $data->level,
					'no_anggota' => $data->no_anggota,
					'logged_in' => TRUE,
					'id_user'  => $data->id_user,
				);

				date_default_timezone_set('Asia/Jakarta');
				$timestamp  		= date("Y-m-d H:i:s");

				$data2 = array('last_login' => $timestamp,);
				
				$this->db->where('id_user', $data->id_user);
				$this->db->update('table_user', $data2);

				if ($data->level == '1') {
					$this->session->set_userdata($newdata);
					$this->session->set_flashdata('notif','<div class="alert alert-arrow-left alert-icon-left alert-light-primary mb-4" role="alert">
						<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-bell"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path><path d="M13.73 21a2 2 0 0 1-3.46 0"></path></svg>
						<strong>Welcome '.$data->nama.' !</strong> My Perpus Indonesia.
						</div>');
					redirect("Dashboard_Admin");
				} else if ($data->level == '3') {
					$this->session->set_userdata($newdata);
					$this->session->set_flashdata('notif','<div class="alert alert-arrow-left alert-icon-left alert-light-primary mb-4" role="alert">
						<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-bell"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path><path d="M13.73 21a2 2 0 0 1-3.46 0"></path></svg>
						<strong>Welcome '.$data->nama.' !</strong> My Perpus Indonesia.
						</div>');
					redirect("Dashboard_Kepala");
				} elseif ($data->level == '2') {
					$this->session->set_userdata($newdata);
					$this->session->set_flashdata('notif','<div class="alert alert-arrow-left alert-icon-left alert-light-primary mb-4" role="alert">
						<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-bell"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path><path d="M13.73 21a2 2 0 0 1-3.46 0"></path></svg>
						<strong>Welcome '.$data->nama.' !</strong> My Perpus Indonesia.
						</div>');
					redirect("Dashboard_User");
				} else {
					$this->session->set_flashdata("notif", "Maaf Anda Tidak Memiliki Akses Untuk Halaman Ini!");
					redirect('Login');
				}

			}
			else{
				$this->session->set_flashdata("notif", "Masukkan Username & Password Dengan Benar");
				redirect('Login');
			}
		} catch(Exception $e) {
			redirect('Login');
		}
	}

	public function logout()
	{
		$this->session->sess_destroy();
		redirect('Login');
	}

	public function register()
	{
		if ($this->session->has_userdata('logged_in') == TRUE) {
			if ($this->session->userdata('level_user') == '1') {
				redirect('Dashboard_Admin');
			}
			else if ($this->session->userdata('level_user') == '2') {
				redirect('Dashboard_User');
			}
			else if ($this->session->userdata('level_user') == '3') {
				redirect('Dashboard_Kepala');
			}
		} else {
			$this->load->view('register-page');
		}
	}

	public function daftar()
	{
		try {
			$output = array('error' => false);
			date_default_timezone_set('Asia/Jakarta');
			$timestamp  		= date("Y-m-d H:i:s");

			$no_anggota 		= $this->admin->getKodeAnggota();
			$tanda_pengenal		= $this->input->post('add_tipe');
			$no_identitas 		= $this->input->post('add_no_identitas');
			$nama_anggota 		= $this->input->post('add_nama');
			$kelas		 		= $this->input->post('add_kelas');
			$fakultas 			= $this->input->post('add_fakultas');
			$prodi 				= $this->input->post('add_prodi');
			$alamat 			= $this->input->post('add_alamat');

			$username 			= $this->input->post('username');
			$password 			= $this->input->post('password');
			$confirm 			= $this->input->post('confirm');

			if ($password != $confirm) {
				$output['error'] = true;
				$output['message'] = 'Konfirmasi Password Tidak Sama!';
			} else {
				$data = array(
					'no_anggota' 		=> $no_anggota,
					'no_identitas' 		=> $no_identitas,
					'tanda_pengenal' 	=> $tanda_pengenal,
					'nama_anggota' 		=> ucwords($nama_anggota),
					'fakultas' 			=> ucwords($fakultas),
					'prodi' 			=> ucwords($prodi),
					'kelas' 			=> $kelas,
					'alamat' 			=> $alamat,
					'date_created' 		=> $timestamp,
				);

				$user = array(
					'username' 		=> $username,
					'password' 		=> md5($password),
					'nama' 			=> ucwords($nama_anggota),
					'level' 		=> '2',
					'no_anggota' 	=> $no_anggota,
					'date_created' 	=> $timestamp,
				);

				$add_user = $this->db->insert('table_user', $user);

				if ($add_user == TRUE) {
					$add = $this->db->insert('table_anggota', $data);
					if ($add == TRUE) {
						$output['message'] = 'Registrasi Berhasil!';
					} else {
						$output['error'] = true;
						$output['message'] = 'Registrasi Gagal!';
					}
				} else {
					$output['error'] = true;
					$output['message'] = 'Registrasi Gagal!';
				}
				
			}

			echo json_encode($output);

		} catch (Exception $e) {
			
		}
	}
}
