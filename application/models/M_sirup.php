<?php
/*
  drop table if exists mstr_sirup;
  create table mstr_sirup(
      id_pk_sirup int primary key auto_increment,
      sirup_rup varchar(100),
      sirup_paket text,
      sirup_klpd varchar(100),
      sirup_satuan_kerja varchar(100),
      sirup_tahun_anggaran int,
      sirup_volume_pekerjaan varchar(300),
      sirup_uraian_pekerjaan varchar(300),
      sirup_spesifikasi_pekerjaan varchar(300),
      sirup_produk_dalam_negri varchar(15),
      sirup_usaha_kecil varchar(15),
      sirup_pra_dipa varchar(15),
      sirup_jenis_pengadaan varchar(300),
      sirup_total int,
      sirup_metode_pemilihan varchar(100),
      sirup_histori_paket varchar(100),
      sirup_tgl_perbarui_paket varchar(100),
      sirup_status varchar(30),
      sirup_tgl_create datetime,
      sirup_tgl_update datetime,
      sirup_tgl_delete datetime,
      sirup_id_create int,
      sirup_id_update int,
      sirup_id_delete int,
      id_fk_pencarian_sirup int
  );

  create table tbl_sirup_lokasi_pekerjaan(
      id_pk_lokasi_pekerjaan int primary key auto_increment,
      lokasi_pekerjaan varchar(1000),
      id_fk_sirup int
  );
  select * from tbl_sirup_lokasi_pekerjaan;
  create table tbl_sirup_sumber_dana(
      id_pk_sumber_dana int primary key auto_increment,
      sumber_dana varchar(1000),
      id_fk_sirup int
  );
  select * from tbl_sirup_sumber_dana;
  create table tbl_sirup_pemanfaatan_barang(
      id_pk_pemanfaatan_barang int primary key auto_increment,
      pemanfaatan_barang varchar(1000),
      id_fk_sirup int
  );
  select * from tbl_sirup_pemanfaatan_barang;
  create table tbl_sirup_jadwal_pelaksanaan(
      id_pk_jadwal_pelaksanaan int primary key auto_increment,
      jadwal_pelaksanaan varchar(1000),
      id_fk_sirup int
  );
  select * from tbl_sirup_jadwal_pelaksanaan;
  create table tbl_sirup_pemilihan_penyedia(
      id_pk_pemilihan_penyedia int primary key auto_increment,
      pemilihan_penyedia varchar(1000),
      id_fk_sirup int
  );
*/
class M_sirup extends CI_Model{
  private $id_pk_sirup;
  private $sirup_rup;
  private $sirup_paket;
  private $sirup_klpd;
  private $sirup_satuan_kerja;
  private $sirup_tahun_anggaran;
  private $sirup_volume_pekerjaan;
  private $sirup_uraian_pekerjaan;
  private $sirup_spesifikasi_pekerjaan;
  private $sirup_produk_dalam_negri;
  private $sirup_usaha_kecil;
  private $sirup_pra_dipa;
  private $sirup_jenis_pengadaan;
  private $sirup_total;
  private $sirup_metode_pemilihan;
  private $sirup_histori_paket;
  private $sirup_tgl_perbarui_paket;
  private $sirup_status;
  private $sirup_tgl_create;
  private $sirup_tgl_update;
  private $sirup_tgl_delete;
  private $sirup_id_create;
  private $sirup_id_update;
  private $sirup_id_delete;
  private $id_fk_pencarian_sirup;
  
  public function insert($sirup_rup,$sirup_paket,$sirup_klpd,$sirup_satuan_kerja,$sirup_tahun_anggaran,$sirup_volume_pekerjaan,$sirup_uraian_pekerjaan,$sirup_spesifikasi_pekerjaan,$sirup_produk_dalam_negri,$sirup_usaha_kecil,$sirup_pra_dipa,$sirup_jenis_pengadaan,$sirup_total,$sirup_metode_pemilihan,$sirup_histori_paket,$sirup_tgl_perbarui_paket,$sirup_id_create,$id_fk_pencarian_sirup, $sirup_status){
    $data = array(
      "sirup_rup" => $sirup_rup,
      "sirup_paket" => $sirup_paket,
      "sirup_klpd" => $sirup_klpd,
      "sirup_satuan_kerja" => $sirup_satuan_kerja,
      "sirup_tahun_anggaran" => $sirup_tahun_anggaran,
      "sirup_volume_pekerjaan" => $sirup_volume_pekerjaan,
      "sirup_uraian_pekerjaan" => $sirup_uraian_pekerjaan,
      "sirup_spesifikasi_pekerjaan" => $sirup_spesifikasi_pekerjaan,
      "sirup_produk_dalam_negri" => $sirup_produk_dalam_negri,
      "sirup_usaha_kecil" => $sirup_usaha_kecil,
      "sirup_pra_dipa" => $sirup_pra_dipa,
      "sirup_jenis_pengadaan" => $sirup_jenis_pengadaan,
      "sirup_total" => $sirup_total,
      "sirup_metode_pemilihan" => $sirup_metode_pemilihan,
      "sirup_histori_paket" => $sirup_histori_paket,
      "sirup_tgl_perbarui_paket" => $sirup_tgl_perbarui_paket,
      "sirup_status" => $sirup_status,
      "sirup_tgl_create" => date("Y-m-d H:i:s"),
      "sirup_id_create" => $sirup_id_create,
      "id_fk_pencarian_sirup" => $id_fk_pencarian_sirup
    );
    return insertRow("mstr_sirup",$data);
  }
  public function insert_lokasi_pekerjaan($data,$id_fk_sirup){
    $data = array(
      "lokasi_pekerjaan" => $data,
      "id_fk_sirup" => $id_fk_sirup
    );
    insertRow("tbl_sirup_lokasi_pekerjaan",$data);
  }
  public function insert_sumber_dana($data,$id_fk_sirup){
    $data = array(
      "sumber_dana" => $data,
      "id_fk_sirup" => $id_fk_sirup
    );
    insertRow("tbl_sirup_sumber_dana",$data);
  }
  public function insert_pemanfaatan_barang($data,$id_fk_sirup){
    $data = array(
      "pemanfaatan_barang" => $data,
      "id_fk_sirup" => $id_fk_sirup
    );
    insertRow("tbl_sirup_pemanfaatan_barang",$data);
  }
  public function insert_jadwal_pelaksanaan($data,$id_fk_sirup){
    $data = array(
      "jadwal_pelaksanaan" => $data,
      "id_fk_sirup" => $id_fk_sirup
    );
    insertRow("tbl_sirup_jadwal_pelaksanaan",$data);
  }
  public function insert_pemilihan_penyedia($data,$id_fk_sirup){
    $data = array(
      "pemilihan_penyedia" => $data,
      "id_fk_sirup" => $id_fk_sirup
    );
    insertRow("tbl_sirup_pemilihan_penyedia",$data);
  }
  public function get_data(){
    $sql = "select id_pk_sirup,sirup_rup,sirup_paket,sirup_klpd,sirup_satuan_kerja,sirup_tahun_anggaran,sirup_volume_pekerjaan,sirup_uraian_pekerjaan,sirup_spesifikasi_pekerjaan,sirup_produk_dalam_negri,sirup_usaha_kecil,sirup_pra_dipa,sirup_jenis_pengadaan,sirup_total,sirup_metode_pemilihan,sirup_histori_paket,sirup_tgl_perbarui_paket,sirup_status,sirup_tgl_create,sirup_tgl_update,sirup_tgl_delete,sirup_id_create,sirup_id_update,sirup_id_delete,id_fk_pencarian_sirup from mstr_sirup where sirup_status = 'aktif' order by sirup_tgl_create DESC";
    return executeQuery($sql);
  }
  public function is_id_exists($id){
    $where = array(
      "sirup_rup" => $id,
      "sirup_status" => "aktif"
    );
    return isExistsInTable("mstr_sirup",$where);
  }
  public function get_detail_lokasi_pekerjaan($id_fk_sirup){
    $sql = "select id_pk_lokasi_pekerjaan, lokasi_pekerjaan from tbl_sirup_lokasi_pekerjaan where id_fk_sirup = ?"; #2
    $args = array(
      $id_fk_sirup
    );
    return executeQuery($sql, $args);
  }
  public function get_detail_sumber_dana($id_fk_sirup){
    $sql = "select id_pk_sumber_dana, sumber_dana from tbl_sirup_sumber_dana where id_fk_sirup = ?"; #5
    $args = array(
      $id_fk_sirup
    );
    return executeQuery($sql, $args);
  }
  public function get_detail_pemanfaatan_barang($id_fk_sirup){
    $sql = "select id_pk_pemanfaatan_barang, pemanfaatan_barang from tbl_sirup_pemanfaatan_barang where id_fk_sirup = ?"; #3
    $args = array(
      $id_fk_sirup
    );
    return executeQuery($sql, $args);
  }
  public function get_detail_pelaksanaan_kontrak($id_fk_sirup){
    $sql = "select id_pk_jadwal_pelaksanaan, jadwal_pelaksanaan from tbl_sirup_jadwal_pelaksanaan where id_fk_sirup = ?"; #1
    $args = array(
      $id_fk_sirup
    );
    return executeQuery($sql, $args);
  }
  public function get_detail_jadwal_pemilihan($id_fk_sirup){
    $sql = "select id_pk_pemilihan_penyedia, pemilihan_penyedia from tbl_sirup_pemilihan_penyedia where id_fk_sirup = ?"; #4
    $args = array(
      $id_fk_sirup
    );
    return executeQuery($sql, $args);
  }
  public function update($id_pk_sirup, $sirup_rup,$sirup_paket,$sirup_klpd,$sirup_satuan_kerja,$sirup_tahun_anggaran,$sirup_volume_pekerjaan,$sirup_uraian_pekerjaan,$sirup_spesifikasi_pekerjaan,$sirup_produk_dalam_negri,$sirup_usaha_kecil,$sirup_pra_dipa,$sirup_jenis_pengadaan,$sirup_total,$sirup_metode_pemilihan,$sirup_histori_paket,$sirup_tgl_perbarui_paket){
    $where = array(
      "id_pk_sirup" => $id_pk_sirup
    );
    $data = array(
      "sirup_rup" => $sirup_rup,
      "sirup_paket" => $sirup_paket,
      "sirup_klpd" => $sirup_klpd,
      "sirup_satuan_kerja" => $sirup_satuan_kerja,
      "sirup_tahun_anggaran" => $sirup_tahun_anggaran,
      "sirup_volume_pekerjaan" => $sirup_volume_pekerjaan,
      "sirup_uraian_pekerjaan" => $sirup_uraian_pekerjaan,
      "sirup_spesifikasi_pekerjaan" => $sirup_spesifikasi_pekerjaan,
      "sirup_produk_dalam_negri" => $sirup_produk_dalam_negri,
      "sirup_usaha_kecil" => $sirup_usaha_kecil,
      "sirup_pra_dipa" => $sirup_pra_dipa,
      "sirup_jenis_pengadaan" => $sirup_jenis_pengadaan,
      "sirup_total" => $sirup_total,
      "sirup_metode_pemilihan" => $sirup_metode_pemilihan,
      "sirup_histori_paket" => $sirup_histori_paket,
      "sirup_tgl_perbarui_paket" => $sirup_tgl_perbarui_paket,
      "sirup_id_update" => $this->session->id_user,
      "sirup_tgl_update" => date("Y-m-d H:i:s")
    );
    updateRow("mstr_sirup", $data, $where);
  }
  public function update_lokasi_pekerjaan($id_pk_lokasi_pekerjaan , $data){
    $where = array(
      "id_pk_lokasi_pekerjaan" => $id_pk_lokasi_pekerjaan
    );
    $data = array(
      "lokasi_pekerjaan" => $data,
    );
    updateRow("tbl_sirup_lokasi_pekerjaan",$data,$where);
  }
  public function update_sumber_dana($id_pk_sumber_dana , $data){
    $where = array(
      "id_pk_sumber_dana" => $id_pk_sumber_dana
    );
    $data = array(
      "sumber_dana" => $data,
    );
    updateRow("tbl_sirup_sumber_dana",$data,$where);
  }
  public function update_pemanfaatan_barang($id_pk_pemanfaatan_barang , $data){
    $where = array(
      "id_pk_pemanfaatan_barang" => $id_pk_pemanfaatan_barang
    );
    $data = array(
      "pemanfaatan_barang" => $data,
    );
    updateRow("tbl_sirup_pemanfaatan_barang",$data,$where);
  }
  public function update_jadwal_pelaksanaan($id_pk_jadwal_pelaksanaan , $data){
    $where = array(
      "id_pk_jadwal_pelaksanaan" => $id_pk_jadwal_pelaksanaan
    );
    $data = array(
      "jadwal_pelaksanaan" => $data,
    );
    updateRow("tbl_sirup_jadwal_pelaksanaan",$data,$where);
  }
  public function update_pemilihan_penyedia($id_pk_pemilihan_penyedia , $data){
    $where = array(
      "id_pk_pemilihan_penyedia" => $id_pk_pemilihan_penyedia
    );
    $data = array(
      "pemilihan_penyedia" => $data,
    );
    updateRow("tbl_sirup_pemilihan_penyedia",$data,$where);
  }
  public function delete($id_pk_sirup){
    $where = array(
      "id_pk_sirup" => $id_pk_sirup
    );
    $data = array(
      "sirup_status" => "nonaktif"
    );
    updateRow("mstr_sirup",$data,$where);
  }
}