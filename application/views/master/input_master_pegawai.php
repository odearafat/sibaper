<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
	<div class="x_panel">
	<div class="x_title">
		<h2> Master Pegawai <small> Autentifikasi</small></h2>
	<div class="clearfix"></div>
	</div>
	<div class="x_content">
		<form action="<?php echo base_url();?>inputPegawai" enctype="multipart/form-data" method="post" id="form_inputPegawai" data-parsley-validate class="form-horizontal form-label-left">
				<div class="form-group">
				<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Nama<span class="required">*</span></label>
				<div class="col-md-6 col-sm-6 col-xs-12">
					<input type="text" id="nama" name="nama" value="" required="required" class="form-control col-md-7 col-xs-12">
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Gelar Depan</label>
				<div class="col-md-6 col-sm-6 col-xs-12">
					<input type="text" id="gelarDepan" name="gelarDepan" value=""  class="form-control col-md-7 col-xs-12">
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Gelar Belakang </label>
				<div class="col-md-6 col-sm-6 col-xs-12">
					<input type="text" id="gelarBelakang" name="gelarBelakang" value="" class="form-control col-md-7 col-xs-12">
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">NIP Lama<span class="required">*</span></label>
				<div class="col-md-6 col-sm-6 col-xs-12">
					<input type="number" id="nipLama" name="nipLama" value="" required="required" class="form-control col-md-7 col-xs-12">
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">NIP Baru<span class="required">*</span></label>
				<div class="col-md-6 col-sm-6 col-xs-12">
					<input type="number" id="nipBaru" name="nipBaru" value="" required="required" class="form-control col-md-7 col-xs-12">
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Email<span class="required">*</span></label>
				<div class="col-md-6 col-sm-6 col-xs-12">
					<input type="text" id="email" name="email" value="" required="required" class="form-control col-md-7 col-xs-12">
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Golongan<span class="required">*</span></label>
				<div class="col-md-6 col-sm-6 col-xs-12">
                          <select id="golongan" name="golongan" required="required" class="select0_single form-control col-md-7 col-xs-12" >
                           <option value="" ></option>
							<?php 
							foreach($gol as $row)
							{
									echo '<option value="'.$row->id_gol.
										'">'.$row->pangkat.' / '.$row->n_gol.'</option>';
							}
									?>
                         <span class="required">*</span> </select>
                        </div>
			</div>
			<div class="form-group">
				<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Satuan Kerja<span class="required">*</span></label>
				<div class="col-md-6 col-sm-6 col-xs-12">
                          <select id="satker" name="satker" required="required" class="select0_single form-control col-md-7 col-xs-12" >
                           <option value="" ></option>
							<?php 
							foreach($satker as $row)
							{
									echo '<option value="'.$row->id_satker.
										'">'.$row->nm_satker.'</option>';
							}
									?>
                         <span class="required">*</span> </select>
                        </div>
			</div>
			<div class="form-group">
				<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Unit Kerja<span class="required">*</span></label>
				<div class="col-md-6 col-sm-6 col-xs-12">
						  <select id="unitKerja" name="unitKerja" required="required" class="select0_single form-control col-md-7 col-xs-12" >
                           <option value="" ></option>
							<?php 
							foreach($unitKerja as $row)
							{
									echo '<option value="'.$row->id_org.
										'">'.$row->nm_org.'</option>';
							}
									?>
                         <span class="required">*</span> </select>
                        </div>
			</div>
			<!--
			<div class="form-group">
					<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Akses<span class="required">*</span></label>
					<div class="col-md-6 col-sm-6 col-xs-12">
                          <select id="akses" name="akses" required="required" class="select0_single form-control col-md-7 col-xs-12" >
							<option ></option>
							<option value="0">Tidak Ada Akses</option>
							<option value="1">Pimpinan</option>
							<option value="2">Pengelola Barang Persediaan dan BMN</option>
							<option value="21">Pengelola Barang Persediaan </option>
							<option value="22">Pengelola BMN</option>
							<option value="4">Admin Utama</option>
							
							?>
                         <span class="required">*</span> </select>
                        </div>
			</div>
			-->
			 <div class="form-group" >
					<div align="center" >
					  <button type="reset"  mode="input" id="reset" class="btn btn-primary">Reset</button>
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
				<th>NIP Lama</th>
				<th>Nama</th>
				<th>Email</th>
				<th>Satker</th>
				<th>Aksi</th>
			</thead>
			<tbody>
				<?php 
				//rint_r($pegawai);
				foreach($pegawai as $row){
					/*$akses="";
					if($row->id_sibaper==0){
						$akses='Tidak Ada Akses';
					}else if($row->id_sibaper==1){
						$akses='Pimpinan';
					}else if($row->id_sibaper==2){
						$akses='Pengelola Barang Persediaan dan BMN';
					}else if($row->id_sibaper==21){
						$akses='Pengelola Barang Persediaan';
					}else if($row->id_sibaper==21){
						$akses='Pengelola BMN';
					}else if($row->id_sibaper==4){
						$akses='Admin Utama';
					}*/
					echo '<tr>
							<td>'.$row->niplama.'</td>
							<td>'.$row->gelar_depan.' '.$row->nama.' '.$row->gelar_belakang.'</td>
							<td>'.$row->email.'</td>
							<td>'.$row->nm_satker.'</td>
							
							<td> 
								<div class="btn-group">
									<button type="button" class="btn btn-info btn-xs">Action</button>
										<button type="button"  class="btn btn-danger btn-xs dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
											<span class="caret"></span>
											<span class="sr-only">Toggle Dropdown</span>
										</button>
									<ul class="dropdown-menu" role="menu">
										<li>
											<a niplama="'.$row->niplama.'" 
												nipbaru="'.$row->nipbaru.'" email="'.$row->email.'"
												nama="'.$row->nama.'" gelarDepan="'.$row->gelar_depan.'" 
												gelarBelakang="'.$row->gelar_belakang.'" 
												golongan="'.$row->id_gol.'" unitKerja="'.$row->id_org.'" satker="'.$row->id_satker.'" 
												id="editPegawai" >Edit</a></li>
										</li>
										<li>
											<a href="'.base_url().'hapusPegawai/'.$row->niplama.'" niplama="'.$row->niplama.'" id="hapusPegawai" >Hapus</a></li>
										</li>
									</ul>
								</div>
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
			$("[id=editPegawai]").click(function(){
				$("#nama").val($(this).attr('nama'));
				$("#gelarDepan").val($(this).attr('gelarDepan'));
				$("#gelarBelakang").val($(this).attr('gelarBelakang'));
				$("#nipLama").val($(this).attr('nipLama'));
				$("#nipBaru").val($(this).attr('nipBaru'));
				$("#email").val($(this).attr('email'));
				$("#golongan").val($(this).attr('golongan')).change();
				$("#satker").val($(this).attr('satker')).change();
				$("#unitKerja").val($(this).attr('unitKerja')).change();
				$("#reset").attr('mode', 'edit');
				$("#reset").text('Batal');
				$("#form_inputPegawai").attr('action', 'editPegawai');
				//$("#kategori").val($(this).('merk'));
				//alert($(this).attr('id'));
			});
			
			$(".select0_single").select2({
			  placeholder: "",
			  allowClear: true
			});
			
			$("#reset").click(function(e){
				e.preventDefault();
				if($(this).attr('mode')=='edit'){
					$("#modal").text("Apakah Anda Yakin Membatalkan Edit Data Pegawai ini ?")
					$( "#dialog-confirm" ).dialog({
						  resizable: false,
						  height: "auto",
						  width: 400,
						  modal: true,
						  buttons: {
							"Ya": function() {
							  $(this ).dialog( "close" );
								$("#nama").val('');
								$("#gelarDepan").val('');
								$("#gelarBelakang").val('');
								$("#nipLama").val('');
								$("#nipBaru").val('');
								$("#email").val('');
								$("#golongan").val('').change();
								$("#satker").val('').change();
								$("#unitKerja").val('').change();
								$("#reset").attr('mode', 'edit');
								$("#reset").text('Batal');
								$("#form_inputPegawai").attr('action', 'inputPegawai');
								$("#reset").attr('mode', 'input');
								$("#reset").text('Reset');
							},
							"Tidak": function() {
							  $( this ).dialog( "close" );
							  
							}
						  }
					});
				}else{
					$("#nama").val('');
					$("#gelarDepan").val('');
					$("#gelarBelakang").val('');
					$("#nipLama").val('');
					$("#nipBaru").val('');
					$("#email").val('');
					$("#golongan").val('').change();
					$("#satker").val('').change();
					$("#unitKerja").val('').change();
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