<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('User_model');
		$this->load->library('form_validation');
		$this->load->library('email');
		
	}

	public function index(){
    // $cipher = 'aes-256';
    // $this->encryption->initialize(
    //     array(
    //             'cipher' => $cipher,
    //             'key' => 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890!@#$%^&*'
    //     )
    //   );
    // $plaintext = "admin";
    // $ciphertext = $this->encryption->encrypt($plaintext);
    // $cipher2plain = $this->encryption->decrypt($ciphertext);
    // echo "Plain Text: ".$plaintext.br();
    // echo "Encrypt with: ".$cipher.br();
    // echo "Encrypted: ".$ciphertext.br();
    // echo "Panjang: ".strlen($ciphertext).br();
    // echo "Decrypted: ".$cipher2plain.br();

//See the password_hash() example to see where this came from.
//     $password = "adminadmin";
//     $options = [
//     'garam' => mcrypt_create_iv(22, MCRYPT_DEV_URANDOM),
// ];
    // $hash = password_hash('adminadmin', PASSWORD_BCRYPT);
    // echo $hash.br();
//     echo strlen($hash).br();
// if (password_verify('admin', $hash)) {
//     echo 'Password is valid!';
// } else {
//     echo 'Invalid password.';
// }

		if($this->session->userdata('status') == "logged"){
			redirect(base_url("home"));
		}elseif($this->session->userdata('status') == "admin"){
				redirect(base_url("admin"));
		}
		else{
			$data['error'] = "";
			$this->load->view('vAuth', $data);
		}
	}//end index function

  function login(){
	  
		//menangkap inputan nip dari user di menu login
		$nip = $this->input->post('nip');

		//menangkap inputan password dari user di menu login
	  	$password = $this->input->post('password');

		//mengeset rules nip yaitu menghilangkan spasi dikiri dan kanan text dengan trim, harus diisi dan mempunyai panjang minimal 5 karakter
		$this->form_validation->set_rules('nip', 'NIP', 'trim|required|min_length[5]',
															array('required' => '<div class="alert alert-danger" role="alert"><b>%s</b> tidak boleh kosong</div>',
															'min_length' => '<div class="alert alert-danger" role="alert"><b>%s</b> minimal 5 karakter</div>'));

		//mengeset rules password yaitu menghilangkan spasi dikiri dan kanan text, field tidak boleh kosong, dan mempunyai panjang minimal 8 karakter
		$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[8]',
															array('required' => '<div class="alert alert-danger" role="alert"><b>%s</b> tidak boleh kosong</div>',
														'min_length' => '<div class="alert alert-danger" role="alert"><b>%s</b> minimal 8 karakter</div>' ));

		//menjalankan form validation
		if($this->form_validation->run() == FALSE ){//jika validasi form tidak sesuai rules
			$data['error'] = "Validasi Error";
			$this->load->view('vAuth', $data);//maka dimuat ulang menu login
		}else{//jika benar atau sesuai rules  maka kode dibawah dijalankan

		//ambil password user by nip untuk dicocokan dengan password yg user input di menu login
		$getPasswdUser = $this->User_model->getPasswdUserbyNIP($nip);

		//mengecek apakah password user di table sudah di set atau belum
		if(isset($getPasswdUser)){//jika sudah maka ambil data
        $passwdUser = $getPasswdUser->password;//password user ditampung di variabel $passwd
		
		}else {
			$passwdUser = '';
			$data['error'] = "NIP Unregistered, <u><a href=".base_url('register').">Register Here</a></u>";
			$this->load->view('vAuth', $data);
		}
		
		//verifikasi password yg user input di menu login dengan password yang ada di database		
		if(password_verify($password, $passwdUser)){

		$getUser = $this->User_model->getInfoUser($nip);
		//var_dump($getUser);exit;
			if(isset($getUser)){
				$userLevel = $getUser->userLevel;
				$userStatus = $getUser->status;
			}

			if ($userLevel === "0") {
				$status = "admin";
				}else {
					$status = "logged";
				}
				

		//meng-update data dimana user terakhir mencoba login dengan mengetahui ip address user tersebut

		$lastlogin = date("Y-m-d H:i:s");
		$ipaddress = $this->User_model->getRealIP();
		$sql = "UPDATE users SET lastLogin = '$lastlogin', ipAddress = '$ipaddress' WHERE nip = '$nip'";
		$result = $this->User_model->customQuery( $sql );

			$data_session = array(
			'nip' => $nip,
			'status' => $status,
			'ipaddress' => $ipaddress,
			'lastlogin' => $lastlogin
			);

		$this->session->set_userdata($data_session);

		$data['error'] = "";

		//jika password user berhasil di verifikas atau password input dan password di database sama maka diarahkan ke halaman Home
		if ($userStatus === "0"){
					$data['error'] = "Akun Anda belum di aktivasi";
					$this->load->view('vAuth', $data);
				}else {
					redirect(base_url("home"));
				}
		

		} else {
			//jika password user gagal di verifikas maka dimuat kembali halaman atau menu login dengan pesan error
			$data['error'] = "Password Invalid!";
			$this->load->view('vAuth', $data);
			}

	}//end else form_validation

	}//end fungsi login

	function logout(){
		$this->session->sess_destroy();
		redirect(base_url());
	}

	function register(){
		$nip = $this->input->post('nip');
		$job = $this->input->post('job');
		$first_name = $this->input->post('first');
		$last_name = $this->input->post('last');
		$email = $this->input->post('email');
		$phone = $this->input->post('phone');
		$address =$this->input->post('address');
		$password = $this->input->post('password');
		$repassword =$this->input->post('repassword');

		$options = [
		'random' => random_bytes(5),
		];
    
    	$hash = password_hash($password, PASSWORD_BCRYPT, $options);

		// $status = '0';
		// $userLevel = '1';
		

		$data['error'] = "";
		if($password != $repassword){
			$data['error'] = "Password & Re-type password doesn't match!";
			$this->load->view('vRegister', $data);
		}else {
			// $created = date("Y-m-d H:i:s");
			// $lastLogin = date("Y-m-d H:i:s");
			$ipAddress = $this->User_model->getRealIP();
			$qry = $this->User_model->register($nip, $hash, $first_name, $last_name, $job, $email, $phone, $address, $ipAddress);
			$data['error'] = "Berhasil registrasi";
			$this->load->view('vAuth', $data);
		}
		
	}//end register

	function registerUser(){
		if($this->session->userdata('status') == "logged"){
			redirect(base_url("home"));
		}elseif($this->session->userdata('status') == "admin"){
				redirect(base_url("admin"));
		}
		else{
			$data['error'] = "";
		$this->load->view('vRegister', $data);
		}
		
	}


}//end class
