<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if($this->session->userdata('status') != "admin"){
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
		$data['nip'] = $this->nip;;
		$data['namaDepan'] = $this->namaDepan;
		$data['namaBelakang'] = $this->namaBelakang;
		$data['status'] = $this->status;
		$data['phone'] = $this->phone;
		$data['email'] = $this->email;
		$data['lastLogin'] = $this->lastLogin;

		$getUser = $this->User_model->getAllUser();
		$data['users'] = "";
		if($getUser){
			foreach ($getUser as $value) {
			$data['users'] .= "<tr>"
            ."<td>$value->nip</td>"
            ."<td>$value->first_name</td>"
            ."<td>$value->job</td>"
            ."<td>$value->created</td>"
			."<td><button class='btn waves-effect waves-light' type='submit' name='activate' value='$value->nip'>Activate</button> <button class='btn waves-effect waves-light red' type='submit' name='delete' value='$value->nip'>Delete</button></td>"
          	."</tr>";
			}
		}else {
			$data['users'] = "<tr><td class='center grey' colspan='5'>Tidak ada user yang harus di aktivasi</td></tr>";
		}

		$getAllUsers = $this->User_model->getUser();
		$data['usersList'] = "";
		foreach ($getAllUsers as $value) {
			if($value->userLevel == 0){
				$level = "Admin";
			}else {
				$level = "User";
			}
			$data['usersList'] .= "<tr>"
			."<td>$value->nip</td>"
			."<td>$value->first_name</td>"
			."<td>$value->job</td>"
			."<td>$value->email</td>"
			."<td>$value->phone</td>"
			."<td>$value->address</td>"
			."<td>$level</td>"
			."<td>$value->lastLogin</td>"
			."<td>$value->ipAddress</td>"
			."</tr>";
		}

		$this->load->view('templates/header', $data);
		$this->load->view('vAdmin');
		$this->load->view('templates/footer');
	}//end index

	public function activateUser(){
        $activate = $this->input->post('activate');
		$delete = $this->input->post('delete');
		if(isset($activate)){
			$this->User_model->activateUser($activate);
			redirect(base_url('users'));
		}elseif (isset($delete)) {
			$this->User_model->deleteUser($delete);
			redirect(base_url('users'));
		}

		
		
    }//end activateUser

}
