<?php
$listdata =$data["listdata"];



$userlog = (isset( $_SESSION['login_user']))?  $_SESSION['login_user'] : '';
?>
<style>
    .thead{
        background-color:#E7CEA6;
        /* font-size: 8px;
        font-weight: 100 !important; */
     
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
    form {
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
                            <h5 class="text-center">List Bayar</h5>
                            </div>
                          </div>
              </div>
              <div class="card-body">
      
                <table id="tabel1" class='table table-striped table-bordered  table-hover' style='width:100%'>                    
                                              <thead  id='thead'class ='thead'>
                                                    <tr>
                                                                <th>No</th>
                                                                <th>Tanggal</th>
                                                                <th>Tanggal Bayar</th>
                                                                <th>Kelompok</th>
                                                                <th>Ket</th>
                                                                <th>Catatan</th>
                                                                <th class="text-end">Amount</th>
                                                                <th class="text-end">Amount Bayar</th>
                                                                <th class="text-end">Amount Sisa</th>
                                                                <th class="text-center">UserID</th>
                                                                <th>Action</th>

                                                    </tr>
                                                    
                                                    </thead>
                                                    <tbody>
                                                    <?php  $no =1;
                                                    $sub_amounty =0;
                                                    $sub_sisa =0;
                                                     foreach($listdata as $item): ?>
                                                <?php $exp =explode(" - ",$item["keterangan"]);
                                                         $ket = $exp[1];
                                                        ?>
                                                    <tr>
                                                      <td class=""><?=$no++?></td>
                                                      <td class=""><?=$item["tanggal"]?></td>
                                                      <td class=""><?=$item["tanggal_bayar"]?></td>
                                                      <td class=""><?=$item["kelompok"]?></td>
                                                      <td class=""><?=$ket?></td>
                                                      <td class=""><?=$item["catatan"]?></td>
                                                      <td class="text-end"><?=preg_replace('/\.(\d{3})/', ',$1',$item["amount_input"])?></td>
                                                      <td class=" text-end"><?=preg_replace('/\.(\d{3})/', ',$1',$item["amount_bayar"])?></td>
                                                      <td class=" text-end"><?=preg_replace('/\.(\d{3})/', ',$1',$item["amount_sisa"])?></td>
                                                      <td class="text-center"><?=$item["user_input"]?></td>
                                                      <td>
                                                      <form role="form" action="<?= base_url; ?>/transaksi/bayar" method="POST" enctype="multipart/form-data">
                                                        <input type="hidden" class="form-control"name="Id_Trans" value ="<?=$item["Id_Trans"]?>">
                                                        <input type="hidden" class="form-control"name="tanggal" value ="<?=$item["tanggal"]?>">
                                                        <input type="hidden" class="form-control"name="amount_sisa" value ="<?=$item["amount_sisa"]?>">
                                                        <input type="hidden" class="form-control"name="amount_bayar" value ="<?=$item["amount_bayar"]?>">
                                                        <input type="hidden" class="form-control"name="keterangan" value ="<?=$item["keterangan"]?>">
                                                        <input type="hidden" class="form-control"name="user_input" value ="<?=$item["user_input"]?>">
                                                        <input type="hidden" class="form-control"name="kelompok" value ="<?=$item["kelompok"]?>">
                                                        <button style="width:50px;  font-size:10px"  type="submit" class="btn btn-primary btn btn-sm mt-2 mb-1">Bayar</button>
                                                      </form>
                                                      </td>
                                                      <?php  endforeach; ?>
                                                    </tr>
                                                    </tbody>
                                                    <!-- <tfoot>
                                                      <th></th>
                                                      <th></th>
                                                      <th></th>
                                                      <th></th>
                                                      <th></th>
                                                      <th></th>
                                                      <th></th>
                                                      <th></th>
                                                      <th></th>
                                                      <th></th>
                                                      <th></th>
                                                    </tfoot> -->
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