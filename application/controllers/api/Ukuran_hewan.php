<?php

use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/Format.php';
require APPPATH . 'libraries/REST_Controller.php';

class Ukuran_hewan extends REST_Controller
{
    public function __construct(){
        parent::__construct();
        $this->load->model('Ukuran_hewan_model' , 'ukuran_hewan');
    }

    public function index_get(){
        $id_ukuran = $this->get('id_ukuran');

        if($id_ukuran === null)
        {
            $ukuran_hewan = $this->ukuran_hewan->getUkuran_hewan();
        } else{
            $ukuran_hewan = $this->ukuran_hewan->getUkuran_hewan($id_ukuran);
        }
        
        if($ukuran_hewan){
            $this->response([
                'status' => TRUE,
                'data' => $ukuran_hewan
            ], REST_Controller::HTTP_OK); 
        } else {
            $this->response([
                'status' => false,
                'message' => 'id tidak ditemukan!'
            ], REST_Controller::HTTP_NOT_FOUND); 
        }
    }

    public function index_delete(){
        $id_ukuran = $this->delete('id_ukuran');

        if($id_ukuran === null){
            $this->response([
                'status' => false,
                'message' => 'id ukuran hewan yang ingin dihapus tidak ditemukan!'
            ], REST_Controller::HTTP_BAD_REQUEST); 
        } else{
            if( $this->ukuran_hewan->deleteUkuran_hewan($id_ukuran) > 0){
                //OKE
                $this->response([
                    'status' => FALSE,
                    'id_ukuran' => $id_ukuran,
                    'message' => 'ukuran_hewan sudah terhapus!'
                ], REST_Controller::HTTP_OK); 
            } else{
                $this->response([
                    'status' => false,  
                    'message' => 'id tidak ditemukan!'
                ], REST_Controller::HTTP_NOT_FOUND); 
            }
        }
    }

    public function index_post(){
        $data = [
            'ukuran' => $this->post('ukuran'),
            'harga' => $this->post('harga')
        ];

        if($this->ukuran_hewan->createUkuran_hewan($data) > 0){
            $this->response([
                'status' => TRUE,
                'message' => 'ukuran hewan sudah terinput!'
            ], REST_Controller::HTTP_CREATED); 
        }else {
            $this->response([
                'status' => false,  
                'message' => 'Gagal menambahkan ukuran hewan!'
            ], REST_Controller::HTTP_BAD_REQUEST); 
        }
    }

    public function index_put(){

        $id_ukuran = $this->put('id_ukuran');

        $data = [
            'ukuran' => $this->put('ukuran'),
            'harga' => $this->put('harga')
        ];

        if($this->ukuran_hewan->updateukuran_hewan($data,$id_ukuran) > 0){
            $this->response([
                'status' => true,
                'message' => 'ukuran_hewan sudah terupdate!'
            ], REST_Controller::HTTP_OK); 
        }else {
            $this->response([
                'status' => false,  
                'message' => 'Gagal update ukuran_hewan!'
            ], REST_Controller::HTTP_BAD_REQUEST); 
        }

    }
}