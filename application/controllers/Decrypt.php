<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Decrypt extends CI_Controller {

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
            $data['title'] = "Decrypt";
            $data['error'] = "";

            $data['nip'] = $this->nip;;
            $data['namaDepan'] = $this->namaDepan;
            $data['namaBelakang'] = $this->namaBelakang;
            $data['status'] = $this->status;
            $data['phone'] = $this->phone;
            $data['email'] = $this->email;
            $data['lastLogin'] = $this->lastLogin;

            $getAllFiles = $this->User_model->getAllFilesByNIP();    

            $decrypt['decrypt'] = "";
            foreach ($getAllFiles as $value) {
                $decrypt['decrypt'] .= "<form action='decryptFile' method='post'><tr>"
					."<input type='hidden' name='id' value='$value->id_file'>"
                    ."<td>$value->orig_name</td>"
                    ."<td>$value->file_name</td>"
                    ."<td><a href='$value->url'>$value->encrypt_name</a></td>"
                    ."<td>$value->date</td>"
                    ."<td>$value->file_size KB</td>"
                    ."<td>$value->keterangan</td>"
                    ."<td><input type='password' name='password' required></td>"
					."<td><button type='submit' class='btn'>Decrypt</button></td>"
                    ."</tr></form>";
            }

            $this->load->view('templates/header', $data);
            $this->load->view('vDecrypt', $decrypt);
            $this->load->view('templates/footer');
        }

		public function decryptFile(){
			
               $id = $this->input->post('id');
			   $password = md5($this->input->post('password'));

			   $getAllFilesByID = $this->User_model->getAllFilesByID($id);
                // echo '<pre>'; print_r($getAllFilesByID);exit;
			   foreach ($getAllFilesByID as $value) {
                    $nip = $value->nip;
                    $orig_name = $value->encrypt_name;
                    $encrypt_name = $value->encrypt_name;
                    $file_name = $value->orig_name;
                    $file_type = $value->file_type;
                    //$password = $value->password;
                    $file_source = $value->id_file;
                    $file_size = $value->file_size;
                    $file_path = $value->file_path;
                    $url = $value->url;
               }

               //ambil nama untuk nama di keterangan
               $getUserByNIP = $this->User_model->getUserByNIP($nip);
               if (isset($getUserByNIP)) {
                   $nama = $getUserByNIP->first_name;
               }

               //menghitung jumlah berapa kali di decrypt
               $count = $this->User_model->count($file_source);
               if (isset($count)) {
                   $counts = $count->count;
                   $counts = $counts + 1;
               }
               //end
                $path = "D:/webroot/dev/kkp/uploads/decrypted/";
                $aes256Decrypt = $this->mycrypt->dec_file($file_path.$encrypt_name.".aes",$password,$path.$file_name);
                die();


               //fixed jgn diubah
                $keterangan = "User $nama telah mendekrip file";
                $action = 'Decrypt';
                $this->encryption->initialize(
                array(
                        'cipher' => 'rc4',
                        'mode' => 'stream',
                        'key' => $password
                )
                );
                //end fixed

                //start proses decrypting with rc4
                //buka dan baca isi file yang ada didatabase pada kolom url
                //url = http://januridp.dev/kkp/uploads/encrypted/ae4c8242c402e31de60d122480608a1b.rc4
                $ciphertext = read_file($url);
                //dekrip $ciphertext
                $plain = $this->encryption->decrypt($ciphertext);
                //end proses decrypting

                //start path initialize
                //menentukan path untuk meletakan file hasil dekrip
                $file_path = "D:/webroot/dev/kkp/uploads/decrypted/";
                $full_path = $file_path.$file_name;
                //end

                //start
                //membuat url link menuju file hasil dekrip
                $url = base_url('uploads/decrypted/').$file_name;
                //end

                //start
                //tanggal dan waktu dekrip
                $date = date('Y-m-d H:i:s');
                //end

                //tulis file baru ke path yang sudah di initialize
                if ( ! write_file($file_path.$file_name, $plain)){  //jika gagal menulis file yg sudah di dekrip
                    echo 'Unable to write the file';    //maka tampilkan pesan ini
                }else{
                    // die("Berhasil");
                    //start insert data hasil dekrip
                    $this->User_model->insertDecryptFiles($nip,$orig_name,$file_name,$file_type,$file_path,$full_path,$url,$date,$file_size,$action,$keterangan,$counts,$file_source);
                    //end

                    //start menampilkan url lokasi file dan me-redirect ke halaman history
                    echo "<script>prompt('File Decrypted:', '$url');window.location='history';</script>";
                    //end 
                }
                
                //}


             


        }//end do_upload function

}//end class History