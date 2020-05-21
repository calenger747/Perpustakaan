<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DataTables extends CI_Controller {

	public function __construct() { 
		parent::__construct();
		$this->load->model('M_Admin', 'admin');
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

	// Data Anggota
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
}
