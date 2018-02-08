<div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">
<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
	<div class="x_panel">
	<div class="x_title">
		<h2> Edit Perawatan BMN <small></small></h2>
	<div class="clearfix"></div>
	</div>
	<div class="x_panel">
	<div class="x_content">
		<form  method="post" id="editPerawatanBmn" action="<?php echo base_url();?>editPerawatanBmn" style="padding-top:2%;" class="form-horizontal form-label-left">
			<table width="100%" style="padding-bottom=2%">
				<tr>
					<td width="15%"> BMN </td>
					<td width="40%" style="padding-botom:12%"><h5><b>
						<?php 
							echo ": ".$namaBmn; ?></b></h5>
						<input type="text" id="kategori" name="kategori" value="<?php echo $kategori; ?>" style="display:none">
						<input type="text" id="idGrupPerawatan" name="idGrupPerawatan" value="<?php echo $idGrupPerawatan; ?>" style="display:none">
						<input type="text" id="bmn" name="Bmn" value="<?php echo $bmn; ?>" style="display:none">
					</td>
					<td width="20%">Tanggal Mulai Pekerjaan</td>
					<td width="25%"><input name="tglMulai" value="<?php echo $tglMulai?>" type="text" id="birthday2" class="date-picker form-control col-md-7 col-xs-12"></td>
				</tr>
				<tr>
					<td><p id="penyedia">Nama Penyedia Jasa/ Bengkel</td>
					<td>
						<input name="penyedia" value="<?php echo $penyedia?>" required="required" id="penyediaField" style="margin-top:2%; width:80%" type="text" class="form-control col-md-7 col-xs-12">
						</br></br></br><p id="errPenyedia" style="color:red"></p>
					</td>
					<td >Tanggal Selesai Pekerjaan</td>
					<td >
						<input type="text" value="<?php echo $tglSelesai?>" name="tglSelesai" id="birthday" class="date-picker form-control col-md-7 col-xs-12">
					</td>
				
				</tr>
				<tr>
					<td id="nmrSpk" >Nomor SPK/ WO</td>
					<td id="nmrSpk" ><input name="nmrSpk" value="<?php echo $nmrSpk?>"type="text" style="width:80%; margin-top:2%" class="form-control col-md-7 col-xs-12"></td>
					<td id="km" style="<?php echo $displayKm; ?>">Jarak Tempuh Kendaraan (Km)</td>
					<td id="km" style="<?php echo $displayKm; ?>"><input  value="<?php echo $km?>" name="km" type="number" class="form-control col-md-7 col-xs-12"></td>
				
				</tr>
			</table>
			<div class="x_title"></div>
			<table style="width:100%">
				<tr><td style="width:50%"><button type="button" mode="input" id="tambahBaris" class="btn btn-success">Tambah Baris</button></td>
					<td style="width:50%; text-align:right"><p id="detailBmn"></p></td>
				</tr>
			<table>
			<table id="tabelPerawatan" width="100%"  class="table table-striped table-bordered dt-responsive nowrap" >
				<thead>
					<th>No</th>
					<th>Pekerjaan</th>
					<th> Alat/ Sparepart Yang Diganti</th>
					<th> Keterangan</th>
					<th> Biaya</th>
				</thead>
				<tbody>
				<?php	
					for($i=0; $i<sizeof($daftarEditPerawatan); $i++){
						echo '<tr>
								<td>'.($i+1).'</td>
								<td><input id="pekerjaan'.$i.'" value="'.$daftarEditPerawatan[$i]->pekerjaan.'" name="pekerjaan[]" type="text" class="form-control col-md-7 col-xs-12">
											<p style="color:red" id="err'.$i.'"></p></td>
								<td><input id="sparepart'.$i.'" value="'.$daftarEditPerawatan[$i]->sparepart.'" name="sparepart[]" type="text" class="form-control col-md-7 col-xs-12">
											<p style="color:red" id="err'.$i.'"></p></td>
								<td><input id="keterangan'.$i.'" value="'.$daftarEditPerawatan[$i]->keterangan.'" name="keterangan[]" type="text" class="form-control col-md-7 col-xs-12"></td>
								<td><input id="biaya'.$i.'" value="'.$daftarEditPerawatan[$i]->biaya.'" name="biaya[]" type="number" min=0 max=10000000  class="form-control col-md-7 col-xs-12"></td>
							</tr>';
					}
				?>
				</tbody>
			</table>
			<input name="byIdOrNot" value="id" style="display:none">
			<p id="errKosong" style="color:red"></p>
			 <div class="form-group" >
					<div align="right" >
					<button type="button" href="<?php echo base_url()?>inputPerawatan.html" id="batal" class="btn btn-success">Batal</button>		
						<button type="submit" mode="input" id="simpan" class="btn btn-success">Simpan</button>			
						
					</div>
			</div>

		</form>
	</div>
</div>
</div>
</div>
</div>
</div>

<div id="dialog-confirm2" style="display:none">
	<p id="dialog-text"></p>
</div>
<script>
 $(document).ready(function() {
	 $('#tambahBaris').click(function(){
		 var jumlahBaris=$('#tabelPerawatan tr').length-1;
		 //alert(jumlahBaris);
		$("#tabelPerawatan tr:last").after('<tr><td>'+(jumlahBaris+1)+'</td> <td><input id="pekerjaan'+jumlahBaris+'" name="pekerjaan[]" type="text" class="form-control col-md-7 col-xs-12">'+
											'<p style="color:red" id="err'+jumlahBaris+'"></p></td><td><input id="sparepart'+jumlahBaris+'" name="sparepart[]" type="text" class="form-control col-md-7 col-xs-12">'+
											'<p style="color:red" id="err'+jumlahBaris+'"></p></td><td><input id="keterangan'+jumlahBaris+'" name="keterangan[]" type="text" class="form-control col-md-7 col-xs-12"></td>'+
											'<td><input id="biaya'+jumlahBaris+'" name="biaya[]" type="number" min=0 max=10000000  class="form-control col-md-7 col-xs-12"></td></tr>');
	 });
	 
	 
	 $("#simpan").click(function(e){
		 e.preventDefault();
		$("#dialog-text").text('Apakah anda Yakin Menyimpan Perubahan Perawatan ini ?');
		$( "#dialog-confirm2" ).dialog({
			  resizable: false,
			  height: "auto",
			  width: 400,
			  modal: true,
			  buttons: {
				"Ya": function() {
					$(this ).dialog( "close" );
					var valid1=true;
					 var valid2=false;
					 var valid3=false;
					 
					 
					 if($("#penyediaField").val()==""){
						valid3=false;
						$("#errPenyedia").text("Penyedia harus terisi");
					 }else{
						valid3=true;
						$("#errPenyedia").text("");
					 }
					 
					 for(var i=0;i<$('#tabelPerawatan tr').length-1; i++){
						// alert($('#biaya'+i).val()!="" && ($('#sparepart'+i).val()=="" && $('#pekerjaan'+i).val()=="" ));
						if($('#biaya'+i).val()!="" && ($('#sparepart'+i).val()=="" && $('#pekerjaan'+i).val()=="" )){
							$('[id=err'+i+']').text("Salah Satu Harus  Terisi !");
							valid1=false;
							
						}else{
							$('[id=err'+i+']').text("");
						}
									
						if($('#biaya'+i).val()!=""){
							valid2=true;
						}
					 }
					
						if(valid2==false){
							$("#errKosong").text('Kolom jumlah tidak ada yang terisi ')
						}else if(valid2==true){
							$("#errKosong").text('')
						}
						
						if(valid1 && valid2 && valid3){
							$('#editPerawatanBmn').submit();
						}
				},
				"Batal": function() {
				  $( this ).dialog( "close" );
				}
			}
		})
		
	 });
	 
	  $("#batal").click(function(e){
			$("#dialog-text").text('Apakah anda Yakin Membatalkan Edit Perawatan ini ?');
			$( "#dialog-confirm2" ).dialog({
				  resizable: false,
				  height: "auto",
				  width: 400,
				  modal: true,
				  buttons: {
					"Ya": function() {
					  $(this ).dialog( "close" );
					  
					  window.location = $("#batal").attr('href');
					},
					"Batal": function() {
					  $( this ).dialog( "close" );
					}
				}
			})
	  });
	 
 });
</script>
