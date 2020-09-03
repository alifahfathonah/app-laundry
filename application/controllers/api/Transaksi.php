<?php defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH.'/libraries/REST_Controller.php';

class Transaksi extends REST_Controller{
    function __construct(){
        parent::__construct();
        $this->limit = 10;
        $this->load->model(array('M_transaksi'));
        date_default_timezone_set('Asia/Jakarta');

        $id_user = $this->session->userdata('id_user');
        if (empty($id_user)) {
            $this->response(array('error' => 'Anda belum login'), 401);
        }
    }

    private function start($page){
        return (($page - 1) * $this->limit);
    }

    /* Laundry Masuk */
    function laundry_masuk_detail_get(){
        if(!$this->get('id')){
            $this->response(NULL, 400);
        }
        
        $data = $this->M_transaksi->get_laundry_masuk_detail($this->get('id'));
        if($data){
            $this->response($data, 200); // 200 being the HTTP response code
        }else{
            $this->response(array('error' => 'Tidak ada data'), 404);
        }
    }

    function get_item_detail_laundry_get(){
        if(!$this->get('id')){
            $this->response(NULL, 400);
        }
        
        $data = $this->M_transaksi->get_item_laundry_masuk_detail($this->get('id'));
        if($data){
            $this->response($data, 200); // 200 being the HTTP response code
        }else{
            $this->response(array('error' => 'Tidak ada data'), 404);
        }
    }

    function laundry_get_antrian_get(){
        $data = array(
            'id_customer' => get_safe('id_customer'),
            'tanggal' => (get_safe('tanggal') !== '')?date2mysql(get_safe('tanggal')):date('Y-m-d')
        );
        $antrian = $this->M_transaksi->get_next_antrian($data);
        die(json_encode(array('antrian' => $antrian)));
    }

    function laundry_post(){
        $this->db->trans_begin();
        $waktu = date('Y-m-d H:i:s');

        // data customer
        if (post_safe('no_customer') == '') {
            $id_customer = false;
        }else{
            $id_customer = post_safe('no_customer');
        }

        $add = array(
                'id' => $id_customer,
                'tanggal_daftar' => date('Y-m-d'),
                'nama_customer' => post_safe('nama_customer'),
                'alamat' => post_safe('alamat'),
                'telp' => post_safe('telp'),
                'status' => (post_safe('status') != '')?post_safe('status'):'Aktif',
                'disc' => post_safe(''),
                'created_date' => $waktu,
        );

        // Validasi data customer
        $no_customer = $this->M_transaksi->update_data_customer($add);

        $laundry_masuk = array(
                        'no_register' => $this->M_transaksi->generate_no_register(),
                        'id_customer' => $no_customer,
                        'id_jenis_pewangi' => post_safe('jenis_pewangi'),
                        'waktu_daftar' => $waktu,
                        'status' => $this->M_transaksi->get_status_customer($no_customer),
                        'id_users' => $this->session->userdata('id_user')
                    );
        
        $id_laundry_masuk = $this->M_transaksi->insert_laundry_masuk($laundry_masuk);
        
        $layanan_laundry_masuk = array(
                        'id_laundry_masuk' => $id_laundry_masuk,
                        'waktu' => $waktu,
                        'no_antri' => $this->M_transaksi->get_next_antrian(array('tanggal' => date('Y-m-d'))),
                        'bayar' => post_safe('status_bayar'),
                        'total' => currencyToNumber(post_safe('grandtotal')),
                        'jumlahbayar' => currencyToNumber(post_safe('bayar')),
                        'piutang' => currencyToNumber(post_safe('piutang'))
                    );

            // Insert layanan laundry_masuk
        $id_layanan_laundry_masuk = $this->M_transaksi->insert_layanan_laundry_masuk($layanan_laundry_masuk);

        $id_paket = post_safe('jenis_paket');
        $jenis_cucian = post_safe('id_paket');
        $harga = currencyToNumber(post_safe('harga'));
        $jumlah = currencyToNumber(post_safe('jumlah'));
        $tanggal_terima = $waktu;

        $auto = $this->db->query("select count(*) from dm_detail_laundry_masuk where id_laundry_masuk = '".$id_laundry_masuk."' GROUP BY penerimaan_ke")->num_rows();
        foreach ($jenis_cucian as $key => $data) {
            $paket = explode('-', $jenis_cucian[$key]);
            $data_detail = array(
                'id_laundry_masuk' => $id_laundry_masuk,
                'id_layanan_laundry_masuk' => $id_layanan_laundry_masuk,
                'id_paket' => $paket[0],
                'harga' => $harga[$key],
                'jumlah' => $jumlah[$key],
                'tanggal_terima' => $waktu,
                'penerimaan_ke' => ($auto+1)
            );
            $this->db->insert('dm_detail_laundry_masuk', $data_detail);
        }

       
        
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            $status = FALSE;
        } else {
            $this->db->trans_commit();
            $status = TRUE;
        }

        $message = array('id' => $id_laundry_masuk, 'status'=>$status, 'message' => '');
        
        $this->response($message, 200); // 200 being the HTTP response code
    }

    function laundry_masuk_list_get(){
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

        $data = $this->M_transaksi->get_list_laundry_masuk($this->limit, $start, $search);
        $data['page'] = (int)$this->get('page');
        $data['limit'] = $this->limit;
        
        if($data){
            $this->response($data, 200); // 200 being the HTTP response code
        }else{
            $this->response(array('error' => 'Data tidak ditemukan'), 404);
        }
    }

    function proses_laundry_post()
    {
        $id = $this->get('id');

        $data = $this->M_transaksi->update_proses_laundry($id);
        $message = array('id' => $data);

        $this->response($message, 200);  
    }

    function laundry_selesai_post()
    {
        $id = $this->get('id');

        $data = $this->M_transaksi->verif_laundry($id);
        $message = array('id' => $data);

        $this->response($message, 200);  
    }

    function batal_laundry_post(){
        $id = $this->get('id');

        $data = $this->M_transaksi->batal_laundry($id);
        $message = array('id' => $data);

        $this->response($message, 200);  

    }

    function cek_pelunasan_customer_get($id_customer){
        $status = $this->M_transaksi->cek_pelunasan_customer($id_customer);
        $this->response($status, 200); 

    }

}