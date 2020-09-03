<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Printing extends CI_Controller{

    function __construct(){
        parent::__construct();
        $this->load->model(array('M_keuangan'));
    }

    /* Billing */
    function nota_pembayaran($id = null){     
        $this->load->view('printing/billing/nota_pembayaran');
    }


}
