<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_keuangan extends CI_Model {

	function get_list_pembayaran($limit, $start, $search)
	{
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

        $sql = "select lm.*, c.nama_customer, c.alamat, (llm.bayar) as 
                status_bayar, 
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

	function get_pembayaran_detail($id)
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
                where lm.id = '".$id."'";
        $data['customer'] = $this->db->query($sql)->row();

        $sql = "select dlm.*, p.nama_paket, p.satuan_paket
                from dm_detail_laundry_masuk dlm 
                join dm_paket p on (dlm.id_paket = p.id) 
                where dlm.id_laundry_masuk = '".$id."'";
        $data['detail'] = $this->db->query($sql)->result();

        return $data;
    }

    function update_data_pembayaran($data)
	{
		$id = $data['id_laundry_masuk'];
		$this->db->where('id_laundry_masuk', $data['id_laundry_masuk'])->update('dm_layanan_laundry_masuk', $data);
		return $id;
		
	}	

}

/* End of file M_keuangan.php */
/* Location: ./application/models/M_keuangan.php */