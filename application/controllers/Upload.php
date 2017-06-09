<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Upload extends CI_Controller {

        public function __construct()
        {
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
                $data['title'] = "Encrypt";
		$data['error'] = "";

                $data['nip'] = $this->nip;;
		$data['namaDepan'] = $this->namaDepan;
		$data['namaBelakang'] = $this->namaBelakang;
		$data['status'] = $this->status;
		$data['phone'] = $this->phone;
		$data['email'] = $this->email;
		$data['lastLogin'] = $this->lastLogin;

                $this->load->view('templates/header', $data);
                $this->load->view('vUpload', array('error' => ' ' ));
                $this->load->view('templates/footer');
                
        }//end index function

        public function do_upload()
        {
                if ($_FILES["userfile"]['name'] != NULL){
                        $path = './uploads/encrypted/';
                        $password = md5($this->input->post('password'));
                        $keterangan = $this->input->post('keterangan');

                        $config = array(
                                'upload_path' => $path,
                                'allowed_types' => 'gif|jpg|jpeg|png|pdf|txt|csv|xls|xlsx|doc|docx|mp3|mp4',
                                'file_name' => $_FILES["userfile"]['name'],
                                'encrypt_name' => true,
                                'remove_spaces' => true
                        );
                        $this->load->library('upload', $config);
                        
                        if (!$this->upload->do_upload()) {
                                $error = array('error' => $this->upload->display_errors());
                                $this->load->view('vUpload', $error);
                                
                        } else {
                                $upload_data = $this->upload->data();

                                $aes256Encrypt = $this->mycrypt->enc_file($upload_data['full_path'],$password,$path.$upload_data['raw_name']);
                                $oldfile = $upload_data['full_path'];
                                        // Delete file after encrypt
                                        unlink($oldfile);
                                        // Ubah hanya jika diperlukan
                                        $nip = $this->nip;
                                        $encrypt_name = $this->upload->data('raw_name');
                                        $file_name = $this->upload->data('file_name');  
                                        $orig_name = $this->upload->data('orig_name');
                                        $type = $this->upload->data('file_type');
                                        $size = $this->upload->data('file_size');
                                        $path = $this->upload->data('file_path');
                                        $fpath = $this->upload->data('file_path').$this->upload->data('raw_name').".aes";
                                        $password = $password;
                                        $keterangan = $keterangan;
                                        $date = date('Y-m-d H:i:s');
                                        $action = "Encrypt";
                                        $url = base_url('uploads/encrypted/').$encrypt_name.".aes";
                                        $this->User_model->insertEncryptFiles($nip, $orig_name, $file_name, $encrypt_name, $type, $path, $fpath, $url, $password, $date, $size, $action, $keterangan);
                                        redirect('history');
                                        die();

                                //buka file
                                //echo $upload_data['raw_name'].".encrypted";die();
                                $readf = read_file($upload_data['full_path']);
                                //encrypt with arcfour/rc4
                                $this->encryption->initialize(
                                        array(
                                                'cipher' => 'rc4',
                                                'mode' => 'stream',
                                                'key' => $password
                                                ));
                                $ciphertext = $this->encryption->encrypt($readf);

                                // $aes256Encrypt = $this->mycrypt->enc_file($upload_data['full_path'],$password,$path.$upload_data['raw_name']);
                                // $readf = read_file(base_url('uploads/encrypted/').$upload_data['raw_name'].".aes");
                                // $rc4 = $this->encryption->encrypt($readf);
                                

                                //tulis file
                                if ( ! write_file($upload_data['file_path'].$upload_data['raw_name'].".rc4", $ciphertext)){
                                // if ( ! write_file($upload_data['file_path'].$upload_data['raw_name'].".rc4", $rc4)){
                                        die('Unable to write the file');
                                }else{
                                        // menghapus file yang berekstensi asli di folder uploads
                                        $oldfile = $upload_data['full_path'];
                                        // delete file after encrypt
                                        unlink($oldfile);

                                        // call aes encrypt function
                                        // $aes256Encrypt = $this->mycrypt->encrypt_file($upload_data['file_path'].$upload_data['raw_name'].".rc4",$password,$path.$upload_data['raw_name']);

                                        // menghapus file yang berekstensi .rc4 yang sudah di enkrip dengan rc4 di folder uploads
                                        // $oldfile = $upload_data['file_path'].$upload_data['raw_name'].".rc4";
                                        // $oldfile = $upload_data['file_path'].$upload_data['raw_name'];
                                        // delete file after encrypt
                                        // unlink($oldfile);

                                        //ubah hanya jika diperlukan
                                        $nip = $this->nip;
                                        $encrypt_name = $this->upload->data('raw_name');
                                        $file_name = $this->upload->data('file_name');  
                                        $orig_name = $this->upload->data('orig_name');
                                        $type = $this->upload->data('file_type');
                                        $size = $this->upload->data('file_size');
                                        $path = $this->upload->data('file_path');
                                        $fpath = $this->upload->data('file_path').$this->upload->data('raw_name').".rc4";
                                        $password = $password;
                                        $keterangan = $keterangan;
                                        $date = date('Y-m-d H:i:s');
                                        $action = "Encrypt";
                                        $url = base_url('uploads/encrypted/').$encrypt_name.".rc4";
                                        $this->User_model->insertEncryptFiles($nip, $orig_name, $file_name, $encrypt_name, $type, $path, $fpath, $url, $password, $date, $size, $action, $keterangan);
                                        redirect('history');
                                        }
                                }
            }

        }//end do_upload function

}//end class Upload