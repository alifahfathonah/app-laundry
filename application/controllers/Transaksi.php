<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksi extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model(array('M_transaksi'));
		
	}

	public function index()
	{
		$data['title'] = "Transaksi";
    	$data['active'] = 'Transaksi';
        $data['module'] = $this->M_app->get_data_module($this->session->userdata('id_group'));
        $id_user = $this->session->userdata('id_user');
        
        if (!empty($id_user)) {
            $this->load->view('dashboard', $data);
        } else {
            redirect('/');
        }
	}

	public function laundry_masuk()
	{
		$data['active'] = 'Laundry Masuk';
		$data['bayar'] = $this->M_masterdata->get_bayar();
		$data['status'] = $this->M_masterdata->get_status();
		$data['noreg'] = $this->M_transaksi->generate_no_register();
		$this->load->view('transaksi/laundry/laundry_masuk', $data);
	}

	public function laundry_keluar()
	{
		$data['active'] = 'Laundry Keluar';
		$data['status'] = $this->M_masterdata->get_status();
		$this->load->view('transaksi/laundry/laundry_keluar', $data);
	}

}

/* End of file Transaksi.php */
/* Location: ./application/controllers/Transaksi.php */