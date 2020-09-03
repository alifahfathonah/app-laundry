<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Masterdata extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		
	}

	public function index()
	{
		$data['title'] = "Master Data";
    	$data['active'] = 'Master Data';
        $data['module'] = $this->M_app->get_data_module($this->session->userdata('id_group'));
        $id_user = $this->session->userdata('id_user');
        
        if (!empty($id_user)) {
            $this->load->view('dashboard', $data);
        } else {
            redirect('/');
        }
	}

	public function jenis_pewangi()
	{
		$data['active'] = 'Jenis Pewangi';
		$data['status'] = $this->M_masterdata->get_status();
		$this->load->view('masterdata/jenis_pewangi/jenis_pewangi', $data);
	}

	public function jenis_paket()
	{
		$data['active'] = 'Jenis Paket';
		$data['status'] = $this->M_masterdata->get_status();
		$this->load->view('masterdata/jenis_paket/jenis_paket', $data);
	}

	public function pegawai()
	{
		$data['active'] = 'Pegawai';
		$data['kelamin'] = $this->M_masterdata->get_kelamin();
		$data['agama'] = $this->M_masterdata->get_agama();
		$data['status'] = $this->M_masterdata->get_status();
		$this->load->view('masterdata/pegawai/pegawai', $data);
	}

	public function jabatan()
	{
		$data['active'] = 'Jabatan';
		$this->load->view('masterdata/jabatan/jabatan', $data);
	}

	public function customer()
	{
		$data['active'] = 'Customer';
		$data['status'] = $this->M_masterdata->get_status();
		$data['kelamin'] = $this->M_masterdata->get_kelamin();
		$data['agama'] = $this->M_masterdata->get_agama();
		$this->load->view('masterdata/customer/customer', $data);
	}

	public function barang()
	{
		$data['active'] = 'Barang';
		$data['kategoris'] = $this->M_masterdata->get_kategori_barang();
		$data['status'] = $this->M_masterdata->get_status();
		$this->load->view('masterdata/barang/barang', $data);
	}
}

/* End of file Masterdata.php */
/* Location: ./application/controllers/Masterdata.php */