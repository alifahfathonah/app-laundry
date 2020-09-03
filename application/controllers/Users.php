<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {
    
    function __construct(){
        parent::__construct();
        
    }

    function logmein()
    {
        $username = filter_input(INPUT_POST, 'username');    
        $password = filter_input(INPUT_POST, 'password');
        $data = $this->M_users->validate_my_account($username, $password)->row();
        if(isset($data->id))
        {
            $data_session = array(
                'id_user' => $data->id,
                'user' => $data->username,
                'nama' => $data->nama,
                'alamat' => $data->alamat,
                'telp' => $data->telp,
                'tanggal_lahir' => $data->tanggal_lahir,
                'agama' => $data->agama,
                'level' =>$data->level,
                'foto' =>$data->foto,
                'id_group' => $data->id_group_users
            );    
            $this->session->set_userdata($data_session);
            die(json_encode(array('status' => TRUE)));
        } else {
            die(json_encode(array('status' => FALSE)));
        }
    }

    function logout()
    {
        $this->session->sess_destroy();
        redirect(base_url());   
    }

}

/* End of file Users.php */
