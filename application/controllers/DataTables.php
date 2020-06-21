<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DataTables extends CI_Controller {

	public function __construct() { 
		parent::__construct();
		$this->load->model('M_Admin', 'admin');
		$this->load->model('M_User', 'user');
	}

	// Data Kategori Buku
	public function showKategori()
	{
		$list = $this->admin->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $kategori) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $kategori->nama_kategori;
			$row[] = '<a
			href="javascript:void(0)"
			data-id_kategori="'.$kategori->id_kategori.'"
			data-nama="'.$kategori->nama_kategori.'"
			data-toggle="modal" data-target="#myEditKategori"
			title="Edit Data">
			<button class="btn btn-sm btn-success"><i class="fa fa-edit"></i></button>
			</a>
			<button
			class="btn btn-sm btn-danger hapus-kategori" 
			data-toggle="modal"
			id="id" 
			data-toggle="modal" 
			data-id_kategori="'.$kategori->id_kategori.'"
			title="Hapus Data">
			<i class="fa fa-trash"></i>
			</button>';

			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->admin->count_all(),
			"recordsFiltered" => $this->admin->count_filtered(),
			"data" => $data,
		);
        //output to json format
		echo json_encode($output);
	}

	// Data Buku
	public function showBuku()
	{
		$list = $this->admin->datatable_buku();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $buku) {
			if ($buku->gambar == NULL) {
				$gambar = '<span><img src="'.base_url().'app-assets/upload/default_buku.jpg" class="profile-img" alt="buku" style="width: 70px; height:70px;"></span>';
			} else {
				$gambar = '<span><img src="'.base_url().'app-assets/upload/'.$buku->gambar.'" class="profile-img" alt="buku" style="width: 70px; height:70px;"></span>';
			}

			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $gambar;
			$row[] = $buku->nama_buku;
			$row[] = $buku->nama_kategori;
			$row[] = $buku->pengarang;
			$row[] = $buku->tahun_terbit;
			$row[] = $buku->stok;
			$row[] = '<a
			href="javascript:void(0)"
			data-id_buku="'.$buku->id_buku.'"
			data-kode="'.$buku->kode_buku.'"
			data-nama="'.$buku->nama_buku.'"
			data-kategori="'.$buku->kategori.'"
			data-pengarang="'.$buku->pengarang.'"
			data-tahun_terbit="'.$buku->tahun_terbit.'"
			data-deskripsi="'.$buku->deskripsi.'"
			data-gambar="'.$buku->gambar.'"
			data-stok="'.$buku->stok.'"
			data-id_supplier="'.$buku->id_supplier.'"
			data-toggle="modal" data-target="#myEditBuku"
			title="Edit Data">
			<button class="btn btn-sm btn-success"><i class="fa fa-edit"></i></button>
			</a>
			<button
			class="btn btn-sm btn-danger hapus-buku" 
			data-toggle="modal"
			id="id" 
			data-toggle="modal" 
			data-id_buku="'.$buku->id_buku.'"
			title="Hapus Data">
			<i class="fa fa-trash"></i>
			</button>';

			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->admin->buku_all(),
			"recordsFiltered" => $this->admin->buku_filtered(),
			"data" => $data,
		);
        //output to json format
		echo json_encode($output);
	}

	// Data Anggota
	public function showAnggota()
	{
		$list = $this->admin->datatable_anggota();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $anggota) {
			$no++;
			$row = array();
			$row[] = $anggota->no_anggota;
			$row[] = $anggota->tanda_pengenal.' - '.$anggota->no_identitas;
			$row[] = $anggota->nama_anggota;
			$row[] = date('d M Y', strtotime($anggota->date_created));
			$row[] = '<a
			href="javascript:void(0)"
			data-no_anggota="'.$anggota->no_anggota.'"
			data-no_identitas="'.$anggota->no_identitas.'"
			data-tanda_pengenal="'.$anggota->tanda_pengenal.'"
			data-nama_anggota="'.$anggota->nama_anggota.'"
			data-fakultas="'.$anggota->fakultas.'"
			data-prodi="'.$anggota->prodi.'"
			data-kelas="'.$anggota->kelas.'"
			data-alamat="'.$anggota->alamat.'"
			data-toggle="modal" data-target="#myEditAnggota"
			title="Edit Data">
			<button class="btn btn-sm btn-success"><i class="fa fa-edit"></i></button>
			</a>
			<button
			class="btn btn-sm btn-danger hapus-anggota" 
			data-toggle="modal"
			id="id" 
			data-toggle="modal" 
			data-no_anggota="'.$anggota->no_anggota.'"
			title="Hapus Data">
			<i class="fa fa-trash"></i>
			</button>';

			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->admin->anggota_all(),
			"recordsFiltered" => $this->admin->anggota_filtered(),
			"data" => $data,
		);
        //output to json format
		echo json_encode($output);
	}

	// Data User
	public function showUser()
	{
		$session = $_POST['id_user'];

		$list = $this->admin->datatable_user();
		$data = array();
		$no = $_POST['start'];

		$key = 'my-perpus-super-secret-key';

		foreach ($list as $user) {
			$no++;

			if ($user->level == '1') {
				$level = 'Administrator';
			} else if ($user->level == '2') {
				$level = 'Anggota';
			} else if ($user->level == '3') {
				$level = 'Kepala Perpustakaan';
			}

			if ($session == $user->id_user) {
				$hapus = '';
			} else {
				$hapus = '<button
				class="btn btn-sm btn-danger hapus-user" 
				data-toggle="modal"
				id="id" 
				data-toggle="modal" 
				data-id_user="'.$user->id_user.'"
				title="Hapus Data">
				<i class="fa fa-trash"></i>
				</button>';
			}

			$row = array();
			$row[] = $no;
			$row[] = $user->username;
			$row[] = $user->nama;
			$row[] = $user->email;
			$row[] = $level;
			$row[] = '<a
			href="javascript:void(0)"
			data-id_user="'.$user->id_user.'"
			data-nama_user="'.$user->nama.'"
			data-email="'.$user->email.'"
			data-level="'.$user->level.'"
			data-username="'.$user->username.'"
			data-password="'.$this->encryption->decrypt($user->password).'"
			data-toggle="modal" data-target="#myEditUser"
			title="Edit Data">
			<button class="btn btn-sm btn-success"><i class="fa fa-edit"></i></button>
			</a>'.$hapus;

			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->admin->user_all(),
			"recordsFiltered" => $this->admin->user_filtered(),
			"data" => $data,
		);
        //output to json format
		echo json_encode($output);
	}

	// Data Supplier
	public function showSupplier()
	{
		$list = $this->admin->datatable_supplier();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $supplier) {
			$no++;

			if ($supplier->no_telp == '') {
				$telp = '-';
			} else {
				$telp = $supplier->no_telp;
			}

			if ($supplier->fax == '') {
				$fax = '-';
			} else {
				$fax = $supplier->fax;
			}

			$row = array();
			$row[] = $no;
			$row[] = $supplier->nama_supplier;
			$row[] = $supplier->email;
			$row[] = $telp.'/'.$fax;
			$row[] = $supplier->alamat;
			$row[] = '<a
			href="javascript:void(0)"
			data-id_supplier="'.$supplier->id_supplier.'"
			data-nama_supplier="'.$supplier->nama_supplier.'"
			data-email="'.$supplier->email.'"
			data-no_telp="'.$supplier->no_telp.'"
			data-fax="'.$supplier->fax.'"
			data-alamat="'.$supplier->alamat.'"
			data-toggle="modal" data-target="#myEditSupplier"
			title="Edit Data">
			<button class="btn btn-sm btn-success"><i class="fa fa-edit"></i></button>
			</a>
			<button
			class="btn btn-sm btn-danger hapus-supplier" 
			data-toggle="modal"
			id="id" 
			data-toggle="modal" 
			data-id_supplier="'.$supplier->id_supplier.'"
			title="Hapus Data">
			<i class="fa fa-trash"></i>
			</button>';

			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->admin->supplier_all(),
			"recordsFiltered" => $this->admin->supplier_filtered(),
			"data" => $data,
		);
        //output to json format
		echo json_encode($output);
	}

	// Data Pinjaman
	public function showPinjaman()
	{
		$list = $this->admin->datatable_pinjaman();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $pinjaman) {
			$no++;

			if ($pinjaman->status == 'Pending') {
				$approve = '<button
				class="btn btn-xs btn-info approve-pinjaman" 
				data-toggle="modal"
				id="id" 
				data-toggle="modal" 
				data-no_pinjaman="'.$pinjaman->no_pinjaman.'"
				data-total_pinjam="'.$pinjaman->total_pinjam.'"
				title="Approve Pinjaman">
				<i class="fa fa-check"></i>
				</button>
				<button
				class="btn btn-xs btn-warning cancel-pinjaman" 
				data-toggle="modal"
				id="id" 
				data-toggle="modal" 
				data-no_pinjaman="'.$pinjaman->no_pinjaman.'"
				title="Cancel Pinjaman">
				<i class="fa fa-times"></i>
				</button>';
			} else {
				$approve = '';
			}

			if ($pinjaman->status == 'Process' || $pinjaman->status == 'Approve by Admin') {
				$edit = '
				<a
				href="'.base_url().'Dashboard_Admin/editPinjaman/'.$pinjaman->no_pinjaman.'"
				title="Edit Data">
				<button class="btn btn-xs btn-success"><i class="fa fa-edit"></i></button>
				</a>';
			} else {
				$edit = '
				<a
				href="'.base_url().'Dashboard_Admin/detailPinjaman/'.$pinjaman->no_pinjaman.'"
				title="Detail Data">
				<button class="btn btn-xs btn-primary"><i class="fa fa-list"></i></button>
				</a>';
			}

			if ($pinjaman->status == 'Dipinjam') {
				$invoice = '<a
				href="'.base_url().'Dashboard_Admin/cetakInvoice/'.$pinjaman->no_pinjaman.'"
				title="Cetak Invoice" target="_blank">
				<button class="btn btn-xs btn-secondary"><i class="fa fa-print"></i></button>
				</a>';
			} else {
				$invoice = '';
			}

			$row = array();
			$row[] = $pinjaman->no_pinjaman;
			$row[] = $pinjaman->nama_anggota;
			$row[] = $pinjaman->total_pinjam;
			$row[] = date('d M Y', strtotime($pinjaman->tgl_pinjam));
			$row[] = $pinjaman->status;
			$row[] = $invoice.$edit.$approve;

			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->admin->pinjaman_all(),
			"recordsFiltered" => $this->admin->pinjaman_filtered(),
			"data" => $data,
		);
        //output to json format
		echo json_encode($output);
	}

	// Data Detail Pinjaman
	public function showDetailCart()
	{
		$list = $this->admin->datatable_detail_cart();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $detail_pinjaman) {
			$no++;
			$qty = '<input type="number" value="'.$detail_pinjaman->qty.'" id="qty'.$detail_pinjaman->id_cart.'" name="edit_qty" style="width: 100px;" min="1" max="3" data-id_cart="'.$detail_pinjaman->id_cart.'" data-no_anggota="'.$detail_pinjaman->no_anggota.'" data-id_buku="'.$detail_pinjaman->id_buku.'" data-stok="'.$detail_pinjaman->stok.'" data-qty="'.$detail_pinjaman->qty.'" class="form-control edit-qty">';
			$row = array();
			$row[] = $detail_pinjaman->kode_buku;
			$row[] = $detail_pinjaman->nama_buku;
			$row[] = $detail_pinjaman->nama_kategori;
			$row[] = $detail_pinjaman->pengarang;
			$row[] = $qty;
			$row[] = '
			<button type="button"
			class="btn btn-sm btn-danger hapus-keranjang" 
			data-toggle="modal" 
			data-id_cart="'.$detail_pinjaman->id_cart.'"
			title="Hapus Data">
			<i class="fa fa-trash"></i>
			</button>';

			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->admin->detail_cart_all(),
			"recordsFiltered" => $this->admin->detail_cart_filtered(),
			"data" => $data,
		);
        //output to json format
		echo json_encode($output);
	}

	// Data Detail Pinjaman
	public function showDetailPinjaman()
	{
		$list = $this->admin->datatable_detail_pinjaman();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $detail_pinjaman) {
			$no++;
			$qty = '<input type="number" value="'.$detail_pinjaman->qty.'" id="qty'.$detail_pinjaman->id_detail.'" name="edit_qty" style="width: 100px;" min="1" max="3" data-id_detail="'.$detail_pinjaman->id_detail.'" data-no_pinjaman="'.$detail_pinjaman->no_pinjaman.'" data-id_buku="'.$detail_pinjaman->id_buku.'" data-stok="'.$detail_pinjaman->stok.'" data-qty="'.$detail_pinjaman->qty.'" class="form-control edit-qty">';
			$row = array();
			$row[] = $detail_pinjaman->kode_buku;
			$row[] = $detail_pinjaman->nama_buku;
			$row[] = $detail_pinjaman->nama_kategori;
			$row[] = $detail_pinjaman->pengarang;
			$row[] = $detail_pinjaman->qty;
			

			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->admin->detail_pinjaman_all(),
			"recordsFiltered" => $this->admin->detail_pinjaman_filtered(),
			"data" => $data,
		);
        //output to json format
		echo json_encode($output);
	}

	// Data Detail Pinjaman
	public function showDetailKembali()
	{
		$list = $this->admin->datatable_detail_pinjaman();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $detail_pinjaman) {
			$no++;
			$row = array();
			$row[] = $detail_pinjaman->kode_buku;
			$row[] = $detail_pinjaman->nama_buku;
			$row[] = $detail_pinjaman->nama_kategori;
			$row[] = $detail_pinjaman->qty;
			$row[] = $detail_pinjaman->expired_date;
			$row[] = $detail_pinjaman->status_detail;

			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->admin->detail_pinjaman_all(),
			"recordsFiltered" => $this->admin->detail_pinjaman_filtered(),
			"data" => $data,
		);
        //output to json format
		echo json_encode($output);
	}

	// Data Pengembalian
	public function showPengembalian()
	{
		$list = $this->admin->datatable_pengembalian();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $pinjaman) {
			$no++;

			if ($pinjaman->status == 'Pending') {
				$approve = '<button
				class="btn btn-xs btn-info approve-pinjaman" 
				data-toggle="modal"
				id="id" 
				data-toggle="modal" 
				data-no_pinjaman="'.$pinjaman->no_pinjaman.'"
				data-total_pinjam="'.$pinjaman->total_pinjam.'"
				title="Approve Pinjaman">
				<i class="fa fa-check"></i>
				</button>
				<button
				class="btn btn-xs btn-warning cancel-pinjaman" 
				data-toggle="modal"
				id="id" 
				data-toggle="modal" 
				data-no_pinjaman="'.$pinjaman->no_pinjaman.'"
				title="Cancel Pinjaman">
				<i class="fa fa-times"></i>
				</button>';
			} else {
				$approve = '';
			}

			if ($pinjaman->status == 'Process' || $pinjaman->status == 'Approve by Admin') {
				$edit = '
				<a
				href="'.base_url().'Dashboard_Admin/editPinjaman/'.$pinjaman->no_pinjaman.'"
				title="Edit Data">
				<button class="btn btn-xs btn-success"><i class="fa fa-edit"></i></button>
				</a>';
			} else {
				$edit = '
				<a
				href="'.base_url().'Dashboard_Admin/detailPinjaman/'.$pinjaman->no_pinjaman.'"
				title="Detail Data">
				<button class="btn btn-xs btn-primary"><i class="fa fa-list"></i></button>
				</a>';
			}

			if ($pinjaman->status == 'Dipinjam') {
				$invoice = '<a
				href="'.base_url().'Dashboard_Admin/cetakInvoice/'.$pinjaman->no_pinjaman.'"
				title="Cetak Invoice" target="_blank">
				<button class="btn btn-xs btn-secondary"><i class="fa fa-print"></i></button>
				</a>';
			} else {
				$invoice = '';
			}

			if ($pinjaman->status == 'Dikembalikan') {
				$invoice_kembali = '<a
				href="'.base_url().'Dashboard_Admin/cetakInvoiceKembali/'.$pinjaman->no_pengembalian.'/'.$pinjaman->no_pinjaman.'"
				title="Cetak Invoice" target="_blank">
				<button class="btn btn-xs btn-secondary"><i class="fa fa-print"></i></button>
				</a>';
			} else {
				$invoice_kembali = '';
			}

			$row = array();
			$row[] = $pinjaman->no_pengembalian;
			$row[] = $pinjaman->nama_anggota;
			$row[] = $pinjaman->no_pinjaman;
			$row[] = $pinjaman->total_pinjam;
			$row[] = date('d M Y', strtotime($pinjaman->tgl_pinjam));
			$row[] = $pinjaman->status;
			$row[] = $invoice_kembali.$edit.$approve;

			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->admin->pengembalian_all(),
			"recordsFiltered" => $this->admin->pengembalian_filtered(),
			"data" => $data,
		);
        //output to json format
		echo json_encode($output);
	}

	// Laporan Anggota
	public function laporanAnggota()
	{
		$list = $this->admin->datatable_laporan_anggota();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $anggota) {
			$no++;

			$row = array();
			$row[] = $anggota->tahun;
			$row[] = $anggota->total;
			$row[] = $anggota->ktp;
			$row[] = $anggota->sim;
			$row[] = $anggota->paspor;
			$row[] = $anggota->ktm;
			$row[] = $anggota->reg_1;
			$row[] = $anggota->reg_2;
			$row[] = $anggota->reg_3;
			$row[] = $anggota->pascasarjana;
			$row[] = $anggota->umum;

			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->admin->laporan_anggota_all(),
			"recordsFiltered" => $this->admin->laporan_anggota_filtered(),
			"data" => $data,
		);
        //output to json format
		echo json_encode($output);
	}

	// Laporan Buku
	public function laporanBuku()
	{
		$list = $this->admin->datatable_laporan_buku();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $buku) {
			$no++;

			$row = array();
			$row[] = $buku->nama_kategori;
			$row[] = $buku->jumlah_buku;
			$row[] = $buku->stok;

			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->admin->laporan_buku_all(),
			"recordsFiltered" => $this->admin->laporan_buku_filtered(),
			"data" => $data,
		);
        //output to json format
		echo json_encode($output);
	}

	// Laporan Pinjaman
	public function laporanPinjaman()
	{
		$list = $this->admin->datatable_laporan_pinjaman();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $pinjaman) {
			$no++;

			$row = array();
			$row[] = $pinjaman->tahun;
			$row[] = $pinjaman->jan;
			$row[] = $pinjaman->feb;
			$row[] = $pinjaman->mar;
			$row[] = $pinjaman->apr;
			$row[] = $pinjaman->mei;
			$row[] = $pinjaman->jun;
			$row[] = $pinjaman->jul;
			$row[] = $pinjaman->agu;
			$row[] = $pinjaman->sep;
			$row[] = $pinjaman->okt;
			$row[] = $pinjaman->nop;
			$row[] = $pinjaman->des;

			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->admin->laporan_pinjaman_all(),
			"recordsFiltered" => $this->admin->laporan_pinjaman_filtered(),
			"data" => $data,
		);
        //output to json format
		echo json_encode($output);
	}

	// Laporan Pengembalian
	public function laporanPengembalian()
	{
		$list = $this->admin->datatable_laporan_pengembalian();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $pinjaman) {
			$no++;

			$row = array();
			$row[] = $pinjaman->tahun;
			$row[] = $pinjaman->jan;
			$row[] = $pinjaman->feb;
			$row[] = $pinjaman->mar;
			$row[] = $pinjaman->apr;
			$row[] = $pinjaman->mei;
			$row[] = $pinjaman->jun;
			$row[] = $pinjaman->jul;
			$row[] = $pinjaman->agu;
			$row[] = $pinjaman->sep;
			$row[] = $pinjaman->okt;
			$row[] = $pinjaman->nop;
			$row[] = $pinjaman->des;

			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->admin->laporan_pengembalian_all(),
			"recordsFiltered" => $this->admin->laporan_pengembalian_filtered(),
			"data" => $data,
		);
        //output to json format
		echo json_encode($output);
	}

	// USER
	// Data Pinjaman
	public function showPinjamanUser()
	{
		$no_anggota = $this->input->post('no_anggota');
		$list = $this->user->datatable_pinjaman_user($no_anggota);
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $pinjaman) {
			$no++;

			$detail = '
				<a
				href="'.base_url().'Dashboard_User/detailPinjaman/'.$pinjaman->no_pinjaman.'"
				title="Detail Data">
				<button class="btn btn-xs btn-primary"><i class="fa fa-list"></i></button>
				</a>';

			if ($pinjaman->status == 'Pending' || $pinjaman->status == 'Approve by Admin') {
				$batal = '<button
				class="btn btn-xs btn-danger batal-pinjaman" 
				data-toggle="modal"
				id="id" 
				data-toggle="modal" 
				data-no_pinjaman="'.$pinjaman->no_pinjaman.'"
				title="Batalkan Pinjaman">
				<i class="fa fa-times"></i>
				</button>';
			} else {
				$batal='';
			}

			if ($pinjaman->status == 'Dipinjam') {
				$invoice = '<a
				href="'.base_url().'Dashboard_Admin/cetakInvoice/'.$pinjaman->no_pinjaman.'"
				title="Cetak Invoice" target="_blank">
				<button class="btn btn-xs btn-secondary"><i class="fa fa-print"></i></button>
				</a>';
			} else {
				$invoice = '';
			}

			$row = array();
			$row[] = $pinjaman->no_pinjaman;
			$row[] = $pinjaman->nama_anggota;
			$row[] = $pinjaman->total_pinjam;
			$row[] = date('d M Y', strtotime($pinjaman->tgl_pinjam));
			$row[] = $pinjaman->status;
			$row[] = $invoice.$detail.$batal;

			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->user->user_pinjaman_all($no_anggota),
			"recordsFiltered" => $this->user->user_pinjaman_filtered($no_anggota),
			"data" => $data,
		);
        //output to json format
		echo json_encode($output);
	}

}
