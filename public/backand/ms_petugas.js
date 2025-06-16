class ms_petugas {


    
    get_tampildata(url){
        let set_url =url+"/masterpetugas/tampildata";
     
        $.ajax({
                  url:set_url,
                  method:'GET',
                  cache:true,
                  dataType:'json',
                  success:function(result){
                       
                      let  datatable =``;

                        datatable =` <table id="Tablepetugas" class="display table-info" style='width:100%'>                    
                                                    <thead class="thead">
                                                    <tr>
                                                                <th>Nama</th>
                                                                <th>Jabatan</th>
                                                                <th>Divisi</th>
                                                                <th>Email</th>
                                                                <th>Action</th>

                                                    </tr>
                                                    </thead>
                                                    <tbody>`;

                      $.each(result,function(a,b){
                      
                        datatable +=`
                                          <tr>
                                            <td >${b.nama}</td>
                                            <td>${b.jabatan}</td>
                                            <td>${b.divisi}</td>
                                            <td>${b.email}</td>
                                            <td>
                                            <button type="button"data-id="${b.id_petugas}" data-divisi="${b.divisi}" data-nama="${b.nama}" data-email ="${b.email}" data-jabatan="${b.jabatan}" class=" open-Petugas btn btn-lg btn-space"
                                             data-bs-toggle="modal" data-bs-target="#EditModal_petugas"><i class="fa-regular fa-pen-to-square"></i></button>
                                            </td>
                                            `;
                                            datatable+=`</tr>`;
                      });
                      datatable+=`</tbody>
							        <tfoot>
                            <tr>
                              <th></th>
                              <th></th>
                              <th></th>
                              <th></th>
                              <th></th>
                            </tr>
                          </tfoot>
                        </table>`;
                      $("#tampildata").empty().html(datatable);
                      const obj = new ms_petugas();

                      obj.datatbl();
                  }
                });
    }

     datatbl(){
      $("#Tablepetugas").DataTable({
                    response:true,
                    "ordering": false,
                    "destroy":true,
                    // dom: 'Plfrtip',
                    //     scrollCollapse: true,
                    paging:true,
                    //     "bPaginate":false,
                    //     "bLengthChange": false,
                    //     "bFilter": true,
                    //     "bInfo": false,
                    //     "bAutoWidth": false,
                    //     dom: 'lrt',
                        fixedColumns:   {
                        // left: 1,
                            right: 1
                        },
                        pageLength: 5,
                        lengthMenu: [[5, 10, 20, -1], [5, 10, 20, 'All']],
                                    
                });
     }


     
      Savedata(url,datas){
        let seturl = url+"/masterpetugas/createdate";
        $.ajax({
                  url:seturl,
                  method:'POST',
                  data:datas,
                  cache:true,
                  dataType:'json',
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
                  success:function(response){
                    const nilai = response.nilai;
                    const pesan = response.error;
                    if(nilai == 1){
                        Swal.fire({
                            position: 'top-center',
                            icon: "success",
                            title:pesan,
                            showConfirmButton: false,
                             timer: 1500
                          }).then(function(){
                            $("#TambaModal_petugas").modal("hide"); 
                            $("#nama").val("");
                            $("#email").val("");
                            $("#jabatan").val("");
                            $("#nama").val("");
                            $("#divis").val("");
                            const obj = new ms_petugas();

                            return obj.datatbl();
                          });
                    }else{
                        Swal.fire({
                            position: 'top-center',
                            icon: "warning",
                            title:pesan,
                            showConfirmButton: false,
                             timer: 1500
                          }).then(function(){ 
                            $("#TambaModal_petugas").modal("hide"); 
                          });
                          
                          const obj = new ms_petugas();

                            return obj.datatbl();
                    }
                   

                  }
        })
    }

    UpdateData(url,datas){
        let seturl = url+"/masterpetugas/updatedate";
        $.ajax({
                  url:seturl,
                  method:'POST',
                  data:datas,
                  cache:true,
                  dataType:'json',
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
                  success:function(response){
                    const nilai = response.nilai;
                    const pesan = response.error;
                    if(nilai == 1){
                        Swal.fire({
                            position: 'top-center',
                            icon: "success",
                            title:pesan,
                            showConfirmButton: false,
                             timer: 1500
                          }).then(function(){
                            $("#EditModal_petugas").modal("hide"); 
                            const obj = new ms_petugas();

                            return obj.datatbl();
                          });
                    }else{
                        Swal.fire({
                            position: 'top-center',
                            icon: "warning",
                            title:pesan,
                            showConfirmButton: false,
                             timer: 1500
                          }).then(function(){ 
                            $("#EditModal_petugas").modal("hide"); 
                          });
                          
                          const obj = new ms_petugas();

                            return obj.datatbl();
                    }
                  }
        })
    }



    DeleteData(url,datas){
        let seturl = url+"/masterpetugas/deletedate";

        $.ajax({
            url:seturl,
            method:'POST',
            data:datas,
            cache:true,
            dataType:'json',
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
            success:function(response){
                const nilai = response.nilai;
                const pesan = response.error;
                if(nilai == 1){
                    Swal.fire({
                        position: 'top-center',
                        icon: "success",
                        title:pesan,
                        showConfirmButton: false,
                         //timer: 1500
                      }).then(function(){
                        $("#EditModal_petugas").modal("hide"); 
                        const obj = new ms_petugas();

                        return obj.datatbl();
                      });
                }else{
                    Swal.fire({
                        position: 'top-center',
                        icon: "warning",
                        title:pesan,
                        showConfirmButton: false,
                         //timer: 1500
                      }).then(function(){ 
                        $("#EditModal_petugas").modal("hide"); 
                      });
                      
                      const obj = new ms_petugas();

                        return obj.datatbl();
                }
            }

        });
    }
}