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

    public function index_get()
    {

		$username = $this->get('username');
		$password = $this->get('password');
		
		$pegawai = $this->pegawai->login($username,$password,"OWNER");
		$message = "Login sebagai owner";
		if(count($pegawai) < 1){
			$pegawai = $this->pegawai->login($username,$password,"CS");
			$message = "Login sebagai cs";
		}

		if($pegawai){
            $this->response([
				'status' => TRUE,
				'message' => $message,
                'data' => $pegawai
            ], REST_Controller::HTTP_OK); 
        } else {
            $this->response([
				'status' => false,
                'message' => 'Gagal Login ! id tidak ditemukan! --HANYA OWNER ATAU CS!--'
            ], REST_Controller::HTTP_BAD_GATEWAY); 
        }
    } 

}