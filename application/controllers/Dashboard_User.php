<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard_User extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_Login', 'login');
		$this->load->model('M_User', 'user');
		$this->load->model('M_Admin', 'admin');
		if ($this->session->has_userdata('logged_in') == TRUE) {
			if ($this->session->userdata('level_user') == '1') {
				redirect('Dashboard_Admin');
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
			"profile" => $this->user->my_profile($this->session->userdata('id_user')),
			"approve" => $this->user->approve_pinjaman($this->session->userdata('no_anggota')),
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
		$data1['bku'] = $this->user->data_buku_all();
		$data = array(
			"page" => $this->load("Dashboard User", $path),
			"content" =>$this->load->view('dashboardUser/index', $data1, true)
		);
		$this->load->view('template/default_template', $data);
	}

	public function Peminjaman()
	{
		$path = "";
		$data = array(
			"page" => $this->load("Dashboard User - Data Peminjaman", $path),
			"content" =>$this->load->view('dashboardUser/data-pinjaman', false, true)
		);
		$this->load->view('template/default_template', $data);
	}

	public function myCart()
	{
		$get = array(
			"anggota" => $this->session->userdata('no_anggota'),
			"buku" => $this->admin->data_buku(),
			"no_pinjam" => $this->admin->getKodePinjaman(),
		);
		$path = "";
		$data = array(
			"page" => $this->load("Dashboard User - Tambah Pinjaman", $path),
			"content" =>$this->load->view('dashboardUser/tambah-pinjaman', $get, true)
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
			"page" => $this->load("Dashboard User - Detail Pinjaman", $path),
			"content" =>$this->load->view('dashboardAdmin/detail-pinjaman', $get, true)
		);
		$this->load->view('template/default_template', $data);
	}

	public function myProfile()
	{	
		$get = array(
			"profile" => $this->user->my_profile($this->session->userdata('id_user')),
		);
		$path = "";
		$data = array(
			"page" => $this->load("Dashboard User - Profile", $path),
			"content" =>$this->load->view('dashboardUser/user-profile', $get, true)
		);
		$this->load->view('template/default_template', $data);
	}

	public function pencarian()
	{
		$css = "";
		$js = "";
		$path = "";
		$key = $this->input->GET('cari', TRUE);

		$data1['buku'] = $this->user->data_buku_cari($key);
		$data = array(
			"page" => $this->load("Dashboard User", $path),
			"content" =>$this->load->view('dashboardUser/pencarian', $data1, true)
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
			$no_hp 				= $this->input->post('edit_no_hp');
			$alamat 			= $this->input->post('edit_alamat');

			$data = array(
				'no_identitas' 		=> $no_identitas,
				'tanda_pengenal' 	=> $tanda_pengenal,
				'nama_anggota' 		=> ucwords($nama_anggota),
				'fakultas' 			=> ucwords($fakultas),
				'prodi' 			=> ucwords($prodi),
				'kelas' 			=> $kelas,
				'no_hp' 			=> $no_hp,
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

			$no_pinjam		= $this->admin->getKodePinjaman();
			$no_anggota 	= $this->input->post('no_anggota');

			$cek_jumlah = $this->admin->cekQtyJumlah($no_anggota)->row();
			$total_pinjam = $cek_jumlah->qty;

			$cart = $this->admin->dataCart($no_anggota)->result();
			$num = $this->admin->dataCart($no_anggota)->num_rows();

			$validasi = $this->admin->validasiPinjaman($no_anggota)->num_rows();
			if ($validasi > 0) {
				$output['error'] = true;
				$output['message'] = 'Anda Masih Dalam Masa Periode Pinjaman!';
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
							'status_detail'	=> 'Pending',
						);
						$data_detail[] = $detail;

					// $stok = $row->stok - $row->qty;
					// $d_stok = array(
					// 	'id_buku'		=> $row->id_buku,
					// 	'stok'			=> $stok,
					// );
					// $data_stok[] = $d_stok;
					}

					$data_pinjam = array(
						'no_pinjaman' 	=> $no_pinjam,
						'tgl_pinjam'	=> $timestamp,
						'no_anggota'	=> $no_anggota,
						'total_pinjam'	=> $total_pinjam,
						'status'		=> 'Pending',
						'notif' 		=> '1',
					);

					$input_detail = $this->db->insert_batch('table_pinjaman_detail', $data_detail);
					if ($input_detail == TRUE) {
						$pinjam = $this->db->insert('table_pinjaman', $data_pinjam);
						if ($pinjam == TRUE) {
						// $update_stok = $this->db->update_batch('table_buku', $data_stok, 'id_buku');
						// if ($update_stok == TRUE) {
							$delete = $this->db->delete('table_cart',['no_anggota'=>$no_anggota]);
							$output['message'] = 'Data Berhasil Disimpan!';
						// } else {
						// 	$output['error'] = true;
						// 	$output['message'] = 'Data Gagal Disimpan!';
						// }
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

	// Approve Pinjaman
	public function approvePinjaman($id)
	{
		try {
			$output = array('error' => false);

			$id_ref = $id;
			$pinjam = array(
				'status' 		=> 'Approve by Admin',
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

	// Hilangkan Notif
	public function notifNull(){
		try {
			$id = $this->input->post('id');
			$no_anggota = $this->input->post('no_anggota');

			$data = array(
				'notif'	=> '0',
			);  

			$update = $this->db->where('no_anggota', $no_anggota);
			$this->db->update('table_pinjaman', $data);

			$arr = array('msg' => 'Data gagal disimpan', 'success' => false);

			if($update){
				$arr = array('msg' => 'Data berhasil disimpan', 'success' => true);
			}
			echo json_encode($arr);

		} catch (Exception $e) {
			
		}
	}

	// Kartu Anggota
	public function kartu_anggota($no_anggota)
	{
		$this->load->library('Pdfkartu');

		$dataLaporan = $this->user->my_profile($no_anggota);

		$dataView = [
			'profile' => $dataLaporan,
		];

		$view = $this->load->view('dashboardUser/kartu-anggota', $dataView, true);
    // echo $view;
		$this->pdfkartu->generate($view, "Kartu Anggota - ".$no_anggota);
	}
}
