<?php

class Transaksi_layanan_model extends CI_Model{

    //untuk tampil semua data
    public function getLog($id = null){
        if($id === null){
            return $this->db->get('transaksi_layanan')->result_array();
        } else{
            return $this->db->get_where('transaksi_layanan', ['id_uid_transaksi_layanankuran' => $id]) ->result_array();
        }
        
    }

    //tidak menampilkan yang ter soft delete 
    public function getTransaksi_layanan($id_transaksi_layanan = null){
        if($id_transaksi_layanan === null){
            return $this->db->get_where('transaksi_layanan', ['delete_at' => null])->result_array();
        } else{
            return $this->db->get_where('transaksi_layanan', ['id_transaksi_layanan' => $id_transaksi_layanan]) ->result_array();
        }
        
    }

    public function deleteTransaksiLayanan($data,$id_transaksi_layanan){
        $this->db->update('transaksi_layanan' , $data , ['id_transaksi_layanan' => $id_transaksi_layanan]);
        return $this->db->affected_rows();
    }

    public function hardDelete($id_transaksi_layanan){
        $this->db->delete('transaksi_layanan' , ['id_transaksi_layanan' => $id_transaksi_layanan]);
        return $this->db->affected_rows();
    }

    public function createTransaksi_layanan($data){
        $this->db->insert('transaksi_layanan', $data);
        return $this->db->affected_rows();
    }

    public function updateTransaksi_layanan($data,$id_transaksi_layanan){
        $this->db->update('transaksi_layanan' , $data , ['id_transaksi_layanan' => $id_transaksi_layanan]);
        return $this->db->affected_rows();
    }
}