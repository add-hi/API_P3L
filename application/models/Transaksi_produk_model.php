<?php

class Transaksi_produk_model extends CI_Model{

    //untuk tampil semua data
    public function getLog($id = null){
        if($id === null){
            return $this->db->get('transaksi_produk')->result_array();
        } else{
            return $this->db->get_where('transaksi_produk', ['id_transaksi_produk' => $id]) ->result_array();
        }
        
    }

    //tidak menampilkan yang ter soft delete  
    public function getTransaksi_produk($id_transaksi_produk = null){
        if($id_transaksi_produk === null){
            return $this->db->get_where('transaksi_produk', ['delete_at' => null])->result_array();
        } else{
            return $this->db->get_where('transaksi_produk', ['id_transaksi_produk' => $id_transaksi_produk]) ->result_array();
        }
        
    }

    public function deleteTransaksi_produk($data,$id_transaksi_produk){
        $this->db->update('transaksi_produk' , $data , ['id_transaksi_produk' => $id_transaksi_produk]);
        return $this->db->affected_rows();
    }
    
    public function hardDelete($id_transaksi_produk){
        $this->db->delete('transaksi_produk' , ['id_transaksi_produk' => $id_transaksi_produk]);
        return $this->db->affected_rows();
    }

    public function createTransaksi_produk($data){
        $this->db->insert('transaksi_produk', $data);
        return $this->db->affected_rows();
    }

    public function updateTransaksi_produk($data,$id_transaksi_produk){
        $this->db->update('transaksi_produk' , $data , ['id_transaksi_produk' => $id_transaksi_produk]);
        return $this->db->affected_rows();
    }
}