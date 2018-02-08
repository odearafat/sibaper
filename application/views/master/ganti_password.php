<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
	<div class="x_panel">
	<div class="x_title">
		<h2> Ganti Password</h2>
	<div class="clearfix"></div>
	</div>
	<div class="x_content">
		<?php echo $kondisi?>
		<form action="<?php echo base_url();?>aksiGantiPassword" enctype="multipart/form-data" method="post" id="form_gantiPassword" data-parsley-validate class="form-horizontal form-label-left">
			<input type="text" id="niplama" name="niplama" style="display:none">	
			<div class="form-group">
				<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Username</label>
				<div class="col-md-6 col-sm-6 col-xs-12">
					<b><?php echo $username ;?></b>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Password Lama<span class="required">*</span></label>
				<div class="col-md-6 col-sm-6 col-xs-12">
					<input type="password" id="passLm" name="passLm" value=""  required="required" class="form-control col-md-7 col-xs-12">
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Password Baru<span class="required">*</span></label>
				<div class="col-md-6 col-sm-6 col-xs-12">
					<input type="password" id="passBr" name="passBr" value="" required="required" class="form-control col-md-7 col-xs-12">
					<small><p style="color:red" id="errTdkSama"></p></small>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Konfirmasi Password Baru<span class="required">*</span></label>
				<div class="col-md-6 col-sm-6 col-xs-12">
					<input type="password" id="passBrKonf" name="passBrKonf" required="required" value=""  class="form-control col-md-7 col-xs-12">
					<small><p style="color:red" id="errTdkSama"></p></small>
				</div>
			</div>
			 <div class="form-group" >
					<div align="center" >
					  <button type="submit" id="simpan" class="btn btn-success">Simpan</button>
					</div>
				</div>
		</form>
		</div>
	</div>
	<div style="display:none" id="dialog-confirm">
		<p id="modal"></p>
	</div>
	</div>
	</div>
	
	<script>
		$(document).ready(function() {
			$("#simpan").click(function(e){
				e.preventDefault();
				if($("#passBr").val()!=$("#passBrKonf").val()){
					$('[id=errTdkSama]').text('Password Baru dan Konfirmasi Password Tidak Sama');
				}else{
					$('#form_gantiPassword').submit();
				}
			});
			
		})
	</script>