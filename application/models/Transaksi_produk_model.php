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
            return $this->db->query("SELECT TP.id_transaksi_produk, TP.id_member, TP.total_harga, TP.diskon, TP.sub_total, TP.created_at, TP.update_at, TP.delete_at, TP.id_pegawai_cs, TP.id_pegawai_kasir, TP.id_hewan , M.nama AS nama_member , DH.nama AS nama_hewan  FROM transaksi_produk TP JOIN member M ON (TP.id_member = M.id_member) JOIN data_hewan DH ON (TP.id_hewan = DH.id_hewan) WHERE TP.delete_at IS NULL ORDER BY TP.id_transaksi_produk DESC")->result_array();
        } else{
            return $this->db->query("SELECT TP.id_transaksi_produk, TP.id_member, TP.total_harga, TP.diskon, TP.sub_total, TP.created_at, TP.update_at, TP.delete_at, TP.id_pegawai_cs, TP.id_pegawai_kasir, TP.id_hewan , M.nama AS nama_member , DH.nama AS nama_hewan  FROM transaksi_produk TP JOIN member M ON (TP.id_member = M.id_member) JOIN data_hewan DH ON (TP.id_hewan = DH.id_hewan) WHERE TP.id_transaksi_produk = '$id_transaksi_produk' AND TP.delete_at IS NULL ORDER BY TP.id_transaksi_produk DESC")->result_array();
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