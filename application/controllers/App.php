<?php defined('BASEPATH') OR exit('No direct script access allowed');

class App extends CI_Controller {

    function __construct(){
        parent::__construct();
        
    }

    public function index()
    {
        $data['title'] = "Home";
        $data['active'] = 'Dashboard';
        $data['module'] = $this->M_app->get_data_module($this->session->userdata('id_group'));
        $data['page'] = 'home_page'; 
        $id_user = $this->session->userdata('id_user');

        if (!empty($id_user)) {
            $this->load->view('dashboard', $data);
        } else {
            $this->login();
        }        
        
    }

    public function dashboard()
    {
        $this->load->view('home_page');
    }

    public function login()
    {
        $data['active'] = 'Login';
        $this->load->view('login');
    }

    function profil(){
        $data['active'] = 'My Profil';
        $this->load->view('profil');
    }

    function ganti_password(){
        $data['active'] = 'Ganti Password';
        $data['id'] = $this->session->userdata("id_user");
        $this->load->view('ganti_password', $data);
    }

    function cek_password() {
        $username = filter_input(INPUT_POST, 'username');
        $password = filter_input(INPUT_POST, 'password');
        $data = $this->M_users->check_my_account($username, $password)->row();
        if (isset($data->id)) {
            die(json_encode(array('status' => TRUE)));
        } else {
            die(json_encode(array('status' => FALSE)));
        }
    }

    function save_password(){
        $data = array(
                'password' => md5(post_safe('password_baru'))
            );

        $this->db->where('id',$this->session->userdata("id_user"))->update('dm_users',$data);

        die(json_encode(array('status'=>true)));
    }

    function do_upload(){
        $id = post_safe('id');

        $config['upload_path']="./foto/";
        $config['allowed_types']='gif|jpg|png';
        $config['encrypt_name'] = TRUE;
         
        $this->load->library('upload',$config);
        if($this->upload->do_upload("file")){
            $data = array('upload_data' => $this->upload->data());
 
            $image= $data['upload_data']['file_name']; 
             
            $result= $this->M_masterdata->update_upload($id,$image);
            echo json_decode($result);
        }
 
     }
}

/* End of file App.php */
