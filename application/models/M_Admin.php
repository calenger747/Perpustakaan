<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class M_Admin extends CI_Model{ 

    var $table_1 = 'table_kategori'; 
    var $column_order_1 = array('nama_kategori'); //set column field database for datatable orderable 
    var $column_search_1 = array('nama_kategori'); //set column field database for datatable searchable 
    var $order_1 = array('id_kategori' => 'ASC'); // default order 

    var $table_2 = 'table_buku';
    var $table_2_2 = 'table_kategori'; 
    var $column_order_2 = array('kode_buku','nama_buku','nama_kategori','pengarang','tahun_terbit'); //set column field database for datatable orderable 
    var $column_search_2 = array('kode_buku','nama_buku','nama_kategori','pengarang','tahun_terbit'); //set column field database for datatable searchable 
    var $order_2 = array('id_buku' => 'ASC'); // default order 

    var $table_3 = 'table_anggota'; 
    var $column_order_3 = array('no_anggota','no_identitas','tanda_pengenal','nama_anggota','fakultas','prodi','kelas','alamat','date_created'); //set column field database for datatable orderable 
    var $column_search_3 = array('no_anggota','no_identitas','tanda_pengenal','nama_anggota','fakultas','prodi','kelas','alamat','DATE_FORMAT(date_created, "%d %b %Y")'); //set column field database for datatable searchable 
    var $order_3 = array('no_anggota' => 'ASC'); // default order 

    var $table_4 = 'table_supplier'; 
    var $column_order_4 = array('nama_supplier','email','no_telp','fax','alamat'); //set column field database for datatable orderable 
    var $column_search_4 = array('nama_supplier','email','no_telp','fax','alamat'); //set column field database for datatable searchable 
    var $order_4 = array('id_supplier' => 'ASC'); // default order 

    var $table_5 = 'table_user'; 
    var $column_order_5 = array('nama','email','username','level'); //set column field database for datatable orderable 
    var $column_search_5 = array('nama','email','username','level'); //set column field database for datatable searchable 
    var $order_5 = array('id_user' => 'ASC'); // default order 

    var $table_6 = 'table_pinjaman'; 
    var $table_6_2 = 'table_anggota';
    var $column_order_6 = array('no_pinjaman','nama_anggota','total_pinjam','tgl_pinjam'); //set column field database for datatable orderable 
    var $column_search_6 = array('no_pinjaman','nama_anggota','total_pinjam','DATE_FORMAT(tgl_pinjam, "%d %b %Y")'); //set column field database for datatable searchable 
    var $order_6 = array('no_pinjaman' => 'ASC'); // default order 

    var $table_7 = 'table_pinjaman'; 
    var $table_7_2 = 'table_pinjaman_detail';
    var $table_7_3 = 'table_buku';
    var $table_7_4 = 'table_kategori';
    var $column_order_7 = array('kode_buku','nama_buku','nama_kategori','pengarang','qty'); //set column field database for datatable orderable 
    var $column_search_7 = array('kode_buku','nama_buku','nama_kategori','pengarang','qty'); //set column field database for datatable searchable 
    var $order_7 = array('id_detail' => 'ASC'); // default order 

    var $table_8 = 'table_cart'; 
    var $table_8_2 = 'table_anggota';
    var $table_8_3 = 'table_buku';
    var $table_8_4 = 'table_kategori';
    var $column_order_8 = array('kode_buku','nama_buku','nama_kategori','pengarang','qty'); //set column field database for datatable orderable 
    var $column_search_8 = array('kode_buku','nama_buku','nama_kategori','pengarang','qty'); //set column field database for datatable searchable 
    var $order_8 = array('id_cart' => 'ASC'); // default order

    var $table_9 = 'table_pengembalian'; 
    var $table_9_2 = 'table_pinjaman';
    var $table_9_3 = 'table_anggota';
    var $column_order_9 = array('no_pengembalian','nama_anggota','no_pinjaman','tgl_kembali','jumlah_kembali'); //set column field database for datatable orderable 
    var $column_search_9 = array('no_pengembalian','nama_anggota','no_pinjaman','DATE_FORMAT(tgl_kembali, "%d %b %Y")','jumlah_kembali'); //set column field database for datatable searchable 
    var $order_9 = array('no_pengembalian' => 'ASC'); // default order

    var $table_a = 'table_anggota';
    var $column_order_a = array('date_created'); //set column field database for datatable orderable 
    var $column_search_a = array('DATE_FORMAT(date_created, "%Y")'); //set column field database for datatable searchable 
    var $order_a = array('date_created' => 'ASC'); // default order

    var $table_b = 'table_kategori';
    var $table_b_2 = 'table_buku';
    var $column_order_b = array('nama_kategori'); //set column field database for datatable orderable 
    var $column_search_b = array('nama_kategori'); //set column field database for datatable searchable 
    var $order_b = array('nama_kategori' => 'ASC'); // default order

    var $table_c = 'table_pinjaman';
    var $column_order_c = array('tgl_pinjam'); //set column field database for datatable orderable 
    var $column_search_c = array('DATE_FORMAT(tgl_pinjam, "%Y")'); //set column field database for datatable searchable 
    var $order_c = array('tgl_pinjam' => 'ASC'); // default order

    var $table_d = 'table_pengembalian';
    var $column_order_d = array('tgl_kembali'); //set column field database for datatable orderable 
    var $column_search_d = array('DATE_FORMAT(tgl_kembali, "%Y")'); //set column field database for datatable searchable 
    var $order_d = array('tgl_kembali' => 'ASC'); // default order

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    // Pinjaman Pending
    public function pending_pinjaman(){
        $query = $this->db->query("SELECT * FROM table_pinjaman WHERE status = 'Pending' AND notif = '1'");
        return $query->num_rows();
    }

    // Data Kategori
    public function data_kategori()
    {
        $query = $this->db->query("SELECT * FROM table_kategori ORDER BY nama_kategori ASC");

        return $query->result();
    }

    // Get Kode Anggota Terakhir
    public function getKodeAnggota()
    {
        $year = date("Y");
        $month = date("m");
        $query = $this->db->query("SELECT MAX(no_anggota) AS kd_max FROM table_anggota WHERE YEAR(date_created) = '$year' AND MONTH(date_created) = '$month'");

        $buku = "ANG";
        $kd = "";
        if($query->num_rows() > 0){
            foreach($query->result() as $k){
                $tmp = $k->kd_max;
                $noUrut = (float)(substr($tmp,3,4)) + 1;
                $kd = sprintf("%04s", $noUrut);
            }
        }else{
            $kd = "0001";
        }
        

        $output = $buku.$kd.'-'.$month.$year;
        // $output = $kd;
        return $output;
    }

    // Data Supplier
    public function data_supplier()
    {
        $query = $this->db->query("SELECT * FROM table_supplier ORDER BY nama_supplier ASC");

        return $query->result();
    }

    // Data Anggota
    public function data_anggota()
    {
        $query = $this->db->query("SELECT * FROM table_anggota ORDER BY nama_anggota ASC");

        return $query->result();
    }

    // Get Kode Pinjaman Terakhir
    public function getKodePinjaman()
    {
        $year = date("Y");
        $month = date("m");
        $query = $this->db->query("SELECT MAX(no_pinjaman) AS kd_max FROM table_pinjaman WHERE YEAR(tgl_pinjam) = '$year' AND MONTH(tgl_pinjam) = '$month'");

        $pinjam = "PJM";
        $kd = "";
        if($query->num_rows() > 0){
            foreach($query->result() as $k){
                $tmp = $k->kd_max;
                $noUrut = (float)(substr($tmp,3,4)) + 1;
                $kd = sprintf("%04s", $noUrut);
            }
        }else{
            $kd = "0001";
        }
        

        $output = $pinjam.$kd.'-'.$month.$year;
        // $output = $kd;
        return $output;
    }

    // Get Kode Pengembalian Terakhir
    public function getKodeKembali()
    {
        $year = date("Y");
        $month = date("m");
        $query = $this->db->query("SELECT MAX(no_pengembalian) AS kd_max FROM table_pengembalian WHERE YEAR(tgl_kembali) = '$year' AND MONTH(tgl_kembali) = '$month'");

        $kembali = "KMB";
        $kd = "";
        if($query->num_rows() > 0){
            foreach($query->result() as $k){
                $tmp = $k->kd_max;
                $noUrut = (float)(substr($tmp,3,4)) + 1;
                $kd = sprintf("%04s", $noUrut);
            }
        }else{
            $kd = "0001";
        }
        

        $output = $kembali.$kd.'-'.$month.$year;
        // $output = $kd;
        return $output;
    }

    // Data Buku
    public function data_buku()
    {
        $query = $this->db->query("SELECT * FROM table_buku ORDER BY kode_buku ASC");

        return $query->result();
    }

    // Get Nama Buku
    public function get_nama_buku($id_buku)
    {
        $query = $this->db->query("SELECT * FROM table_buku WHERE id_buku = '$id_buku'");        
        return $output = $query->row();
    }

    // Cek QTY 
    public function cekQtyJumlah($no_anggota) {
        $query = $this->db->query("SELECT SUM(qty) AS qty FROM table_cart WHERE no_anggota = '$no_anggota'");
        return $query;
    }

    // Cek QTY Detail
    public function cekQtyDetail($no_pinjaman) {
        $query = $this->db->query("SELECT SUM(qty) AS qty FROM table_pinjaman_detail WHERE no_pinjaman = '$no_pinjaman'");
        return $query;
    }


    // Validasi Cart
    public function cekCart($no_anggota, $id_buku) {
        $query = $this->db->query("SELECT * FROM table_cart AS a JOIN table_buku AS b ON a.id_buku = b.id_buku WHERE a.no_anggota = '$no_anggota' AND a.id_buku = '$id_buku' ");
        return $query;
    }

    // Validasi Detail
    public function cekDetail($no_pinjaman, $id_buku) {
        $query = $this->db->query("SELECT * FROM table_pinjaman_detail AS a JOIN table_buku AS b ON a.id_buku = b.id_buku WHERE a.no_pinjaman = '$no_pinjaman' AND a.id_buku = '$id_buku' ");
        return $query;
    }

    // Data Cart
    public function dataCart($no_anggota) {
        $query = $this->db->query("SELECT * FROM table_cart AS a JOIN table_buku AS b ON a.id_buku = b.id_buku WHERE a.no_anggota = '$no_anggota'");
        return $query;
    }

    // Data Detail
    public function dataDetail($no_anggota) {
        $query = $this->db->query("SELECT * FROM table_pinjaman_detail AS a JOIN table_pinjaman AS b ON a.no_pinjaman = b.no_pinjaman JOIN table_buku AS c ON a.id_buku = c.id_buku WHERE b.no_anggota = '$no_anggota'");
        return $query;
    }

    // Data Peminjaman
    public function data_peminjaman($no_pinjaman) {
        $query = $this->db->query("SELECT * FROM table_pinjaman AS a JOIN table_anggota AS b ON a.no_anggota = b.no_anggota WHERE a.no_pinjaman = '$no_pinjaman'");
        return $query->row();
    }

    // Data Peminjaman
    public function data_pengembalian($no_kembali) {
        $query = $this->db->query("SELECT * FROM table_pengembalian AS a JOIN table_anggota AS b ON a.no_anggota = b.no_anggota JOIN table_pinjaman AS c ON a.no_pinjam = c.no_pinjaman WHERE a.no_pengembalian = '$no_kembali'");
        return $query->row();
    }

    // Detail Pinjaman
    public function detail_peminjaman($no_pinjaman) {
        $query = $this->db->query("SELECT * FROM table_pinjaman AS a JOIN table_pinjaman_detail AS b ON a.no_pinjaman = b.no_pinjaman JOIN table_buku AS c ON b.id_buku = c.id_buku JOIN table_kategori AS d ON c.kategori = d.id_kategori WHERE a.no_pinjaman = '$no_pinjaman'");
        return $query->result();
    }

    // Validasi Peminjaman
    public function validasiPinjaman($no_anggota) {
        $query = $this->db->query("SELECT * FROM table_pinjaman WHERE no_anggota = '$no_anggota' AND status='Dipinjam' ");
        return $query;
    }

    // Data Pinjaman
    public function data_pinjaman()
    {
        $query = $this->db->query("SELECT * FROM table_pinjaman WHERE status='Dipinjam' ORDER BY no_pinjaman ASC");

        return $query->result();
    }

    // Count Anggota
    public function count_anggota()
    {
        $query = $this->db->query("SELECT * FROM table_anggota");

        return $query->num_rows();
    }

    // Count Buku
    public function count_buku()
    {
        $query = $this->db->query("SELECT * FROM table_buku");

        return $query->num_rows();
    }

    // Count Supplier
    public function count_supplier()
    {
        $query = $this->db->query("SELECT * FROM table_supplier");

        return $query->num_rows();
    }

    // Count Pinjaman
    public function count_pinjaman()
    {
        $query = $this->db->query("SELECT * FROM table_pinjaman");

        return $query->num_rows();
    }

    // Count Pengembalian
    public function count_pengembalian()
    {
        $query = $this->db->query("SELECT * FROM table_pengembalian");

        return $query->num_rows();
    }

    private function _get_datatables_query()
    {

        $this->db->from($this->table_1);
        $this->db->order_by('id_kategori','DESC');

        $i = 0;

        foreach ($this->column_search_1 as $item) // loop column 
        {
            if($_POST['search']['value']) // if datatable send POST for search
            {

                if($i===0) // first loop
                {
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                }
                else
                {
                    $this->db->or_like($item, $_POST['search']['value']);
                }

                if(count($this->column_search_1) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
                }
                $i++;
            }

        if(isset($_POST['order_1'])) // here order processing
        {
            $this->db->order_by($this->column_order_1[$_POST['order_1']['0']['column_1']], $_POST['order_1']['0']['dir']);
        } 
        else if(isset($this->order_1))
        {
            $order_1 = $this->order_1;
            $this->db->order_by(key($order_1), $order_1[key($order_1)]);
        }
    }

    function get_datatables()
    {
        $this->_get_datatables_query();
        if($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    function count_filtered()
    {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all()
    {
        $this->db->from($this->table_1);
        return $this->db->count_all_results();
    }

    // Data Buku
    private function buku_query()
    {

        $this->db->from($this->table_2);
        $this->db->join($this->table_2_2, $this->table_2.'.kategori ='.$this->table_2_2.'.id_kategori');
        $this->db->order_by('id_buku','DESC');

        $i = 0;

        foreach ($this->column_search_2 as $item) // loop column 
        {
            if($_POST['search']['value']) // if datatable send POST for search
            {

                if($i===0) // first loop
                {
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                }
                else
                {
                    $this->db->or_like($item, $_POST['search']['value']);
                }

                if(count($this->column_search_2) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
                }
                $i++;
            }

        if(isset($_POST['order_2'])) // here order processing
        {
            $this->db->order_by($this->column_order_2[$_POST['order_2']['0']['column_2']], $_POST['order_2']['0']['dir']);
        } 
        else if(isset($this->order_2))
        {
            $order_2 = $this->order_2;
            $this->db->order_by(key($order_2), $order_2[key($order_2)]);
        }
    }

    function datatable_buku()
    {
        $this->buku_query();
        if($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    function buku_filtered()
    {
        $this->buku_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function buku_all()
    {
        $this->db->from($this->table_2);
        $this->db->join($this->table_2_2, $this->table_2.'.kategori ='.$this->table_2_2.'.id_kategori');
        return $this->db->count_all_results();
    }

    // Data Anggota
    private function anggota_query()
    {

        $this->db->from($this->table_3);
        $this->db->order_by('no_anggota','DESC');

        $i = 0;

        foreach ($this->column_search_3 as $item) // loop column 
        {
            if($_POST['search']['value']) // if datatable send POST for search
            {

                if($i===0) // first loop
                {
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                }
                else
                {
                    $this->db->or_like($item, $_POST['search']['value']);
                }

                if(count($this->column_search_3) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
                }
                $i++;
            }

        if(isset($_POST['order_3'])) // here order processing
        {
            $this->db->order_by($this->column_order_3[$_POST['order_3']['0']['column_3']], $_POST['order_3']['0']['dir']);
        } 
        else if(isset($this->order_3))
        {
            $order_3 = $this->order_3;
            $this->db->order_by(key($order_3), $order_3[key($order_3)]);
        }
    }

    function datatable_anggota()
    {
        $this->anggota_query();
        if($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    function anggota_filtered()
    {
        $this->anggota_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function anggota_all()
    {
        $this->db->from($this->table_3);
        return $this->db->count_all_results();
    }

    // Data Supplier
    private function supplier_query()
    {

        $this->db->from($this->table_4);
        $this->db->order_by('id_supplier','DESC');

        $i = 0;

        foreach ($this->column_search_4 as $item) // loop column 
        {
            if($_POST['search']['value']) // if datatable send POST for search
            {

                if($i===0) // first loop
                {
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                }
                else
                {
                    $this->db->or_like($item, $_POST['search']['value']);
                }

                if(count($this->column_search_4) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
                }
                $i++;
            }

        if(isset($_POST['order_4'])) // here order processing
        {
            $this->db->order_by($this->column_order_4[$_POST['order_4']['0']['column_4']], $_POST['order_4']['0']['dir']);
        } 
        else if(isset($this->order_4))
        {
            $order_4 = $this->order_4;
            $this->db->order_by(key($order_4), $order_4[key($order_4)]);
        }
    }

    function datatable_supplier()
    {
        $this->supplier_query();
        if($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    function supplier_filtered()
    {
        $this->supplier_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function supplier_all()
    {
        $this->db->from($this->table_4);
        return $this->db->count_all_results();
    }

    // Data User
    private function user_query()
    {

        $this->db->from($this->table_5);
        $this->db->order_by('id_user','ASC');

        $i = 0;

        foreach ($this->column_search_5 as $item) // loop column 
        {
            if($_POST['search']['value']) // if datatable send POST for search
            {

                if($i===0) // first loop
                {
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                }
                else
                {
                    $this->db->or_like($item, $_POST['search']['value']);
                }

                if(count($this->column_search_5) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
                }
                $i++;
            }

        if(isset($_POST['order_5'])) // here order processing
        {
            $this->db->order_by($this->column_order_5[$_POST['order_5']['0']['column_5']], $_POST['order_5']['0']['dir']);
        } 
        else if(isset($this->order_5))
        {
            $order_5 = $this->order_5;
            $this->db->order_by(key($order_5), $order_5[key($order_5)]);
        }
    }

    function datatable_user()
    {
        $this->user_query();
        if($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    function user_filtered()
    {
        $this->user_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function user_all()
    {
        $this->db->from($this->table_5);
        return $this->db->count_all_results();
    }

    // Data Pinjaman
    private function pinjaman_query()
    {
        $this->db->where($this->table_6.".status != 'Dikembalikan'");
        $this->db->from($this->table_6);
        $this->db->join($this->table_6_2, $this->table_6.'.no_anggota ='.$this->table_6_2.'.no_anggota');
        $this->db->order_by('no_pinjaman','DESC');

        $i = 0;

        foreach ($this->column_search_6 as $item) // loop column 
        {
            if($_POST['search']['value']) // if datatable send POST for search
            {

                if($i===0) // first loop
                {
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                }
                else
                {
                    $this->db->or_like($item, $_POST['search']['value']);
                }

                if(count($this->column_search_6) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
                }
                $i++;
            }

        if(isset($_POST['order_6'])) // here order processing
        {
            $this->db->order_by($this->column_order_6[$_POST['order_6']['0']['column_6']], $_POST['order_6']['0']['dir']);
        } 
        else if(isset($this->order_6))
        {
            $order_6 = $this->order_6;
            $this->db->order_by(key($order_6), $order_6[key($order_6)]);
        }
    }

    function datatable_pinjaman()
    {
        $this->pinjaman_query();
        if($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    function pinjaman_filtered()
    {
        $this->pinjaman_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function pinjaman_all()
    {
        $this->db->where($this->table_6.".status != 'Dikembalikan'");
        $this->db->from($this->table_6);
        $this->db->join($this->table_6_2, $this->table_6.'.no_anggota ='.$this->table_6_2.'.no_anggota');
        return $this->db->count_all_results();
    }

    // Data Detail Pinjaman
    private function detail_pinjaman_query()
    {

        $this->db->where($this->table_7.'.no_pinjaman', $this->input->post('no_pinjam'));
        $this->db->from($this->table_7_2);
        $this->db->join($this->table_7, $this->table_7.'.no_pinjaman ='.$this->table_7_2.'.no_pinjaman');
        $this->db->join($this->table_7_3, $this->table_7_2.'.id_buku ='.$this->table_7_3.'.id_buku');
        $this->db->join($this->table_7_4, $this->table_7_4.'.id_kategori ='.$this->table_7_3.'.kategori');
        $this->db->order_by('id_detail','DESC');

        $i = 0;

        foreach ($this->column_search_7 as $item) // loop column 
        {
            if($_POST['search']['value']) // if datatable send POST for search
            {

                if($i===0) // first loop
                {
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                }
                else
                {
                    $this->db->or_like($item, $_POST['search']['value']);
                }

                if(count($this->column_search_7) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
                }
                $i++;
            }

        if(isset($_POST['order_7'])) // here order processing
        {
            $this->db->order_by($this->column_order_7[$_POST['order_7']['0']['column_7']], $_POST['order_7']['0']['dir']);
        } 
        else if(isset($this->order_7))
        {
            $order_7 = $this->order_7;
            $this->db->order_by(key($order_7), $order_7[key($order_7)]);
        }
    }

    function datatable_detail_pinjaman()
    {
        $this->detail_pinjaman_query();
        if($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    function detail_pinjaman_filtered()
    {
        $this->detail_pinjaman_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function detail_pinjaman_all()
    {
        $this->db->where($this->table_7.'.no_pinjaman', $this->input->post('no_pinjam'));
        $this->db->from($this->table_7_2);
        $this->db->join($this->table_7, $this->table_7.'.no_pinjaman ='.$this->table_7_2.'.no_pinjaman');
        $this->db->join($this->table_7_3, $this->table_7_2.'.id_buku ='.$this->table_7_3.'.id_buku');
        $this->db->join($this->table_7_4, $this->table_7_4.'.id_kategori ='.$this->table_7_3.'.kategori');
        return $this->db->count_all_results();
    }

    // Data Detail Cart
    private function detail_cart_query()
    {
        $this->db->where($this->table_8.'.no_anggota', $this->input->post('no_anggota'));
        $this->db->from($this->table_8);
        $this->db->join($this->table_8_2, $this->table_8.'.no_anggota ='.$this->table_8_2.'.no_anggota');
        $this->db->join($this->table_8_3, $this->table_8.'.id_buku ='.$this->table_8_3.'.id_buku');
        $this->db->join($this->table_8_4, $this->table_8_4.'.id_kategori ='.$this->table_8_3.'.kategori');
        $this->db->order_by('id_cart','DESC');

        $i = 0;

        foreach ($this->column_search_8 as $item) // loop column 
        {
            if($_POST['search']['value']) // if datatable send POST for search
            {

                if($i===0) // first loop
                {
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                }
                else
                {
                    $this->db->or_like($item, $_POST['search']['value']);
                }

                if(count($this->column_search_8) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
                }
                $i++;
            }

        if(isset($_POST['order_8'])) // here order processing
        {
            $this->db->order_by($this->column_order_8[$_POST['order_8']['0']['column_8']], $_POST['order_8']['0']['dir']);
        } 
        else if(isset($this->order_8))
        {
            $order_8 = $this->order_8;
            $this->db->order_by(key($order_8), $order_8[key($order_8)]);
        }
    }

    function datatable_detail_cart()
    {
        $this->detail_cart_query();
        if($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    function detail_cart_filtered()
    {
        $this->detail_cart_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function detail_cart_all()
    {
        $this->db->where($this->table_8.'.no_anggota', $this->input->post('no_anggota'));
        $this->db->from($this->table_8);
        $this->db->join($this->table_8_2, $this->table_8.'.no_anggota ='.$this->table_8_2.'.no_anggota');
        $this->db->join($this->table_8_3, $this->table_8.'.id_buku ='.$this->table_8_3.'.id_buku');
        $this->db->join($this->table_8_4, $this->table_8_4.'.id_kategori ='.$this->table_8_3.'.kategori');
        return $this->db->count_all_results();
    }

    // Data Pengembalian
    private function pengembalian_query()
    {
        $this->db->from($this->table_9);
        $this->db->join($this->table_9_2, $this->table_9.'.no_pinjam ='.$this->table_9_2.'.no_pinjaman');
        $this->db->join($this->table_9_3, $this->table_9_2.'.no_anggota ='.$this->table_9_3.'.no_anggota');
        $this->db->order_by('no_pengembalian','DESC');

        $i = 0;

        foreach ($this->column_search_9 as $item) // loop column 
        {
            if($_POST['search']['value']) // if datatable send POST for search
            {

                if($i===0) // first loop
                {
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                }
                else
                {
                    $this->db->or_like($item, $_POST['search']['value']);
                }

                if(count($this->column_search_9) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
                }
                $i++;
            }

        if(isset($_POST['order_9'])) // here order processing
        {
            $this->db->order_by($this->column_order_9[$_POST['order_9']['0']['column_9']], $_POST['order_9']['0']['dir']);
        } 
        else if(isset($this->order_9))
        {
            $order_9 = $this->order_9;
            $this->db->order_by(key($order_9), $order_9[key($order_9)]);
        }
    }

    function datatable_pengembalian()
    {
        $this->pengembalian_query();
        if($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    function pengembalian_filtered()
    {
        $this->pengembalian_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function pengembalian_all()
    {

        $this->db->from($this->table_9);
        $this->db->join($this->table_9_2, $this->table_9.'.no_pinjam ='.$this->table_9_2.'.no_pinjaman');
        $this->db->join($this->table_9_3, $this->table_9_2.'.no_anggota ='.$this->table_9_3.'.no_anggota');
        return $this->db->count_all_results();
    }

    // Laporan Anggota
    private function laporan_anggota_query()
    {   
        $this->db->select("
            DATE_FORMAT(date_created, '%Y') AS tahun, 
            COUNT(DISTINCT no_anggota) AS total, 
            IFNULL(SUM(CASE WHEN tanda_pengenal = 'KTP' THEN 1 ELSE 0 END), 0) ktp, 
            IFNULL(SUM(CASE WHEN tanda_pengenal = 'SIM' THEN 1 ELSE 0 END), 0) sim, 
            IFNULL(SUM(CASE WHEN tanda_pengenal = 'Paspor' THEN 1 ELSE 0 END), 0) paspor, 
            IFNULL(SUM(CASE WHEN tanda_pengenal = 'KTM' THEN 1 ELSE 0 END), 0) ktm, 
            IFNULL(SUM(CASE WHEN kelas = 'Reguler 1' THEN 1 ELSE 0 END), 0) reg_1, 
            IFNULL(SUM(CASE WHEN kelas = 'Reguler 2' THEN 1 ELSE 0 END), 0) reg_2, 
            IFNULL(SUM(CASE WHEN kelas = 'Reguler 3' THEN 1 ELSE 0 END), 0) reg_3, 
            IFNULL(SUM(CASE WHEN kelas = '-' THEN 1 ELSE 0 END), 0) umum, 
            IFNULL(SUM(CASE WHEN kelas = 'Pascasarjana' THEN 1 ELSE 0 END), 0) pascasarjana"
        );
        $this->db->from($this->table_a);
        $this->db->order_by('YEAR(date_created)','ASC');
        $this->db->group_by('YEAR(date_created)');

        $i = 0;

        foreach ($this->column_search_a as $item) // loop column 
        {
            if($_POST['search']['value']) // if datatable send POST for search
            {

                if($i===0) // first loop
                {
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                }
                else
                {
                    $this->db->or_like($item, $_POST['search']['value']);
                }

                if(count($this->column_search_a) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
                }
                $i++;
            }

        if(isset($_POST['order_a'])) // here order processing
        {
            $this->db->order_by($this->column_order_a[$_POST['order_a']['0']['column_a']], $_POST['order_a']['0']['dir']);
        } 
        else if(isset($this->order_a))
        {
            $order_a = $this->order_a;
            $this->db->order_by(key($order_a), $order_a[key($order_a)]);
        }
    }

    function datatable_laporan_anggota()
    {
        $this->laporan_anggota_query();
        if($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    function laporan_anggota_filtered()
    {
        $this->laporan_anggota_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function laporan_anggota_all()
    {

        $this->db->select("
            DATE_FORMAT(date_created, '%Y') AS tahun, 
            COUNT(DISTINCT no_anggota) AS total, 
            IFNULL(SUM(CASE WHEN tanda_pengenal = 'KTP' THEN 1 ELSE 0 END), 0) ktp, 
            IFNULL(SUM(CASE WHEN tanda_pengenal = 'SIM' THEN 1 ELSE 0 END), 0) sim, 
            IFNULL(SUM(CASE WHEN tanda_pengenal = 'Paspor' THEN 1 ELSE 0 END), 0) paspor, 
            IFNULL(SUM(CASE WHEN tanda_pengenal = 'KTM' THEN 1 ELSE 0 END), 0) ktm, 
            IFNULL(SUM(CASE WHEN kelas = 'Reguler 1' THEN 1 ELSE 0 END), 0) reg_1, 
            IFNULL(SUM(CASE WHEN kelas = 'Reguler 2' THEN 1 ELSE 0 END), 0) reg_2, 
            IFNULL(SUM(CASE WHEN kelas = 'Reguler 3' THEN 1 ELSE 0 END), 0) reg_3, 
            IFNULL(SUM(CASE WHEN kelas = '-' THEN 1 ELSE 0 END), 0) umum, 
            IFNULL(SUM(CASE WHEN kelas = 'Pascasarjana' THEN 1 ELSE 0 END), 0) pascasarjana"
        );
        $this->db->from($this->table_a);
        $this->db->order_by('YEAR(date_created)','ASC');
        $this->db->group_by('YEAR(date_created)');
        return $this->db->count_all_results();
    }

    // Laporan Buku
    private function laporan_buku_query()
    {   
        $this->db->select("nama_kategori, COUNT(id_buku) AS jumlah_buku, IFNULL(SUM(stok), 0) stok");
        $this->db->from($this->table_b);
        $this->db->join($this->table_b_2, $this->table_b.'.id_kategori ='.$this->table_b_2.'.kategori');
        $this->db->order_by('nama_kategori','ASC');
        $this->db->group_by($this->table_b.'.nama_kategori');

        $i = 0;

        foreach ($this->column_search_b as $item) // loop column 
        {
            if($_POST['search']['value']) // if datatable send POST for search
            {

                if($i===0) // first loop
                {
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                }
                else
                {
                    $this->db->or_like($item, $_POST['search']['value']);
                }

                if(count($this->column_search_b) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
                }
                $i++;
            }

        if(isset($_POST['order_b'])) // here order processing
        {
            $this->db->order_by($this->column_order_b[$_POST['order_b']['0']['column_b']], $_POST['order_b']['0']['dir']);
        } 
        else if(isset($this->order_b))
        {
            $order_b = $this->order_b;
            $this->db->order_by(key($order_b), $order_b[key($order_b)]);
        }
    }

    function datatable_laporan_buku()
    {
        $this->laporan_buku_query();
        if($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    function laporan_buku_filtered()
    {
        $this->laporan_buku_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function laporan_buku_all()
    {

        $this->db->select("nama_kategori, COUNT(id_buku) AS jumlah_buku, IFNULL(SUM(stok), 0) stok");
        $this->db->from($this->table_b);
        $this->db->join($this->table_b_2, $this->table_b.'.id_kategori ='.$this->table_b_2.'.kategori');
        $this->db->group_by($this->table_b.'.nama_kategori');
        return $this->db->count_all_results();
    }

    // Laporan Peminjaman
    private function laporan_pinjaman_query()
    {   
        $this->db->select("
            DATE_FORMAT(tgl_pinjam, '%Y') AS tahun, 
            IFNULL(SUM(MONTH(tgl_pinjam) = '01'), 0) jan, 
            IFNULL(SUM(MONTH(tgl_pinjam) = '02'), 0) feb, 
            IFNULL(SUM(MONTH(tgl_pinjam) = '03'), 0) mar, 
            IFNULL(SUM(MONTH(tgl_pinjam) = '04'), 0) apr, 
            IFNULL(SUM(MONTH(tgl_pinjam) = '05'), 0) mei, 
            IFNULL(SUM(MONTH(tgl_pinjam) = '06'), 0) jun, 
            IFNULL(SUM(MONTH(tgl_pinjam) = '07'), 0) jul, 
            IFNULL(SUM(MONTH(tgl_pinjam) = '08'), 0) agu, 
            IFNULL(SUM(MONTH(tgl_pinjam) = '09'), 0) sep, 
            IFNULL(SUM(MONTH(tgl_pinjam) = '10'), 0) okt, 
            IFNULL(SUM(MONTH(tgl_pinjam) = '11'), 0) nop, 
            IFNULL(SUM(MONTH(tgl_pinjam) = '12'), 0) des"
        );
        $this->db->from($this->table_c);
        $this->db->order_by('YEAR(tgl_pinjam)','ASC');
        $this->db->group_by('YEAR(tgl_pinjam)');

        $i = 0;

        foreach ($this->column_search_c as $item) // loop column 
        {
            if($_POST['search']['value']) // if datatable send POST for search
            {

                if($i===0) // first loop
                {
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                }
                else
                {
                    $this->db->or_like($item, $_POST['search']['value']);
                }

                if(count($this->column_search_c) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
                }
                $i++;
            }

        if(isset($_POST['order_c'])) // here order processing
        {
            $this->db->order_by($this->column_order_c[$_POST['order_c']['0']['column_c']], $_POST['order_c']['0']['dir']);
        } 
        else if(isset($this->order_c))
        {
            $order_c = $this->order_c;
            $this->db->order_by(key($order_c), $order_c[key($order_c)]);
        }
    }

    function datatable_laporan_pinjaman()
    {
        $this->laporan_pinjaman_query();
        if($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    function laporan_pinjaman_filtered()
    {
        $this->laporan_pinjaman_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function laporan_pinjaman_all()
    {

        $this->db->select("
            DATE_FORMAT(tgl_pinjam, '%Y') AS tahun, 
            IFNULL(SUM(MONTH(tgl_pinjam) = '01'), 0) jan, 
            IFNULL(SUM(MONTH(tgl_pinjam) = '02'), 0) feb, 
            IFNULL(SUM(MONTH(tgl_pinjam) = '03'), 0) mar, 
            IFNULL(SUM(MONTH(tgl_pinjam) = '04'), 0) apr, 
            IFNULL(SUM(MONTH(tgl_pinjam) = '05'), 0) mei, 
            IFNULL(SUM(MONTH(tgl_pinjam) = '06'), 0) jun, 
            IFNULL(SUM(MONTH(tgl_pinjam) = '07'), 0) jul, 
            IFNULL(SUM(MONTH(tgl_pinjam) = '08'), 0) agu, 
            IFNULL(SUM(MONTH(tgl_pinjam) = '09'), 0) sep, 
            IFNULL(SUM(MONTH(tgl_pinjam) = '10'), 0) okt, 
            IFNULL(SUM(MONTH(tgl_pinjam) = '11'), 0) nop, 
            IFNULL(SUM(MONTH(tgl_pinjam) = '12'), 0) des"
        );
        $this->db->from($this->table_c);
        $this->db->order_by('YEAR(tgl_pinjam)','ASC');
        $this->db->group_by('YEAR(tgl_pinjam)');
        return $this->db->count_all_results();
    }

    // Laporan Pengembalian
    private function laporan_pengembalian_query()
    {   
        $this->db->select("
            DATE_FORMAT(tgl_kembali, '%Y') AS tahun, 
            IFNULL(SUM(MONTH(tgl_kembali) = '01'), 0) jan, 
            IFNULL(SUM(MONTH(tgl_kembali) = '02'), 0) feb, 
            IFNULL(SUM(MONTH(tgl_kembali) = '03'), 0) mar, 
            IFNULL(SUM(MONTH(tgl_kembali) = '04'), 0) apr, 
            IFNULL(SUM(MONTH(tgl_kembali) = '05'), 0) mei, 
            IFNULL(SUM(MONTH(tgl_kembali) = '06'), 0) jun, 
            IFNULL(SUM(MONTH(tgl_kembali) = '07'), 0) jul, 
            IFNULL(SUM(MONTH(tgl_kembali) = '08'), 0) agu, 
            IFNULL(SUM(MONTH(tgl_kembali) = '09'), 0) sep, 
            IFNULL(SUM(MONTH(tgl_kembali) = '10'), 0) okt, 
            IFNULL(SUM(MONTH(tgl_kembali) = '11'), 0) nop, 
            IFNULL(SUM(MONTH(tgl_kembali) = '12'), 0) des"
        );
        $this->db->from($this->table_d);
        $this->db->order_by('YEAR(tgl_kembali)','ASC');
        $this->db->group_by('YEAR(tgl_kembali)');

        $i = 0;

        foreach ($this->column_search_d as $item) // loop column 
        {
            if($_POST['search']['value']) // if datatable send POST for search
            {

                if($i===0) // first loop
                {
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                }
                else
                {
                    $this->db->or_like($item, $_POST['search']['value']);
                }

                if(count($this->column_search_d) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
                }
                $i++;
            }

        if(isset($_POST['order_d'])) // here order processing
        {
            $this->db->order_by($this->column_order_d[$_POST['order_d']['0']['column_d']], $_POST['order_d']['0']['dir']);
        } 
        else if(isset($this->order_d))
        {
            $order_d = $this->order_d;
            $this->db->order_by(key($order_d), $order_d[key($order_d)]);
        }
    }

    function datatable_laporan_pengembalian()
    {
        $this->laporan_pengembalian_query();
        if($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    function laporan_pengembalian_filtered()
    {
        $this->laporan_pengembalian_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function laporan_pengembalian_all()
    {

        $this->db->select("
            DATE_FORMAT(tgl_kembali, '%Y') AS tahun, 
            IFNULL(SUM(MONTH(tgl_kembali) = '01'), 0) jan, 
            IFNULL(SUM(MONTH(tgl_kembali) = '02'), 0) feb, 
            IFNULL(SUM(MONTH(tgl_kembali) = '03'), 0) mar, 
            IFNULL(SUM(MONTH(tgl_kembali) = '04'), 0) apr, 
            IFNULL(SUM(MONTH(tgl_kembali) = '05'), 0) mei, 
            IFNULL(SUM(MONTH(tgl_kembali) = '06'), 0) jun, 
            IFNULL(SUM(MONTH(tgl_kembali) = '07'), 0) jul, 
            IFNULL(SUM(MONTH(tgl_kembali) = '08'), 0) agu, 
            IFNULL(SUM(MONTH(tgl_kembali) = '09'), 0) sep, 
            IFNULL(SUM(MONTH(tgl_kembali) = '10'), 0) okt, 
            IFNULL(SUM(MONTH(tgl_kembali) = '11'), 0) nop, 
            IFNULL(SUM(MONTH(tgl_kembali) = '12'), 0) des"
        );
        $this->db->from($this->table_d);
        $this->db->order_by('YEAR(tgl_kembali)','ASC');
        $this->db->group_by('YEAR(tgl_kembali)');
        return $this->db->count_all_results();
    }

    // Laporan Anggota
    public function laporan_anggota($tgl_awal, $tgl_akhir)
    {
      $where = "";
      if (!empty($tgl_awal) && !empty($tgl_akhir)) {
        $where .= " WHERE YEAR(date_created) BETWEEN '{$tgl_awal}' AND '{$tgl_akhir}' ";
      }

      $sql = "SELECT 
                DATE_FORMAT(date_created, '%Y') AS tahun, 
                COUNT(DISTINCT no_anggota) AS total, 
                IFNULL(SUM(CASE WHEN tanda_pengenal = 'KTP' THEN 1 ELSE 0 END), 0) ktp, 
                IFNULL(SUM(CASE WHEN tanda_pengenal = 'SIM' THEN 1 ELSE 0 END), 0) sim, 
                IFNULL(SUM(CASE WHEN tanda_pengenal = 'Paspor' THEN 1 ELSE 0 END), 0) paspor, 
                IFNULL(SUM(CASE WHEN tanda_pengenal = 'KTM' THEN 1 ELSE 0 END), 0) ktm, 
                IFNULL(SUM(CASE WHEN kelas = 'Reguler 1' THEN 1 ELSE 0 END), 0) reg_1, 
                IFNULL(SUM(CASE WHEN kelas = 'Reguler 2' THEN 1 ELSE 0 END), 0) reg_2, 
                IFNULL(SUM(CASE WHEN kelas = 'Reguler 3' THEN 1 ELSE 0 END), 0) reg_3, 
                IFNULL(SUM(CASE WHEN kelas = '-' THEN 1 ELSE 0 END), 0) umum, 
                IFNULL(SUM(CASE WHEN kelas = 'Pascasarjana' THEN 1 ELSE 0 END), 0) pascasarjana
              FROM `table_anggota` 
              {$where}  
              GROUP BY YEAR(date_created)";

      $prepared = $this->db->query($sql);
      return $prepared->result();
    }

    // Laporan Buku
    public function laporan_buku()
    {

      $sql = "SELECT 
                a.nama_kategori, 
                COUNT(id_buku) AS jumlah_buku, 
                IFNULL(SUM(stok), 0) stok
              FROM `table_kategori` AS a
              JOIN `table_buku` AS b ON a.id_kategori = b.kategori
              GROUP BY a.nama_kategori";

      $prepared = $this->db->query($sql);
      return $prepared->result();
    }

    // Laporan Peminjaman
    public function laporan_pinjaman($tgl_awal, $tgl_akhir)
    {
      $where = "";
      if (!empty($tgl_awal) && !empty($tgl_akhir)) {
        $where .= " WHERE YEAR(tgl_pinjam) BETWEEN '{$tgl_awal}' AND '{$tgl_akhir}' ";
      }

      $sql = "SELECT 
                DATE_FORMAT(tgl_pinjam, '%Y') AS tahun, 
                IFNULL(SUM(MONTH(tgl_pinjam) = '01'), 0) jan, 
                IFNULL(SUM(MONTH(tgl_pinjam) = '02'), 0) feb, 
                IFNULL(SUM(MONTH(tgl_pinjam) = '03'), 0) mar, 
                IFNULL(SUM(MONTH(tgl_pinjam) = '04'), 0) apr, 
                IFNULL(SUM(MONTH(tgl_pinjam) = '05'), 0) mei, 
                IFNULL(SUM(MONTH(tgl_pinjam) = '06'), 0) jun, 
                IFNULL(SUM(MONTH(tgl_pinjam) = '07'), 0) jul, 
                IFNULL(SUM(MONTH(tgl_pinjam) = '08'), 0) agu, 
                IFNULL(SUM(MONTH(tgl_pinjam) = '09'), 0) sep, 
                IFNULL(SUM(MONTH(tgl_pinjam) = '10'), 0) okt, 
                IFNULL(SUM(MONTH(tgl_pinjam) = '11'), 0) nop, 
                IFNULL(SUM(MONTH(tgl_pinjam) = '12'), 0) des
              FROM `table_pinjaman` 
              {$where}  
              GROUP BY YEAR(tgl_pinjam)";

      $prepared = $this->db->query($sql);
      return $prepared->result();
    }

    // Laporan Pengembalian
    public function laporan_pengembalian($tgl_awal, $tgl_akhir)
    {
      $where = "";
      if (!empty($tgl_awal) && !empty($tgl_akhir)) {
        $where .= " WHERE YEAR(tgl_kembali) BETWEEN '{$tgl_awal}' AND '{$tgl_akhir}' ";
      }

      $sql = "SELECT 
                DATE_FORMAT(tgl_kembali, '%Y') AS tahun, 
                IFNULL(SUM(MONTH(tgl_kembali) = '01'), 0) jan, 
                IFNULL(SUM(MONTH(tgl_kembali) = '02'), 0) feb, 
                IFNULL(SUM(MONTH(tgl_kembali) = '03'), 0) mar, 
                IFNULL(SUM(MONTH(tgl_kembali) = '04'), 0) apr, 
                IFNULL(SUM(MONTH(tgl_kembali) = '05'), 0) mei, 
                IFNULL(SUM(MONTH(tgl_kembali) = '06'), 0) jun, 
                IFNULL(SUM(MONTH(tgl_kembali) = '07'), 0) jul, 
                IFNULL(SUM(MONTH(tgl_kembali) = '08'), 0) agu, 
                IFNULL(SUM(MONTH(tgl_kembali) = '09'), 0) sep, 
                IFNULL(SUM(MONTH(tgl_kembali) = '10'), 0) okt, 
                IFNULL(SUM(MONTH(tgl_kembali) = '11'), 0) nop, 
                IFNULL(SUM(MONTH(tgl_kembali) = '12'), 0) des
              FROM `table_pengembalian` 
              {$where} 
              GROUP BY YEAR(tgl_kembali)";

      $prepared = $this->db->query($sql);
      return $prepared->result();
    }
}