<?php

use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/Format.php';
require APPPATH . 'libraries/REST_Controller.php';

class Pegawai extends REST_Controller
{
    public function __construct(){
        parent::__construct();
        $this->load->model('Pegawai_model' , 'pegawai');
    }

    public function index_get(){
        $id_pegawai = $this->get('id_pegawai');

        if($id_pegawai === null)
        {
            $pegawai = $this->pegawai->getPegawai();
        } else{
            $pegawai = $this->pegawai->getPegawai($id_pegawai);
        }
        
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

    public function index_delete(){
        $id_pegawai = $this->delete('id_pegawai');

        if($id_pegawai === null){
            $this->response([
                'status' => false,
                'message' => 'id pegawai yang ingin dihapus tidak ditemukan!'
            ], REST_Controller::HTTP_BAD_REQUEST); 
        } else{
            if( $this->pegawai->deletePegawai($id_pegawai) > 0){
                //OKE
                $this->response([
                    'status' => FALSE,
                    'id_pegawai' => $id_pegawai,
                    'message' => 'Pegawai sudah terhapus!'
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
            'nama' => $this->post('nama'),
            'alamat' => $this->post('alamat'),
            'tgl_lhr' => $this->post('tgl_lhr'),
            'no_telp' => $this->post('no_telp'),
            'role' => $this->post('role'),
            'password' => $this->post('password'),
            'username' => $this->post('username')
        ];

        if($this->pegawai->createPegawai($data) > 0){
            $this->response([
                'status' => TRUE,
                'message' => 'Pegawai sudah terinput!'
            ], REST_Controller::HTTP_CREATED); 
        }else {
            $this->response([
                'status' => false,  
                'message' => 'Gagal menambahkan pegawai!'
            ], REST_Controller::HTTP_BAD_REQUEST); 
        }
    }

    public function index_put(){

        $id_pegawai = $this->put('id_pegawai');

        $data = [
            'nama' => $this->put('nama'),
            'alamat' => $this->put('alamat'),
            'tgl_lhr' => $this->put('tgl_lhr'),
            'no_telp' => $this->put('no_telp'),
            'role' => $this->put('role'),
            'password' => $this->put('password'),
            'username' => $this->put('username')
        ];

        if($this->pegawai->updatePegawai($data,$id_pegawai) > 0){
            $this->response([
                'status' => true,
                'message' => 'Pegawai sudah terupdate!'
            ], REST_Controller::HTTP_OK); 
        }else {
            $this->response([
                'status' => false,  
                'message' => 'Gagal update pegawai!'
            ], REST_Controller::HTTP_BAD_REQUEST); 
        }

    }
}