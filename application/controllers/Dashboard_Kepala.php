<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard_Kepala extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_Login', 'login');
		$this->load->model('M_Admin', 'admin');
		if ($this->session->has_userdata('logged_in') == TRUE) {
			if ($this->session->userdata('level_user') == '1') {
				redirect('Dashboard_Admin');
			}
			else if ($this->session->userdata('level_user') == '2') {
				redirect('Dashboard_User');
			}
		} else {
			redirect('Login');
		}
	}

	private function load($title = '', $datapath = '')
	{

		$get = array(
			"title" => $title,
			"profile" => $this->login->my_profile($this->session->userdata('id_user')),
		);

		$page = array(
			"head" => $this->load->view('template/head', $get, true),
			"sidebar" => $this->load->view('template/sidebar', $get, true),
			"navbar" => $this->load->view('template/navbar', $get, true),
			"meta" => $this->load->view('template/meta', false, true),
			"footer" => $this->load->view('template/footer', false, true),
			"js" => $this->load->view('template/js', false, true),
		);
		return $page;
	}

	public function index()
	{
		$css = "";
		$js = "";
		$path = "";
		$get = array(
			"count_anggota" => $this->admin->count_anggota(),
			"count_buku" => $this->admin->count_buku(),
			"count_supplier" => $this->admin->count_supplier(),
			"count_pinjaman" => $this->admin->count_pinjaman(),
			"count_pengembalian" => $this->admin->count_pengembalian(),
		);
		$data = array(
			"page" => $this->load("Dashboard Kepala", $path),
			"content" =>$this->load->view('dashboardKepala/index', $get, true)
		);
		$this->load->view('template/default_template', $data);
	}

	public function myProfile()
	{	
		$get = array(
			"profile" => $this->login->my_profile($this->session->userdata('id_user')),
		);
		$path = "";
		$data = array(
			"page" => $this->load("Dashboard Kepala - Profile", $path),
			"content" =>$this->load->view('user-profile', $get, true)
		);
		$this->load->view('template/default_template', $data);
	}

	public function laporanAnggota()
	{	
		$get = "";
		$path = "";
		$data = array(
			"page" => $this->load("Dashboard Admin - Laporan Anggota", $path),
			"content" =>$this->load->view('dashboardAdmin/laporan/laporan-anggota', false, true)
		);
		$this->load->view('template/default_template', $data);
	}

	public function laporanBuku()
	{	
		$get = "";
		$path = "";
		$data = array(
			"page" => $this->load("Dashboard Admin - Laporan Buku", $path),
			"content" =>$this->load->view('dashboardAdmin/laporan/laporan-buku', false, true)
		);
		$this->load->view('template/default_template', $data);
	}

	public function laporanPeminjaman()
	{	
		$get = "";
		$path = "";
		$data = array(
			"page" => $this->load("Dashboard Admin - Laporan Peminjaman", $path),
			"content" =>$this->load->view('dashboardAdmin/laporan/laporan-peminjaman', false, true)
		);
		$this->load->view('template/default_template', $data);
	}

	public function laporanPengembalian()
	{	
		$get = "";
		$path = "";
		$data = array(
			"page" => $this->load("Dashboard Admin - Laporan Pengembalian", $path),
			"content" =>$this->load->view('dashboardAdmin/laporan/laporan-pengembalian', false, true)
		);
		$this->load->view('template/default_template', $data);
	}
}
