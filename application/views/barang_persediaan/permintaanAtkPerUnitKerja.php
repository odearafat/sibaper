<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
	<div class="x_panel">
	<div class="x_title">
		<h2>Kartu Kendali ATK</h2>
		 
		<div class="clearfix"></div>
	  </div>
	  <div class="x_content">
	  <form id="karkenATKForm" kategori="permintaan" action="<?php echo base_url() ?>aksiPemintaanAtkUnitKerja" enctype="multipart/form-data" method="post" id="demo-form" data-parsley-validate class="form-horizontal form-label-left">
	  <table width="100%">
		  <tr width="100%" >
			<td width="15%">Pilih Unit Kerja</td>
			<td style="padding-bottom:1%">
				<select name="unitKerja" id="barang_persediaan"; style="width:100%;"  class="select8_single form-control col-md-7 col-xs-24">
					<option value=""></option>
					<?php 
						$optionUnitKerja="";
						foreach($unit_kerja as $row){
							$optionUnitKerja=$optionUnitKerja.
								'<option value="'.$row['id_unit_kerja'].'">'.$row['nm_unit_kerja'].'</option>';
						}
						echo $optionUnitKerja;
					?>
							<?php ?>
				</select></br>
				<p id="valBarangPersediaan" style="color:red; display:none"></p>
			</td>
		  </tr>
		  <tr>
			<td>Periode</td>
			<td style="padding-bottom:1%"><input  id="birthday" name="tglAwal" class="date-picker form-control col-md-7 col-xs-12" required="required" type="text"> </td>
			<td style="padding-left:1% ">s/d</td>
			<td style="padding-bottom:1%"><input  id="birthday2" name="tglAkhir" class="date-picker form-control col-md-7 col-xs-12" required="required" type="text"> </td>
		  </tr>
		  <tr id="valTanggalBar">
		  <td></td>
			<td><p id="valTanggalAwal" style="color:red; display:none"></p></td>
			<td></td>
			<td><p id="valTanggalAkhir" style="color:red; display:none"></p></td>
		  </tr>
		  <tr>
		  <td> Janis Laporan</td>
			<td>
				<input type="radio" class="flat" name="jnsLaporan"  value="detail" checked="" required /> Detail Per Pengambilan
				<input type="radio" class="flat" name="jnsLaporan"  value="rekap" /> Rekap Per Barang
			 </td>
			</tr>
		  <tr>
			 <td></td><td><button type="submit" id="bttKarken" class="btn btn-success">Buat Laporan</button></td>
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
				<form action="<?php echo base_url()?>downloadExcelPerUnitKerja" enctype="multipart/form-data" method="post" id="formDownload" data-parsley-validate class="form-horizontal form-label-left" >
					
					<input type="text" style="display:none" name="jnsLaporanCad" value="<?php echo $jnsLaporanCad; ?>">
					<input type="text" style="display:none" name="unitKerjaCad" value="<?php echo $unitKerjaCad; ?>">
					<input type="text" style="display:none" name="tglMasukCad" value="<?php echo $tglMasukCad; ?>">
					<input type="text" style="display:none" name="tglKeluarCad" value="<?php echo $tglKeluarCad; ?>">
					<input type="text" style="display:none" id="typeTombol" name="typeTombol" value="">
					<button type="submit" id="bttDownloadExcel" style="" class="btn btn-success">Download Excel</button>
					<!--<button type="submit" id="bttDownloadPDF" class="btn btn-success">Download PDF</button>-->
				</form>
				<!--
					<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a> </li>
				-->
				</ul><div class="clearfix"></div>
			</div>
			<div class="x_content">
				<?php echo $karkenHtml?>
			</div>
		</div>
		</div>
		</div>
		<script>
	  $(document).ready(function() {
		  $(".select8_single").select2({
				placeholder: "",
				allowClear: true
			});
	
		/*var unit_kerja=<?php echo json_encode($unit_kerja); ?>;
		for (i=0; i<5; i++){
			$(".select8"+i+"_single").select2({
				placeholder: "",
				allowClear: true
			});
			var option="";
			for(var j=0; j<unit_kerja.length; j++)
			{
				var stok="";
				/*if(barang_persediaan[j]['stok']==0){
					stok="Habis";
				}else{
					stok= barang_persediaan[j]['stok'];
				}
					
				
				option=option+'<option value="'+barang_persediaan[j]['kd_brg']+
					'" jumlah="1" satuan'+i+'="'+barang_persediaan[j]['satuan']+'" row="'+i+'" stok="'+barang_persediaan[j]['stok']+'">'+
					barang_persediaan[j]['ur_brg']+'  <p style="color:red"><b>('+stok+' )</b></p></option>';
			}
			$(".select8"+i+"_single").append(option);
			
			//klik pilih barang
			$(".select8"+i+"_single").change(function (){
				var kategori=$("#inputPersediaanForm").attr("kategori");
				if(kategori=="permintaan" && $(this).find('option:selected').attr("stok")=='0'){
					alert("Barang yang Diminta Tidak Tersedia di Gudang ");
					$(this).val("").change();
				}else{
					//alert($(this).find('option:selected').attr("satuan"+$(this).find('option:selected').attr("row")));
					var row=$(this).find('option:selected').attr("row");
					$('#satuan'+row).text($(this).find('option:selected').attr("satuan"+row))
					$("#jumlah"+row).val($(this).find('option:selected').attr("jumlah"));
				}
				
			})
		};*/
	  })
	</script>

	  