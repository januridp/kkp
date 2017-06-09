<?php
class User_model extends CI_Model {

	function __construct(){
		 parent::__construct();
		 $this->load->database();
		 $this->nip   = $this->session->userdata('nip');
	}

    function register($nip, $hash, $first_name, $last_name, $job, $email, $phone, $address, $ipAddress){
        $data = array(
        'nip' => $nip,
        'password' => $hash,
        'first_name' => $first_name,
        'last_name' => $last_name,
        'job' => $job,
        'email' => $email,
        'phone' => $phone,
        'address' => $address,
        'ipAddress' => $ipAddress
    );
    $this->db->insert('users', $data); 
    }//end register

    function insertEncryptFiles($nip, $orig_name, $file_name, $encrypt_name, $type, $path, $fpath, $url, $password, $date, $size, $action, $keterangan){
        $this->db->set('nip', $nip);
        $this->db->set('orig_name', $orig_name);
        $this->db->set('file_name', $file_name);
        $this->db->set('encrypt_name', $encrypt_name);
        $this->db->set('file_type', $type);
        $this->db->set('file_path', $path);
        $this->db->set('full_path', $fpath);
        $this->db->set('url', $url);
        $this->db->set('password', $password);
        $this->db->set('date', $date);
        $this->db->set('file_size', $size);
        $this->db->set('action', $action);
        $this->db->set('keterangan', $keterangan);
        $this->db->insert('files');
    }//end insertEncryptFiles

    function insertDecryptFiles($nip,$orig_name,$file_name,$file_type,$file_path,$full_path,$url,$date,$file_size,$action,$keterangan,$counts,$file_source){
        $this->db->set('nip', $nip);
        $this->db->set('orig_name', $orig_name);
        $this->db->set('file_name', $file_name);
        $this->db->set('file_type', $file_type);
        $this->db->set('file_path', $file_path);
        $this->db->set('full_path', $full_path);
        $this->db->set('url', $url);
        $this->db->set('date', $date);
        $this->db->set('file_size', $file_size);
        $this->db->set('action', $action);
        $this->db->set('keterangan', $keterangan);
        $this->db->set('count', $counts);
        $this->db->set('file_source', $file_source);
        $this->db->insert('files');
    }//end insertDecryptFiles


	function login($username){
    //proses pencocokkan data user yang diinput dengan yang di database
    $this->db->select('*');
    $this->db->from('user');
    $this->db->where('username', $username);
    $query = $this->db->get();
    if($query->num_rows() > 0){
        return $query->row();
        }else{
            return false;
            }
    }//end login

    function getUserByNIP($nip){
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where('nip', $nip);
        $query = $this->db->get();
        return $query->result();
    }//end getUserByNIP

    function getUser(){
        $this->db->select('*');
        $this->db->from('users');
        $query = $this->db->get();
        return $query->result();
    }//end getUser

    function getAllFiles(){
        $this->db->select('*');
        $this->db->from('files');
        $query = $this->db->get();
        return $query->result();
    }//end all files

    function getAllFilesByNIP(){
        $nip = $this->nip;
        $this->db->select('*');
        $this->db->from('files');
        $this->db->where('nip', $nip);
        $this->db->where('action', 'Encrypt');
        $query = $this->db->get();
        return $query->result();
    }//end all files by NIP

    function getAllFilesByID($id){
        $nip = $this->nip;
        $this->db->select('*');
        $this->db->from('files');
        $this->db->where('id_file', $id);
        $query = $this->db->get();
        return $query->result();
    }//end all files by ID

    function getAllUser(){
        $status = '0';
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where('status', $status);
        $query = $this->db->get();
        return $query->result();
    }//end user

    function getPasswdUserbyNIP($nip){
        $this->db->select('password');
        $this->db->from('users');
        $this->db->where('nip', $nip);
        $query = $this->db->get();
        return $query->row();
    }//end passwd

    function getInfoUser($nip){
        $this->db->select('userLevel, status');
        $this->db->from('users');
        $this->db->where('nip', $nip);
        $query = $this->db->get();
        return $query->row();
    }//end info user

    //fungsi untuk di controller auth
	function customQuery($query){
		$query = $this->db->query("$query");
	}//end

    function count($file_source){
        $query = $this->db->query("select count(*) as count from files where action='Decrypt' and file_source='$file_source'");
		return $query->row();
    }//end count

    //fungsi update untuk controller activateUser
    function activateUser($nip){
        $status = 1;
        $data = array(
        'status' => $status
        );

        $this->db->where('nip', $nip);
        $this->db->update('users', $data);
    }

    //fungsi updateProfile untuk controller Users
    function updateProfile($fname,$lname,$phone,$email){
        $nip = $this->nip;
        $data = array(
        'first_name' => $fname,
        'last_name' => $lname,
        'phone' => $phone,
        'email' => $email
        );

        $this->db->where('nip', $nip);
        $this->db->update('users', $data);
    }

    //fungsi hapus untuk controller activateUser
    function deleteUser($nip){
        $this->db->where('nip', $nip);
        $this->db->delete('users');
    }

    function getRealIP(){
    $clientip      = isset( $_SERVER['HTTP_CLIENT_IP'] )       && $_SERVER['HTTP_CLIENT_IP']       ?
                     $_SERVER['HTTP_CLIENT_IP']         : false;
    $xforwarderfor = isset( $_SERVER['HTTP_X_FORWARDED_FOR'] ) && $_SERVER['HTTP_X_FORWARDED_FOR'] ?
                     $_SERVER['HTTP_X_FORWARDED_FOR']   : false;
    $xforwarded    = isset( $_SERVER['HTTP_X_FORWARDED'] )     && $_SERVER['HTTP_X_FORWARDED']     ?
                     $_SERVER['HTTP_X_FORWARDED']       : false;
    $forwardedfor  = isset( $_SERVER['HTTP_FORWARDED_FOR'] )   && $_SERVER['HTTP_FORWARDED_FOR']   ?
                     $_SERVER['HTTP_FORWARDED_FOR']     : false;
    $forwarded     = isset( $_SERVER['HTTP_FORWARDED'] )       && $_SERVER['HTTP_FORWARDED']       ?
                     $_SERVER['HTTP_FORWARDED']         : false;
    $remoteadd     = isset( $_SERVER['REMOTE_ADDR'] )          && $_SERVER['REMOTE_ADDR']          ?
                     $_SERVER['REMOTE_ADDR']            : false;

    //GET AN IP ADDRESS
    if ( $clientip          !== false ) {
        $ipaddress = $clientip;
    }
    elseif( $xforwarderfor  !== false ) {
        $ipaddress = $xforwarderfor;
    }
    elseif( $xforwarded     !== false ) {
        $ipaddress = $xforwarded;
    }
    elseif( $forwardedfor   !== false ) {
        $ipaddress = $forwardedfor;
    }
    elseif( $forwarded      !== false ) {
        $ipaddress = $forwarded;
    }
    elseif( $remoteadd      !== false ) {
        $ipaddress = $remoteadd;
    }
    else{
        $ipaddress = false; # unknown
    }
    return $ipaddress;
    }//end real ip

}//end class
