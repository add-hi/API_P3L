<?php

use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/Format.php';
require APPPATH . 'libraries/REST_Controller.php';

class Detail_transaksi_produk extends REST_Controller
{
    public function __construct(){
        parent::__construct();
        $this->load->model('Detail_transaksi_produk_model' , 'detail_transaksi_produk');
    }

    public function index_get(){
        $id_detail_produk = $this->get('id_detail_produk');

        if($id_detail_produk === null)
        {
            $detail_transaksi_produk = $this->detail_transaksi_produk->getDetail_transaksi_produk();
        } else{
            $detail_transaksi_produk = $this->detail_transaksi_produk->getDetail_transaksi_produk($id_detail_produk);
        }
        
        if($detail_transaksi_produk){
            $this->response([
                'status' => TRUE,
                'data' => $detail_transaksi_produk
            ], REST_Controller::HTTP_OK); 
        } else {
            $this->response([
                'status' => false,
                'message' => 'id tidak ditemukan!'
            ], REST_Controller::HTTP_NOT_FOUND); 
        }
    }

    public function index_delete(){
        $id_detail_produk = $this->delete('id_detail_produk');

        if($id_detail_produk === null){
            $this->response([
                'status' => false,
                'message' => 'id detail_produk yang ingin dihapus tidak ditemukan!'
            ], REST_Controller::HTTP_BAD_REQUEST); 
        } else{
            if( $this->detail_transaksi_produk->deleteDetail_transaksi_produk($id_detail_produk) > 0){
                //OKE
                $this->response([
                    'status' => FALSE,
                    'id_detail_produk' => $id_detail_produk,
                    'message' => 'detail_produk sudah terhapus!'
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
            'id_transaksi_produk' => $this->post('id_transaksi_produk'),
            'id_produk' => $this->post('id_produk'),
            'jumlah' => $this->post('jumlah'),
            'sub_harga' => $this->post('sub_harga')
        ];

        if($this->detail_transaksi_produk->createDetail_transaksi_produk($data) > 0){
            $this->response([
                'status' => TRUE,
                'message' => 'detail_transaksi_produk sudah terinput!'
            ], REST_Controller::HTTP_CREATED); 
        }else {
            $this->response([
                'status' => false,  
                'message' => 'Gagal menambahkan detail_transaksi_produk!'
            ], REST_Controller::HTTP_BAD_REQUEST); 
        }
    }

    public function index_put(){

        $id_detail_produk = $this->put('id_detail_produk');

        $data = [
            'id_transaksi_produk' => $this->put('id_transaksi_produk'),
            'id_produk' => $this->put('id_produk'),
            'jumlah' => $this->put('jumlah'),
            'sub_harga' => $this->put('sub_harga')
        ];

        if($this->detail_transaksi_produk->updateDetail_transaksi_produk($data,$id_detail_produk) > 0){
            $this->response([
                'status' => true,
                'message' => 'detail_produk sudah terupdate!'
            ], REST_Controller::HTTP_OK); 
        }else {
            $this->response([
                'status' => false,  
                'message' => 'Gagal update detail_produk!'
            ], REST_Controller::HTTP_BAD_REQUEST); 
        }

    }
}