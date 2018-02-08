<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
	<div class="x_panel">
	<div class="x_title">
		<h2> Input dan Daftar BMN <small></small></h2>
	<div class="clearfix"></div>
	</div>
	<div class="x_panel">
	<h2>  <small id="textJudul">Input BMN</small></h2>
	<div class="x_title">
	<div class="x_content">
		<form  style="padding-top:2%" class="form-horizontal form-label-left">
			<div class="form-group">
					<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Pilih Master BMN</label>
					<div class="col-md-6 col-sm-6 col-xs-12">
                          <select style="width:100%" id="jenisBmn" name="jenisBmn" required="required" class="select9_single form-control col-md-7 col-xs-12" >
                           <option value="" kategori=""></option>
							<?php 
							foreach($jenis_barang as $row)
							{
									echo '<option kategori="'.$row->id_kategori.'" value="'.$row->id_jenis_bmn.
										'">'.$row->nm_kategori.': '.$row->merk.' '.$row->type.' </option>';
							}
									?>
                         <span class="required">*</span> </select>
                    </div>
			</div>
		</form>
	</div>
	</div>
	<div class="x_content">
		<form style="display:none" action="inputKendaraan" enctype="multipart/form-data" method="post" id="form_inputKendaraan" data-parsley-validate class="form-horizontal form-label-left">
			<input style="display:none" name="idJenisBmn" id="idJenisBmnKendaraan" value="">
			<input style="display:none" name="idKendaraan" id="idKendaraan" value="">
			<div class="form-group">
				<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">No Polisi<span class="required">*</span></label>
				<div class="col-md-6 col-sm-6 col-xs-12">
					<input type="text" id="no_pol" name="no_pol" value="" required="required" class="form-control col-md-7 col-xs-12">
				</div>
			</div>
			<div class="form-group">
					<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Pengguna Kendaraan/ </br>Penanggung Jawab <span class="required">*</span></label>
					<div   class="col-md-6 col-sm-6 col-xs-12">
                          <select style="width:100%"id="pegawai" name="pegawai" required="required" class="select3_single form-control col-md-7 col-xs-12" >
                           <option value="" ></option>
							<?php 
							foreach($pegawai as $row)
							{
									echo '<option  value="'.$row->niplama.
										'">'.$row->nama.' </option>';
							}
									?>
                         <span class="required">*</span> </select>
                    </div>
			</div>
			<div class="form-group">
				<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">No Rangka</label>
				<div class="col-md-6 col-sm-6 col-xs-12">
					<input type="text" id="no_rangka" name="no_rangka" value="<?php  //echo $value['nm_barang']?>" class="form-control col-md-7 col-xs-12">
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">No Mesin</label>
				<div class="col-md-6 col-sm-6 col-xs-12">
					<input type="text" id="no_mesin" name="no_mesin" value="" class="form-control col-md-7 col-xs-12">
				</div>
			</div>
			<div class="form-group">
					<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Tahun Pembuatan<span class="required">*</span></label>
					<div  class="col-md-6 col-sm-6 col-xs-12">
                          <select style="width:100%" name="tahun_kendaraan" id="tahun_kendaraan" class="select5_single form-control col-md-7 col-xs-12" >
                            <option></option>
							<?php 
							for($i=date("Y"); $i>1990; $i--)
								{
										echo '<option value='.$i.
											'>'.$i.'</option>';
								}
									?>
                          </select>
                        </div>
			</div>
			
			<div class="form-group">
				<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Tanggal STNK</label>
				<div class="col-md-6 col-sm-6 col-xs-12">
					<input type="text" id="birthday" name="tgl_stnk" value=""   class="date-picker form-control col-md-7 col-xs-12">
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Foto Barang</label>
				<div class="col-md-6 col-sm-6 col-xs-12">
					<input type="file" accept=".png,.jpeg,.jpg" value="" id="fotoKendaraan" name="fotoKendaraan"  class="form-control col-md-7 col-xs-12">
					<p style="color:red" id="errorFoto"></p>
					<a href="" style="color:blue" id="linkKendaraan"></a>
					<input type="text" style="display:none" value="" name="namaFileKendaraan" id="namaFileKendaraan">
				</div>
			</div>
			 <div class="form-group" >
					<div align="center" >
					  <button type="reset"  mode="input" id="resetKendaraan" class="btn btn-primary">Reset</button>
					  <button type="submit" mode="input"id="simpan" class="btn btn-success">Simpan</button>
					</div>
				</div>
		</form>
		
		<form style="display:none" action="inputNonKendaraan" enctype="multipart/form-data" method="post" id="form_inputNonKendaraan" data-parsley-validate class="form-horizontal form-label-left">
			<input style="display:none" name="idJenisBmn" id="idJenisBmnNonKendaraan" value="">
			<input style="display:none" name="idNonKendaraan" id="idNonKendaraan" value="">
			<div class="form-group">
				<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Identitas Barang<span class="required">*</span>
						</br> <p> <i>Identitas Bisa Nama, Ruangan Tempat Barang, atau nomor yang membedakan barang dengan jenis yang sama
							contoh : Kantor BPS Provinsi SUlawesi Tenggara, Printer Ruang IPDS, dll</i></p>
						</br></label>
				<div class="col-md-6 col-sm-6 col-xs-12">
					<input type="text" id="identitas" name="identitas" value="<?php  //echo $value['nm_barang']?>" required="required" class="form-control col-md-7 col-xs-12">
				</div>
			</div>
			<div class="form-group">
					<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Pengguna/ </br>Penanggung Jawab </label>
					<div   class="col-md-6 col-sm-6 col-xs-12">
                          <select style="width:100%" id="pegawaiNonKendaraan" name="pegawai" class="select3_single form-control col-md-7 col-xs-12" >
                           <option value="" ></option>
							<?php 
							foreach($pegawai as $row)
							{
									echo '<option  value="'.$row->niplama.
										'">'.$row->nama.' </option>';
							}
									?>
                         <span class="required">*</span> </select>
                    </div>
			</div>
			<div class="form-group">
					<label class="control-label col-md-3 col-sm-3 col-xs-12" >Tahun Perolehan</label>
					<div class="col-md-6 col-sm-6 col-xs-12">
                          <select style="width:100%" name="tahun" id="tahun_perolehan" class="select5_single form-control col-md-7 col-xs-12" >
                            <option></option>
							<?php 
							for($i=date("Y"); $i>1990; $i--)
								{
										echo '<option value='.$i.
											'>'.$i.'</option>';
								}
									?>
                          </select>
                        </div>
				</div>
			<div class="form-group">
				<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Foto Barang</label>
				<div class="col-md-6 col-sm-6 col-xs-12">
					<input type="file" accept=".png,.jpeg,.jpg" value="" id="fotoNonKendaraan" name="fotoNonKendaraan"  class="form-control col-md-7 col-xs-12">
					<p style="color:red" id="errorFotoNonKendaraan"></p>
					<a href="" style="color:blue" id="linkNonKendaraan"></a>
					<input type="text" style="display:none" value="" name="namaFileNonKendaraan" id="namaFileNonKendaraan">
				</div>
			</div>
			 <div class="form-group" >
					<div align="center" >
					  <button type="reset"  mode="input" id="resetNonKendaraan" class="btn btn-primary">Reset</button>
					  <button type="submit" mode="input"id="simpan" class="btn btn-success">Simpan</button>
					</div>
				</div>
		</form>
	</div>
</div>
	<div class="x_panel">
	<h2> <small>Daftar Kendaraan</small></h2>
	<div class="x_title"></div>
		 <div class="clearfix"></div>
		<div class="x_content">
		
		<table id="tabelStok2" class="table table-striped table-bordered" cellspacing="0" width="100%">
			<thead>
				<th>Jenis Kendaraan</th>
				<th>No Polisi</th>
				<th>Pengguna/ Penanggung Jawab</th>
				<th>Aksi</th>
			</thead>
			<tbody>
				<?php 
				//print_r($barangKendaraan);
				foreach($barangKendaraan as $row){
					$pieces = explode("-", $row->tgl_stnk);
					$date="";
					if(sizeof($pieces)==3){
						$date=$pieces[2]."/".$pieces[0]."/".$pieces[1];
					}
					
					echo '<tr><td>'.$row->merk.'  '.$row->type.'</td>
								<td>'.$row->no_pol.'</td>
								<td>'.$row->nama.'</td>
								<td>
									<div class="btn-group">
										<button type="button" class="btn btn-info btn-xs">Action</button>
											<button type="button"  class="btn btn-danger btn-xs dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
												<span class="caret"></span>
												<span class="sr-only">Toggle Dropdown</span>
											</button>
										<ul class="dropdown-menu" role="menu">
										
											<li><a idJenisBmnKendaraan="'.$row->id_jenis_bmn.'" no_pol="'.$row->no_pol.'" 
													pegawai="'.$row->niplama.'" no_rangka="'.$row->no_rangka.'" 
													no_mesin="'.$row->no_mesin.'" 
													tahun_kendaraan="'.$row->tahun_kendaraan.'" birthday="'.$date.'" 
													fotoKendaraan="'.$row->link_foto_k.'" idKendaraan="'.$row->id_kendaraan.'" id="editKendaraan">Edit</a></li>
											<li><a no_pol="'.$row->no_pol.'" href="'.base_url().'hapusKendaraan/'.$row->id_kendaraan.'" id="hapusKendaraan" id_jenis="">Hapus</a></li>
											</li>
										</ul>
									</div>
								</td>
							</tr>';
				}?>
			</tbody>
		</table>
		</div>
	</div>
	
	
		<div class="x_panel">
		<h2> <small>Daftar Barang BMN Non Kendaraan</small></h2>
		<div class="x_title"></div>
	<div class="clearfix"></div>
		<div class="x_content">
		<table id="tabelStok2" class="table table-striped table-bordered" cellspacing="0" width="100%">
			<thead>
				<th>Jenis BMN</th>
				<th>Identitas BMN</th>
				<th>Pengguna/ Penanggung Jawab</th>
				<th>Aksi</th>
			</thead>
			<tbody>
				<?php foreach($barangNonKendaraan as $row){
					echo '<tr><td>'.$row->merk.'  '.$row->type.'</td>
								<td>'.$row->identitas_barang.'</td>
								<td>'.$row->nama.'</td>
								<td>
									<div class="btn-group">
										<button type="button" class="btn btn-info btn-xs">Action</button>
											<button type="button"  class="btn btn-danger btn-xs dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
												<span class="caret"></span>
												<span class="sr-only">Toggle Dropdown</span>
											</button>
										<ul class="dropdown-menu" role="menu">
											<li><a id_jenis_bmn="'.$row->id_jenis_bmn.'" identitas="'.$row->identitas_barang.'" 
													pegawai="'.$row->niplama.'" id_non_kendaraan="'.$row->id_non_kendaraan.'" tahun="'.$row->tahun.'" 
													foto="'.$row->link_foto_k.'" id="editNonKendaraan">Edit</a></li>
											<li><a id="hapusNonKendaraan" identitas="'.$row->identitas_barang.'" href="'.base_url().'hapusNonKendaraan/'.$row->id_non_kendaraan.'">Hapus</a></li>
											</li>
										</ul>
									</div>
								</td>
							</tr>';
				}?>
			</tbody>
		</table>
	</div>
	</div>
</div>
</div>
<div id="dialog-confirm2" style="display:none">
	<p id="dialog-text"></p>
</div>
<script>
	$(document).ready(function() {
		$("#jenisBmn").change(function(){
			var kategori=$(this).find('option:selected').attr("kategori");
				//alert(kategori);
			if(kategori=='1' || kategori=='2' ){
				$("#form_inputNonKendaraan").hide();		
				$("#form_inputKendaraan").show();		
				$("#idJenisBmnKendaraan").attr('value', $(this).find('option:selected').attr("value"));		
			}else if(kategori==''){
				$("#form_inputNonKendaraan").hide();		
				$("#form_inputKendaraan").hide();		
			}else{
				$("#form_inputNonKendaraan").show()	;	
				$("#form_inputKendaraan").hide();	
				$("#idJenisBmnNonKendaraan").val($(this).val());	
			}
		})
		
		$('[id=editKendaraan]').click(function(){
			$("#form_inputNonKendaraan").hide();
			$("#form_inputKendaraan").show();
			$("#form_inputKendaraan").attr('action', 'editKendaraan');
			$("#resetKendaraan").attr('mode', 'edit');
			$("#resetKendaraan").text('Batal');
			
			$("#jenisBmn").val($(this).attr('idJenisBmnKendaraan')).change();
			$("#idKendaraan").val($(this).attr('idKendaraan'));
			$("#idJenisBmnKendaraan").val($(this).attr('idJenisBmnKendaraan'));
			$("#no_pol").val($(this).attr('no_pol'));
			$("#pegawai").val($(this).attr('pegawai')).change();
			$("#no_rangka").val($(this).attr('no_rangka'));
			$("#no_mesin").val($(this).attr('no_mesin'));
			$("#tahun_kendaraan").val($(this).attr('tahun_kendaraan')).change();
			$("#birthday").attr('value',$(this).attr('birthday'));
			$("#textJudul").text('Edit '+$("#jenisBmn").find('option:selected').text()+" "+$(this).attr('no_pol'));
			//alert($(this).attr('birthday'));
			
			var base_url='<?php echo base_url();?>';
			if($(this).attr('fotoKendaraan')==''){
				$("#linkKendaraan").hide();
			}else{
				$("#linkKendaraan").show();
			}
			$("#linkKendaraan").attr("href",base_url+'assets/images/bmn/'+($(this).attr('fotoKendaraan')));
			$("#linkKendaraan").text('Foto '+$("#jenisBmn").find('option:selected').text()+" "+$(this).attr('no_pol'));
			
			$("#namaFileKendaraan").attr('value',$(this).attr('fotoKendaraan'))
		})
		
		$('[id=editNonKendaraan]').click(function(){
			$("#form_inputNonKendaraan").show();
			$("#form_inputKendaraan").hide();
			$("#form_inputNonKendaraan").attr('action', 'editNonKendaraan');
			$("#resetNonKendaraan").attr('mode', 'edit');
			$("#resetNonKendaraan").text('Batal');
			
			$("#jenisBmn").val($(this).attr('id_jenis_bmn')).change();
			$("#idJenisBmnNonKendaraan").val($(this).attr('id_jenis_bmn'));
			$("#idNonKendaraan").val($(this).attr('id_non_kendaraan'));
			$("#identitas").val($(this).attr('identitas')).change();
			$("#pegawaiNonKendaraan").val($(this).attr('pegawai')).change();
			$("#tahun_perolehan").val($(this).attr('tahun')).change();
			$("#textJudul").text('Edit '+$("#jenisBmn").find('option:selected').text()+" "+$(this).attr('identitas'));
			
			var base_url='<?php echo base_url();?>';
			if($(this).attr('foto')==''){
				$("#linkNonKendaraan").hide();
			}else{
				$("#linkNonKendaraan").show();
			}
			$("#linkNonKendaraan").attr("href",base_url+'assets/images/bmn/'+($(this).attr('foto')));
			$("#linkNonKendaraan").text('Foto '+$("#jenisBmn").find('option:selected').text()+" "+$(this).attr('identitas'));
			
			$("#namaFileNonKendaraan").attr('value',$(this).attr('foto'));
		})
		
		$("#resetNonKendaraan").click(function(e){
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
								$("#jenisBmn").val('').change();
								$("#identitas").val('');
								$("#idJenisBmnNonKendaraan").val('');
								$("#pegawaiNonKendaraan").val('').change();
								$("#tahunPerolehan").val('').change();
								$("#textJudul").text('Input BMN')
								$('#resetNonKendaraan').attr('mode', 'input');
								$('#resetNonKendaraan').text('Reset');
								$("#form_inputNonKendaraan").attr('action', 'inputNonKendaraan');
								$("#linkNonKendaraan").attr("href","");
								$("#linkNonKendaraan").text("");
			
								$("#namaFileNonKendaraan").attr('value',"");
								//$("#fotoKendaraan").val('');
							},
							"Tidak": function() {
							  $( this ).dialog( "close" );
							}
						  }
					});
				}else{
					$("#identitas").val('');
					$("#idJenisBmnNonKendaraan").val('');
					$("#pegawaiNonKendaraan").val('').change();
					$("#tahunPerolehan").val('').change();
					$("#textJudul").text('Input BMN')
					$("#namaFileNonKendaraan").attr("href","");
					$("#namaFileNonKendaraan").text("");
					$("#linkNonKendaraan").attr("href","");
					$("#linkNonKendaraan").text("");
					$("#namaFileNonKendaraan").attr('value',"");
					$(this).attr('mode', 'input');
					$(this).text( 'Reset');
				}
		});
		
		$("#resetKendaraan").click(function(e){
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
								$("#jenisBmn").val("").change();
								$("#idJenisBmnKendaraan").val("");
								$("#no_pol").val('');
								$("#pegawai").val('').change();
								$("#no_rangka").val('');
								$("#no_mesin").val('');
								$("#tahun_kendaraan").val('').change();
								$("#birthday").val('');
								$("#textJudul").text("Input BMN");
								$('#resetKendaraan').attr('mode', 'input');
								$('#resetKendaraan').text('Reset');
								$("#form_inputKendaraan").attr('action', 'inputKendaraan');
								//$("#fotoKendaraan").val('');
								
								$("#linkKendaraan").attr("href","");
								$("#linkKendaraan").text('');
								$("#namaFileKendaraan").attr('value','')
							},
							"Tidak": function() {
							  $( this ).dialog( "close" );
							}
						  }
					});
				}else{
					$("#idJenisBmnKendaraan").val("");
					$("#no_pol").val('');
					$("#pegawai").val('').change();
					$("#no_rangka").val('');
					$("#no_mesin").val('');
					$("#namaFileKendaraan").attr("href","");
					$("#namaFileKendaraan").text("");
					$("#tahun_kendaraan").val('').change();
					$("#birthday").val('');
					$("#textJudul").text("Input BMN");
					$("#fotoKendaraan").text('');
					
				}
		});
		
		$("#fotoKendaraan").bind('change', function(){
				var ext=["jpg","png","jpeg"]
				if(this.files[0].size/1024/1024>2){
		
					$("#fotoKendaraan").val("");
					$("#errorFoto").text('File foto terlalu > 2 MB , upload ulang foto');
					
				}else if($.inArray($("#fotoKendaraan").val().split('.').pop().toLowerCase(),ext)==-1){
					$("#fotoKendaraan").val("");
					$("#errorFoto").text('File  Foto harus .jpg, .jpeg, atau .png , upload ulang BAST');
				
				}
				else{
					$("#errorFoto").text('');
				}					
			});
			
		$("#fotoNonKendaraan").bind('change', function(){
				var ext=["jpg","png","jpeg"];
				if(this.files[0].size/1024/1024>2){
					$("#fotoNonKendaraan").val("");
					$("#errorFotoNonKendaraan").text('File foto terlalu > 2 MB , upload ulang foto');
					
				}else if($.inArray($("#fotoNonKendaraan").val().split('.').pop().toLowerCase(),ext)==-1){
					$("#fotoNonKendaraan").val("");
					$("#errorFotoNonKendaraan").text('File  Foto harus .jpg, .jpeg, atau .png , upload ulang BAST');
				}
				else{
					$("#errorFotoNonKendaraan").text("");
				}					
		});
		
		$('[id=hapusKendaraan]').click(function(e){
			e.preventDefault();
			var a=this
			$("#dialog-text").text('Apakah anda Yakin Menghapus Kendaraan '+ $(this).attr('no_pol') +' ?');
			$( "#dialog-confirm2" ).dialog({
				  resizable: false,
				  height: "auto",
				  width: 400,
				  modal: true,
				  buttons: {
					"Ya": function() {
					  $(this ).dialog( "close" );
					  window.location = a.href;
					},
					"Batal": function() {
					  $( this ).dialog( "close" );
					}
				}
			});
		})
		
		$('[id=hapusNonKendaraan]').click(function(e){
			e.preventDefault();
			var a=this
			$("#dialog-text").text('Apakah anda Yakin Menghapus '+ $(this).attr('identitas') +' ?');
			$( "#dialog-confirm2" ).dialog({
				  resizable: false,
				  height: "auto",
				  width: 400,
				  modal: true,
				  buttons: {
					"Ya": function() {
					  $(this ).dialog( "close" );
					  window.location = a.href;
					},
					"Batal": function() {
					  $( this ).dialog( "close" );
					}
				}
			});
		})
		
	})
</script>