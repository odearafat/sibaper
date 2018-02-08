		<?php 
				if($this->session->userdata('id_sibaper')!='21'){
						$this->load->view('bmn/daftarBmn');
				}
				if($this->session->userdata('id_sibaper')!='22'){
					$this->load->view('home/daftarBarangPersediaan');
				}
		 ?>
	
	
	
			

	