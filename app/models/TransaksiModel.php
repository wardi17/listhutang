<?php
class TransaksiModel{
    private $db;
    private $tbl_trans ="[um_db].[dbo].Listhutang";
    private $tbl_cur ="[bambi-bmi].[dbo].currency";
    private $tbl_sup ="[bambi-bmi].[dbo].supplier";
    public function __construct()
    {
      $this->db = new Database;
    }


    public function getCurrency(){
        $query ="SELECT CurrencyID,CurrName FROM $this->tbl_cur ORDER BY CurrencyID ASC";
        $result2 = $this->db->baca_sql($query);
            $datas = [];
            while(odbc_fetch_row($result2)){
            $datas[] = array(
              "id" =>rtrim(odbc_result($result2,'CurrencyID')),
              "nama"	=>rtrim(odbc_result($result2,'CurrName')),
            
            );
          }

          return $datas;
    }

   public function getCustomer(){
        $query ="SELECT CustomerID,CustName FROM $this->tbl_sup ORDER BY CustomerID ASC";
        $result2 = $this->db->baca_sql($query);
            $datas = [];
            while(odbc_fetch_row($result2)){
            $datas[] = array(
              "id" =>rtrim(odbc_result($result2,'CustomerID')),
              "nama"	=>rtrim(odbc_result($result2,'CustomerID'))." | ".rtrim(odbc_result($result2,'CustName'))
            
            );
          }

          return $datas;
    }

    protected 	function test_input($data) {
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
		}

    public function getListTransaksiByth($post){
     
        $tahun = $post["tahun"];
        $this->setTanggalbulan($tahun);
        $datas = $this->getdata($tahun);

        return $datas;
    }


    private function setTanggalbulan($tahun){
        $bulanindo = array(
            "January" => "Januari",
            "February" => "Februari",
            "March" => "Maret",
            "April" => "April",
            "May" => "Mei",
            "June" => "Juni",
            "July" => "Juli",
            "August" => "Agustus",
            "September" => "September",
            "October" => "Oktober",
            "November" => "November",
            "December" => "Desember"
        );
        for ($i = 1; $i <= 12; $i++) {
         
            $bulan_k = $i;
            $nama_bulan =$bulanindo[date('F', mktime(0, 0, 0, $i, 1))];
            $query ="USP_SimpanBulanListhutang '".$tahun."','".$nama_bulan."','".$bulan_k."'";
            $this->db->baca_sql($query);

        }
   }


   private function getdata($tahun){


    $query ="USP_TampilInputListhutang '".$tahun."'";

    //die(var_dump($query));
    $result2 = $this->db->baca_sql($query);
    $datas = [];
	  while(odbc_fetch_row($result2)){
	    $amountInput   = rtrim(odbc_result($result2, 'amount'));
          $formattedAmount = floor($amountInput) != $amountInput
                ? number_format($amountInput, 2, ".", ",")
                : number_format($amountInput, 0, ".", ",");
		  $datas[] = array(
			"tahun"=>rtrim(odbc_result($result2,'tahun')),
			 "bulan"=>(int)rtrim(odbc_result($result2,'bulan')),
        "nama_bulan"=>rtrim(odbc_result($result2,'nama_bulan')),
        "amount"=>$formattedAmount
		  );
		  
		  }
		


   
		  return $datas;
   }


      public function getListTransaksi($status){
        $tgl_sekarang = date("Y-m-d");
       // WHERE Tanggal_Input >='".$tgl_sekarang."'  
    
          $query ="SELECT Id_Trans,noinvoice,tanggal_invoice,tanggal_jatuhtempo,Keterangan,Amount_Input,Kelompok,SupplierID,
          recan_bayar,Keterangan,Catatan_Input,User_Input FROM $this->tbl_trans  ORDER BY  tanggal_invoice ASC ";
        
    
      
        $result2 = $this->db->baca_sql($query);
        $datas = [];
          while(odbc_fetch_row($result2)){
          
        $idTrans = rtrim(odbc_result($result2, 'Id_Trans'));
        $noinvoice = rtrim(odbc_result($result2, 'noinvoice'));
        $tglInvoiceRaw = trim(odbc_result($result2, 'tanggal_invoice'));
        $tglJatuhTempoRaw = trim(odbc_result($result2, 'tanggal_jatuhtempo'));
        $recanBayar = trim(odbc_result($result2, 'recan_bayar'));
        $amountInput = rtrim(odbc_result($result2, 'Amount_Input'));
        $keterangan = rtrim(odbc_result($result2, 'Keterangan'));
        $kelompok = rtrim(odbc_result($result2, 'Kelompok'));
        $catatan = rtrim(odbc_result($result2, 'Catatan_Input'));
        $userInput = rtrim(odbc_result($result2, 'User_Input'));
        $Supplierid = rtrim(odbc_result($result2, 'SupplierID'));

              $datas[] = array(
                  "Id_Trans" => $idTrans,
                  "noinvoice" => $noinvoice,
                  "tanggal_invoice" => !empty($tglInvoiceRaw) ? date("d-m-y", strtotime($tglInvoiceRaw)) : '',
                  "tanggal_jatuhtempo" => !empty($tglJatuhTempoRaw) ? date("d-m-y", strtotime($tglJatuhTempoRaw)) : '',
                  "amount" => number_format($amountInput/1000,3, ",", "."),
                  "recan_bayar" =>  (!empty($recanBayar) && $recanBayar != '1900-01-01 00:00:00.000')? date("d-m-y", strtotime($recanBayar)): '',
                  "keterangan" => $keterangan,
                  "kelompok" => $kelompok,
                  "catatan" => $catatan,
                  "user_input" => $userInput,
                  "supplier"  =>$Supplierid
              );
              }
   
      //  echo "<pre>";
      // print_r($datas);
      // echo "</pre>";
      // die();  
        return $datas;
      }


      
     public function SaveData($post){
     
     
        $userid             = $this->test_input($post["userid"]);
        $id_trans           = $this->test_input($post["id_trans"]);
        $noinvoice          = $this->test_input($post["noinvoice"]);
        $tanggal_invoice    = $this->test_input($post["tanggal_invoice"]);
        $tanggal_jatuhtempo = $this->test_input($post["tanggal_jatuhtempo"]);
        $amount             = $this->test_input($post["amount"]);
        $kelompok           = $this->test_input($post["kelompok"]);
        $recan_bayar        = $this->test_input($post["recan_bayar"]);
        $catatan            = $this->test_input($post["catatan"]);
        $keterangan         = $this->test_input($post["keterangan"]);
        $tanggalbayar       = $this->test_input($post["tanggalbayar"]);
        $Currency           = $this->test_input($post["Currency"]);
        $kurs               = $this->test_input($post["kurs"]);
        $Customer           = $this->test_input($post["Customer"]);
        $truck              = $this->test_input($post["truck"]);

         $statusCR ="";
         $tgl_bayar = "";

         if(!empty($tanggalbayar)){
           $statusCR ="Y";
           $tgl_bayar =$tanggalbayar;
            $last_update_CR = date("Y-m-d H:i:s");
         }else{
           $statusCR ="N";
            $tgl_bayar ="";
            $last_update_CR="";
         }
      

        $query ="
         IF NOT EXISTS(SELECT * FROM $this->tbl_trans WHERE Id_Trans='".$id_trans."')
            BEGIN
                INSERT INTO $this->tbl_trans (Id_Trans,noinvoice,tanggal_invoice,tanggal_jatuhtempo,Amount_Input,
                Kelompok,recan_bayar,Keterangan,Catatan_Input,User_Input,StatusCR,Tgl_bayar,last_update_CR,Currency,Kurs,SupplierID,truck)
              VALUES('".$id_trans."','".$noinvoice."','".$tanggal_invoice."','".$tanggal_jatuhtempo."','".$amount."',
              '".$kelompok."','".$recan_bayar."','".$keterangan."','".$catatan."','".$userid."','".$statusCR."',
              '".$tgl_bayar."','".$last_update_CR."','".$Currency."','".$kurs."','".$Customer."','".$truck."')
            END
        ";
  // echo "<pre>";
  //     print_r($query);
  //     echo "</pre>";
  //     die();  
        
        $cek =0;
        $result = $this->db->baca_sql($query);
        $response="Berhasil Simpan data";

               if(!$result){
               $cek =$cek+1;
               }
           
               if ($cek==0){
               $pesan['nilai']=1; //bernilai benar
               $pesan['error']=$response;
               }else{
               $pesan['nilai']=0; //bernilai benar
               $pesan['error']="Data Gagal Ditambahkan";
               }
               
           
               return $pesan;
        return $pesan;
     }


     public function getdataedit($id_trans){
            $query = "SELECT  Id_Trans,noinvoice,tanggal_invoice,tanggal_jatuhtempo,Amount_Input,SupplierID,
            Kelompok,recan_bayar,Keterangan,Catatan_Input,Tgl_bayar,Currency,Kurs,truck FROM $this->tbl_trans WHERE Id_Trans='".$id_trans."' ";

          
            $result2 = $this->db->baca_sql($query);
      $datas = [];

        while (odbc_fetch_row($result2)) {
            // Ambil dan simpan semua nilai kolom ke variabel
            $idTrans       = rtrim(odbc_result($result2, 'Id_Trans'));
            $noinvoice     = rtrim(odbc_result($result2, 'noinvoice'));
            $tglInvoice    = trim(odbc_result($result2, 'tanggal_invoice'));
            $tglJatuhTempo = trim(odbc_result($result2, 'tanggal_jatuhtempo'));
            $amountInput   = rtrim(odbc_result($result2, 'Amount_Input'));
            $recanBayar    = trim(odbc_result($result2, 'recan_bayar'));
            $kelompok      = rtrim(odbc_result($result2, 'Kelompok'));
            $keterangan    = rtrim(odbc_result($result2, 'Keterangan'));
            $catatan       = rtrim(odbc_result($result2, 'Catatan_Input'));
            $Currency      = trim(odbc_result($result2, 'Currency'));
            $Kurs          = trim(odbc_result($result2, 'Kurs'));
            $Customer      = trim(odbc_result($result2, 'SupplierID'));
            $Tgl_bayar     = trim(odbc_result($result2, 'Tgl_bayar'));
            $truck     = trim(odbc_result($result2, 'truck'));
            // Format tanggal jika tidak kosong
            $tanggalInvoiceFormatted = !empty($tglInvoice) ? date("Y-m-d", strtotime($tglInvoice)) : '';
            $tanggalJatuhTempoFormatted = !empty($tglJatuhTempo) ? date("Y-m-d", strtotime($tglJatuhTempo)) : '';
          
            $recanBayarFormatted = (!empty($recanBayar) && $recanBayar != '1900-01-01 00:00:00.000')
            ? date("Y-m-d", strtotime($recanBayar))
            : '';
           $Tgl_bayarFormatted = (!empty($Tgl_bayar) && $Tgl_bayar != '1900-01-01 00:00:00.000')
            ? date("Y-m-d", strtotime($Tgl_bayar))
            : '';
            // Ambil nama bulan (bisa ganti ke versi Indonesia kalau mau)
            $namaBulan = !empty($tglInvoice) ? date("F", strtotime($tglInvoice)) : '';
            $formattedAmount = floor($amountInput) != $amountInput
                ? number_format($amountInput, 2, ".", ",")
                : number_format($amountInput, 0, ".", ",");
            $datas = array(
                "Id_Trans"           => $idTrans,
                "noinvoice"          => $noinvoice,
                "tanggal_invoice"    => $tanggalInvoiceFormatted,
                "tanggal_jatuhtempo" => $tanggalJatuhTempoFormatted,
                "amount_input"       =>  $formattedAmount,
                "recan_bayar"        => $recanBayarFormatted,
                "kelompok"           => $kelompok,
                "keterangan"         => $keterangan,
                "catatan"            => $catatan,
                "nama_bulan"         => $namaBulan,
                "Tgl_bayar"          => $Tgl_bayarFormatted,
                "Currency"           =>$Currency,
                "Kurs"               =>floor($Kurs),
                "Customer"           =>$Customer,
                "truck"              =>$truck

            );
        }

 
  
      // echo "<pre>";
      // print_r($datas);
      // echo "</pre>";
      // die();      
      return $datas;

     }
   public function UpdateData($post){

      
        $userid             = $this->test_input($post["userid"]);
        $id_trans           = $this->test_input($post["id_trans"]);
        $noinvoice          = $this->test_input($post["noinvoice"]);
        $tanggal_invoice    = $this->test_input($post["tanggal_invoice"]);
        $tanggal_jatuhtempo = $this->test_input($post["tanggal_jatuhtempo"]);
        $amount             = $this->test_input($post["amount"]);
        $kelompok           = $this->test_input($post["kelompok"]);
        $recan_bayar        = $this->test_input($post["recan_bayar"]);
        $catatan            = $this->test_input($post["catatan"]);
        $keterangan         = $this->test_input($post["keterangan"]);
        $tanggalbayar       = $this->test_input($post["tanggalbayar"]);
        $Currency           = $this->test_input($post["Currency"]);
        $kurs               = $this->test_input($post["kurs"]);
        $Customer             = $this->test_input($post["Customer"]);
        $truck             = $this->test_input($post["truck"]);
        $tgl_comp = date("Y-m-d H:i:s");
    
         $statusCR ="";
         $tgl_bayar = "";


        
         if(!empty($tanggalbayar)){
           $statusCR ="Y";
           $tgl_bayar =$tanggalbayar;
            $last_update_CR = date("Y-m-d H:i:s");
         }else{
           $statusCR ="N";
            $tgl_bayar ="";
            $last_update_CR="";
         }

        $query ="UPDATE $this->tbl_trans SET noinvoice='".$noinvoice."',tanggal_invoice='".$tanggal_invoice."',recan_bayar='".$recan_bayar."',
         tanggal_jatuhtempo='".$tanggal_jatuhtempo."',Catatan_Input ='".$catatan."',Keterangan='".$keterangan."',Kelompok='".$kelompok."',
        Amount_Input='".$amount."', User_Edit='".$userid."',date_edit='".$tgl_comp."',
        StatusCR='".$statusCR."',Tgl_bayar='".$tgl_bayar."',last_update_CR='".$last_update_CR."',
        Currency='".$Currency."',Kurs='".$kurs."',SupplierID='".$Customer."',truck='".$truck."' 
        WHERE Id_Trans='".$id_trans."'
        ";
        // die(var_dump($query));
        $cek =0;
        $result = $this->db->baca_sql($query);
       

            if(!$result){
            $cek =$cek+1;
            }
        
            if ($cek==0){
            $pesan['nilai']=1; //bernilai benar
            $pesan['error']="Berhasil Update data";
            }else{
            $pesan['nilai']=0; //bernilai benar
            $pesan['error']="Data Gagal Ditambahkan";
            }
            
        
            return $pesan;
    }

       public function DeleteData($post){
        
        $id_trans =$this->test_input($post["Id_Trans"]);

        $query ="DELETE FROM $this->tbl_trans WHERE Id_Trans='".$id_trans."'";
        $cek =0;
        $result = $this->db->baca_sql($query);
       
            if(!$result){
            $cek =$cek+1;
            }
        
            if ($cek==0){
            $pesan['nilai']=1; //bernilai benar
            $pesan['error']="Berhasil Delete data";
            }else{
            $pesan['nilai']=0; //bernilai benar
            $pesan['error']="Data Gagal Delete Ditambahkan";
            }
            
        
            return $pesan;
    }

}
/*
     public function Laporantransaksi2($post,$status){
       
      
      $tgl_from =date("m/d/Y",strtotime($this->test_input($post["tgl_from"])));
      $tgl_to = date("m/d/Y",strtotime($this->test_input($post["tgl_to"])));
      $kelompok = $this->test_input($post["kelompok"]);

      $query ="SP_LaporanTransApcollection2 '".$tgl_from."','".$tgl_to."','".$kelompok."','".$status."'";
      
      //die(var_dump($query));
      $result2 = $this->db->baca_sql2($query);
      $datas = [];
        while(odbc_fetch_row($result2)){
        
            $datas[] = array(
               "keterangan"=>$this->setKeterangan(odbc_result($result2,'Keterangan')),
               "amount_input"=>number_format(rtrim(odbc_result($result2,'Amount_Input')),0,".","."),
               "kelompok"=>rtrim(odbc_result($result2,'Kelompok')),
               "catatan"=>rtrim(odbc_result($result2,'Catatan')),
               "tanggal"=>  date("d-m-Y",strtotime(rtrim(odbc_result($result2,'Tanggal')))),
               "user_input"=>rtrim(odbc_result($result2,'User_Input')),
             
               
            );
            
            }
 
  
      // echo "<pre>";
      // print_r($datas);
      // echo "</pre>";
      // die();      
      return $datas;

   }

    private function setKeterangan($ket){
      $expload = explode(" - ",$ket);
      return $expload[1];
    }

     public function Laporantransaksi($post){
       

        $tgl_from = $this->test_input($post["tgl_from"]);
        $tgl_to = $this->test_input($post["tgl_to"]);
        $kelompok = $this->test_input($post["kelompok"]);
        $query ="SP_LaporanTransApcollection '".$tgl_from."','".$tgl_to."','".$kelompok."'";

        
        $result2 = $this->db->baca_sql2($query);
        $datas = [];
          while(odbc_fetch_row($result2)){
          
              $datas[] = array(
                 "keterangan"=>rtrim(odbc_result($result2,'Keterangan')),
                 "amount_input"=>number_format(rtrim(odbc_result($result2,'Amount_Input')),0,".","."),
                 "kelompok"=>rtrim(odbc_result($result2,'Kelompok')),
                 "catatan"=>rtrim(odbc_result($result2,'Catatan')),
                 "tanggal"=>  date("d-m-Y",strtotime(rtrim(odbc_result($result2,'Tanggal')))),
                 "user_input"=>rtrim(odbc_result($result2,'User_Input')),
                 "tanggal_bayar"=>  date("d-m-Y",strtotime(rtrim(odbc_result($result2,'Tanggal_Bayar')))) =="01-01-1970" ? "" : date("d-m-Y",strtotime(rtrim(odbc_result($result2,'Tanggal_Bayar')))),
                 "amount_bayar"=>number_format(rtrim(odbc_result($result2,'Amount_Bayar')),0,".","."),
                 "amount_sisa"=>number_format(rtrim(odbc_result($result2,'Amount_Sisa')),0,".","."),
                 "user_bayar"=>rtrim(odbc_result($result2,'User_Bayar')),
                 "catatan_bayar"=>rtrim(odbc_result($result2,'Catatan_bayar')),
              );
              
              }
   
    
        // echo "<pre>";
        // print_r($datas);
        // echo "</pre>";
        // die();      
        return $datas;

     }




  

 



    public function getListBayar($status){

      if($status =="N"){
        $query ="SELECT Id_Trans,Tanggal_Input,Keterangan,Amount_Input,Amount_Bayar,(Amount_Input - Amount_Bayar) AS Amount_Sisa, Kelompok,Catatan_Bayar,Tanggal_Input,User_Input,Tanggal_Bayar 
        FROM $this->tbl_trans WHERE Amount_Bayar < Amount_Input AND flageclosing='N' AND Kelompok <>'OPEX'";
      }else{
        $query ="SELECT Id_Trans,Tanggal_Input,Keterangan,Amount_Input,Amount_Bayar,(Amount_Input - Amount_Bayar) AS Amount_Sisa,
       Kelompok,Catatan_Bayar,Tanggal_Input,User_Input,Tanggal_Bayar FROM $this->tbl_trans  WHERE Amount_Bayar < Amount_Input AND flageclosing='N' ";
      }
     
       $result2 = $this->db->baca_sql2($query);
       $datas = [];
         while(odbc_fetch_row($result2)){
         
             $datas[] = array(
                "Id_Trans"=>rtrim(odbc_result($result2,'Id_Trans')),
                "keterangan"=>rtrim(odbc_result($result2,'Keterangan')),
                "amount_input"=>number_format(rtrim(odbc_result($result2,'Amount_Input')),0,".","."),
                "amount_bayar"=>number_format(rtrim(odbc_result($result2,'Amount_Bayar')),0,".","."),
                "amount_sisa"=>number_format(rtrim(odbc_result($result2,'Amount_Sisa')),0,".","."),
                "kelompok"=>rtrim(odbc_result($result2,'Kelompok')),
                "catatan"=>rtrim(odbc_result($result2,'Catatan_Bayar')),
                "tanggal"=>  date("d-m-Y",strtotime(rtrim(odbc_result($result2,'Tanggal_Input')))),
                "tanggal_bayar"=>  date("d-m-Y",strtotime(rtrim(odbc_result($result2,'Tanggal_Bayar')))) =="01-01-1970" ? "" : date("d-m-Y",strtotime(rtrim(odbc_result($result2,'Tanggal_Bayar')))),
                "user_input"=>rtrim(odbc_result($result2,'User_Input')),
             );
             
             }
  
        // echo "<pre>";
        // print_r($datas);
        // echo "</pre>";
        // die();
       return $datas;
    }


    public function BayarApp($post){
      $id_trans =$this->test_input($post["id_trans"]);
      $catatan =$this->test_input($post["catatan"]);
      $tanggal_bayar = $this->test_input($post["tanggal_bayar"]);
      $amonut_bayar =$this->test_input($post["amonut_bayar"]);
      $userid =$this->test_input($post["userid"]);
      $tgl_comp = date("Y-m-d H:i:s");

      $query ="UPDATE $this->tbl_trans SET Tanggal_bayar='".$tanggal_bayar."',Catatan_bayar ='".$catatan."',
      Amount_Bayar='".$amonut_bayar."', User_Bayar='".$userid."',date_bayar='".$tgl_comp."'
      WHERE Id_Trans='".$id_trans."'
      ";
      // die(var_dump($query));
      $cek =0;
      $result = $this->db->baca_sql2($query);
     

          if(!$result){
          $cek =$cek+1;
          }
      
          if ($cek==0){
          $pesan['nilai']=1; //bernilai benar
          $pesan['error']="Berhasil Bayar";
          }else{
          $pesan['nilai']=0; //bernilai benar
          $pesan['error']="Data Gagal Bayar";
          }
          
      
          return $pesan;
    }




  public function SaveClosingmodel($post){
   
    $bulan =$this->test_input($post["bulan"]);
    $tahun =$this->test_input($post["tahun"]);
    $tgl_comp = date("Y-m-d H:i:s");
    $userid =$this->test_input($post["userid"]);
    $query ="UPDATE $this->tbl_trans SET flageclosing='Y',Tanggal_Closing='".$tgl_comp."', User_Closing ='".$userid."' 
    WHERE YEAR(Tanggal_Input)='".$tahun."' AND MONTH(Tanggal_Input)='".$bulan."' ";

    // die(var_dump($query));
    $cek =0;
    $result = $this->db->baca_sql2($query);
   

        if(!$result){
        $cek =$cek+1;
        }
    
        if ($cek==0){
        $pesan['nilai']=1; //bernilai benar
        $pesan['error']="Berhasil Closing";
        }else{
        $pesan['nilai']=0; //bernilai benar
        $pesan['error']="Data Gagal Closing";
        }
        
    
        return $pesan;
  }
*/

    
