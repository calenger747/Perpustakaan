<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_Admin', 'admin');
		$this->load->model('M_Login', 'login');
		if ($this->session->has_userdata('logged_in') == TRUE) {
			if ($this->session->userdata('level_user') == '2') {
				redirect('Dashboard_User');
			}
		} else {
			redirect('Login');
		}
	}

	// Edit Profile
	public function editProfile()
	{
		try {
			$output = array('error' => false);
			date_default_timezone_set('Asia/Jakarta');
			$timestamp  		= date("Y-m-d H:i:s");

			$id_user		= $this->input->post('edit_id');
			$nama 			= $this->input->post('edit_nama');
			$username		= $this->input->post('edit_username');
			$email 			= $this->input->post('edit_email');
			

			$data = array(
				'nama' 			=> ucwords($nama),
				'username' 		=> $username,
				'email' 		=> $email,
			);

			$this->db->where('id_user', $id_user);
			$update = $this->db->update('table_user', $data);
			if ($update == TRUE) {
				$output['message'] = 'Data Berhasil Disimpan!';
			} else {
				$output['error'] = true;
				$output['message'] = 'Data Gagal Disimpan!';
			}

			echo json_encode($output);

		} catch (Exception $e) {
			
		}
	}

	// Edit Password
	public function editPassword()
	{
		try {
			$output = array('error' => false);
			date_default_timezone_set('Asia/Jakarta');
			$timestamp  		= date("Y-m-d H:i:s");

			$key = 'my-perpus-super-secret-key';

			$id_user		= $this->input->post('edit_id');
			$old_password 	= $this->input->post('old_password');
			$new_password	= $this->input->post('new_password');
			
			$_id = $this->db->get_where('table_user',['id_user' => $id_user])->row();
			$password = $this->encryption->decrypt($_id->password);

			if ($password == $old_password) {
				$data = array(
					'password' 	=> $this->encryption->encrypt($new_password),
				);

				$this->db->where('id_user', $id_user);
				$update = $this->db->update('table_user', $data);
				if ($update == TRUE) {
					$output['message'] = 'Password Berhasil Diubah!';
				} else {
					$output['error'] = true;
					$output['message'] = 'Password Gagal Diubah!';
				}
			} else {
				$output['error'] = true;
				$output['message'] = 'Password Lama Salah!';
			}
			echo json_encode($output);

		} catch (Exception $e) {
			
		}
	}

	// Laporan Anggota
	public function laporan_anggota_pdf()
	{
		$tgl_awal 			= $this->input->get("tgl_awal");
		$tgl_akhir 	 		= $this->input->get("tgl_akhir");

		$dataLaporan = $this->admin->laporan_anggota($tgl_awal, $tgl_akhir);

		$dataView = [
			'dataLaporan' => $dataLaporan,
			'tgl_awal' => date("Y", strtotime($tgl_awal)),
			'tgl_akhir' => date("Y", strtotime($tgl_akhir))
		];

		$view = $this->load->view('dashboardAdmin/laporan/pdf/laporan-anggota', $dataView, true);
    // echo $view;
		$this->pdfgenerator->generate($view, "Laporan Anggota (".$tgl_awal." - ".$tgl_akhir.")");
	}

	// Laporan Buku
	public function laporan_buku_pdf()
	{

		$dataLaporan = $this->admin->laporan_buku();

		$dataView = [
			'dataLaporan' => $dataLaporan,
		];

		$view = $this->load->view('dashboardAdmin/laporan/pdf/laporan-buku', $dataView, true);
    // echo $view;
		$this->pdfportrait->generate($view, "Laporan Buku");
	}

	// Laporan Pinjaman
	public function laporan_peminjaman_pdf()
	{
		$tgl_awal 			= $this->input->get("tgl_awal");
		$tgl_akhir 	 		= $this->input->get("tgl_akhir");

		$dataLaporan = $this->admin->laporan_pinjaman($tgl_awal, $tgl_akhir);

		$dataView = [
			'dataLaporan' => $dataLaporan,
			'tgl_awal' => date("Y", strtotime($tgl_awal)),
			'tgl_akhir' => date("Y", strtotime($tgl_akhir))
		];

		$view = $this->load->view('dashboardAdmin/laporan/pdf/laporan-peminjaman', $dataView, true);
    // echo $view;
		$this->pdfgenerator->generate($view, "Laporan Pinjaman (".$tgl_awal." - ".$tgl_akhir.")");
	}

	// Laporan Pengembalian
	public function laporan_pengembalian_pdf()
	{
		$tgl_awal 			= $this->input->get("tgl_awal");
		$tgl_akhir 	 		= $this->input->get("tgl_akhir");

		$dataLaporan = $this->admin->laporan_pengembalian($tgl_awal, $tgl_akhir);

		$dataView = [
			'dataLaporan' => $dataLaporan,
			'tgl_awal' => date("Y", strtotime($tgl_awal)),
			'tgl_akhir' => date("Y", strtotime($tgl_akhir))
		];

		$view = $this->load->view('dashboardAdmin/laporan/pdf/laporan-pengembalian', $dataView, true);
    // echo $view;
		$this->pdfgenerator->generate($view, "Laporan Pengembalian (".$tgl_awal." - ".$tgl_akhir.")");
	}
}
