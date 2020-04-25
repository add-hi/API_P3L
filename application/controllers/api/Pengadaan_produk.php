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

    
    //id Format

    public function id_get(){
        $temp = "PO-".date("Y")."-".date("m")."-".date("d")."-";
        $this->db->select('id_pengadaan');
        $this->db->from('pengadaan_produk');
        $this->db->like('id_pengadaan',$temp);

        $id_format = $this->db->get()->result();
        if($id_format == null){
            return $temp."0"."1";
        }else if (count($id_format)>=9){
            $i = count($id_format)+1;
            return $temp.$i;
        }else{
            $i = count($id_format)+1;
            return $temp."0".$i;
        }
    }

    public function updateProduk_post(){
        $id_produk = $this->post('id_produk');
        $tambah_stok = $this->post('tambah_stok');

        $response = $this->pengadaan_produk->update_stok($id_produk,$tambah_stok);
        if($response > 0){
            $this->response([
                'status' => TRUE,
                'message' => 'Berhasil'
            ], REST_Controller::HTTP_OK); 
        }else{
            $this->response([
                'status' => false,
                'message' => 'id tidak ditemukan!'
            ], REST_Controller::HTTP_NOT_FOUND); 
        }
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
            'id_pengadaan' => $this->id_get(),
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

    public function konfirmasi_put(){
        $id_pengadaan = $this->put('id_pengadaan');
        $data = $this->put('status');
        if($this->pengadaan_produk->konfirmasi_barang($data,$id_pengadaan) > 0){
            $this->response([
                'status' => true,
                'message' => 'pengadaan_produk sudah terkonfirmasi!'
            ], REST_Controller::HTTP_OK); 
        }else {
            $this->response([
                'status' => false,  
                'message' => 'Gagal konfirmasi pengadaan_produk!'
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