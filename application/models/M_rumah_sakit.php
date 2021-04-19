<?php
date_default_timezone_set("Asia/Jakarta");
class M_rumah_sakit extends CI_Model{

     private $id_pk_rs;
     private $rs_kode;
     private $rs_nama;
     private $rs_kelas;
     private $rs_direktur;
     private $rs_alamat;
     private $rs_kategori;
     private $id_fk_kabupaten;
     private $rs_kode_pos;
     private $rs_telepon;
     private $rs_fax;
     private $id_fk_jenis_rs;
     private $id_fk_penyelenggara;
     private $rs_status;
     private $rs_tgl_create;
     private $rs_tgl_edit;
     private $rs_tgl_delete;
     private $rs_id_create;
     private $rs_id_edit;
     private $rs_id_delete;

     public function get_provinsi() {
       $sql = "SELECT id_pk_provinsi, provinsi_nama FROM mstr_provinsi";
       $result = $this->db->query($sql);
       return $result;
     }

     public function kabupaten_default() {
       $sql = "SELECT id_pk_kabupaten, id_fk_provinsi, kabupaten_nama FROM mstr_kabupaten";
       $result = $this->db->query($sql);
       return $result;
     }

     public function get_kabupaten($id_pk_provinsi) {
       $sql = "SELECT id_pk_kabupaten, id_fk_provinsi, kabupaten_nama FROM mstr_kabupaten WHERE id_fk_provinsi = $id_pk_provinsi";
       $result = $this->db->query($sql);
       return $result;
     }

     public function get_rs(){
         $sql = "SELECT id_pk_rs, rs_kode, rs_nama, rs_kelas, rs_direktur, rs_alamat, rs_kategori, id_fk_kabupaten, rs_kode_pos, rs_telepon, rs_fax, id_fk_jenis_rs, id_fk_penyelenggara, rs_status FROM mstr_rs WHERE rs_status = 'aktif'";
         $result = $this->db->query($sql);
         return $result;
     }

     public function insert_rs($rs_kode, $rs_nama, $rs_kelas, $rs_direktur, $rs_alamat, $rs_kategori, $id_fk_kabupaten, $rs_kode_pos, $rs_telepon, $rs_fax, $id_fk_jenis_rs, $id_fk_penyelenggara, $rs_status) {
 			$data = array(
        "rs_kode"=>$rs_kode,
        "rs_nama"=>$rs_nama,
        "rs_kelas"=>$rs_kelas,
        "rs_direktur"=>$rs_direktur,
        "rs_alamat"=>$rs_alamat,
        "rs_kategori"=>$rs_kategori,
        "id_fk_kabupaten"=>$id_fk_kabupaten,
        "rs_kode_pos"=>$rs_kode_pos,
        "rs_telepon"=>$rs_telepon,
        "rs_fax"=>$rs_fax,
        "id_fk_jenis_rs"=>$id_fk_jenis_rs,
        "id_fk_penyelenggara"=>$id_fk_penyelenggara,
        "rs_status"=>"aktif"
 			);
 			$this->db->insert("mstr_rs",$data);
 		}

    public function delete_rs($id_pk_rs) {
      $sql = "UPDATE mstr_rs SET rs_status = 'nonaktif' WHERE id_pk_rs = $id_pk_rs";
      $result = $this->db->query($sql);
    }

    public function edit_rs($rs_kode, $rs_nama, $rs_kelas, $rs_direktur, $rs_alamat, $rs_kategori, $id_fk_kabupaten, $rs_kode_pos, $rs_telepon, $rs_fax, $id_fk_jenis_rs, $id_fk_penyelenggara) {
      $sql = "UPDATE mstr_rs SET rs_kode = $rs_kode, rs_nama = $rs_nama, rs_kelas = $rs_kelas, rs_direktur = $rs_direktur, rs_alamat = $rs_alamat, rs_kategori = $rs_kategori, id_fk_kabupaten = $id_fk_kabupaten, rs_kode_pos = $rs_kode_pos, rs_telepon = $rs_telepon, rs_fax = $rs_fax, id_fk_jenis_rs = $id_fk_jenis_rs, id_fk_penyelenggara = $id_fk_penyelenggara WHERE id_pk_rs = $id_pk_rs";
      $result = $this->db->query($sql);
    }
}