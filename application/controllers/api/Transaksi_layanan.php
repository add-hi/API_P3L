<?php

use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/Format.php';
require APPPATH . 'libraries/REST_Controller.php';

class Transaksi_layanan extends REST_Controller
{
    public function __construct(){
        parent::__construct();
        $this->load->model('Transaksi_layanan_model' , 'transaksi_layanan');
    }

    //id Format

    public function id_format(){
        $temp = "LY-".date("d").date("m").date("y")."-";
        $this->db->select('id_transaksi_layanan');
        $this->db->from('transaksi_layanan');
        $this->db->like('id_transaksi_layanan',$temp);

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

    public function index_get(){
        $id_transaksi_layanan = $this->get('id_transaksi_layanan');

        if($id_transaksi_layanan === null)
        {
            $transaksi_layanan = $this->transaksi_layanan->getTransaksi_layanan();
        } else{
            $transaksi_layanan = $this->transaksi_layanan->getTransaksi_layanan($id_transaksi_layanan);
        }
        
        if($transaksi_layanan){
            $this->response([
                'status' => TRUE,
                'data' => $transaksi_layanan
            ], REST_Controller::HTTP_OK); 
        } else {
            $this->response([
                'status' => false,
                'message' => 'id tidak ditemukan!'
            ], REST_Controller::HTTP_NOT_FOUND); 
        }
    }

    public function log_get(){
        $id = $this->get('id_transaksi_layanan');

        if($id === null)
        {
            $transaksi_layanan = $this->transaksi_layanan->getLog();
        } else{
            $transaksi_layanan = $this->transaksi_layanan->getTransaksi_layanan($id);
        }
        
        if($transaksi_layanan){
            $this->response([
                'status' => TRUE,
                'data' => $transaksi_layanan
            ], REST_Controller::HTTP_OK); 
        } else {
            $this->response([
                'status' => false,
                'message' => 'id tidak ditemukan!'
            ], REST_Controller::HTTP_NOT_FOUND); 
        }
    }

    public function delete_post(){
        $id = $this->post('id_transaksi_layanan');
        $data = [
          'delete_at' => date('Y-m-d H:i:s')
        ];
  
        $query = $this->db->get_where('transaksi_layanan',['id_transaksi_layanan'=> $id]);
  
      foreach ($query->result() as $row)
      {
          $cek = $row->delete_at;
      }
  
        if($cek === null){
          if($this->transaksi_layanan->deleteTransaksiLayanan($data, $id) > 0) {
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
        $id_transaksi_layanan = $this->delete('id_transaksi_layanan');

        if($id_transaksi_layanan === null){
            $this->response([
                'status' => false,
                'message' => 'id transaksi_layanan yang ingin dihapus tidak ditemukan!'
            ], REST_Controller::HTTP_BAD_REQUEST); 
        } else{
            if( $this->transaksi_layanan->hardDelete($id_transaksi_layanan) > 0){
                //OKE
                $this->response([
                    'status' => FALSE,
                    'id_transaksi_layanan' => $id_transaksi_layanan,
                    'message' => 'transaksi_layanan sudah terhapus!'
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
            'id_transaksi_layanan' => $this->id_format(),
            'id_member' => $this->post('id_member'),
            'id_hewan' => $this->post('id_hewan'),
            'diskon' => $this->post('diskon'),
            'total_harga' => $this->post('total_harga'),
            'sub_total' => $this->post('sub_total'),
            'status_layanan' => $this->post('status_layanan'),
            'status_pembayaran' => $this->post('status_pembayaran'),
            'tgl_selesai' => $this->post('tgl_selesai'),
            'id_pegawai_cs' => $this->post('id_pegawai_cs'),
            'id_pegawai_kasir' => $this->post('id_pegawai_kasir')

        ];

        if($this->transaksi_layanan->createTransaksi_layanan($data) > 0){
            $this->response([
                'status' => TRUE,
                'message' => 'transaksi_layanan sudah terinput!'
            ], REST_Controller::HTTP_CREATED); 
        }else {
            $this->response([
                'status' => false,  
                'message' => 'Gagal menambahkan transaksi_layanan!'
            ], REST_Controller::HTTP_BAD_REQUEST); 
        }
    }

    public function ubahStatus_put(){
        $id_transaksi_layanan = $this->put('id_transaksi_layanan');
        if($this->transaksi_layanan->ubahStatus($id_transaksi_layanan) > 0){
            $this->response([
                'status' => true,
                'message' => 'ubah status transaksi_layanan berhasil!'
            ], REST_Controller::HTTP_OK); 
        }else {
            $this->response([
                'status' => false,  
                'message' => 'Gagal ubah status transaksi_layanan!'
            ], REST_Controller::HTTP_BAD_REQUEST); 
        }
    }

    public function index_put(){

        $id_transaksi_layanan = $this->put('id_transaksi_layanan');

        $data = [
            'id_member' => $this->put('id_member'),
            'id_hewan' => $this->put('id_hewan'),
            'diskon' => $this->put('diskon'),
            'total_harga' => $this->put('total_harga'),
            'sub_total' => $this->put('sub_total'),
            'status_layanan' => $this->put('status_layanan'),
            'status_pembayaran' => $this->put('status_pembayaran'),
            'tgl_selesai' => $this->put('tgl_selesai'),
            'id_pegawai_cs' => $this->put('id_pegawai_cs'),
            'id_pegawai_kasir' => $this->put('id_pegawai_kasir')
        ];

        if($this->transaksi_layanan->updateTransaksi_layanan($data,$id_transaksi_layanan) > 0){
            $this->response([
                'status' => true,
                'message' => 'transaksi_layanan sudah terupdate!'
            ], REST_Controller::HTTP_OK); 
        }else {
            $this->response([
                'status' => false,  
                'message' => 'Gagal update transaksi_layanan!'
            ], REST_Controller::HTTP_BAD_REQUEST); 
        }

    }
}