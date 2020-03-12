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

		$pegawai = $this->pegawai->login($username,$password);
        
        if($pegawai){
            $this->response([
                'status' => TRUE,
                'data' => $pegawai
            ], REST_Controller::HTTP_OK); 
        } else {
            $this->response([
                'status' => false,
                'message' => 'id tidak ditemukan!'
            ], REST_Controller::HTTP_NOT_FOUND); 
        }
    }

}