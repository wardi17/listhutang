<?php
date_default_timezone_set('Asia/Jakarta');
$hariIni = new DateTime();


$listbulan =$data["listbulan"];

$userlog = (isset( $_SESSION['login_user']))?  $_SESSION['login_user'] : '';


?>
<style>
    .thead{
        background-color:#E7CEA6 !important;;
        /* font-size: 8px;
        font-weight: 100 !important; */
        color :#000000 !important;
      }
table.dataTable thead th {
    background-color: #E7CEA6 !important; /* Gunakan !important untuk mengatasi konflik */
    color :#000000 !important;
}
     
	#tabel1_filter{ 
	  padding-bottom: 20px !important;
	}
	
	.dataTables_filter{
		 padding-bottom: 20px !important;
	}
	
	 
		
		.table-hover tbody tr:hover td, .table-hover tbody tr:hover th {
		  background-color: #F3FEB8;
		}

    .colorread{
      color:red !important;
    }

    .textblack{
      color:black !important;
    }
</style>
<div id="main">
<div class ="col-md-12 col-12">
        <div class="card">
            <div class="card-content balikprint">
            <div class="card-body">
            <div  class="page-heading mb-3">
                  <div class="page-title">
                 <h2 class="text-start"><b class="text-primary">Monthly Closing</b></h2>
                 
          
                  </div>
                </div>
                <div id="filterdata" class=" row col-md-12">
                <h4 class="text-start"><b style="color:black">General Ledger</b></h4>
                            <div style="width:40%;" class="row col-md-4">
                                        <label for="bulan"   style="width:35%;" class="col-sm-3 col-form-label">Closing Period &nbsp;&nbsp;:</label>
                                                  <div  class="col-sm-4">
                                                              <select  class="form-control" id="bulan">
                                                              <?php  foreach($listbulan as $file =>$key):
                                                                      ?>
                                                            <option value="<?= $file ?>"><?= $key ?></option>
                                                              <?php endforeach;?> 
                                                            </select>
                                                     
                                                          </div>
                                          <div style="width:20%;"  class="col-md-2">
                                                  <input type="text" disabled id="tahun" class="form-control" value="<?=date("Y")?>">
                                          </div>
                                    </div>
                                 
                                 
                        <div style="width:10%;"  class="col-sm-2">
                                    <button  type="submit" name="submit" class=" btnsumbit btn btn-primary me-1 mb-3" id="ClosingData">Submit</button>
                                  </div>
</div>
               
                <div id="tampildata"></div> 
                <!-- <div class="col-md-12">
                      <?php foreach($kelompok as $file):?>
                        <label><?=$file?></label> 
                        <?php endforeach;?>                                          
                </div>     -->
            </div>
                               
            </div>
            </div>
        </div>
  </div>
 
  <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>

  <script src="https://printjs-4de6.kxcdn.com/print.min.js"></script>
  <link rel="stylesheet" type="text/css" href="https://printjs-4de6.kxcdn.com/print.min.css">
<script>
    //   $(document).on("click", ".balikprint", function(){
    //     $("#filterdata").show();
    //     $("#printBtn").show();
    // });
    $(document).ready(function(){

      settahunbulan();

      $("#ClosingData").on("click",function(e){
        e.preventDefault()
        let bulan = $("#bulan").find(":selected").val();
        let tahun = $("#tahun").val();
        let userid ="<?=trim($userlog)?>";
        const datas ={
          "bulan":bulan,
          "tahun":tahun,
          "userid":userid
        };
      
        saveclosing(datas);
      
      

      });


}); //batas document ready jquery 2024 D war

function settahunbulan(){
        const dateya = new Date();
        let month = dateya.getMonth()+1;
        let bulan =(month<10 ? '0' : '') + month 
      
       $("#bulan").val(bulan)

      }



    function  saveclosing(datas){
      $.ajax({
                 url:"<?=base_url?>/transaksi/saveclosing",
                        method:"POST",
                        dataType: "json",
                        data:datas,
                        beforeSend: function(){
                            Swal.fire({
                                title: 'Loading',
                                html: 'Please wait...',
                                allowEscapeKey: false,
                                allowOutsideClick: false,
                            didOpen: () => {
                            Swal.showLoading()
                        }
                            });
                        },
                        success:function(result){
                          let pesan = result.error;
                          Swal.fire({
                            position: 'top-center',
                            icon: "success",
                            title:pesan,
                            showConfirmButton: true,
                            // timer:300
                          }).then(function(){ 
                            //goBack();
                          });
                        }
                });
    }

</script>