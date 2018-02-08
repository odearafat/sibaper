<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
	<div class="x_panel">
	<div class="x_title">
		<h2> Master Jenis BMN <small>Baru</small></h2>
	<div class="clearfix"></div>
	</div>
	<div class="x_content">
		<form action="aksiInputJenisBmn" enctype="multipart/form-data" method="post" id="form" data-parsley-validate class="form-horizontal form-label-left">
			<input style="display:none" name="idJenisBmn" id="idJenisBmn" value="">
			<div class="form-group">
				<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Merk<span class="required">*</span></label>
				<div class="col-md-6 col-sm-6 col-xs-12">
					<input type="text" id="merk" name="merk" value="<?php  //echo $value['nm_barang']?> " required="required" class="form-control col-md-7 col-xs-12">
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Type<span class="required">*</span></label>
				<div class="col-md-6 col-sm-6 col-xs-12">
					<input type="text" id="type" name="type" value="<?php  //echo $value['nm_barang']?>" required="required" class="form-control col-md-7 col-xs-12">
				</div>
			</div>
			
			<div class="form-group">
					<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Kategori</label>
					<div class="col-md-6 col-sm-6 col-xs-12">
                          <select id="kategori" name="kategori" required="required" class="select4_single form-control col-md-7 col-xs-12" >
                           <option value="" ></option>
							<?php 
							foreach($kategori as $row)
							{
								//if($value['id_jenis_barang']==$row['id_jenis_barang']){
								//	echo '<option selected="selected" value='.$row['id_jenis_barang'].
								//		'>'.$row['nama_jenis_barang'].'</option>';
								//}else{
									//echo $row'id_kategori';
									echo '<option value="'.$row->id_kategori.
										'">'.$row->nm_kategori.'</option>';
								//}
							}
									?>
                         <span class="required">*</span> </select>
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
		<div class="x_panel">
		<div class="x_content">
		<div class="clearfix"></div>
		<table  id="tabelStok2" class="table table-striped table-bordered" cellspacing="0" width="100%">
			<thead>
				<th>Kategori</th>
				<th>Merk</th>
				<th>Type</th>
				<th>Aksi</th>
			</thead>
			<tbody>
				<?php 
				foreach($jenis_barang as $row){
					$a="";
					if($this->session->userdata('id_sibaper')==4){
						$a='<li><a href="'.base_url().'hapusJenisBmn/'.$row->id_jenis_bmn.'" id="hapusJenis" id_jenis="'.$row->id_jenis_bmn.'">Hapus</a></li>
										</li>';
					}
					echo '<tr>
							<td>'.$row->nm_kategori.'</td>
							<td>'.$row->merk.'</td>
							<td>'.$row->type.'</td>
							<td> 
								<div class="btn-group">
									<button type="button" class="btn btn-info btn-xs">Action</button>
										<button type="button"  class="btn btn-danger btn-xs dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
											<span class="caret"></span>
											<span class="sr-only">Toggle Dropdown</span>
										</button>
									<ul class="dropdown-menu" role="menu">
										<li><a id_kategori="'.$row->id_kategori.'" merk="'.$row->merk.'" 
												type="'.$row->type.'" id_jenis="'.$row->id_jenis_bmn.'" id="editJenis">Edit</a></li>'.$a.'
										
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
			$("[id=editJenis]").click(function(){
				$("#merk").val($(this).attr('merk'));
				$("#type").val($(this).attr('type'));
				$("#kategori").val($(this).attr('id_kategori')).change();
				$("#idJenisBmn").val($(this).attr('id_jenis'));
				$("#form").attr('action', 'editJenisBmn');
				$("#reset").attr('mode', 'edit');
				$("#reset").text('Batal');
				//$("#kategori").val($(this).('merk'));
				//alert($(this).attr('id'));
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
								$("#merk").val("");
								$("#type").val("");
								$("#kategori").val("").change();
								$("#idJenisBmn").val("");
								$("#form").attr('action', 'aksiInputJenisBmn');
								$("#reset").attr('mode', 'input');
								$("#reset").text('Reset');
							},
							"Tidak": function() {
							  $( this ).dialog( "close" );
							  
							}
						  }
					});
				}else{
					$("#merk").val("");
					$("#type").val("");
					$("#kategori").val("").change();
				}
			});
			
			$("[id=hapusJenis]").click(function(e){
				e.preventDefault();
				var a=this;
				$("#modal").text("Apakah Anda Yakin Menghapus Jenis Barang ini ?");
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