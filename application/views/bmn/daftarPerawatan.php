<div role="tabpanel" class="tab-pane fade " id="tab_content2" aria-labelledby="home-tab">
<div class="row">
	<div class="x_panel">
	<div class="x_content">
		<table id="adatatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
			<thead>
				<th width="10%">Tanggal</th>
				<th width="20%">BMN</th>
				<th width="15%">Penyedia Jasa/ Bengkel</th>
				<th width="35%">Ringkasan Perawatan</th>
				<th width="10%">Biaya</th>
				<th width="15%">Aksi</th>
			</thead>
			<tbody>
				<?php 
					foreach($daftarPerawatan as $row){
						echo '<tr>
								<td>'.$row['tanggal_selesai'].'</td>
								<td>'.$row['merk'].' '.$row['type'].': '.$row['identitas'].'</td>
								<td>'.$row['penyedia'].'</td>
								<td>'.$row['ringkasanPerawatan'].'</td>
								<td>'.$row['biaya'].'</td>
								<td>
									<div class="btn-group">
									<button type="button" class="btn btn-info btn-xs">Action</button>
										<button type="button" class="btn btn-danger btn-xs dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
											<span class="caret"></span>
											<span class="sr-only">Toggle Dropdown</span>
										</button>
									<ul class="dropdown-menu" role="menu">
										<li><a id="hapusDaftarPerawatan" href="'.base_url().'hapusDaftarPerawatan/'.$row['id_grup_trx'].'/'.$row['id_barang'].'">Hapus</a></li>
										<li><a href="'.base_url().'editPerawatanPage/'.$row['id_grup_trx'].'/'.$row['id_barang'].'">Edit</a></li>
										</li>
									</ul>
								</div>
								</tr>';
					}
				?>
			</tbody>
		</table>
	</div>
</div>
</div>
</div>
<div id="dialog-confirm2" style="display:none">
	<p id="dialog-text"></p>
</div>
<script>
	$(document).ready(function() {
		$('[id=hapusDaftarPerawatan]').click(function(e){
			e.preventDefault();
			var a=this;
			$("#dialog-text").text('Apakah anda Yakin Menghapus Daftar Perawatan ini ?');
			$( "#dialog-confirm2" ).dialog({
				  resizable: false,
				  height: "auto",
				  width: 400,
				  modal: true,
				  buttons: {
					"Ya": function() {
					  $(this ).dialog( "close" );
					  window.location = a.href;
					},
					"Batal": function() {
					  $( this ).dialog( "close" );
					}
				}
			});
		})
	})
	</script>