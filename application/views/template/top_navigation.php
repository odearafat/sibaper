 <!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu">
           
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>
			  <div align="center" class="pull-right">
              <ul width="50%" class="nav navbar-nav" >
                <li width="50%">
                  <a width="50%" href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
					
					<?php echo $this->session->userdata("nama").'&nbsp &nbsp &nbsp  '?>
					<i class="fa fa-user "></i>
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                    <li><a href="<?php echo base_url();?>help.html">Help</a></li>
                    <li><a href="<?php echo base_url();?>gantiPassword.html">Ganti Password</a></li>
                    <li><a href="<?php echo base_url();?>logout.html"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                  
                  </ul>
                </li>
				</div>
				
              </ul>
            
          </div>
        </div>
        <!-- /top navigation -->