<?php

 class Master_model extends CI_Model {
				
	public function __construct()
	{
			// Call the CI_Model constructor
			parent::__construct();
			$this->load->database();
	}
	
	public function get_pegawai(){
		$query=$this->db->query('SELECT * FROM `master_pegawai` 
								JOIN master_satker ON master_pegawai.`id_satker`=master_satker.id_satker');
		return $query->result();
	}
	
	public function get_golongan(){
		$query=$this->db->query('SELECT * FROM `master_gol` ORDER BY `id_gol`');
		return $query->result();
	}
	
	public function get_unit_kerja(){
		$query=$this->db->query('SELECT * FROM `master_org` ORDER BY `id_org`');
		return $query->result();
	}
	
	public function input_pegawai($data){
		return $this->db->insert('master_pegawai', $data);
	}
	
	function edit_pegawai($data){
			return $this->db->replace('master_pegawai', $data);
	}
	
	function hapus_pegawai($data){
			return $this->db->delete('master_pegawai', array('niplama' => $data));
	}
	
	public function get_autentifikasi(){
		$query=$this->db->query('SELECT * FROM  master_pegawai
								LEFT JOIN `autentifikasi` ON master_pegawai.`niplama`=autentifikasi.niplama');
		return $query->result();
	}
	
	public function update_akses($data, $niplama){
		$this->db->where('niplama', $niplama);
		return $this->db->update('autentifikasi', $data);
	}
	
	public function input_akses($data){
		return $this->db->insert('autentifikasi', $data);
	}
	
	public function getPassword($nipLama){
		$query=$this->db->query('SELECT password FROM  autentifikasi
								where niplama="'.$nipLama.'"');
		return $query->result();
	}
	
	public function update_password($niplama, $data){
		$this->db->where('niplama', $niplama);
		return $this->db->update('autentifikasi', $data);
	}
	
 }