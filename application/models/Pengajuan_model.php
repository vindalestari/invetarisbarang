<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Pengajuan_model extends CI_Model
{

    public $table = 'pengajuan';
    public $id = 'id';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // get all
    function get_all()
    {
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }

    // get data by id
    function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }
    
    // get total rows
    function total_rows($q = NULL) {
        $this->db->like('id', $q);
	$this->db->or_like('id_barang', $q);
	$this->db->or_like('jumlah_barang', $q);
	$this->db->or_like('tanggal_pengajuan', $q);
	$this->db->or_like('status', $q);
	$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->select("pengajuan.*,kelola_barang.nama_barang,kelola_supplier.nama");
        $this->db->join('kelola_supplier','pengajuan.id_supplier=kelola_supplier.id');
        $this->db->join('kelola_barang','pengajuan.id_barang=kelola_barang.id');
        $this->db->order_by('pengajuan.id', $this->order);
        $this->db->or_like('kelola_barang.nama_barang', $q);
        $this->db->or_like('kelola_supplier.nama', $q);
	$this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }

    // insert data
    function insert($data)
    {
        $this->db->insert($this->table, $data);
    }

    // update data
    function update($id, $data)
    {
        $this->db->where($this->id, $id);
        $this->db->update($this->table, $data);
    }

    function setujui($id)
    {
        $this->db->where($this->id, $id);
        $this->db->set('status',1);
        return $this->db->update($this->table);
    }

    function tidak_disetujui($id)
    {
        $this->db->where($this->id, $id);
        $this->db->set('status',2);
        $this->db->update($this->table);
    }

    // delete data
    function delete($id)
    {
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
    }

    // delete bulkdata
    function deletebulk(){
        $data = $this->input->post('msg_', TRUE);
        $arr_id = explode(",", $data); 
        $this->db->where_in($this->id, $arr_id);
        return $this->db->delete($this->table);
    }

}

/* End of file Pengajuan_model.php */
/* Location: ./application/models/Pengajuan_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2022-06-30 10:22:23 */
/* http://harviacode.com */