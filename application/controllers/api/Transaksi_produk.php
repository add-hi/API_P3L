<?php

use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/Format.php';
require APPPATH . 'libraries/REST_Controller.php';

class Transaksi_produk extends REST_Controller
{
    public function __construct(){
        parent::__construct();
        $this->load->model('Transaksi_produk_model' , 'transaksi_produk');
    }

    public function index_get(){
        $id_transaksi_produk = $this->get('id_transaksi_produk');

        if($id_transaksi_produk === null)
        {
            $transaksi_produk = $this->transaksi_produk->getTransaksi_produk();
        } else{
            $transaksi_produk = $this->transaksi_produk->getTransaksi_produk($id_transaksi_produk);
        }
        
        if($transaksi_produk){
            $this->response([
                'status' => TRUE,
                'data' => $transaksi_produk
            ], REST_Controller::HTTP_OK); 
        } else {
            $this->response([
                'status' => false,
                'message' => 'id tidak ditemukan!'
            ], REST_Controller::HTTP_NOT_FOUND); 
        }
    }

    public function index_delete(){
        $id_transaksi_produk = $this->delete('id_transaksi_produk');

        if($id_transaksi_produk === null){
            $this->response([
                'status' => false,
                'message' => 'id transaksi_produk yang ingin dihapus tidak ditemukan!'
            ], REST_Controller::HTTP_BAD_REQUEST); 
        } else{
            if( $this->transaksi_produk->deleteTransaksi_produk($id_transaksi_produk) > 0){
                //OKE
                $this->response([
                    'status' => FALSE,
                    'id_transaksi_produk' => $id_transaksi_produk,
                    'message' => 'transaksi_produk sudah terhapus!'
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
            'total_harga' => $this->post('total_harga'),
            'diskon' => $this->post('diskon'),
            'sub_total' => $this->post('sub_total'),
            'id_pegawai_cs' => $this->post('id_pegawai_cs'),
            'id_pegawai_kasir' => $this->post('id_pegawai_kasir')
        ];

        if($this->transaksi_produk->createTransaksi_produk($data) > 0){
            $this->response([
                'status' => TRUE,
                'message' => 'transaksi_produk sudah terinput!'
            ], REST_Controller::HTTP_CREATED); 
        }else {
            $this->response([
                'status' => false,  
                'message' => 'Gagal menambahkan transaksi_produk!'
            ], REST_Controller::HTTP_BAD_REQUEST); 
        }
    }

    public function index_put(){

        $id_transaksi_produk = $this->put('id_transaksi_produk');

        $data = [
            'id_member' => $this->put('id_member'),
            'total_harga' => $this->put('total_harga'),
            'diskon' => $this->put('diskon'),
            'sub_total' => $this->put('sub_total'),
            'id_pegawai_cs' => $this->put('id_pegawai_cs'),
            'id_pegawai_kasir' => $this->put('id_pegawai_kasir')
        ];

        if($this->transaksi_produk->updateTransaksi_produk($data,$id_transaksi_produk) > 0){
            $this->response([
                'status' => true,
                'message' => 'transaksi_produk sudah terupdate!'
            ], REST_Controller::HTTP_OK); 
        }else {
            $this->response([
                'status' => false,  
                'message' => 'Gagal update transaksi_produk!'
            ], REST_Controller::HTTP_BAD_REQUEST); 
        }

    }
}