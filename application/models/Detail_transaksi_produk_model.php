<?php

class Detail_transaksi_produk_model extends CI_Model{

    public function getDetail_transaksi_produk($id_detail_produk = null){
        if($id_detail_produk === null){
            return $this->db->get('detail_transaksi_produk')->result_array();
        } else{
            return $this->db->get_where('detail_transaksi_produk', ['id_detail_produk' => $id_detail_produk]) ->result_array();
        }
        
    }

    public function deleteDetail_transaksi_produk($id_detail_produk){
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