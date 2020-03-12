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

    // FITUR LOGIN , COBA PERUBAHAN
    public function login()
    {
		$username = $this->post('username');
		$password = $this->post('password');
		$where = array(
			'username' => $username,
			'password' => $password
			);
		$cek = $this->m_login->cek_login($where)->num_rows();
		if($cek > 0){

			$data_session = array(
				'nama' => $username,
				'status' => "login"
				);

			$this->session->set_userdata($data_session);

			// redirect(base_url("admin"));

		}else{
			echo "Username dan password salah !";
		}
    }

    public function logout()
    {
        // hancurkan semua sesi
        $this->session->sess_destroy();
        //redirect(site_url('admin/login'));
    }

}