<div role="tabpanel" class="tab-pane fade " id="tab_content2" aria-labelledby="home-tab">
<div class="row">
	<div class="x_panel">
	<div class="x_content">
	
		<table id="adatatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
			<thead>
				<th width="10%">Tanggal</th>
				<th width="7%">No SPK (WO)</th>
				<th width="13%">Penyedia Jasa/ Bengkel</th>
				<th width="25%">Pekerjaan</th>
				<th width="15%">Alat/Spareparts yang Diganti</th>
				<th width="10%">Biaya</th>
				<th width="10%">Keterangan</th>
				<th width="15%">Aksi</th>
			</thead>
			<tbody>
				<?php 
				//print_r($daftarPerawatan)
					foreach($daftarPerawatan as $row){
						echo '<tr>
								<td>'.$row->tanggal_selesai.'</td>
								<td>'.$row->no_spk.'</td>
								<td>'.$row->penyedia.'</td>
								<td>'.$row->pekerjaan.'</td>
								<td>'.$row->sparepart.'</td>
								<td>'.$row->biaya.'</td>
								<td>'.$row->keterangan.'</td>
								<td>
									<div class="btn-group">
									<button type="button" class="btn btn-info btn-xs">Action</button>
										<button type="button" class="btn btn-danger btn-xs dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
											<span class="caret"></span>
											<span class="sr-only">Toggle Dropdown</span>
										</button>
									<ul class="dropdown-menu" role="menu">
										<li><a id="hapusDaftarPerawatan" href="'.base_url().'hapusDaftarPerawatan/'.$row->id_grup_trx.'/'.$row->id_barang.'">Hapus</a></li>
										<li><a href="'.base_url().'editPerawatanPage/'.$row->id_grup_trx.'/'.$row->id_barang.'">Edit</a></li>
										</li>
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
</div>