<div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">
<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
	<div class="x_panel">
	<div class="x_title">
		<h2> Input Perawatan BMN <small></small></h2>
	<div class="clearfix"></div>
	</div>
	<div class="x_panel">
	<div class="x_content">
		<form  method="post" id="inputPerawatanBmn" action="<?php echo base_url();?>inputPerawatanBmn" style="padding-top:2%;" class="form-horizontal form-label-left">
			<table width="100%" style="padding-bottom=2%">
				<tr>
					<td width="15%"> BMN </td>
					<td width="40%" style="padding-botom:12%"><h5><b>
						<?php 
							echo ": ".$namaBmn; ?></b></h5>
						<input type="text" id="kategori" name="kategori" value="<?php echo $kategori; ?>" style="display:none">
						<input type="text" id="bmn" name="Bmn" value="<?php echo $bmn; ?>" style="display:none">
					</td>
					<td width="20%">Tanggal Mulai Pekerjaan</td>
					<td width="25%"><input name="tglMulai" type="text" id="birthday2" class="date-picker form-control col-md-7 col-xs-12"></td>
				</tr>
				<tr>
					<td><p id="penyedia">Nama Penyedia Jasa/ Bengkel</td>
					<td>
						<input name="penyedia" value="" required="required" id="penyediaField" style="margin-top:2%; width:80%" type="text" class="form-control col-md-7 col-xs-12">
						</br></br></br><p id="errPenyedia" style="color:red"></p>
					</td>
					<td >Tanggal Selesai Pekerjaan</td>
					<td >
						<input type="text" name="tglSelesai" id="birthday" class="date-picker form-control col-md-7 col-xs-12">
					</td>
				
				</tr>
				<tr>
					<td id="nmrSpk" >Nomor SPK/ WO</td>
					<td id="nmrSpk" ><input name="nmrSpk" type="text" style="width:80%; margin-top:2%" class="form-control col-md-7 col-xs-12"></td>
					<td id="km" style="<?php echo $displayKm; ?>">Jarak Tempuh Kendaraan (Km)</td>
					<td id="km" style="<?php echo $displayKm; ?>"><input  name="km" type="number" class="form-control col-md-7 col-xs-12"></td>
				
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
					for($i=0; $i<3; $i++){
						echo '<tr>
								<td>'.($i+1).'</td>
								<td><input id="pekerjaan'.$i.'" name="pekerjaan[]" type="text" class="form-control col-md-7 col-xs-12">
											<p style="color:red" id="err'.$i.'"></p></td>
								<td><input id="sparepart'.$i.'" name="sparepart[]" type="text" class="form-control col-md-7 col-xs-12">
											<p style="color:red" id="err'.$i.'"></p></td>
								<td><input id="keterangan'.$i.'" name="keterangan[]" type="text" class="form-control col-md-7 col-xs-12"></td>
								<td><input id="biaya'.$i.'" name="biaya[]" type="number" min=0 max=10000000  class="form-control col-md-7 col-xs-12"></td>
							</tr>';
					}
				?>
				</tbody>
			</table>
			<input name="byIdOrNot" value="id" style="display:none">
			<p id="errKosong" style="color:red"></p>
			 <div class="form-group" >
					<div align="right" >
						<button type="submit" mode="input"id="simpan" class="btn btn-success">Simpan</button>		
					</div>
			</div>

		</form>
	</div>
</div>
</div>
</div>
</div>
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
	 
	 $("#Bmn").change(function(){
		 if($(this).find('option:selected').attr("kategori")==1 || $(this).find('option:selected').attr("kategori")==2){
			$("[id=km]").show();
			$("#judulPenyedia").text("Bengkel");
			$("#kategori").attr('value','1');
		 }else{
			$("[id=km]").hide();
			$("#judulPenyedia").text("Penyedia Jasa/Toko");
			$("#kategori").attr('value','2');
		 }
		 
		 //alert($(this).val());
		 if($(this).val()!=""){
			$("#detailBmn").text($(this).find('option:selected').attr("pengguna")+
						' | '+$(this).find('option:selected').attr('jnsBmn'));
		 }else{
			$("#detailBmn").text("");
		 }
	 });
	 
	 $("#simpan").click(function(e){
		 e.preventDefault();
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
				$('#inputPerawatanBmn').submit();
			}
	 });
	 
 });
</script>
