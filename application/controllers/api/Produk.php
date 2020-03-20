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

    public function delete_post(){
      $id = $this->post('id_produk');
      $data = [
        'delete_at' => date('Y-m-d H:i:s')
      ];

      $query = $this->db->get_where('produk',['id_produk'=> $id]);

    foreach ($query->result() as $row)
    {
        $cek = $row->delete_at;
    }

      if($cek === null){
        if($this->produk->deleteProduk($data, $id) > 0) {
            $this->response([
              'status' => true,
              'id' => $id,
              'message' => 'berhasil soft delete :)'
            ],  REST_Controller::HTTP_OK);
          } else {
            $this->response([
              'status' => false,
              'message' => 'gagal soft delete'
            ], REST_Controller::HTTP_BAD_REQUEST);
          }
      }else{
        $this->response([
            'status' => false,
            'message' => 'data sudah di delete sebelumnya'
          ], REST_Controller::HTTP_BAD_REQUEST);
      }

    }

    public function index_delete(){
        $id = $this->delete('id_produk');

        if($id === null){
            $this->response([
                'status' => false,
                'message' => 'id produk yang ingin dihapus tidak ditemukan!'
            ], REST_Controller::HTTP_BAD_REQUEST); 
        } else{
            if( $this->produk->hardDelete($id) > 0){
                //OKE
                $this->response([
                    'status' => FALSE,
                    'id_produk' => $id,
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

    private function image_upload()
	{
		$config['upload_path']          = './upload/produk/';
		$config['allowed_types']        = 'gif|jpg|png|JPG|PNG|jpeg';
        $config['encrypt_name']			= TRUE;

		$this->load->library('upload', $config);

		if ($this->upload->do_upload("foto")) {
            $data = array('upload_data' => $this->upload->data());
			return $data['upload_data']['file_name']; 
        }
        else{
            return NULL;
        }
		print_r($this->upload->display_errors());
	}
}