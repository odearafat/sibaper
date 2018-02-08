<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
	<div class="x_panel">
	<div class="x_title">
		<h2>Kartu Kendali BMN</h2>
		 
		<div class="clearfix"></div>
	  </div>
	  <div class="x_content">
	  <form id="karkenBmnForm" kategori="permintaan" action="aksiKarkenBmn" enctype="multipart/form-data" method="post" id="demo-form" data-parsley-validate class="form-horizontal form-label-left">
	  <table width="100%">
		  <tr width="100%" >
			<td width="15%">Pilih BMN</td>
			<td style="padding-bottom:1%" colspan="3">
				<select name="bmn[]" multiple id="bmn"; style="width:100%;"  class="selectBmn form-control col-md-7 col-xs-24">
					<option value=""></option>
					<?php 
						foreach($kendaraan as $row){
							echo '<option value="'.$row->id_kendaraan.
										'-1" kendaraan_or_no="1" nm_kategori="'.$row->nm_kategori.'" kategori="'.$row->id_kategori.'" 
										pengguna="'.$row->nama.'" linkFoto="'.$row->link_foto.'" 
										jnsBmn="'.$row->merk.' '.$row->type.'">
										'.$row->merk.' '.$row->type.' : '.$row->no_pol.' </option>';
						}
						
						foreach($non_kendaraan as $row){
								echo '<option value="'.$row->id_non_kendaraan.
										'-2" kendaraan_or_no="2" nm_kategori="'.$row->nm_kategori.'" kategori="'.$row->id_kategori.'" 
										pengguna="'.$row->nama.'" linkFoto="'.$row->link_foto.'" 
										 jnsBmn="'.$row->merk.' '.$row->type.'">
										'.$row->merk.' '.$row->type.' : '.$row->identitas_barang.' </option>';
						}
					?>
				</select></br>
				<p id="valBarangPersediaan" style="color:red; display:none"></p>
				<input type="text" id="kendaraan_or_no" name="kendaraan_or_no" value="" style="display:none">
			</td>
		  </tr>
		  <tr>
			<td>Periode</td>
			<td style="padding-bottom:1%"><input  id="birthday" name="tglAwal" class="date-picker form-control col-md-7 col-xs-12"  type="text" required> </td>
			<td style="padding-left:1% ">s/d</td>
			<td style="padding-bottom:1%"><input  id="birthday2" name="tglAkhir" class="date-picker form-control col-md-7 col-xs-12" type="text" required > </td>
		  </tr>
		  <tr id="valTanggalBar">
		  <td></td>
			<td><p id="valTanggalAwal" style="color:red; display:none"></p></td>
			<td></td>
			<td><p id="valTanggalAkhir" style="color:red; display:none"></p></td>
		  </tr>
		  <tr>
			 <td></td><td><button type="submit" id="bttKarkenBmn" class="btn btn-success">Buat Katu Kendali</button></td>
		  </tr>
	  </table>
	  </form>
	  </div>
	 </div>
	</div>
	</div>
		<div class="row">
		<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="x_panel">
			<div class="x_title">
			<h2>Output</h2>
				<ul class="nav navbar-right panel_toolbox">
				<form action="downloadExcelBmn" enctype="multipart/form-data" method="post" id="formDownload" data-parsley-validate class="form-horizontal form-label-left" >
					<input type="text" style="display:none" name="bmnCad" value='<?php echo $bmnCad; ?>'>
					<input type="text" style="display:none" name="tglAkhirCad" value="<?php echo $tglAkhirCad; ?>">
					<input type="text" style="display:none" name="tglAwalCad" value="<?php echo $tglAwalCad; ?>">
					<input type="text" style="display:none" name="kendaraanOrNoCad" value="<?php echo $kendaraanOrNoCad; ?>">
					<button type="submit" id="bttDownloadExcel" style="" class="btn btn-success">Download Kartu Kendali</button>
					<!--<button type="submit" id="bttDownloadPDF" class="btn btn-success">Download PDF</button>-->
				</form>
				<!--
					<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a> </li>
				-->
				</ul><div class="clearfix"></div>
			</div>
			<div class="x_content" style="text-align:center">
				<?php echo $karkenHtml?>
			</div>
		</div>
		</div>
		</div>
		<script>
	  $(document).ready(function() {
		  $(".selectBmn").select2({
				placeholder: "",
				allowClear: true
			});
			
			$(".selectBmn").change(function (){
				$("#kendaraan_or_no").val($(this).find('option:selected').attr("kendaraan_or_no"));
			});
	
			$("#bttKarkenBmn").on('click', function(e){
				e.preventDefault();
				var show2=false;
				var tglAwal=$("#birthday").val();
				var splitTgl=tglAwal.split("/");
				var gabungAwal=splitTgl[2]+splitTgl[0]+splitTgl[1];
				
				var tglAkhir=$("#birthday2").val().split("/");
				var gabungAkhir=tglAkhir[2]+tglAkhir[0]+tglAkhir[1];
				
				var today= new Date();
				var todayGabung=today.getFullYear()+('0'+(today.getMonth()+1)).slice(-2)+('0'+(today.getDate())).slice(-2);
				
				if($("#bmn").val()=="" || $("#bmn").val()==null){
					$("#valBarangPersediaan").text("Pilih BMN");
					$("#valBarangPersediaan").show();
					show2=false;
				}else{
					$("#valBarangPersediaan").text("");
					$("#valBarangPersediaan").hide();
					show2=true;
				}
				
				//alert(today.getFullYear()+"---"+(('0'+(today.getMonth()+1))).slice(-2)+"---"+('0'+(today.getDate())).slice(-2));
				//alert(gabungAwal +"---"+gabungAkhir+"---"+todayGabung);
				
				var show1=false;
				var show3=false;
				
				if(gabungAwal >gabungAkhir){
					$("#valTanggalAwal").text("Tanggal Awal Tidak Boleh Lebih dari Tanggal Akhir");
					$("#valTanggalAwal").show();
					show1=true;
				}else if(gabungAwal > todayGabung ){
					$("#valTanggalAwal").text("Tanggal Tidak Boleh Lebih dari hari ini");
					$("#valTanggalAwal").show();
					show1=true;
				}else{
					$("#valTanggalAwal").text("");
					$("#valTanggalAwal").hide;
					show1=false;
				}
				
				if(gabungAkhir>todayGabung){
					$("#valTanggalAkhir").text("Tanggal Tidak Boleh Lebih dari hari ini");
					$("#valTanggalAkhir").show();
					show3=true;
				}else{
					$("#valTanggalAkhir").text("");
					$("#valTanggalAkhir").hide();
					show3=false;
				}
				
				if(show1 || show3){
					$("#valTanggalBar").show();
				}else{
					$("#valTanggalBar").hide();
				}
				
				//alert("!show1= "+!show1+" !show2= "+!show2+" show3= "+show3 )
				if(!show1 && show2 && !show3){
					$("#karkenBmnForm").submit();
					$("#bttDownloadExcel").show();
				}else{
					$("#bttDownloadExcel").hide();
				}
				
			});	 
	
		$("#bttDownloadExcel").on('click', function(e){
			e.preventDefault();
			$("#typeTombol").val("excel");
			$("#formDownload").submit();
			
		});
		$("#bttDownloadPDF").on('click', function(e){
			e.preventDefault();
			$("#typeTombol").val("pdf");
			$("#formDownload").submit();
		});
		 
	
	  })
	</script>

	  