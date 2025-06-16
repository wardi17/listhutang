<?php
$listdata =$data["listdata"];



$userlog = (isset( $_SESSION['login_user']))?  $_SESSION['login_user'] : '';
?>
<style>
    .thead{
        background-color:#E7CEA6;
        /* font-size: 8px;
        font-weight: 100 !important; 
        color :#000000; */
      }
	#tabel1_filter{ 
	  padding-bottom: 20px !important;
	}
	
	.dataTables_filter{
		 padding-bottom: 20px !important;
	}
	
  /* td,th {
    border: 0.5px solid  !important;
    padding: 1px  !important;
    text-align: left
  } */
  /* .dataTable th, .dataTable tr, .dataTable td {
    border: 1px !important;
    padding: 1px  !important;
} */
		
		.table-hover tbody tr:hover td, .table-hover tbody tr:hover th {
		  background-color: #F3FEB8;
		}

    .colorread{
      color:red !important;
    }

    .textblack{
      color:black !important;
    }

  form {
    width:100%;
    height: 2% !important;
  margin: 0 auto;
}

  #frompacking{
        width:100%;
        height: 2% !important;
      margin: 0 auto;
  }
</style>

<div id="main">
       <header class="mb-3">
       <input type="hidden" id="usernama" class="form-control" value="<?=$userlog?>">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header>
    <!-- Content Header (Page header) -->
    <div class ="col-md-12 col-12">
            <!-- Default box -->
            <div class="card">
              <div class="card-header">
              <div class="row col-md-12">
                             <!-- <div class="col-md-1">
                            <button onclick="goBack()" type="button" class="btn btn-lg text-start"><i class="fa-solid fa-chevron-left"></i></button>
                            </div> -->
                            <div class ="col-md-11">
                            <h5 class="text-center">List Transaksi</h5>
                            </div>
                          </div>
              </div>
              <div class="card-body">
      
                <table id="tabel1" class='table table-striped table-bordered  table-hover' style='width:100%;'>                    
                                              <thead  id='thead'class ='thead'>
                                               <tr>
                                                  <th style="width: 30px;" class="text-center">No</th>
                                                  <th style="width: 120px;">Supplier</th>
                                                  <th style="width: 120px;">No Invoice</th>
                                                  <th style="width: 120px;">Tanggal Invoice</th>
                                                  <th style="width: 120px;">JT Invoice</th>
                                                  <th style="width: 120px;">Rencana Bayar</th>
                                                  <th style="width: 100px;">Kelompok</th>
                                                  <th style="width: 150px;">Ket</th>
                                                  <th style="width: 150px;">Catatan</th>
                                                  <th style="width: 100px;" class="text-end">Amount</th>
                                                  <th style="width: 80px;" class="text-center">UserID</th>
                                                  <th style="width: 60px;">Action</th>
                                                 </tr>
                                                    
                                                    </thead>
                                                    <tbody>
                                                    <?php  $no =1;
                                                    $sub_amounty =0;
                                                    $sub_sisa =0;
                                                     foreach($listdata as $item): ?>
                                                        <?php
														
                                                      
                                                        ?>
                                                    <tr>
                                                      <td class="text-center"><?=$no++?></td>
                                                      <td class=""><?=$item["supplier"]?></td>
                                                      <td class=""><?=$item["noinvoice"]?></td>
                                                      <td class=""><?=$item["tanggal_invoice"]?></td>
                                                       <td class=""><?=$item["tanggal_jatuhtempo"]?></td>
                                                        <td class=""><?=$item["recan_bayar"]?></td>
                                                      <td class=""><?=$item["kelompok"]?></td>
                                                       <td class=""><?=$item["keterangan"]?></td>
                                                      <td class=""><?=$item["catatan"]?></td>
                                                      <td class="text-end"><?=$item["amount"];
                                                     ?></td>
                                                      <td  class="text-center"><?=$item["user_input"]?></td>
                                                      <td>
                                                      <form  id="frompacking" role="form" action="<?= base_url; ?>/transaksi/edit" method="POST" enctype="multipart/form-data">
                                                        <input type="hidden" name="Id_Trans" value ="<?=$item["Id_Trans"]?>">
                                                        <button style="width:50px; font-size: 10px"  type="submit" class="btn btn-primary btn btn-sm mt-1 mb-1">Edit</button>
                                                      </form>
                                                      </td>
                                                      <?php  endforeach; ?>
                                                    </tr>
                                                    </tbody>
                                         
                      </table>
                                            
              </div>
              </div>
              <!-- /.card-body -->
            </div>
      </div>
</div>

<script>
  $(document).ready(function(){
    tablelistedit();
  })



            function  tablelistedit(){
                const tabel1 = "#tabel1";
                $(tabel1).DataTable({
                    order: [[0, 'asc']],
                      responsive: true,
                      "ordering": true,
                      "destroy":true,
                      pageLength: 10,
                      lengthMenu: [[10, 20, -1], [10, 20, 'All']],
                      fixedColumns:   {
                          // left: 1,
                            right: 1
                        },
                        
                    })
                }
</script>