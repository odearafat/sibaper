 <div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
	<div class="x_panel">
	  <div class="x_title">
		<table style="width:100%">
		<tr>
			<td style="text-align:left"><h2>Daftar BMN</h2></td>
			<td >
			<?php
		if($this->session->userdata('id_sibaper')=='3'||$this->session->userdata('id_sibaper')=='4'){
			
			echo '<div style="margin-left:50%" class="col-md-6 col-sm-6 col-xs-12">
			<select style="width:100%" id="satker" name="satker" required="required" class="select9_single form-control col-md-7 col-xs-12" >';	
		
			foreach($satker as $row)
			{
					if($row->id_satker==$id_satker){
						echo '<option selected="selected" href="'.base_url().'daftarBmn/'.$row->id_satker.'" value="'.$row->id_satker.'">'
						.$row->nm_satker.' </option>';
					}
					else{
						echo '<option href="'.base_url().'daftarBmn/'.$row->id_satker.'" value="'.$row->id_satker.'">'
						.$row->nm_satker.' </option>';
					}
			}		
		
			echo '<span class="required">*</span> </select></div>';
		}
		?>
		 </td>
		 </tr>
		 </table>
		<div class="clearfix"></div>
	  </div>
	  <div class="x_content">
		  <div class="row">
	<?php 
	$maxPage=5;
	$i=0;
	$cad=Array();
	foreach($kendaraan as $row){
	if($i<$maxPage || $daftar=='daftar'){?>
	  <div class="col-md-55">
		<div class="thumbnail">
		  <div class="image view view-first">
			<img style="width: 100%; display: block;" src="<?php
					$foto='./assets/images/bmn/'.$row->link_foto_k;
					//var_dump(is_file($foto));
					//echo $foto;
					if(!is_file($foto)){
						$foto=base_url().'assets/images/kategori/'.$row->link_foto_kat;
					}else{
						$foto= base_url().'assets/images/bmn/'.$row->link_foto_k;
					}
					echo $foto?>" alt="image" />
			<div class="mask">
			  <div class="tools tools-bottom">
				<a href="<?=base_url()?>detail/1/<?php echo $row->id_kendaraan.'/'.$row->no_pol?>"><i class="fa fa-search"></i></a>
				<?php 
				if($this->session->userdata('id_sibaper')=='1'|| $this->session->userdata('id_sibaper')=='3'){
					}else{
							echo '<a href="'.base_url().'perawatanba/1/'.$row->id_kendaraan.'/'.$row->no_pol.'"><i class="fa fa-wrench"></i></a>';
						}
				?>
			  </div>
			</div>
		  </div>
		  <div class="caption">
		<p><?php $caption=$row->merk.' '.$row->type.': '.$row->no_pol; 
					if(strlen($caption)<42){
						echo $caption;
				}else{
					echo substr($caption, 0,42).' . . .';
				}?></p><p>Perawatan : <?php 
		if($row->biaya==""){
			echo '0';
		}else{
			echo 'Rp '.$row->biaya.',-';
		}?></p>
		  </div>
		</div>
	</div> 
	<?php 
		
	}else{
		break;
		
	}
	$i++; }?>
	
	<?php foreach($non_kendaraan as $row){
		if($i<$maxPage || $daftar=='daftar'){ ?>
	  <div class="col-md-55">
		<div class="thumbnail">
		  <div class="image view view-first">
			<img style="width: 100%; display: block;" src="<?php 
					$foto='./assets/images/bmn/'.$row->link_foto_k;
					//var_dump(is_file($foto));
					//echo $foto;
					if(!is_file($foto)){
						$foto=base_url().'assets/images/kategori/'.$row->link_foto_kat;
					}else{
						$foto= base_url().'assets/images/bmn/'.$row->link_foto_k;
					}
					echo $foto;?>" alt="image" />
			<div class="mask">
			  <div class="tools tools-bottom">
				<a href="<?=base_url()?>detail/2/<?php echo $row->id_non_kendaraan.'/'.$row->identitas_barang ?>"><i class="fa fa-search"></i></a>
				<?php if($this->session->userdata('id_sibaper')=='1'|| $this->session->userdata('id_sibaper')=='3'){
						
						}else{
		echo '<a href="'.base_url().'perawatanba/2/'.$row->id_non_kendaraan.'/'.$row->identitas_barang.'"><i class="fa fa-cog"></i></a>';					
						}
				?>
			  </div>
			</div>
		  </div>
		  <div class="caption">
	<p><?php $caption=$row->merk.' '.$row->type.': '.$row->identitas_barang; 
				if(strlen($caption)<42){
						echo $caption;
				}else{
					echo substr($caption, 0,42).' . . .';
				}
				?></p><p>Perawatan : <?php 
		if($row->biaya==""){
			echo '0';
		}else{
			echo 'Rp '.$row->biaya.',-';
		} ?></p>
		  </div>
		</div>
	</div> <?php 
		}else{
			break;
		}
		$i++;
	}
?>
	
	</div>
	<?php if($daftar!='daftar'){
				echo'<div style="text-align:right; ">
				<a style="color:blue" href="'.base_url().'daftarBmn.html"> 
				Selengkapnya>></a></div>';
			}
	?>
	
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