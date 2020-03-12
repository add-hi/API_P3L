<?php

use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/Format.php';
require APPPATH . 'libraries/REST_Controller.php';

class Produk extends REST_Controller
{
    public function __construct(){
        parent::__construct();
        $this->load->model('Produk_model' , 'produk');
    }

    public function index_get(){
        $id_produk = $this->get('id_produk');

        if($id_produk === null)
        {
            $produk = $this->produk->getProduk();
        } else{
            $produk = $this->produk->getProduk($id_produk);
        }
        
        if($produk){
            $this->response([
                'status' => TRUE,
                'data' => $produk
            ], REST_Controller::HTTP_OK); 
        } else {
            $this->response([
                'status' => false,
                'message' => 'id tidak ditemukan!'
            ], REST_Controller::HTTP_NOT_FOUND); 
        }
    }

    public function index_delete(){
        $id_produk = $this->delete('id_produk');

        if($id_produk === null){
            $this->response([
                'status' => false,
                'message' => 'id produk yang ingin dihapus tidak ditemukan!'
            ], REST_Controller::HTTP_BAD_REQUEST); 
        } else{
            if( $this->produk->deleteProduk($id_produk) > 0){
                //OKE
                $this->response([
                    'status' => FALSE,
                    'id_produk' => $id_produk,
                    'message' => 'produk sudah terhapus!'
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
            'unit' => $this->post('unit'),
            'stok' => $this->post('stok'),
            'min_stok' => $this->post('min_stok'),
            'harga' => $this->post('harga'),
            'foto' => $this->post('foto')
        ];

        if($this->produk->createProduk($data) > 0){
            $this->response([
                'status' => TRUE,
                'message' => 'produk sudah terinput!'
            ], REST_Controller::HTTP_CREATED); 
        }else {
            $this->response([
                'status' => false,  
                'message' => 'Gagal menambahkan produk!'
            ], REST_Controller::HTTP_BAD_REQUEST); 
        }
    }

    public function index_put(){

        $id_produk = $this->put('id_produk');

        $data = [
            'nama' => $this->put('nama'),
            'unit' => $this->put('unit'),
            'stok' => $this->put('stok'),
            'min_stok' => $this->put('min_stok'),
            'harga' => $this->put('harga'),
            'foto' => $this->put('foto')
        ];

        if($this->produk->updateProduk($data,$id_produk) > 0){
            $this->response([
                'status' => true,
                'message' => 'produk sudah terupdate!'
            ], REST_Controller::HTTP_OK); 
        }else {
            $this->response([
                'status' => false,  
                'message' => 'Gagal update produk!'
            ], REST_Controller::HTTP_BAD_REQUEST); 
        }

    }
}