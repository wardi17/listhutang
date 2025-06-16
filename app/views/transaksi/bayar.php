
<?php

$datapost =$data["datapost"];
$kelompok =$data["kelompok"];

$bulan = $data["bulan"];
$nama_bulan = $data["nama_bulan"];
$tgl =$datapost["tanggal"];
$setdate = date("m/d/Y",strtotime($tgl));
$bln_sk = date("m");

$amount = $datapost["amount_sisa"];
$amount_bayar = $datapost["amount_bayar"];
$keterangan = $datapost["keterangan"];

$ket_sub = $keterangan;
//str_replace("RB-","",$keterangan);
$amount_lama = $datapost["amount_bayar"];

$set_kelompok =$datapost["kelompok"];
$id_trans = $datapost["Id_Trans"];
// $bln_sekarang = (int)$bln_sk;
// $bln_pilih = (int)$bulan;

// if($bln_sekarang == $bln_pilih){
//   $setdate =date("Y-m-d");
// }else{
//   $tgl = $tahun."-".$bulan."-"."1";
//   $setdate =date("Y-m-d",strtotime($tgl));
// }


$userlog = (isset( $_SESSION['login_user']))?  $_SESSION['login_user'] : '';
?>
<style>
      input[type="file"]{
        display: none;
    }
    .error {
      color: red;
    }

    .ldBar path.mainline {
    stroke-width: 10;
    stroke: #09f;
    stroke-linecap: round;
  }
  .ldBar path.baseline {
    stroke-width: 14;
    stroke: #f1f2f3;
    stroke-linecap: round;
    filter:url(#custom-shadow);
  }

  .loading-spinner{
  width:30px;
  height:30px;
  border:2px solid indigo;
  border-radius:50%;
  border-top-color:#0001;
  display:inline-block;
  animation:loadingspinner .7s linear infinite;
}
@keyframes loadingspinner{
  0%{
    transform:rotate(0deg)
  }
  100%{
    transform:rotate(360deg)
  }
}
  </style>
<div id="main">
       <header class="mb-3">
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
                             <div class="col-md-1">
                            <button onclick="goBack()" type="button" class="btn btn-lg text-start"><i class="fa-solid fa-chevron-left"></i></button>
                            </div>
                            <div class ="col-md-11">
                            <h5 class="text-center">Bayar Transaksi Bulan <?=$nama_bulan?></h5>
                            </div>
                          </div>
                        
                        </div>
                          <div class="card-body">
                          <input type="hidden" class="form-control" id="amountbayar_lama" value="<?=$amount_lama?>">
                            <input type="hidden" id="id_trans" value="<?=$id_trans?>"/>
                        <form  id ="formtambah" class ="form form-horizontal" enctype="multipart/form-data">
                                <div class="row col-md-12-col-12">
                                <div class="row col-md-12 mb-3">
                                                <label for="tanggal" style="width:10%;" class="col-sm-3 form-label">Tanggal Input</label>
                                            <div class="col-sm-2">
                                                <input  disabled  id="tanggal" type="text" value="<?=$setdate?>" class="form-control">
                                            </div>
                                      </div>
                                      <div class="row col-md-12 mb-3">
                                                <label for="tanggal_bayar" style="width:10%;" class="col-sm-3 form-label">Tanggal Bayar</label>
                                            <div class="col-sm-2">
                                                <input   id="tanggal_bayar" type="date"  class="form-control">
                                            </div>
                                      </div>
                                <div class="row col-md-12 mb-3">
                                                <label  style="width:10%;" for="amonut" class="col-sm-3 form-label">Amonut</label>
                                            <div class="col-sm-4">
                                                <input disabled id="amonut" name="amonut" value="<?=$amount?>" type="text" class="form-control">
                                                <span id="amonutError" class="error"></span>
                                            </div>
                                </div>
                                <div class="row col-md-12 mb-3">
                                                <label  style="width:10%;" for="amonut_bayar" class="col-sm-3 form-label">Amonut Bayar</label>
                                            <div class="col-sm-4">
                                                <input  id="amonut_bayar" name="amonut_bayar" value="<?=$amount_bayar?>" type="text" class="form-control">
                                                <span id="amonut_bayarError" class="error"></span>
                                            </div>
                                </div>
                                    <div class="row mb-12 mb-2">
                                         <label  for="kelompok" style="width:10%;" class="col-sm-2 col-form-label">Kelompok</label>
                                          <div class="col-sm-6">
                                            <?php foreach ($kelompok as $item):?>
                                            
                                          <div class="form-check">
                                            <input disabled class="form-check-input" type="radio" name="kelompok" value="<?=$item?>" id="<?=$item?>">
                                            <label class="form-check-label" for="<?=$item?>">
                                            <?=$item?>
                                            </label>
                                          </div>
                                       <?php endforeach;?>
                                          <span id="kelompokError" class="error"></span>
                                        </div>
                                    </div>

                                    <div class="row col-md-12 mb-3">
                                                <label  style="width:10%;" for="keterangan" class="col-sm-3 form-label">Ket</label>
                                            <div class="col-sm-4">
                                                <input disabled id="keterangan" name="keterangan" type="text" value="<?=$ket_sub?>" class="form-control">
                                                <span id="keteranganError" class="error"></span>
                                            </div>
                                    </div>
                                                <div class="row mb-12 mb-2">
                                                        <label for="catatan" style="width:10%;" class="col-sm-3 col-form-label">Catatan</label>
                                                        <div class="col-sm-4">
                                                        <textarea type="text" style="width:150%;" id="catatan" class="form-control"></textarea>
                                                        <span id="catatanError" class="error"></span>
                                                        </div>
                                                    </div>
                            
                    
                                            </div>
                                            <div class="col-sm-11 d-flex justify-content-end">
                                                    <button  type="sumbit" id="Createdata" name="sumbit" class="btn btn-primary me-1 mb-3">Save</button>
                                                    <button type="button" class="btn btn-secondary me-1 mb-3" onclick="goBack();">Batal</button>
                                                </div>
                        </form>
      </div>
    </div>
    <div>
                          
                                </div>  
  </div>
  </div>

  <script>
  $(document).ready(function(){
    settanggal();
    setdatakelompok();
    $('#amonut_bayar').on('keyup', function() {
                var inputVal = $(this).val().replace(/[^,\d]/g, ''); // Menghapus karakter selain angka dan koma
                var formattedVal = formatRupiah(inputVal);
                $(this).val(formattedVal);
            });

    $("#Createdata").on("click",function(e){
      e.preventDefault();
      let data =validasiinput(event);
      if(data !==false){
                $.ajax({
                 url:"<?=base_url?>/transaksi/bayarapp",
                        method:"POST",
                        dataType: "json",
                        data:data,
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
                            showConfirmButton: false,
                             timer:300
                          }).then(function(){ 
                            goBack();
                          });
                        }
                });
            }else{
              Swal.fire({
                            position: 'top-center',
                            icon: "info",
                            title:"Amount Bayar tidak boleh melebih Amount",
                            showConfirmButton: false,
                             timer:50000
                          })
            }
    });


  })//batas document ready
  function settanggal(){
    var d = new Date();
      var month = d.getMonth()+1;
      var day = d.getDate();
      let  output = d.getFullYear()+ '-' +
                  (month<10 ? '0' : '') + month + '-' +
                  (day<10 ? '0' : '') + day 
                  
      $("#tanggal_bayar").val(output);
  }
  function goBack(){
      //$("#submbiback").click();
      window.location.replace("<?=base_url?>/transaksi/listbayar");
    }
  function  validasiinput(event){
        const amonut = $("#amonut_bayar").val();
                if (amonut ==="0" || amonut ==="") {
                    $("#amonut_bayarError").text("amount bayar harus di isi");
                    event.preventDefault(); // Menghentikan pengiriman formulir jika ada kesalahan
                } else {
                    $("#amonut_bayarError").text("");
                }
       
        let  kelompok = $('input[name="kelompok"]:checked').val();
        if (kelompok ===undefined) {
            $("#kelompokError").text(" kelompok harus di pilih");
            event.preventDefault(); // Menghentikan pengiriman formulir jika ada kesalahan
          }else {
            $("#kelompokError").text("");
          }
        const catatan = $("#catatan").val();
        const tanggal = $("#tanggal_bayar").val();
        const id_trans =$("#id_trans").val();
        const userid = "<?= trim($userlog)?>";

        const ket  = $("#keterangan").val();
       
        if (ket ==="") {
                    $("#keteranganError").text("Keterangan harus di isi");
                    event.preventDefault(); // Menghentikan pengiriman formulir jika ada kesalahan
                } else {
                    $("#keteranganError").text("");
                }

        let split_tgl =tanggal.split("-");
        const bln_filih = "<?=$bulan?>";   
        let month = bln_filih.padStart(2, '0');  
     
        let tgl_new =split_tgl[0]+"-"+month+"-"+split_tgl[2];
     

        const amount_input = $("#amonut").val();
        let replace_saldo = amount_input.replace(/\./g,""); 
        let replace_bayar = amonut.replace(/\./g,""); 
              
        const amountbayar_lama =$("#amountbayar_lama").val();
        let replace_bayarlama = amountbayar_lama.replace(/\./g,""); 

        let new_bayar = parseFloat(replace_bayarlama) + parseFloat(replace_bayar) ;
     
        // if( parseFloat(replace_bayar) > parseFloat(replace_saldo)){
        //   $("#amonut_bayarError").text("amount bayar tidak boleh melebihi Amonut");
        //   event.preventDefault(); 
        // }else{
        //    $("#kelompokError").text("");
        // }
        if(amonut !=="" && amonut !=="0"){
            
            const datas ={
                "userid":userid,
                "id_trans":id_trans,
                "tanggal_bayar":tgl_new,
                "amonut_bayar":new_bayar,
                "catatan":catatan,
            }

      
      
          return  datas;
      }else{
          return false;
      }
    }
  
  function formatRupiah(angka, prefix) {
            var number_string = angka.replace(/[^,\d]/g, '').toString(),
                split = number_string.split(','),
                sisa = split[0].length % 3,
                rupiah = split[0].substr(0, sisa),
                ribuan = split[0].substr(sisa).match(/\d{3}/gi);
            if (ribuan) {
                separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }

            rupiah = split[1] !== undefined ? rupiah + ',' + split[1] : rupiah;
            return prefix === undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
        }
    function setdatakelompok(){

      const  setkelompok ="<?=$set_kelompok?>";
      if(setkelompok !==""){
        let id  = "#"+setkelompok;
        $(id).prop("checked", true);
      }
 
      

    }
  </script>