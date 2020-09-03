<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class M_users extends CI_Model {
    
    function validate_my_account($username, $password)
    {
        $sql = "select u.*, g.nama as level, p.nama, p.alamat, p.agama, p.telp, p.tanggal_lahir, p.foto
        		from dm_users u 
        		join dm_group_users g on (u.id_group_users = g.id) 
        		join dm_pegawai p on (u.id = p.id) 
        		where u.username = '$username' and u.password = '".md5($password)."'";
        return $this->db->query($sql);
    }

    function check_my_account($id_user, $password)
    {
    	$sql = "select u.*
    			from dm_users u 
    			where u.id = '$id_user' and u.password = '".md5($password)."'";
    	return $this->db->query($sql);
    }
}

/* End of file M_users.php */
