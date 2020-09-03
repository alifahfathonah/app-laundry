<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Keuangan extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model(array('M_keuangan'));
		
	}

	public function index()
	{
		$data['title'] = "Keuangan";
    	$data['active'] = 'Keuangan';
        $data['module'] = $this->M_app->get_data_module($this->session->userdata('id_group'));
        $id_user = $this->session->userdata('id_user');
        
        if (!empty($id_user)) {
            $this->load->view('dashboard', $data);
        } else {
            redirect('/');
        }
	}

	public function pembayaran()
	{
		$data['active'] = 'Pembayaran';
		$data['status_bayar'] = $this->M_masterdata->get_bayar();
		$this->load->view('keuangan/pembayaran/pembayaran', $data);
	}


}

/* End of file Keuangan.php */
/* Location: ./application/controllers/Keuangan.php */