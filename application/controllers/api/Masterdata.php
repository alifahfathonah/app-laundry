<?php defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH.'/libraries/REST_Controller.php';

class Masterdata extends REST_Controller{
    function __construct()
    {
        parent::__construct();
        $this->limit = 10;

        $id_user = $this->session->userdata('id_user');
        if (empty($id_user)) {
            $this->response(array('error' => 'Anda belum login'), 401);
        }
    }

    private function start($page) {
        return (($page - 1) * $this->limit);
    }

    /* Barang */
    function barang_get()
    {
        if (!$this->get('id')) {
                $this->response(NULL, 400);
        }
        $data['data'] = $this->M_masterdata->get_barang($this->get('id'));
        $data['page'] = 1;
        $data['limit'] = $this->limit;
        if ($data) {
            $this->response($data, 200);
        } else {
            $this->response(array('error' => 'Tidak ada data'), 404);
        }    
    }

    function barang_post()
    {
        $harga_pokok = ((post_safe('harga_pokok') !== '')?currencyToNumber(post_safe('harga_pokok')):0);

        $add = array(
            'id' => $this->get('id'),
            'id_kategori' => post_safe('kategori'),
            'kode_barang' => post_safe('kode_barang'),
            'nama' => post_safe('nama_barang'),
            'stock' => post_safe('stock'), 
            'harga_pokok' => $harga_pokok, 
            'status' => post_safe('status') 
        );  

        $id = $this->M_masterdata->update_data_barang($add);
        $message = array('id' => $id);

        $this->response($message, 200);  
    }

    function barang_delete()
    {
        $this->M_masterdata->delete_data_barang($this->get('id'));        
    }

    function barang_list_get() {
        if (!$this->get('page')) {
            $this->response(NULL, 400);
        }

        $search = array(
            'pencarian' => get_safe('pencarian')
        );

        $start = $this->start($this->get('page'));

        $data = $this->M_masterdata->get_list_barang($this->limit, $start, $search);
        $data['page'] = (int)$this->get('page');
        $data['limit'] = $this->limit;

        if ($data) {
            $this->response($data, 200);
        } else {
            $this->response(array('error' => 'Data tidak ditemukan'), 404);
        }
    }

    /* Jenis Pewangi */
    function jenis_pewangi_get()
    {
        if (!$this->get('id')) {
                $this->response(NULL, 400);
        }
        $data['data'] = $this->M_masterdata->get_jenis_pewangi($this->get('id'));
        $data['page'] = 1;
        $data['limit'] = $this->limit;
        if ($data) {
            $this->response($data, 200);
        } else {
            $this->response(array('error' => 'Tidak ada data'), 404);
        }    
    }

    function jenis_pewangi_post()
    {
        $add = array(
            'id' => $this->get('id'),
            'nama_pewangi' => post_safe('nama_pewangi'),
            'status' => post_safe('status') 
        );  

        $id = $this->M_masterdata->update_data_jenis_pewangi($add);
        $message = array('id' => $id);

        $this->response($message, 200);  
    }

    function jenis_pewangi_delete()
    {
        $this->M_masterdata->delete_data_jenis_pewangi($this->get('id'));        
    }

    function jenis_pewangi_list_get() {
        if (!$this->get('page')) {
            $this->response(NULL, 400);
        }

        $search = array(
            'pencarian' => get_safe('pencarian')
        );

        $start = $this->start($this->get('page'));

        $data = $this->M_masterdata->get_list_jenis_pewangi($this->limit, $start, $search);
        $data['page'] = (int)$this->get('page');
        $data['limit'] = $this->limit;

        if ($data) {
            $this->response($data, 200);
        } else {
            $this->response(array('error' => 'Data tidak ditemukan'), 404);
        }
    }

    /* Jenis Paket */
    function jenis_paket_get()
    {
        if (!$this->get('id')) {
                $this->response(NULL, 400);
        }
        $data['data'] = $this->M_masterdata->get_jenis_paket($this->get('id'));
        $data['page'] = 1;
        $data['limit'] = $this->limit;
        if ($data) {
            $this->response($data, 200);
        } else {
            $this->response(array('error' => 'Tidak ada data'), 404);
        }    
    }

    function jenis_paket_post()
    {
        $harga_paket = ((post_safe('harga_paket') !== '')?currencyToNumber(post_safe('harga_paket')):0);

        $add = array(
            'id' => $this->get('id'),
            'nama_paket' => post_safe('nama_paket'),
            'satuan_paket' => post_safe('satuan_paket'), 
            'harga_paket' => $harga_paket 
        );  

        $id = $this->M_masterdata->update_data_jenis_paket($add);
        $message = array('id' => $id);

        $this->response($message, 200);  
    }

    function jenis_paket_delete()
    {
        $this->M_masterdata->delete_data_jenis_paket($this->get('id'));        
    }

    function jenis_paket_list_get() {
        if (!$this->get('page')) {
            $this->response(NULL, 400);
        }

        $search = array(
            'pencarian' => get_safe('pencarian')
        );

        $start = $this->start($this->get('page'));

        $data = $this->M_masterdata->get_list_jenis_paket($this->limit, $start, $search);
        $data['page'] = (int)$this->get('page');
        $data['limit'] = $this->limit;

        if ($data) {
            $this->response($data, 200);
        } else {
            $this->response(array('error' => 'Data tidak ditemukan'), 404);
        }
    }

    /* Pegawai */
    function pegawai_get()
    {
        if (!$this->get('id')) {
                $this->response(NULL, 400);
        }
        $data['data'] = $this->M_masterdata->get_pegawai($this->get('id'));
        $data['page'] = 1;
        $data['limit'] = $this->limit;
        if ($data) {
            $this->response($data, 200);
        } else {
            $this->response(array('error' => 'Tidak ada data'), 404);
        }    
    }

    function pegawai_post()
    {
        $add = array(
            'id' => $this->get('id'),
            'nama' => post_safe('nama'),
            'alamat' => post_safe('alamat'), 
            'kelamin' => post_safe('kelamin'), 
            'tempat_lahir' => post_safe('tempat_lahir'), 
            'tanggal_lahir' => (post_safe('tanggal_lahir') !== '')?date2mysql(post_safe('tanggal_lahir')):NULL,
             'agama' => (post_safe('agama') !== '')?post_safe('agama'):NULL, 
             'id_jabatan' => (post_safe('jabatan') !== '')?post_safe('jabatan'):NULL,
             'telp' => post_safe('telp'), 
             'status' => post_safe('status') 
        );  

        $id = $this->M_masterdata->update_data_pegawai($add);
        $message = array('id' => $id);

        $this->response($message, 200);  
    }

    function pegawai_delete()
    {
        $this->M_masterdata->delete_data_pegawai($this->get('id'));        
    }

    function pegawai_list_get() {
        if (!$this->get('page')) {
            $this->response(NULL, 400);
        }

        $search = array(
            'pencarian' => get_safe('pencarian')
        );

        $start = $this->start($this->get('page'));

        $data = $this->M_masterdata->get_list_pegawai($this->limit, $start, $search);
        $data['page'] = (int)$this->get('page');
        $data['limit'] = $this->limit;

        if ($data) {
            $this->response($data, 200);
        } else {
            $this->response(array('error' => 'Data tidak ditemukan'), 404);
        }
    }

    /* Customer */
    function customer_get()
    {
        if (!$this->get('inc')) {
                $this->response(NULL, 400);
        }
        $data['data'] = $this->M_masterdata->get_customer($this->get('inc'));
        $data['page'] = 1;
        $data['limit'] = $this->limit;
        if ($data) {
            $this->response($data, 200);
        } else {
            $this->response(array('error' => 'Tidak ada data'), 404);
        }    
    }

    function customer_post()
    {
        $no_customer = $this->M_masterdata->generate_no_customer();

        $add = array(
            'id' => $no_customer,
            'inc' => $this->get('inc'),
            'nama_customer' => post_safe('nama_customer'),
            'alamat' => post_safe('alamat'),
            'telp' => post_safe('telp'),
            'status' => post_safe('status'),
            'disc' => post_safe('disc'),

        );  

        $id = $this->M_masterdata->update_data_customer($add);
        $message = array('inc' => $id);

        $this->response($message, 200);  
    }

    function customer_delete()
    {
        $this->M_masterdata->delete_data_customer($this->get('id'));        
    }

    function customer_list_get() {
        if (!$this->get('page')) {
            $this->response(NULL, 400);
        }

        $search = array(
            'pencarian' => get_safe('pencarian')
        );

        $start = $this->start($this->get('page'));

        $data = $this->M_masterdata->get_list_customer($this->limit, $start, $search);
        $data['page'] = (int)$this->get('page');
        $data['limit'] = $this->limit;

        if ($data) {
            $this->response($data, 200);
        } else {
            $this->response(array('error' => 'Data tidak ditemukan'), 404);
        }
    }

    /* Jabatan */
    function jabatan_get()
    {
        if (!$this->get('id')) {
                $this->response(NULL, 400);
        }
        $data['data'] = $this->M_masterdata->get_jabatan($this->get('id'));
        $data['page'] = 1;
        $data['limit'] = $this->limit;
        if ($data) {
            $this->response($data, 200);
        } else {
            $this->response(array('error' => 'Tidak ada data'), 404);
        }    
    }

    function jabatan_post()
    {
        $add = array(
            'id' => $this->get('id'),
            'nama' => post_safe('nama')
        );  

        $id = $this->M_masterdata->update_data_jabatan($add);
        $message = array('id' => $id);

        $this->response($message, 200);  
    }

    function jabatan_delete()
    {
        $this->M_masterdata->delete_data_jabatan($this->get('id'));        
    }

    function jabatan_list_get() {
        if (!$this->get('page')) {
            $this->response(NULL, 400);
        }

        $search = array(
            'pencarian' => get_safe('pencarian')
        );

        $start = $this->start($this->get('page'));

        $data = $this->M_masterdata->get_list_jabatan($this->limit, $start, $search);
        $data['page'] = (int)$this->get('page');
        $data['limit'] = $this->limit;

        if ($data) {
            $this->response($data, 200);
        } else {
            $this->response(array('error' => 'Data tidak ditemukan'), 404);
        }
    }
    
}