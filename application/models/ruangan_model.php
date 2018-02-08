<?php

	class Ruangan_model extends CI_Model {
		
		public function __construct()
		{
				// Call the CI_Model constructor
				parent::__construct();
				$this->load->database();
		}
		
		public function get_ruangan(){
		$this->db->order_by('nama_ruangan', 'ASC');
		$query = $this->db->get('master_ruangan');
		return $query->result();
	}
	
	public function get_ruangan_satker($id_ruangan){
		$this->db->order_by('nama_ruangan', 'ASC');
		$this->db->where('id_ruangan', $id_ruangan);
		$query = $this->db->get('master_ruangan');
		return $query->result();
	}
}