<?php
	class Login_model extends CI_Model{	
		function cek_login($where){	
			$query2 = $this->db->query('SELECT username, password, master_pegawai.niplama as niplama, 
											nipbaru, nama, email, gelar_depan, gelar_belakang, 
											master_satker.id_satker , id_sibaper, nm_satker
										FROM `autentifikasi` 
										join master_pegawai on master_pegawai.niplama = autentifikasi.niplama 
										join master_satker on master_satker.id_satker = master_pegawai.id_satker
										where `username`= "'.$where['username'].'" 
											AND password="'.$where['password'].'"');
			//$query = $this->db->get();
			return $query2->result();
		}
	}
?>