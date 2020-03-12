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
        $where = array(
			'username' => $username,
			'password' => $password,
			'role' => 'OWNER'
			);
		
		$pegawai = $this->pegawai->login($where);

		if($pegawai){
            $this->response([
				'status' => TRUE,
				'message' => 'Loggin Berhasil!',
                'data' => $pegawai
            ], REST_Controller::HTTP_OK); 
        } else {
            $this->response([
				'status' => false,
                'message' => 'Gagal Login ! id tidak ditemukan! --HANYA OWNER ATAU CS!--'
            ], REST_Controller::HTTP_BAD_GATEWAY); 
        }

		// if($cek > 0){
 
		// 	$data_session = array(
		// 		'nama' => $username,
		// 		'status' => "login"
		// 		);
		// 	$this->response([
		// 		'status' => TRUE,
		// 		'message' => 'Berhasil Loggin!'
		// 	], REST_Controller::HTTP_OK);
			
		// 	$this->session->set_userdata($data_session);
 
		// 	redirect(base_url("admin"));
 
		// }else{
		// 	$this->response([
		// 		'status' => FALSE,
		// 		'message' => 'GAGAL Loggin!'
		// 	], REST_Controller::HTTP_BAD_REQUEST);

		// 	echo "Username dan password salah !";
		// }
        // foreach($result as $row){
        //     if(password_verify($password,$row['password'])){
				
		// 		$this->response([
		// 			'status' => "true",
		// 		], REST_Controller::HTTP_OK);

        //         if($result>0)
        //         {
        //             $this->response([
        //                 'status' => "true",
        //             ], REST_Controller::HTTP_OK);
        //         }else{
        //             $this->response([
        //                 'status' => "false",
        //                 'password' => $where['password'],
        //                 'message' => 'User Not Found'
        //             ], REST_Controller::HTTP_NOT_FOUND);
        //         }
        //     }
        // }
    } 
		
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