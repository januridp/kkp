<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if($this->session->userdata('status') != "logged" && $this->session->userdata('status') != "admin"){
			redirect(base_url());
		}
		$this->load->model('User_model');

		$getUser = $this->User_model->getUser();
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
		$this->nip   = $this->session->userdata('nip');
		//var_dump($getUser);
		
	}

	public function index(){
        $fname = $this->input->post('first_name');
        $lname = $this->input->post('last_name');
        $phone = $this->input->post('phone');
        $email = $this->input->post('email');

        $updateProfile = $this->User_model->updateProfile($fname,$lname,$phone,$email);

        echo "<script>swal('Berhasil');</script>";


	}

}