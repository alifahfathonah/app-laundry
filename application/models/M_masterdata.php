<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_masterdata extends CI_Model {

	function update_upload($id,$image){
        $data = array(
                'foto' => $image
            );  
        $result= $this->db->where('id', $id)->update('dm_pegawai', $data);
        return $result;
    }

	function get_kelamin(){
        return array(
                '' => 'Pilih',
                'L' => 'Laki-laki',
                'P' => 'Perempuan'
            );
    }

    function get_bayar(){
        return array(
                '' => 'Pilih',
                'Belum' => 'Belum Lunas',
                'Lunas' => 'Lunas'
            );
    }

    function get_agama(){
        $data = array(
                '' => 'Pilih',
                'Islam' => 'Islam',
                'Kristen' => 'Kristen',
                'Katholik' => 'Katholik',
                'Hindu' => 'Hindu',
                'Budha' => 'Budha',
                'Lain-lain' => 'Lain-lain'
            );

        return $data;
    }

    function get_status(){
        $data = array(
        		'' => 'Pilih',
                'Aktif' => 'Aktif',
                'Tidak Aktif' => 'Tidak Aktif'
         );

        return $data;
    }

    /* Barang */
    function get_kategori_barang() {
        return $this->db->query("select * from dm_kategori_barang")->result();
    }

    function get_barang($id)
	{
		$sql = "select b.*, 
				IFNULL(kb.nama, '') as kategori 
				from dm_barang b 
				left join dm_kategori_barang kb 
				on (kb.id = b.id_kategori) 
				where b.id = '".$id."'";
		return $this->db->query($sql)->row();
	}

	function get_list_barang($limit, $start, $search)
	{
		$q = '';

		if ($search['pencarian'] !== '') {
			$q = " and nama like '%".$search['pencarian']."%' ";
		}

		$limit = " limit $start , $limit";

		$sql = "select b.*, 
				IFNULL(kb.nama, '') as kategori 
				from dm_barang b 
				left join dm_kategori_barang kb 
				on (kb.id = b.id_kategori) 
				where b.id is not null";
		$order = " order by nama ";
		$query = $this->db->query($sql.$q.$order.$limit);
		$result['data'] = $query->result();
		$result['jumlah'] = $this->db->query($sql.$q)->num_rows();
		return $result;
	}

	function update_data_barang($data)
	{
		if ($data['id'] === false) {
			//insert
			$this->db->set('created_date', 'NOW()', FALSE);
			$this->db->insert('dm_barang', $data);
			$id = $this->db->insert_id();
		} else {
			// update
			$id = $data['id'];
			$this->db->set('update_date', 'NOW()', FALSE);
			$this->db->where('id', $data['id'])->update('dm_barang', $data);
		}

		return $id;
		
	}

	function delete_data_barang($id)
	{
		$this->db->where('id', $id)->delete('dm_barang');
	}

	/* Jenis Pewangi */
	function get_jenis_pewangi($id)
	{
		$sql = "select * from dm_jenis_pewangi where id = '".$id."'";
		return $this->db->query($sql)->row();
	}

	function get_list_jenis_pewangi($limit, $start, $search)
	{
		$q = '';

		if ($search['pencarian'] !== '') {
			$q = " and nama_pewangi like '%".$search['pencarian']."%' ";
		}

		$limit = " limit $start , $limit";

		$sql = "select * from dm_jenis_pewangi where id is not null";
		$order = " order by nama_pewangi ";
		$query = $this->db->query($sql.$q.$order.$limit);
		$result['data'] = $query->result();
		$result['jumlah'] = $this->db->query($sql.$q)->num_rows();
		return $result;
	}

	function update_data_jenis_pewangi($data)
	{
		if ($data['id'] === false) {
			//insert
			$this->db->insert('dm_jenis_pewangi', $data);
			$id = $this->db->insert_id();
		} else {
			// update
			$id = $data['id'];
			$this->db->where('id', $data['id'])->update('dm_jenis_pewangi', $data);
		}

		return $id;
		
	}

	function delete_data_jenis_pewangi($id)
	{
		$this->db->where('id', $id)->delete('dm_jenis_pewangi');
	}

	/* Jenis Paket */
	function get_jenis_paket($id)
	{
		$sql = "select * from dm_paket where id = '".$id."'";
		return $this->db->query($sql)->row();
	}

	function get_list_jenis_paket($limit, $start, $search)
	{
		$q = '';

		if ($search['pencarian'] !== '') {
			$q = " and nama_paket like '%".$search['pencarian']."%' ";
		}

		$limit = " limit $start , $limit";

		$sql = "select * from dm_paket where id is not null";
		$order = " order by nama_paket ";
		$query = $this->db->query($sql.$q.$order.$limit);
		$result['data'] = $query->result();
		$result['jumlah'] = $this->db->query($sql.$q)->num_rows();
		return $result;
	}

	function update_data_jenis_paket($data)
	{
		if ($data['id'] === false) {
			//insert
			$this->db->insert('dm_paket', $data);
			$id = $this->db->insert_id();
		} else {
			// update
			$id = $data['id'];
			$this->db->where('id', $data['id'])->update('dm_paket', $data);
		}

		return $id;
		
	}

	function delete_data_jenis_paket($id)
	{
		$this->db->where('id', $id)->delete('dm_paket');
	}

	/* Pegawai */
	function get_pegawai($id)
	{
		$sql = "select p.*, 
				IFNULL(jb.nama, '') as jabatan 
				from dm_pegawai p 
				left join dm_jabatan jb on (jb.id = p.id_jabatan) 
				where p.id = '".$id."'";
		return $this->db->query($sql)->row();
	}

	function get_list_pegawai($limit, $start, $search)
	{
		$q = '';

		if ($search['pencarian'] !== '') {
			$q = " and p.nama like '%".$search['pencarian']."%' 
                  or jb.nama like '%".$search['pencarian']."%' ";
		}

		$limit = " limit $start , $limit";

		$sql = "select p.*, 
				IFNULL(jb.nama, '') as jabatan 
				from dm_pegawai p 
				left join dm_jabatan jb on (jb.id = p.id_jabatan) 
				where id_jabatan is not null";
		$order = " order by nama ";
		$query = $this->db->query($sql.$q.$order.$limit);
		$result['data'] = $query->result();
		$result['jumlah'] = $this->db->query($sql.$q)->num_rows();
		return $result;
	}

	function update_data_pegawai($data)
	{
		if ($data['id'] === false) {
			//insert
			$this->db->insert('dm_pegawai', $data);
			$id = $this->db->insert_id();
		} else {
			// update
			$id = $data['id'];
			$this->db->where('id', $data['id'])->update('dm_pegawai', $data);
		}

		return $id;
		
	}

	function delete_data_pegawai($id)
	{
		$this->db->where('id', $id)->delete('dm_pegawai');
	}

	function get_auto_pegawai($q, $start, $limit, $param = NULL){
        $limit = " limit $start, $limit";
        $p = NULL;
        if ($param !== '') {
            $p = " and p.id not in (select id from dm_users)";
        }
        $sql = "select p.*, 
                IFNULL(jb.nama, '') as jabatan
                from dm_pegawai p 
                left join dm_jabatan jb on (jb.id = p.id_jabatan) 
            where p.nama like ('%$q%') $p  order by p.nama";
        $data['data'] = $this->db->query($sql.$limit)->result();
        $data['total'] = $this->db->query($sql)->num_rows();
        return $data;
    }

    /* Jabatan */
    function get_jabatan($id)
	{
		$sql = "select * from dm_jabatan where id = '".$id."'";
		return $this->db->query($sql)->row();
	}

	function get_list_jabatan($limit, $start, $search)
	{
		$q = '';

		if ($search['pencarian'] !== '') {
			$q = " and nama like '%".$search['pencarian']."%' ";
		}

		$limit = " limit $start , $limit";

		$sql = "select * from dm_jabatan where id is not null";
		$order = " order by nama ";
		$query = $this->db->query($sql.$q.$order.$limit);
		$result['data'] = $query->result();
		$result['jumlah'] = $this->db->query($sql.$q)->num_rows();
		return $result;
	}

	function update_data_jabatan($data)
	{
		if ($data['id'] === false) {
			//insert
			$this->db->insert('dm_jabatan', $data);
			$id = $this->db->insert_id();
		} else {
			// update
			$id = $data['id'];
			$this->db->where('id', $data['id'])->update('dm_jabatan', $data);
		}

		return $id;
		
	}

	function delete_data_jabatan($id)
	{
		$this->db->where('id', $id)->delete('dm_jabatan');
	}

	function get_auto_jabatan($q, $start, $limit){
        $limit = " limit $start, $limit";
        $sql = "select * from dm_jabatan 
            where nama like ('%$q%')  order by nama";
        $data['data'] = $this->db->query($sql.$limit)->result();
        $data['total'] = $this->db->query($sql)->num_rows();
        return $data;
    }

    /* Customer */

    function get_customer($inc)
	{
		$sql = "select * from dm_customer where inc = '".$inc."'";
		return $this->db->query($sql)->row();
	}

	function get_list_customer($limit, $start, $search)
	{
		$q = '';

		if ($search['pencarian'] !== '') {
			$q = " and nama_customer like '%".$search['pencarian']."%' ";
		}

		$limit = " limit $start , $limit";

		$sql = "select * from dm_customer where id is not null";
		$order = " order by created_date desc ";
		$query = $this->db->query($sql.$q.$order.$limit);
		$result['data'] = $query->result();
		$result['jumlah'] = $this->db->query($sql.$q)->num_rows();
		return $result;
	}

	function update_data_customer($data)
	{
		if ($data['inc'] === false) {
			//insert
			$this->db->set('created_date', 'NOW()', FALSE);
			$this->db->insert('dm_customer', $data);
			$id = $this->db->insert_id();
		} else {
			// update
			$this->db->set('update_date', 'NOW()', FALSE);
			$id = $data['inc'];
			$this->db->where('inc', $data['inc'])->update('dm_customer', $data);
		}

		return $id;
		
	}

	function delete_data_customer($id)
	{
		$this->db->where('inc', $id)->delete('dm_customer');
	}

	function generate_no_customer()
	{
		$q = $this->db->query("
				select max(right(id,4)) as kd_max from dm_customer
			");
		$kd = "";
		if ($q->num_rows() > 0) {
			foreach ($q->result() as $k) {
				$tmp = ((int) $k->kd_max) + 1;
				$kd = sprintf("%05s", $tmp);
			}
		} else {
			$kd = "00001";
		}

		date_default_timezone_set('Asia/Jakarta');
		return $kd;
	}

}

/* End of file M_masterdata.php */
/* Location: ./application/models/M_masterdata.php */