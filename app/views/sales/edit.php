
  <!-- Modal  tambah baru  member divisi-->
  <div class="modal fade" id="EditModal_petugas" tabindex="-1" aria-labelledby="EditModal_petugas" aria-hidden="true">
        <div class="modal-dialog  modal-xl">
          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Edit Master</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" onclick="closetambah()" aria-label="Close"></button>
            </div>
            <div class="modal-body">

      <form  id ="formtambah" class ="form form-horizontal" enctype="multipart/form-data">
      <input id="id_petugas" name="id_petugas" type="hidden" class="form-control">

          <div class="row col-md-12-col-12">
                            <div class="row col-md-12 mb-3">
                                <label for="nama_edit" class="col-sm-2 form-label">Nama</label>
                               <div class="col-sm-4">
                                <input id="nama_edit" name="nama_edit" type="text" class="form-control">
                               </div>
                </div>
                <div class="row col-md-12 mb-3">
                                <label for="email_edit" class="col-sm-2 form-label">Email</label>
                               <div class="col-sm-4">
                                <input id="email_edit" name="email_edit" type="email" class="form-control">
                               </div>
                </div>
                <div class="row col-md-12 mb-3">
                                <label for="jabatan_edit" class="col-sm-2 form-label">Jabatan</label>
                               <div class="col-sm-4">
                                <input id="jabatan_edit" name="jabatan_edit" type="text" class="form-control">
                               </div>
                </div>
                <div class="row col-md-12 mb-3">
                                <label for="divisi_edit" class="col-sm-2 form-label">Divisi</label>
                               <div class="col-sm-4">
                                <input id="divisi_edit" name="divisi_edit" type="text" class="form-control">
                               </div>
                </div>
              
    
                            </div>
                            <div class="col-sm-11 d-flex justify-content-end">
                                    <button  type="sumbit" id="UpdateData" name="sumbit" class="btn btn-info me-1 mb-3">Update</button>
                                    <button  type="sumbit" id="DeleteData" name="sumbit" class="btn btn-danger me-1 mb-3">Delete</button>
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
        $("#UpdateData").on("click",function(e){
            e.preventDefault();
            const nama = $("#nama_edit").val();
            const email = $("#email_edit").val();
            const jabatan = $("#jabatan_edit").val();
            const divisi = $("#divisi_edit").val();
            const id_petugas = $("#id_petugas").val();

            const datas ={
                "nama" :nama,
                "email":email,
                "jabatan":jabatan,
                "divisi":divisi,
                "id_petugas":id_petugas
            }
            const url ="<?=base_url?>";
            obj.UpdateData(url,datas);
            
      });


      $(document).on("click",".open-Petugas",function(){

        let id_petugas = $(this).data("id");
        let divisi = $(this).data("divisi");
        let nama = $(this).data("nama");
        let email = $(this).data("email");
        let jabatan = $(this).data("jabatan");

        $(".modal-body #id_petugas").val(id_petugas);
        $(".modal-body #divisi_edit").val(divisi);
        $(".modal-body #nama_edit").val(nama);
        $(".modal-body #email_edit").val(email);
        $(".modal-body #jabatan_edit").val(jabatan);
      })
    


      $("#DeleteData").on("click",function(e){
            e.preventDefault();
            const id_petugas = $("#id_petugas").val();
            const datas ={
                "id_petugas":id_petugas
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
                  const url ="<?=base_url?>";
                  obj.DeleteData(url,datas);
                }
              })
      });

    }) //batas document ready
   




</script>