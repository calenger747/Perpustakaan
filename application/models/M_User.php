<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class M_User extends CI_Model{ 

    var $table_6 = 'table_pinjaman'; 
    var $table_6_2 = 'table_anggota';
    var $column_order_6 = array('no_pinjaman','nama_anggota','total_pinjam','tgl_pinjam'); //set column field database for datatable orderable 
    var $column_search_6 = array('no_pinjaman','nama_anggota','total_pinjam','DATE_FORMAT(tgl_pinjam, "%d %b %Y")'); //set column field database for datatable searchable 
    var $order_6 = array('no_pinjaman' => 'ASC'); // default order 

    public function __construct(){
        parent::__construct();
        $this->load->database();
    }

    public function my_profile($id_user) {
        $query = $this->db->query("SELECT * FROM table_user AS a JOIN table_anggota AS b ON a.no_anggota = b.no_anggota WHERE a.id_user = '$id_user'");
        return $query->row();
    }

    // Pinjaman Approve
    public function approve_pinjaman($no_anggota){
        $query = $this->db->query("SELECT * FROM table_pinjaman WHERE no_anggota='$no_anggota' AND status = 'Approve by Admin' AND notif = '1'");
        return $query->num_rows();
    }

    public function data_buku_all()
    {
        $this->load->library('pagination'); // Load librari paginationnya
    
        $query = "SELECT * FROM table_buku AS a JOIN table_kategori AS b ON a.kategori = b.id_kategori ORDER BY id_buku DESC"; // Query untuk menampilkan semua data siswa
        
        $config['base_url'] = base_url('Dashboard_User/index');
        $config['total_rows'] = $this->db->query($query)->num_rows();
        $config['per_page'] = 12;
        $config['uri_segment'] = 3;
        $config['num_links'] = 2;
        
        // Style Pagination
        // Agar bisa mengganti stylenya sesuai class2 yg ada di bootstrap
        $config['full_tag_open']   = '<ul class="pagination">';
        $config['full_tag_close']  = '</ul>';
        
        $config['first_link']      = '<i class="fa fa-angle-double-left"></i>'; 
        $config['first_tag_open']  = '<li class="prev">';
        $config['first_tag_close'] = '</li>';
        
        $config['last_link']       = '<i class="fa fa-angle-double-right"></i>'; 
        $config['last_tag_open']   = '<li class="next">';
        $config['last_tag_close']  = '</li>';
        
        $config['next_link']       = '<i class="fa fa-angle-right"></i> '; 
        $config['next_tag_open']   = '<li>';
        $config['next_tag_close']  = '</li>';
        
        $config['prev_link']       = ' <i class="fa fa-angle-left"></i> '; 
        $config['prev_tag_open']   = '<li>';
        $config['prev_tag_close']  = '</li>';
        
        $config['cur_tag_open']    = '<li class="active"><a href="#">';
        $config['cur_tag_close']   = '</a></li>';
         
        $config['num_tag_open']    = '<li>';
        $config['num_tag_close']   = '</li>';
        // End style pagination
        
        $this->pagination->initialize($config); // Set konfigurasi paginationnya
        
        $page = ($this->uri->segment($config['uri_segment'])) ? $this->uri->segment($config['uri_segment']) : 0;
        $query .= " LIMIT ".$page.", ".$config['per_page'];
        
        $data['limit'] = $config['per_page'];
        $data['total_rows'] = $config['total_rows'];
        $data['pagination'] = $this->pagination->create_links(); // Generate link pagination nya sesuai config diatas
        $data['buku'] = $this->db->query($query)->result();
        
        return $data;
    }

    public function data_buku_cari($cari)
    {
        $query = $this->db->query("SELECT * FROM table_buku AS a JOIN table_kategori AS b ON a.kategori = b.id_kategori WHERE a.id_buku LIKE '%$cari%' OR a.kode_buku LIKE '%$cari%' OR a.nama_buku LIKE '%$cari%' OR a.pengarang LIKE '%$cari%' OR a.tahun_terbit LIKE '%$cari%' OR a.deskripsi LIKE '%$cari%' OR b.nama_kategori LIKE '%$cari%' ORDER BY id_buku DESC");
        return $query->result();
    }

    // Data Pinjaman
    private function pinjaman_query_user($no_anggota)
    {
        $this->db->where($this->table_6.'.no_anggota', $no_anggota);
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

    function datatable_pinjaman_user($no_anggota)
    {
        $this->pinjaman_query_user($no_anggota);
        if($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    function user_pinjaman_filtered($no_anggota)
    {
        $this->pinjaman_query_user($no_anggota);
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function user_pinjaman_all($no_anggota)
    {
        $this->db->where($this->table_6.'.no_anggota', $no_anggota);
        $this->db->from($this->table_6);
        $this->db->join($this->table_6_2, $this->table_6.'.no_anggota ='.$this->table_6_2.'.no_anggota');
        return $this->db->count_all_results();
    }
}