<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Master_controller extends CI_Controller {

	public function __construct(){
		parent::__construct();
		if($this->session->userdata('status') != "login" || $this->session->userdata('id_sibaper')==0){
				redirect(base_url("login.html"));
			}
		$this->load->model('Master_model');
		$this->load->model('Jenis_bmn_model');
	}
	
	public function input_master_pegawai_page(){
		$content['page']='master/input_master_pegawai';
		$content['judul_halaman']='Master Pegawai';
		
		$query2=$this->Master_model->get_pegawai();
		$gol=$this->Master_model->get_golongan();
		$unitKerja=$this->Master_model->get_unit_kerja();
		$query=$this->Jenis_bmn_model->get_satker();
		$content['pegawai']=$query2;
		$content['satker']=$query;
		$content['gol']=$gol;
		$content['unitKerja']=$unitKerja;
		
		$this->load->view('template/layout', $content);
	}
	
	public function aksi_input_pegawai(){
		$data=Array();
		$data=Array(
				'nama'=>$this->input->post('nama'),
				'gelar_depan'=>$this->input->post('gelarDepan'),
				'gelar_belakang'=>$this->input->post('gelarBelakang'),
				'niplama'=>$this->input->post('nipLama'),
				'nipbaru'=>$this->input->post('nipBaru'),
				'email'=>$this->input->post('email'),
				'id_gol'=>$this->input->post('golongan'),
				'id_satker'=>$this->input->post('satker'),
				'id_org'=>$this->input->post('unitKerja'),
				
			);
			if($this->Master_model->input_pegawai($data)==1){
				$data2=Array(
					'niplama'=>$this->input->post('nipLama'),
				);
				$this->Master_model->input_akses($data2);
				redirect('inputMasterPegawai.html');
			}
	}
	
	public function aksi_edit_pegawai(){
		$data=Array();
		$data=Array(
				'nama'=>$this->input->post('nama'),
				'gelar_depan'=>$this->input->post('gelarDepan'),
				'gelar_belakang'=>$this->input->post('gelarBelakang'),
				'niplama'=>$this->input->post('nipLama'),
				'nipbaru'=>$this->input->post('nipBaru'),
				'email'=>$this->input->post('email'),
				'id_gol'=>$this->input->post('golongan'),
				'id_satker'=>$this->input->post('satker'),
				'id_org'=>$this->input->post('unitKerja'),
				
		);
			if($this->Master_model->edit_pegawai($data)==1){
				redirect('inputMasterPegawai.html');
			}
	}
	
	public function aksi_hapus_pegawai($niplama){
		if($this->Master_model->hapus_pegawai($niplama)==1){
				redirect('inputMasterPegawai.html');
		}
	}
	
	public function hak_akses_page(){
		$content['page']='master/hak_akses';
		$content['judul_halaman']='Master Akun ';
		
		$query2=$this->Master_model->get_autentifikasi();
		$content['autentifikasi']=$query2;
		
		
		$this->load->view('template/layout', $content);
	}
	
	public function aksi_edit_akses(){
		$data=Array();
		$niplama=$this->input->post('niplama');
		if($this->input->post('pass')!='**##**##'){
			$data=Array(
				'username'=>$this->input->post('user'),
				'password'=>$this->input->post('pass'),
				'id_sibaper'=>$this->input->post('akses'),
			);
		}else{
			$data=Array(
				'username'=>$this->input->post('user'),
				'id_sibaper'=>$this->input->post('akses'),
			);
		}
			if($this->Master_model->update_akses($data, $niplama)==1){
				redirect('hakAkses.html');
			}
	}
	
	function ganti_pasword_page(){
			$content['page']='master/ganti_password';
			$content['judul_halaman']='Ganti Password';
			$content['username']=$this->session->userdata('username');
			$content['kondisi']='';
			
			$this->load->view('template/layout', $content);
		
	}
	
	function aksi_ganti_password(){
		$content['page']='master/ganti_password';
		$content['judul_halaman']='Ganti Password';
		$content['username']=$this->session->userdata('username');	
		
		$resultPassword=$this->Master_model->getPassword($this->session->userdata('niplama'));
		$password=0;
		if(sizeof($resultPassword)>0){
			$password=$resultPassword[0]->password;
		}
		
		//echo $this->input->post('passLm') . '  == '.$this->session->userdata('password');
		if($this->input->post('passLm')!=$password){
			$content['kondisi']=
					'<div class="alert alert-danger alert-dismissible fade in" role="alert" >
							<strong>Password Lama Tidak Sesuai !!</strong>
					</div>';
		}else{
			$data=Array(
				'password'=>$this->input->post('passBr'),
			);
			$this->Master_model->update_password($this->session->userdata('niplama'), $data);
			$content['kondisi']='
			<div class="alert alert-success alert-dismissible fade in" role="alert">
                    <strong>Berhasil Ganti Password...</strong>
			</div>';
		}
		$this->load->view('template/layout', $content);
	}
}