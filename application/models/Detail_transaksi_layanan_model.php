<?php

class Detail_transaksi_layanan_model extends CI_Model{

    //untuk tampil semua data
    public function getLog($id_detail_layanan = null){
        if($id_detail_layanan === null){
            return $this->db->get('detail_transaksi_layanan')->result_array();
        } else{
            return $this->db->get_where('detail_transaksi_layanan', ['id_detail_layanan' => $id_detail_layanan]) ->result_array();
        }
        
    }

    //tidak menampilkan yang ter soft delete   
    public function getDetail_transaksi_layanan($id_detail_layanan = null){
        if($id_detail_layanan === null){
            return $this->db->get_where('detail_transaksi_layanan', ['delete_at' => null])->result_array();
        } else{
            return $this->db->get_where('detail_transaksi_layanan', ['id_detail_layanan' => $id_detail_layanan]) ->result_array();
        }
        
    }

    public function deleteDetail_transaksi_layanan($data,$id_detail_layanan){
        $this->db->update('detail_transaksi_layanan' , $data , ['id_detail_layanan' => $id_detail_layanan]);
        return $this->db->affected_rows();
    }

    public function hardDelete($id_detail_layanan){
        $this->db->delete('detail_transaksi_layanan' , ['id_detail_layanan' => $id_detail_layanan]);
        return $this->db->affected_rows();
    }

    public function createDetail_transaksi_layanan($data){
        $this->db->insert('detail_transaksi_layanan', $data);
        return $this->db->affected_rows();
    }

    public function updateDetail_transaksi_layanan($data,$id_detail_layanan){
        $this->db->update('detail_transaksi_layanan' , $data , ['id_detail_layanan' => $id_detail_layanan]);
        return $this->db->affected_rows();
    }
}