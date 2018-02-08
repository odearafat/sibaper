<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'Home_controller';
$route['login'] = 'login_controller/aksi_login';
$route['login.html'] = 'Login_controller/login_page';
$route['logout.html'] = 'Login_controller/aksi_logout';
$route['gantiPassword.html'] = 'Master_controller/ganti_pasword_page';
$route['aksiGantiPassword'] = 'Master_controller/aksi_ganti_password';
$route['beranda.html'] = 'Home_controller';
$route['inputJenisBmn.html'] = 'Bmn_controller/master_jenis_bmn_page';
$route['inputBmn.html'] = 'Bmn_controller/master_bmn_page';
$route['inputPerawatan.html'] = 'Bmn_controller/input_perawatan_page';
$route['inputPerawatanBmn'] = 'Bmn_controller/aksi_input_perawatan';
$route['inputKendaraan'] = 'Bmn_controller/aksi_input_kendaraan';
$route['inputNonKendaraan'] = 'Bmn_controller/aksi_input_non_kendaraan';
$route['aksiInputJenisBmn'] = 'Bmn_controller/aksi_input_jenis_bmn';
$route['editJenisBmn'] = 'Bmn_controller/aksi_edit_jenis_bmn';
$route['editKendaraan'] = 'Bmn_controller/aksi_edit_kendaraan';
$route['editNonKendaraan'] = 'Bmn_controller/aksi_edit_non_kendaraan';
$route['hapusJenisBmn/(:any)'] = 'Bmn_controller/aksi_hapus_jenis_bmn/$1';
$route['hapusKendaraan/(:any)'] = 'Bmn_controller/aksi_hapus_kendaraan/$1';
$route['hapusNonKendaraan/(:any)'] = 'Bmn_controller/aksi_hapus_non_kendaraan/$1';
$route['hapusDaftarPerawatan/(:any)/(:any)'] = 'Bmn_controller/aksi_hapus_daftar_perawatan/$1/$2';
$route['editPerawatanPage/(:any)/(:any)'] = 'Bmn_controller/edit_perawatan_page/$1/$2';
$route['editPerawatanBmn'] = 'Bmn_controller/edit_perawatan_aksi';
$route['karkenBMN.html'] = 'Bmn_controller/kartu_kendali_page';
$route['aksiKarkenBmn'] = 'Bmn_controller/aksi_karken_bmn';
$route['downloadExcelBmn'] = 'Bmn_controller/aksi_download_karken_bmn';
$route['daftarBmn.html'] = 'bmn_controller/daftar_bmn_page';
$route['daftarBmn/(:any)'] = 'bmn_controller/daftar_bmn_satker/$1';
$route['daftarAset.html'] = 'Bmn_controller/daftar_aset_page/1/dadsada';
$route['daftarAset/(:any)/(:any)'] = 'Bmn_controller/daftar_aset_page/$1/$2';
$route['perawatanba/(:any)/(:any)/(:any)'] = 'Bmn_controller/perawatan_bmn_by_id_page/$1/$2/$3';
$route['detail/(:any)/(:any)/(:any)'] = 'Bmn_controller/detail_bmn/$1/$2/$3';
$route['inputMasterPersediaan.html'] = 'Barang_persediaan_controller/input_master_persediaan_page';
$route['aksiInputMasterPersediaan'] = 'Barang_persediaan_controller/aksi_input_mater_persediaan';
$route['editMasterPersediaan'] = 'Barang_persediaan_controller/aksi_edit_mater_persediaan';
$route['hapusBarangPersediaan/(:any)'] = 'Barang_persediaan_controller/aksi_hapus_mater_persediaan/$1';

$route['inputMasterPegawai.html'] = 'Master_controller/input_master_pegawai_page';
$route['inputPegawai'] = 'Master_controller/aksi_input_pegawai';
$route['editPegawai'] = 'Master_controller/aksi_edit_pegawai';
$route['hapusPegawai/(:any)'] = 'Master_controller/aksi_hapus_pegawai/$1';
$route['hakAkses.html'] = 'Master_controller/hak_akses_page';
$route['editAkses'] = 'Master_controller/aksi_edit_akses';

$route['daftarBarangAset.html'] = 'barang_aset_controller/daftar_barang';
$route['inputBarangAset.html/(:any)/(:any)'] = 'barang_aset_controller/input_barang/$1/$2';
$route['inputBarangAset.html'] = 'barang_aset_controller/input_barang/blank/blank';
$route['perawatanBarangAset.html'] = 'barang_aset_controller/perawatan_barang';
$route['transferBarangAset.html'] = 'barang_aset_controller/transfer_barang';
$route['detail/(:num)'] = 'barang_aset_controller/detail_barang_page/$1';
$route['editba/(:num)'] = 'barang_aset_controller/edit_barang_page/$1';
$route['editpba/(:num)'] = 'barang_aset_controller/edit_perawatan_page/$1';
$route['editData/(:num)'] = 'barang_aset_controller/aksi_edit_barang/$1';
$route['perawatanba/(:num)'] = 'barang_aset_controller/input_perawatan_by_barang/$1';
$route['hapusba/(:num)'] = 'barang_aset_controller/aksi_hapus_barang';
$route['hapuspba/(:num)'] = 'barang_aset_controller/aksi_hapus_perawatan';
$route['inputData'] = 'barang_aset_controller/aksi_input_barang';
$route['inputPerawatan'] = 'barang_aset_controller/aksi_input_perawatan';
$route['stok.html'] = 'barang_persediaan_controller/stok_page';
$route['stok/(:any)'] = 'barang_persediaan_controller/stok_satker/$1';
$route['inputPersediaan'] = 'Barang_persediaan_controller/aksi_input_barang';
$route['editInputPersediaan'] = 'Barang_persediaan_controller/aksi_edit_input_barang';
$route['permintaanPersediaan'] = 'Barang_persediaan_controller/aksi_permintaan';
$route['permintaanPersediaanEdit'] = 'Barang_persediaan_controller/aksi_edit_permintaan';
$route['hapusDaftarPermintaan/(:any)'] = 'Barang_persediaan_controller/aksi_hapus_trx_k/$1';
$route['hapusDaftarInput/(:any)'] = 'Barang_persediaan_controller/aksi_hapus_trx_m/$1';
$route['stockOpname'] = 'Barang_persediaan_controller/aksi_stockOpname';
$route['karkenATK.html'] = 'Barang_persediaan_controller/kartu_kendali_page';
$route['permintaanAtkUnitKerja.html'] = 'Barang_persediaan_controller/karken_permintaan_persediaan_unker';
$route['aksiKarkenAtk'] = 'Barang_persediaan_controller/aksi_KarkenAtk';
$route['download_excel'] = 'Barang_persediaan_controller/aksi_download_excel';
$route['test'] = 'Barang_persediaan_controller/input_master_data';
$route['printItemPermintaan/(:any)'] = 'Barang_persediaan_controller/aksi_download_permintaan/$1';
$route['editItemPermintaan/(:any)'] = 'Barang_persediaan_controller/page_edit_permintaan/$1';
$route['editInput/(:any)'] = 'Barang_persediaan_controller/input_barang_edit/$1';
$route['aksiPemintaanAtkUnitKerja'] = 'Barang_persediaan_controller/aksi_pemintaan_atk_unit_kerja';
$route['downloadExcelPerUnitKerja'] = 'Barang_persediaan_controller/aksi_download_pemintaan_atk_unit_kerja';

$route['daftarBarangPersediaan.html'] = 'Barang_persediaan_controller/daftar_barang';
$route['inputBarangPersediaan.html'] = 'Barang_persediaan_controller/input_barang';
$route['permintaanBarangPersediaan.html'] = 'Barang_persediaan_controller/permintaan_barang';

$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
