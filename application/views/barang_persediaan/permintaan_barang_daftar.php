<div role="tabpanel" class="tab-pane fade active in" id="tab_content2" aria-labelledby="home-tab">
	  <table id="adatatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
	  <thead>
		<tr>
		  <th width="15%">Tanggal Permintaan</th>
		  <th width="20%">Unit Kerja</th>
		  <th width="55%">Ringkasan Permintaan </th>
		  <th width="10%">Aksi</th>
		</tr>
	  </thead>
	  <tbody>
		<?php
		//print_r($daftar_barang);
			foreach($daftar_barang as $itemDaftarBarang){
				echo ' <tr>
						  <td>'.$itemDaftarBarang['tgl_permintaan'].'</td>
						  <td>'.$itemDaftarBarang['unit_kerja'].' </td>
						  <td>'.$itemDaftarBarang['ringkasan_permintaan'].'</td>
						  <td> 
								<div class="btn-group">
									<button type="button" class="btn btn-info btn-xs">Action</button>
										<button type="button" class="btn btn-danger btn-xs dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
											<span class="caret"></span>
											<span class="sr-only">Toggle Dropdown</span>
										</button>
									<ul class="dropdown-menu" role="menu">
										<li><a id="hapusDaftarPermintaan" href="'.base_url().'hapusDaftarPermintaan/'.$itemDaftarBarang['id_trx_k'].'">Hapus</a></li>
										<li><a id="editItemPermintaan" href="'.base_url().'editItemPermintaan/'.$itemDaftarBarang['id_trx_k'].'">Edit</a></li>
										<li><a id="printItemPermintaan" href="'.base_url().'printItemPermintaan/'.$itemDaftarBarang['id_trx_k'].'">Cetak</a></li>
										</li>
									</ul>
									
								</div>
						  </td>';
			}
		?>
	  </tbody>
	</table>
</div>
<div id="dialog-confirm2" style="display:none">
	<p id="dialog-text"></p>
</div>
<script>
	$(document).ready(function() {
		$('[id=hapusDaftarPermintaan]').click(function(e){
			e.preventDefault();
			var a=this;
			$("#dialog-text").text('Apakah anda Yakin Menghapus Daftar Permintaan ini ?');
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
