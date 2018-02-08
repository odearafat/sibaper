<body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0; text-align:center; margin:5% 0% 30% 0%;" >
				<img style="display:block; padding:0% 30% 5% 30%"src="<?=base_url()?>images/sbp.gif" >
              <a href="index.html" class="site_title" style="margin-bottom:20%; display:inline; align:center; height:100%; line-height:0px; width:100%">
			  <!--<i class="fa fa-institution"></i>-->
			  <small><b>Sistem Informasi <br> Barang Pemerintah</b></small></a>
			 
            </div>
            <div class="clearfix" ></div>

            <!-- menu profile quick info -->
            
             <!-- <div class="profile_pic">
                <img src="<?=base_url()?>images/img.jpg" alt="..." class="img-circle profile_img">
              </div>
			 -->
			 <!--
              <div style="text-align:center; padding-top:10%;" width="100%" >
                <span>Selamat Datang,</span>
                <b><h2> <?php echo $this->session->userdata("nama")?></h2></b>
              </div>
              <div class="clearfix"></div>
          -->
            <!-- /menu profile quick info -->
            <br/>

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3>General</h3>
                <ul class="nav side-menu">
                  <li><a href="<?=base_url()?>beranda.html"><i class="fa fa-home"></i> Home </a>
				<?php if($this->session->userdata('id_sibaper')!='21'){ 
							echo'<li><a><i class="fa fa-desktop"></i> BMN <span class="fa fa-chevron-down"></span></a>
									<ul class="nav child_menu">
									  <li><a href="'.base_url().'daftarBmn.html">Daftar BMN</a></li>';
									  if($this->session->userdata('id_sibaper')=='1' || $this->session->userdata('id_sibaper')=='3'){}else{
											echo 	'<li><a href="'.base_url().'inputPerawatan.html">Input Perawatan BMN</a></li> <li><a href="'.base_url().'inputBmn.html">Input BMN</a></li>';
									  }
									  
							echo '</ul></li>';
						}
						
						if($this->session->userdata('id_sibaper')!='22'){
							echo '<li><a><i class="fa fa-clone"></i>Barang Persediaan <span class="fa fa-chevron-down"></span></a>
									<ul class="nav child_menu">
									  <li><a href="'.base_url().'stok.html">Stok</a></li>';
									  if($this->session->userdata('id_sibaper')=='1' || $this->session->userdata('id_sibaper')=='3'){}else{
										  echo '<li><a href="'.base_url().'inputBarangPersediaan.html">Input Barang Persediaan</a></li>
												<li><a href="'.base_url().'permintaanBarangPersediaan.html">Permintaan Barang Persediaan</a></li>';
									  }
							echo '</ul></li>';		
						}							
                ?>  
					
					<li><a><i class="fa fa-file-o"></i>Laporan <span class="fa fa-chevron-down"></span></a>
						<ul class="nav child_menu">
						<?php //if($this->session->userdata('id_sibaper')==1){ 
										echo '<li><a href="'.base_url().'karkenBMN.html">Kartu Kendali BMN</a></li>';
										echo '<li><a href="'.base_url().'daftarAset.html">Rekap Aset BMN</a></li>';
										//}
								//else{
									echo '<li><a href="'.base_url().'karkenATK.html">Kartu Kendali ATK</a></li>';
									
									echo '<li><a href="'.base_url().'permintaanAtkUnitKerja.html">Permintaan ATK Unit Kerja</a></li>';
									
									
									//}
								
						?>
						</ul>
					</li>
                </ul>
              </div>
	  
                          <?php if($this->session->userdata('id_sibaper')==1 || $this->session->userdata('id_sibaper')==3 ){
				}else{
				echo '<div class="menu_section">
                <h3>Master Tabel</h3>
                <ul class="nav side-menu">
				  <li><a href="'.base_url().'inputJenisBmn.html">Master Merk & Type BMN</a></li>
                  <li><a href="'.base_url().'inputMasterPersediaan.html">  Master Barang Persediaan</a></li>';?>
					<?php if($this->session->userdata('id_sibaper')==4){
						echo '<li><a href="'.base_url().'inputMasterPegawai.html">  Master Pegawai</a></li>';
						echo '<li><a href="'.base_url().'hakAkses.html">  Hak Akses</a></li>';
					}?>
                <?php echo '</ul>
				</div>';}?>
			
            </div>
			
            <!-- /sidebar menu -->
			 <!-- /menu footer buttons -->
            <div class="sidebar-footer hidden-small">
              <a data-toggle="tooltip" data-placement="top" title="Settings">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Lock">
                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Logout">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
              </a>
            </div>
            <!-- /menu footer buttons -->
          </div>
        </div>