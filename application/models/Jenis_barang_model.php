<?php
class Jenis_barang_model extends CI_Model {
	public function __construct()
	{
				// Call the CI_Model constructor
				parent::__construct();
				$this->load->database();
	}
	
	public function get_jenis_barang(){
		$this->db->order_by('id_jenis_barang', 'ASC');
		$query = $this->db->get('master_jenis_barang');
		return $query->result();
	}
	
	public function get_jenis_barang_like($nama_barang){
		$this->db->like('nama_jenis_barang', $nama_barang);
		$query = $this->db->get('master_jenis_barang');
		return $query->result();
	}
	public function get_jenis_barang_id($id){
		$this->db->where('id_jenis_barang', $id);
		$query = $this->db->get('master_jenis_barang');
		return $query->result();
	}
}
?>