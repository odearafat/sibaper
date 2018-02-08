 <?php
 
 class Pegawai_model extends CI_Model {
				
	public function __construct()
	{
			// Call the CI_Model constructor
			parent::__construct();
			$this->load->database();
	}
	
	public function get_pegawai(){
		$this->db->order_by('nama', 'ASC');
		$query = $this->db->get('master_pegawai');
		return $query->result();
	}
	
	public function get_pegawai_like($nm_pegawai){
		$this->db->order_by('nama', 'ASC');
		$this->db->like('nm_pegawai', $nm_pegawai);
		$query = $this->db->get('master_pegawai');
		return $query->result();
	}
	
	public function get_pegawai_by_satker($id_satker){
		//echo $id_satker;
		$this->db->order_by('nama', 'ASC');
		$this->db->where('id_satker', $id_satker);
		$query = $this->db->get('master_pegawai');
		return $query->result();
	}
	
	public function get_pegawai_id($id){
		$this->db->where('id_jenis_barang', $id);
		$query = $this->db->get('master_pegawai');
		return $query->result();
	}
 
 }