<div class="row">
	<div class="col-md-12 col-sm-12 col-xs-12">
	<div class="x_panel">
	  <div class="x_title">
		<table style="width:100%">
		<tr>
				<td style="text-align:left">
					<h2>Barang Persediaan</h2>
				</td>
			<td>
					<?php
					if($this->session->userdata('id_sibaper')=='3'||$this->session->userdata('id_sibaper')=='4'){
					echo '<div style="margin-left:50%" class="col-md-6 col-sm-6 col-xs-12">
						<select style="width:100%" id="satker" name="satker" required="required" class="select9_single form-control col-md-7 col-xs-12" >';	
					 
						foreach($satker as $row)
						{
								if($row->id_satker==$this->session->userdata('id_satker')){
									echo '<option selected="selected" href="'.base_url().'stok/'.$row->id_satker.'" value="'.$row->id_satker.'">'
									.$row->nm_satker.' </option>';
								}
								else{
									echo '<option href="'.base_url().'stok/'.$row->id_satker.'" value="'.$row->id_satker.'">'
									.$row->nm_satker.' </option>';
								}
						}		
					
				echo '<span class="required">*</span> </select></div>';
				}
				?>
			</td>
		 </table>
		 
		<div class="clearfix"></div>
	  </div>
	 <div class="x_content">
		<table id="tabelStokHome" class="table table-striped table-bordered" cellspacing="0" width="100%">
		<thead>
			<th width="16%">Kode Barang</th>
			<th width="50%">Nama barang</th>
			<th width="12%">Satuan</th>
			<th width="12%">Jumlah</th>
			<th id="s_opname" style="display:none" width="5%">Perbaiki Jumlah</th>
			</thead>
		<tbody>
			<?php 
			$i=0;
			foreach($stok as $row){
				echo '<tr><td> <input type="hidden"  name="var[]" value="'.$row['id_barang'].'--'.$row['stok'].'">'.$row['id_barang'].'</td>
						<td> '.$row['uraian_barang'].'</td><td>'.$row['satuan'].'</p></td>
						<td>'.$row['stok'].'</td><td id="s_opname'.$i.'" style="display:none"><input type="number" name="stockOpname[]"></td></tr>';
				$i++;
			}?>
		</tbody>
		</table>
	</div>
	</div>
	</div>
	</div>
	<!-- Datatables -->
    <script>
      $(document).ready(function() {
        var handleDataTableButtons = function() {
          if ($("#datatable-buttons").length) {
            $("#datatable-buttons").DataTable({
              dom: "Bfrtip",
              buttons: [
                {
                  extend: "copy",
                  className: "btn-sm"
                },
                {
                  extend: "csv",
                  className: "btn-sm"
                },
                {
                  extend: "excel",
                  className: "btn-sm"
                },
                {
                  extend: "pdfHtml5",
                  className: "btn-sm"
                },
                {
                  extend: "print",
                  className: "btn-sm"
                },
              ],
              responsive: true
            });
          }
        };

        TableManageButtons = function() {
          "use strict";
          return {
            init: function() {
              handleDataTableButtons();
            }
          };
        }();

        $('[id=tabelStokHome]').dataTable();

        $('#datatable-keytable').DataTable({
          keys: true
        });

        //$('#datatable-responsive').DataTable();

        $('#datatable-scroller').DataTable({
          ajax: "js/datatables/json/scroller-demo.json",
          deferRender: true,
          scrollY: 380,
          scrollCollapse: true,
          scroller: true
        });

        $('#datatable-fixed-header').DataTable({
          fixedHeader: true
        });

        
        TableManageButtons.init();
        $("[id=satker]").change(function(){
				var href=$(this).find('option:selected').attr("href");
				window.location.href=href;
			});
        
      });
    </script>
    <!-- /Datatables -->