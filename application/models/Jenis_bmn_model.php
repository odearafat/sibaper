<?php
	class Jenis_Bmn_Model extends CI_Model{	
		public function __construct()
		{
				// Call the CI_Model constructor
				parent::__construct();
				$this->load->database();
		}
		function getKategori(){	
			$this->db->select('*');
			$query = $this->db->get('kategori_bmn');
			
			return $query->result();
		}
		
		function input_jenis_bmn($data){
			return $this->db->insert('master_jenis_bmn', $data);
		}
		
		function input_bmn($table,$data){
			return $this->db->insert($table, $data);
		}
		
		function input_perawatan($table,$data){
			return $this->db->insert_batch($table, $data);
		}
		
		function edit_jenis_bmn($data){
			return $this->db->replace('master_jenis_bmn', $data);
		}
		
		function editUmum($tabel,$data){
			return $this->db->replace($tabel, $data);
		}
		
		function hapus_jenis_bmn($data){
			return $this->db->delete('master_jenis_bmn', array('id_jenis_bmn' => $data));
		}
		
		function hapus($tabel,$kolom, $data){
			return $this->db->delete($tabel, array($kolom => $data));
		}
		
		function get_kendaraan($idSatker){
			$this->db->select('*, sum(biaya) as biaya, barang_kendaraan.link_foto as link_foto_k, 
									kategori_bmn.link_foto as link_foto_kat');
			$this->db->from('barang_kendaraan');
			$this->db->join('master_jenis_bmn', 'master_jenis_bmn.id_jenis_bmn=barang_kendaraan.id_jenis_bmn');
			$this->db->join('master_pegawai', 'master_pegawai.niplama=barang_kendaraan.niplama', 'left');
			$this->db->join('master_satker', 'master_satker.id_satker=barang_kendaraan.idSatker');
			$this->db->join('kategori_bmn', 'kategori_bmn.id_kategori=master_jenis_bmn.id_kategori_bmn', 'left');
			$this->db->join('(SELECT * from trx_perawatan where kendaraan_or_no=1) as a', 'a.id_barang=barang_kendaraan.id_kendaraan', 'left');
			$this->db->where('barang_kendaraan.idSatker', $idSatker);
			$this->db->group_by('id_kendaraan');
			$query=$this->db->get();
			return $query->result();
		}
		
		function get_non_kendaraan($idSatker){
			$this->db->select('*, sum(biaya) as biaya, barang_non_kendaraan.link_foto as link_foto_k, 
									kategori_bmn.link_foto as link_foto_kat');
			$this->db->from('barang_non_kendaraan');
			$this->db->join('master_pegawai', 'master_pegawai.niplama=barang_non_kendaraan.niplama', 'left');
			$this->db->join('master_satker', 'master_satker.id_satker=barang_non_kendaraan.id_satker');
			$this->db->join('master_jenis_bmn', 'master_jenis_bmn.id_jenis_bmn=barang_non_kendaraan.id_jenis_bmn');
			$this->db->join('kategori_bmn', 'kategori_bmn.id_kategori=master_jenis_bmn.id_kategori_bmn');
			$this->db->join('(SELECT * from trx_perawatan where kendaraan_or_no=2) as a', 'a.id_barang=barang_non_kendaraan.id_non_kendaraan', 'left');
			$this->db->where('barang_non_kendaraan.id_satker', $idSatker);
			$this->db->group_by('id_non_kendaraan');
			$query=$this->db->get();
			return $query->result();
		}
		
		/*function getSumBiayaKendaraan($id_satker){
			$query=$this->get_kendaraan($idSatker)
			foreach($query as $row){
				$this->db->select('*');
				$this->db->from('trx_perawatan');
				$this->db->where('id_barang', $row->id_kendaraan);
				$this->db->where('kendaraan_or_no', $row->kendaraan_or_no);
				
			}
		}*/
		
		function getJenisBarang(){	
			$this->db->select('id_jenis_bmn, merk, type, nm_kategori, link_foto, id_kategori');
			$this->db->join('kategori_bmn', 'kategori_bmn.id_kategori=master_jenis_bmn.id_kategori_bmn');
			$query = $this->db->get('master_jenis_bmn');
			return $query->result();
		}
		
		function get_grup_perawatan($idSatker){
			$data=Array();
			$query=$this->db->query('SELECT id_trx, id_barang, penyedia, id_grup_trx, kendaraan_or_no, 
										merk as merk_k , type as type_k,  
										no_pol, sum(biaya) as biaya, tanggal_selesai
									FROM `trx_perawatan` 
									left join barang_kendaraan on id_barang=id_kendaraan 
									left join master_jenis_bmn on master_jenis_bmn.id_jenis_bmn= barang_kendaraan.id_jenis_bmn 
									where idSatker='.$idSatker.' AND kendaraan_or_no=1
									group by id_grup_trx order by id_grup_trx DESC');
			
			$data[]=$query->result();
			$query1=$this->db->query('SELECT id_trx, id_barang, penyedia, id_grup_trx, kendaraan_or_no, 
										merk as merk_n_k , type as type_n_k, 
										 identitas_barang , sum(biaya) as biaya, tanggal_selesai
									FROM `trx_perawatan` 
									left join barang_non_kendaraan on id_barang=id_non_kendaraan 
									left join master_jenis_bmn on master_jenis_bmn.id_jenis_bmn= barang_non_kendaraan.id_jenis_bmn 
									 WHERE  id_satker='.$idSatker.' AND kendaraan_or_no=2 
									group by id_grup_trx order by id_grup_trx DESC');
			$data[]=$query1->result();
			
			return $data;
		}

		function get_perawatan($idGrupTrx){
			$query=$this->db->query('SELECT * 
										FROM `trx_perawatan` 	
										where id_grup_trx='.$idGrupTrx);
			return $query->result();
		}
		
		function get_perawatan_by_id($idGrupTrx, $idBarang){
			$query=$this->db->query('SELECT * 
										FROM `trx_perawatan` 	
										where id_grup_trx='.$idGrupTrx.' AND '.' id_barang='.$idBarang );
			return $query->result();
		}
		
		
		function get_daftar_perawatan($idSatker){
			$daftarPerawatanMain=$this->get_grup_perawatan($idSatker);
			$data=Array();
			
		foreach($daftarPerawatanMain as $daftarPerawatan){
			
			foreach($daftarPerawatan as $row){
				$merk='';
				$type='';
				$identitasBarang="";
				$ringkasanPerawatan="";
				
				if($row->kendaraan_or_no=='1'){
					$identitasBarang=$row->no_pol;
					$merk=$row->merk_k;
					$type=$row->type_k;
				}else{
					$identitasBarang=$row->identitas_barang;	
					$merk=$row->merk_n_k;
					$type=$row->type_n_k;
				}
				
				$transaksi=$this->get_perawatan($row->id_grup_trx);
				foreach($transaksi as $row2){
						$ringkasanPerawatan=$ringkasanPerawatan.'( '.
							($row2->pekerjaan).' , '.($row2->sparepart).' | '.($row2->biaya).')';
					}
				
				$data[]=Array(
							'merk'=>$merk,
							'type'=>$type,
							'identitas'=>$identitasBarang,
							'ringkasanPerawatan'=>$ringkasanPerawatan,
							'biaya'=>$row->biaya,
							'id_grup_trx'=>$row->id_grup_trx,
							'id_barang'=>$row->id_barang,
							'penyedia'=>$row->penyedia,
							'tanggal_selesai'=>$row->tanggal_selesai
						);
			}
		}
			//print_r($data);
			return $data;
		}
		
		public function getKendaraanById($idKendaraan){
			$this ->db-> select('*, barang_kendaraan.link_foto as link_foto_k, 
					kategori_bmn.link_foto as link_foto_kat');
			$this ->db-> from('barang_kendaraan');
			$this ->db-> join('master_jenis_bmn', 'master_jenis_bmn.id_jenis_bmn=barang_kendaraan.id_jenis_bmn');
			$this ->db-> join('kategori_bmn', 'kategori_bmn.id_kategori=master_jenis_bmn.id_kategori_bmn');
			$this ->db-> join('master_pegawai', 'master_pegawai.niplama=barang_kendaraan.niplama');
			$this ->db-> join('master_satker', 'master_pegawai.id_satker=master_satker.id_satker', 'left');
			$this ->db-> where('id_kendaraan',$idKendaraan);
			$query = $this->db->get();
			return $query->result();
		}
		
		
		public function getNonKendaraanById($idNonKendaraan){
			$this ->db-> select('*, barang_non_kendaraan.link_foto as link_foto_k, 
					kategori_bmn.link_foto as link_foto_kat');
			$this ->db-> from('barang_non_kendaraan');
			$this ->db-> join('master_jenis_bmn', 'master_jenis_bmn.id_jenis_bmn=barang_non_kendaraan.id_jenis_bmn');
			$this ->db-> join('kategori_bmn', 'kategori_bmn.id_kategori=master_jenis_bmn.id_kategori_bmn');
			$this ->db-> join('master_pegawai', 'master_pegawai.niplama=barang_non_kendaraan.niplama');
			$this ->db-> join('master_satker', 'master_pegawai.id_satker=master_satker.id_satker', 'left');
			$this ->db-> where('id_non_kendaraan',$idNonKendaraan);
			$query = $this->db->get();
			return $query->result();
		}
		
		
		public function getTrxById($idBarang, $kendaraanOrNo, $tglAwal, $tglAkhir){
			$this ->db-> select('*');
			$this ->db-> from('trx_perawatan');
			$this ->db-> where('id_barang',$idBarang);
			$this ->db-> where('kendaraan_or_no',$kendaraanOrNo);
			$this->db->where('tanggal_selesai  >=', $tglAwal);
			$this->db->where('tanggal_selesai <=', $tglAkhir);
			$query = $this->db->get();
			return $query->result();
		}
			
		public function getPegawaiByOrg($idSatker, $idOrg, $idLevel){
			$query=$this->db->query('SELECT * FROM `master_pegawai` 
					JOIN master_org on master_org.id_org=master_pegawai.id_org
					JOIN autentifikasi on autentifikasi.niplama=master_pegawai.niplama
					JOIN master_level on master_level.id_level=autentifikasi.id_level
					where id_satker='.$idSatker.' AND master_pegawai.id_org='.$idOrg.' AND autentifikasi.id_level='.$idLevel.' 
					ORDER BY `nama` ASC');
			return $query->result();
		}
		
		public function getPegawaiByNiplama($niplama, $idSatker){
			$query=$this->db->query('SELECT * FROM `master_pegawai` 
					JOIN master_org on master_org.id_org=master_pegawai.id_org
					JOIN autentifikasi on autentifikasi.niplama=master_pegawai.niplama
					JOIN master_level on master_level.id_level=autentifikasi.id_level
					where niplama='.$niplama.' AND id_satker='.$idSatker.'
					ORDER BY `nama` ASC');
			return $query->result();
		}
		
		public function hapus_perawatan($idGrupTrx, $idBarang){
			$this -> db -> where('id_grup_trx', $idGrupTrx);
			$this -> db -> where('id_barang', $idBarang);
			$this -> db -> delete('trx_perawatan');
		}
		
		public function get_satker(){
			$this->db->select('*');
			$this->db->from('master_satker');
			$query=$this->db->get();
			return $query->result();
		}
		
		public function get_satker_by_id($idSatker){
			$this->db->select('*');
			$this->db->from('master_satker');
			$this->db->where('id_satker', $idSatker);
			$query=$this->db->get();
			return $query->result();
		}
		
		public function get_kategori(){
			$this->db->select('*');
			$this->db->from('kategori_bmn');
			$query=$this->db->get();
			return $query->result();
		}
		
		public function get_jenis(){
			$this->db->select('*');
			$this->db->from('master_jenis_bmn');
			$this->db->join('kategori_bmn', 'kategori_bmn.id_kategori=master_jenis_bmn.id_kategori_bmn ');
			$this->db->order_by('id_kategori');
			$query=$this->db->get();
			return $query->result();
		}
		
		public function getAsetKendaraanAll($group){
			$query=$this->db->query('SELECT * ,count(id_kendaraan) as jumlah_bmn
					FROM `barang_kendaraan` 
					join master_jenis_bmn on master_jenis_bmn.`id_jenis_bmn`=barang_kendaraan.id_jenis_bmn 
					join kategori_bmn on master_jenis_bmn.id_kategori_bmn=kategori_bmn.id_kategori 
					join master_satker on id_satker=idsatker group by  '.$group.' ASC, idsatker ASC 
					ORDER BY id_kategori');					
			return $query->result();
		}
		public function getAsetNonKendaraanAll($group){
			$query=$this->db->query('SELECT *, count(id_non_kendaraan) as jumlah_bmn
					FROM `barang_non_kendaraan` 
					join master_jenis_bmn on master_jenis_bmn.`id_jenis_bmn`=barang_non_kendaraan.id_jenis_bmn 
					join kategori_bmn on master_jenis_bmn.id_kategori_bmn=kategori_bmn.id_kategori 
					join master_satker on master_satker.id_satker=barang_non_kendaraan.id_satker group by '.$group.' ASC, barang_non_kendaraan.id_satker ASC
					ORDER BY id_kategori');
			return $query->result();
		}
		
		public function getAsetKendaraanPegawaiAll($idSatker){
			$query=$this->db->query('SELECT * ,count(id_kendaraan) as jumlah_bmn
					FROM `barang_kendaraan` 
					join master_jenis_bmn on master_jenis_bmn.`id_jenis_bmn`=barang_kendaraan.id_jenis_bmn 
					join kategori_bmn on master_jenis_bmn.id_kategori_bmn=kategori_bmn.id_kategori 
					join master_pegawai on master_pegawai.niplama=barang_kendaraan.niplama 
					'.$idSatker.'
					group by  barang_kendaraan.niplama ASC, master_jenis_bmn.id_kategori_bmn ASC 
					ORDER BY nama');					
			return $query->result();
		}
		public function getAsetNonKendaraanPegawaiAll($idSatker){
			$query=$this->db->query('SELECT *, count(id_non_kendaraan) as jumlah_bmn
					FROM `barang_non_kendaraan` 
					join master_jenis_bmn on master_jenis_bmn.`id_jenis_bmn`=barang_non_kendaraan.id_jenis_bmn 
					join kategori_bmn on master_jenis_bmn.id_kategori_bmn=kategori_bmn.id_kategori 
					join master_pegawai on master_pegawai.niplama=barang_non_kendaraan.niplama 
					'.$idSatker.'
					group by  barang_non_kendaraan.niplama ASC, master_jenis_bmn.id_kategori_bmn ASC 
					
					 ORDER BY id_kategori');
			return $query->result();
		}
		
		
		public function getPegawai($satker){
			
			$query=Array();
			if($satker==''){
				$query=$this->db->query('SELECT * FROM 
						`master_pegawai`   
						ORDER BY `nama` ASC'  );
			}else{
				$query=$this->db->query('SELECT * FROM 
						`master_pegawai` where id_satker="'.$satker.'"  
						ORDER BY `nama` ASC' );
			}
			return $query->result();
		}
		
	}
?>