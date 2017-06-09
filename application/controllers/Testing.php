<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Testing extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('User_model');
		$this->load->library('encryption');
		$this->load->library('form_validation');
		$this->load->helper('file');

		//Import RC4 Lib
		//$this->load->library("rc4");
		
	}

    function index(){
echo '<pre>'; print_r($this->session->all_userdata());exit;
		// $key = '!1L0v31nD0n3514R4y4!';
		// $string = read_file('./uploads/plain.txt');
		// $action = 'decrypt';

		// $this->encryption->initialize(
        // array(
        //         'cipher' => 'rc4',
        //         'mode' => 'stream',
		// 		'key' => $key
        // )
		// );
		
		// echo $string.br();
		// $ciphertext = $this->encryption->encrypt($string);
		// echo $ciphertext.br();

		// // Outputs: This is a plain-text message!
		// $plain_text = $this->encryption->decrypt($ciphertext);

		// if($action=='encrypt'){
		// 	$file_path = './uploads/encrypted/encrypted.txt';
		// 	if ( ! write_file($file_path, $ciphertext)){
		// 		echo 'Unable to write the file';
		// 	}else{
		// 			echo 'File written!';
		// 	}
		// }elseif($action=='decrypt') {
		// 	$file_path = './uploads/decrypted/decrypted.txt';
		// 	if ( ! write_file($file_path, $plain_text)){
		// 		echo 'Unable to write the file';
		// 	}else{
		// 			echo 'File written!';
		// 	}
		// }

		
$this->load->view('vTesting');
		
    //   echo '<pre>'; print_r($this->session->all_userdata());exit;
	  //See the password_hash() example to see where this came from.
    // $password = "adminadmin";
	// $userInput = "adminadmin";

	// $options = [
    // 'random' => random_bytes(5),
	// ];
    
    // $hash = password_hash($password, PASSWORD_BCRYPT, $options);
    // echo $hash.br();
    // echo "Panjang hash: ".strlen($hash).br();
	// if (password_verify($userInput, $hash)){
	// 	echo 'Verify: Valid!'.br();
	// 	} else {
	// 		echo 'Verify: Invalid!'.br();
	// 		}
//echo substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil(6/strlen($x)) )),1,6);
// $bytes = random_bytes(5);
// var_dump(bin2hex($bytes));
// $hashed_password = crypt('mypassword','asd');
// echo $hashed_password;

// $plain = "Aku IndonesasdasdasdasdasdasdsdasdasdasiaAku IndonesasdasdasdasdasdasdsdasdasdasiaAku IndonesasdasdasdasdasdasdsdasdasdasiaAku IndonesasdasdasdasdasdasdsdasdasdasiaAku IndonesasdasdasdasdasdasdsdasdasdasiaAku Indonesasdasdasdasdasdasdsdasdasdasia";
// $encrypt = $this->encryption->encrypt($plain);
// $decrypt = $this->encryption->decrypt($encrypt);
 
//         //tampilkan hasilnya
//         echo $encrypt;
// 		echo "<br>".strlen($encrypt);
// 		echo br().$decrypt;
    }//end of index

	public function teszip(){
		$this->load->library('zip');
		$name = 'mydata1.txt';
$data = 'A Data String!';

$this->zip->add_data($name, $data);

// Write the zip file to a folder on your server. Name it "my_backup.zip"
$this->zip->archive('http://januridp.dev/kkp/uploads/my_backup.zip');

// Download the file to your desktop. Name it "my_backup.zip"
$this->zip->download('my_backup.zip');
	}



}//end class