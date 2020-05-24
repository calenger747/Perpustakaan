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
 
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
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
}