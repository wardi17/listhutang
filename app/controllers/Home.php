<?php

class Home extends Controller{

	public function __construct()
	{	
	
	
		if($_SESSION['login_user'] == '') {
			Flasher::setMessage('Login','Tidak ditemukan.','danger');
			session_start();
			session_destroy();
			header('location: '.base_urllogin);
			exit;
		}
	} 
    
	public function index()
		{
		

			$data["pages"] ="home";
			$this->view('templates/header');
			$this->view('templates/sidebar', $data);
			$this->view('home/index');
			$this->view('templates/footer');
		}


		public function index2(){
			$this->view('home/index2');
		}


 public function getharikerja(){

	$data= $this->model('homeModel')->getHarikerja($_POST);
	if(empty($data)){
		$data = null;
		echo json_encode($data);
	}else{
		echo json_encode($data);
	}

 }







   public function createdate(){
	$data= $this->model('homeModel')->saveData($_POST);
	if(empty($data)){
		$data = null;
		echo json_encode($data);
	}else{
		echo json_encode($data);
	}
   }


   public function tampildata(){
		$data= $this->model('homeModel')->GetTampil();
		if(empty($data)){
			$data = null;
			echo json_encode($data);
		}else{
			echo json_encode($data);
		}
   }



   public function Updatedate(){
	$data= $this->model('homeModel')->UpdateData($_POST);
	if(empty($data)){
		$data = null;
		echo json_encode($data);
	}else{
		echo json_encode($data);
	}
   }


   public function deletedate(){
	$data= $this->model('homeModel')->DeleteData($_POST);
	if(empty($data)){
		$data = null;
		echo json_encode($data);
	}else{
		echo json_encode($data);
	}
   }
}