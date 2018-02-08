<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
	<div class="x_panel">
	<div class="x_title">
		<h2> Autentifikasi</h2>
	<div class="clearfix"></div>
	</div>
	<div class="x_content">
		<form style="display:none" action="<?php echo base_url();?>editAkses" enctype="multipart/form-data" method="post" id="form_inputAkses" data-parsley-validate class="form-horizontal form-label-left">
			<input type="text" id="niplama" name="niplama" style="display:none">	
			<div class="form-group">
				<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Username<span class="required">*</span></label>
				<div class="col-md-6 col-sm-6 col-xs-12">
					<input type="text" id="user" name="user" value="" required="required" class="form-control col-md-7 col-xs-12">
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Password</label>
				<div class="col-md-6 col-sm-6 col-xs-12">
					<input type="password" id="pass" name="pass" value=""  class="form-control col-md-7 col-xs-12">
				</div>
			</div>
			<div class="form-group">
					<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Akses<span class="required">*</span></label>
					<div class="col-md-6 col-sm-6 col-xs-12">
                          <select id="akses" style="width:100%" name="akses" required="required" class="select0_single form-control col-md-7 col-xs-12" >
							<option ></option>
							<option value="0">Tidak Ada Akses</option>
							<option value="1">Pimpinan Kabupaten</option>
							<option value="3">Pimpinan Provinsi</option>
							<option value="2">Pengelola Barang Persediaan dan BMN</option>
							<option value="21">Pengelola Barang Persediaan </option>
							<option value="22">Pengelola BMN</option>
							<option value="4">Admin Utama</option>
						
							
							?>
                         <span class="required">*</span> </select>
                        </div>
			</div>
			 <div class="form-group" >
					<div align="center" >
					  <button type="reset"  mode="edit" id="reset" class="btn btn-primary">Batal</button>
					  <button type="submit" mode="input"id="simpan" class="btn btn-success">Simpan</button>
					</div>
				</div>
		</form>
		</div>
		<div class="x_panel">
		<div class="x_content">
		<div class="clearfix"></div>
		<table  id="tabelStok" class="table table-striped table-bordered" cellspacing="0" width="100%">
			<thead>
				<th>Nama</th>
				<th>Username</th>
				<th>Hak Akses</th>
				<th>Aksi</th>
			</thead>
			<tbody>
				<?php 
				
				foreach($autentifikasi as $row){
					$akses="";
					if($row->id_sibaper==0){
						$akses='Tidak Ada Akses';
					}else if($row->id_sibaper==1){
						$akses='Pimpinan Kabupaten';
					}else if($row->id_sibaper==3){
						$akses='Pimpinan Provinsi';
					}else if($row->id_sibaper==2){
						$akses='Pengelola Barang Persediaan dan BMN';
					}else if($row->id_sibaper==21){
						$akses='Pengelola Barang Persediaan';
					}else if($row->id_sibaper==21){
						$akses='Pengelola BMN';
					}else if($row->id_sibaper==4){
						$akses='Admin Utama';
					}
					
					$gelarBelakang="";
					if($row->gelar_belakang!=''){
						$gelarBelakang=', '.$row->gelar_belakang;
					}
					
					echo '<tr>
							<td>'.$row->gelar_depan.' '.$row->nama.$gelarBelakang.'</td>
							<td>'.$row->username.'</td>
							<td>'.$akses.'</td>
							
							<td> 
								<button type="button" id="editAkses" nama="'.$row->gelar_depan.' '.$row->nama.$gelarBelakang.'" 
								niplama="'.$row->niplama.'" username="'.$row->username.'" hakAkses="'.$row->id_sibaper.'" class="btn btn-round btn-warning">Edit Akun</button>
							 </td> 
						</tr>';
				}
						?>
			</tbody>
		</table>
	</div>
	</div>
	</div>
	<div style="display:none" id="dialog-confirm">
		<p id="modal"></p>
	</div>
	</div>
	</div>
	<script>
		$(document).ready(function() {
			$("[id=editAkses]").click(function(){
				$("#user").val($(this).attr('username'));
				$("#pass").val('**##**##');
				$("#akses").val($(this).attr('hakAkses')).change();
				$("#niplama").val($(this).attr('niplama'));
				
				$("#form_inputAkses").css('display', '');
			});
			
			$(".select0_single").select2({
			  placeholder: "",
			  allowClear: true
			});
			
			$("#reset").click(function(e){
				e.preventDefault();
				if($(this).attr('mode')=='edit'){
					$("#modal").text("Apakah Anda Yakin Membatalkan Edit Data ini ?")
					$( "#dialog-confirm" ).dialog({
						  resizable: false,
						  height: "auto",
						  width: 400,
						  modal: true,
						  buttons: {
							"Ya": function() {
							  $(this ).dialog( "close" );
									$("#user").val('');
									$("#niplama").val('');
									$("#pass").val('');
									$("#akses").val('0').change();
									$("#form_inputAkses").css('display', 'none');
							},
							"Tidak": function() {
							  $( this ).dialog( "close" );
							  
							}
						  }
					});
				}
			});
			
			$("[id=hapusPegawai]").click(function(e){
				e.preventDefault();
				var a=this;
				$("#modal").text("Apakah Anda Yakin Menghapus Pegawai ini ?");
				$("#dialog-confirm").dialog({
						  resizable: false,
						  height: "auto",
						  width: 400,
						  modal: true,
						  buttons: {
							"Ya": function() {
							  $(this ).dialog( "close" );
							  window.location = a.href;
							},
							"Tidak": function() {
							  $(this).dialog( "close" );
							}
						  }
				})
				
			})
		})
	</script>