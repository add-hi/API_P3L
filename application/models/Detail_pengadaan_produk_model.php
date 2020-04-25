<?php

class Detail_pengadaan_produk_model extends CI_Model{

    //untuk tampil semua data
    public function getLog($id_detail_produk = null){
        if($id_detail_produk === null){
            return $this->db->get('detail_pengadaan_produk')->result_array();
        } else{
            return $this->db->get_where('detail_pengadaan_produk', ['id_detail_produk' => $id_detail_produk]) ->result_array();
        }
        
    }

    //tidak menampilkan yang ter soft delete    
    public function getDetail_pengadaan_produk($id_pengadaan = null){
        if($id_pengadaan === null){
            return $this->db->query("SELECT DP.id_detail_produk, DP.id_pengadaan, DP.id_produk, M.nama , M.harga ,DP.jumlah, DP.delete_at, DP.sub_harga FROM detail_pengadaan_produk DP JOIN produk M ON (DP.id_produk=M.id_produk)")->result_array();
        } else{
            return $this->db->query("SELECT DP.id_detail_produk, DP.id_pengadaan, DP.id_produk, M.nama , M.harga ,DP.jumlah, DP.delete_at ,DP.sub_harga  FROM detail_pengadaan_produk DP JOIN produk M ON (DP.id_produk=M.id_produk) WHERE DP.id_pengadaan = '$id_pengadaan'") ->result_array();
        }
        
    }

    public function deleteDetail_pengadaan_produk($data,$id_detail_produk){
        $this->db->update('detail_pengadaan_produk' , $data , ['id_detail_produk' => $id_detail_produk]);
        return $this->db->affected_rows();
    }

    public function hardDelete($id_detail_produk){
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