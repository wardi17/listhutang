<?php
date_default_timezone_set('Asia/Jakarta');
$hariIni = new DateTime();

$formathari = $hariIni->format('F Y');


?>
<style>


/* table {
    font-size:12px !important; /* Ubah ukuran teks sesuai kebutuhan 
} */

 /* table targert*/
#tebelatas th,#tebelatas td{
  font-size:9px !important;
  border: none !important;
  background-color: white !important; 
}
 /* and table targert*/
 .nobaris {
  border: none !important;
  background-color: white !important;
 }
 .barisfootkanan {
  border-left: none;
  
  background-color:#F5F7F8  !important;
 }
 .barisfootkiri {
  border-right: none;
  background-color:#F5F7F8  !important;
 }

 .barisfoottengah {
  border-left: none;
  border-right: none;
  background-color:#F5F7F8  !important;
 }

 th,td {
    font-size:9px;
     border: 1px solid black; /* Menambahkan garis pada sel */
    padding: 1px !important; /* Memberikan ruang di dalam sel */
    text-align: left /* Ubah ukuran teks header */
}
th {
            background-color: #f2f2f2; /* Warna latar belakang untuk header */
        }
        /* tr,td {
            height:25px; /* Ubah tinggi baris 
        } */

.libur{
  color:red !important;
  /* font-weight: bold;*/
}
.tdklibur{
  color:black !important;
  /* font-weight: bold;*/
}
.bg_hari{
 /* font-weight: bold;*/
  background-color: #F0EAAC !important; 
}
.text_gltotal{
  font-weight: bold;
  background-color:#B3E2A7  !important;
  border: 1px solid black !important; 
}
.targetharian{
  background-color:#D1E9F6  !important;
}

.notbload {
  font-weight: normal  !important;
  background-color:#F5F7F8  !important;
}
  /* tfoot tabel*/
  tfoot{
    background-color: white !important; 
  }
 /* and tfoot tabel*/

 #filterdata,#printBtn ,#footerid,#cetakjpg{
  font-size:10px;/* Menambahkan garis pada sel */
  padding: 1px !important; /* Memberikan ruang di dalam sel */
 }

 .form-control,.btnsumbit{
  font-size:10px;
 }

 .text-right-footer {
    display: inline-block; /* Agar teks bisa diposisikan */
    text-align: right; /* Mengatur teks menjadi rata kanan */
    position: absolute; /* Mengatur posisi teks */
    right: 0; /* Menempelkan teks ke sisi kanan */
}
.haritotal{
  font-weight: bold;
}

.sam_judul{

  background-color:#D5ED9F  !important;
}

.perkiraan{
  background-color:#F0EAAC  !important;
}

.gratoalbawah{
  background-color: #BBE9FF !important;
}

.printdate{
  text-align: right  !important;
  font-size:9px !important;
  font-style: italic !important;
}
</style>
  <div class="">
<div class ="col-md-12 col-12">
        <div class="card">
            <div class="card-content balikprint">
            <div class="card-body">
            <div  class="page-heading mb-3">
                  <div class="page-title">
                  <!--  <h6 class="text-start">Sales PT Bindex International</h6>
                 
                 <h6>Hari : <span id="harikerja"></span></h6> -->
                  </div>
                </div>
                <div id="filterdata" class=" row col-md-12">
                    <div class="row col-md-2" style="width:18%;">  
                                <label style="width:35%;" for="selectahun" class="col-sm-2 col-form-label">Tahun</label>
                                <div class="col-sm-6">
                                  <select class ="form-control" id="selectahun"></select>                             
                              </div>
                      </div>  
                      <div class="row col-md-4" style="width:18%;">  
                                <label style="width:30%;"  for="selecbulan" class="col-sm-2 col-form-label">Bulan</label>
                                <div class="col-sm-8">
                                  <select class ="form-control" id="selecbulan"></select>                                
                                </div>
                        </div>
                        <div style="width:18%;" class="row col-md-3">
                        <label  style="width:30%;" class="col-sm-2 col-form-label">From</label>
                                    <div  style="width:70%;" class ="col-md-6">
                                       <input type="date" class=" form-control" id="tgl_from" name="tgl_from">
                                    </div>
						              </div>
                         
                            <div style="width:18%;" class="row col-md-4">
                            <label style="width:25%;" class="col-sm-2 col-form-label">To</label>
                                    <div style="width:75%;" class = "col-md-6">
                                       <input type="date" class=" form-control" id="tgl_to" name="tgl_to">
                                    </div>
                            </div>
                        <div style="width:15%;"  class="col-sm-2">
                                    <button  type="sumbit" name="sumbit" class=" btnsumbit btn btn-primary me-1 mb-3" id="Createdata">Sumbit</button>
                                  </div>
                </div>
               
                <div id="tampildata"></div>     
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

  
        
      $(document).on("click","#printBtn",function() {
      $("#filterdata").hide();
      $("#printBtn").hide();
      $("#footerid").hide();
      $("#dateprint").show();
      $("#cetakjpg").hide();
      const  date_to = $("#tgl_to").val();
       let splite = date_to.split("-");
       let tgl = splite[2];
       let bln = $("#selecbulan").find(":selected").val();
       let thn = splite[0];
       let bln_indo =convertindo(bln);
       

       let judul = 'LHP PT Bindex per tgl'+' '+tgl+' '+bln_indo+' '+ thn;
      document.title = judul;
       window.print();
      showtombol();
      
    });

    $(document).on("click","#cetakjpg",function(){
      const  date_to = $("#tgl_to").val();
       let splite = date_to.split("-");
       let tgl = splite[2];
       let bln = $("#selecbulan").find(":selected").val();
       let thn = splite[0];
       let bln_indo =convertindo(bln);
       

       let judul = 'LHP PT Bindex per tgl'+' '+tgl+' '+bln_indo+' '+ thn;
       
      
     $("#filterdata").hide();
      $("#printBtn").hide();
      $("#cetakjpg").hide();
      $("#footerid").hide();
      html2canvas(document.querySelector(".balikprint")).then(canvas => {
            let image = canvas.toDataURL("image/jpeg", 1.0);
            let link = document.createElement('a');
            link.href = image;
            link.download = judul+'.jpg';
            link.click();
        });
        showtombol();
      
    });
      // const obj = new ms_petugas();


      // const url ="<?=base_url?>";

      // obj.get_tampildata(url);
      get_tahun();
      get_bulan();
      settahunbulan();
      gettanggal();
      $("#Createdata").on("click",function(e){
        e.preventDefault()
        let tahun = $("#selectahun").find(":selected").val();
        let bulan = $("#selecbulan").find(":selected").val();
        let tgl_from = $("#tgl_from").val();
        let tgl_to = $("#tgl_to").val();
        const datas ={
          "tahun":tahun,
          "bulan":bulan,
          "tgl_from":tgl_from,
          "tgl_to":tgl_to
        };
       
        setharikerja(datas)
        //Getdata(datas);

      });
      $("#selecbulan").on("change",function(){
      const tahun = $("#selectahun").find(":selected").val();
      const bulan = $(this).val();
      let bln = ubahNamaBulanKeAngka(bulan);
  
      // const datas ={
      //   "tahun":tahun,
      //   "bulan":bln
      // }
  
      setTanggalAwalAkhir(tahun,bln);
    })

      
}); //batas document ready jquery 2024 D war

function showtombol(){
  $("#filterdata").show();
  $("#printBtn").show();
  $("#footerid").show();
  $("#dateprint").hide();
  $("#cetakjpg").show();
  document.title ='sales';
}
function  gettanggal(){
	  let currentDate = new Date();
    // Mengatur tanggal pada objek Date ke 1 untuk mendapatkan awal bulan
    currentDate.setDate(1);
    // Membuat format tanggal YYYY-MM-DD
    let formattedDate = currentDate.toISOString().slice(0,10);
    // Menampilkan hasil
    $("#tgl_from").val(formattedDate);
	
    let d = new Date();
      let month = d.getMonth()+1;
      let day = d.getDate();
      let  output =  d.getFullYear() +'-'+
					(month<10 ? '0' : '') + month + '-' +
				 (day<10 ? '0' : '') + day;
    $("#tgl_to").val(output);

 

}

function setTanggalAwalAkhir(tahun,bulan){
    let currentDate = new Date();
    // Mengatur tanggal pada objek Date ke 1 untuk mendapatkan awal bulan
    currentDate.setDate(1);
    let formattedDate = currentDate.toISOString().split('T')[0];
   
    let split = formattedDate.split('-');
    let tgl_awl = split[2];
    

    let set_tgl = tahun+'-'+(bulan<10 ? '0' : '')+ bulan + '-'+tgl_awl;
    let f = new Date(set_tgl)
    let tgl_awal = f.toISOString().slice(0,10);

    $("#tgl_from").val(tgl_awal);
    

    let lastDay = new Date(tahun, bulan, 0);
    let set_tglakh = moment(lastDay).format("YYYY-MM-DD");
    // let split_akh = dateString_.split('-');
    // console.log(dateString_);
    // let tgl_akh = split_akh[2];
    // let set_tglakh = tahun+'-'+(bulan<10 ? '0' : '')+ bulan + '-'+tgl_akh;

    $("#tgl_to").val(set_tglakh);



  }

        function  Getdata(datas){

          $.ajax({
              url:"<?=base_url?>/sales/Tampildata",
              method:"POST",
              cache:false,
              dataType:'json',
              success:function(responses){
                console.log(responses)
              }

          })
        }
      function setharikerja(datas){
         
        $.ajax({
              url:"<?=base_url?>/sales/getharikerja",
              method:"POST",
              data:datas,
              cache:false,
              dataType:'json',
              beforeSend :function(){    
                                Swal.fire({
                                    title: 'Loading...',
                                    html: 'Please wait...',
                                    allowEscapeKey: false,
                                    allowOutsideClick: false,
                                    didOpen: () => {
                                    Swal.showLoading()
                                    }
                                    });
                                },
              success:function(responses){
                          Swal.fire({
                                position: 'top-center',
                                icon: 'success',
                                showConfirmButton: false,
                                timer:10
                                }).then(function(){
                                SetTabeldata(responses,datas);
                                });
                            
              }

          })

      }

 
     function  SetTabeldata(responses,datas){
          let th = datas.tahun;
          let bln = datas.bulan;
          let target = responses.Target;
          let target2 = responses.Target2;
          let hk = responses.Hari;
          const detaildata = responses.Detaildata;
          let blnind = convertindo(bln);
          //     <input  type="button" id="cetakjpg" value="jpg">
          let Tabeldata =``;

            Tabeldata +=`
              <div class="row col-md-3">
                <div class="col-md-2" style="width:15%">
                       <input type="button" id="printBtn"  value="print">
                </div>
                 <div class="col-md-1">
              
                 </div>
              </div>
       
            `;
           Tabeldata +=`
              <div class="col-md-12 mt-2 mb-2">
                <table id="tebelatas" class="tebelatas mt-2 mb-2">
                <thed>
                  <tr>
                   <td>Sales PT Bindex International</td>
                    <td></td>
                  </tr>
                </thed>
                <tbody>
                  <tr>
                     <td> ${blnind} ${th}</td>
                  </tr>
                  <tr>

                    <td>Target &nbsp;&nbsp;&nbsp;: 
                    &nbsp; Rp.&nbsp;${target} &nbsp;&nbsp;&nbsp; <span class="targetharian">Rp.&nbsp;${target2}</span></td>
                  
                  </tr>
                  <tr>
                    <td>Hari &nbsp;&nbsp;&nbsp; &nbsp; : 
                    &nbsp; &nbsp;${hk}</td>
                  </tr>
                </tbody>
                </table>
              </div>
           `;

        Tabeldata +=``;
        Tabeldata +=`
          <table id="Tabel1" styles="font-size: 8px;" class="display table-hover table-info" style='width:100%'>
          <div  class="printdate">PrintDate &nbsp;: <span id="clock"></span>&nbsp;&nbsp;&nbsp;&nbsp;</div>                    
                                                    <thead class="notbload">
                                                    <tr>
                                                                <td rowspan="3" style="width:3%" class="text-center">TGL</td>
                                                                <td style="width:12%" rowspan="3" class="text-center">HARI</td>
                                                                <td colspan="5" class="text-center">OFFLINE</td>
                                                                <td style="width:6%" rowspan="2" class="text-center">ONLINE</td>
                                                                <td  style="width:6%" rowspan="3" class="text-center">TOTAL</td>
                                                                <td  style="width:7%" rowspan="3" class="text-center">ACCUMULATION</td>
                                                                <td style="width:7%" rowspan="3" class="text-center">CURRENT DAY </br>TARGETS</td>
                                                                <td style="width:7%" rowspan="3" class="text-center">ACHIEVEMENT </br>%</td>
                                                                <td style="width:7%" rowspan="3" class="text-center">PROJECTION </br>Rp</td>
                                                                <td style="width:7%" rowspan="3" class="text-center">ACHIEVEMENT </br>%</td>
                                                                <td style="width:7%" rowspan="3" class="text-center">GRAND TOTAL </br>Rp</td>
                                                              
                                                    </tr>
                                                    <tr>
                                                    <td style="width:6%" class="text-center">CORPORATE</td>
                                                    <td style="width:6%" class="text-center">DEALER</td>
                                                    <td style="width:6%" class="text-center">DEPSTORE</td>
                                                    <td style="width:6%" class="text-center">STORE</td>
                                                    <td style="width:6%" class="text-center">USER</td>
                                                    </tr>
                                                      <tr>
                                                      <td class="text-center">Harian</td>
                                                      <td class="text-center">Harian</td>
                                                      <td class="text-center">Harian</td>
                                                      <td class="text-center">Harian</td>
                                                      <td class="text-center">Harian</td>
                                                      <td class="text-center">Harian</td>
                                                      </tr>
                                                    </thead>
                                                    <tbody>
        `;

       let total_hariini =``;
       let total_harikemaren =``;
       let projection_hariini =``;
       let acc1_hariini =``;
      $.each(detaildata,function(a,b){
          let text_color =``;
          let bghari=``;
            if(b.Hari =="Minggu" || b.Hari =="Sabtu" ){
              text_color ="libur";
            }else{
              text_color ="tdklibur";
            }
         
          if(b.Tgl == (responses.hariini-1)){
            total_harikemaren =b.Accumulation;
          }
          if(b.Tgl == responses.hariini){
            total_hariini =b.Total;
            projection_hariini =b.Projection;
            bghari="bg_hari";
            acc1_hariini=b.Achivement1;
          }else{
            bghari="";
          }

         
          if(b.Tgl <= responses.hariini){
            Tabeldata +=`
              <td class="${bghari} ${text_color} text-center">${b.Tgl}</td>
              <td class=" ${bghari} ${text_color} text-center">${b.Hari}</td>
              <td class="${bghari}  ${text_color} text-end">${b.Corporate == 0 ?'-' : b.Corporate}&nbsp;</td>
              <td class="${bghari} ${text_color} text-end">${b.Dealer == 0 ?'-' : b.Dealer}&nbsp;</td>
              <td class="${bghari} ${text_color} text-end">${b.Depstore == 0 ?'-' :b.Depstore}&nbsp;</td>
              <td class="${bghari} ${text_color} text-end">${b.Store == 0 ?'-':b.Store}&nbsp;</td>
              <td class="${bghari} ${text_color} text-end">${b.Users == 0 ?'-':b.Users}&nbsp;</td>
              <td class="${bghari} ${text_color} text-end">${b.Online == 0 ?'-':b.Online}&nbsp;</td>

              <td class="haritotal ${bghari} ${text_color} text-end">${b.Total == 0 ?'-':b.Total}&nbsp;</td>
              <td class="${bghari} ${text_color} text-end">${b.Accumulation == 0 ?'':b.Accumulation}&nbsp;</td>
              <td class="${bghari} ${text_color} text-end">${b.Current_day_targets}&nbsp;</td>
              <td class="${bghari} ${text_color} text-end">${b.Achivement1 =='0,00' ?'':b.Achivement1+'%'}&nbsp;</td>
              <td class="${bghari} ${text_color} text-end">${b.Projection == 0 ?'':b.Projection}&nbsp;</td>
              <td class="${bghari} ${text_color} text-end">${b.Achivement2 =='0,00'?'':b.Achivement2+'%'}&nbsp;</td>
            `;
          }else{

       

          Tabeldata +=`
              <td class="${bghari} ${text_color} text-center">${b.Tgl}</td>
              <td class=" ${bghari} ${text_color} text-center">${b.Hari}</td>
              <td class="${bghari}  ${text_color} text-end">${b.Corporate == 0 ?'' : b.Corporate}&nbsp;</td>
              <td class="${bghari} ${text_color} text-end">${b.Dealer == 0 ?'' : b.Dealer}&nbsp;</td>
              <td class="${bghari} ${text_color} text-end">${b.Depstore == 0 ?'' :b.Depstore}&nbsp;</td>
              <td class="${bghari} ${text_color} text-end">${b.Store == 0 ?'':b.Store}&nbsp;</td>
              <td class="${bghari} ${text_color} text-end">${b.Users == 0 ?'':b.Users}&nbsp;</td>
              <td class="${bghari} ${text_color} text-end">${b.Online == 0 ?'':b.Online}&nbsp;</td>

              <td class="haritotal ${bghari} ${text_color} text-end">${b.Total == 0 ?'':b.Total}&nbsp;</td>
              <td class="${bghari} ${text_color} text-end">${b.Accumulation == 0 ?'':b.Accumulation}&nbsp;</td>
              <td class="${bghari} ${text_color} text-end">${b.Current_day_targets}&nbsp;</td>
              <td class="${bghari} ${text_color} text-end">${b.Achivement1 =='0,00' ?'':b.Achivement1+'%'}&nbsp;</td>
              <td class="${bghari} ${text_color} text-end">${b.Projection == 0 ?'':b.Projection}&nbsp;</td>
              <td class="${bghari} ${text_color} text-end">${b.Achivement2 =='0,00'?'':b.Achivement2+'%'}&nbsp;</td>
            `;
          }
            if(b.Tgl == responses.rowspan1){
                Tabeldata += `<td class="text_gltotal text-end">${responses.w1}&nbsp;</td>`;
            }else if(b.Tgl == responses.rowspan2){
              Tabeldata += `<td class="text_gltotal text-end">${responses.w2}&nbsp;</td>`;
            }else if(b.Tgl == responses.rowspan3){
              Tabeldata += `<td class="text_gltotal text-end">${responses.w3}&nbsp;</td>`;
            }else if(b.Tgl == responses.rowspan4){
              Tabeldata += `<td class="text_gltotal text-end">${responses.w4}&nbsp;</td>`;
            }else{
        Tabeldata += `<td class="text-end"></td>`;
            }
      Tabeldata += `</tr>`;

       
      })
    Tabeldata +=`</tbody>`;
    Tabeldata +=`<tfoot class="notbload">`;
    Tabeldata +=`
              <tr>
              <td colspan="2">&nbsp;TOTAL</td>
              <td class="text-end">${responses.totalCorporate == 0 ?'-':responses.totalCorporate}&nbsp;</td>
              <td class="text-end">${responses.totalDealer == 0 ?'-': responses.totalDealer}&nbsp;</td>
              <td class="text-end">${responses.totalDepstore == 0 ?'-': responses.totalDepstore}&nbsp;</td>
              <td class="text-end">${responses.totalStore == 0 ?'-':responses.totalStore}&nbsp;</td>
              <td class="text-end">${responses.totalUsers == 0 ?'-':responses.totalUsers}&nbsp;</td>
              <td class="text-end">${responses.totalOnline ==0 ?'-':responses.totalOnline}&nbsp;</td>
              <td class="nobaris"></td>
              <td class="nobaris"></td>
              <td class="nobaris"></td>
              <td  class="nobaris"></td>
              <td  class="nobaris"></td>
              <td  class="nobaris"></td>
              <td class="text_gltotal text-end" >${responses.total_week}&nbsp;</td>
              </tr>
          `;
    Tabeldata +=`
              <tr>
              <td colspan="2">&nbsp;TARGET</td>
              <td class="text-end">${responses.TargetCorporate}&nbsp;</td>
              <td  class="text-end" >${responses.TargetDealer}&nbsp;</td>
              <td  class="text-end">${responses.TargetDepstore}&nbsp;</td>
              <td  class="text-end" >${responses.TargetStore}&nbsp;</td>
              <td  class="text-end" >${responses.TargetUsers}&nbsp;</td>
              <td  class="text-end">${responses.TargetOnline}&nbsp;</td>
              <td  class="nobaris"></td>
              <td colspan="5" class="sam_judul text-center">LAPORAN PENJUALAN PT BINDEX INTERNATIONAL 1-${hk} ${blnind} ${th}</td>

              <td  class="nobaris"></td>
              <td  class="nobaris"></td>
              </tr>
          `;
   Tabeldata +=`
              <tr>
              <td colspan="2">&nbsp;KEKURANGAN TARGET</td>
              <td  class="text-end">${responses.krg_cor}&nbsp;</td>
              <td  class="text-end">${responses.krg_der}&nbsp;</td>
              <td  class="text-end">${responses.krg_dep}&nbsp;</td>
              <td  class="text-end">${responses.krg_sto}&nbsp;</td>
              <td  class="text-end">${responses.krg_use}&nbsp;</td>
              <td  class="text-end">${responses.krg_onl}&nbsp;</td>
              <td class="nobaris"></td>
              <td colspan="4" class="" >&nbsp;Penjualan Tgl ${responses.hariini}  ${blnind} ${th}</td>
              <td class="text-end"> ${total_hariini} &nbsp;</td>
              <td class="nobaris"></td>
              <td class="nobaris"></td>
              </tr>
          `;
          
    Tabeldata +=`
              <tr>
              <td colspan="2">&nbsp;% Prediksi Pencapaian sd Akhir Bln</td>
              <td  class="text-center">${responses.prediksi_Corporate}%&nbsp;</td>
              <td  class="text-center">${responses.prediksi_Dealer}%&nbsp;</td>
              <td  class="text-center">${responses.prediksi_Depstore}%&nbsp;</td>
              <td  class="text-center">${responses.prediksi_Store}%&nbsp;</td>
              <td  class="text-center">${responses.prediksi_Users}%&nbsp;</td>
              <td  class="text-center">${responses.prediksi_Online}%&nbsp;</td>
              <td class="nobaris"></td>

              <td colspan="4" class="">&nbsp;Penjualan Tgl 1-${responses.hariini -1} ${blnind} ${th}</td>
              <td class="text-end">${total_harikemaren} &nbsp;</td>
              <td class="nobaris"></td>
              <td class="nobaris"></td>
              </tr>
          `;
    Tabeldata +=`
              <tr>
              <td colspan="2"  class="gratoalbawah">&nbsp;GRAND TOTAL</td>
              <td  class="text-end gratoalbawah">${responses.garand_total}&nbsp;</td>
              <td class="text-center gratoalbawah">${acc1_hariini+'%'}&nbsp;</td>
              <td class="nobaris"> </td>
              <td class="nobaris"> </td>
             <td class="nobaris"> </td>
             <td class="nobaris"> </td>
              <td class="nobaris"></td>
              <td colspan="4" class="">&nbsp;GRAND TOTAL</td>
              <td class="text-end">${responses.garand_total} &nbsp;</td>
              </tr>
          `;
    Tabeldata +=`
              <tr>
              <td colspan="2" class="gratoalbawah">&nbsp;TOTAL TARGET</td>
              <td  class="text-end gratoalbawah">${responses.total_target}&nbsp;</td>
              <td class="gratoalbawah"></td>
              <td class="nobaris"></td>
              <td class="nobaris"></td>
              <td class="nobaris"></td>
              <td class="nobaris"></td>
              <td class="nobaris"></td>
              <td colspan="4" class="perkiraan">&nbsp;Perkiraan Penjualan (${hk} Hari)</td>
              <td class="text-end perkiraan">${projection_hariini}&nbsp;&nbsp;</td>
              </tr>
          `;
    Tabeldata +=`</tfoot>`; 
      Tabeldata +=`</table>`;

           $("#tampildata").empty().html(Tabeldata);
           //datatale12();


           updateClock(); // Update immediately
           setInterval(updateClock, 1000);
           $(".dateprint").hide();
}

function updateClock() {
  const now = new Date();
            const day = now.getDate().toString().padStart(2, '0');
            const month = (now.getMonth() + 1).toString().padStart(2, '0'); // Months are zero-indexed
            const year = now.getFullYear();

            const hours = now.getHours().toString().padStart(2, '0');
            const minutes = now.getMinutes().toString().padStart(2, '0');
            const seconds = now.getSeconds().toString().padStart(2, '0');

            const formattedDate = `${day}-${month}-${year}`;
            const formattedTime = `${hours}:${minutes}:${seconds}`;
            $('#clock').text(`${formattedDate} ${formattedTime}`);
        }

   



      function settahunbulan(){
        const dateya = new Date();
        let bulandefault = dateya.getMonth()+1;
        let tahundefault = dateya.getFullYear();
        let tahun = tahundefault;

 
        $("#selectahun").val(tahun);
        let bln = bulan_angka(bulandefault);
   
        $("#selecbulan").val(bln);
      }
      function get_tahun(){
        
        let startyear = 2020;
        let date = new Date().getFullYear();
        
        let endyear = date + 2;
        
        for(let i = startyear; i <=endyear; i++){
          let selected = (i !== date) ? 'selected' : date; 
          $("#selectahun").append($(`<option />`).val(i).html(i).prop('selected', selected));

        }
    }

    function get_bulan(){
      let seletBulan = $("#selecbulan");
      const namaBulan = [
        "January", "February", "March", "April", "May", "June",
        "July", "August", "September", "October", "November", "December"
      ];
    
      for(let a = 0 ; a < namaBulan.length; a++){
        let option = $('<option>',{
          value: namaBulan[a] ,
          text: namaBulan[a]
        });
        seletBulan.append(option);
      }
    } 

    function bulan_angka(angkaBulan){
        const namaBulan2 = [
          "January", "February", "March", "April", "May", "June",
          "July", "August", "September", "October", "November", "December"
        ];

        // Pastikan angkaBulan berada dalam rentang 1 hingga 12
        if (angkaBulan >= 1 && angkaBulan <= 12) {
          return namaBulan2[angkaBulan - 1];
        } else {
          return "Bulan tidak valid";
        }

    }

    function ubahNamaBulanKeAngka(namaBulan) {
    // Cari indeks bulan
    const bulan = [
          "January", "February", "March", "April", "May", "June",
          "July", "August", "September", "October", "November", "December"
        ];
    const index = bulan.indexOf(namaBulan);
    
    // Jika nama bulan ditemukan, kembalikan indeks + 1 (karena bulan dimulai dari 1)
    if (index !== -1) {
        return index + 1;
    } else {
        // Jika tidak ditemukan, kembalikan nilai yang sesuai, misalnya null atau 0
        return null;
    }
}


function convertindo(englishMonth) {
    const monthMapping = {
        "January": "Januari",
        "February": "Februari",
        "March": "Maret",
        "April": "April",
        "May": "Mei",
        "June": "Juni",
        "July": "Juli",
        "August": "Agustus",
        "September": "September",
        "October": "Oktober",
        "November": "November",
        "December": "Desember"
    };

    return monthMapping[englishMonth] || "Bulan tidak valid";
}
</script>