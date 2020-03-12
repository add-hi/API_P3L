<?php

class Detail_pengadaan_produk_model extends CI_Model{

    public function getDetail_pengadaan_produk($id_detail_produk = null){
        if($id_detail_produk === null){
            return $this->db->get('detail_pengadaan_produk')->result_array();
        } else{
            return $this->db->get_where('detail_pengadaan_produk', ['id_detail_produk' => $id_detail_produk]) ->result_array();
        }
        
    }

    public function deleteDetail_pengadaan_produk($id_detail_produk){
        $this->db->delete('detail_pengadaan_produk' , ['id_detail_produk' => $id_detail_produk]);
        return $this->db->affected_rows();
    }

    public function createDetail_pengadaan_produk($data){
        $this->db->insert('detail_pengadaan_produk', $data);
        return $this->db->affected_rows();
    }

    public function updateDetail_pengadaan_produk($data,$id_detail_produk){
        $this->db->update('detail_pengadaan_produk' , $data , ['id_detail_produk' => $id_detail_produk]);
        return $this->db->affected_rows();
    }
}