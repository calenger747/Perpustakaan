<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class M_Login extends CI_Model{ 

    public function __construct(){
        parent::__construct();
        $this->load->database();
    }

    public function login($username, $password) {
        $query = $this->db->query("SELECT * FROM table_user WHERE username = '$username' AND password = '$password'");
        return $query->row();
    }

    public function my_profile($id_user) {
    	$query = $this->db->query("SELECT * FROM table_user WHERE id_user = '$id_user'");
        return $query->row();
    }
}