<?php

use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/Format.php';
require APPPATH . 'libraries/REST_Controller.php';

class Member extends REST_Controller
{
    public function __construct(){
        parent::__construct();
        $this->load->model('Member_model' , 'member');
    }

    public function index_get(){
        $id_member = $this->get('id_member');

        if($id_member === null)
        {
            $member = $this->member->getMember();
        } else{
            $member = $this->member->getMember($id_member);
        }
        
        if($member){
            $this->response([
                'status' => TRUE,
                'data' => $member
            ], REST_Controller::HTTP_OK); 
        } else {
            $this->response([
                'status' => false,
                'message' => 'id tidak ditemukan!'
            ], REST_Controller::HTTP_NOT_FOUND); 
        }
    }

    public function index_delete(){
        $id_member = $this->delete('id_member');

        if($id_member === null){
            $this->response([
                'status' => false,
                'message' => 'id member yang ingin dihapus tidak ditemukan!'
            ], REST_Controller::HTTP_BAD_REQUEST); 
        } else{
            if( $this->member->deleteMember($id_member) > 0){
                //OKE
                $this->response([
                    'status' => FALSE,
                    'id_member' => $id_member,
                    'message' => 'member sudah terhapus!'
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
            'id_pegawai_cs' => $this->post('id_pegawai_cs'),
            'id_pegawai_kasir' => $this->post('id_pegawai_kasir'),
            'nama' => $this->post('nama'),
            'no_telp' => $this->post('no_telp'),
            'tgl_lhr' => $this->post('tgl_lhr'),
            'alamat' => $this->post('alamat'),
            'status' => $this->post('status')
        ];

        if($this->member->createMember($data) > 0){
            $this->response([
                'status' => TRUE,
                'message' => 'member sudah terinput!'
            ], REST_Controller::HTTP_CREATED); 
        }else {
            $this->response([
                'status' => false,  
                'message' => 'Gagal menambahkan member!'
            ], REST_Controller::HTTP_BAD_REQUEST); 
        }
    }

    public function index_put(){

        $id_member = $this->put('id_member');

        $data = [
            'id_pegawai_cs' => $this->put('id_pegawai_cs'),
            'id_pegawai_kasir' => $this->put('id_pegawai_kasir'),
            'nama' => $this->put('nama'),
            'no_telp' => $this->put('no_telp'),
            'tgl_lhr' => $this->put('tgl_lhr'),
            'alamat' => $this->put('alamat'),
            'status' => $this->put('status')
        ];

        if($this->member->updateMember($data,$id_member) > 0){
            $this->response([
                'status' => true,
                'message' => 'member sudah terupdate!'
            ], REST_Controller::HTTP_OK); 
        }else {
            $this->response([
                'status' => false,  
                'message' => 'Gagal update member!'
            ], REST_Controller::HTTP_BAD_REQUEST); 
        }

    }
}