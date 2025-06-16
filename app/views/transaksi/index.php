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
              <h5 class="text-center">Input Transaksi</h5>
              </div>
              <div class="card-body">
              <div class ="row col-md-12 col-12">
                <!-- <h3 class="text-center">Target upload</h3> -->
                  
                    <div  class="col-md-8">
                        <form id="form_filter">
                                    <div class=" row col-md-8">
                                    <label for="tahun" class="col-sm-2 form-label">Tahun</label>
                                    <div style="width:25%;" class="col-md-2">
                                          <select class ="form-control" id="filter_tahun"></select>
                                        </div>
                              
                                    </div>
                                </form>
                
                    </div> 
                    <div id="divsatu"></div>
                    <div class="row col-md-12">
                   
                    <div id="divdua"></div>
                    </div>
               
            </div>
               
              </div>
              </div>
              <!-- /.card-body -->
            </div>
      </div>
<script>
  $(document).ready(function(){
    get_tahun();
    settahun();
    const tahun =$("#filter_tahun").find(":selected").val();

    getData(tahun);


      $("#filter_tahun").on("change",function(e){
        const tahun =$(this).find(":selected").val();
        getData(tahun);
      })
  }); //batas document ready

    function getData(tahun){
        
    $.ajax({
                  url:"<?=base_url?>/transaksi/getdata",
                  data:{"tahun":tahun},
                  method:"POST",
                  dataType: "json",
               /*   beforeSend: function(){
                      Swal.fire({
                        title: 'Loading',
                        html: 'Please wait...',
                        allowEscapeKey: false,
                        allowOutsideClick: false,
                        didOpen: () => {
                        Swal.showLoading()
                    }
                        });
                    },*/
                  success:function(result){
                    Set_Tabel(result);
                    // Swal.fire({
                    //   position: 'top-center',
                    //   icon: "success",
                    //   showConfirmButton: false,
                    //    timer: 1500
                    // }).then(function(){ 
                      
                      
                    // });
                     
  
                  }
      });
    }

    function Set_Tabel(result){
      const dateya = new Date();
      let bulandefault;
      let currentahun = dateya.getFullYear();

      const tahun =$("#filter_tahun").find(":selected").val();
      if(tahun == currentahun){
          bulandefault =dateya.getMonth()+1;
      }else{
        bulandefault =1;
       
      }
   
        let divsatu =``;
        let divgabung =``;
        let divdua =``;
        divgabung +=`<div class="row col-md-12">`;
        $.each(result,function(a,b){
        

          if(b.bulan <= 6){
             divsatu +=`
             <div class="row col-md-6 mt-4">
                    <label for="bulan" class="col-sm-3 col-form-label">${b.nama_bulan}</label>
                        <div class="row col-md-6">
                                    <div class="col-sm-6" style="width:80%">
                                          <input disabled type="text" id="" class="form-control" value="${b.amount}">
                                    </div>`;

                    //if(b.bulan == bulandefault){
                       divsatu +=`
                                          <div class="col-sm-2">
                                          <form role="form" action="<?= base_url; ?>/transaksi/forminput" method="POST" enctype="multipart/form-data">
                                              <input type="hidden" class="form-control"name="tahun" value ="${b.tahun}">
                                              <input type="hidden" class="form-control"name="nama_bulan" value ="${b.nama_bulan}">
                                              <input type="hidden" class="form-control"name="bulan" value ="${b.bulan}">
                                                <button type="submit" id="submbiback"  class="btn btn-info"><i class="fa-solid fa-plus text-primary"></i></button>
                                            </form>
                                    </div>
                          `;
                   // }else{
                   // divsatu +=`<div></div>`;
                   // }
                  divsatu +=`</div>
                          </div>`;
                    

          }else{
            divdua +=`
             <div class="row col-md-6 mt-4">
                    <label for="bulan" class="col-sm-3 col-form-label">${b.nama_bulan}</label>
                        <div class="row col-md-6">
                                    <div class="col-sm-6" style="width:80%">
                                          <input disabled type="text" id="" class="form-control" value="${b.amount}">
                                    </div>`;

                   // if(b.bulan >= bulandefault && tahun == currentahun ){
                      divdua +=`
                                          <div class="col-sm-2">
                                          <form role="form" action="<?= base_url; ?>/transaksi/forminput" method="POST" enctype="multipart/form-data">
                                              <input type="hidden" class="form-control"name="tahun" value ="${b.tahun}">
                                              <input type="hidden" class="form-control"name="nama_bulan" value ="${b.nama_bulan}">
                                              <input type="hidden" class="form-control"name="bulan" value ="${b.bulan}">
                                                <button type="submit" id="submbiback"  class="btn btn-info"><i class="fa-solid fa-plus text-primary"></i></button>
                                            </form>
                                    </div>
                          `;
                   // }else{
                   //   divsatu +=`<div></div>`; 
                   // }
                    divdua +=` </div>
                          </div>`;
          }
         
        });
    
        divgabung +=divsatu;
        divgabung +=divdua;
        divgabung +=`</div>`;
        $("#divsatu").empty().html(divgabung);
       
    }
  function get_tahun(){
       let startyear = 2020;
       let date = new Date().getFullYear();
       let endyear = date + 2;
       for(let i = startyear; i <=endyear; i++){
         var selected = (i !== date) ? 'selected' : date; 

        $("#filter_tahun").append($(`<option />`).val(i).html(i).prop('selected', selected));
       }
      }
  function settahun(){
    const dateya = new Date();
    let bulandefault = dateya.getMonth()+1;
    let tahundefault = dateya.getFullYear();
    let tahun = tahundefault;
    $("#filter_tahun").val(tahun);

  }
</script>