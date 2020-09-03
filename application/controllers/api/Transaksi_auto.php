<?php defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH.'/libraries/REST_Controller.php';

class Transaksi_auto extends REST_Controller{
    function __construct(){
        parent::__construct();
        $this->limit = 20;
        $this->load->model('M_transaksi');
        $id_user = $this->session->userdata('id_user');
        if (empty($id_user)) {
            $this->response(array('error' => 'Anda belum login'), 401);
        }
    }

    private function start($page){
        return (($page - 1) * $this->limit);
    }
    
    function customer_auto_get(){
        $q = get_safe('q');
        $start = $this->start(get_safe('page'));
        $data = $this->M_transaksi->get_auto_customer($q, $start, $this->limit);
        $this->response($data, 200);
    }

    function jenis_pewangi_auto_get(){
        $q = get_safe('q');
        $start = $this->start(get_safe('page'));
        $data = $this->M_transaksi->get_auto_jenis_pewangi($q, $start, $this->limit);
        $this->response($data, 200);
    }

    function jenis_paket_auto_get(){
        $q = get_safe('q');
        $start = $this->start(get_safe('page'));
        $data = $this->M_transaksi->get_auto_jenis_paket($q, $start, $this->limit);
        $this->response($data, 200);
    }


}