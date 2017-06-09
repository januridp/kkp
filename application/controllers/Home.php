<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if($this->session->userdata('status') != "logged" && $this->session->userdata('status') != "admin"){
			redirect(base_url());
		}
		$this->load->model('User_model');
		$this->nip   = $this->session->userdata('nip');

		$getUser = $this->User_model->getUserByNIP($this->nip);
		// var_dump($getUser);die();
		$this->status = "";
		foreach ($getUser as $value) {
			$this->namaDepan = $value->first_name;
			$this->namaBelakang = $value->last_name;
			if ($value->status==1){
				$this->status = ' <i class="fa fa-check-circle tooltipped" data-position="right" data-delay="50" data-tooltip="Verified account" aria-hidden="true"></i>';
			}else {
				$this->status = " (Unverified)";
			}
			$this->email = $value->email;
			$this->phone = $value->phone;
			$this->lastLogin = $value->lastLogin;
			$this->GAuth = $value->GAuth;
		}
		
		//var_dump($getUser);
		
	}

	public function index(){
		$data['nip'] = $this->nip;;
		$data['namaDepan'] = $this->namaDepan;
		$data['namaBelakang'] = $this->namaBelakang;
		$data['status'] = $this->status;
		$data['phone'] = $this->phone;
		$data['email'] = $this->email;
		$data['lastLogin'] = $this->lastLogin;

		$this->load->view('templates/header', $data);
		$this->load->view('vHome');
		$this->load->view('templates/footer');
	}

	public function about(){
		$data['nip'] = $this->nip;;
		$data['namaDepan'] = $this->namaDepan;
		$data['namaBelakang'] = $this->namaBelakang;
		$data['status'] = $this->status;
		$data['phone'] = $this->phone;
		$data['email'] = $this->email;
		$data['lastLogin'] = $this->lastLogin;

		$this->load->view('templates/header', $data);
		$this->load->view('vAbout');
		$this->load->view('templates/footer');
	}

	public function help(){
		$data['title'] = "Help";

		$data['nip'] = $this->nip;;
		$data['namaDepan'] = $this->namaDepan;
		$data['namaBelakang'] = $this->namaBelakang;
		$data['status'] = $this->status;
		$data['phone'] = $this->phone;
		$data['email'] = $this->email;
		$data['lastLogin'] = $this->lastLogin;

		$this->load->view('templates/header', $data);
		$this->load->view('vHelp');
		$this->load->view('templates/footer');
	}

	public function faq(){
		$data['title'] = "Frequently Asked Questions (FAQ)";

		$data['nip'] = $this->nip;;
		$data['namaDepan'] = $this->namaDepan;
		$data['namaBelakang'] = $this->namaBelakang;
		$data['status'] = $this->status;
		$data['phone'] = $this->phone;
		$data['email'] = $this->email;
		$data['lastLogin'] = $this->lastLogin;

		$this->load->view('templates/header', $data);
		$this->load->view('vFaq');
		$this->load->view('templates/footer');
	}


}
