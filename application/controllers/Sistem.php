<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sistem extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model(array('M_sistem'));
	}

	public function index()
	{
		$data['title'] = "Sistem";
    	$data['active'] = 'Sistem';
        $data['module'] = $this->M_app->get_data_module($this->session->userdata('id_group'));
        $id_user = $this->session->userdata('id_user');
        
        if (!empty($id_user)) {
            $this->load->view('dashboard', $data);
        } else {
            redirect('/');
        }
	}

	function account(){
        $this->load->view('sistem/account/account'); 
    }

    function group_user(){
        $this->load->view('sistem/account/group_user'); 
    }

    function users(){
        $this->load->view('sistem/account/users'); 
    }

}

/* End of file Sistem.php */
/* Location: ./application/controllers/Sistem.php */