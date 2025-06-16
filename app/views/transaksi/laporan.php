<?php
date_default_timezone_set('Asia/Jakarta');
$hariIni = new DateTime();

$formathari = $hariIni->format('F Y');
$kelompok =$data["kelompok"];




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
      
                        <div style="width:19%;" class="row col-md-4">
                        <label  style="width:30%;" class="col-sm-2 col-form-label">From</label>
                                    <div  style="width:70%;" class ="col-md-6">
                                       <input type="date" class=" form-control" id="tgl_from" name="tgl_from">
                                    </div>
						              </div>
                         
                            <div style="width:19%;" class="row col-md-4">
                            <label style="width:25%;" class="col-sm-2 col-form-label">To</label>
                                    <div style="width:70%;" class = "col-md-6">
                                       <input type="date" class=" form-control" id="tgl_to" name="tgl_to">
                                    </div>
                            </div>
                            <div style="width:27%;" class="row col-md-4">
                                        <label for="kelompok"   style="width:30%;" class="col-sm-3 col-form-label">Kelompok</label>
                                                  <div  class="col-sm-6">
                                                              <select  class="form-control" id="kelompok">
                                                              <option value="ALL"  selected>ALL</option>
                                                              <?php  foreach($kelompok as $file):
                                                                      ?>
                                                            <option value="<?= $file ?>"><?= $file ?></option>
                                                              <?php endforeach;?> 
                                                            </select>
                                                     
                                                          </div>
                                    </div>
                        <div style="width:10%;"  class="col-sm-2">
                                    <button  type="submit" name="submit" class="submit btn btn-primary me-1 mb-3" id="Createdata">Submit</button>
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
        let tgl_from = $("#tgl_from").val();
        let tgl_to = $("#tgl_to").val();
        let kelompok = $("#kelompok").find(":selected").val();
        const datas ={
          "tgl_from":tgl_from,
          "tgl_to":tgl_to,
          "kelompok":kelompok
        };
      
        getdatalaporan(datas)
      

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

    getdata();
}); //batas document ready jquery 2024 D war


function  getdata(){
  let tgl_from = $("#tgl_from").val();
        let tgl_to = $("#tgl_to").val();
        let kelompok = $("#kelompok").find(":selected").val();
        const datas ={
          "tgl_from":tgl_from,
          "tgl_to":tgl_to,
          "kelompok":kelompok
        };
        getdatalaporan(datas);
        console.log(datas);
}



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
      function getdatalaporan(datas){
         
        $.ajax({
              url:"<?=base_url?>/transaksi/getdatalaporan",
              method:"POST",
              data:datas,
              cache:false,
              dataType:'json',
            //   beforeSend :function(){    
            //                     Swal.fire({
            //                         title: 'Loading...',
            //                         html: 'Please wait...',
            //                         allowEscapeKey: false,
            //                         allowOutsideClick: false,
            //                         didOpen: () => {
            //                         Swal.showLoading()
            //                         }
            //                         });
            //                     },
              success:function(responses){
                setTablehider(responses);
                      
                        //   Swal.fire({
                        //         position: 'top-center',
                        //         icon: 'success',
                        //         showConfirmButton: false,
                        //         timer:10
                        //         }).then(function(){
                        //         SetTabeldata(responses,datas);
                        //         });
                            
              }

          })

      }

      function  setTablehider(responses){
        let dataTable=``;
         dataTable +=` <div class ="col-md-11 mt-4">
                            <h5 class="text-center">Laporan</h5>
                            </div>`;
        dataTable +=`
                                    <table id="table1" class="table table-striped table-hover" style='width:100%'>                    
                                                    <thead  id='thead'class ='thead'>
                                                      <tr>
                                                                <th>No</th>
                                                                <th>Tanggal</th>
                                                                <th>Tanggal Bayar</th>
                                                                <th class="text-end">Amount</th>
                                                                 <th class="text-end">Amount Bayar</th>
                                                                 <th class="text-end">Amount Sisa</th>
                                                                <th>Kelompok</th>
                                                                <th>Ket</th>
                                                                <th>Catatan Input</th>
                                                                <th>User Input</th>
                                                                <th>User Bayar</th>
                                                                <th>Catatan Bayar</th>
                                                               
                                                    </tr>
                                                    </thead>
                                                    <tbody>`;
            let no =1;
            let subtotal =0;
            $.each(responses,function(a,b){
                let amount =b.amount_input;
                let str =amount.replace(/\./g, ''); 
                subtotal +=parseFloat(str);
                 dataTable +=`<tr>`;
                 dataTable +=`<td>${no++}</td>
                 <td>${b.tanggal}</td>
                 <td>${b.tanggal_bayar}</td>
                 <td  class="text-end">${b.amount_input}</td>
                 <td  class="text-end">${b.amount_bayar}</td>
                 <td  class="text-end">${b.amount_sisa}</td>
                 <td>${b.kelompok}</td>
                 <td>${b.keterangan}</td>
                 <td>${b.catatan}</td>
                  <td>${b.user_input}</td>
                  <td>${b.user_bayar}</td>
                   <td>${b.catatan_bayar}</td>
                 `;
                 dataTable +=`</tr>`;
            });

            
            dataTable+=`</tbody>`;	
                  dataTable +=`<tfoot>`;
                  dataTable +=`<tr>
                                <th  class="text-end" colspan="3">Subtotal : </th>
                                <th  class="text-end" >${formatRupiah(subtotal.toString())}</th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                 <th></th>
                                <th></th>
                              </tr>`;
          dataTable +=`</tfoot></table>`;                                       
           $("#tampildata").empty().html(dataTable);
           tablelistedit();


           updateClock(); // Update immediately
           setInterval(updateClock, 1000);
           $(".dateprint").hide();
}
function  tablelistedit(){

                const tabel1 = "#table1";
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
                        
                    });
          }        
function formatRupiah(angka, prefix) {
            let number_string = angka.replace(/[^,\d]/g, '').toString(),
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