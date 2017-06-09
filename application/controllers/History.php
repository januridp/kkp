<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class History extends CI_Controller {

        public function __construct(){
            parent::__construct();
            if($this->session->userdata('status') != "logged" && $this->session->userdata('status') != "admin"){
                redirect(base_url());
                }
        $this->load->model('User_model');
		$this->load->library('encryption');
        $this->load->helper(array('form', 'url'));
        $this->load->library("mycrypt");

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
        }//end construct

        public function index(){
            $data['title'] = "History";
            $data['error'] = "";

            $data['nip'] = $this->nip;;
            $data['namaDepan'] = $this->namaDepan;
            $data['namaBelakang'] = $this->namaBelakang;
            $data['status'] = $this->status;
            $data['phone'] = $this->phone;
            $data['email'] = $this->email;
            $data['lastLogin'] = $this->lastLogin;

            if($this->session->userdata('status') == "admin"){
                $getAllFiles = $this->User_model->getAllFiles();
                } else {
                    $getAllFiles = $this->User_model->getAllFilesByNIP();
                }

            $history['history'] = "";
            foreach ($getAllFiles as $value) {
                $history['history'] .= "<tr>"
                    ."<td>$value->nip</td>"
                    ."<td>$value->orig_name</td>"
                    ."<td>$value->file_name</td>"
                    ."<td>$value->encrypt_name</td>"
                    ."<td>$value->date</td>"
                    ."<td>$value->file_size KB</td>"
                    ."<td>$value->keterangan</td>"
                    ."<td>$value->action</td>"
                    ."</tr>";
            }

            $this->load->view('templates/header', $data);
            $this->load->view('vHistory', $history);
            $this->load->view('templates/footer');
        }

}//end class History