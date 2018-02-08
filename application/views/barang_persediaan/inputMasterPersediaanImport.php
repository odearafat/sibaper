<div role="tabpanel" class="tab-pane fade " id="tab_content2" aria-labelledby="home-tab">
<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
	<div class="x_panel">
	<form id="stockOpnameForm" action="importData" enctype="multipart/form-data" method="post" id="demo-form" data-parsley-validate class="form-horizontal form-label-left">		
	<div class="x_title">
		<h2>Import Master Persediaan (.ral)</h2>
		<div class="clearfix"></div>
	 </div>
	  <div class="x_content">
	  <table class="table table-striped table-bordered dt-responsive nowrap">
		<tr>
			<td style="padding-right:2%">Upload Backup Master Persediaan Dari Aplikasi Simak BMN (.ral)</td>
				<td><input type="file" accept=".ral" name="backupSimak"></td>
			</tr>
		</tr>
	</table>
	<table>
		<tr>
			<td><td style="padding-right:2%"></td>
				<td>  <button type="submit" id="importData"class="btn btn-success">Import</button></td>
			</tr>
		</tr>
		
	</form>
	</table>
	  </div>
	  </div>
	  </div>
	  </div>
	  </div>
	  
	   <script>
	  $(document).ready(function() {
		
		$("#importData").click(function(e){
			e.preventDefault();
			alert("Untuk Sementara Hubungi Admin Utama Untuk Melakukan Import Data !!");
		});
		
	  });
	  </script>