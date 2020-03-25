<?php

use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/Format.php';
require APPPATH . 'libraries/REST_Controller.php';

class Data_hewan extends REST_Controller
{
    public function __construct(){
        parent::__construct();
        $this->load->model('Data_hewan_model' , 'data_hewan');
    }

    public function index_get(){
        $id_hewan = $this->get('id_hewan');

        if($id_hewan === null)
        {
            $data_hewan = $this->data_hewan->getData_hewan();
        } else{
            $data_hewan = $this->data_hewan->getData_hewan($id_hewan);
        }
        
        if($data_hewan){
            $this->response([
                'status' => TRUE,
                'data' => $data_hewan
            ], REST_Controller::HTTP_OK); 
        } else {
            $this->response([
                'status' => false,
                'message' => 'id tidak ditemukan!'
            ], REST_Controller::HTTP_NOT_FOUND); 
        }
    }

    public function log_get(){
        $id = $this->get('id_hewan');

        if($id === null)
        {
            $data_hewan = $this->data_hewan->getLog();
        } else{
            $data_hewan = $this->data_hewan->getData_hewan($id);
        }
        
        if($data_hewan){
            $this->response([
                'status' => TRUE,
                'data' => $data_hewan
            ], REST_Controller::HTTP_OK); 
        } else {
            $this->response([
                'status' => false,
                'message' => 'id tidak ditemukan!'
            ], REST_Controller::HTTP_NOT_FOUND); 
        }
    }

    public function delete_post(){
        $id = $this->post('id_hewan');
        $data = [
          'delete_at' => date('Y-m-d H:i:s')
        ];
  
        $query = $this->db->get_where('data_hewan',['id_hewan'=> $id]);
  
      foreach ($query->result() as $row)
      {
          $cek = $row->delete_at;
      }
  
        if($cek === null){
          if($this->data_hewan->deleteData_hewan($data, $id) > 0) {
              $this->response([
                'status' => true,
                'id' => $id,
                'message' => 'berhasil soft delete :)'
              ],  REST_Controller::HTTP_OK);
            } else {
              $this->response([
                'status' => false,
                'message' => 'deleted'
              ], REST_Controller::HTTP_BAD_REQUEST);
            }
        }else{
          $this->response([
              'status' => false,
              'message' => 'deleted'
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
  
      }
      
    public function index_delete(){
        $id_hewan = $this->delete('id_hewan');

        if($id_hewan === null){
            $this->response([
                'status' => false,
                'message' => 'id data_hewan yang ingin dihapus tidak ditemukan!'
            ], REST_Controller::HTTP_BAD_REQUEST); 
        } else{
            if( $this->data_hewan->hardDelete($id_hewan) > 0){
                //OKE
                $this->response([
                    'status' => FALSE,
                    'id_hewan' => $id_hewan,
                    'message' => 'data_hewan sudah terhapus!'
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
            'id_member' => $this->post('id_member'),
            'id_jenis' => $this->post('id_jenis'),
            'id_ukuran' => $this->post('id_ukuran'),
            'nama' => $this->post('nama'),
            'tgl_lhr' => $this->post('tgl_lhr'),
            'id_pegawai_cs' => $this->post('id_pegawai_cs'),
            'id_pegawai_kasir' => $this->post('id_pegawai_kasir')
        ];

        if($this->data_hewan->createData_hewan($data) > 0){
            $this->response([
                'status' => TRUE,
                'message' => 'data_hewan sudah terinput!'
            ], REST_Controller::HTTP_CREATED); 
        }else {
            $this->response([
                'status' => false,  
                'message' => 'Gagal menambahkan data_hewan!'
            ], REST_Controller::HTTP_BAD_REQUEST); 
        }
    }

    public function index_put(){

        $id_hewan = $this->put('id_hewan');

        $data = [
            'id_member' => $this->put('id_member'),
            'id_jenis' => $this->put('id_jenis'),
            'id_ukuran' => $this->put('id_ukuran'),
            'nama' => $this->put('nama'),
            'tgl_lhr' => $this->put('tgl_lhr'),
            'id_pegawai_cs' => $this->put('id_pegawai_cs'),
            'id_pegawai_kasir' => $this->put('id_pegawai_kasir')
        ];

        if($this->data_hewan->updateData_hewan($data,$id_hewan) > 0){
            $this->response([
                'status' => true,
                'message' => 'data_hewan sudah terupdate!'
            ], REST_Controller::HTTP_OK); 
        }else {
            $this->response([
                'status' => false,  
                'message' => 'Gagal update data_hewan!'
            ], REST_Controller::HTTP_BAD_REQUEST); 
        }

    }
}