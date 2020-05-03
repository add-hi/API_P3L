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
            return $this->db->query("SELECT TL.id_transaksi_layanan, TL.id_member, TL.id_hewan,TL.diskon, TL.total_harga, TL.sub_total, TL.status_layanan, TL.status_pembayaran, TL.created_at, TL.tgl_selesai, TL.delete_at, TL.id_pegawai_cs, TL.id_pegawai_kasir , DH.nama AS nama_hewan ,  M.nama AS nama_member FROM transaksi_layanan TL JOIN data_hewan DH ON (TL.id_hewan=DH.id_hewan) JOIN member M ON (TL.id_member = M.id_member) WHERE TL.delete_at IS NULL ORDER BY TL.id_transaksi_layanan DESC")->result_array();
        } else{
            return $this->db->query("SELECT TL.id_transaksi_layanan, TL.id_member, TL.id_hewan,TL.diskon, TL.total_harga, TL.sub_total, TL.status_layanan, TL.status_pembayaran, TL.created_at, TL.tgl_selesai, TL.delete_at, TL.id_pegawai_cs, TL.id_pegawai_kasir , DH.nama AS nama_hewan ,  M.nama AS nama_member FROM transaksi_layanan TL JOIN data_hewan DH ON (TL.id_hewan=DH.id_hewan) JOIN member M ON (TL.id_member = M.id_member) WHERE TL.delete_at IS NULL AND id_transaski_layanan = '$id_transaksi_layanan' ORDER BY TL.id_transaksi_layanan DESC") ->result_array();
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

    public function ubahStatus($id_transaksi_layanan){
        $this->db->query("UPDATE transaksi_layanan SET status_layanan = 'selesai' WHERE id_transaksi_layanan = '$id_transaksi_layanan'");
        return $this->db->affected_rows();
    }
}