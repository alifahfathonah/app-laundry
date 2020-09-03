<?php defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH.'/libraries/REST_Controller.php';

class keuangan extends REST_Controller{
    function __construct(){
        parent::__construct();
        $this->limit = 10;
        $this->load->model(array('M_keuangan'));
        date_default_timezone_set('Asia/Jakarta');

        $id_user = $this->session->userdata('id_user');
        if (empty($id_user)) {
            $this->response(array('error' => 'Anda belum login'), 401);
        }
    }

    private function start($page){
        return (($page - 1) * $this->limit);
    }

    /* Pembayaran */
    function pembayaran_list_get(){
        if(!$this->get('page')){
            $this->response(NULL, 400);
        }

        $search = array(
               'id' => get_safe('id'),
               'awal' => get_safe('awal'),
               'akhir' => get_safe('akhir'),
               'no_register' => get_safe('no_register'),
               'no_customer' => get_safe('no_customer'),
               'nama_customer' => get_safe('nama_customer')
            );

        $start = $this->start($this->get('page'));

        $data = $this->M_keuangan->get_list_pembayaran($this->limit, $start, $search);
        $data['page'] = (int)$this->get('page');
        $data['limit'] = $this->limit;
        
        if($data){
            $this->response($data, 200); // 200 being the HTTP response code
        }else{
            $this->response(array('error' => 'Data tidak ditemukan'), 404);
        }
    }

    function pembayaran_detail_get(){
        if(!$this->get('id')){
            $this->response(NULL, 400);
        }
        
        $data = $this->M_keuangan->get_pembayaran_detail($this->get('id'));
        if($data){
            $this->response($data, 200); // 200 being the HTTP response code
        }else{
            $this->response(array('error' => 'Tidak ada data'), 404);
        }
    }

    function pembayaran_post()
    {
        $id = $this->get('id');
        $total = ((post_safe('bayar') !== '')?currencyToNumber(post_safe('bayar')):0);
        $jumlahbayar = ((post_safe('serah') !== '')?currencyToNumber(post_safe('serah')):0);

        $add = array(
            'id_laundry_masuk' => $id,
            'bayar' => 'Lunas', 
            'total' => $total, 
            'jumlahbayar' => $jumlahbayar 
        );  

        // var_dump($add);
        $id = $this->M_keuangan->update_data_pembayaran($add);
        $message = array('id_laundry_masuk' => $id);

        $this->response($message, 200);  
    }

}