<?php

class Pengadaan_produk_model extends CI_Model{

    public function getPengadaan_produk($id_pengadaan = null){
        if($id_pengadaan === null){
            return $this->db->get('pengadaan_produk')->result_array();
        } else{
            return $this->db->get_where('pengadaan_produk', ['id_pengadaan' => $id_pengadaan]) ->result_array();
        }
        
    }

    public function deletePengadaan_produk($id_pengadaan){
        $this->db->delete('pengadaan_produk' , ['id_pengadaan' => $id_pengadaan]);
        return $this->db->affected_rows();
    }

    public function createPengadaan_produk($data){
        $this->db->insert('pengadaan_produk', $data);
        return $this->db->affected_rows();
    }

    public function updatePengadaan_produk($data,$id_pengadaan){
        $this->db->update('pengadaan_produk' , $data , ['id_pengadaan' => $id_pengadaan]);
        return $this->db->affected_rows();
    }
}