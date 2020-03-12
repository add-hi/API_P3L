<?php

class Transaksi_layanan_model extends CI_Model{

    public function getTransaksi_layanan($id_transaksi_layanan = null){
        if($id_transaksi_layanan === null){
            return $this->db->get('transaksi_layanan')->result_array();
        } else{
            return $this->db->get_where('transaksi_layanan', ['id_transaksi_layanan' => $id_transaksi_layanan]) ->result_array();
        }
        
    }

    public function deleteTransaksi_layanan($id_transaksi_layanan){
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