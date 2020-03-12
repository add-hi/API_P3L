<?php

use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/Format.php';
require APPPATH . 'libraries/REST_Controller.php';

class Login extends REST_Controller
{
    public function __construct(){
        parent::__construct();
        $this->load->model('Pegawai_model' , 'pegawai');
    }

    public function index_get(){
		$username = $this->get('username');
		$password = $this->get('password');
		
		//$pegawai = $this->pegawai->login($username,$password);
		$data=$this->pegawai->auth_owner($username,$password);
		$this->response([
			'status' => TRUE,
			'message' => 'login owner sukses!',
			
		], REST_Controller::HTTP_OK); 
		
		// if($cek_owner->num_rows() > 0){ //jika login sebagai dosen
		// 	$data=$cek_owner->row_array();
		// 	$this->response([
		// 		'status' => TRUE,
		// 		'message' => 'login owner sukses!',
        //         'data' => $data
		// 	], REST_Controller::HTTP_OK); 
		// } else{
		// 	$cek_cs=$this->pegawai->auth_cs($username,$password);
		// 	if($cek_cs->num_rows() > 0){
		// 		$data=$cek_cs->row_array();
		// 		$this->response([
		// 			'status' => TRUE,
		// 			'message' => 'login cs sukses!',
		// 			'data' => $data
		// 		], REST_Controller::HTTP_OK);
		// 	}else{
		// 		$this->response([
		// 			'status' => false,
		// 			'message' => 'id tidak ditemukan!'
		// 		], REST_Controller::HTTP_NOT_FOUND); 
		// 	}
		// }
    }

}