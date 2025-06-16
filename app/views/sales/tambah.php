
  <!-- Modal  tambah baru  member divisi-->
  <div class="modal fade" id="TambaModal_petugas" tabindex="-1" aria-labelledby="TambahModal_divisiLabel" aria-hidden="true">
        <div class="modal-dialog  modal-xl">
          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Tambah Master</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" onclick="closetambah()" aria-label="Close"></button>
            </div>
            <div class="modal-body">

      <form  id ="formtambah" class ="form form-horizontal" enctype="multipart/form-data">
        <div class="row col-md-12-col-12">
                            <div class="row col-md-12 mb-3">
                                <label for="nama" class="col-sm-2 form-label">Nama</label>
                               <div class="col-sm-4">
                                <input id="nama" name="nama" type="text" class="form-control">
                               </div>
                </div>
                <div class="row col-md-12 mb-3">
                                <label for="email" class="col-sm-2 form-label">Email</label>
                               <div class="col-sm-4">
                                <input id="email" name="email" type="email" class="form-control">
                               </div>
                </div>
                <div class="row col-md-12 mb-3">
                                <label for="jabatan" class="col-sm-2 form-label">Jabatan</label>
                               <div class="col-sm-4">
                                <input id="jabatan" name="jabatan" type="text" class="form-control">
                               </div>
                </div>
                <div class="row col-md-12 mb-3">
                                <label for="divisi" class="col-sm-2 form-label">Divisi</label>
                               <div class="col-sm-4">
                                <input id="divisi" name="divisi" type="text" class="form-control">
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
  </div>
  </div>

<script>
    $(document).ready(function(){
      const obj = new ms_petugas();
      
        $("#Createdata").on("click",function(e){
            e.preventDefault();
            const nama = $("#nama").val();
            const email = $("#email").val();
            const jabatan = $("#jabatan").val();
            const divisi = $("#divisi").val();

         
           const url ="<?=base_url?>";
            const datas ={
                "nama" :nama,
                "email":email,
                "jabatan":jabatan,
                "divisi":divisi
            }

            obj.Savedata(url,datas);
            
      })
    
    }) //batas document ready
   



    // function setdatatabl(result){
       
    // }
</script>