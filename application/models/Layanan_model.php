<?php

class Layanan_model extends CI_Model{

    //untuk tampil semua data
    public function getLog($id = null){
        if($id === null){
            return $this->db->get('layanan')->result_array();
        } else{
            return $this->db->get_where('layanan', ['id_layanan' => $id]) ->result_array();
        }
        
    }

    //tidak menampilkan yang ter soft delete    
    public function getLayanan($id_layanan = null){
        if($id_layanan === null){
            return $this->db->get_where('layanan', ['delete_at' => null])->result_array();
        } else{
            return $this->db->get_where('layanan', ['id_layanan' => $id_layanan]) ->result_array();
        }
        
    }

    //ascending harga
    public function getHargaAsc(){
        $this->db->order_by('harga', 'ASC');
        $query = $this->db->get_where('layanan', ['delete_at' => null]);
        return $query->result_array();
        // return $this->db->query("SELECT * from produk ORDER BY 'stok' ASC")->result_array();
    }

    //ascending harga
    public function getHargaDesc(){
        $this->db->order_by('harga', 'DESC');
        $query = $this->db->get_where('layanan', ['delete_at' => null]);
        return $query->result_array();
        // return $this->db->query("SELECT * from produk ORDER BY 'stok' ASC")->result_array();
    }

    public function deleteLayanan($data,$id_layanan){
        $this->db->update('layanan' , $data , ['id_layanan' => $id_layanan]);
        return $this->db->affected_rows();
    }

    public function hardDelete($id_layanan){
        $this->db->delete('layanan' , ['id_layanan' => $id_layanan]);
        return $this->db->affected_rows();
    }

    public function createLayanan($data){
        $this->db->insert('layanan', $data);
        return $this->db->affected_rows();
    }

    public function updateLayanan($data,$id_layanan){
        $this->db->update('layanan' , $data , ['id_layanan' => $id_layanan]);
        return $this->db->affected_rows();
    }
}