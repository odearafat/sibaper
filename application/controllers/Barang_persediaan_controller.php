<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Barang_persediaan_controller extends CI_Controller {

	public function __construct(){
		parent::__construct();

			$this->load->model('Jenis_barang_model');
			//$this->load->model('Pegawai_model');
			$this->load->model('Barang_persediaan_model');
			//$this->load->model('Ruangan_model');
			//$this->load->model('Perawatan_model');
			$this->load->helper('url');
			$this->load->helper(array('form', 'url'));
			//$this->load->library("excel/PHPExcel");
			$this->load->library("excel/PHPExcel");

			if($this->session->userdata('status') != "login" || $this->session->userdata('id_sibaper')==0){
				redirect(base_url("login.html"));
			}
	}

	public function stok_page()
	{
		$content['page']='barang_persediaan/stok';
		$content['judul_halaman']='Stok Barang';
		$query=$this->Barang_persediaan_model->get_stok($this->session->userdata('id_satker'));
		$content['stok']=$this->get_element_stok($query);
		$satker=$this->Barang_persediaan_model->get_satker();
		if($this->session->userdata('id_sibaper')==1){
			$content['idStok']='tabelStok2';
			$content['panel']='';

		}else if($this->session->userdata('id_sibaper')==3){
			$content['panel']='<ul style="width:100%; margin-bottom:2%" class="nav navbar-left panel_toolbox">
				 <li style="width:50%"> <div  style="width:100%" class="col-md-6 col-sm-6 col-xs-12">
				<select style="width:100%" id="satker" name="satker" required="required" class="select9_single form-control col-md-7 col-xs-12" >';
			$content['idStok']='tabelStok2';
			foreach($satker as $row)
			{
					if($row->id_satker==$this->session->userdata('id_satker')){
						$content['panel']=$content['panel'].'<option selected="selected" href="'.base_url().'stok/'.$row->id_satker.'" value="'.$row->id_satker.'">'
						.$row->nm_satker.' </option>';
					}
					else{
						$content['panel']=$content['panel'].'<option href="'.base_url().'stok/'.$row->id_satker.'" value="'.$row->id_satker.'">'
						.$row->nm_satker.' </option>';
					}
			}

			$content['panel']=$content['panel'].'<span class="required">*</span> </select></div> </li>
				</ul>';
		}else{
			$content['idStok']='tabelStok';
			$content['panel']='<ul class="nav navbar-left panel_toolbox">
				 <li>
					<button type="submit" style="display:none" id="bttStockOpname" class="btn btn-success">Simpan</button>
				</li>
				<li>
					<input  id="birthday" style="display:none" name="tglStockOpname" class="date-picker form-control col-md-7 col-xs-12" required="required" type="text">
				 </li>
				</ul>

				<ul class="nav navbar-right panel_toolbox">
				 <li>
					<label>
							<input width="100%" type="checkbox" id="onOffStockOpname" class="js-switch" /> Stok Opname Mode <b class="modeSO"style="color:red">Off</b>
					</label>
				 </li>
				</ul>';
		}

		$this->load->view('template/layout', $content);
	}


	public function stok_satker($idSatker){
		$content['page']='barang_persediaan/stok';
		$content['judul_halaman']='Stok Barang';
		$query=$this->Barang_persediaan_model->get_stok($idSatker);
		$content['stok']=$this->get_element_stok($query);
		//$this->load->vars($data);
		$satker=$this->Barang_persediaan_model->get_satker();
		if($this->session->userdata('id_sibaper')=='1'){
			$content['idStok']='tabelStok2';
			$content['panel']='';

		}else if($this->session->userdata('id_sibaper')=='3' || $this->session->userdata('id_sibaper')=='4'){
			$content['panel']='<ul style="width:100%; margin-bottom:2%" class="nav navbar-left panel_toolbox">
				 <li style="width:50%"> <div  style="width:100%" class="col-md-6 col-sm-6 col-xs-12">
				<select style="width:100%" id="satker" name="satker" required="required" class="select9_single form-control col-md-7 col-xs-12" >';

			foreach($satker as $row)
			{
					$content['idStok']='tabelStok2';

					if($row->id_satker==$idSatker){
						$content['panel']=$content['panel'].'<option selected="selected" href="'.base_url().'stok/'.$row->id_satker.'" value="'.$row->id_satker.'">'
						.$row->nm_satker.' </option>';
					}
					else{
						$content['panel']=$content['panel'].'<option href="'.base_url().'stok/'.$row->id_satker.'" value="'.$row->id_satker.'">'
						.$row->nm_satker.' </option>';
					}
			}

			$content['panel']=$content['panel'].'<span class="required">*</span> </select></div> </li>
				</ul>';
		}else{
			$content['idStok']='tabelStok';
			$content['panel']='<ul class="nav navbar-left panel_toolbox">
				 <li>
					<button type="submit" style="display:none" id="bttStockOpname" class="btn btn-success">Simpan</button>
				</li>
				<li>
					<input  id="birthday" style="display:none" name="tglStockOpname" class="date-picker form-control col-md-7 col-xs-12" required="required" type="text">
				 </li>
				</ul>

				<ul class="nav navbar-right panel_toolbox">
				 <li>
					<label>
							<input width="100%" type="checkbox" id="onOffStockOpname" class="js-switch" /> Stok Opname Mode <b class="modeSO"style="color:red">Off</b>
					</label>
				 </li>
				</ul>';
		}


		$this->load->view('template/layout', $content);
	}

	public function aksi_stockOpname()
	{
		$daftarSO= $this->input->post('stockOpname');
		$variabel= $this->input->post('var');
		$tglStockOpname= $this->input->post('tglStockOpname');
		$dataMasuk=Array();
		$dataKeluar=Array();
		$getStock=json_decode(json_encode($this->Barang_persediaan_model->get_stok_by_time(
				$this->setDateFormat($tglStockOpname), $this->session->userdata('id_satker'))),true);

		$idTrx=$this->setUnicIdTrxMasuk($tglStockOpname);
		for($i=0; $i<sizeof($daftarSO);$i++)
		{
			if($daftarSO[$i]!=''){
				$var=explode("--", $variabel[$i]);
				$key = array_search($var[0], array_column($getStock, 'kd_brg'));
				//print_r($getStock[$key]);
				$stokAwal=$getStock[$key]['stok'];
				//echo $stokAwal.'--'.$daftarSO[$i];
				//Cek jika stok awal 0
				//if($getStock[$key]['kd_brg']==){
				//	$stokAwal=0;
				//}

				if($stokAwal>$daftarSO[$i]){
					$dataKeluar[]=array (
						'id_trx_k'=>$idTrx,
						'kd_brg'=>$var[0],
						'id_bdg_sks'=>"00",
						'jumlah'=>$stokAwal-$daftarSO[$i] ,
						'id_satker'=>$this->session->userdata('id_satker'),
						'tgl_keluar'=> $this->setDateFormat($tglStockOpname)
					);
				}else if($stokAwal<$daftarSO[$i]){
					$dataMasuk[]=array (
						'id_trx_m'=>$idTrx,
						'kd_brg'=>$var[0],
						'penyedia'=>"Stock Opname Barang Tanggal ".$tglStockOpname,
						'jumlah'=>$daftarSO[$i]-$stokAwal ,
						'id_satker'=>$this->session->userdata('id_satker'),
						'tgl_masuk'=> $this->setDateFormat($tglStockOpname)
					);
				}
			}
		}
		if(sizeof($dataMasuk)>0){
			$this->Barang_persediaan_model->input_transaksi_masuk($dataMasuk);
		}
		if(sizeof($dataKeluar)>0){
			$this->Barang_persediaan_model->input_transaksi_keluar($dataKeluar);
		}
		redirect("/stok.html");
	}

	//jadikan array untuk html
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


	public function daftar_barang()
	{
		$content['page']='barang_persediaan/daftar_barang_persediaan';
		$content['judul_halaman']='Daftar Barang Persediaan';
		//$this->load->vars($data);
		$this->load->view('template/layout', $content);
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

	public function input_barang()
	{
		$content['page']='barang_persediaan/input_barang_persediaan';
		$content['pageInputOrEdit']='barang_persediaan/input_barang_persediaan_ajukan';
		$content['judul_halaman']='Input Barang Persediaan';
		//$this->load->vars($data);
		$query=$this->Barang_persediaan_model->get_stok($this->session->userdata('id_satker'));
		$content['barang_persediaan']=$query;


		//$daftar_barang=$this->Barang_persediaan_model->query_daftar_transaksi_masuk($this->session->userdata('id_satker'));
		//print_r($daftar_barang);
		//$content['daftar_barang']=$daftar_barang;
		$this->load->view('template/layout', $content);

	}

	public function daftar_input_barang()
	{
		$content['page']='barang_persediaan/daftar_input_barang_persediaan';
		//$content['pageInputOrEdit']='barang_persediaan/input_barang_persediaan_ajukan';
		$content['judul_halaman']='Daftar Barang Persediaan';
		//$this->load->vars($data);
		//$query=$this->Barang_persediaan_model->get_stok($this->session->userdata('id_satker'));
		//$content['barang_persediaan']=$query;


		$daftar_barang=$this->Barang_persediaan_model->query_daftar_transaksi_masuk($this->session->userdata('id_satker'));
		//print_r($daftar_barang);
		$content['daftar_barang']=$daftar_barang;
		$this->load->view('template/layout', $content);

	}

	public function input_barang_edit($idTrxMasuk)
	{
		$content['page']='barang_persediaan/input_barang_persediaan';
		$content['pageInputOrEdit']='barang_persediaan/input_barang_persediaan_edit';
		$content['judul_halaman']='Edit Barang Persediaan`';
		$query=$this->Barang_persediaan_model->get_stok($this->session->userdata('id_satker'));
		$transaksi=$this->Barang_persediaan_model->queryItemTrxMasuk($idTrxMasuk, $this->session->userdata('id_satker'));
		$content['barang_persediaan']=$query;
		$content['transaksi']=$transaksi;

		$content['penyedia']="";
		$content['tglMasuk']="";
		if(sizeof($transaksi)>0){
			$content['penyedia']=$transaksi[0]->penyedia;
			$content['tglMasuk']=$this->setDateFormatToField2($transaksi[0]->tgl_masuk);
		}

		//$daftar_barang=$this->Barang_persediaan_model->query_daftar_transaksi_masuk($this->session->userdata('id_satker'));
		//print_r($daftar_barang);
		//$content['daftar_barang']=$daftar_barang;

		$content['idTrxMasuk']=$idTrxMasuk;
		$this->load->view('template/layout', $content);

	}

	public function aksi_input_barang()
	{
		$daftarBarang= $this->input->post('barang_persediaan');
		$jumlah= $this->input->post('jumlah');
		$id_trx=$this->setUnicIdTrxMasuk($this->input->post('tgl_masuk'));
		$elementResult=Array();
			for($i=0; $i<sizeof($daftarBarang);$i++)
			{
				if($daftarBarang[$i]!=""){
					$elementResult[]=array (
					'id_trx_m'=>$id_trx,
					'kd_brg'=>$daftarBarang[$i],
					'penyedia'=>$this->input->post('penyedia'),
					'jumlah'=> $jumlah[$i],
					'id_satker'=>$this->session->userdata('id_satker'),
					'tgl_masuk'=> $this->setDateFormat($this->input->post('tgl_masuk')),
					);
				}
			}

			$this->Barang_persediaan_model->input_transaksi_masuk($elementResult);
			redirect('/inputBarangPersediaan.html');
			//echo "berhasil Input Data";
			//his->input_barang("isi",$sukses);
	}

	public function aksi_edit_input_barang(){
		$daftarBarang= $this->input->post('barang_persediaan');
		$jumlah= $this->input->post('jumlah');
		$id_trx=$this->input->post('idTrxMasuk');
		$tgl_masuk=$this->setDateFormat($this->input->post('tgl_masuk'));
		$elementResult=Array();
			for($i=0; $i<sizeof($daftarBarang);$i++)
			{
				if($daftarBarang[$i]!=""){
					$elementResult[]=array (
					'id_trx_m'=>$id_trx,
					'kd_brg'=>$daftarBarang[$i],
					'penyedia'=>$this->input->post('penyedia'),
					'jumlah'=> $jumlah[$i],
					'id_satker'=>$this->session->userdata('id_satker'),
					'tgl_masuk'=> $tgl_masuk,
					);
				}
			}
			$this->Barang_persediaan_model->hapus_transaksi_masuk($id_trx);
			$this->Barang_persediaan_model->input_transaksi_masuk($elementResult);
			redirect('/inputBarangPersediaan.html');
			//echo "berhasil Input Data";
			//his->input_barang("isi",$sukses);
	}

	public function aksi_hapus_trx_m($id_transaksi_masuk){
		$this->Barang_persediaan_model->hapus_transaksi_masuk($id_transaksi_masuk);
		//echo 'berhasl Hapus';
		redirect('inputBarangPersediaan.html');
	}

	public function permintaan_barang()
	{
		$content['page']='barang_persediaan/permintaan_barang_persediaan';
		$content['judul_halaman']='Permintaan Barang Persediaan';
		$query=$this->Barang_persediaan_model->get_stok($this->session->userdata('id_satker'));
		$queryBidang=$this->Barang_persediaan_model->get_bidang();
		$querySeksi=$this->Barang_persediaan_model->get_seksi();
		//$queryDataPermintaan=$this->Barang_persediaan_model->query_daftar_transaksi_keluar($this->session->userdata('id_satker'));


		$content['barang_persediaan']=$query;
		$content['page_edit_or_no']='barang_persediaan/permintaan_barang_ajukan';
		//$content['daftar_barang']=$queryDataPermintaan;
		$content['unit_kerja']=$this->unitKerja($querySeksi, $queryBidang, $this->session->userdata('id_satker'));
		//$this->load->vars($data);

		$this->load->view('template/layout', $content);
	}

	public function daftar_permintaan_barang()
	{
		$content['page']='barang_persediaan/daftar_permintaan_barang_persediaan';
		$content['judul_halaman']='Daftar Permintaan Barang Persediaan';
		//$query=$this->Barang_persediaan_model->get_stok($this->session->userdata('id_satker'));
		//$queryBidang=$this->Barang_persediaan_model->get_bidang();
		//$querySeksi=$this->Barang_persediaan_model->get_seksi();
		$queryDataPermintaan=$this->Barang_persediaan_model->query_daftar_transaksi_keluar($this->session->userdata('id_satker'));


		//$content['barang_persediaan']=$query;
		//$content['page_edit_or_no']='barang_persediaan/permintaan_barang_ajukan';
		$content['daftar_barang']=$queryDataPermintaan;
		//$content['unit_kerja']=$this->unitKerja($querySeksi, $queryBidang, $this->session->userdata('id_satker'));
		//$this->load->vars($data);

		$this->load->view('template/layout', $content);
	}

	public function page_edit_permintaan($idTrxKeluar){
		$content['page']='barang_persediaan/permintaan_barang_persediaan';
		$content['judul_halaman']='Permintaan Barang Persediaan';
		$query=$this->Barang_persediaan_model->get_stok($this->session->userdata('id_satker'));
		$queryBidang=$this->Barang_persediaan_model->get_bidang();
		$querySeksi=$this->Barang_persediaan_model->get_seksi();
		//$queryDataPermintaan=$this->Barang_persediaan_model->query_daftar_transaksi_keluar($this->session->userdata('id_satker'));
		$queryTrx=$this->Barang_persediaan_model->queryItemTrxKeluar($idTrxKeluar, $this->session->userdata('id_satker'));

		$content['tgl_keluar']="";
		$content['unitKerjaSelect']="";
		$content['idTransaksi']="";

		if(sizeof($queryTrx)>0){
			//$content['tgl_keluar']=$this->setDateFormatToField($queryTrx[0]->tgl_keluar);
			$content['tgl_keluar']=$this->setDateFormatToField2($queryTrx[0]->tgl_keluar);
			$content['unitKerjaSelect']=$queryTrx[0]->id_bdg_sks;
			$content['idTransaksi']=$queryTrx[0]->id_trx_k;
		}

		$content['transaksi']=$queryTrx;
		$content['barang_persediaan']=$query;
		$content['page_edit_or_no']='barang_persediaan/permintaan_barang_ajukan_edit';
		//$content['daftar_barang']=$queryDataPermintaan;
		$content['unit_kerja']=$this->unitKerja($querySeksi, $queryBidang, $this->session->userdata('id_satker'));
		//$this->load->vars($data);

		$this->load->view('template/layout', $content);
	}

	public function aksi_edit_permintaan(){
		$daftarBarang= $this->input->post('barang_persediaan');
		$jumlah= $this->input->post('jumlah');
		$id_trx_k=$this->input->post('idTransaksi');
		$elementResult=Array();
		for($i=0; $i<sizeof($daftarBarang);$i++)
		{
			if($daftarBarang[$i]!=""){
				$elementResult[]=array (
				'id_trx_k'=>$id_trx_k,
				'kd_brg'=>$daftarBarang[$i],
				'id_bdg_sks'=>$this->input->post('unitKerja'),
				'jumlah'=> $jumlah[$i],
				'id_satker'=>$this->session->userdata('id_satker'),
				'tgl_keluar'=> $this->setDateFormat($this->input->post('tgl_keluar')),
				);
			}
		}
		$this->Barang_persediaan_model->hapus_transaksi_keluar($id_trx_k);
		$this->Barang_persediaan_model->input_transaksi_keluar($elementResult);
		redirect('permintaanBarangPersediaan.html');
	}

	public function aksi_hapus_trx_k($id_transaksi_keluar){
		$this->Barang_persediaan_model->hapus_transaksi_keluar($id_transaksi_keluar);
		//echo 'dsadas';
		redirect('permintaanBarangPersediaan.html');
	}

	public function aksi_permintaan(){
		$daftarBarang= $this->input->post('barang_persediaan');
		$jumlah= $this->input->post('jumlah');
		$id_trx_k=$this->setUnicIdTrxMasuk($this->input->post('tgl_keluar'));
		$elementResult=Array();
		for($i=0; $i<sizeof($daftarBarang);$i++)
		{
			if($daftarBarang[$i]!=""){
				$elementResult[]=array (
				'id_trx_k'=>$id_trx_k,
				'kd_brg'=>$daftarBarang[$i],
				'id_bdg_sks'=>$this->input->post('unitKerja'),
				'jumlah'=> $jumlah[$i],
				'id_satker'=>$this->session->userdata('id_satker'),
				'tgl_keluar'=> $this->setDateFormat($this->input->post('tgl_keluar')),
				);
			}

		}
		//echo (sizeof($daftarBarang));
		//print_r($daftarBarang);
		$this->Barang_persediaan_model->input_transaksi_keluar($elementResult);
		redirect('permintaanBarangPersediaan.html');
		//echo "berhasil Input Permintaan";
	}

	public function unitKerja($querySeksi, $queryBidang, $satker){
		$elementResult=Array();
		if(substr($satker, 2, 2)=="00"){
			foreach ($querySeksi as $row)
			{
				if($row->id_bidang!=""){
					$elementResult[]= array (
						'id_unit_kerja'=>"s".$row->id_seksi,
						'nm_unit_kerja' => $row->nm_seksi,
					);
				}
			}

			foreach ($queryBidang as $row)
			{
				$elementResult[]= array(
					'id_unit_kerja'=>"b".$row->id_bidang,
					'nm_unit_kerja' => $row->nm_bidang,
				);
			}
		}else{
			foreach ($querySeksi as $row)
			{
				if($row->id_bidang==""){
					$elementResult[]= array (
						'id_unit_kerja'=>"s".$row->id_seksi,
						'nm_unit_kerja' => $row->nm_seksi,
					);
				}
			}
		}
		return $elementResult;
	}

	public function kartu_kendali_page()
	{
		$content['page']='barang_persediaan/kartu_kendali_atk';
		$content['judul_halaman']='Kartu Kendali ATK';
		$query=$this->Barang_persediaan_model->get_stok($this->session->userdata('id_satker'));
		$content['barang_persediaan']=$query;
		$content['karkenHtml']="";
		$content['barangPersediaanCad']="";
		$content['tglMasukCad']="";
		$content['tglKeluarCad']="";

		//echo $a;
		$this->load->view('template/layout', $content);
	}

	public function aksi_KarkenAtk(){
		$content['page']='barang_persediaan/kartu_kendali_atk';
		$content['judul_halaman']='Kartu Kendali ATK';
		$query=$this->Barang_persediaan_model->get_stok($this->session->userdata('id_satker'));
		$content['barang_persediaan']=$query;

		$barang_persediaan=$this->input->post('barang_persediaan');
		$tglAwal=$this->setDateFormat($this->input->post('tglAwal'));
		$tglAkhir=$this->setDateFormat($this->input->post('tglAkhir'));

		$barang_persediaan=$this->olahGetBarangPersediaan($barang_persediaan, $tglAwal, $tglAkhir);


		$content['barangPersediaanCad']=json_encode($barang_persediaan);
		$content['tglMasukCad']=$tglAwal;
		$content['tglKeluarCad']=$tglAkhir;


		$head='<div class="" role="tabpanel" data-example-id="togglable-tabs">
						<ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">';

		$i=0;
		foreach($barang_persediaan as $row){

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

		//print_r($barang_persediaan);

		foreach($barang_persediaan as $row){
			if($j==0){
				$isi=$isi.'<div role="tabpanel" style="text-align:center" class="tab-pane fade active in" id="tab_content0" aria-labelledby="home-tab">';
			}else{
				$isi=$isi.'<div role="tabpanel" style="text-align:center" class="tab-pane fade" id="tab_content'.$j.'" aria-labelledby="home-tab">';
			}

			$objPHPExcel=PHPExcel_IOFactory::load(APPPATH.'libraries/excel/template - Copy.xlsx');
			$objWorksheet = $objPHPExcel->getActiveSheet();

			$isi=$isi.$this->isitabel($objPHPExcel, $row, $tglAwal, $tglAkhir, 'buat',0);

			$isi=$isi.'</div>';
			$j++;

		}

		$isi=$isi.'</div>';
		$content['karkenHtml']=$head.$isi;
		$this->load->view('template/layout', $content);

	}


	public function olahGetBarangPersediaan($barang_persediaan, $tglAwal, $tglAkhir){
		$barang=Array();
		foreach($barang_persediaan as $row){
			if($row=='00'){
				$barangTransaksiKeluar=$this->Barang_persediaan_model->getBarangTrxKeluarBeetwen($tglAwal, $tglAkhir, $this->session->userdata('id_satker'));

				//print_r($barangTransaksiKeluar);
				foreach($barangTransaksiKeluar as $row){
					$barang[]=$row->kd_brg;
				}

				$barangTransaksiMasuk=$this->Barang_persediaan_model->getBarangTrxMasukBeetwen($tglAwal, $tglAkhir, $this->session->userdata('id_satker'));
				//print_r($barangTransaksiMasuk);
				foreach($barangTransaksiMasuk as $row){
					$barang[]=$row->kd_brg;
				}
			}else{
				$barang[]=$row;
			}
		}
		return array_unique($barang);
	}

	public function isitabel($objPHPExcel, $kd_brg, $tglAwal, $tglAkhir, $jenisAksi, $index){
		$query=$this->Barang_persediaan_model->queryTrxKeluar($kd_brg, $tglAwal, $tglAkhir, $this->session->userdata('id_satker'));
		$query1=$this->Barang_persediaan_model->get_barang_persediaan_by_id($kd_brg, $this->session->userdata('id_satker'));
		$query2=$this->Barang_persediaan_model->queryTrxMasuk($kd_brg, $tglAwal, $tglAkhir, $this->session->userdata('id_satker'));
		$query3=$this->Barang_persediaan_model->queryStokAwalKeluar($tglAwal, $kd_brg, $this->session->userdata('id_satker'));
		$query4=$this->Barang_persediaan_model->queryStokAwalMasuk($tglAwal, $kd_brg, $this->session->userdata('id_satker'));

		$nm_satker="";
		if(substr ($this->session->userdata('id_satker'), 2, 2)=="00"){
			$nm_satker=substr ($this->session->userdata('nm_satker'), 4, 50);
		}else{
			$nm_satker=substr ($this->session->userdata('nm_satker'), 4, 50);
		}

		//Set Keterangan Barang
		if(sizeof($query1)>0){
			$objPHPExcel->setActiveSheetIndex($index)
					->setCellValue('O4', ": ".$query1[0]->ur_brg)
					->setCellValue('O5', ": ".$query1[0]->kd_brg)
					->setCellValue('O6', ": ".$query1[0]->satuan)
					->setCellValue('O7', ": ".$tglAwal.'  s/d  '.$tglAkhir)
					->setCellValue('A6', $nm_satker)
					->setCellValue('AC6', ": ".'2017');
		}

		$objDrawing=new PHPExcel_Worksheet_Drawing();
		$objDrawing->setPath('./assets/images/other/bps.gif');
		$objDrawing->setCoordinates('D1');
		$objDrawing->setWorkSheet($objPHPExcel->setActiveSheetIndex($index));

		//Set Isi tabel
		//Stok awal
		$stokKeluar=0;
		$stokMasuk=0;
		if(sizeof($query3)!=0){
			$stokKeluar=$query3[0]->jumlah;
		}else{
			$stokKeluar=0;
		}

		if(sizeof($query4)!=0){
			$stokMasuk=$query4[0]->jumlah;
		}else{
			$stokMasuk=0;
		}
		$stok=$stokMasuk-$stokKeluar;

		//Array Barang Keluar Bulanan
		$keluarBulan=Array();
		$keluarBulan[1]=0;
		$keluarBulan[2]=0;
		$keluarBulan[3]=0;
		$keluarBulan[4]=0;
		$keluarBulan[5]=0;
		$keluarBulan[6]=0;
		$keluarBulan[7]=0;
		$keluarBulan[8]=0;
		$keluarBulan[9]=0;
		$keluarBulan[10]=0;
		$keluarBulan[11]=0;
		$keluarBulan[12]=0;


		//Tabel Transaksi Keluar
		$data=Array();
		foreach($query as $row){
			array_push($data, Array(
				'id_transaksi'=>$row->id_trx_k,
				'tgl_trx'=>$row->tgl_keluar,
				'uraian'=>$this->setUraian($row->id_bdg_sks, $this->setDateFormatToField($row->tgl_keluar)),
				'jumlah'=>$row->jumlah,
				'jenis'=>'k'
			));

			if(substr($row->id_trx_k, 4, 2)=='01'){
				$keluarBulan[1]=$keluarBulan[1]+$row->jumlah;
			}else if(substr($row->id_trx_k, 4, 2)=='02'){
				$keluarBulan[2]=$keluarBulan[2]+$row->jumlah;
			}else if(substr($row->id_trx_k, 4, 2)=='03'){
				$keluarBulan[3]=$keluarBulan[3]+$row->jumlah;
			}else if(substr($row->id_trx_k, 4, 2)=='04'){
				$keluarBulan[4]=$keluarBulan[4]+$row->jumlah;
			}else if(substr($row->id_trx_k, 4, 2)=='05'){
				$keluarBulan[5]=$keluarBulan[5]+$row->jumlah;
			}else if(substr($row->id_trx_k, 4, 2)=='06'){
				$keluarBulan[6]=$keluarBulan[6]+$row->jumlah;
			}else if(substr($row->id_trx_k, 4, 2)=='07'){
				$keluarBulan[7]=$keluarBulan[7]+$row->jumlah;
			}else if(substr($row->id_trx_k, 4, 2)=='08'){
				$keluarBulan[8]=$keluarBulan[8]+$row->jumlah;
			}else if(substr($row->id_trx_k, 4, 2)=='09'){
				$keluarBulan[9]=$keluarBulan[9]+$row->jumlah;
			}else if(substr($row->id_trx_k, 4, 2)=='10'){
				$keluarBulan[10]=$keluarBulan[10]+$row->jumlah;
			}else if(substr($row->id_trx_k, 4, 2)=='11'){
				$keluarBulan[11]=$keluarBulan[11]+$row->jumlah;
			}else if(substr($row->id_trx_k, 4, 2)=='12'){
				$keluarBulan[12]=$keluarBulan[12]+$row->jumlah;
			}
		}

		//Tabel Transaksi masuk
		foreach($query2 as $row){
			array_push($data, Array(
				'id_transaksi'=>$row->id_trx_m,
				'tgl_trx'=>$row->tgl_masuk,
				'uraian'=>$row->penyedia,
				'jumlah'=>$row->jumlah,
				'jenis'=>'m'
			));
		}

		//print_r($data);
		$idTransaksi=Array();
		$sortArray= array();
		foreach($data as $key => $row){
			$idTransaksi[$key]=$row['id_transaksi'];
		}

		$sortArray=array_multisort($idTransaksi, SORT_ASC,  $data);
		//print_r($sortArray);
		$i=1;
		$barisPertama=16;
		$barisanKedua=17;
		$objPHPExcel->setActiveSheetIndex($index)->setCellValue('A'.($barisPertama), 1)
											->setCellValue('D'.($barisPertama), $tglAwal)
											->setCellValue('F'.($barisPertama), "Saldo Awal ")
											->setCellValue('L'.($barisPertama), $stok)
											->setCellValue('N'.($barisPertama), "0")
											->setCellValue('AD11', $stok)
											->setCellValue('P'.($barisPertama), $stok);

		//Isi Jumlah Pengeuaran Per Bulan
		$objPHPExcel->setActiveSheetIndex($index)->setCellValue('A11', $keluarBulan[1])
											->setCellValue('D11', $keluarBulan[2])
											->setCellValue('F11', $keluarBulan[3])
											->setCellValue('H11', $keluarBulan[4])
											->setCellValue('J11', $keluarBulan[5])
											->setCellValue('L11', $keluarBulan[6])
											->setCellValue('N11', $keluarBulan[7])
											->setCellValue('P11', $keluarBulan[8])
											->setCellValue('R11', $keluarBulan[9])
											->setCellValue('U11', $keluarBulan[10])
											->setCellValue('X11', $keluarBulan[11])
											->setCellValue('Z11', $keluarBulan[12])
											->setCellValue('AD11', '=L16')
											->setCellValue('AB11', '=SUM(A11:Z11)');


		//Percobaan
		$b=0;
		if(count($data)==0){
			$b=1;
		}else{
			$b=round((count($data))/2);
		}

		$objWorksheet = $objPHPExcel->getActiveSheet();
		$objWorksheet->insertNewRowBefore(18,$b);
		for ($m=18; $m<18+$b ; $m++) {
			$objWorksheet->mergeCells('B'.$m.':C'.$m);
			$objWorksheet->mergeCells('D'.$m.':E'.$m);
			$objWorksheet->mergeCells('F'.$m.':K'.$m);
			$objWorksheet->mergeCells('L'.$m.':M'.$m);
			$objWorksheet->mergeCells('N'.$m.':O'.$m);
			$objWorksheet->mergeCells('P'.$m.':Q'.$m);
			$objWorksheet->mergeCells('P'.$m.':Q'.$m);
			$objWorksheet->mergeCells('S'.$m.':T'.$m);
			$objWorksheet->mergeCells('U'.$m.':W'.$m);
			$objWorksheet->mergeCells('X'.$m.':AC'.$m);
			$objWorksheet->mergeCells('AD'.$m.':AE'.$m);
			$objWorksheet->mergeCells('AF'.$m.':AG'.$m);
			$objWorksheet->mergeCells('AH'.$m.':AI'.$m);
		}
		// Percobaan

		foreach($data as $row){
			if($i<($b+1)){
				if($row['jenis']=="m"){
					$objPHPExcel->setActiveSheetIndex($index)
								->setCellValue('L'.($barisPertama+1), $row['jumlah'])
								->setCellValue('N'.($barisPertama+1), 0);
				}else{
					$objPHPExcel->setActiveSheetIndex($index)
								->setCellValue('N'.($barisPertama+1), $row['jumlah'])
								->setCellValue('L'.($barisPertama+1), 0);
				}

				$objPHPExcel->setActiveSheetIndex($index)
							->setCellValue('A'.($barisPertama+1), $i+1)
							->setCellValue('D'.($barisPertama+1), $row['tgl_trx'])
							->setCellValue('F'.($barisPertama+1), $row['uraian'])
							->setCellValue('P'.($barisPertama+1), '=P'.($barisPertama).'+'.'L'.($barisPertama+1).'-'.'N'.($barisPertama+1));

				$barisPertama++;
			}else{
				if($row['jenis']=="m"){
					$objPHPExcel->setActiveSheetIndex($index)
								->setCellValue('AD'.($barisanKedua), $row['jumlah'])
								->setCellValue('AF'.($barisanKedua), 0);
				}else{
					$objPHPExcel->setActiveSheetIndex($index)
								->setCellValue('AF'.($barisanKedua), $row['jumlah'])
								->setCellValue('AD'.($barisanKedua), 0);
				}
				$objPHPExcel->setActiveSheetIndex($index)
							->setCellValue('R'.($barisanKedua), $i+1)
							->setCellValue('U'.($barisanKedua), $row['tgl_trx'])
							->setCellValue('X'.($barisanKedua), $row['uraian'])
							->setCellValue('AH'.($barisanKedua), '=AH'.($barisanKedua-1).'+'.'AD'.($barisanKedua).'-'.'AF'.($barisanKedua));
				$barisanKedua++;
			}
			$i++;
		}

			$objPHPExcel->setActiveSheetIndex($index)
							->setCellValue('L'.(18+$b), '=SUM(L16:M'.(17+$b).')')
							->setCellValue('N'.(18+$b), '=SUM(N16:O'.(17+$b).')')
							->setCellValue('P'.(18+$b), '=P'.(16+$b));
			//echo '=P'.($i+15);

			if($i<($b+1)){
				$objPHPExcel->setActiveSheetIndex($index)
							//->setCellValue('P'.(18+$b), '=P'.(16+$b))
							->setCellValue('P'.(18+$b), '=P'.$barisPertama)
							->setCellValue('AH11', '=P'.(18+$b));
			}else{
				$objPHPExcel->setActiveSheetIndex($index)
							->setCellValue('AD16', '=L'.(16+$b))
							->setCellValue('AD'.(18+$b), '=L'.(18+$b).'+SUM(AD17:AE'.(17+$b).')')
							->setCellValue('AF'.(18+$b), '=N'.(18+$b).'+SUM(AF17:AG'.(17+$b).')')
							->setCellValue('AH'.(18+$b), '=AH'.($barisanKedua-1))
							->setCellValue('AF16', '=N'.(16+$b))
							->setCellValue('AH16', '=P'.(16+$b))
							//->setCellValue('P39', '=P37')
							->setCellValue('AH11', '=AH'.(18+$b));
			}

		if($jenisAksi=='download'){
			return $objPHPExcel;
		}else if('buat'){
			//$objPHPExcelIsi=$this->isitabel($objPHPExcel, $row, $tglAwal, $tglAkhir);
			$objectWriter=PHPExcel_IOFactory::createWriter($objPHPExcel, 'HTML');
			$objectWriter->setSheetIndex($index);

			ob_start();
			$objectWriter->save('php://output');
			$a = ob_get_contents();
			ob_end_clean();
			return $a;
			exit;
		//return $objPHPExcel;
		}

	}

	public function aksi_download_excel(){
		$barang_persediaan=$this->input->post('barangPersediaanCad');
		$tglAwal=$this->input->post('tglMasukCad');
		$tglAkhir=$this->input->post('tglKeluarCad');
		$typeTombol=$this->input->post('typeTombol');

		$barang_persediaan=json_decode($barang_persediaan);

		//print_r($barang_persediaan);
		$i=0;
		$objPHPExcel=PHPExcel_IOFactory::load(APPPATH.'libraries/excel/template - Copy.xlsx');
		$objPHPExcelCad=PHPExcel_IOFactory::load(APPPATH.'libraries/excel/template - Copy.xlsx');

		foreach($barang_persediaan as $row){
			$query1=$this->Barang_persediaan_model->get_barang_persediaan_by_id($row, $this->session->userdata('id_satker'));


			if(sizeof($query1)>0){
				$nm_barang=str_replace('/',' ', $query1[0]->ur_brg);
			}


			if($i==0){
				$objPHPExcelIsi=$this->isitabel($objPHPExcel, $row, $tglAwal, $tglAkhir, 'download',$i);
				$objPHPExcel->getActiveSheet()->setTitle(substr($nm_barang,0,25));
			}else{

					// Set active sheet index to the first sheet, so Excel opens this as the first sheet
					$objPHPExcelCad->setActiveSheetIndex(0);

					//$sd = $objReader->load("sheet.xls");
					$sc =   $objPHPExcelCad ->getActiveSheet()->copy();
					$clonedSheet = clone $sc;

					$temporarySheet = clone $clonedSheet;
					$temporarySheet->setTitle(substr($nm_barang,0,25));
					$objPHPExcel->addSheet($temporarySheet,$i);
					$objPHPExcel->setActiveSheetIndex($i);

					$objPHPExcelIsi=$this->isitabel($objPHPExcel, $row, $tglAwal, $tglAkhir, 'download', $i);
			}
			// Rename worksheet
			//$objPHPExcel->getActiveSheet()->setTitle('kartu kendali');
			$i++;
		}

			if($typeTombol=="excel"){
				// Redirect output to a client’s web browser (Excel2007)
				header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
				header('Content-Disposition: attachment;filename="Kartu Kendali ATK - '.$tglAwal.' s.d '.$tglAkhir.'.xlsx"');
				header('Cache-Control: max-age=0');

				// If you're serving to IE 9, then the following may be needed
				header('Cache-Control: max-age=1');

				// If you're serving to IE over SSL, then the following may be needed
				header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
				header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
				header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
				header ('Pragma: public'); // HTTP/1.0

				$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
				ob_end_clean();
				$objWriter->save('php://output');

				//exit;
			}else{
				echo "salah Om";
			}
	}

	public function aksi_download_permintaan($id_trx){
		$trxKeluar=$this->Barang_persediaan_model->queryItemTrxKeluar($id_trx, $this->session->userdata('id_satker'));
		$objPHPExcel=PHPExcel_IOFactory::load(APPPATH.'libraries/excel/templatePermintaanBarang.xlsx');

		$queryBidang=$this->Barang_persediaan_model->get_bidang();
		$querySeksi=$this->Barang_persediaan_model->get_seksi();

		//$unitKerja=$this->setUraian($trxKeluar[0]->id_bdg_sks,$trxKeluar[0]->tgl_keluar);
		//$trxKeluar[0]->id_bdg_sks
		//echo $trxKeluar[0]->id_bdg_sks;
		//echo($unitKerja);

		if(sizeof($trxKeluar)>0){
			$unitKerja=$this->setUraian($trxKeluar[0]->id_bdg_sks,$trxKeluar[0]->tgl_keluar);
			$objPHPExcelIsi=$this->isiPermintaan($objPHPExcel, $trxKeluar, $unitKerja, $trxKeluar[0]->tgl_keluar);

			// Redirect output to a client’s web browser (Excel2007)
			header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
			header('Content-Disposition: attachment;filename=Permintaan-'.$unitKerja.'-'.$trxKeluar[0]->tgl_keluar.'.xlsx');
			header('Cache-Control: max-age=0');

			// If you're serving to IE 9, then the following may be needed
			header('Cache-Control: max-age=1');

			// If you're serving to IE over SSL, then the following may be needed
			header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
			header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
			header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
			header ('Pragma: public'); // HTTP/1.0

			$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
			ob_end_clean();
			$objWriter->save('php://output');
			exit;
		}
	}

	public function isiPermintaan($objPHPExcel, $trxKeluar, $unitKerja, $tgl_keluar){
		$nm_satker="";
		$menyetujui="";
		$penerimaBarang="";
		$nm_satker="";


		if(substr ($this->session->userdata('id_satker'), 2, 2)=="00"){
			//$queryMengetahui=$this->Jenis_Bmn_Model->getPegawaiByOrg($this->session->userdata('id_satker'), '92100', '2');
			//$queryYgMengurus=$this->Jenis_Bmn_Model->getPegawaiByOrg($this->session->userdata('id_satker'), '92140', '3');

			$nm_satker=substr ($this->session->userdata('nm_satker'), 4, 50);
			$menyetujui='Kasubbag Perlengkapan,';
			$penerimaBarang="Kepala ".$unitKerja;
		}else{
			$nm_satker=substr($this->session->userdata('nm_satker'), 4, 50);
			$menyetujui='Kasubbag Tata Usaha,';
			$penerimaBarang=$unitKerja;

			//$queryMengetahui=$this->Jenis_Bmn_Model->getPegawaiByOrg($this->session->userdata('id_satker'), '92800', '2');
			//$queryYgMengurus=$this->Jenis_Bmn_Model->getPegawaiByOrg($this->session->userdata('id_satker'), '92810', '3');
		}

		/*if(sizeof($queryMengetahui)>0){
			$nmMengetahui=$queryMengetahui[0]->gelar_depan.' '.$queryMengetahui[0]->nama.' '.$queryMengetahui[0]->gelar_belakang;
			$nipMengetahui='NIP. '.$queryMengetahui[0]->nipbaru;
		}

		if(sizeof($queryYgMengurus)>0){
			$nmYngMengurus=$queryYgMengurus[0]->gelar_depan.' '.$queryYgMengurus[0]->nama.' '.$queryYgMengurus[0]->gelar_belakang;
			$nipYngMengurus='NIP. '.$queryYgMengurus[0]->nipbaru;
		}*/

		$objPHPExcel->setActiveSheetIndex(0)
					->setCellValue('C2', $nm_satker)
					->setCellValue('B41', $menyetujui)
					->setCellValue('F41', $penerimaBarang);


		$objDrawing=new PHPExcel_Worksheet_Drawing();
		$objDrawing->setPath('./assets/images/other/bps.gif');
		$objDrawing->setCoordinates('A1');
		$objDrawing->setWorkSheet($objPHPExcel->setActiveSheetIndex(0));

			$objPHPExcel->setActiveSheetIndex(0)
					->setCellValue('E6', ": ".$unitKerja)
					->setCellValue('E7', ": ".$tgl_keluar);

			$barisPertama=11;
			$nomor=1;
			foreach($trxKeluar as $row){
				$objPHPExcel->setActiveSheetIndex(0)
					->setCellValue('B'.$barisPertama, $nomor)
					->setCellValue('C'.$barisPertama, $row->ur_brg)
					->setCellValue('F'.$barisPertama, $row->satuan)
					->setCellValue('G'.$barisPertama, $row->jumlah);

					$barisPertama++;
					$nomor++;
			}

	}

	public function setUraian($id_bdg_sks,$tgl_keluar ){
		$retur="";
		if(substr($id_bdg_sks, 0, 1)=="s"){
			$query=$this->Barang_persediaan_model->get_seksi_by_id(substr($id_bdg_sks, 1, 2));
			//print_r($query);
			$retur=$query[0]->nm_seksi;
		}else if(substr($id_bdg_sks, 0, 1)=="b"){
			$query=$this->Barang_persediaan_model->get_bidang_by_id(substr($id_bdg_sks, 1, 2));
			$retur=$query[0]->nm_bidang;
		}else{
			$retur="Stok Opname Tanggal ".$tgl_keluar;
		}
		return $retur;
	}

	public function input_master_data(){
		$objPHPExcel=PHPExcel_IOFactory::load(APPPATH.'libraries/excel/7402_muna.xls');
		//$sql="";
		$data=Array();
		for($i=2; $i<748; $i++){
				$data[]=Array(
					'kd_brg'=>$objPHPExcel->getActiveSheet()->getCellByColumnAndRow(0, $i)->getValue(),
					'ur_brg'=>$objPHPExcel->getActiveSheet()->getCellByColumnAndRow(1, $i)->getValue(),
					'satuan'=>$objPHPExcel->getActiveSheet()->getCellByColumnAndRow(2, $i)->getValue(),
					'id_satker'=>$objPHPExcel->getActiveSheet()->getCellByColumnAndRow(3, $i)->getValue()
				);
			}
		$this->Barang_persediaan_model->input_master_barang($data);
	}

	public function karken_permintaan_persediaan_unker(){
		$content['page']='barang_persediaan/permintaanAtkPerUnitKerja';
		$content['judul_halaman']='Permintaan ATK Unit Kerja';
		//$query=$this->Barang_persediaan_model->get_stok($this->session->userdata('id_satker'));

		$queryBidang=$this->Barang_persediaan_model->get_bidang();
		$querySeksi=$this->Barang_persediaan_model->get_seksi();

		$unitKerja=$this->unitKerja($querySeksi, $queryBidang, $this->session->userdata['id_satker']);
		//print_r($unitKerja);

		$content['unit_kerja']=$unitKerja;
		$content['karkenHtml']="";

		$content['unitKerjaCad']="";
		$content['tglMasukCad']="";
		$content['tglKeluarCad']="";
		$content['jnsLaporanCad']="";

		//echo $a;
		$this->load->view('template/layout', $content);
	}

	public function aksi_pemintaan_atk_unit_kerja(){
		$content['page']='barang_persediaan/permintaanAtkPerUnitKerja';
		$content['judul_halaman']='Permintaan ATK Unit Kerja';

		$queryBidang=$this->Barang_persediaan_model->get_bidang();
		$querySeksi=$this->Barang_persediaan_model->get_seksi();

		$unitKerja=$this->unitKerja($querySeksi, $queryBidang, $this->session->userdata['id_satker']);
		$content['unit_kerja']=$unitKerja;

		$unitKerja=$this->input->post('unitKerja');
		$tglAwal=$this->setDateFormat($this->input->post('tglAwal'));
		$tglAkhir=$this->setDateFormat($this->input->post('tglAkhir'));
		$jnsLaporan=$this->input->post('jnsLaporan');

		$transaksi=Array();
		$uraianUnitKerja=$this->setUraian($unitKerja,null );
		//print_r($transaksi);
		$content['unitKerjaCad']=$unitKerja;
		$content['tglMasukCad']=$tglAwal;
		$content['tglKeluarCad']=$tglAkhir;
		$content['jnsLaporanCad']=$jnsLaporan;


		$path="";
		if($jnsLaporan=='detail'){
			$path='libraries/excel/laporanPengambilanPerSeksiDetail.xlsx';
			$transaksi=$this->Barang_persediaan_model->queryrTrxKeluarByUnitKerja($unitKerja,
						$this->session->userdata('id_satker'), $tglAwal, $tglAkhir);
		}else if($jnsLaporan=='rekap'){
			$path='libraries/excel/laporanPengambilanPerSeksiRekap.xlsx';
			$transaksi=$this->Barang_persediaan_model->queryrTrxKeluarByUnitKerja2($unitKerja,
						$this->session->userdata('id_satker'), $tglAwal, $tglAkhir);
		}

		$objPHPExcel=PHPExcel_IOFactory::load(APPPATH.$path);
			$objPHPExcelIsi=$this->isitabelLaporanPerSeksi($objPHPExcel, $transaksi, $uraianUnitKerja,
								$this->setDateFormatToField2($tglAwal), $this->setDateFormatToField2($tglAkhir), $jnsLaporan);

		$objectWriter=PHPExcel_IOFactory::createWriter($objPHPExcelIsi, 'HTML');
		$objectWriter->setSheetIndex(0);

		ob_start();
		$objectWriter->save('php://output');
		$a = ob_get_contents();
		ob_end_clean();

		$content['karkenHtml']=$a;
		$this->load->view('template/layout', $content);
	}

	public function aksi_download_pemintaan_atk_unit_kerja(){
		$unitKerja=$this->input->post('unitKerjaCad');
		$tglAwal=$this->input->post('tglMasukCad');
		$tglAkhir=$this->input->post('tglKeluarCad');
		$jnsLaporan=$this->input->post('jnsLaporanCad');

		$transaksi=Array();
		$uraianUnitKerja=$this->setUraian($unitKerja,null );
		//print_r($transaksi);
		$content['unitKerjaCad']=$unitKerja;
		$content['tglMasukCad']=$tglAwal;
		$content['tglKeluarCad']=$tglAkhir;
		$content['jnsLaporanCad']=$jnsLaporan;


		$path="";
		if($jnsLaporan=='detail'){
			$path='libraries/excel/laporanPengambilanPerSeksiDetail.xlsx';
			$transaksi=$this->Barang_persediaan_model->queryrTrxKeluarByUnitKerja($unitKerja,
						$this->session->userdata('id_satker'), $tglAwal, $tglAkhir);
		}else if($jnsLaporan=='rekap'){
			$path='libraries/excel/laporanPengambilanPerSeksiRekap.xlsx';
			$transaksi=$this->Barang_persediaan_model->queryrTrxKeluarByUnitKerja2($unitKerja,
						$this->session->userdata('id_satker'), $tglAwal, $tglAkhir);
		}

		$objPHPExcel=PHPExcel_IOFactory::load(APPPATH.$path);
		$objPHPExcelIsi=$this->isitabelLaporanPerSeksi($objPHPExcel, $transaksi, $uraianUnitKerja,
								$tglAwal, $tglAkhir, $jnsLaporan);

		$objectWriter=PHPExcel_IOFactory::createWriter($objPHPExcelIsi, 'HTML');
		$objectWriter->setSheetIndex(0);

			// Redirect output to a client’s web browser (Excel2007)
			header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
			header('Content-Disposition: attachment;filename=Permintaan-'.$unitKerja.'-'.$tglAwal.' s.d '.$tglAkhir.'.xlsx');
			header('Cache-Control: max-age=0');

			// If you're serving to IE 9, then the following may be needed
			header('Cache-Control: max-age=1');

			// If you're serving to IE over SSL, then the following may be needed
			header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
			header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
			header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
			header ('Pragma: public'); // HTTP/1.0

			$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
			ob_end_clean();
			$objWriter->save('php://output');
			exit;
	}

	public function isitabelLaporanPerSeksi($objPHPExcel, $transaksi, $unitKerja, $tglAwal, $tglAkhir, $jnsLaporan){
		$nm_satker="";
		if(substr ($this->session->userdata('id_satker'), 2, 2)=="00"){
			$nm_satker=substr ($this->session->userdata('nm_satker'), 4, 50);
		}else{
			$nm_satker=substr ($this->session->userdata('nm_satker'), 4, 50);
		}

		//Set Keterangan Barang
		$objPHPExcel->setActiveSheetIndex(0)
					->setCellValue('C3', $nm_satker)
					->setCellValue('C6', ": ".$unitKerja)
					->setCellValue('C7', ": ".$tglAwal.' s.d '.$tglAkhir);


		$objDrawing=new PHPExcel_Worksheet_Drawing();
		$objDrawing->setPath('./assets/images/other/bps.gif');
		$objDrawing->setCoordinates('A1');
		$objDrawing->setWorkSheet($objPHPExcel->setActiveSheetIndex(0));

		$nomor=1;
		$barisPertama=11;
		if($jnsLaporan=='detail'){
			foreach($transaksi as $row){
				$objPHPExcel->setActiveSheetIndex(0)
						->setCellValue('A'.$barisPertama, $nomor)
						->setCellValue('B'.$barisPertama, $row->tgl_keluar)
						->setCellValue('D'.$barisPertama, $row->ur_brg)
						->setCellValue('G'.$barisPertama, $row->satuan)
						->setCellValue('H'.$barisPertama, $row->jumlah);

				$nomor++;
				$barisPertama++;
			}
			$objPHPExcel->setActiveSheetIndex(0)
						->setCellValue('G45', 'Kepala '.$unitKerja);

		}else{
			foreach($transaksi as $row){
				$objPHPExcel->setActiveSheetIndex(0)
						->setCellValue('A'.$barisPertama, $nomor)
						->setCellValue('B'.$barisPertama, $row->ur_brg)
						->setCellValue('E'.$barisPertama, $row->satuan)
						->setCellValue('F'.$barisPertama, $row->sumJumlah);

				$nomor++;
				$barisPertama++;
			}
			$objPHPExcel->setActiveSheetIndex(0)
						->setCellValue('E45', 'Kepala '.$unitKerja.',');
		}
		return $objPHPExcel;
	}

	public function input_master_persediaan_page(){
		$content['page']='barang_persediaan/inputMasterPersediaan';
		$content['judul_halaman']='Input Master Persediaan';
		$content['barang_persediaan']=$this->Barang_persediaan_model->get_barang_persediaan_by_satker($this->session->userdata('id_satker'));

		$this->load->view('template/layout', $content);
	}

	public function aksi_input_mater_persediaan(){
		$id= $this->input->post('id');
		$nm= $this->input->post('nm');
		$satuan=$this->input->post('satuan');
		$elementResult=Array();

			$elementResult=array (
				'kd_brg'=>$id,
				'ur_brg'=>$nm,
				'satuan'=>$satuan,
				'id_satker'=> $this->session->userdata('id_satker')
			);


			$this->Barang_persediaan_model->input_master_persediaan($elementResult);
			redirect('/inputMasterPersediaan.html');
	}

	public function aksi_edit_mater_persediaan(){
		$id= $this->input->post('id');
		$idCad= $this->input->post('idCad');
		$nm= $this->input->post('nm');
		$satuan=$this->input->post('satuan');
		$elementResult=Array();
			$elementResult=array (
				'kd_brg'=>$id,
				'ur_brg'=>$nm,
				'satuan'=>$satuan,
				'id_satker'=> $this->session->userdata('id_satker')
			);


			$this->Barang_persediaan_model->edit_master_persediaan($elementResult, $idCad);
			redirect('/inputMasterPersediaan.html');
	}

	public function aksi_hapus_mater_persediaan($kd_brg){
			$this->Barang_persediaan_model->hapus_barang_persediaan($kd_brg, $this->session->userdata('id_satker'));
			redirect('/inputMasterPersediaan.html');
	}

	public function setDateFormat($strigDate){
		$pieces = explode("/", $strigDate);
		$date=$pieces[2]."-".$pieces[0]."-".$pieces[1];
		return $date;
	}

	public function setDateFormatToField($strigDate){
		$pieces = explode("-", $strigDate);
		$date=$pieces[2]."/".$pieces[0]."/".$pieces[1];
		return $date;
	}

	public function setDateFormatToField2($strigDate){
		$pieces = explode("-", $strigDate);
		$date=$pieces[1]."/".$pieces[2]."/".$pieces[0];
		return $date;
	}

	public function setUnicIdTrxMasuk($stringDate){
		$pieces = explode("/", $stringDate);
		$id=$pieces[2].$pieces[0].$pieces[1].date("His");
		return $id;
	}

}
