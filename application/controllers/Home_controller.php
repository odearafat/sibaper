<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home_controller extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		//$this->load->model('Barang_aset_model');
		$this->load->model('Barang_persediaan_model');
		$this->load->model('Jenis_bmn_model');
		
		if($this->session->userdata('status') != "login" || $this->session->userdata('id_sibaper')==0){
				redirect(base_url("login.html"));
			}
			//else if($this->session->userdata('id_sibaper')==4){
			
			//}else if($this->session->userdata('id_sibaper')!=2){
			//	show_404();
			//}
	}
	public function index(){
		$content['page']='home/home';
		$content['judul_halaman']='Halaman Utama';
		$content['daftar']='noDaftar';
	
		
		$query3=$this->Jenis_bmn_model->get_kendaraan($this->session->userData('id_satker'));
		$query4=$this->Jenis_bmn_model->get_non_kendaraan($this->session->userData('id_satker'));
		$satker=$this->Jenis_bmn_model->get_satker();
		
		$content['satker']=$satker;
		$content['kendaraan']=$query3;
		$content['non_kendaraan']=$query4;
		
		$query=$this->Barang_persediaan_model->get_stok($this->session->userdata('id_satker'));
		$content['stok']=$this->get_element_stok($query);
		
		
		$this->load->view('template/layout', $content);
	
	}
	
	
	public function get_element_stok($query){
		$elementResult=Array();
		foreach ($query as $row)
		{
		  $elementResult[]= array (
				'id_barang'=>$row->kd_brg,
				'uraian_barang'=>$row->ur_brg,
				'satuan'=>$row->satuan,
				'stok'=>$this->isNull($row->stok)
		  );
		}
		return $elementResult;
	}
	
	public function isNull($stok){
		$retur=0;
		if($stok==0 || $stok==''){
			$retur='-';
		}else{
			$retur=$stok;
		}
		return $retur;
	}
}
?>