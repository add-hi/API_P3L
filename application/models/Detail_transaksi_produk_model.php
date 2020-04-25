<?php

class Detail_transaksi_produk_model extends CI_Model{

    //tidak menampilkan yang ter soft delete 
    public function getDetail_transaksi_produk($id_transaksi_produk = null){
        if($id_transaksi_produk === null){
            return $this->db->query("SELECT DT.id_detail_produk, DT.id_transaksi_produk, DT.id_produk, DT.jumlah, DT.delete_at, DT.sub_harga , P.nama AS nama_produk , P.foto AS foto FROM detail_transaksi_produk DT JOIN produk P ON (DT.id_produk=P.id_produk)")->result_array();
        } else{
            return $this->db->query("SELECT DT.id_detail_produk, DT.id_transaksi_produk, DT.id_produk, DT.jumlah, DT.delete_at, DT.sub_harga , P.nama AS nama_produk , P.foto AS foto FROM detail_transaksi_produk DT JOIN produk P ON (DT.id_produk=P.id_produk) WHERE DT.id_transaksi_produk = '$id_transaksi_produk'") ->result_array();
        }
        
    }

    //untuk tampil semua data
    public function getLog($id_detail_produk = null){
        if($id_detail_produk === null){
            return $this->db->get_where('detail_transaksi_produk', ['delete_at' => null])->result_array();
        } else{
            return $this->db->get_where('detail_transaksi_produk', ['id_detail_produk' => $id_detail_produk]) ->result_array();
        }
        
    }

    public function deleteDetail_transaksi_produk($data,$id_detail_produk){
        $this->db->update('detail_transaksi_produk' , $data , ['id_detail_produk' => $id_detail_produk]);
        return $this->db->affected_rows();
    }

    public function hardDelete($id_detail_produk){
        $this->db->delete('detail_transaksi_produk' , ['id_detail_produk' => $id_detail_produk]);
        return $this->db->affected_rows();
    }

    public function createDetail_transaksi_produk($data){
        $this->db->insert('detail_transaksi_produk', $data);
        return $this->db->affected_rows();
    }

    public function updateDetail_transaksi_produk($data,$id_detail_produk){
        $this->db->update('detail_transaksi_produk' , $data , ['id_detail_produk' => $id_detail_produk]);
        return $this->db->affected_rows();
    }
}