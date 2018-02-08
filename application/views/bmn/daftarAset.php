<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
	<div class="x_panel">
	<div class="x_title">
		<h2>Rekap Aset BMN</h2>
		 
		<div class="clearfix"></div>
	  </div>
	  <div class="x_content">
	  <form id="karkenBmnForm" kategori="permintaan" action="aksiKarkenBmn" enctype="multipart/form-data" method="post" id="demo-form" data-parsley-validate class="form-horizontal form-label-left">
	  <table width="100%">
		  <tr width="100%" >
			<td width="15%">Pilih Jenis Rekap</td>
			<td style="padding-bottom:1%">
				<select name="bmn" id="jenis_rekap"; style="width:100%;"  class="selectBmn form-control col-md-7 col-xs-24">
					<option></option>
					<option value="1" <?php echo $select1?> href="<?php echo base_url()?>daftarAset/1/Rekap Berdasarkan Kategori">Rekap Berdasarkan Kategori BMN</option>
					<option value="2" <?php echo $select2?> href="<?php echo base_url()?>daftarAset/2/Rekap Berdasarkan Merk dan Type">Rekap Berdasarkan Merk & Type BMN</option>
					<option value="3"  <?php echo $select3?> href="<?php echo base_url()?>daftarAset/3/0000">Rekap Berdasarkan Pegawai & Kategori </option>
				</select></br>
			</td>
		  </tr>
		  <tr id="satker" <?php echo $displaySatker ?>>
			<td>Piih Satuan Kerja</td>
			<td style="padding-bottom:1%">
				<select name="selectSatker" id="selectSatker"; style="width:100%;"  class="selectBmn form-control col-md-7 col-xs-24">
					
					<?php 
						echo $satker;
					?>
				</select></br>
			</td>
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
			<div class="clearfix"></div>
		</div>
		<div class="x_content">
			<?php echo $table?>
		</div>
	</div>
	</div>
	</div>
		<script>
	  $(document).ready(function() {
		  $(".selectBmn").select2({
				placeholder: ""
				
			});
			
			$("#jenis_rekap").change(function (){
					var href=$(this).find('option:selected').attr('href');
					if($(this).find('option:selected').val()!=''){
						window.location.href=href;
					}
			});
			
			$("#selectSatker").change(function (){
					var href=$(this).find('option:selected').attr('href');
					if($(this).find('option:selected').val()!=''){
						window.location.href=href;
					}
			});
			
			/*$("#bttKarken").on('click', function(e){
				e.preventDefault();
				var show2=false;
				var tglAwal=$("#birthday").val();
				var splitTgl=tglAwal.split("/");
				var gabungAwal=splitTgl[2]+splitTgl[0]+splitTgl[1];
				
				var tglAkhir=$("#birthday2").val().split("/");
				var gabungAkhir=tglAkhir[2]+tglAkhir[0]+tglAkhir[1];
				
				var today= new Date();
				var todayGabung=today.getFullYear()+('0'+(today.getMonth()+1)).slice(-2)+('0'+(today.getDate())).slice(-2);
				
				if($("#bmn").find('option:selected').val()==""){
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
		 */
	
	  })
	</script>

	  