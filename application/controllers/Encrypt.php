<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Encrypt extends CI_Controller {

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

        }//end construct

        public function index(){
			$data['error'] = "";
			$this->load->view('vUpload_Success',$data);
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
                                redirect('encrypt');
                                
                        } else {
                                $upload_data = $this->upload->data();
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

                                //tulis file
                                if ( ! write_file($upload_data['file_path'].$upload_data['raw_name'].".rc4", $ciphertext)){
                                        echo 'Unable to write the file';
                                }else{
                                        
                                        // menghapus file yang berekstensi asli di folder uploads
                                        $oldfile = $upload_data['full_path'];
                                        // delete file after encrypt
                                        unlink($oldfile);

                                        // call aes encrypt function
                                        $aes256Encrypt = $this->mycrypt->encrypt_file($upload_data['file_path'].$upload_data['raw_name'].".rc4",$password,$path.$upload_data['raw_name']);

                                        // menghapus file yang berekstensi .rc4 yang sudah di enkrip dengan rc4 di folder uploads
                                        $oldfile = $upload_data['file_path'].$upload_data['raw_name'].".rc4";
                                        // delete file after encrypt
                                        unlink($oldfile);

                                        $nip = $this->nip;
                                        $encrypt_name = $this->upload->data('raw_name').'.encrypted';
                                        $file_name = $this->upload->data('file_name');  
                                        $orig_name = $this->upload->data('orig_name');
                                        $type = $this->upload->data('file_type');
                                        $size = $this->upload->data('file_size');
                                        $path = $this->upload->data('file_path');
                                        $fpath = $this->upload->data('full_path');
                                        $password = $password;
                                        $keterangan = $keterangan;
                                        $date = date('Y-m-d H:i:s');
                                        $action = "Encrypt";
                                        $url = base_url('uploads/encrypted/').$encrypt_name;
                                        // $this->User_model->insertEncryptFiles($nip, $orig_name, $file_name, $encrypt_name, $type, $path, $fpath, $url, $password, $date, $size, $action, $keterangan);
                                        // redirect('history');
                                        }
                                }
            }

        }//end do_upload function

}//end class Upload