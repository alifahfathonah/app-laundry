<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class M_app extends CI_Model {

    function get_data_module($id_group)
    {
        $sql = "select m.* from dm_module m 
                join dm_privileges p on (m.id = p.id_module) 
                join dm_grant_privileges g on (p.id = g.id_privileges) 
                where g.id_group_users = '".$id_group."' 
                group by m.id order by m.urut";
        return $this->db->query($sql)->result();
    }
    
    function get_data_privileges($id_group, $id_module)
    {
        $sql = "select p.* from dm_privileges p
                join dm_grant_privileges g on (p.id = g.id_privileges)
                where g.id_group_users = '".$id_group."'
                and p.id_module = '".$id_module."'
                order by p.urutan asc, p.menu asc";
        return $this->db->query($sql)->result();
    }

}

/* End of file M_app.php */
