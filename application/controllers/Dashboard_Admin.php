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
			"pending" => $this->admin->pending_pinjaman(),
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
		$get = array(
			"count_anggota" => $this->admin->count_anggota(),
			"count_buku" => $this->admin->count_buku(),
			"count_supplier" => $this->admin->count_supplier(),
			"count_pinjaman" => $this->admin->count_pinjaman(),
			"count_pengembalian" => $this->admin->count_pengembalian(),
		);
		$path = "";
		$data = array(
			"page" => $this->load("Dashboard Admin", $path),
			"content" =>$this->load->view('dashboardAdmin/index', $get, true)
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

	public function tambahPinjaman()
	{
		$get = array(
			"anggota" => $this->admin->data_anggota(),
			"buku" => $this->admin->data_buku(),
			"no_pinjam" => $this->admin->getKodePinjaman(),
		);
		$path = "";
		$data = array(
			"page" => $this->load("Dashboard Admin - Tambah Pinjaman", $path),
			"content" =>$this->load->view('dashboardAdmin/tambah-pinjaman', $get, true)
		);
		$this->load->view('template/default_template', $data);
	}

	public function editPinjaman($no_pinjaman)
	{
		$get = array(
			"anggota" => $this->admin->data_anggota(),
			"buku" => $this->admin->data_buku(),
			"pinjaman" => $this->admin->data_peminjaman($no_pinjaman),
		);
		$path = "";
		$data = array(
			"page" => $this->load("Dashboard Admin - Edit Pinjaman", $path),
			"content" =>$this->load->view('dashboardAdmin/edit-pinjaman', $get, true)
		);
		$this->load->view('template/default_template', $data);
	}

	public function detailPinjaman($no_pinjaman)
	{
		$get = array(
			"pinjaman" => $this->admin->data_peminjaman($no_pinjaman),
			"detail" => $this->admin->detail_peminjaman($no_pinjaman),
		);
		$path = "";
		$data = array(
			"page" => $this->load("Dashboard Admin - Detail Pinjaman", $path),
			"content" =>$this->load->view('dashboardAdmin/detail-pinjaman', $get, true)
		);
		$this->load->view('template/default_template', $data);
	}

	public function cetakInvoice($no_pinjaman)
	{
		$get = array(
			"pinjaman" => $this->admin->data_peminjaman($no_pinjaman),
			"detail" => $this->admin->detail_peminjaman($no_pinjaman),
		);
		$this->load->view('dashboardAdmin/cetak-invoice', $get);
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

	public function tambahPengembalian()
	{
		$get = array(
			"pinjaman" => $this->admin->data_pinjaman(),
			"no_kembali" => $this->admin->getKodeKembali(),
		);
		$path = "";
		$data = array(
			"page" => $this->load("Dashboard Admin - Tambah Pengembalian", $path),
			"content" =>$this->load->view('dashboardAdmin/tambah-pengembalian', $get, true)
		);
		$this->load->view('template/default_template', $data);
	}

	public function cetakInvoiceKembali($no_kembali, $no_pinjaman)
	{
		$get = array(
			"pinjaman" => $this->admin->data_pengembalian($no_kembali),
			"detail" => $this->admin->detail_peminjaman($no_pinjaman),
		);
		$this->load->view('dashboardAdmin/cetak-invoice-kembali', $get);
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

	public function listUser()
	{	
		$get = "";
		$path = "";
		$data = array(
			"page" => $this->load("Dashboard Admin - Manajemen User", $path),
			"content" =>$this->load->view('dashboardAdmin/list-user', false, true)
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

	// Get Nama Buku
	public function getNamaBuku()
	{
		$id_buku = $this->input->post('id_buku');

		$data = $this->admin->get_nama_buku($id_buku);

		$output = array();
		$output['nama'] = $data->nama_buku;
		$output['stok'] = $data->stok;

		echo json_encode($output);

	}

	// Get Nama Peminjam
	public function getNamaPeminjam()
	{
		$no_pinjaman = $this->input->post('no_pinjaman');

		$data = $this->admin->data_peminjaman($no_pinjaman);

		$output = array();
		$output['nama_anggota'] = $data->nama_anggota;
		$output['tgl_pinjam'] = $data->tgl_pinjam;
		$output['no_anggota'] = $data->no_anggota;
		$output['total_pinjam'] = $data->total_pinjam;

		echo json_encode($output);

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
						'nama_buku' 	=> ucwords($nama_buku),
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
				$kode_buku 		= $this->input->post("edit_kode");
				$nama_buku 		= $this->input->post("edit_nama");
				$kategori 		= $this->input->post("edit_kategori");
				$pengarang 		= $this->input->post("edit_pengarang");
				$tahun_terbit 	= $this->input->post("edit_tahun");
				$deskripsi 		= $this->input->post("edit_deskripsi");
				$stok 			= $this->input->post("edit_stok");
				$id_supplier 	= $this->input->post("edit_supplier");

				if (empty($_FILES["file"]["name"])) {
					$data = array(
						'kode_buku' 	=> $kode_buku,
						'nama_buku' 	=> ucwords($nama_buku),
						'kategori' 		=> $kategori,
						'pengarang' 	=> $pengarang,
						'tahun_terbit' 	=> $tahun_terbit,
						'deskripsi' 	=> $deskripsi,
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
				} else {
					$_id = $this->db->get_where('table_buku',['id_buku' => $id_buku])->row();
					if (!empty($_id->gambar)) {
						unlink("./app-assets/upload/".$_id->gambar);
					}

					if(!$this->upload->do_upload('file')) {  
						$error =  $this->upload->display_errors(); 
						echo json_encode(array('message' => $error, 'error' => true));
					} else {  
						$data = $this->upload->data();
						$data = array(
							'kode_buku' 	=> $kode_buku,
							'nama_buku' 	=> ucwords($nama_buku),
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

			$key = 'my-perpus-super-secret-key';

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
				'password' 		=> $this->encryption->encrypt($password),
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
				$d_user = $this->db->delete('table_user',['no_anggota'=>$id_ref]);
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

	// Delete Supplier
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

	// Add User
	public function addUser()
	{
		try {
			$output = array('error' => false);
			date_default_timezone_set('Asia/Jakarta');
			$timestamp  		= date("Y-m-d H:i:s");

			$key = 'my-perpus-super-secret-key';

			$nama 			= $this->input->post('add_nama');
			$username		= $this->input->post('username');
			$email 			= $this->input->post('add_email');
			$level 			= $this->input->post('add_level');
			$password 		= $this->input->post('password');

			$data = array(
				'nama' 			=> ucwords($nama),
				'username' 		=> $username,
				'email' 		=> $email,
				'level' 		=> $level,
				'password' 		=> $this->encryption->encrypt($password),
				'date_created' 	=> $timestamp,
			);

			$add = $this->db->insert('table_user', $data);
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

	// Edit User
	public function editUser()
	{
		try {
			$output = array('error' => false);
			date_default_timezone_set('Asia/Jakarta');
			$timestamp  		= date("Y-m-d H:i:s");

			$key = 'my-perpus-super-secret-key';

			$id_user		= $this->input->post('edit_id');
			$nama 			= $this->input->post('edit_nama');
			$username		= $this->input->post('edit_username');
			$email 			= $this->input->post('edit_email');
			$level 			= $this->input->post('edit_level');
			$password 		= $this->input->post('edit_password');
			

			$data = array(
				'nama' 			=> ucwords($nama),
				'username' 		=> $username,
				'email' 		=> $email,
				'level' 		=> $level,
				'password' 		=> $this->encryption->encrypt($password),
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

	// Delete User
	public function deleteUser($id)
	{
		try {
			$output = array('error' => false);

			$id_ref = $id;
			$delete = $this->db->delete('table_user',['id_user'=>$id_ref]);

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


	// Add Cart
	public function addCart()
	{
		try {
			$output = array('error' => false);
			date_default_timezone_set('Asia/Jakarta');
			$timestamp  		= date("Y-m-d H:i:s");

			$no_anggota 	= $this->input->post('no_anggota');
			$id_buku		= $this->input->post('id_buku');
			$jumlah 		= $this->input->post('qty');
			$stok 			= $this->input->post('stok');

			$cek_jumlah = $this->admin->cekQtyJumlah($no_anggota)->row();
			$validasi = $this->admin->cekCart($no_anggota, $id_buku)->row();
			$sum_qty = $cek_jumlah->qty + $jumlah;
			if ($sum_qty > 3) {
				$output['error'] = true;
				$output['message'] = 'Jumlah Maksimal Buku Dipinjam Adalah 3';
			} else {
				if ($validasi) {
					$qty = $validasi->qty + $jumlah;
					if ($qty > $validasi->stok) {
						$output['error'] = true;
						$output['message'] = 'Stok Buku "'.$validasi->nama_buku.'" Hanya Ada '.$stok.'!';
					} else {
						if ($qty > 3) {
							$output['error'] = true;
							$output['message'] = 'Jumlah Maksimal Buku Dipinjam Adalah 3';
						} else {
							$id_cart = $validasi->id_cart;

							$data = array(
								'qty' 		=> $qty,
							);

							$this->db->where('id_cart', $id_cart);
							$this->db->update('table_cart', $data);
						}
					}
				} else {
					$qty = $jumlah;

					$data = array(
						'no_anggota' => $no_anggota,
						'id_buku' 	=> $id_buku,
						'qty' 		=> $qty,
					);

					$add = $this->db->insert('table_cart', $data);
				}
			}

			echo json_encode($output);

		} catch (Exception $e) {
			
		}
	}

	// Update Cart
	public function updateCart()
	{
		try {
			$output = array('error' => false);
			date_default_timezone_set('Asia/Jakarta');
			$timestamp  		= date("Y-m-d H:i:s");

			$id_cart 		= $this->input->post('id_cart');
			$no_anggota 	= $this->input->post('no_anggota');
			$id_buku 		= $this->input->post('id_buku');
			$jumlah 		= $this->input->post('qty');
			$qty_lama 		= $this->input->post('qty_lama');
			$stok 			= $this->input->post('stok');

			$cek_jumlah = $this->admin->cekQtyJumlah($no_anggota)->row();
			$validasi = $this->admin->cekCart($no_anggota, $id_buku)->row();
			$total = ($cek_jumlah->qty - $qty_lama) + $jumlah;

			if ($cek_jumlah->qty > 3) {
				$output['error'] = true;
				$output['message'] = 'Jumlah Maksimal Buku Dipinjam Adalah 3';
			} else {
				if ($jumlah > $validasi->stok) {
					$output['error'] = true;
					$output['message'] = 'Stok Buku "'.$validasi->nama_buku.'" Hanya Ada '.$stok.'!';
				} else {
					if ($total > 3) {
						$output['error'] = true;
						$output['message'] = 'Jumlah Maksimal Buku Dipinjam Adalah 3';
					} else {
						$data = array(
							'qty' 		=> $jumlah,
						);

						$this->db->where('id_cart', $id_cart);
						$this->db->update('table_cart', $data);

						$output['message'] = 'Data Berhasil Disimpan!';
					}
				}
			}

			echo json_encode($output);

		} catch (Exception $e) {

		}
	}

	// Delete Cart
	public function deleteCart($id)
	{
		try {
			$output = array('error' => false);

			$id_ref = $id;
			$delete = $this->db->delete('table_cart',['id_cart'=>$id_ref]);

			if ($delete == TRUE) {
				$output['message'] = 'Data has been deleted!';
			} else {
				$output['error'] = true;
				$output['message'] = 'Data Failed to Delete!';
			}

			echo json_encode($output);
		} catch (Exception $e) {

		}
	}

	// Kode Pinjaman
	public function kodePinjaman()
	{
		$no_pinjam = $this->admin->getKodePinjaman();
		echo $no_pinjam;
	}

	// Add Pinjaman
	public function addPinjaman()
	{
		try {
			$output = array('error' => false);
			date_default_timezone_set('Asia/Jakarta');
			$timestamp  		= date("Y-m-d H:i:s");

			$date 			= date("Y-m-d");
			$exp_date  		= date('Y-m-d', strtotime($date. ' + 7 days'));

			$no_pinjam		= $this->input->post('no_pinjam');
			$no_anggota 	= $this->input->post('no_anggota');

			$cek_jumlah = $this->admin->cekQtyJumlah($no_anggota)->row();
			$total_pinjam = $cek_jumlah->qty;

			$cart = $this->admin->dataCart($no_anggota)->result();
			$num = $this->admin->dataCart($no_anggota)->num_rows();

			$validasi = $this->admin->validasiPinjaman($no_anggota)->num_rows();
			if ($validasi > 0) {
				$output['error'] = true;
				$output['message'] = 'Anggota Yang Bersangkutan Masih Dalam Periode Pinjaman!';
			} else {
				if ($num < 1) {
					$output['error'] = true;
					$output['message'] = 'Buku Belum Didaftarkan';
				} else {
					foreach ($cart as $row) {

						$detail = array(
							'no_pinjaman'	=> $no_pinjam,
							'id_buku'		=> $row->id_buku,
							'qty'			=> $row->qty,
							'expired_date'	=> $exp_date,
							'denda'			=> 0,
							'status_detail'		=> 'Pinjam',
						);
						$data_detail[] = $detail;

						$stok = $row->stok - $row->qty;
						$d_stok = array(
							'id_buku'		=> $row->id_buku,
							'stok'			=> $stok,
						);
						$data_stok[] = $d_stok;
					}

					$data_pinjam = array(
						'no_pinjaman' 	=> $no_pinjam,
						'tgl_pinjam'	=> $timestamp,
						'no_anggota'	=> $no_anggota,
						'total_pinjam'	=> $total_pinjam,
						'status'		=> 'Dipinjam',
						'notif' 		=> '0',
					);

					$input_detail = $this->db->insert_batch('table_pinjaman_detail', $data_detail);
					if ($input_detail == TRUE) {
						$pinjam = $this->db->insert('table_pinjaman', $data_pinjam);
						if ($pinjam == TRUE) {
							$update_stok = $this->db->update_batch('table_buku', $data_stok, 'id_buku');
							if ($update_stok == TRUE) {
								$delete = $this->db->delete('table_cart',['no_anggota'=>$no_anggota]);
								$output['message'] = 'Data Berhasil Disimpan!';
							} else {
								$output['error'] = true;
								$output['message'] = 'Data Gagal Disimpan!';
							}
						} else {
							$output['error'] = true;
							$output['message'] = 'Data Gagal Disimpan!';
						}
					} else {
						$output['error'] = true;
						$output['message'] = 'Data Gagal Disimpan!';
					}
				}
			}

			echo json_encode($output);

		} catch (Exception $e) {

		}
	}

	// Update Pinjaman
	public function updatePinjaman()
	{
		try {
			$output = array('error' => false);
			date_default_timezone_set('Asia/Jakarta');
			$timestamp  		= date("Y-m-d H:i:s");

			$date 			= date("Y-m-d");
			$exp_date  		= date('Y-m-d', strtotime($date. ' + 7 days'));

			$no_pinjam		= $this->input->post('no_pinjam');
			$no_anggota 	= $this->input->post('no_anggota');

			$cek_jumlah = $this->admin->cekQtyDetail($no_pinjam)->row();
			$total_pinjam = $cek_jumlah->qty;

			$cart = $this->admin->dataDetail($no_anggota)->result();
			$num = $this->admin->dataDetail($no_anggota)->num_rows();

			$validasi = $this->admin->validasiPinjaman($no_anggota)->num_rows();
			if ($validasi > 0) {
				$output['error'] = true;
				$output['message'] = 'Anggota Yang Bersangkutan Masih Dalam Periode Pinjaman!';
			} else {
				if ($num < 1) {
					$output['error'] = true;
					$output['message'] = 'Buku Belum Didaftarkan';
				} else {
					foreach ($cart as $row) {

						$detail = array(
							'no_pinjaman'	=> $no_pinjam,
							'id_buku'		=> $row->id_buku,
							'qty'			=> $row->qty,
							'expired_date'	=> $exp_date,
							'denda'			=> 0,
							'status_detail'		=> 'Pinjam',
						);
						$data_detail[] = $detail;

						$stok = $row->stok - $row->qty;
						$d_stok = array(
							'id_buku'		=> $row->id_buku,
							'stok'			=> $stok,
						);
						$data_stok[] = $d_stok;
					}

					$data_pinjam = array(
						'no_pinjaman' 	=> $no_pinjam,
						'tgl_pinjam'	=> $timestamp,
						'no_anggota'	=> $no_anggota,
						'total_pinjam'	=> $total_pinjam,
						'status'		=> 'Dipinjam',
						'notif' 		=> '0',
					);

					$input_detail = $this->db->update_batch('table_pinjaman_detail', $data_detail, 'no_pinjaman');
					if ($input_detail == TRUE) {
						$this->db->where('no_pinjaman', $no_pinjam);
						$pinjam = $this->db->update('table_pinjaman', $data_pinjam);
						if ($pinjam == TRUE) {
							$update_stok = $this->db->update_batch('table_buku', $data_stok, 'id_buku');
							if ($update_stok == TRUE) {
								$delete = $this->db->delete('table_cart',['no_anggota'=>$no_anggota]);
								$output['message'] = 'Data Berhasil Disimpan!';
							} else {
								$output['error'] = true;
								$output['message'] = 'Data Gagal Disimpan!';
							}
						} else {
							$output['error'] = true;
							$output['message'] = 'Data Gagal Disimpan!';
						}
					} else {
						$output['error'] = true;
						$output['message'] = 'Data Gagal Disimpan!';
					}
				}
			}

			echo json_encode($output);

		} catch (Exception $e) {

		}
	}

	// Add Detail
	public function addDetail()
	{
		try {
			$output = array('error' => false);
			date_default_timezone_set('Asia/Jakarta');
			$timestamp  		= date("Y-m-d H:i:s");

			$date 			= date("Y-m-d");
			$exp_date  		= date('Y-m-d', strtotime($date. ' + 7 days'));

			$no_pinjaman 	= $this->input->post('no_pinjaman');
			$id_buku		= $this->input->post('id_buku');
			$jumlah 		= $this->input->post('qty');
			$stok 			= $this->input->post('stok');

			$cek_jumlah = $this->admin->cekQtyDetail($no_pinjaman)->row();
			$validasi = $this->admin->cekDetail($no_pinjaman, $id_buku)->row();
			$sum_qty = $cek_jumlah->qty + $jumlah;
			if ($sum_qty > 3) {
				$output['error'] = true;
				$output['message'] = 'Jumlah Maksimal Buku Dipinjam Adalah 3';
			} else {
				if ($validasi) {
					$qty = $validasi->qty + $jumlah;
					if ($qty > $validasi->stok) {
						$output['error'] = true;
						$output['message'] = 'Stok Buku "'.$validasi->nama_buku.'" Hanya Ada '.$stok.'!';
					} else {
						if ($qty >= 3) {
							$output['error'] = true;
							$output['message'] = 'Jumlah Maksimal Buku Dipinjam Adalah 3';
						} else {
							$id_detail = $validasi->id_detail;

							$data = array(
								'qty' 		=> $qty,
								'expired_date' 	=> $exp_date,
							);

							$this->db->where('id_detail', $id_detail);
							$this->db->update('table_pinjaman_detail', $data);
						}
					}
				} else {
					$qty = $jumlah;

					$data = array(
						'no_pinjaman' 	=> $no_pinjaman,
						'id_buku' 		=> $id_buku,
						'qty' 			=> $qty,
						'expired_date' 	=> $exp_date,
						'status_detail' => 'Proses',
					);

					$add = $this->db->insert('table_pinjaman_detail', $data);
				}
			}

			echo json_encode($output);

		} catch (Exception $e) {
			
		}
	}

	// Update Detail
	public function updateDetail()
	{
		try {
			$output = array('error' => false);
			date_default_timezone_set('Asia/Jakarta');
			$timestamp  		= date("Y-m-d H:i:s");

			$date 			= date("Y-m-d");
			$exp_date  		= date('Y-m-d', strtotime($date. ' + 7 days'));

			$id_detail 		= $this->input->post('id_detail');
			$no_pinjaman 	= $this->input->post('no_pinjaman');
			$id_buku 		= $this->input->post('id_buku');
			$jumlah 		= $this->input->post('qty');
			$qty_lama 		= $this->input->post('qty_lama');
			$stok 			= $this->input->post('stok');

			$cek_jumlah = $this->admin->cekQtyDetail($no_pinjaman)->row();
			$validasi = $this->admin->cekDetail($no_pinjaman, $id_buku)->row();
			$total = ($cek_jumlah->qty - $qty_lama) + $jumlah;

			if ($cek_jumlah->qty > 3) {
				$output['error'] = true;
				$output['message'] = 'Jumlah Maksimal Buku Dipinjam Adalah 3';
			} else {
				if ($jumlah > $validasi->stok) {
					$output['error'] = true;
					$output['message'] = 'Stok Buku "'.$validasi->nama_buku.'" Hanya Ada '.$stok.'!';
				} else {
					if ($total > 3) {
						$output['error'] = true;
						$output['message'] = 'Jumlah Maksimal Buku Dipinjam Adalah 3';
					} else {
						$data = array(
							'qty' 			=> $jumlah,
							'expired_date' 	=> $exp_date,
						);

						$this->db->where('id_detail', $id_detail);
						$this->db->update('table_pinjaman_detail', $data);

						$pinjam = array(
							'total_pinjam' 		=> $total,
						);
						$this->db->where('no_pinjaman', $no_pinjaman);
						$this->db->update('table_pinjaman', $pinjam);

						$output['message'] = 'Data Berhasil Disimpan!';
					}
				}
			}

			echo json_encode($output);

		} catch (Exception $e) {

		}
	}

	// Delete Detail
	public function deleteDetail($id)
	{
		try {
			$output = array('error' => false);

			$id_ref = $id;
			$delete = $this->db->delete('table_pinjaman_detail',['id_detail'=>$id_ref]);

			if ($delete == TRUE) {
				$output['message'] = 'Data has been deleted!';
			} else {
				$output['error'] = true;
				$output['message'] = 'Data Failed to Delete!';
			}

			echo json_encode($output);
		} catch (Exception $e) {

		}
	}

	// Approve Pinjaman
	public function approvePinjaman($id)
	{
		try {
			$output = array('error' => false);

			$id_ref = $id;
			$pinjam = array(
				'status' 		=> 'Approve by Admin',
				'notif' 		=> '1',
			);
			$this->db->where('no_pinjaman', $id_ref);
			$approve = $this->db->update('table_pinjaman', $pinjam);

			if ($approve == TRUE) {
				$detail = array(
					'status_detail' 		=> 'Proses',
				);
				$this->db->where('no_pinjaman', $id_ref);
				$approve = $this->db->update('table_pinjaman_detail', $detail);

				$output['message'] = 'Data Berhasil di Approve!';
			} else {
				$output['error'] = true;
				$output['message'] = 'Data Gagal di Approve!';
			}

			echo json_encode($output);
		} catch (Exception $e) {

		}
	}

	// Cancel Pinjaman
	public function cancelPinjaman($id)
	{
		try {
			$output = array('error' => false);

			$id_ref = $id;
			$pinjam = array(
				'status' 		=> 'Cancel by Admin',
			);
			$this->db->where('no_pinjaman', $id_ref);
			$approve = $this->db->update('table_pinjaman', $pinjam);

			if ($approve == TRUE) {
				$detail = array(
					'status_detail' 		=> 'Cancel',
				);
				$this->db->where('no_pinjaman', $id_ref);
				$approve = $this->db->update('table_pinjaman_detail', $detail);

				$output['message'] = 'Data Berhasil di Cancel!';
			} else {
				$output['error'] = true;
				$output['message'] = 'Data Gagal di Cancel!';
			}

			echo json_encode($output);
		} catch (Exception $e) {

		}
	}

	// Batal Pinjaman
	public function batalPinjaman($id)
	{
		try {
			$output = array('error' => false);

			$id_ref = $id;
			$pinjam = array(
				'status' 		=> 'Dibatalkan',
			);
			$this->db->where('no_pinjaman', $id_ref);
			$approve = $this->db->update('table_pinjaman', $pinjam);

			if ($approve == TRUE) {
				$detail = array(
					'status_detail' 		=> 'Batal',
				);
				$this->db->where('no_pinjaman', $id_ref);
				$approve = $this->db->update('table_pinjaman_detail', $detail);

				$output['message'] = 'Data Berhasil di Cancel!';
			} else {
				$output['error'] = true;
				$output['message'] = 'Data Gagal di Cancel!';
			}

			echo json_encode($output);
		} catch (Exception $e) {

		}
	}

	// Kode Pinjaman
	public function kodeKembali()
	{
		$no_kembali = $this->admin->getKodeKembali();
		echo $no_kembali;
	}

	// Add Pengembalian
	public function addPengembalian()
	{
		try {
			$output = array('error' => false);
			date_default_timezone_set('Asia/Jakarta');
			$timestamp  	= date("Y-m-d H:i:s");
			$date_now  		= date("Y-m-d");

			$no_pinjaman	= $this->input->post('no_pinjaman');
			$no_kembali 	= $this->input->post('no_kembali');
			$no_anggota 	= $this->input->post('no_anggota');
			$jumlah_kembali	= $this->input->post('kembali');
			$tgl_pinjam		= date('Y-m-d', strtotime($this->input->post('tgl_pinjam')));

			$buku = $this->admin->detail_peminjaman($no_pinjaman);
			foreach ($buku as $row) {

				$stok = $row->stok + $row->qty;
				$d_stok = array(
					'id_buku'		=> $row->id_buku,
					'stok'			=> $stok,
				);
				$data_stok[] = $d_stok;

				$exp_date = date('Y-m-d', strtotime($row->expired_date));

				$start_date = new DateTime($exp_date);
				$end_date = new DateTime($date_now);
				$interval = $start_date->diff($end_date);
				$selisih = intval($interval->days);

				if ($date_now <= $exp_date) {
					$denda = (float)(($selisih * 0) * $row->qty);
				} else {
					if ($selisih > 0) {
						$denda = (float)(($selisih * 500) * $row->qty);
					} else {
						$denda = (float)(($selisih * 0) * $row->qty);
					}
				}

				$detail = array(
					'id_detail' => $row->id_detail,
					'denda' => $denda,
					'status_detail' => 'Kembali',
				);
				$data_detail[] = $detail;
			}

			$pinjam = array(
				'status' 		=> 'Dikembalikan',
			);

			$pengembalian = array(
				'no_pengembalian' 	=> $no_kembali,
				'tgl_kembali' 		=> $timestamp,
				'no_pinjam' 		=> $no_pinjaman,
				'no_anggota' 		=> $no_anggota,
				'jumlah_kembali' 	=> $jumlah_kembali,
			);

			$detail_kembali = $this->db->update_batch('table_pinjaman_detail', $data_detail, 'id_detail');
			if ($detail_kembali == TRUE) {
				$update_stok = $this->db->update_batch('table_buku', $data_stok, 'id_buku');
				if ($update_stok == TRUE) {
					$this->db->where('no_pinjaman', $no_pinjaman);
					$kembali = $this->db->update('table_pinjaman', $pinjam);

					if ($kembali == TRUE) {
						$approve = $this->db->insert('table_pengembalian', $pengembalian);

						$output['message'] = 'Pinjaman Berhasil Dikembalikan!';
					} else {
						$output['error'] = true;
						$output['message'] = 'Pinjaman Gagal Dikembalikan!';
					}
				} else {
					$output['error'] = true;
					$output['message'] = 'Pinjaman Gagal Dikembalikan!';
				}
			} else {
				$output['error'] = true;
				$output['message'] = 'Pinjaman Gagal Dikembalikan!';
			}
			
			// $output['error'] = true;
			// $output['message'] = $selisih.' - '.$denda;
			

			echo json_encode($output);
		} catch (Exception $e) {

		}
	}

	// Hilangkan Notif
	public function notifNull(){
		try {
			$id = $this->input->post('id');

			$data = array(
				'notif'	=> '0',
			);  

			$update = $this->db->where('notif', $id);
			$this->db->update('table_pinjaman', $data);

			$arr = array('msg' => 'Data gagal disimpan', 'success' => false);

			if($update){
				$arr = array('msg' => 'Data berhasil disimpan', 'success' => true);
			}
			echo json_encode($arr);

		} catch (Exception $e) {
			
		}
	}
}
