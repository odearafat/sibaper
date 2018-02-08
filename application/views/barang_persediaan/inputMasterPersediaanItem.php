<div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">
<div class="x_title">
		<h2>Input Manual Barang Persediaan</h2>
		<div class="clearfix"></div>
</div>

<div class="x_content">
		<form action="<?php echo base_url()?>aksiInputMasterPersediaan" enctype="multipart/form-data" method="post" id="form" data-parsley-validate class="form-horizontal form-label-left">
			<input style="display:none" name="idCad" id="idCad" value="">
			<div class="form-group">
				<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">ID Barang Persediaan<span class="required">*</span></label>
				<div class="col-md-6 col-sm-6 col-xs-12">
					<input type="number" id="id" name="id" value="" required="required" class="form-control col-md-7 col-xs-12"><p id="errid" style="color:red"></p>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Nama Barang Persediaan <span class="required">*</span></label>
				<div class="col-md-6 col-sm-6 col-xs-12">
					<input type="text" id="nm" name="nm" value="<?php  //echo $value['nm_barang']?>" required="required" class="form-control col-md-7 col-xs-12"><p id="errnm" style="color:red"></p>
				</div>
			</div>
			
			<div class="form-group">
					<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Satuan</label>
					<div class="col-md-6 col-sm-6 col-xs-12">
					<input type="text" id="satuan" name="satuan" value="<?php  //echo $value['nm_barang']?>" required="required" class="form-control col-md-7 col-xs-12"><p id="errsatuan" style="color:red"></p>
				</div>
			</div>
			 <div class="form-group" >
					<div align="center" >
					  <button type="reset"  mode="input" id="reset" class="btn btn-primary">Reset</button>
					  <button type="submit" mode="input"id="simpan" class="btn btn-success">Simpan</button>
					</div>
				</div>
		</form>
		</div>

<div class="x_title">
	<div class="clearfix"></div>
</div>
<?php
	echo '<table id="tabelStok2" class="table table-striped table-bordered" 
					cellspacing="0" width="100%"><thead>
			<th> ID Barang Persediaan</th>
			<th> Nama Barang</th>
			<th> Satuan</th>
			<th> Aksi</th>
			</thead><tbody>';
	foreach($barang_persediaan as $row){
		echo '<tr>
					<td width="15%">'.$row->kd_brg.'</td>
					<td width="60%">'.$row->ur_brg.' </td>
					<td width="15%">'.$row->satuan.' </td>
					<td width="10%"> 
						<div class="btn-group">
						<button type="button" class="btn btn-info btn-xs">Action</button>
							<button type="button"  class="btn btn-danger btn-xs dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
								<span class="caret"></span>
								<span class="sr-only">Toggle Dropdown</span>
							</button>
						<ul class="dropdown-menu" role="menu"><li>
							<a  kd_brg="'.$row->kd_brg.'" ur_brg="'.$row->ur_brg.'" 
									satuan="'.$row->satuan.'" id="barang_persediaan_edit">Edit</a>
						</li>
							<li>
							<a href="'.base_url().'hapusBarangPersediaan/'.$row->kd_brg.'" id="hapusPersediaan" ur_brg="'.$row->ur_brg.'">Hapus</a></li>
						</li>
						</ul>
					</div>	
					</td>
					</tr>';
	}
	echo '</tbody></table>';
	
?>
</div>
<div style="display:none" id="dialog-confirm">
		<p id="modal"></p>
	</div>
<script>
		$(document).ready(function() {
			var barang_persediaan=<?php echo json_encode($barang_persediaan) ?>;
			
			$("[id=barang_persediaan_edit]").click(function(){
				$("#id").val($(this).attr('kd_brg'));
				$("#nm").val($(this).attr('ur_brg'));
				$("#satuan").val($(this).attr('satuan'));
				$("#idCad").val($(this).attr('kd_brg'));
				$("#form").attr('action', '<?php echo base_url()?>editMasterPersediaan');
				$("#reset").attr('mode', 'edit');
		        $("#simpan").attr('mode', 'edit');
				$("#reset").text('Batal');
			});
			
			$("#simpan").click(function(e){
				e.preventDefault();
				var submit=true;
				if($("#id").val()==''){
					$("#errid").text('ID Tidak Boleh Kosong');
					submit=false;
				}else{
					$("#errid").text('');
				}
				
				if($("#nm").val()==''){
					$("#errnm").text('Nama Barang Tidak Boleh Kosong');
						submit=false;
				}else{
					$("#errnm").text('');
				}
				
				if($("#satuan").val()==''){
					$("#errsatuan").text('Satuan Tidak Boleh Kosong');
						submit=false;
				}else{
					$("#errsatuan").text('');
				}
				
				if($(this).attr('mode')!='edit'){
				    	for(var i=0; i<barang_persediaan.length; i++){
        					if(barang_persediaan[i].kd_brg==$("#id").val()){
        					$("#errid").text('ID Sudah dipakai Barang  "'+barang_persediaan[i].ur_brg+'"');
        						submit=false;
        					}
    				}
				}else{
				    
				    
				}
    			
				
				if(submit){
					$("#form").submit();
				}
				
				
			});
			
			$("#reset").click(function(e){
				e.preventDefault();
				if($(this).attr('mode')=='edit'){
					$("#modal").text("Apakah Anda Yakin Membatalkan Edit Data ini ?");
					$("#dialog-confirm" ).dialog({
						  resizable: false,
						  height: "auto",
						  width: 400,
						  modal: true,
						  buttons: {
							"Ya": function() {
							  $(this ).dialog( "close" );

								$("#id").val('');
								$("#nm").val('');
								$("#satuan").val('');
								$("#errid").text('');
								$("#form").attr('action', '<?php echo base_url()?>aksiInputMasterPersediaan');
								$("#reset").attr('mode', 'input');
							    $("#reset").attr('mode', 'simpan');
								$("#reset").text('Reset');
							},
							"Tidak": function() {
							  $( this ).dialog( "close" );
							  
							}
						  }
					});
				}else{
					$("#id").val('');
					$("#nm").val('');
					$("#satuan").val('');
					
				}
			});
			
			$("[id=hapusPersediaan]").click(function(e){
				e.preventDefault();
				var a=this;
				$("#modal").text("Apakah Anda Yakin Menghapus "+$(this).attr('ur_brg')+" ? ("+
							"Semua Transaksi yang Berhubungan Dengan Barang ini Akan Dihapus)");
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