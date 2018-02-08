<?php
 
 class Barang_persediaan_model extends CI_Model {
	public function __construct()
	{
				// Call the CI_Model constructor
				parent::__construct();
				$this->load->database();
	}
	
	public function get_barang_persediaan_by_id($kd_brg, $idSatker){
		$this->db->select('*');
		$this->db->from('barang_persediaan');
		$this->db->where('kd_brg', $kd_brg);
		$this->db->where('id_satker', $idSatker);
		$this->db->where('id_satker', $this->session->userdata('id_satker'));
		$query = $this->db->get();
		
		return $query->result();
	}
	
	public function get_barang_persediaan_by_satker($id_satker){
		$this->db->select('*');
		$this->db->from('barang_persediaan');
		$this->db->where('id_satker', $id_satker);
		$query = $this->db->get();
		
		return $query->result();
	}
	
	public function edit_master_persediaan($data,$idCad){
		$this->db->where('kd_brg', $idCad);
		$this->db->where('id_satker', $data['id_satker']);
		$this->db->update('barang_persediaan', $data);
		
							
		$query1 = $this->db->query('UPDATE trx_keluar SET kd_brg="'.$data['kd_brg'].
							'" WHERE  kd_brg="'.$idCad.'" AND id_satker="'.$data['id_satker'].'"');
		//$query1->result();
		
		$query2 = $this->db->query('UPDATE trx_masuk SET kd_brg="'.$data['kd_brg'].
							'" WHERE  kd_brg="'.$idCad.'" AND id_satker="'.$data['id_satker'].'"');
		//$query2->result();
	}
	
	public function hapus_barang_persediaan($kd_brg, $id_satker){
		$this->db->where('kd_brg', $kd_brg);
		$this->db->where('id_satker', $id_satker);
		$this->db->delete('barang_persediaan');
		
		$this->db->where('kd_brg', $kd_brg);
		$this->db->where('id_satker', $id_satker);
		$this->db->delete('trx_masuk');
		
		$this->db->where('kd_brg', $kd_brg);
		$this->db->where('id_satker', $id_satker);
		$this->db->delete('trx_keluar');
		
	}
	
	public function input_transaksi_masuk($data){
		$this->db->insert_batch('trx_masuk',$data);
	}
	
	public function input_master_persediaan($data){
		$this->db->insert('barang_persediaan',$data);
	}
	
	public function get_satker(){
			$this->db->select('*');
			$this->db->from('master_satker');
			$query=$this->db->get();
			return $query->result();
		}
	
	public function get_stok($idSatker){
		$query2 = $this->db->query('SELECT masuk.kd_brg, ur_brg, satuan, (jml_masuk-jml_keluar) as stok , jml_masuk, jml_keluar
                  FROM (SELECT barang_persediaan.kd_brg, coalesce(sum(jumlah),0) as jml_masuk , ur_brg, 							satuan 
                        FROM `barang_persediaan` 
                        LEFT join (select * 
                                   from trx_masuk where trx_masuk.id_satker="'.$idSatker.'") as trx_masuk 
                        			on trx_masuk.kd_brg=barang_persediaan.kd_brg 
                        			where barang_persediaan.id_satker="'.$idSatker.'" 
                        			group by barang_persediaan.kd_brg) AS masuk, 
                        (SELECT barang_persediaan.kd_brg, coalesce(sum(jumlah),0) as jml_keluar 
                                   FROM `barang_persediaan` 
                                   left join (SELECT * from trx_keluar where trx_keluar.id_satker="'.$idSatker.'") 										as trx_keluar on trx_keluar.kd_brg=barang_persediaan.kd_brg 
                                             where barang_persediaan.id_satker="'.$idSatker.'"
                                             group by barang_persediaan.kd_brg) AS keluar
                                        where masuk.kd_brg=keluar.kd_brg
                                        group by masuk.kd_brg
                                        order by stok DESC, ur_brg ASC');
		return $query2->result();
	}
	
	public function get_stok_by_time($tglAkhir, $idSatker){
		$query2 = $this->db->query('SELECT masuk.kd_brg, ur_brg, satuan, (jml_masuk-jml_keluar) as stok , jml_masuk, jml_keluar
                  FROM (SELECT barang_persediaan.kd_brg, coalesce(sum(jumlah),0) as jml_masuk , ur_brg, 							satuan 
                        FROM `barang_persediaan` 
                        LEFT join (select * 
                                   from trx_masuk where trx_masuk.id_satker="'.$idSatker.'" AND tgl_masuk <= "'.$tglAkhir.'") as trx_masuk 
                        			on trx_masuk.kd_brg=barang_persediaan.kd_brg 
                        			where barang_persediaan.id_satker="'.$idSatker.'" 
                        			group by barang_persediaan.kd_brg) AS masuk, 
                        (SELECT barang_persediaan.kd_brg, coalesce(sum(jumlah),0) as jml_keluar 
                                   FROM `barang_persediaan` 
                                   left join (SELECT * from trx_keluar where trx_keluar.id_satker="'.$idSatker.'" AND tgl_keluar <="'.$tglAkhir.'") 										as trx_keluar on trx_keluar.kd_brg=barang_persediaan.kd_brg 
                                             where barang_persediaan.id_satker="'.$idSatker.'"
                                             group by barang_persediaan.kd_brg) AS keluar
                                        where masuk.kd_brg=keluar.kd_brg
                                        group by masuk.kd_brg
                                        order by stok DESC, ur_brg ASC');
		return $query2->result();
	}
	
	public function get_seksi(){
		$this->db->select('*');
		$this->db->from('master_seksi');
		$query = $this->db->get();
		
		return $query->result();
	}
	
	public function get_seksi_by_id($id){
		$this->db->select('*');
		$this->db->from('master_seksi');
		$this->db->where('id_seksi',$id);
		$query = $this->db->get();
		
		return $query->result();
	}
	public function get_bidang(){
		$this->db->select('*');
		$this->db->from('master_bidang');
		$query = $this->db->get();
		
		return $query->result();
	}
	
	public function get_bidang_by_id($id){
		$this->db->select('*');
		$this->db->from('master_bidang');
		$this->db->where('id_bidang',$id);
		
		$query = $this->db->get();
		
		return $query->result();
	}
	
	public function input_transaksi_keluar($data){
		$this->db->insert_batch('trx_keluar',$data);
	}
	
	public function input_master_barang($data){
		$this->db->insert_batch('barang_persediaan',$data);
	}
	
	public function queryTrxKeluar($kd_brg, $tglAwal, $tglAkhir, $idSatker){
		$this->db->select('*');
		$this->db->from('trx_keluar');
		$this->db->where('kd_brg =', $kd_brg);
		$this->db->where('id_satker =', $idSatker);
		$this->db->where('tgl_keluar  >=', $tglAwal);
		$this->db->where('tgl_keluar <=', $tglAkhir);
		$query = $this->db->get();
		
		return $query->result();
	}
	
	public function queryTrxKeluarUmum( $kdSatker){
		$query = $this->db->query('SELECT id_trx_k, count(id_trx_k), barang_persediaan.kd_brg, 
										trx_keluar.id_satker, id_bdg_sks
									FROM `trx_keluar` 
									join barang_persediaan ON barang_persediaan.`kd_brg`= `trx_keluar`.`kd_brg` 
									where trx_keluar.id_satker='.$kdSatker.'
									group by id_trx_k 
									order by `id_trx_k` DESC');
		return $query->result();
	}
	
	public function queryTrxMasukUmum( $kdSatker){
		$query = $this->db->query('SELECT id_trx_m, count(id_trx_m), barang_persediaan.kd_brg, 
										trx_masuk.id_satker, penyedia
									FROM `trx_masuk` 
									join barang_persediaan ON barang_persediaan.`kd_brg`= `trx_masuk`.`kd_brg` 
									where trx_masuk.id_satker='.$kdSatker.'
									group by id_trx_m 
									order by `id_trx_m` DESC');
		return $query->result();
	}
	
	function queryOneByOneTrxMasuk($kdSatker){
		$query=$this->queryTrxMasukUmum($kdSatker);
		//print_r($query);
		$elementResult=Array();
		
		foreach($query as $row){
			$resultQuery=$this->commonQuery('SELECT * 
									FROM `trx_masuk` 
									join barang_persediaan on barang_persediaan.`kd_brg`= `trx_masuk`.kd_brg 
									where `id_trx_m`='.$row->id_trx_m.' AND barang_persediaan.id_satker='.$kdSatker.'
									ORDER BY `tgl_masuk` ASC'
					);	
			
			$barang="";
			foreach($resultQuery as $rowResult){
				$barang=$barang." ".$rowResult->ur_brg." ( ".$rowResult->jumlah." )";
			}
			//print_r($resultQuery);
			if(sizeof($resultQuery)>=1){
				$elementResult[]= array (
					'id_trx_m'=>$resultQuery[0]->id_trx_m,
					'penyedia' => $resultQuery[0]->penyedia, 
					'tgl_input' => $resultQuery[0]->tgl_masuk,
					'ringkasan_input' => $barang
				);	
			}
			
		}
		return $elementResult;
	}
	
	public function query_daftar_transaksi_masuk($kdSatker){
		return $this->queryOneByOneTrxMasuk($kdSatker);
		//print_r($this->queryOneByOneTrxMasuk($kdSatker));
	}
	
	public function hapus_transaksi_masuk($id_transaksi_masuk){
		$this -> db -> where('id_trx_m', $id_transaksi_masuk);
		$this -> db -> delete('trx_masuk');
	}
	
	function queryOneByOneTrxKeluar($kdSatker){
		$query=$this->queryTrxKeluarUmum($kdSatker);
		//print_r($query);
		$elementResult=Array();
		
		foreach($query as $row){
			if(substr ($row->id_bdg_sks, 0, 1) == 's'){
				$resultQuery=$this->commonQuery('SELECT * 
									FROM `trx_keluar` 
									join barang_persediaan on barang_persediaan.`kd_brg`= `trx_keluar`.kd_brg 
									join master_seksi on master_seksi.id_seksi='.substr ($row->id_bdg_sks, 1, 2).' 
									where `id_trx_k`='.$row->id_trx_k.' AND barang_persediaan.id_satker='.$kdSatker.'
									ORDER BY `tgl_keluar` ASC'
					);	
					$barang="";
					foreach($resultQuery as $rowResult){
						$barang=$barang." ".$rowResult->ur_brg." ( ".$rowResult->jumlah." )";
					}
					$elementResult[]= array (
							'id_trx_k'=>$resultQuery[0]->id_trx_k,
							'unit_kerja' => $resultQuery[0]->nm_seksi, 
							'tgl_permintaan' => $resultQuery[0]->tgl_keluar,
							'ringkasan_permintaan' => $barang
					);	
				
			}else if(substr ($row->id_bdg_sks, 0, 1) == 'b'){
				$resultQuery=$this->commonQuery('SELECT * 
									FROM `trx_keluar` 
									join barang_persediaan on barang_persediaan.`kd_brg`= `trx_keluar`.kd_brg 
									join master_bidang on master_bidang.id_bidang='.substr ($row->id_bdg_sks, 1, 2).' 
									where `id_trx_k`='.$row->id_trx_k.' AND barang_persediaan.id_satker='.$kdSatker.'
									ORDER BY `tgl_keluar` ASC'
					);	
					
					$barang="";
					foreach($resultQuery as $rowResult){
						$barang=$barang." ".$rowResult->ur_brg." ( ".$rowResult->jumlah." )";
					}
					$elementResult[]= array (
							'id_trx_k'=>$resultQuery[0]->id_trx_k,
							'unit_kerja' => $resultQuery[0]->nm_bidang, 
							'tgl_permintaan' => $resultQuery[0]->tgl_keluar,
							'ringkasan_permintaan' => $barang
					);	
			}else{
				$resultQuery=$this->commonQuery('SELECT * 
									FROM `trx_keluar` 
									join barang_persediaan on barang_persediaan.`kd_brg`= `trx_keluar`.kd_brg 
									where `id_trx_k`='.$row->id_trx_k. ' AND barang_persediaan.id_satker='.$kdSatker.'
									ORDER BY `tgl_keluar` ASC'
					);	
					
					$barang="";
					foreach($resultQuery as $rowResult){
						$barang=$barang." ".$rowResult->ur_brg." ( ".$rowResult->jumlah." )";
					}
					$elementResult[]= array (
							'id_trx_k'=>$resultQuery[0]->id_trx_k,
							'unit_kerja' => 'Stock Opname', 
							'tgl_permintaan' => $resultQuery[0]->tgl_keluar,
							'ringkasan_permintaan' => $barang
					);	
			}
		}
		return $elementResult;
		//print_r($elementResult);
		//print_r($elementResultBidang);
		//print_r($elementResultStockCek);
	}
	public function commonQuery($sql){
		$query = $this->db->query($sql);
		return $query->result();
	}
	
	public function query_daftar_transaksi_keluar($kdSatker){
		return $this->queryOneByOneTrxKeluar($kdSatker);
	}
	
	public function hapus_transaksi_keluar($id_transaksi_keluar){
		$this -> db -> where('id_trx_k', $id_transaksi_keluar);
		$this -> db -> delete('trx_keluar');
	}
	
	public function queryTrxMasuk($kd_brg, $tglAwal, $tglAkhir, $idSatker){
		$this->db->select('*');
		$this->db->from('trx_masuk');
		$this->db->where('kd_brg =', $kd_brg);
		$this->db->where('id_satker =', $idSatker);
		$this->db->where('tgl_masuk  >=', $tglAwal);
		$this->db->where('tgl_masuk <=', $tglAkhir);
		$query = $this->db->get();
		
		return $query->result();
	}
	
	public function queryStokAwalKeluar($tgl_keluar, $kd_brg){
		$this->db->select('kd_brg, sum(jumlah) as jumlah');
		$this->db->from('trx_keluar');
		$this->db->where('tgl_keluar < ',$tgl_keluar);
		$this->db->where('kd_brg',$kd_brg);
		$query = $this->db->get();
		
		return $query->result();
	}
	
	public function queryStokAwalMasuk($tgl_masuk, $kd_brg){
		$this->db->select('kd_brg, sum(jumlah) as jumlah');
		$this->db->from('trx_masuk');
		$this->db->where('tgl_masuk< ',$tgl_masuk);
		$this->db->where('kd_brg',$kd_brg);
		$query = $this->db->get();
		
		return $query->result();
	}
	
	public function queryItemTrxKeluar($idTrxKeluar, $idSatker){
		$query = $this->db->query('SELECT * 
									FROM `trx_keluar` 
									join barang_persediaan on barang_persediaan.`kd_brg`= `trx_keluar`.kd_brg 
									where `id_trx_k`='.$idTrxKeluar. ' AND barang_persediaan.id_satker='.$idSatker.'
									ORDER BY `tgl_keluar` ASC');
		return $query->result();
	}
	
	public function queryItemTrxMasuk($idTrxMasuk, $idSatker){
		$query = $this->db->query('SELECT * 
									FROM `trx_masuk` 
									join barang_persediaan on barang_persediaan.`kd_brg`= `trx_masuk`.kd_brg 
									where `id_trx_m`='.$idTrxMasuk. ' AND barang_persediaan.id_satker='.$idSatker.'
									ORDER BY `tgl_masuk` ASC');
		return $query->result();
	}
	
	public function queryrTrxKeluarByUnitKerja($id_unit_kerja, $id_satker, $tglAwal, $tglAkhir){
		$query = $this->db->query('SELECT * FROM (SELECT * from trx_keluar 
						where trx_keluar.id_satker='.$id_satker.' AND 
						`tgl_keluar`>="'.$tglAwal.'" AND `tgl_keluar`<="'.$tglAkhir.'" 
						AND `id_bdg_sks`="'.$id_unit_kerja.'") as trx_keluar
						join (SELECT * FROM `barang_persediaan` where `id_satker`='.$id_satker.') as barang_persediaan 
							on barang_persediaan.kd_brg=trx_keluar.kd_brg
						ORDER BY tgl_keluar ASC');
		return $query->result();
	}
	
	public function queryrTrxKeluarByUnitKerja2($id_unit_kerja, $id_satker, $tglAwal, $tglAkhir){
		$query = $this->db->query('SELECT * FROM (SELECT *, sum(jumlah) as sumJumlah from trx_keluar 
						where trx_keluar.id_satker='.$id_satker.' AND 
						`tgl_keluar`>="'.$tglAwal.'" AND `tgl_keluar`<="'.$tglAkhir.'" 
						AND `id_bdg_sks`="'.$id_unit_kerja.'" Group BY kd_brg) as trx_keluar
						join (SELECT * FROM `barang_persediaan` where `id_satker`='.$id_satker.') as barang_persediaan 
							on barang_persediaan.kd_brg=trx_keluar.kd_brg
						ORDER By tgl_keluar');
		return $query->result();
	}
	
	public function getBarangTrxKeluarBeetwen($tglAwal, $tglAkhir, $idSatker){
		$query = $this->db->query('SELECT * 
									FROM  trx_keluar
									WHERE tgl_keluar >="'.$tglAwal.'" AND tgl_keluar<="'.$tglAkhir.'" AND id_satker="'.$idSatker.'"
									group by kd_brg');
		return $query->result();
	}
	
	public function getBarangTrxMasukBeetwen($tglAwal, $tglAkhir, $idSatker){
		$query = $this->db->query('SELECT * 
									FROM trx_masuk
									WHERE tgl_masuk >="'.$tglAwal.'" AND tgl_masuk<="'.$tglAkhir.'" AND id_satker="'.$idSatker.'"
									group by kd_brg');
		return $query->result();
	}
	
 }