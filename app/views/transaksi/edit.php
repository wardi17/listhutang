
<?php

$transaksi =$data["getdataedit"];
$kelompok =$data["kelompok"];

$userlog = (isset( $_SESSION['login_user']))?  $_SESSION['login_user'] : '';


$kol_terpilih = $transaksi["kelompok"];




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

/* Untuk Chrome, Safari, Edge, dan Opera */
        input[type=number]::-webkit-outer-spin-button,
        input[type=number]::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        /* Untuk Firefox */
        input[type=number] {
            -moz-appearance: textfield;
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
                            <h5 class="text-center">Edit Transaksi</h5>
                            </div>
                          </div>
                        
                        </div>
                          <div class="card-body">
                            <input type="hidden" id="id_trans" value="<?=$transaksi["Id_Trans"]?>"/>
                              <input type="hidden" id="Tgl_dibayarset" value="<?=$transaksi["Tgl_bayar"]?>"/>
                               <input type="hidden" id="Currencyset" value="<?=$transaksi["Currency"]?>"/>
                               <input type="hidden" id="Customerset" value="<?=$transaksi["Customer"]?>"/>
                               <input type="hidden" id="Kursset" value="<?=$transaksi["Kurs"]?>"/>

                        <form  id ="formtambah" class ="form form-horizontal" enctype="multipart/form-data">
                                 <div class="row col-md-12 mb-3">
                                                <label  style="width:10%;" for="Customer" class="col-sm-3 form-label">Supplier</label>
                                            <div class="col-sm-4">
                                               <select id="Customer" class="form-control"></select>
                                                <span id="CustomerError" class="error"></span>
                                            </div>
                                     </div> 
                        <div class="row col-md-12-col-12">
                                            <div class="row col-md-12 mb-3">
                                                <label for="noinvoice" style="width:10%;" class="col-sm-3 form-label">No Invoice</label>
                                            <div class="col-sm-2">
                                                <input   id="noinvoice" type="text" value="<?=$transaksi["noinvoice"]?>" class="form-control">
                                                  <span id="noinvoiceError" class="error"></span>
                                              </div>
                                </div>
                                <div class="row col-md-12-col-12">

                                        <div class="row col-md-12 mb-3">
                                                <label for="tanggal_invoice" style="width:10%;" class="col-sm-3 form-label">Tgl invoice</label>
                                            <div class="col-sm-2">
                                                <input   id="tanggal_invoice" type="date" value="<?=$transaksi["tanggal_invoice"]?>"  class="form-control">
                                                <span id="tanggal_invoiceError" class="error"></span>
                                              </div>
                                        </div>

                                        <div class="row col-md-12 mb-3">
                                                <label for="tanggal_jatuhtempo" style="width:10%;" class="col-sm-3 form-label">JT invoice</label>
                                            <div class="col-sm-2">
                                                <input   id="tanggal_jatuhtempo" type="date" value="<?=$transaksi["tanggal_jatuhtempo"]?>"  class="form-control">
                                                 <span id="tanggal_jatuhtempoError" class="error"></span>
                                              </div>
                                        </div>

                                <div class="row col-md-12 mb-3">
                                                <label  style="width:10%;" for="amonut" class="col-sm-3 form-label">Amonut</label>
                                            <div class="col-sm-4">
                                                <input id="amonut" name="amonut" value="<?=$transaksi["amount_input"]?>"  type="text" class="form-control">
                                                <span id="amonutError" class="error"></span>
                                            </div>
                                </div>
                                    <div class="row mb-12 mb-2">
                                         <label  for="kelompok" style="width:10%;" class="col-sm-2 col-form-label">Kelompok</label>
                                          <div class="col-sm-6">
                                            <?php foreach ($kelompok as $item):?>
                                            
                                          <div class="form-check">
                                            <input class="form-check-input" type="radio" name="kelompok" value="<?=$item?>" id="<?=$item?>"    <?= ($item == $kol_terpilih) ? 'checked' : '' ?>>
                                            <label class="form-check-label" for="<?=$item?>">
                                            <?=$item?>
                                            </label>
                                          </div>
                                       <?php endforeach;?>
                                          <span id="kelompokError" class="error"></span>
                                        </div>
                                    </div>
                                    <div id="tampilCurrrencry"></div>   
                               <div class="row align-items-center mb-3" id="barisPembayaran">
                                  <!-- Rencana Bayar -->
                                  <label for="recan_bayar" class="col-auto col-form-label">Rencana Bayar</label>
                                  <div class="col-md-2">
                                    <input id="recan_bayar" type="date" value="<?=$transaksi["recan_bayar"]?>" class="form-control">
                                  </div>

                                  <!-- Tempat tombol bayar / input tanggal bayar -->
                                  <div id="klikbayar" class="d-flex align-items-center col-md-6 gap-2"></div>
                                </div>


                                    <div class="row col-md-12 mb-3">
                                                <label  style="width:10%;" for="keterangan" class="col-sm-3 form-label">Ket</label>
                                            <div class="col-sm-4">
                                                <input id="keterangan" value="<?=$transaksi["keterangan"]?>"  name="keterangan" type="text" class="form-control">
                                                <span id="keteranganError" class="error"></span>
                                            </div>
                                    </div>
                                                <div class="row mb-12 mb-2">
                                                        <label for="catatan" style="width:10%;" class="col-sm-3 col-form-label">Catatan</label>
                                                        <div class="col-sm-4">
                                                        <textarea type="text" style="width:150%;" id="catatan"  value="<?=$transaksi["catatan"]?>"  class="form-control"><?=htmlspecialchars($transaksi["catatan"]); ?> </textarea>
                                                        <span id="catatanError" class="error"></span>
                                                        </div>
                                          </div>
                            
                    
                                            </div>
                                            <div class="col-sm-11 d-flex justify-content-end">
                                                    <button  type="sumbit" id="Updatedata" name="sumbit" class="btn btn-primary me-1 mb-3">Update</button>
                                                    <button  type="button" id="Deletedata"  class="btn btn-danger me-1 mb-3">Delete</button>
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
    $('#amonut').on('keyup', function() {
                var inputVal = $(this).val().replace(/[^,\d]/g, ''); // Menghapus karakter selain angka dan koma
                var formattedVal = formatRupiah(inputVal);
                $(this).val(formattedVal);
            });
    settanggaldibayar();
     getCustomer();    
 $(document).on('change', "input[name='kelompok']", function () {
      const selected = $(this).val();
      // Bersihkan area klikbayar
      $("#klikbayar").empty();
      $("#tampilCurrrencry").empty();
      // Jika bukan Supplier lokal atau Supplier import
      if (selected !== 'Supplier lokal' && selected !== 'Supplier import') {
        // Tampilkan tombol "Dibayarkan"
        const html = `<button type="button" class="btn btn-success" id="btndibayarkan">Dibayarkan</button>`;
        $("#klikbayar").html(html);
      }

       if(selected == 'Supplier import'){
        const html1 =`       <div class="row col-md-12 mb-3">
                                                <label  style="width:10%;" for="Currency" class="col-sm-3 form-label">Currency</label>
                                            <div class="col-sm-4">
                                               <select id="Currency" class="form-control"></select>
                                                <span id="CurrencyError" class="error"></span>
                                            </div>
                                     </div>
                                           <div class="row col-md-12 mb-3">
                                                <label  style="width:10%;" for="kurs" class="col-sm-3 form-label">Kurs(RP)</label>
                                            <div class="col-sm-4">
                                                <input id="kurs" name="kurs"  type="number" class="form-control">
                                                <span id="kursError" class="error"></span>
                                            </div>
                                </div>`;

          $("#tampilCurrrencry").html(html1);   
          getCurrency();
      }
    });

     $(document).on("click", "#btndibayarkan", function (event) {
          event.preventDefault();

          // Ganti tombol dengan input tanggal bayar
          const html = `
            <label for="tanggalbayar" class="col-auto col-form-label">Tanggal Bayar</label>
            <div class="col-auto">
              <input id="tanggalbayar" type="date" class="form-control">
            </div>`;
          
          $("#klikbayar").html(html);
        });

    $("#Updatedata").on("click",function(e){
      e.preventDefault();
      let data =validasiinput(event);
      if(data !==false){
                $.ajax({
                 url:"<?=base_url?>/transaksi/updatedata",
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
            }
    });

    $("#Deletedata").on("click",function(e){
      e.preventDefault();
   
         const id_trans = $("#id_trans").val();
     
        let datas ={
          "Id_Trans":id_trans,
        
        }
      
      Swal.fire({
                title: "Apakah Anda Yakin?",
                text: "Hapus Data Ini!",
                type: "warning",
                showDenyButton: true,
                confirmButtonColor: "#DD6B55",
                denyButtonColor: "#757575",
                confirmButtonText: "Ya, Hapus!",
                denyButtonText: "Tidak, Batal!",
              }).then((result) =>{
                if (result.isConfirmed) {
                  $.ajax({
                            url:"<?= base_url; ?>/transaksi/deletedata",
                            type:'POST',
                            dataType:'json',
                            data :datas,
                            success:function(result){
                            
                              let status = result.error;
                              Swal.fire({
                                position: 'top-center',
                                icon: "info",
                              title: status,
                              showConfirmButton: false,
                              timer: 10000
                              }).than(
                                goBack()
                              ); 
                            }
                          }); 

                }
              });
     })
  })//batas document ready
     const getCustomer=()=>{
        const Customerset = $("#Customerset").val();
      
       $.ajax({
                  url:"<?=base_url?>/transaksi/getCustomer",
                        method:"GET",
                        dataType: "json",
                        success:function(result){
                          if (result && Array.isArray(result)) {
                              let defaultOption = `<option value="" disabled ${!Customerset ? 'selected' : ''}>-- Pilih  --</option>`;
                              let mediaOptions = result.map(item =>{
                               let selected = item.id == Customerset ? 'selected' :'';
                               return `<option value="${item.id}">${item.nama}</option>`
                              }).join('');
                              $("#Customer").html(defaultOption+mediaOptions);
                            }
                        }
                });
   }

     const getCurrency=()=>{
        const Currencyset = $("#Currencyset").val();
       $.ajax({
                  url:"<?=base_url?>/transaksi/getCurrency",
                        method:"GET",
                        dataType: "json",
                        success:function(result){
                          if (result && Array.isArray(result)) {
                              let defaultOption = `<option value="" disabled ${!Currencyset ? 'selected' : ''}>-- Pilih  --</option>`;
                              let mediaOptions = result.map(item =>{
                               let selected = item.id == Currencyset ? 'selected' :'';
                               return `<option value="${item.id}">${item.id}</option>`
                              }).join('');
                              $("#Currency").html(defaultOption+mediaOptions);
                            }
                        }
                });
   }
   const settanggaldibayar=()=>{

      const Tgl_dibayarset = $("#Tgl_dibayarset").val();
      const Kursset        = $("#Kursset").val();
      let  selected = $('input[name="kelompok"]:checked').val();
      $("#klikbayar").empty();

      if(Tgl_dibayarset ==''){
         // Jika bukan Supplier lokal atau Supplier import
        if (selected !== 'Supplier lokal' && selected !== 'Supplier import') {
          // Tampilkan tombol "Dibayarkan"
          const html = `<button type="button" class="btn btn-success" id="btndibayarkan">Dibayarkan</button>`;
          $("#klikbayar").html(html);
        }
      }else{
          const html = `
            <label for="tanggalbayar" class="col-auto col-form-label">Tanggal Bayar</label>
            <div class="col-auto">
              <input id="tanggalbayar" type="date" value="${Tgl_dibayarset}" class="form-control">
            </div>`;
          
          $("#klikbayar").html(html);
      }
    
          if(selected == 'Supplier import'){
        const html1 =`       <div class="row col-md-12 mb-3">
                                                <label  style="width:10%;" for="Currency" class="col-sm-3 form-label">Currency</label>
                                            <div class="col-sm-4">
                                               <select id="Currency" class="form-control"></select>
                                                <span id="CurrencyError" class="error"></span>
                                            </div>
                                     </div>
                                           <div class="row col-md-12 mb-3">
                                                <label  style="width:10%;" for="kurs" class="col-sm-3 form-label">Kurs(RP)</label>
                                            <div class="col-sm-4">
                                                <input id="kurs" name="kurs"  type="number" value="${Kursset}" class="form-control">
                                                <span id="kursError" class="error"></span>
                                            </div>
                                </div>`;

          $("#tampilCurrrencry").html(html1);   
          getCurrency();
      }

    
   }
  function goBack(){
      //$("#submbiback").click();
      window.location.replace("<?=base_url?>/transaksi/listdata");
    }

  
   function  validasiinput(event){
      
          const noinvoice = $("#noinvoice").val();
                if (noinvoice ===undefined || noinvoice ==="") {
                    $("#noinvoiceError").text("noinvoice harus di isi");
                    event.preventDefault(); // Menghentikan pengiriman formulir jika ada kesalahan
                } else {
                    $("#noinvoiceError").text("");
                }
              const tanggal_invoice = $("#tanggal_invoice").val();
                if (tanggal_invoice ===undefined || tanggal_invoice ==="") {
                    $("#tanggal_invoiceError").text("tanggal_invoice harus di isi");
                    event.preventDefault(); // Menghentikan pengiriman formulir jika ada kesalahan
                } else {
                    $("#tanggal_invoiceError").text("");
                }

                const tanggal_jatuhtempo = $("#tanggal_jatuhtempo").val();
                if (tanggal_jatuhtempo ===undefined || tanggal_jatuhtempo ==="") {
                    $("#tanggal_jatuhtempoError").text("tanggal_jatuhtempo harus di isi");
                    event.preventDefault(); // Menghentikan pengiriman formulir jika ada kesalahan
                } else {
                    $("#tanggal_jatuhtempoError").text("");
                }

        const amonut = $("#amonut").val();
                if (amonut ==="0" || amonut ==="") {
                    $("#amonutError").text("amount harus di isi");
                    event.preventDefault(); // Menghentikan pengiriman formulir jika ada kesalahan
                } else {
                    $("#amonutError").text("");
                }

        let  kelompok = $('input[name="kelompok"]:checked').val();
        if (kelompok ===undefined) {
            $("#kelompokError").text(" kelompok harus di pilih");
            event.preventDefault(); // Menghentikan pengiriman formulir jika ada kesalahan
          }else {
            $("#kelompokError").text("");
          }
        const catatan = $("#catatan").val();
        const recan_bayar = $("#recan_bayar").val();
        const id_trans =$("#id_trans").val();
        const userid = "<?= trim($userlog)?>";

        const ket  = $("#keterangan").val();
        const Currency = $("#Currency").find(":selected").val();
        const kurs     = $("#kurs").val();
         const Customer = $("#Customer").find(":selected").val();
        let tglbayar = $("#tanggalbayar").val();
        let tanggalbayar = (tglbayar === undefined || tglbayar === null) ? '' : tglbayar;
        let curren = (Currency === undefined || Currency === null) ?'Rp' : Currency;
        let kurrest = (kurs === undefined || kurs === null) ? 0 : kurs;
         if (kelompok == 'Supplier lokal' && kelompok == 'Supplier import') {
            tanggalbayar ='';
         }

        if (ket ==="") {
                    $("#keteranganError").text("Keterangan harus di isi");
                    event.preventDefault(); // Menghentikan pengiriman formulir jika ada kesalahan
                } else {
                    $("#keteranganError").text("");
                }

       
      
        if(noinvoice !=""&& noinvoice !==undefined && tanggal_invoice !=""&& tanggal_invoice !==undefined &&
        tanggal_jatuhtempo !=""&& tanggal_jatuhtempo !==undefined && kelompok !=""&& kelompok !==undefined &&
        amonut !=="" && amonut !=="0"){
            let replace_saldo = amonut.replace(/\./g,""); 

            const datas ={
                "userid":userid,
                "id_trans":id_trans,
                "noinvoice":noinvoice,
                "tanggal_invoice":tanggal_invoice,
                "tanggal_jatuhtempo":tanggal_jatuhtempo,
                "amount":replace_saldo,
                "kelompok":kelompok,
                "recan_bayar":recan_bayar,
                "keterangan":ket,
                "catatan":catatan,
                "tanggalbayar":tanggalbayar,
                "Currency":curren,
                "kurs":kurrest,
                "Customer":Customer
            }

         // console.log(datas)
      
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

  </script>