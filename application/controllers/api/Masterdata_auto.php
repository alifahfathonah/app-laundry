<?php defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH.'/libraries/REST_Controller.php';

class Masterdata_auto extends REST_Controller{
    function __construct(){
        parent::__construct();
        $this->limit = 20;

        $id_user = $this->session->userdata('id_user');
        if (empty($id_user)) {
            $this->response(array('error' => 'Anda belum login'), 401);
        }
    }

    private function start($page){
        return (($page - 1) * $this->limit);
    }

    function jabatan_auto_get(){
        $q = get_safe('q');
        $start = $this->start(get_safe('page'));
        $data = $this->M_masterdata->get_auto_jabatan($q, $start, $this->limit);
        if ((get_safe('page') == 1) & ($q == '')) {
            $pilih[] = array('id'=>'', 'nama' =>' ');
            $data['data'] = array_merge($pilih, $data['data']);
            $data['total'] += 1;
        }
        $this->response($data, 200);
    }

    function pegawai_auto_get(){
        $q = get_safe('q');
        $start = $this->start(get_safe('page'));
        $var   = get_safe('param');
        $param = isset($var)?$var:NULL;
        $data = $this->M_masterdata->get_auto_pegawai($q, $start, $this->limit, $param);
        if ((get_safe('page') == 1) & ($q == '')) {
            $pilih[] = array('id'=>'', 'nama' =>' ', 'jabatan' => "");
            $data['data'] = array_merge($pilih, $data['data']);
            $data['total'] += 1;
        }
        $this->response($data, 200);
    }

}