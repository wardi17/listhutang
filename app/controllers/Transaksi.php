<?php

class Transaksi extends Controller{

	private $status;
	public function __construct()
	{	
	
	
		if($_SESSION['login_user'] == '') {
			Flasher::setMessage('Login','Tidak ditemukan.','danger');
			session_start();
			session_destroy();
			header('location: '.base_urllogin);
			exit;
		}else{
			// $userid = $_SESSION['login_user'];
			// if($userid =="putribmi" OR  $userid =="anggi"){
			//    $this->status="N";
			// }else{
			   $this->status ="Y";
			//}
		}
	} 

	private $kelompok =["Forwarder","Supplier lokal","Supplier import","Utility","Marketing","Sewa","Gaji","Management","Leasing","Lain-Lain"];
    private   $bulanindo =[
		"01" => "Januari",
		"02" => "Februari",
		"03" => "Maret",
		"04" => "April",
		"05" => "Mei",
		"06" => "Juni",
		"07" => "Juli",
		"08" => "Agustus",
		"09" => "September",
		"10" => "Oktober",
		"11" => "November",
		"12" => "Desember"
	];
	public function index()
		{
		
		
			$data["pages"]="pjn";
			$this->view('templates/header');
			$this->view('templates/sidebar', $data);
			$this->view('transaksi/index');
			$this->view('templates/footer');
		}

		public function getdata(){

			$data= $this->model('TransaksiModel')->getListtransaksibyth($_POST);
			if(empty($data)){
				$data = null;
				echo json_encode($data);
			}else{
				echo json_encode($data);
			}
		
		 }


  public function listdata(){
	
	$dataperbulan = $this->model('transaksiModel')->getListTransaksi($this->status);

	$data["pages"]="list";
	// $data["postdata"] =$datapost;
	$data["listdata"] =$dataperbulan;
	$this->view('templates/header');
	$this->view('templates/sidebar', $data);
	$this->view('transaksi/listdata',$data);
	$this->view('templates/footer');
  }


	public function perbulan(){

		$datapost = $_POST;
		$dataperbulan = $this->model('transaksiModel')->getListdataPebulan($datapost);
		$data["pages"]="pjn";
		$data["postdata"] =$datapost;
		$data["datainput"] =$dataperbulan;
		$this->view('templates/header');
		$this->view('templates/sidebar', $data);
		$this->view('transaksi/perbulan',$data);
		$this->view('templates/footer');
	}


	public function forminput(){
		$datapost = $_POST;
		$kelompok = $this->kelompok;
	
		$data["pages"]="pjn";
		$data["datapost"] =$datapost;
		$data["kelompok"] =$kelompok;
		$this->view('templates/header');
		$this->view('templates/sidebar', $data);
		$this->view('transaksi/forminput',$data);
		$this->view('templates/footer');
	}


	public function savedata(){
		$data= $this->model('transaksiModel')->SaveData($_POST);
			if(empty($data)){
				$data = null;
				echo json_encode($data);
			}else{
				echo json_encode($data);
			}
	}


	public function GetdataSekarang(){
		$data= $this->model('transaksiModel')->GetDataSekarang($_POST);
		if(empty($data)){
			$data = null;
			echo json_encode($data);
		}else{
			echo json_encode($data);
		}
	}

	public function laporan2(){
		$data["pages"]="laporan";
		
			$kelompok = $this->kelompok;
		 
		$data["kelompok"] =$kelompok;
		$this->view('templates/header2');
		$this->view('transaksi/laporan2',$data);
		$this->view('templates/footer2');
	}

	public function getdatalaporan2(){
	
		
		$data= $this->model('transaksiModel')->Laporantransaksi2($_POST,$this->status);
		if(empty($data)){
			$data = null;
			echo json_encode($data);
		}else{
			echo json_encode($data);
		}
	}

	public function laporan(){
		$data["pages"]="laporan";
		$data["kelompok"] =$this->kelompok;
		$this->view('templates/header2');
		$this->view('transaksi/laporan',$data);
		$this->view('templates/footer2');
	}


	public function getdatalaporan(){
	
	
		$data= $this->model('transaksiModel')->Laporantransaksi($_POST);
		if(empty($data)){
			$data = null;
			echo json_encode($data);
		}else{
			echo json_encode($data);
		}
	}

	public function Edit(){

				
		$Id_Trans = $_POST["Id_Trans"];
		$getdataedit= $this->model('transaksiModel')->getdataedit($Id_Trans);
	
		$data["pages"]="list";
		$data["getdataedit"] =$getdataedit;
	
		$data["kelompok"] =$this->kelompok;
		$this->view('templates/header');
		$this->view('templates/sidebar', $data);
		$this->view('transaksi/edit',$data);
		$this->view('templates/footer');
	}


	public function UpdateData(){
		$data= $this->model('transaksiModel')->UpdateData($_POST);
		if(empty($data)){
			$data = null;
			echo json_encode($data);
		}else{
			echo json_encode($data);
		}
	}


	public function DeleteData(){
		$data= $this->model('transaksiModel')->DeleteData($_POST);
		if(empty($data)){
			$data = null;
			echo json_encode($data);
		}else{
			echo json_encode($data);
		}
	}


	public function listbayar(){


		$dataperbulan = $this->model('transaksiModel')->getListBayar($this->status);
		$data["pages"]="bayar";
		// $data["postdata"] =$datapost;
		$data["listdata"] =$dataperbulan;
		$this->view('templates/header');
		$this->view('templates/sidebar', $data);
		$this->view('transaksi/listbayar',$data);
		$this->view('templates/footer');	
	}


	public function bayar(){
		$datapost = $_POST;
		$tgl = $datapost["tanggal"];
		$ex = explode("-",$tgl);
		
		$nama_bulan = $this->bulanindo[$ex[1]];
	
		$data["pages"]="bayar";
		$data["datapost"] =$datapost;
		$data["nama_bulan"] = $nama_bulan;
		$data["bulan"] = $ex[1];
		$data["kelompok"] =$this->kelompok;
		$this->view('templates/header');
		$this->view('templates/sidebar', $data);
		$this->view('transaksi/bayar',$data);
		$this->view('templates/footer');	
	}


	public function BayarApp(){
		$data= $this->model('transaksiModel')->BayarApp($_POST);
		if(empty($data)){
			$data = null;
			echo json_encode($data);
		}else{
			echo json_encode($data);
		}
	}


	public function Closing(){
		$data["pages"]="closing";
		// $data["postdata"] =$datapost;
		$data["listbulan"] =$this->bulanindo;

	
		$this->view('templates/header');
		$this->view('templates/sidebar', $data);
		$this->view('transaksi/closing',$data);
		$this->view('templates/footer');	
	}

	public function saveclosing(){
		

		$data= $this->model('transaksiModel')->SaveClosingmodel($_POST);
		if(empty($data)){
			$data = null;
			echo json_encode($data);
		}else{
			echo json_encode($data);
		}
	}



	public function getCurrency(){
		$data= $this->model('transaksiModel')->getCurrency();
		if(empty($data)){
			$data = null;
			echo json_encode($data);
		}else{
			echo json_encode($data);
		}
	}

	
	public function getCustomer(){
		$data= $this->model('transaksiModel')->getCustomer();
		if(empty($data)){
			$data = null;
			echo json_encode($data);
		}else{
			echo json_encode($data);
		}
	}
}