 <div class="x_panel">
	<div class="x_title">
		<h2>Profil Barang <small>Riwayat perawatan </small></h2>
		
		<div class="clearfix"></div>
	</div>
	 <div class="x_content">
		<div class="col-md-3 col-sm-3 col-xs-12 profile_left">
						  <div class="profile_img">
							<div id="crop-avatar">
			  <!-- Current avatar -->
			    <?php //echo $barangKendaraan->link_foto_k;?>
			  <img class="img-responsive avatar-view" src="<?php 
				//echo print_r($barangKendaraan);
				if($kendaraanOrNo=='1'){
					if(is_file('./assets/images/bmn/'.$barangKendaraan->link_foto_k)){
						echo base_url().'assets/images/bmn/'.$barangKendaraan->link_foto_k;
					}else{
						echo base_url().'assets/images/kategori/'.$barangKendaraan->link_foto_kat;
					}
				}else{
						if(is_file('./assets/images/bmn/'.$barangNonKendaraan->link_foto_k)){
							echo base_url().'assets/images/bmn/'.$barangNonKendaraan->link_foto_k;
						}else{
							echo base_url().'assets/images/kategori/'.$barangNonKendaraan->link_foto_kat;
						}
					}
				?>" alt="Avatar" title="Change the avatar">
			</div>
		  </div>
		  <h3><?php if($kendaraanOrNo=='1'){
							echo $barangKendaraan->merk.' '.$barangKendaraan->type.' '.
							$barangKendaraan->no_pol; //print_r($barangKendaraan);
					}else{
						echo $barangNonKendaraan->merk.' '.$barangNonKendaraan->type.' '.
							$barangNonKendaraan->identitas_barang; //print_r($barangKendaraan);
					}
						?></h3>

		  <ul class="list-unstyled user_data">
			<li><i class="fa fa-map-marker user-profile-icon"> <?php
				if($kendaraanOrNo=='1'){
					echo " ".$barangKendaraan->nm_satker;
				}else{
					echo " ".$barangNonKendaraan->nm_satker;
				}
					?></i>
			</li>
			<li>
			  <i class="fa fa-user user-profile-icon"><?php 
				if($kendaraanOrNo=='1'){
					echo "  ".$barangKendaraan->nama;
				}else{
					echo "  ".$barangNonKendaraan->nama;
				}
				
					;?> </i> 
			</li>
			<li>
			  <i class="fa fa-clock-o user-profile-icon"> <?php 
			  if($kendaraanOrNo=='1'){
				echo "  ".$barangKendaraan->tahun_kendaraan;
			  }else{
				  echo "  ".$barangNonKendaraan->tahun;
			  }?> </i>
			</li>
		  </ul>
		  
		  <!--<a href="<?php //echo base_url().'editba/'.$result['id_barang_aset'];?>" class="btn btn-success"><i class="fa fa-edit m-right-xs"></i>Edit Barang</a>
			-->
		 <br />

		</div>
		
		<div style=" <?php 
			if($kendaraanOrNo=='1'){
				echo "";
			}else{
				echo "display:none";
			} ?>"class="col-md-9 col-sm-9 col-xs-12">
		  <div class="profile_title">
			<div class="col-md-6">
			  <h2>Profil Barang</h2>
			</div>
		  </div>
		  <div>
			  <table class="data table table-striped no-margin">
				<tr>
					<td>Kategori BMN</td>
					<td width="3%">:</td>
					<td><?php 
					if($kendaraanOrNo=='1'){
					echo $barangKendaraan->nm_kategori;}?></td>
				</tr>
				<tr>
					<td>Merk/Type</td>
					<td>:</td>
					<td><?php 
					if($kendaraanOrNo=='1'){
					echo $barangKendaraan->merk.'  '.$barangKendaraan->type;}?></td>
				</tr>
				<tr>
					<td>Nomor Polisi</td>
					<td>:</td>
					<td><?php  if($kendaraanOrNo=='1'){echo $barangKendaraan->no_pol;}?></td>
				</tr>
				<tr>
					<td>Tahun Kendaraan</td>
					<td>:</td>
					<td><?php 
					if($kendaraanOrNo=='1'){
						if($barangKendaraan->tahun_kendaraan==''){
										echo '-';
							}else{
								echo $barangKendaraan->tahun_kendaraan;
							}
					}
						
						?></td>
				</tr><tr>
					<td>Nomor Mesin</td>
					<td>:</td>
					<td><?php if($kendaraanOrNo=='1'){
						if($barangKendaraan->no_mesin==''){
										echo '-';
							}else{
								echo $barangKendaraan->no_mesin;
							}
					}
					;?></td>
				</tr>
				<tr>
					<td>Nomor Rangka</td>
					<td>:</td>
					<td><?php 
					if($kendaraanOrNo=='1'){
					if($barangKendaraan->no_rangka==''){
										echo '-';
							}else{
								echo $barangKendaraan->no_rangka;
							}
					}
					?></td>
				</tr>
				<tr>
					<td>Tanggal STNK</td>
					<td>:</td>
					<td><?php 
					if($kendaraanOrNo=='1'){
					if($barangKendaraan->tgl_stnk==''){
										echo '-';
							}else{
								echo $barangKendaraan->tgl_stnk;
							}
					}
					?></td>
				</tr>
			  </table>
			 </div>
		</div>
		<div style=" <?php 
			if($kendaraanOrNo=='1'){
				echo "display:none";
			}else{
				echo "";
			} ?>"class="col-md-9 col-sm-9 col-xs-12">
		  <div class="profile_title">
			<div class="col-md-6">
			  <h2>Profil Barang</h2>
			</div>
		  </div>
		  <div>
			  <table class="data table table-striped no-margin">
				<tr>
					<td>Kategori BMN</td>
					<td width="3%">:</td>
					<td><?php 
					if($kendaraanOrNo=='2'){
						echo $barangNonKendaraan->nm_kategori;
					}?></td>
				</tr>
				<tr>
					<td>Merk/Type</td>
					<td>:</td>
					<td><?php 
					if($kendaraanOrNo=='2'){
					echo $barangNonKendaraan->merk.'  '.$barangNonKendaraan->type;}?></td>
				</tr>
				<tr>
					<td>Nama/Identitas BMN</td>
					<td>:</td>
					<td><?php  if($kendaraanOrNo=='2'){echo $barangNonKendaraan->identitas_barang;}?></td>
				</tr>
				<tr>
					<td>Tahun Perolehan</td>
					<td>:</td>
					<td><?php 
					if($kendaraanOrNo=='2'){
						if($barangNonKendaraan->tahun==''){
										echo '-';
							}else{
								echo $barangNonKendaraan->tahun;
							}
					}
						
						?></td>
				</tr>
			  </table>
			 </div>
		</div>
		<div class="col-md-12 col-sm-12 col-xs-12" width="100%">
		  <div class="profile_title">
			<table width="100%"><tr><td style="text-align:left;">
				<div class="col-md-6">
				  <h2>Riwayat Perawatan <small> Tahun <?php echo  date('Y');?> </small></h2>
				</div>
				</td>
				<td style="text-align:right;"> 
				<form action="<?php echo base_url();?>downloadExcelBmn" enctype="multipart/form-data" method="post"  class="form-horizontal form-label-left" >
					<input type="text" style="display:none" name="bmnCad" value=<?php echo $bmnCad; ?>>
					<input type="text" style="display:none" name="tglAkhirCad" value="<?php echo $tglAkhirCad; ?>">
					<input type="text" style="display:none" name="tglAwalCad" value="<?php echo $tglAwalCad; ?>">
					<input type="text" style="display:none" name="kendaraanOrNoCad" value="<?php echo $kendaraanOrNoCad; ?>">
					<button type="submit"  class="btn btn-success">Download Kartu Kendali</button>
					<!--<button type="submit" id="bttDownloadPDF" class="btn btn-success">Download PDF</button>-->
				</form>
				</td>
				</tr>
			</table>
		  </div>

		  
		   
			<div id="myTabContent" class="tab-content" width="100%">
			<table id="adatatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
			<thead>
				<th width="10%">Tanggal</th>
				<th width="7%">No SPK (WO)</th>
				<th width="13%">Penyedia Jasa/ Bengkel</th>
				<th width="25%">Pekerjaan</th>
				<th width="15%">Alat/Spareparts yang Diganti</th>
				<th width="10%">Biaya</th>
				<th width="10%">Keterangan</th>
			</thead>
			<tbody>
			<?php
			//print_r($daftarPerawatan);
			$biaya=0;
				foreach($daftarPerawatan as $row){
						echo '<tr>
								<td>'.$row->tanggal_selesai.'</td>
								<td>'.$row->no_spk.'</td>
								<td>'.$row->penyedia.'</td>
								<td>'.$row->pekerjaan.'</td>
								<td>'.$row->sparepart.'</td>
								<td>'.$row->biaya.'</td>
								<td>'.$row->keterangan.'</td>
							</tr>';
							$biaya=$biaya+$row->biaya;
					}
					if(sizeof($daftarPerawatan)>=0 or sizeof($daftarPerawatan)>=0){
						echo '<tr><td colspan="5">Jumlah</td>
								<td colspan="2">'.$biaya.'</td>
								</tr>';
					}else{
						echo '<tr><td colspan="7">Belum Ada Perawatan Selama Tahun '.date('Y').'</td></tr>';
					}
				?>
				</tbody>
			</table>
		  </div>
	  </div>
	 </div>
   </div>