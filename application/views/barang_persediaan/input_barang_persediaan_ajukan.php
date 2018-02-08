<div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">
<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
	<div class="x_panel">
	<div class="x_title">
		<h2>Input Barang Persediaan</h2>
		<ul class="nav navbar-right panel_toolbox">
		 <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a> </li>
		</ul>
		 
		<div class="clearfix"></div>
	  </div>
	  <div class="x_content">
	  <div width="100%">
	  <form id="inputPersediaanForm" kategori="input" action="inputPersediaan<?php //echo base_url().$action;?>" enctype="multipart/form-data" method="post" id="demo-form" data-parsley-validate class="form-horizontal form-label-left">
		<table width="100%">
			<tr  >
			<td>Tanggal</td>
			<td style="padding-bottom:1%"> <input   id="birthday" name="tgl_masuk" class="date-picker form-control col-md-7 col-xs-12" required="required" type="text"></td>
			</tr>
			<tr width="100%">
				<td width="15%" > Penyedia/ Toko</td>
				<td width="45%" > <input id="penyedia" name="penyedia" class="form-control col-md-7 col-xs-12"> </br><p style="color:red" id="valPenyedia"></p></td>
				<td width="40%" align="right"> <button type="button" id="tambah_baris" class="btn btn-success">Tambah Baris</button> 
				<button type="button" style="display:none" class="btn btn-success">Jenis Barang Baru</button></td>
			</tr>
		</table>
	  
	  
		<table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
				<th width="65%" align="center" >Nama Barang</th>
				<th width="15%" align="center">Satuan</th>
				<th width="20%">Jumlah</th>
			<tbody>
				<?php for($i=0;$i<5;$i++){?>
				<tr>
					<td>
						 <select name="barang_persediaan[]"  style="width:100%;"  class="select8<?php echo $i ?>_single form-control col-md-7 col-xs-24">
							<option satuan<?php echo $i ?>=" " row="<?php echo $i; ?>" jumlah="" value=""></option>
							<?php  ?>
						</select>
					</td>
					<td id="satuan<?php echo $i ?>"></td>
						<td><input type="number" id="jumlah<?php echo $i ?>" name="jumlah[]" class="form-control col-n col-xs-12"> </br> <p id="valJumlah<?php echo $i ?>" style="color:red"></p></td>
				</tr>
				<?php };?>
			</tbody>
		</table>
		<div><p id="valNoEmpty" style="color:red"> </p></div>
		<div width="100%" align="right"  >
		  <button type="submit" class="btn btn-success">Simpan</button>
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
		var barang_persediaan=<?php echo json_encode($barang_persediaan); ?>;
		//alert(barang_persediaan);
		for (i=0; i<5; i++){
			$(".select8"+i+"_single").select2({
				placeholder: "",
				allowClear: true
			});
			var option="";
			for(var j=0; j<barang_persediaan.length; j++)
			{
				var stok="";
				if(barang_persediaan[j]['stok']==0){
					stok="Habis";
				}else{
					stok= barang_persediaan[j]['stok'];
				}
					
				
				option=option+'<option value="'+barang_persediaan[j]['kd_brg']+
					'" jumlah="1" satuan'+i+'="'+barang_persediaan[j]['satuan']+'" row="'+i+'" stok="'+barang_persediaan[j]['stok']+'"> '+barang_persediaan[j]['ur_brg']+' ['+barang_persediaan[j]['satuan']+']  <p style="color:red"><b>('+stok+' ) '+'['+barang_persediaan[j]['kd_brg']+']</b></p></option>';
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
		};
		
		$("#tambah_baris").click(function(){
		  var rowCount = $('#datatable-responsive tr').length-1;
		  var option2="";
		  for(var j=0; j<barang_persediaan.length; j++)
			{
				var stok="";
				if(barang_persediaan[j]['stok']==0){
					stok="Habis";
				}else{
					stok= barang_persediaan[j]['stok'];
				}
				option2=option2+'<option value="'+barang_persediaan[j]['kd_brg']+
					'" jumlah="1" satuan'+i+'="'+barang_persediaan[j]['satuan']+'" row="'+i+'" stok="'+barang_persediaan[j]['stok']+'"> '+barang_persediaan[j]['ur_brg']+' ['+barang_persediaan[j]['satuan']+']  <p style="color:red"><b>('+stok+' ) '+'['+barang_persediaan[j]['kd_brg']+']</b></p></option>';
			}
			
		  $("#datatable-responsive tr:last").after('<tr><td><select name="barang_persediaan[]"  style="width:100%;"  class="select8'+(rowCount)+'_single form-control col-md-7 col-xs-24" >'+ 
				'<option jumlah="" satuan'+(rowCount)+'=" " value="" row="'+(rowCount)+'"></option>'+option2+
				'</td><td id="satuan'+(rowCount)+'"></td><td><input type="number" id="jumlah'+(rowCount)+'" name="jumlah[]" class="form-control col-n col-xs-12"></br><p id="valJumlah'+(rowCount)+'" style="color:red"></p></td></tr>'
			);
			
			//$(".select8"+i+"_single").append(option);
			$(".select8"+rowCount+"_single").select2({
				placeholder: "",
				allowClear: true
			});
			
			$(".select8"+rowCount+"_single").change(function (){
				//alert($(this).find('option:selected').attr("satuan"+$(this).find('option:selected').attr("row")));
				//$(this).text("dhjsadja");
				var row=$(this).find('option:selected').attr("row");
				$('#satuan'+row).text($(this).find('option:selected').attr("satuan"+$(this).find('option:selected').attr("row")))
				$("#jumlah"+row).val($(this).find('option:selected').attr("jumlah"));
			})
		});
	  })
	</script>