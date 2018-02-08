<div class="x_panel">
<div class="x_content">
	<div class="" role="tabpanel" data-example-id="togglable-tabs">
		<ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
			<li role="presentation" class="active"><a href="#tab_content1" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Input Perawatan</a></li>
			<li role="presentation"  class=""><a href="#tab_content2" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">Daftar Perawatan</a></li>
		
	     </ul>
		<div id="myTabContent" class="tab-content">
			<?php	
				$this->load->view($pageInput);
				$this->load->view($pageDaftar);
			?>
		</div>
	</div>
</div >
</div >