<?php

class Produk_model extends CI_Model{
    
    //ascending harga
    public function getHarga(){
        $this->db->order_by('harga', 'ASC');
        $query = $this->db->get_where('produk', ['delete_at' => null]);
        return $query->result_array();
        // return $this->db->query("SELECT * from produk ORDER BY 'stok' ASC")->result_array();
    }

     //ascending stock
     public function getStok(){
        $this->db->order_by('stok', 'DESC');
        $query = $this->db->get_where('produk', ['delete_at' => null]);
        return $query->result_array();
        // return $this->db->query("SELECT * from produk ORDER BY 'stok' ASC")->result_array();
    }

    //untuk tampil semua data
    public function getLogProduk($id_produk = null){
        if($id_produk === null){
            return $this->db->get('produk')->result_array();
        } else{
            return $this->db->get_where('produk', ['id_produk' => $id_produk]) ->result_array();
        }
        
    }

    //tidak menampilkan yang ter soft delete
    public function getProduk($id_produk = null){
        if($id_produk === null){
            return $this->db->get_where('produk', ['delete_at' => null])->result_array();
        } else{
            return $this->db->get_where('produk', ['id_produk' => $id_produk]) ->result_array();
        }
    }

    public function deleteProduk($data, $id)
    {
        $this->db->update('produk', $data, ['id_produk' => $id]);
        return $this->db->affected_rows();
    }

    public function hardDelete($id){
        $this->db->delete('produk' , ['id_produk' => $id]);
        return $this->db->affected_rows();
    }

    public function createProduk($data){
        $this->db->insert('produk', $data);
        return $this->db->affected_rows();
    }

    public function updateProduk($data,$id_produk){
        $this->db->update('produk' , $data , ['id_produk' => $id_produk]);
        return $this->db->affected_rows();
    }

    //upload foto

    public function fotoProduk($data, $id)
    {
        $this->db->update('produk', $data, ['id_produk' => $id]);
        return $this->db->affected_rows();
    }

}