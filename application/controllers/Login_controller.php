<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_controller extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
			$this->load->model('Login_model');
	}
		
	function login_page(){
		$content['valLogin']="";
		$this->load->view('home/login', $content);
	}
	
	function aksi_logout(){
		$this->session->sess_destroy();
		redirect(base_url('login.html'));
	}


	function aksi_login(){
		//echo "log";
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		//echo md5($password);
		$where = array(
			'username' => $username,
			//'password' => md5($password)
			'password' => $password
			);
		
		$hasilQuery=$this->Login_model->cek_login($where);
		if(sizeof($hasilQuery) > 0){
			$data_session = array(
				'username' => $hasilQuery[0]->username,
				'nama' => $hasilQuery[0]->nama,
				'niplama' => $hasilQuery[0]->niplama,
				'nipbaru' => $hasilQuery[0]->nipbaru,
				'email' => $hasilQuery[0]->email,
				'gelar_depan' => $hasilQuery[0]->gelar_depan,
				'gelar_belakang' => $hasilQuery[0]->gelar_belakang,
				'id_seksi' => $hasilQuery[0]->id_seksi,
				'id_satker' => $hasilQuery[0]->id_satker,
				'id_sibaper' => $hasilQuery[0]->id_sibaper,
				'nm_satker' => $hasilQuery[0]->nm_satker,
				'status'=>'login'
			);
			
			//print_r($data_session);
			$this->session->set_userdata($data_session);
			
			redirect(base_url());
			//echo "login Berhasil";
		}else{
			$content['valLogin']='<div style="text-align:center"><p style="color:red">Username dan password salah !</p></div>';
			$this->load->view('home/login', $content);
		}
	}

}