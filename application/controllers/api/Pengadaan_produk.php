<?php

use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/Format.php';
require APPPATH . 'libraries/REST_Controller.php';

class Pengadaan_produk extends REST_Controller
{
    public function __construct(){
        parent::__construct();
        $this->load->model('Pengadaan_produk_model' , 'pengadaan_produk');
    }

    public function index_get(){
        $id_pengadaan = $this->get('id_pengadaan');

        if($id_pengadaan === null)
        {
            $pengadaan_produk = $this->pengadaan_produk->getPengadaan_produk();
        } else{
            $pengadaan_produk = $this->pengadaan_produk->getPengadaan_produk($id_pengadaan);
        }
        
        if($pengadaan_produk){
            $this->response([
                'status' => TRUE,
                'data' => $pengadaan_produk
            ], REST_Controller::HTTP_OK); 
        } else {
            $this->response([
                'status' => false,
                'message' => 'id tidak ditemukan!'
            ], REST_Controller::HTTP_NOT_FOUND); 
        }
    }

    public function log_get(){
        $id = $this->get('id_pengadaan');

        if($id === null)
        {
            $pengadaan_produk = $this->pengadaan_produk->getLog();
        } else{
            $pengadaan_produk = $this->pengadaan_produk->getPengadaan_produk($id);
        }
        
        if($pengadaan_produk){
            $this->response([
                'status' => TRUE,
                'data' => $pengadaan_produk
            ], REST_Controller::HTTP_OK); 
        } else {
            $this->response([
                'status' => false,
                'message' => 'id tidak ditemukan!'
            ], REST_Controller::HTTP_NOT_FOUND); 
        }
    }

    public function delete_post(){
        $id = $this->post('id_pengadaan');
        $data = [
          'delete_at' => date('Y-m-d H:i:s')
        ];
  
        $query = $this->db->get_where('pengadaan_produk',['id_pengadaan'=> $id]);
  
      foreach ($query->result() as $row)
      {
          $cek = $row->delete_at;
      }
  
        if($cek === null){
          if($this->pengadaan_produk->deletePengadaan_produk($data, $id) > 0) {
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
        $id_pengadaan = $this->delete('id_pengadaan');

        if($id_pengadaan === null){
            $this->response([
                'status' => false,
                'message' => 'id pengadaan_produk yang ingin dihapus tidak ditemukan!'
            ], REST_Controller::HTTP_BAD_REQUEST); 
        } else{
            if( $this->pengadaan_produk->hardDelete($id_pengadaan) > 0){
                //OKE
                $this->response([
                    'status' => FALSE,
                    'id_pengadaan' => $id_pengadaan,
                    'message' => 'pengadaan_produk sudah terhapus!'
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
            'status' => $this->post('status'),
            'id_supplier' => $this->post('id_supplier'),
            'printed_at' => $this->post('printed_at'),
            'pengeluaran' => $this->post('pengeluaran')
        ];

        if($this->pengadaan_produk->createPengadaan_produk($data) > 0){
            $this->response([
                'status' => TRUE,
                'message' => 'pengadaan_produk sudah terinput!'
            ], REST_Controller::HTTP_CREATED); 
        }else {
            $this->response([
                'status' => false,  
                'message' => 'Gagal menambahkan pengadaan_produk!'
            ], REST_Controller::HTTP_BAD_REQUEST); 
        }
    }

    public function index_put(){

        $id_pengadaan = $this->put('id_pengadaan');

        $data = [
            'status' => $this->put('status'),
            'id_supplier' => $this->put('id_supplier'),
            'printed_at' => $this->put('printed_at'),
            'pengeluaran' => $this->put('pengeluaran')
        ];

        if($this->pengadaan_produk->updatePengadaan_produk($data,$id_pengadaan) > 0){
            $this->response([
                'status' => true,
                'message' => 'pengadaan_produk sudah terupdate!'
            ], REST_Controller::HTTP_OK); 
        }else {
            $this->response([
                'status' => false,  
                'message' => 'Gagal update pengadaan_produk!'
            ], REST_Controller::HTTP_BAD_REQUEST); 
        }

    }
}