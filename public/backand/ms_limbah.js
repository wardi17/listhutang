class ms_limbah {


    
    get_tampildata(url){
        let set_url =url+"/masterjenislimbah/tampildata";
     
        $.ajax({
                  url:set_url,
                  method:'GET',
                  cache:true,
                  dataType:'json',
                  success:function(result){
                       
                      let  datatable =``;

                        datatable =` <table id="Table1" class="center display table-info" style='width:80%'>                    
                                                    <thead class="thead">
                                                    <tr>
                                                                <th>ID</th>
                                                                <th>Jenis Limbah</th>
                                                                <th>Action</th>

                                                    </tr>
                                                    </thead>
                                                    <tbody>`;

                      $.each(result,function(a,b){
                      
                        datatable +=`
                                          <tr>
                                            <td >${b.id_limbah}</td>
                                            <td>${b.jenis_limbah}</td>
                                            <td>
                                            <button type="button"data-id="${b.id_limbah}"  data-jenislimbah="${b.jenis_limbah}" class=" open-modal btn btn-lg btn-space"
                                             data-bs-toggle="modal" data-bs-target="#EditModal"><i class="fa-regular fa-pen-to-square"></i></button>
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
                      const obj = new ms_limbah();

                      obj.datatbl();
                  }
                });
    }

     datatbl(){
      $("#Table1").DataTable({
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
        let seturl = url+"/masterjenislimbah/createdate";
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
                             timer:0
                          }).then(function(){
                            $("#TambaModal").modal("hide"); 
                            $("#jenislimbah").val("");
                            const obj = new ms_limbah();

                            return obj.get_tampildata(url);
                          });
                    }else{
                        Swal.fire({
                            position: 'top-center',
                            icon: "warning",
                            title:pesan,
                            showConfirmButton: false,
                            timer:0
                          }).then(function(){ 
                            $("#TambaModal").modal("hide"); 
                          });
                          
                          const obj = new ms_limbah();

                          return obj.get_tampildata(url);
                    }
                   

                  }
        })
    }

    UpdateData(url,datas){
        let seturl = url+"/masterjenislimbah/updatedate";
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
                            timer:0
                          }).then(function(){
                            $("#EditModal").modal("hide"); 
                            const obj = new ms_limbah();

                            return obj.get_tampildata(url);
                          });
                    }else{
                        Swal.fire({
                            position: 'top-center',
                            icon: "warning",
                            title:pesan,
                            showConfirmButton: false,
                            timer:0
                          }).then(function(){ 
                            $("#EditModal").modal("hide"); 
                          });
                          
                          const obj = new ms_limbah();

                          return obj.get_tampildata(url);
                    }
                  }
        })
    }



    DeleteData(url,datas){
        let seturl = url+"/masterjenislimbah/deletedate";

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
                        $("#EditModal").modal("hide"); 
                        const obj = new ms_limbah();

                        return obj.get_tampildata(url);
                      });
                }else{
                    Swal.fire({
                        position: 'top-center',
                        icon: "warning",
                        title:pesan,
                        showConfirmButton: false,
                         //timer: 1500
                      }).then(function(){ 
                        $("#EditModal").modal("hide"); 
                      });
                      
                      const obj = new ms_limbah();

                      return obj.get_tampildata(url);
                }
            }

        });
    }
}