<?php
 class Perawatan_model extends CI_Model {
	public function __construct()
	{
				// Call the CI_Model constructor
				parent::__construct();
				$this->load->database();
	}
 
	public function get_perawatan(){
		
		$this->db->select('*');
		$this->db->from('riwayat_perawatan');
		$this->db->join('master_pegawai', 'master_pegawai.niplama = riwayat_perawatan.niplama');
		$this->db->join('master_barang_aset', 'master_barang_aset.id_barang_aset = riwayat_perawatan.id_barang_aset');
		$query = $this->db->get();
		
		return $query->result();
	}
	
	public function input_data($data){
		$this->db->insert('riwayat_perawatan',$data);
	}
	
	public function delete_perawatan($id){
		$this->db->delete('riwayat_perawatan', array('id_riwayat_perawatan' => $id));
	}
 }
?>