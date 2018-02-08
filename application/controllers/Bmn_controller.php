<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bmn_controller extends CI_Controller {
	
	var $varBantu ="" ;
	
	public function __construct(){
		parent::__construct();
		
			$this->load->model('Jenis_bmn_model');
			$this->load->model('Pegawai_model');
			$this->load->helper('url');
			$this->load->helper(array('form', 'url'));
			$this->load->library("excel/PHPExcel");
			//$this->load->model('Bmn_model');
			//$this->load->helper('url');
			//$this->load->helper(array('form', 'url'));
			
			if($this->session->userdata('status') != "login" || $this->session->userdata('id_sibaper')==0){
				redirect(base_url("login.html"));
			}
	}
	
	//master Jenis Barang Page
	public function master_jenis_bmn_page(){
		$content['page']='bmn/input_jenis_bmn';
		$content['judul_halaman']='Master Jenis BMN';
		$query=$this->Jenis_bmn_model->getKategori();
		$query2=$this->Jenis_bmn_model->getJenisBarang();
		$content['kategori']=$query;
		$content['jenis_barang']=$query2;
		
		$this->load->view('template/layout', $content);
	}
	
	public function aksi_input_jenis_bmn(){
		$data=Array();
		$data=Array(
				'merk'=>$this->input->post('merk'),
				'type'=>$this->input->post('type'),
				'id_kategori_bmn'=>$this->input->post('kategori')
			);
			if($this->Jenis_bmn_model->input_jenis_bmn($data)==1){
				redirect('inputJenisBmn.html');
			}
		//print_r($data);
	}
	
	public function aksi_edit_jenis_bmn(){
		$data=Array();
		$data=Array(
				'merk'=>$this->input->post('merk'),
				'type'=>$this->input->post('type'),
				'id_kategori_bmn'=>$this->input->post('kategori'),
				'id_jenis_bmn'=>$this->input->post('idJenisBmn')
			);
			//print_r($data);
			if($this->Jenis_bmn_model->edit_jenis_bmn($data)==1){
				redirect('inputJenisBmn.html');
			}
		//print_r($data);
	}
	
	public function aksi_edit_kendaraan(){
		$link="";
		//echo "test--".$this->input->post('namaFileKendaraan');
		if($this->input->post('namaFileKendaraan')==""){
			if($_FILES['fotoKendaraan']['name']!=""){
				$link='kendaraaan'.$this->session->userdata('id_satker').date("YmdHis").'.jpg';
				$this->upload_dokumen('./assets/images/bmn/', 'fotoKendaraan','jpg|jpeg|png', $link);
			}
		}else{
			$link=$this->input->post('namaFileKendaraan');
			if($_FILES['fotoKendaraan']['name']!=""){
				$this->upload_dokumen('./assets/images/bmn/', 'fotoKendaraan','jpg|jpeg|png', $link);
			}
			//echo $link;
		}
		$data=Array();
		$data=Array(
				'id_kendaraan'=>$this->input->post('idKendaraan'),
				'no_pol'=>$this->input->post('no_pol'),
				'no_rangka'=>$this->input->post('no_rangka'),
				'no_mesin'=>$this->input->post('no_mesin'),
				'tahun_kendaraan'=>$this->input->post('tahun_kendaraan'),
				'tgl_stnk'=>$this->setDateFormat($this->input->post('tgl_stnk')),
				'niplama'=>$this->input->post('pegawai'),
				'idSatker'=>$this->session->userdata('id_satker'),
				'id_jenis_bmn'=>$this->input->post('idJenisBmn'),
				'link_foto'=>$link
			);
			//print_r($data);
			if($this->Jenis_bmn_model->editUmum('barang_kendaraan',$data)==1){
				redirect('inputBmn.html');
		}
		//print_r($data);
	}
	
	public function aksi_edit_non_kendaraan(){
		$link="";
		if($this->input->post('namaFileNonKendaraan')==""){
			if($_FILES['fotoNonKendaraan']['name']!=""){
				$link='nonkendaraaan'.$this->session->userdata('id_satker').date("YmdHis").'.jpg';
				$this->upload_dokumen('./assets/images/bmn/', 'fotoNonKendaraan','jpg|jpeg|png', $link);
			}
		}else{
			$link=$this->input->post('namaFileNonKendaraan');
			if($_FILES['fotoNonKendaraan']['name']!=""){
				$this->upload_dokumen('./assets/images/bmn/', 'fotoNonKendaraan','jpg|jpeg|png', $link);
			}
		}
		
		$data=Array();
		$data=Array(
				'id_non_kendaraan'=>$this->input->post('idNonKendaraan'),
				'identitas_barang'=>$this->input->post('identitas'),
				'tahun'=>$this->input->post('tahun'),
				'id_jenis_bmn'=>$this->input->post('idJenisBmn'),
				'id_satker'=>$this->session->userdata('id_satker'),
				'niplama'=>$this->input->post('pegawai'),
				'link_foto'=>$link
			);
			//print_r($data);
			if($this->Jenis_bmn_model->editUmum('barang_non_kendaraan',$data)==1){
				redirect('inputBmn.html');
			}
		//print_r($data);
	}
	
	public function aksi_hapus_jenis_bmn($idBarang){
			if($this->Jenis_bmn_model->hapus_jenis_bmn($idBarang)==1){
				redirect('inputJenisBmn.html');
			}
		//print_r($data);
	}
	
	public function aksi_input_kendaraan(){
		$link='';
		if($_FILES['fotoKendaraan']['name']!=""){
			$link='kendaraaan'.$this->session->userdata('id_satker').date("YmdHis").'.jpg';
			$this->upload_dokumen('./assets/images/bmn/', 'fotoKendaraan','jpg|jpeg|png', $link);
		}
		
		$data=Array();
		$data=Array(
				'no_pol'=>$this->input->post('no_pol'),
				'no_mesin'=>$this->input->post('no_mesin'),
				'no_rangka'=>$this->input->post('no_rangka'),
				'tahun_kendaraan'=>$this->input->post('tahun_kendaraan'),
				'tgl_stnk'=>$this->setDateFormat($this->input->post('tgl_stnk')),
				'niplama'=>$this->input->post('pegawai'),
				'idsatker'=>$this->session->userdata('id_satker'),
				'id_jenis_bmn'=>$this->input->post('idJenisBmn'),
				'link_foto'=>$link
			);
			//print_r($data);
			if($this->Jenis_bmn_model->input_bmn('barang_kendaraan',$data)==1){
				redirect('inputBmn.html');
			}
	}
	
	public function aksi_input_non_kendaraan(){
		$link="";
		if($_FILES['fotoNonKendaraan']['name']!=""){
			$link='nonkendaraaan'.$this->session->userdata('id_satker').date("YmdHis").'.jpg';
			$this->upload_dokumen('./assets/images/bmn/', 'fotoNonKendaraan','jpg|jpeg|png', $link);
		}
		$data=Array();
		$data=Array(
					'identitas_barang'=>$this->input->post('identitas'),
					'tahun'=>$this->input->post('tahun'),
					'niplama'=>$this->input->post('pegawai'),
					'id_satker'=>$this->session->userdata('id_satker'),
					'id_jenis_bmn'=>$this->input->post('idJenisBmn'),
					'link_foto'=>$link
				);
				
				//print_r($data);
				if($this->Jenis_bmn_model->input_bmn('barang_non_kendaraan', $data)==1){
					redirect('inputBmn.html');
				}
				
	}
	
	public function master_bmn_page(){
		$content['page']='bmn/inputBmn';
		$content['judul_halaman']='Master BMN';
		//$query=$this->Jenis_bmn_model->getKategori();
		$query2=$this->Jenis_bmn_model->getJenisBarang();
		$query=$this->Pegawai_model->get_pegawai_by_satker($this->session->userData('id_satker'));
		$query3=$this->Jenis_bmn_model->get_kendaraan($this->session->userData('id_satker'));
		$query4=$this->Jenis_bmn_model->get_non_kendaraan($this->session->userData('id_satker'));
		//print_r($query3);
		$content['barangKendaraan']=$query3;
		$content['barangNonKendaraan']=$query4;
		$content['pegawai']=$query;
		$content['jenis_barang']=$query2;
		
		$this->load->view('template/layout', $content);
	}
	
	public function aksi_hapus_kendaraan($id){
		if($this->Jenis_bmn_model->hapus('barang_kendaraan', 'id_kendaraan',$id)==1){
				redirect('inputBmn.html');
			}
	}
	
	public function aksi_hapus_non_kendaraan($id){
		if($this->Jenis_bmn_model->hapus('barang_non_kendaraan', 'id_non_kendaraan',$id)==1){
				redirect('inputBmn.html');
			}
	}
	
	public function upload_dokumen($path, $field, $types, $fileName)
	{
			$this->load->library('upload');
			$this->upload->initialize(array(
					"upload_path"   => $path,
					"allowed_types"=> $types,
					"file_name"=> $fileName
			));
			if($_FILES[$field]['name']!=""){
				if(is_file($path.$fileName)){
					unlink($path.$fileName);
				};
				
				if ( !$this->upload->do_upload($field))
				{
					$error = array('error' => $this->upload->display_errors());
					return $error;	
				}
				else
				{
					return "Sukses";   
				}
			}else{
				return "Sukses";   
			}
	}
		
	public function setDateFormat($strigDate){
		$pieces = explode("/", $strigDate);
		$date="";
		if(sizeof($pieces)>2){
			$date=$pieces[2]."-".$pieces[0]."-".$pieces[1];
		}
		return $date;
	}
	
	public function input_perawatan_page(){
		$content['page']='bmn/inputDaftarPerawatan';
		$content['judul_halaman']='Input Dan Daftar Perawatan BMN';
		$content['pageInput']='bmn/inputPerawatan';
		$content['pageDaftar']='bmn/daftarPerawatan';
		
		$query3=$this->Jenis_bmn_model->get_kendaraan($this->session->userData('id_satker'));
		$query4=$this->Jenis_bmn_model->get_non_kendaraan($this->session->userData('id_satker'));
		$query5=$this->Jenis_bmn_model->get_daftar_perawatan($this->session->userData('id_satker'));
		
		$content['bmnKendaraan']=$query3;
		$content['bmnNonKendaraan']=$query4;
		$content['daftarPerawatan']=$query5;
		
		$this->load->view('template/layout', $content);
	}
	
	public function aksi_input_perawatan(){
		$pekerjaan=$this->input->post('pekerjaan');
		$sparepart=$this->input->post('sparepart');
		$keterangan=$this->input->post('keterangan');
		$biaya=$this->input->post('biaya');
		$id_grup_trx=date("YmdHis");
		$data=Array();
		$i=0;
		foreach($biaya as $row){
				if($row!=""){
					$data[]=Array(
						'id_grup_trx'=>$id_grup_trx,
						'tanggal_dicatat'=>$this->setDateFormat($this->input->post('tglMulai')),
						'tanggal_selesai'=>$this->setDateFormat($this->input->post('tglSelesai')),
						'no_spk'=>$this->input->post('nmrSpk'),
						'pekerjaan'=> $pekerjaan[$i],
						'sparepart'=>$sparepart[$i],
						'km'=>$this->input->post('km'),
						'penyedia'=>$this->input->post('penyedia'),
						'biaya'=>$biaya[$i],
						'keterangan'=>$keterangan[$i],
						'id_barang'=>$this->input->post('Bmn'),
						'kendaraan_or_no'=>$this->input->post('kategori')
					);
				}
				$i++;
		}
		//echo $this->Jenis_bmn_model->input_perawatan('trx_perawatan',$data);
		$this->Jenis_bmn_model->input_perawatan('trx_perawatan',$data);
		
		if($this->input->post('byIdOrNot')=="notId"){
			redirect('inputPerawatan.html');
		}else{
			redirect('perawatanba/'.$this->input->post('kategori').'/'.
						$this->input->post('Bmn').'/'.'bmn');
		}
		
		//echo "dasdasdsa";
		print_r($data);
	}
	
	public function aksi_hapus_daftar_perawatan($idGrupTrx, $idBarang){
		$this->Jenis_bmn_model->hapus_perawatan($idGrupTrx, $idBarang);
		redirect('inputPerawatan.html');
	}
	
	public function edit_perawatan_page($idGrupTrx, $idBarang){
		$content['page']='bmn/inputDaftarPerawatan';
		$content['judul_halaman']='Edit dan Daftar Perawatan BMN';
		$content['pageInput']='bmn/editPerawatanById';
		$content['pageDaftar']='bmn/daftarPerawatan';
		
		$itemPerawatan=$this->Jenis_bmn_model->get_perawatan_by_id($idGrupTrx, $idBarang);
		
		$namaBmn="";
		$displayKm="";
		$show=true;
		
		if(sizeof($itemPerawatan)>0){
			if($itemPerawatan[0]->kendaraan_or_no=='1'){
				$query3=$this->Jenis_bmn_model->getKendaraanById($idBarang);
				if(sizeof($query3)>0){
					$namaBmn=$query3[0]->merk.' '.$query3[0]->type.' ('.$query3[0]->no_pol.')';
					$displayKm="";
				}else{
					$show=false;
				}
			}else if($itemPerawatan[0]->kendaraan_or_no=='2'){
				$query4=$this->Jenis_bmn_model->getNonKendaraanById($idBarang);
				if(sizeof($query4)>0){
					$namaBmn=$query4[0]->merk.' '.$query4[0]->type.'('.$query4[0]->identitas_barang.')';
					$displayKm="display:none";
				}
				else{
					$show=false;
				}
			}
			$content['namaBmn']=$namaBmn;
			$content['idGrupPerawatan']=$idGrupTrx;
			$content['penyedia']=$itemPerawatan[0]->penyedia;
			$content['nmrSpk']=$itemPerawatan[0]->no_spk;
			$content['tglMulai']=$this->setDateFormatToField2($itemPerawatan[0]->tanggal_dicatat);
			$content['tglSelesai']=$this->setDateFormatToField2($itemPerawatan[0]->tanggal_selesai);
			$content['km']=$itemPerawatan[0]->km;
			$content['daftarEditPerawatan']=$itemPerawatan;
			$content['displayKm']=$displayKm;
			$content['bmn']=$idBarang;
			$content['kategori']=$itemPerawatan[0]->kendaraan_or_no;
			$query5=$this->Jenis_bmn_model->get_daftar_perawatan($this->session->userData('id_satker'));
			$content['daftarPerawatan']=$query5;
		}else{
					$show=false;
		}
		if($show){
			$this->load->view('template/layout', $content);
		}else{
			show_404();
		}
		
	}
	
	public function edit_perawatan_aksi(){
		$pekerjaan=$this->input->post('pekerjaan');
		$sparepart=$this->input->post('sparepart');
		$keterangan=$this->input->post('keterangan');
		$biaya=$this->input->post('biaya');
		$id_grup_trx=$this->input->post('idGrupPerawatan');
		
		$this->Jenis_bmn_model->hapus_perawatan($id_grup_trx, $this->input->post('Bmn'));
		$data=Array();
		$i=0;
		foreach($biaya as $row){
				if($row!=""){
					$data[]=Array(
						'id_grup_trx'=>$id_grup_trx,
						'tanggal_dicatat'=>$this->setDateFormat($this->input->post('tglMulai')),
						'tanggal_selesai'=>$this->setDateFormat($this->input->post('tglSelesai')),
						'no_spk'=>$this->input->post('nmrSpk'),
						'pekerjaan'=> $pekerjaan[$i],
						'sparepart'=>$sparepart[$i],
						'km'=>$this->input->post('km'),
						'penyedia'=>$this->input->post('penyedia'),
						'biaya'=>$biaya[$i],
						'keterangan'=>$keterangan[$i],
						'id_barang'=>$this->input->post('Bmn'),
						'kendaraan_or_no'=>$this->input->post('kategori')
					);
				}
				$i++;
		}
		
		//echo $this->Jenis_bmn_model->input_perawatan('trx_perawatan',$data);
		$this->Jenis_bmn_model->input_perawatan('trx_perawatan',$data);
			
		redirect('inputPerawatan.html');
		
	}
	
	public function kartu_kendali_page(){
		$content['page']='bmn/kartu_kendali_bmn';
		$content['judul_halaman']='Kartu Kendali BMN';
		$query3=$this->Jenis_bmn_model->get_kendaraan($this->session->userData('id_satker'));
		$query4=$this->Jenis_bmn_model->get_non_kendaraan($this->session->userData('id_satker'));
		
		$content['kendaraan']=$query3;
		$content['non_kendaraan']=$query4;
		
		$content['karkenHtml']="";
		$content['bmnCad']='';
		$content['kendaraanOrNoCad']='';
		$content['tglAwalCad']='';
		$content['tglAkhirCad']='';
		
		$this->load->view('template/layout', $content);
	}
	
	public function aksi_karken_bmn(){
		$content['page']='bmn/kartu_kendali_bmn';
		$content['judul_halaman']='Kartu Kendali BMN';
		$query3=$this->Jenis_bmn_model->get_kendaraan($this->session->userData('id_satker'));
		$query4=$this->Jenis_bmn_model->get_non_kendaraan($this->session->userData('id_satker'));
		
		$content['kendaraan']=$query3;
		$content['non_kendaraan']=$query4;
		
		$idBarang=$this->input->post('bmn');
		//$kendaraanOrNo=$this->input->post('kendaraan_or_no');
		$tglAwal=$this->setDateFormat($this->input->post('tglAwal'));
		$tglAkhir=$this->setDateFormat($this->input->post('tglAkhir'));
		
		$content['bmnCad']=json_encode($idBarang);
		$content['kendaraanOrNoCad']='';
		$content['tglAwalCad']=$tglAwal;
		$content['tglAkhirCad']=$tglAkhir;
		
		
		$i=0;
		$head='<div class="" role="tabpanel" data-example-id="togglable-tabs">
						<ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">';
		foreach($idBarang as $row){
			if($i==0){
				$head=$head.'<li role="presentation" class="active"><a href="#tab_content0" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">'.($i+1).'</a></li>';
			}else{
				$head=$head.'<li role="presentation"  class=""><a href="#tab_content'.$i.'" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">'.($i+1).'</a></li>';		 
			}
			$i++;		
		}
		$head=$head.'</ul></div>';
		
		$isi='<div id="myTabContent" class="tab-content">';
		$j=0;
		
		foreach($idBarang as $row){
			$barangPlus=explode('-',$row);
			
			if($j==0){
				$isi=$isi.'<div role="tabpanel" class="tab-pane fade active in" id="tab_content0" aria-labelledby="home-tab">';
			}else{
				$isi=$isi.'<div role="tabpanel" class="tab-pane fade" id="tab_content'.$j.'" aria-labelledby="home-tab">';
			}
			
			//$objPHPExcel=new PHPExcel();
			if($barangPlus[1]=='1'){
				$objPHPExcel=PHPExcel_IOFactory::load(APPPATH.'libraries/excel/templateBmnKendaraan.xlsx');
			}else{
				$objPHPExcel=PHPExcel_IOFactory::load(APPPATH.'libraries/excel/templateBmnNonKendaraan.xlsx');
			}
			
			$objPHPExcel->getActiveSheet()->setTitle('0');
			$isi=$isi.$this->isitabel($objPHPExcel, $barangPlus[0], $barangPlus[1], $tglAwal, $tglAkhir, 'buat', 0);
			
			$isi=$isi.'</div>';
			$j++;
		}
		
		$isi=$isi.'</div>';
		$content['karkenHtml']=$head.$isi;
		$this->load->view('template/layout', $content);
	}
	
	public function isitabel($objPHPExcel, $idBarang, $kendaraanOrNo, $tglAwal, $tglAkhir, $jenisPerintah, $index){
		
		$nm_satker="";
		$mengetahui="";
		$nmMengetahui="";
		$nmYngMengurus="";
		$nipMengetahui="";
		$nipYngMengurus="";
		$queryMengetahui=Array();
		$queryYgMengurus=Array();
		
		
		
		if(substr ($this->session->userdata('id_satker'), 2, 2)=="00"){
			$queryMengetahui=$this->Jenis_bmn_model->getPegawaiByOrg($this->session->userdata('id_satker'), '92100', '2');
			$queryYgMengurus=$this->Jenis_bmn_model->getPegawaiByOrg($this->session->userdata('id_satker'), '92140', '3');
		
			$nm_satker=substr ($this->session->userdata('nm_satker'), 4, 50);
			$mengetahui='Kepala Bagian Tata Usaha,';
			$yngMengurus="Kepala Subbagian Urusan Dalam,";
		}else{
			$nm_satker=substr($this->session->userdata('nm_satker'), 4, 50);
			$mengetahui='Kepala,';
			$yngMengurus="Kepala Sub Bagian Tata Usaha,";
			
			$queryMengetahui=$this->Jenis_bmn_model->getPegawaiByOrg($this->session->userdata('id_satker'), '92800', '2');
			$queryYgMengurus=$this->Jenis_bmn_model->getPegawaiByOrg($this->session->userdata('id_satker'), '92810', '3');
		}
		
		if(sizeof($queryMengetahui)>0){
			$nmMengetahui=$queryMengetahui[0]->gelar_depan.' '.$queryMengetahui[0]->nama.' '.$queryMengetahui[0]->gelar_belakang;
			$nipMengetahui='NIP. '.$queryMengetahui[0]->nipbaru;
		}
		
		$objDrawing=new PHPExcel_Worksheet_Drawing();
		$objDrawing->setPath('./assets/images/other/bps.gif');
		$objDrawing->setCoordinates('A1');
		$objDrawing->setWorkSheet($objPHPExcel->setActiveSheetIndex($index));
		
		if(sizeof($queryYgMengurus)>0){
			$nmYngMengurus=$queryYgMengurus[0]->gelar_depan.' '.$queryYgMengurus[0]->nama.' '.$queryYgMengurus[0]->gelar_belakang;
			$nipYngMengurus='NIP. '.$queryYgMengurus[0]->nipbaru;
		}
		
		
		$objPHPExcel->setActiveSheetIndex($index)
					->setCellValue('C2', $nm_satker)
					->setCellValue('A30', $mengetahui)
					->setCellValue('I30', $yngMengurus)
					->setCellValue('A33', $nmMengetahui)
					->setCellValue('A34', $nipMengetahui)
					->setCellValue('I33', $nmYngMengurus)
					->setCellValue('I34', $nipYngMengurus);	
		
		if($kendaraanOrNo=='1'){
			$query=$this->Jenis_bmn_model->getKendaraanById($idBarang);
			
			//Set Keterangan Barang
			if(sizeof($query)>0){
				$objPHPExcel->setActiveSheetIndex($index)
						->setCellValue('D5', ": ".$query[0]->no_pol)
						->setCellValue('D6', ": ".$query[0]->gelar_depan.' '.$query[0]->nama.', '.$query[0]->gelar_belakang)
						->setCellValue('D7', ": ".$query[0]->nm_kategori)
						->setCellValue('D8', ": ".$query[0]->merk." / ".$query[0]->type)
						->setCellValue('I5', ": ".$query[0]->no_mesin)
						->setCellValue('I6', ": ".$query[0]->no_rangka)
						->setCellValue('I7', ": ".$query[0]->tahun_kendaraan)
						->setCellValue('I8', ": ".$query[0]->tgl_stnk);
						
				//$$this->Jenis_bmn_model->getPegawaiByNiplama($query[0]->niplama, $query[0]->id_satker);
			}
		}else{
			$query=$this->Jenis_bmn_model->getNonKendaraanById($idBarang);
			if(sizeof($query)>0){
				$objPHPExcel->setActiveSheetIndex($index)
						->setCellValue('D6', ": ".$query[0]->nm_kategori)
						->setCellValue('D7', ": ".$query[0]->merk.'/'.$query[0]->type)
						->setCellValue('D8', ": ".$query[0]->nama)
						->setCellValue('I6', ": ".$query[0]->tahun);
			}
		}
		
		$queryTrx=$this->Jenis_bmn_model->getTrxById($idBarang, $kendaraanOrNo, $tglAwal, $tglAkhir);
		
		$barisPertama=12;
		$nomorPertama=1;
		foreach($queryTrx as $row){
			$objPHPExcel->setActiveSheetIndex($index)
						->setCellValue('A'.$barisPertama, $nomorPertama)
						->setCellValue('B'.$barisPertama, $row->tanggal_dicatat)
						->setCellValue('C'.$barisPertama, $row->no_spk)
						->setCellValue('D'.$barisPertama, $row->pekerjaan)
						->setCellValue('E'.$barisPertama, $row->sparepart)
						->setCellValue('F'.$barisPertama, $row->km)
						->setCellValue('G'.$barisPertama, $row->tanggal_selesai)
						->setCellValue('H'.$barisPertama, $row->penyedia)
						->setCellValue('I'.$barisPertama, $row->biaya)
						->setCellValue('J'.$barisPertama, $row->keterangan);	
		$barisPertama++;
		$nomorPertama++;		
		}
		
		$objPHPExcel->setActiveSheetIndex($index)
						->setCellValue('I27', '=SUM(I12:I26)');
		
		if($jenisPerintah=='buat'){
			$objectWriter=PHPExcel_IOFactory::createWriter($objPHPExcel, 'HTML');
			$objectWriter->setSheetIndex($index);
			
			ob_start();
			$objectWriter->save('php://output');
			$a = ob_get_contents();
			ob_end_clean();
			return $a;
			exit;
		}else if($jenisPerintah=='download'){
			//echo 'masuk';
			return $objPHPExcel;
			
		}
		
	}
	
	public function aksi_download_karken_bmn(){
		$idBarang=json_decode($this->input->post('bmnCad'));
		$tglAwal=$this->input->post('tglAwalCad');
		$tglAkhir=$this->input->post('tglAkhirCad');
		$namaBmnForDownload="";
		
			$objPHPExcelKend=PHPExcel_IOFactory::load(APPPATH.'libraries/excel/templateBmnKendaraan.xlsx');
			$objPHPExcelNonKend=PHPExcel_IOFactory::load(APPPATH.'libraries/excel/templateBmnNonKendaraan.xlsx');
			$objPHPExcel=null;	
		
		$i=0;
		foreach($idBarang as $row){
			$barangPlus=explode('-',$row);
			if($i==0){
				if($barangPlus[1]=='1'){
					$getKendaraan=$this->Jenis_bmn_model->getKendaraanById($barangPlus[0]);
					$kategoriBmnForDownload=$getKendaraan[0]->nm_kategori;
					$namaBmnForDownload=$getKendaraan[0]->no_pol;
					$gabung=str_replace('/','',$namaBmnForDownload.' - '.$kategoriBmnForDownload);
					$objPHPExcelKend->setActiveSheetIndex(0)->setTitle(substr($gabung,0,25));
					
					$objPHPExcel=$this->isitabel($objPHPExcelKend, $barangPlus[0], $barangPlus[1],  $tglAwal, $tglAkhir, 'download', 0);
				}else if($barangPlus[1]=='2'){
					$getNonKendaraan=$this->Jenis_bmn_model->getNonKendaraanById($barangPlus[0]);
					$kategoriBmnForDownload=$getNonKendaraan[0]->nm_kategori;
					$namaBmnForDownload=$getNonKendaraan[0]->identitas_barang;
					$gabung=str_replace('/','',$namaBmnForDownload.' - '. $kategoriBmnForDownload);
					
					$objPHPExcelNonKend->setActiveSheetIndex(0)->setTitle(substr($gabung,0,25));
					$objPHPExcel=$this->isitabel($objPHPExcelNonKend, $barangPlus[0], $barangPlus[1],  $tglAwal, $tglAkhir, 'download', 0);
				}
				
			}
			else{
				if($barangPlus[1]=='1'){
					$objPHPExcelKendCad=PHPExcel_IOFactory::load(APPPATH.'libraries/excel/templateBmnKendaraan.xlsx');
					$objPHPExcelKendCad->setActiveSheetIndex(0);
					$sc = $objPHPExcelKendCad->getActiveSheet()->copy();
					$clonedSheet = clone $sc;
					$temporarySheet = clone $clonedSheet;
					
					$getKendaraan=$this->Jenis_bmn_model->getKendaraanById($barangPlus[0]);
					$kategoriBmnForDownload=$getKendaraan[0]->nm_kategori;
					$namaBmnForDownload=$getKendaraan[0]->no_pol;
					$gabung=str_replace('/','',$namaBmnForDownload.' - '.$kategoriBmnForDownload);
					
					$temporarySheet->setTitle(substr($gabung,0,25));
					$objPHPExcel->addSheet($temporarySheet,$i);
					$objPHPExcel->setActiveSheetIndex($i);
					$this->isitabel($objPHPExcel, $barangPlus[0], $barangPlus[1],  $tglAwal, $tglAkhir, 'download', $i);
				
				}else if($barangPlus[1]=='2'){
					$objPHPExcelNKendCad=PHPExcel_IOFactory::load(APPPATH.'libraries/excel/templateBmnNonKendaraan.xlsx');
					$objPHPExcelNKendCad->setActiveSheetIndex(0);
					$sc = $objPHPExcelNKendCad->getActiveSheet()->copy();
					$clonedSheet = clone $sc;
					$temporarySheet = clone $clonedSheet;
					
					$getNonKendaraan=$this->Jenis_bmn_model->getNonKendaraanById($barangPlus[0]);
					$kategoriBmnForDownload=$getNonKendaraan[0]->nm_kategori;
					$namaBmnForDownload=$getNonKendaraan[0]->identitas_barang;
					$gabung=str_replace('/','',$namaBmnForDownload.' - '. $kategoriBmnForDownload);
					
					
					$temporarySheet->setTitle(substr($gabung,0,25));
					$objPHPExcel->addSheet($temporarySheet,$i);
					$objPHPExcel->setActiveSheetIndex($i);
					
					$this->isitabel($objPHPExcel,$barangPlus[0], $barangPlus[1],  $tglAwal, $tglAkhir, 'download', $i);
				}
			}
			$i++;
			
		}
				// Redirect output to a client’s web browser (Excel2007)
				header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
				header('Content-Disposition: attachment;filename="Kartu Kendali BMN - '.$tglAwal.' s.d '.$tglAkhir.'.xlsx"');
				header('Cache-Control: max-age=0');
				
				// If you're serving to IE 9, then the following may be needed
				header('Cache-Control: max-age=1');

				// If you're serving to IE over SSL, then the following may be needed
				header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
				header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
				header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
				header ('Pragma: public'); // HTTP/1.0
				//error_reporting(E_ERROR|E_WARNING|E_PARSE);
				$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
				
				ob_end_clean();
				$objWriter->save('php://output');
		
	}
	
	
	public function daftar_bmn_page(){
		$content['page']='bmn/daftarBmn';
		$content['judul_halaman']='Daftar BMN';
		$query3=$this->Jenis_bmn_model->get_kendaraan($this->session->userData('id_satker'));
		$query4=$this->Jenis_bmn_model->get_non_kendaraan($this->session->userData('id_satker'));
		
		$satker=$this->Jenis_bmn_model->get_satker();
		$content['satker']=$satker;
		
		$content['kendaraan']=$query3;
		$content['non_kendaraan']=$query4;
		$content['daftar']='daftar';
				
		$this->load->view('template/layout', $content);
	}
	
	
	public function daftar_bmn_satker($id_satker){
		$content['page']='bmn/daftarBmn';
		$content['judul_halaman']='Daftar BMN';
		$query3=$this->Jenis_bmn_model->get_kendaraan($id_satker);
		$query4=$this->Jenis_bmn_model->get_non_kendaraan($id_satker);
		
		$satker=$this->Jenis_bmn_model->get_satker();
		$content['satker']=$satker;
		$content['id_satker']=$id_satker;
		
		
		$content['kendaraan']=$query3;
		$content['non_kendaraan']=$query4;
		$content['daftar']='daftar';
				
		$this->load->view('template/layout', $content);
	}
	
	public function perawatan_bmn_by_id_page($kendaraanOrNo, $idBarang, $identitasBarang){
		$content['page']='bmn/inputDaftarPerawatan';
		$content['judul_halaman']='Input dan Daftar Perawatan BMN';
		$content['pageInput']='bmn/inputPerawatanById';
		$content['pageDaftar']='bmn/daftarPerawatanById';
		
		$namaBmn="";
		$displayKm="";
		$query5=$this->Jenis_bmn_model->getTrxById($idBarang, $kendaraanOrNo, date('Y').'-01-01', date('Y-m-d'));
		if($kendaraanOrNo==1){
			$query3=$this->Jenis_bmn_model->getKendaraanById($idBarang);
			if(sizeof($query3)>0){
				$namaBmn=$query3[0]->merk.' '.$query3[0]->type.' ('.$query3[0]->no_pol.')';
				$displayKm="";
			}
			
		}else{
			$query4=$this->Jenis_bmn_model->getNonKendaraanById($idBarang);
			if(sizeof($query4)>0){
				$namaBmn=$query4[0]->merk.' '.$query4[0]->type.'('.$query4[0]->identitas_barang.')';
				$displayKm="display:none";
			}
		}
			
		$content['namaBmn']=$namaBmn;
		$content['daftarPerawatan']=$query5;
		$content['displayKm']=$displayKm;
		$content['bmn']=$idBarang;
		$content['kategori']=$kendaraanOrNo;
		$this->load->view('template/layout', $content);
	}
	
	public function daftar_aset_page($jenisRekap, $urJenisRekap){
		$content['page']='bmn/daftarAset';
		$content['judul_halaman']='Rekap Aset BMN';
		
		$satker=null;
		if($this->session->userdata('id_sibaper')=='3' || $this->session->userdata('id_sibaper')=='4' ){
			$satker=$this->Jenis_bmn_model->get_satker();
		}else{
			$satker=$this->Jenis_bmn_model->get_satker_by_id($this->session->userdata('id_satker'));
		}
		
		$kategori=$this->Jenis_bmn_model->get_kategori();
		$jenis=$this->Jenis_bmn_model->get_jenis();
		
		
		if($jenisRekap==1){
				$asetKendaraan=$this->Jenis_bmn_model->getAsetKendaraanAll('id_kategori');
				$asetNonKendaraan=$this->Jenis_bmn_model->getAsetNonKendaraanAll('id_kategori');
				
				$bmn=Array();
				foreach($asetKendaraan as $row){
					$bmn[$row->id_kategori.$row->id_satker]=Array(
												'jumlah'=>$row->jumlah_bmn
											);
				}
				
				foreach($asetNonKendaraan as $row){
					$bmn[$row->id_kategori.$row->id_satker]=Array(
												'jumlah'=>$row->jumlah_bmn
											);
				}
				$table='<table id="tabelStok2" class="table table-striped table-bordered" cellspacing="0" width="100%">
						<thead><th>Rincian</th>';
				foreach($satker as $row){
					$table=$table.'<th>'.str_replace("BPS KOTA", "", str_replace("BPS PROVINSI", "", str_replace("BPS KABUPATEN", "", $row->nm_satker))).'</th>';
				}
				$table=$table.'</thead><tbody>';
				
				foreach($kategori as $row1){
					$table=$table.'<tr> <td>'.$row1->nm_kategori.'</td>';
					foreach($satker as $row2){
						if(isset($bmn[$row1->id_kategori.$row2->id_satker])){
							$table=$table.'<td style="text-align:center">'.$bmn[$row1->id_kategori.$row2->id_satker]['jumlah'].'</td>';
						}else{
							$table=$table.'<td style="text-align:center">-</td>';
						}
						
					}
					$table=$table.'</tr>';
				}
				$table=$table.'</tbody></table>';
				
				$content['select1']='selected="selected"';
				$content['select2']="";
				$content['select3']="";
				$content['displaySatker']='style="display:none"';
				$content['table']=$table;
				$content['satker']='';
				$this->load->view('template/layout', $content);
		}else if($jenisRekap==2){
				$asetKendaraan=$this->Jenis_bmn_model->getAsetKendaraanAll('master_jenis_bmn.id_jenis_bmn');
				$asetNonKendaraan=$this->Jenis_bmn_model->getAsetNonKendaraanAll('master_jenis_bmn.id_jenis_bmn');
				
				$bmn=Array();
				foreach($asetKendaraan as $row){
					$bmn[$row->id_jenis_bmn.$row->id_satker]=Array(
												'jumlah'=>$row->jumlah_bmn
											);
				}
				
				foreach($asetNonKendaraan as $row){
					$bmn[$row->id_jenis_bmn.$row->id_satker]=Array(
												'jumlah'=>$row->jumlah_bmn
											);
				}
				$table='<table id="tabelStok2" class="table table-striped table-bordered" cellspacing="0" width="100%">
						<thead><th>Rincian</th>';
				foreach($satker as $row){
					$table=$table.'<th>'.str_replace("BPS KOTA", "", str_replace("BPS PROVINSI", "", str_replace("BPS KABUPATEN", "", $row->nm_satker))).'</th>';
				}
				$table=$table.'</thead><tbody>';
				
				foreach($jenis as $row1){
					$table=$table.'<tr> <td>'.$row1->nm_kategori.' : '.$row1->merk.' '.$row1->type.'</td>';
					foreach($satker as $row2){
						if(isset($bmn[$row1->id_jenis_bmn.$row2->id_satker])){
							$table=$table.'<td style="text-align:center">'.$bmn[$row1->id_jenis_bmn.$row2->id_satker]['jumlah'].'</td>';
						}else{
							$table=$table.'<td style="text-align:center">-</td>';
						}
						
					}
					$table=$table.'</tr>';
				}
				$table=$table.'</tbody></table>';
				
				$content['table']=$table;
				$content['select1']="";
				$content['select2']='selected="selected"';
				$content['select3']="";
				$content['satker']='';
				$content['displaySatker']='style="display:none"';
				$this->load->view('template/layout', $content);
		}else if($jenisRekap==3){
				$bmn=Array();
				$pegawai=Array();
				
				if($this->session->userdata('id_sibaper')=='3' || $this->session->userdata('id_sibaper')=='4' ){
					if($urJenisRekap=='0000'){
						$pegawai=$this->Jenis_bmn_model->getPegawai('');
					}else{
						$pegawai=$this->Jenis_bmn_model->getPegawai($urJenisRekap);
					}
				}else{
					$pegawai=$this->Jenis_bmn_model->getPegawai($this->session->userdata('id_satker'));
				}
				
				
				
				$satkerOption='<option value="3" href="'.base_url().'daftarAset/3/0000">Semua Pegawai</option>';
				foreach($satker as $row){
					//echo $row->id_satker.'=='.$urJenisRekap;
					if($row->id_satker==$urJenisRekap){
						$satkerOption=$satkerOption.'<option selected="selected" href="'.base_url().'daftarAset/3/'.$row->id_satker.'"
										value="'.$row->id_satker.'">
										'.$row->nm_satker.' </option>';
					}else{
						$satkerOption=$satkerOption.'<option href="'.base_url().'daftarAset/3/'.$row->id_satker.'"
										value="'.$row->id_satker.'">
										'.$row->nm_satker.' </option>';
					}		
				}
				
				$asetKendaraan=Array();
				$asetNonKendaraan=Array();
				
				if($urJenisRekap!='0000'){
					$asetKendaraan=$this->Jenis_bmn_model->getAsetKendaraanPegawaiAll('where barang_kendaraan.idSatker="'.$urJenisRekap.'"');
					$asetNonKendaraan=$this->Jenis_bmn_model->getAsetNonKendaraanPegawaiAll('where barang_non_kendaraan.id_satker="'.$urJenisRekap.'"');
				}else{
					$asetKendaraan=$this->Jenis_bmn_model->getAsetKendaraanPegawaiAll('');
					$asetNonKendaraan=$this->Jenis_bmn_model->getAsetNonKendaraanPegawaiAll('');
				}
				
				
				$bmn=Array();
				foreach($asetKendaraan as $row){
					$bmn[$row->id_kategori.$row->niplama]=Array(
												'jumlah'=>$row->jumlah_bmn
											);
				}
				
				foreach($asetNonKendaraan as $row){
					$bmn[$row->id_kategori.$row->niplama]=Array(
												'jumlah'=>$row->jumlah_bmn
											);
				}
				
				
				$table='<table id="tabelStok2" class="table table-striped table-bordered" cellspacing="0" width="100%">
						<thead><th>Nama Pegawai</th>';
				foreach($kategori as $row){
					$table=$table.'<th>'.$row->nm_kategori.'</th>';
				}
				$table=$table.'</thead><tbody>';
				
				//print_r($pegawai);
				foreach($pegawai as $row1){
					$table=$table.'<tr> <td>'.$row1->gelar_depan.' '.$row1->nama.' '.$row1->gelar_belakang.'</td>';
					foreach($kategori as $row2){
						if(isset($bmn[$row2->id_kategori.$row1->niplama])){
							$table=$table.'<td style="text-align:center">'.$bmn[$row2->id_kategori.$row1->niplama]['jumlah'].'</td>';
						}else{
							$table=$table.'<td style="text-align:center">-</td>';
						}
						
					}
					$table=$table.'</tr>';
				}
				$table=$table.'</tbody></table>';
				
				if($this->session->userdata('id_sibaper')=='3' || $this->session->userdata('id_sibaper')=='4' ){
					$content['satker']=$satkerOption;
					$content['displaySatker']='';
				}else{
					$content['satker']='';
					$content['displaySatker']='style="display:none"';
				}
				
				$content['table']=$table;
				$content['select1']="";
				$content['select2']='selected="selected"';
				$content['select3']="";
				
				
				$this->load->view('template/layout', $content);
		}else{
			echo "404";
		}
		
	}
		
	public function detail_bmn($kendaraanOrNo, $idBarang, $identitasBarang){
		$content['page']='bmn/detailBmn';
		$content['judul_halaman']='Detail BMN';
		$barangKendaraan=Array();
		$barangNonKendaraan=Array();
		
		$content['bmnCad']=json_encode(Array($idBarang.'-'.$kendaraanOrNo));
		$content['kendaraanOrNoCad']=$kendaraanOrNo;
		$content['tglAwalCad']=date('Y').'-01-01';
		$content['tglAkhirCad']=date('Y').'-12-31';
		
		if($kendaraanOrNo==1){
			$query3=$this->Jenis_bmn_model->getKendaraanById($idBarang);
			if(sizeof($query3)>0){
				$barangKendaraan=$query3[0];
				$content['kendaraanOrNo']='1';
			}
			
		}else{
			$query4=$this->Jenis_bmn_model->getNonKendaraanById($idBarang);
			if(sizeof($query4)>0){
				$barangNonKendaraan=$query4[0];
				$content['kendaraanOrNo']='2';
			}
		}
		
		$query5=$this->Jenis_bmn_model->getTrxById($idBarang, $kendaraanOrNo, date('Y').'-01-01', date('Y-m-d'));
		$content['daftarPerawatan']=$query5;
		$content['barangKendaraan']=$barangKendaraan;
		$content['barangNonKendaraan']=$barangNonKendaraan;
		$this->load->view('template/layout', $content);
		
	}
	
	public function setUnicIdTrx($stringDate){
		$pieces = explode("/", $stringDate);
		$id=$pieces[2].$pieces[0].$pieces[1].date("His");
		return $id;
	}
	
	public function setDateFormatToField2($strigDate){
		$pieces = explode("-", $strigDate);
		$date=$pieces[1]."/".$pieces[2]."/".$pieces[0];
		return $date;
	}
	
}