<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_transaksi extends CI_Model {
    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
    }

	function get_status_customer($no_customer){
        $sql = "select count(*) as jumlah from dm_laundry_masuk where id_customer = '".$no_customer."'";
        $status = 'Baru';
        $query = $this->db->query($sql)->row();

        if ($query !== null) {
            if ($query->jumlah > 0) {
                $status = 'Lama';
            }
        }

        return $status;
    }

	function get_auto_customer($q, $start, $limit){
        $limit = " limit $start, $limit";
        $sql = "select * from dm_customer 
        		where (id like ('%$q%') or nama_customer like ('%$q%')) and status = 'Aktif'  order by id";


        $data['data'] = $this->db->query($sql.$limit)->result();
        $data['total'] = $this->db->query($sql)->num_rows();
        return $data;
    }

    function get_auto_jenis_pewangi($q, $start, $limit){
        $limit = " limit $start, $limit";
        $sql = "select * from dm_jenis_pewangi 
        		where (nama_pewangi like ('%$q%')) and status = 'Aktif' order by nama_pewangi";


        $data['data'] = $this->db->query($sql.$limit)->result();
        $data['total'] = $this->db->query($sql)->num_rows();
        return $data;
    }

    function get_auto_jenis_paket($q, $start, $limit){
        $limit = " limit $start, $limit";
        $sql = "select * from dm_paket 
        		where nama_paket like ('%$q%') order by nama_paket";


        $data['data'] = $this->db->query($sql.$limit)->result();
        $data['total'] = $this->db->query($sql)->num_rows();
        return $data;
    }

    function generate_no_register(){
        $format = date('y').date('m').date('d');

        $sql = "select count(*) as jumlah from dm_laundry_masuk 
                where date(waktu_daftar) = '".date('Y-m-d')."' ";
        $db = $this->db->query($sql)->row();
        return $format.str_pad($db->jumlah+1, 4,"0",STR_PAD_LEFT);
    }

    function get_last_no_customer(){
        $sql = "select c.id from dm_customer c
                inner join (
                select max(inc) as inc_max from dm_customer
                ) mx on (mx.inc_max = c.inc )
                ";
        $no_max = $this->db->query($sql)->row();
        //return str_pad($db->no_customer+1, 8,"0",STR_PAD_LEFT);
        

        // komponen no rm
        if (isset($no_max->id)) {
            $c1 = (int)substr($no_max->id, 0,2);
            $c2 = (int)substr($no_max->id, 2,4);
            $c3 = (int)substr($no_max->id, 6,2);

       
            $no_customer = '00';

            if (($c2+1) > 9999) {
                $c2 = 1;
                $c3++;
            }else{
                $c2++;
            }

            $no_customer .= str_pad($c2, 4,"0",STR_PAD_LEFT);
        

        }else{
            // Customer pertama
            $no_customer = '000001';
        }


        return $no_customer;
    }

    function get_next_antrian($data) {
        $sql = "select max(no_antri) as no_antri from 
        		dm_layanan_laundry_masuk 
                where date(waktu) = '".$data['tanggal']."' ";
        //echo $sql;
        $query = $this->db->query($sql);
        $next_antrian = 0;

        if ($query->row() != null) {
            $unit = $query->row();
            $next_antrian = $unit->no_antri + 1;
        } else {
            $next_antrian = 1;
        }
        return $next_antrian;
    }

    function update_data_customer($data){
        if ($data['id'] === false) {
            // insert
            $data['id'] = $this->get_last_no_customer();
            $id = $data['id'];
            $this->db->insert('dm_customer', $data);
            $id = $data['id'];
        }else{
            // Update
            $id = $data['id'];
            $this->db->where('id', $data['id'])->update('dm_customer', $data);
        }

        return $id;
    }

    function insert_laundry_masuk($data){
        $this->db->insert('dm_laundry_masuk', $data);
        $id = $this->db->insert_id();
        return $id;
    }

    function insert_layanan_laundry_masuk($data){
        $this->db->insert('dm_layanan_laundry_masuk', $data);
        $id = $this->db->insert_id();
        return $id;
    }

    function get_list_laundry_masuk($limit, $start, $search){
        $q = '';

        if (($search['akhir'] !== '') & ($search['akhir'] !== '') ){
            $q .= " and date(lm.waktu_daftar) between '". date2mysql($search['awal']) ."' and '". date2mysql($search['akhir']) ."' ";
        }

        if ($search['id'] !== '') {
            $q .= " and lm.id = '".$search['id']."' ";
        }

        if ($search['no_register'] !== '') {
            $q .= " and lm.no_register = '".$search['no_register']."' ";
        }

        if ($search['no_customer'] !== '') {
            $q .= " and c.id like '%".$search['no_customer']."%' ";
        }

        if ($search['nama_customer'] !== '') {
            $q .= " and nama_customer like '%".$search['nama_customer']."%' ";
        }

        $limit = " limit $start , $limit";

        $sql = "select lm.*, c.nama_customer, c.alamat, (llm.status) as 
                status_laundry, 
                IFNULL(us.username, '') as user
                from dm_laundry_masuk lm
                join dm_customer c on (lm.id_customer = c.id) 
                join dm_layanan_laundry_masuk llm on(llm.id_laundry_masuk = lm.id)
                join dm_users us on (lm.id_users = us.id) 
                where lm.id is not null $q 
                group by lm.id";


        $order = " order by lm.waktu_daftar desc";
        //echo $sql.$q.$order.$limit;
        $query = $this->db->query($sql.$order.$limit);
        $result['data'] = $query->result();
        $result['jumlah'] = $this->db->query($sql)->num_rows();
        return $result;
    }

    function get_laundry_masuk_detail($id_laundry_masuk)
    {
        $q = '';
        // data laundry masuk
        $sql = "select lm.*, c.nama_customer, c.alamat, 
                c.telp, jp.nama_pewangi, llm.no_antri, (llm.status) as 
                status_laundry, llm.bayar, llm.total, 
                llm.jumlahbayar, llm.piutang 
                from dm_laundry_masuk lm
                join dm_customer c on (lm.id_customer = c.id) 
                join dm_layanan_laundry_masuk llm on (llm.id_laundry_masuk = lm.id) 
                join dm_jenis_pewangi jp on (lm.id_jenis_pewangi = jp.id)
                where lm.id = '".$id_laundry_masuk."'";
        $data['customer'] = $this->db->query($sql)->row();

        $sql = "select dlm.*, p.nama_paket, p.satuan_paket
                from dm_detail_laundry_masuk dlm 
                join dm_paket p on (dlm.id_paket = p.id) 
                where dlm.id_laundry_masuk = '".$id_laundry_masuk."'";
        $data['detail'] = $this->db->query($sql)->result();

        return $data;
    }

    function update_proses_laundry($id)
    {
        $sql = "update dm_layanan_laundry_masuk 
                set status = 'Proses' where dm_layanan_laundry_masuk.id_laundry_masuk = '".$id."'";
        return $this->db->query($sql);
    }

    function verif_laundry($id)
    {
        $waktu = date('Y-m-d H:i:s');

        $data = "update dm_laundry_masuk, dm_layanan_laundry_masuk 
                set dm_layanan_laundry_masuk.status = 'Selesai', waktu_keluar = '".$waktu."' 
                where dm_layanan_laundry_masuk.id_laundry_masuk = '".$id."' 
                and dm_laundry_masuk.id = '".$id."'";
        return $this->db->query($data);
    }

    function batal_laundry($id){
        $waktu = date('Y-m-d H:i:s');

        $data = "update dm_laundry_masuk, dm_layanan_laundry_masuk 
                set dm_layanan_laundry_masuk.status = 'Batal', waktu_keluar = '".$waktu."' 
                where dm_layanan_laundry_masuk.id_laundry_masuk = '".$id."' 
                and dm_laundry_masuk.id = '".$id."'";
        return $this->db->query($data);
    }

    function cek_pelunasan_customer($id_customer){
        $sql = "select if(sum(llm.total - llm.jumlahbayar) > 0, 'Belum', 'Sudah' ) as sisa , 
                lm.id_customer 
                from dm_laundry_masuk lm 
                left join dm_layanan_laundry_masuk llm on (lm.id = llm.id_laundry_masuk)
                inner join (
                  select max(id) as id_max from dm_laundry_masuk 
                  where id_customer = '".$id_customer."' 
                ) lm on (llm.id = lm.id_max)";
        
        return $this->db->query($sql)->row();
    
    }

}

/* End of file M_transaksi.php */
/* Location: ./application/models/M_transaksi.php */