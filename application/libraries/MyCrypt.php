<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once 'AESCryptFileLib.php';
require_once 'aes256/MCryptAES256Implementation.php'; 
 
class MyCrypt {
	
	private $mylib;
	private $pubkey;	
	
	public function __construct(){
		$mcrypt       = new MCryptAES256Implementation();
		$this->mylib  = new AESCryptFileLib($mcrypt);
		$this->pubkey = "admin";
	}
	
	public function enc_file($file_to_encrypt,$password,$path){			
		return $this->mylib->encryptFile($file_to_encrypt, $password,$path.'.aes');
	}
	
	public function dec_file($encypt_file,$password,$decrypted_file){		
		return $this->mylib->decryptFile($encypt_file, $password, $decrypted_file);
	}
	
	
	                
}
