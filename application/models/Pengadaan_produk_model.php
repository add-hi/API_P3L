<?php

class Pengadaan_produk_model extends CI_Model{

    //untuk tampil semua data
    public function getLog($id_pengadaan = null){
        if($id_pengadaan === null){
            return $this->db->get('pengadaan_produk')->result_array();
        } else{
            return $this->db->get_where('pengadaan_produk', ['id_pengadaan' => $id_pengadaan]) ->result_array();
        }
    }

    //tidak menampilkan yang ter soft delete 
    public function getPengadaan_produk($id_pengadaan = null){
        if($id_pengadaan === null){
            return $this->db->query("SELECT PP.id_pengadaan, PP.status, PP.id_supplier, M.nama as nama_supplier ,PP.created_at, PP.update_at, PP.delete_at, PP.printed_at, PP.pengeluaran FROM pengadaan_produk PP JOIN supplier M ON (PP.id_supplier=M.id_supplier) WHERE PP.delete_at IS NULL ORDER BY PP.id_pengadaan DESC")->result_array();
        } else{
            return $this->db->query("SELECT PP.id_pengadaan, PP.status, PP.id_supplier, M.nama as nama_supplier,PP.created_at, PP.update_at, PP.delete_at, PP.printed_at, PP.pengeluaran FROM pengadaan_produk PP JOIN supplier M ON (PP.id_supplier=M.id_supplier) WHERE PP.delete_at IS NULL AND PP.id_pengadaan = '$id_pengadaan'") ->result_array();
        }
        
    }

    public function deletePengadaan_produk($data,$id_pengadaan){
        $this->db->update('pengadaan_produk' , $data , ['id_pengadaan' => $id_pengadaan]);
        return $this->db->affected_rows();
    }

    public function hardDelete($id_pengadaan){
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

    public function konfirmasi_barang($data,$id_pengadaan){
        $this->db->query("UPDATE pengadaan_produk SET status = '$data' WHERE id_pengadaan = '$id_pengadaan'");
        return $this->db->affected_rows();
    }

    public function update_stok($id_produk,$tambah_stok){

        $this->db->select('stok');
        $this->db->from('produk');
        $this->db->where('id_produk',$id_produk);
    
        $data = $this->db->get()->result();
        $current_stok = $data[0]->stok;

        $tambah = $tambah_stok + $current_stok;

        $updateProduk = [
            'stok' => $tambah
        ];

        if($this->db->where('id_produk',$id_produk)->update('produk', $updateProduk)){
            return $this->db->affected_rows();
        }
    }
}