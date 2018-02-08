 <!-- footer content -->
        <footer>
          <div class="pull-right">
             SULTRA PROJECT - Supported  by Gentelella </a>
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>

    <!-- jQuery -->
    <script src="<?=base_url()?>assets/js/jquery.min.js"></script>
    <script src="<?=base_url()?>assets/js/jquery-1.12.4.js"></script>
    <script src="<?=base_url()?>assets/js/jquery-ui.js"></script>
    <!-- Bootstrap -->
    <script src="<?=base_url()?>assets/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="<?=base_url()?>assets/js/fastclick.js"></script>
	<!-- Switchery -->
    <script src="<?=base_url()?>assets/js/switchery.min.js"></script>
    <!-- NProgress -->
    <script src="<?=base_url()?>assets/js/nprogress.js"></script>
    <!-- iCheck -->
    <script src="<?=base_url()?>assets/js/icheck.min.js"></script>
    <!-- Custom Theme Scripts -->
    <script src="<?=base_url()?>assets/js/custom.min.js"></script>
	<!-- jQuery autocomplete -->
    <script src="<?=base_url()?>assets/js/jquery.autocomplete.min.js"></script>
    <!-- Select2 -->
    <script src="<?=base_url()?>assets/js/select2.full.min.js"></script>
	<!-- bootstrap-daterangepicker -->
    <script src="<?=base_url()?>assets/js/moment.min.js"></script>
    <script src="<?=base_url()?>assets/js/daterangepicker.js"></script>
	<!-- bootstrap-wysiwyg -->
    <script src="<?=base_url()?>assets/js/bootstrap-wysiwyg.min.js"></script>
    <script src="<?=base_url()?>assets/js/jquery.hotkeys.js"></script>
    <script src="<?=base_url()?>assets/js/prettify.js"></script>
	<!-- Dropzone.js -->
    <script src="<?=base_url()?>assets/js/dropzone.min.js"></script>
	
	<!-- Parsley -->
    <script src="<?=base_url()?>assets/js/parsley.min.js"></script>
	
	<script src="<?=base_url()?>assets/js/jquery.uploadify.min.js"></script>
	<!-- Datatables -->
    <script src="<?=base_url()?>assets/js/jquery.dataTables.min.js"></script>
    <script src="<?=base_url()?>assets/js/dataTables.bootstrap.min.js"></script>
    <script src="<?=base_url()?>assets/js/dataTables.buttons.min.js"></script>
    <script src="<?=base_url()?>assets/js/buttons.bootstrap.min.js"></script>
    <script src="<?=base_url()?>assets/js/buttons.flash.min.js"></script>
    <script src="<?=base_url()?>assets/js/buttons.html5.min.js"></script>
    <script src="<?=base_url()?>assets/js/buttons.print.min.js"></script>
	
	<!-- Select2 -->
    <script>
      $(document).ready(function() {
		  
        $(".select2_single").select2({
          placeholder: "Pilih Jenis Barang",
          allowClear: true
        });
        $(".select2_group").select2({});
        $(".select2_multiple").select2({
          maximumSelectionLength: 4,
          placeholder: "With Max Selection limit 4",
          allowClear: true
        });
		$(".select3_single").select2({
          placeholder: "Pilih Pegawai",
          allowClear: true
        });	
		$(".select4_single").select2({
          placeholder: "Pilih Kategori",
          allowClear: true
        });
		$(".select5_single").select2({
          placeholder: "Pilih Tahun",
          allowClear: true
        });
		$(".select6_single").select2({
          placeholder: "Pilih Barang Aset",
          allowClear: true
        });
		$(".select10_single").select2({
          placeholder: "",
          allowClear: true
        });
		$(".select9_single").select2({
          placeholder: "Pilih Master BMN",
          allowClear: true
        });
		$(".select7_single").select2({
          placeholder: "Pilih Jenis Perawatan",
          allowClear: true
        });
      });
	 
	//Validation Input	 
	 $("#inputPersediaanForm").on('submit', function(e){
		var kategori=$("#inputPersediaanForm").attr("kategori");
        if(!validation(kategori))
        {
            e.preventDefault();
        }else{
			
		}
		
		function validation(kategori){
			var ne=valNotEmpty();		
			var tk=valNamaToko(kategori);		
			var jb=valJmlBarang();
			 
			var retur= ne && tk && jb;		
			return retur;
		}
		
		//validasi Nama Toko
		function valNamaToko(form){
			var retur=false;
			if(form=="input"){
				if($("#penyedia").val()==""){
					$("#valPenyedia").text("Nama Toko/ Penyedia Harus Diisi");
					retur=false;	
				}else{
					$("#valPenyedia").text("");
					retur=true;	
				}
			}else if(form=="permintaan"){
				if($("#unitKerja").find('option:selected').attr("value")==""){
					$("#valUnitKerja").text("Pilih Unit Kerja");
					retur=false;	
				}else{
					$("#valUnitKerja").text("");
					retur=true;	
				}
			}
			return retur;
		}
		
		//Validasi jumlah Barang
		function valJmlBarang(){
			var retur=true;
			for(var i=0; i<$('#datatable-responsive tr').length-1; i++){
				//alert($(".select8"+i+"_single").find('option:selected').attr("value")+"---"+$("#jumlah"+i).val());
				if($(".select8"+i+"_single").find('option:selected').attr("value")!="" && ($("#jumlah"+i).val()==0 || $("#jumlah"+i).val()=="")){
					$("#valJumlah"+i).text("Jumlah Tidak Boleh 0/ kosong");
					 retur=false;
				}else{
					$("#valJumlah"+i).text("");
				}
			 }
			 return retur;
		}
		
		function valNotEmpty(){
			var retur=false;
			//alert();
			 for(var i=0; i<$('#datatable-responsive tr').length-1; i++){
				 //alert($(".select8"+i+"_single").find('option:selected').attr("value"));
				 //alert($('#datatable-responsive tr').length-1);
				if($(".select8"+i+"_single").find('option:selected').attr("value")!=""){
					retur=true;
				};
			 };
			 if(retur){
				$("#valNoEmpty").text("");
			 }else{
				 $("#valNoEmpty").text("Field Masih Kosong");
			 }
			 return retur;
		}
			
    });
    </script>
    <!-- /Select2 -->
	
	<!--Stok-->
	<script>
	 $(document).ready(function() {
		$('#onOffStockOpname').attr('checked', false);
		$('#onOffStockOpname').click(function(){
				if(this.checked){ //Jika Stock Opname Mode ON
					$('#bttStockOpname').show();
					$('#birthday').show();
					
					$("[id=s_opname]").show();
					$('.modeSO').css("color","green");
					$('.modeSO').text("On");
					//alert($("#tabelStok tr").length);
					/*for(var i=0; i<$("#tabelStok tr").length; i++){
						$('#s_opname'+i).show();
						$('#bttStockOpname').show();
					}*/		
				}else{
					$('#bttStockOpname').hide();
					$('#birthday').hide();
						$("[id=s_opname]").hide();
						//$('#s_opname').hide();
						$('.modeSO').css("color","red");
						$('.modeSO').text("Off");
					for(var i=0; i<$("#tabelStok tr").length; i++){
						$('#s_opname'+i).hide();
						$('#bttStockOpname').hide();
					}
				}
		});
		
		$("#bttStockOpname").on('click', function(e){
			//alert("dsadsa");
			e.preventDefault();
			$( "#dialog-confirm" ).dialog({
				  resizable: false,
				  height: "auto",
				  width: 400,
				  modal: true,
				  buttons: {
					"Ya": function() {
					  $(this ).dialog( "close" );
					 $("#stockOpnameForm").submit();
					},
					"Batal": function() {
					  $( this ).dialog( "close" );
					}
			}
		});
		});
	});
	 </script>
	 
	 <!--Kartu Kendali-->
	 <script>
		 $(document).ready(function() {
				$("#bttKarken").on('click', function(e){
					e.preventDefault();
					var show2=false;
					var tglAwal=$("#birthday").val();
					var splitTgl=tglAwal.split("/");
					var gabungAwal=splitTgl[2]+splitTgl[0]+splitTgl[1];
					
					var tglAkhir=$("#birthday2").val().split("/");
					var gabungAkhir=tglAkhir[2]+tglAkhir[0]+tglAkhir[1];
					
					var today= new Date();
					var todayGabung=today.getFullYear()+('0'+(today.getMonth()+1)).slice(-2)+('0'+(today.getDate())).slice(-2);
					
					if($("#barang_persediaan").val()=="" || $("#barang_persediaan").val()==null ){
						$("#valBarangPersediaan").text("Pilih Barang Persediaan");
						$("#valBarangPersediaan").show();
						show2=false;
					}else{
						$("#valBarangPersediaan").text("");
						$("#valBarangPersediaan").hide();
						show2=true;
					}
					
					//alert(today.getFullYear()+"---"+(('0'+(today.getMonth()+1))).slice(-2)+"---"+('0'+(today.getDate())).slice(-2));
					//alert(gabungAwal +"---"+gabungAkhir+"---"+todayGabung);
					
					var show1=false;
					var show3=false;
					
					if(gabungAwal >gabungAkhir){
						$("#valTanggalAwal").text("Tanggal Awal Tidak Boleh Lebih dari Tanggal Akhir");
						$("#valTanggalAwal").show();
						show1=true;
					}else if(gabungAwal > todayGabung ){
						$("#valTanggalAwal").text("Tanggal Tidak Boleh Lebih dari hari ini");
						$("#valTanggalAwal").show();
						show1=true;
					}else{
						$("#valTanggalAwal").text("");
						$("#valTanggalAwal").hide;
						show1=false;
					}
					
					if(gabungAkhir>todayGabung){
						$("#valTanggalAkhir").text("Tanggal Tidak Boleh Lebih dari hari ini");
						$("#valTanggalAkhir").show();
						show3=true;
					}else{
						$("#valTanggalAkhir").text("");
						$("#valTanggalAkhir").hide();
						show3=false;
					}
					
					if(show1 || show3){
						$("#valTanggalBar").show();
					}else{
						$("#valTanggalBar").hide();
					}
					
					//alert("!show1= "+!show1+" !show2= "+!show2+" show3= "+show3 )
					if(!show1 && show2 && !show3){
						$("#karkenATKForm").submit();
						$("#bttDownloadExcel").show();
					}else{
						$("#bttDownloadExcel").hide();
					}
					
				});	 
		 });
		 	$("#bttDownloadExcel").on('click', function(e){
				e.preventDefault();
				$("#typeTombol").val("excel");
				$("#formDownload").submit();
				
			});
			$("#bttDownloadPDF").on('click', function(e){
				e.preventDefault();
				$("#typeTombol").val("pdf");
				$("#formDownload").submit();
			});
		 
	</script>
	 <!-- bootstrap-daterangepicker -->
    <script>
      $(document).ready(function() {
        $('#birthday').daterangepicker({
          singleDatePicker: true,
          calender_style: "picker_4"
        }, function(start, end, label) {
          console.log(start.toISOString(), end.toISOString(), label);
        });
      });
	  $(document).ready(function() {
        $('#birthday2').daterangepicker({
          singleDatePicker: true,
          calender_style: "picker_4"
        }, function(start, end, label) {
          console.log(start.toISOString(), end.toISOString(), label);
        });
      });
    </script>
    <!-- /bootstrap-daterangepicker -->
	
	 <!-- bootstrap-wysiwyg -->
    <script>
      $(document).ready(function() {
        function initToolbarBootstrapBindings() {
          var fonts = ['Serif', 'Sans', 'Arial', 'Arial Black', 'Courier',
              'Courier New', 'Comic Sans MS', 'Helvetica', 'Impact', 'Lucida Grande', 'Lucida Sans', 'Tahoma', 'Times',
              'Times New Roman', 'Verdana'
            ],
            fontTarget = $('[title=Font]').siblings('.dropdown-menu');
          $.each(fonts, function(idx, fontName) {
            fontTarget.append($('<li><a data-edit="fontName ' + fontName + '" style="font-family:\'' + fontName + '\'">' + fontName + '</a></li>'));
          });
          $('a[title]').tooltip({
            container: 'body'
          });
          $('.dropdown-menu input').click(function() {
              return false;
            })
            .change(function() {
              $(this).parent('.dropdown-menu').siblings('.dropdown-toggle').dropdown('toggle');
            })
            .keydown('esc', function() {
              this.value = '';
              $(this).change();
            });

          $('[data-role=magic-overlay]').each(function() {
            var overlay = $(this),
              target = $(overlay.data('target'));
            overlay.css('opacity', 0).css('position', 'absolute').offset(target.offset()).width(target.outerWidth()).height(target.outerHeight());
          });

          if ("onwebkitspeechchange" in document.createElement("input")) {
            var editorOffset = $('#editor').offset();

            $('.voiceBtn').css('position', 'absolute').offset({
              top: editorOffset.top,
              left: editorOffset.left + $('#editor').innerWidth() - 35
            });
          } else {
            $('.voiceBtn').hide();
          }
        }

        function showErrorAlert(reason, detail) {
          var msg = '';
          if (reason === 'unsupported-file-type') {
            msg = "Unsupported format " + detail;
          } else {
            console.log("error uploading file", reason, detail);
          }
          $('<div class="alert"> <button type="button" class="close" data-dismiss="alert">&times;</button>' +
            '<strong>File upload error</strong> ' + msg + ' </div>').prependTo('#alerts');
        }

        initToolbarBootstrapBindings();

        $('#editor').wysiwyg({
          fileUploadError: showErrorAlert
        });

        window.prettyPrint;
        prettyPrint();
      });
    </script>
    <!-- /bootstrap-wysiwyg -->
	
	
    <script>
		$(document).ready(function() {
			$("#bast").bind('change', function(){
				//alert(this.files[0].size/1024/1024);
				if(this.files[0].size/1024/1024>2){
					$("#bast").val("");
					$("#errorBast").text('File BAST terlalu > 2 MB , upload ulang BAST');
				}else if($("#bast").val().split('.').pop().toLowerCase()!="pdf"){
					$("#bast").val("");
					$("#errorBast").text('File BAST harus PDF , upload ulang BAST');
				}
				else{
					$("#errorBast").text('');
				}			
			});
			
			$("#foto").bind('change', function(){
				var ext=["jpg","png","jpeg"]
				if(this.files[0].size/1024/1024>2){
		
					$("#foto").val("");
					$("#errorFoto").text('File foto terlalu > 2 MB , upload ulang foto');
					
				}else if($.inArray($("#foto").val().split('.').pop().toLowerCase(),ext)==-1){
						$("#foto").val("");
					$("#errorFoto").text('File BAST harus .jpg, .jpeg, atau .png , upload ulang BAST');
				
				}
				else{
					$("#errorFoto").text('');
				}					
			});
			
		});
	</script>
	  
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

        $('[id=tabelStok]').dataTable(
       	{
       		 paginate: false
       	}
        );
        
        $('[id=tabelStok2]').dataTable();

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

        var $datatable = $('#datatable-checkbox');

        $datatable.dataTable({
          'order': [[ 1, 'asc' ]],
          'columnDefs': [
            { orderable: false, targets: [0] }
          ]
        });
		
        $datatable.on('draw.dt', function() {
          $('input').iCheck({
            checkboxClass: 'icheckbox_flat-green'
          });
        });

        TableManageButtons.init();
      });
    </script>
    <!-- /Datatables -->
	
  </body>
</html>
