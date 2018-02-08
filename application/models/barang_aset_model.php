 <?php
 
 class Barang_aset_model extends CI_Model {
	public function __construct()
	{
				// Call the CI_Model constructor
				parent::__construct();
				$this->load->database();
	}
		
	public function get_barang_aset(){
		$this->db->select('*');
		$this->db->from('master_barang_aset');
		$this->db->join('master_pegawai', 'master_pegawai.niplama = master_barang_aset.nip_lama');
		$this->db->join('master_ruangan', 'master_ruangan.id_ruangan = master_barang_aset.id_ruang');
		$this->db->join('master_jenis_barang', 'master_jenis_barang.id_jenis_barang = master_barang_aset.id_jenis_barang');
		$this->db->join('master_satker', 'master_satker.id_satker = master_barang_aset.id_satker');
		$query = $this->db->get();
		
		return $query->result();
	}
	
	public function get_barang_aset_by_id($id){
		$this->db->select('*');
		$this->db->from('master_barang_aset');
		$this->db->join('master_pegawai', 'master_pegawai.niplama = master_barang_aset.nip_lama');
		$this->db->join('master_ruangan', 'master_ruangan.id_ruangan = master_barang_aset.id_ruang');
		$this->db->join('master_jenis_barang', 'master_jenis_barang.id_jenis_barang = master_barang_aset.id_jenis_barang');
		$this->db->join('master_satker', 'master_satker.id_satker = master_barang_aset.id_satker');
		$this->db->where('id_barang_aset', $id);
		$query = $this->db->get();
		return $query->result();
	}
	
	public function get_barang_aset_pegawai($nip_lama){
		$this->db->select('*');
		$this->db->from('master_barang_aset');
		$this->db->join('master_pegawai', 'master_pegawai.niplama = 340056728');
		$this->db->join('master_ruangan', 'master_ruangan.id_ruangan = master_barang_aset.id_ruang');
		$this->db->join('master_jenis_barang', 'master_jenis_barang.id_jenis_barang = master_barang_aset.id_jenis_barang');
		$this->db->join('master_satker', 'master_satker.id_satker = master_barang_aset.id_satker');
		$this->db->where('master_barang_aset.nip_lama', $nip_lama);
		$query = $this->db->get();
		
		return $query->result();
	}		
	public function input_data($data){
		$this->db->insert('master_barang_aset',$data);
	}
	
	public function update_data($data){
		$this->db->replace('master_barang_aset',$data);
	}
	public function delete_data($id){
		$this->db->delete('master_barang_aset', array('id_barang_aset' => $id));
		//$this->db->insert('master_barang_aset',$data);
	}
	public function get_next_autoincrement($tableName){
		$this->db->select('AUTO_INCREMENT');
		$this->db->from('information_schema.tables');
		$this->db->where('table_name', $tableName);
		$query = $this->db->get();
		$row1 = $query->first_row();
		return $row1;
		
	}
	
 }
 ?>