<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
	<div class="x_panel">
<table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
	  <thead>
		<tr>
		  <th>Nama Barang</th>
		   <th>Tanggal Pembelian</th>
		  <th>Jumlah Awal</th>
		   <th>Nilai Awal</th>
		  <th>Jumlah Tersisa</th>
		  <th>Nilai Tersisa</th>
		    <th>Aksi</th>
		  
		</tr>
	  </thead>
	  <tbody>
		<tr>
		  <td>Kertas A4 Sinar Dunia</td>
		  <td>2017/01/01</td>
		  <td>20(rim)</td>
		  <td>1000000</td>
		  <td>10 (rim)</td>
		  <td>500000</td>
		  <td> 
			<div class="btn-group">
				<button type="button" class="btn btn-info btn-xs">Action</button>
                    <button type="button" class="btn btn-danger btn-xs dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                        <span class="caret"></span>
                        <span class="sr-only">Toggle Dropdown</span>
                    </button>
				<ul class="dropdown-menu" role="menu">
					<li><a href="<?=base_url()?>detail/<?php// echo $row['id_barang_aset']?>';">Lihat Detail</a></li>
					<li><a href="<?=base_url()?>editba/<?php //echo $row['id_barang_aset']?>">Edit</a></li>
					<li><a href="<?=base_url()?>hapusba/<?php// echo $row['id_barang_aset']?>">Hapus</a></li>
					<li><a href="<?=base_url()?>editba/<?php //echo $row['id_barang_aset']?>">Input Permintaan</a></li>
					</li>
				</ul>
			</div>
		 </td> 
		</tr>
		<?php //}?>
		</tr>
		<tr>
		  <td>Map BPS</td>
		  <td>2017/01/01</td>
		  <td>300 (buah)</td>
		  <td>1500000</td>
		  <td>100 (buah)</td>
		  <td>500000</td>
		  <td> 
			<div class="btn-group">
				<button type="button" class="btn btn-info btn-xs">Action</button>
                    <button type="button" class="btn btn-danger btn-xs dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                        <span class="caret"></span>
                        <span class="sr-only">Toggle Dropdown</span>
                    </button>
				<ul class="dropdown-menu" role="menu">
					<li><a href="<?=base_url()?>detail/<?php// echo $row['id_barang_aset']?>';">Lihat Detail</a></li>
					<li><a href="<?=base_url()?>editba/<?php //echo $row['id_barang_aset']?>">Edit</a></li>
					<li><a href="<?=base_url()?>hapusba/<?php// echo $row['id_barang_aset']?>">Hapus</a></li>
					<li><a href="<?=base_url()?>editba/<?php //echo $row['id_barang_aset']?>">Input Permintaan</a></li>
					</li>
				</ul>
			</div>
		 </td> 
		</tr>
	  </tbody>
	</table>
	</div>
	</div>
</div>
	