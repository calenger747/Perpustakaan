<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard_Admin extends CI_Controller {

	public function __construct() { 
		parent::__construct();
		$this->load->model('M_Admin', 'admin');
		$this->load->model('M_Login', 'login');
		if ($this->session->has_userdata('logged_in') == TRUE) {
			if ($this->session->userdata('level_user') == '2') {
				redirect('Dashboard_User');
			}
			else if ($this->session->userdata('level_user') == '3') {
				redirect('Dashboard_Kepala');
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
		$data = array(
			"page" => $this->load("Dashboard Admin", $path),
			"content" =>$this->load->view('dashboardAdmin/index', false, true)
		);
		$this->load->view('template/default_template', $data);
	}

	public function Anggota()
	{
		$path = "";
		$data = array(
			"page" => $this->load("Dashboard Admin - Data Anggota", $path),
			"content" =>$this->load->view('dashboardAdmin/data-anggota', false, true)
		);
		$this->load->view('template/default_template', $data);
	}

	public function Buku()
	{

		$get = array(
			"kategori" => $this->admin->data_kategori(),
			"supplier" => $this->admin->data_supplier(),
		);
		$path = "";
		$data = array(
			"page" => $this->load("Dashboard Admin - Data Buku", $path),
			"content" =>$this->load->view('dashboardAdmin/data-buku', $get, true)
		);
		$this->load->view('template/default_template', $data);
	}

	public function kategoriBuku()
	{
		$path = "";
		$data = array(
			"page" => $this->load("Dashboard Admin - Data Kategori Buku", $path),
			"content" =>$this->load->view('dashboardAdmin/data-kategori-buku', false, true)
		);
		$this->load->view('template/default_template', $data);
	}

	public function Supplier()
	{
		$path = "";
		$data = array(
			"page" => $this->load("Dashboard Admin - Data Supplier", $path),
			"content" =>$this->load->view('dashboardAdmin/data-supplier', false, true)
		);
		$this->load->view('template/default_template', $data);
	}

	public function Peminjaman()
	{
		$path = "";
		$data = array(
			"page" => $this->load("Dashboard Admin - Data Peminjaman", $path),
			"content" =>$this->load->view('dashboardAdmin/data-peminjaman', false, true)
		);
		$this->load->view('template/default_template', $data);
	}

	public function Pengembalian()
	{
		$path = "";
		$data = array(
			"page" => $this->load("Dashboard Admin - Data Pengembalian", $path),
			"content" =>$this->load->view('dashboardAdmin/data-pengembalian', false, true)
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
			"page" => $this->load("Dashboard Admin - Profile", $path),
			"content" =>$this->load->view('user-profile', $get, true)
		);
		$this->load->view('template/default_template', $data);
	}

	// Add Kategori
	public function addKategori()
	{
		try {
			$output = array('error' => false);

			$nama_kategori 		= $this->input->post('add_nama_kategori');

			$data = array(
				'nama_kategori' 	=> $nama_kategori,
			);

			$add = $this->db->insert('table_kategori', $data);
			if ($add == TRUE) {
				$output['message'] = 'Data Berhasil Disimpan!';
			} else {
				$output['error'] = true;
				$output['message'] = 'Data Gagal Disimpan!';
			}

			echo json_encode($output);

		} catch (Exception $e) {
			
		}
	}

	// Edit Kategori
	public function editKategori()
	{
		try {
			$output = array('error' => false);

			$id_ref 		= $this->input->post('edit_id');
			$nama_kategori 	= $this->input->post('edit_nama_kategori');

			$data = array(
				'nama_kategori' 	=> $nama_kategori,
			);

			$this->db->where('id_kategori', $id_ref);
			$update = $this->db->update('table_kategori', $data);
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

	// Delete Kategori
	public function deleteKategori($id)
	{
		try {
			$output = array('error' => false);

			$id_ref = $id;
			$delete = $this->db->delete('table_kategori',['id_kategori'=>$id_ref]);

			if ($delete == TRUE) {
				$output['message'] = 'Data has been deleted!';
			} else {
				$output['error'] = true;
				$output['message'] = 'Data Failed to Delete!';
			}

			echo json_encode($output);
		} catch (Exception $e) {
			redirect('dashboard/category');
		}
	}

	// Add Buku
	public function addBuku()
	{
		try {
			if(isset($_FILES["file"]["name"])) {  
				$arr = array('error' => false);

				$config['upload_path'] = './app-assets/upload';  
				$config['allowed_types'] = 'jpg|jpeg|png|JPG|JPEG|PNG';  
				$this->load->library('upload', $config); 

				$kode_buku 		= $this->input->post("add_kode");
				$nama_buku 		= $this->input->post("add_nama");
				$kategori 		= $this->input->post("add_kategori");
				$pengarang 		= $this->input->post("add_pengarang");
				$tahun_terbit 	= $this->input->post("add_tahun");
				$deskripsi 		= $this->input->post("add_deskripsi");
				$stok 			= $this->input->post("add_stok");
				$id_supplier 	= $this->input->post("add_supplier");

				if(!$this->upload->do_upload('file')) {  
					$error =  $this->upload->display_errors(); 
					echo json_encode(array('message' => $error, 'error' => true));
				} else {  
					$data = $this->upload->data();
					$data = array(
						'kode_buku' 	=> $kode_buku,
						'nama_buku' 	=> $nama_buku,
						'kategori' 		=> $kategori,
						'pengarang' 	=> $pengarang,
						'tahun_terbit' 	=> $tahun_terbit,
						'deskripsi' 	=> $deskripsi,
						'gambar' 		=> $data['file_name'],
						'stok' 			=> $stok,
						'id_supplier' 	=> $id_supplier,
					);  
					$insert = $this->db->insert('table_buku', $data); 

					if ($insert == TRUE) {
						$arr = array('message' => 'Data Berhasil Disimpan', 'error' => false);
					} else {
						$arr = array('message' => 'Data Gagal Disimpan', 'error' => true);
					}
					echo json_encode($arr);
				}  
			}  

		} catch (Exception $e) {
			redirect('Dashboard/transaction');
		}
	}

	// Edit Buku
	public function editBuku()
	{
		try {
			if(isset($_FILES["file"]["name"])) {  
				$arr = array('error' => false);

				$config['upload_path'] = './app-assets/upload';  
				$config['allowed_types'] = 'jpg|jpeg|png|JPG|JPEG|PNG';  
				$this->load->library('upload', $config); 

				$id_buku 		= $this->input->post("edit_id");

				$_id = $this->db->get_where('table_buku',['id_buku' => $id_buku])->row();
				if ($_id->gambar != '') {
					unlink("./app-assets/upload/".$_id->gambar);
				}

				$kode_buku 		= $this->input->post("edit_kode");
				$nama_buku 		= $this->input->post("edit_nama");
				$kategori 		= $this->input->post("edit_kategori");
				$pengarang 		= $this->input->post("edit_pengarang");
				$tahun_terbit 	= $this->input->post("edit_tahun");
				$deskripsi 		= $this->input->post("edit_deskripsi");
				$stok 			= $this->input->post("edit_stok");
				$id_supplier 	= $this->input->post("edit_supplier");

				if(!$this->upload->do_upload('file')) {  
					$error =  $this->upload->display_errors(); 
					echo json_encode(array('message' => $error, 'error' => true));
				} else {  
					$data = $this->upload->data();
					$data = array(
						'kode_buku' 	=> $kode_buku,
						'nama_buku' 	=> $nama_buku,
						'kategori' 		=> $kategori,
						'pengarang' 	=> $pengarang,
						'tahun_terbit' 	=> $tahun_terbit,
						'deskripsi' 	=> $deskripsi,
						'gambar' 		=> $data['file_name'],
						'stok' 			=> $stok,
						'id_supplier' 	=> $id_supplier,
					);  
					$update = $this->db->where('kode_buku', $kode_buku);
					$this->db->update('table_buku', $data);

					if ($update == TRUE) {
						$arr = array('message' => 'Data Berhasil Disimpan', 'error' => false);
					} else {
						$arr = array('message' => 'Data Gagal Disimpan', 'error' => true);
					}
					echo json_encode($arr);
				}  
			}

		} catch (Exception $e) {
			
		}
	}

	// Delete Buku
	public function deleteBuku($id)
	{
		try {
			$output = array('error' => false);

			$id_ref = $id;
			$_id = $this->db->get_where('table_buku',['id_buku' => $id_ref])->row();
			$delete = $this->db->delete('table_buku',['id_buku'=>$id_ref]);

			if ($delete == TRUE) {
				if ($_id->gambar != '') {
					unlink("./app-assets/upload/".$_id->gambar);
				}
				$output['message'] = 'Data has been deleted!';
			} else {
				$output['error'] = true;
				$output['message'] = 'Data Failed to Delete!';
			}

			echo json_encode($output);
		} catch (Exception $e) {
			redirect('Buku');
		}
	}

	// Kode Anggota
	public function kodeAnggota()
	{
		$no_anggota = $this->admin->getKodeAnggota();
		echo json_encode($no_anggota);
	}

	// Add Anggota
	public function addAnggota()
	{
		try {
			$output = array('error' => false);
			date_default_timezone_set('Asia/Jakarta');
			$timestamp  		= date("Y-m-d H:i:s");

			// $no_anggota 		= $this->input->post('add_no_anggota');
			$no_anggota 		= $this->admin->getKodeAnggota();
			$tanda_pengenal		= $this->input->post('add_tipe');
			$no_identitas 		= $this->input->post('add_no_identitas');
			$nama_anggota 		= $this->input->post('add_nama');
			$kelas		 		= $this->input->post('add_kelas');
			$fakultas 			= $this->input->post('add_fakultas');
			$prodi 				= $this->input->post('add_prodi');
			$alamat 			= $this->input->post('add_alamat');

			$username 			= $this->input->post('username');
			$password		 	= $this->input->post('password');
			$confirm 			= $this->input->post('confirm');
			$no_telp 			= $this->input->post('add_telp');
			$email 				= $this->input->post('add_email');

			$data = array(
				'no_anggota' 		=> $no_anggota,
				'no_identitas' 		=> $no_identitas,
				'tanda_pengenal' 	=> $tanda_pengenal,
				'nama_anggota' 		=> ucwords($nama_anggota),
				'fakultas' 			=> ucwords($fakultas),
				'prodi' 			=> ucwords($prodi),
				'kelas' 			=> $kelas,
				'no_hp' 			=> $no_telp,
				'alamat' 			=> $alamat,
				'date_created' 		=> $timestamp,
			);

			$user = array(
				'username' 		=> $username,
				'password' 		=> md5($password),
				'nama' 			=> ucwords($nama_anggota),
				'email' 		=> $email,
				'level' 		=> '2',
				'no_anggota' 	=> $no_anggota,
				'date_created' 	=> $timestamp,
			);

			$add = $this->db->insert('table_anggota', $data);
			if ($add == TRUE) {
				$user = $this->db->insert('table_user', $user);
				if ($user == TRUE) {
					$output['message'] = 'Data Berhasil Disimpan!';
				} else {
					$output['error'] = true;
					$output['message'] = 'Data Gagal Disimpan!';
				}
			} else {
				$output['error'] = true;
				$output['message'] = 'Data Gagal Disimpan!';
			}

			echo json_encode($output);

		} catch (Exception $e) {
			
		}
	}

	// Edit Anggota
	public function editAnggota()
	{
		try {
			$output = array('error' => false);
			date_default_timezone_set('Asia/Jakarta');
			$timestamp  		= date("Y-m-d H:i:s");

			$no_anggota 		= $this->input->post('edit_no_anggota');
			$tanda_pengenal		= $this->input->post('edit_tipe');
			$no_identitas 		= $this->input->post('edit_no_identitas');
			$nama_anggota 		= $this->input->post('edit_nama');
			$kelas		 		= $this->input->post('edit_kelas');
			$fakultas 			= $this->input->post('edit_fakultas');
			$prodi 				= $this->input->post('edit_prodi');
			$alamat 			= $this->input->post('edit_alamat');

			$data = array(
				'no_identitas' 		=> $no_identitas,
				'tanda_pengenal' 	=> $tanda_pengenal,
				'nama_anggota' 		=> ucwords($nama_anggota),
				'fakultas' 			=> ucwords($fakultas),
				'prodi' 			=> ucwords($prodi),
				'kelas' 			=> $kelas,
				'alamat' 			=> $alamat,
			);

			$this->db->where('no_anggota', $no_anggota);
			$update = $this->db->update('table_anggota', $data);
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

	// Delete Anggota
	public function deleteAnggota($id)
	{
		try {
			$output = array('error' => false);

			$id_ref = $id;
			$_id = $this->db->get_where('table_anggota',['no_anggota' => $id_ref])->row();
			$delete = $this->db->delete('table_anggota',['no_anggota'=>$id_ref]);

			if ($delete == TRUE) {
				$output['message'] = 'Data has been deleted!';
			} else {
				$output['error'] = true;
				$output['message'] = 'Data Failed to Delete!';
			}

			echo json_encode($output);
		} catch (Exception $e) {
			redirect('dashboard/category');
		}
	}

	// Add Supplier
	public function addSupplier()
	{
		try {
			$output = array('error' => false);
			date_default_timezone_set('Asia/Jakarta');
			$timestamp  		= date("Y-m-d H:i:s");

			$nama_supplier 	= $this->input->post('add_nama');
			$no_telp		= $this->input->post('add_telp');
			$email 			= $this->input->post('add_email');
			$fax 			= $this->input->post('add_fax');
			$alamat 		= $this->input->post('add_alamat');

			$data = array(
				'nama_supplier' => strtoupper($nama_supplier),
				'no_telp' 		=> $no_telp,
				'email' 		=> $email,
				'fax' 			=> $fax,
				'alamat' 		=> $alamat,
				'date_created' 	=> $timestamp,
			);

			$add = $this->db->insert('table_supplier', $data);
			if ($add == TRUE) {
				$output['message'] = 'Data Berhasil Disimpan!';
			} else {
				$output['error'] = true;
				$output['message'] = 'Data Gagal Disimpan!';
			}

			echo json_encode($output);

		} catch (Exception $e) {
			
		}
	}

	// Edit Supplier
	public function editSupplier()
	{
		try {
			$output = array('error' => false);
			date_default_timezone_set('Asia/Jakarta');
			$timestamp  		= date("Y-m-d H:i:s");

			$id_supplier 	= $this->input->post('edit_id');

			$nama_supplier 	= $this->input->post('edit_nama');
			$no_telp		= $this->input->post('edit_telp');
			$email 			= $this->input->post('edit_email');
			$fax 			= $this->input->post('edit_fax');
			$alamat 		= $this->input->post('edit_alamat');

			$data = array(
				'nama_supplier' => strtoupper($nama_supplier),
				'no_telp' 		=> $no_telp,
				'email' 		=> $email,
				'fax' 			=> $fax,
				'alamat' 		=> $alamat,
			);

			$this->db->where('id_supplier', $id_supplier);
			$update = $this->db->update('table_supplier', $data);
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

	// Delete Anggota
	public function deleteSupplier($id)
	{
		try {
			$output = array('error' => false);

			$id_ref = $id;
			$delete = $this->db->delete('table_supplier',['id_supplier'=>$id_ref]);

			if ($delete == TRUE) {
				$output['message'] = 'Data has been deleted!';
			} else {
				$output['error'] = true;
				$output['message'] = 'Data Failed to Delete!';
			}

			echo json_encode($output);
		} catch (Exception $e) {
			redirect('dashboard/category');
		}
	}
}
