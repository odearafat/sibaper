 <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3><?php echo $judul_halaman; ?></h3>
              </div>
              <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                  <div class="input-group" style="margin-bottom:15%">
                  <!--
                    <input type="text" class="form-control" placeholder="Search for...">
                    <span class="input-group-btn">
                      <button class="btn btn-default" type="button">Go!</button>
                    </span>
                    -->
                  </div>
				  
                </div>
              </div>
			  
            </div>
			<?php $this->load->view($page);?>
            <div class="clearfix"></div>
			 
          </div>
        </div>
		
        <!-- /page content -->