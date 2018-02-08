 <div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
	<div class="x_panel">
	<form id="stockOpnameForm" action="stockOpname" enctype="multipart/form-data" method="post" id="demo-form" data-parsley-validate class="form-horizontal form-label-left">		
	<div class="x_title">
		
		 
		<div class="clearfix"></div>
	  </div>
	  <div class="x_content">
	<?php echo $panel; ?>
		
		<div class="clearfix"></div>
		<table   id="<?php echo $idStok; ?>" class="table table-striped table-bordered" cellspacing="0" width="100%">
			<thead>
			<tr>
			<th width="16%">Kode Barang</th>
			<th width="50%">Nama barang</th>
			<th width="12%">Satuan</th>
			<th width="12%">Jumlah</th>
			<th id="s_opname" style="display:none" width="5%">Perbaiki Jumlah</th>
			</tr>
			</thead>
			<tbody>
				<?php 
				$i=0;
				foreach($stok as $row){
					echo '<tr><td> <input type="hidden"  name="var[]" value="'.$row['id_barang'].'--'.$row['stok'].'">'.$row['id_barang'].'</td>
							<td> '.$row['uraian_barang'].'</td><td>'.$row['satuan'].'</p></td>
							<td>'.$row['stok'].'</td><td id="s_opname" style="display:none"><input type="number" name="stockOpname[]"></td></tr>';
					$i++;
					
				}?>
			</tbody>
		</table>
				
	  </div>
	  </form>
	  <div id="dialog-confirm" style="display:none">
		Anda Yakin Dengan Perubahan Stok ?	
	  </div>
	</div>
	</div>
</div>
<script>
		$(document).ready(function() {
		$("#satker").change(function(){
						var href=$(this).find('option:selected').attr("href");
						window.location.href=href;
					});
					});
</script>