<?php
date_default_timezone_set("Asia/Jakarta");
class M_rumah_sakit extends CI_Model
{
  public function get_provinsi()
  {
    $sql = "SELECT id_pk_provinsi, provinsi_nama FROM mstr_provinsi WHERE provinsi_status = 'aktif'";
    $result = $this->db->query($sql);
    return $result;
  }
  public function get_kabupaten($id_pk_provinsi)
  {
    $sql = "SELECT id_pk_kabupaten, id_fk_provinsi, kabupaten_nama FROM mstr_kabupaten WHERE id_fk_provinsi = $id_pk_provinsi AND kabupaten_status = 'aktif'";
    $result = $this->db->query($sql);
    return $result;
  }
  public function get_kabupaten_name($id_pk_provinsi)
  {
    $sql = "SELECT kabupaten_nama FROM mstr_kabupaten WHERE id_fk_provinsi = $id_pk_provinsi AND kabupaten_status = 'aktif'";
    $result = $this->db->query($sql);
    return $result;
  }
  public function get_rs_kabupaten($id_fk_kabupaten)
  {
    $sql = "
      SELECT id_pk_rs, rs_kode, rs_nama, rs_kelas, rs_direktur, rs_alamat, rs_kategori, mstr_kabupaten.kabupaten_nama AS nama_kabupaten, rs_kode_pos, rs_telepon, rs_fax, mstr_jenis_rs.jenis_rs_nama AS jenis_rs, mstr_penyelenggara.penyelenggara_nama AS penyelenggara, rs_status FROM mstr_rs 
      INNER JOIN mstr_kabupaten ON mstr_rs.id_fk_kabupaten = mstr_kabupaten.id_pk_kabupaten 
      INNER JOIN mstr_jenis_rs ON mstr_rs.id_fk_jenis_rs = mstr_jenis_rs.id_pk_jenis_rs
      INNER JOIN mstr_penyelenggara ON mstr_rs.id_fk_penyelenggara = mstr_penyelenggara.id_pk_penyelenggara 
      WHERE rs_status = 'aktif' and id_fk_kabupaten = ?";
    $args = array(
      $id_fk_kabupaten
    );
    $result = $this->db->query($sql, $args);
    return $result;
  }
  public function insert_rs($rs_kode, $rs_nama, $rs_kelas, $rs_direktur, $rs_alamat, $rs_kategori, $id_fk_kabupaten, $rs_kode_pos, $rs_telepon, $rs_fax, $id_fk_jenis_rs, $id_fk_penyelenggara, $rs_status)
  {
    $data = array(
      "rs_kode" => $rs_kode,
      "rs_nama" => $rs_nama,
      "rs_kelas" => $rs_kelas,
      "rs_direktur" => $rs_direktur,
      "rs_alamat" => $rs_alamat,
      "rs_kategori" => $rs_kategori,
      "id_fk_kabupaten" => $id_fk_kabupaten,
      "rs_kode_pos" => $rs_kode_pos,
      "rs_telepon" => $rs_telepon,
      "rs_fax" => $rs_fax,
      "id_fk_jenis_rs" => $id_fk_jenis_rs,
      "id_fk_penyelenggara" => $id_fk_penyelenggara,
      "rs_status" => "aktif"
    );
    return insertRow("mstr_rs", $data);
  }

  public function delete_rs($id_pk_rs)
  {
    $data = array(
      "rs_status" => 'nonaktif'
    );
    $where = array(
      "id_pk_rs" => $id_pk_rs
    );
    updateRow("mstr_rs", $data, $where);
  }

  public function edit_rs($id_pk_rs, $rs_kode, $rs_nama, $rs_kelas, $rs_direktur, $rs_alamat, $rs_kategori, $id_fk_kabupaten, $rs_kode_pos, $rs_telepon, $rs_fax, $id_fk_jenis_rs, $id_fk_penyelenggara)
  {
    $data = array(
      "rs_kode" => $rs_kode,
      "rs_nama" => $rs_nama,
      "rs_kelas" => $rs_kelas,
      "rs_direktur" => $rs_direktur,
      "rs_alamat" => $rs_alamat,
      "rs_kategori" => $rs_kategori,
      "id_fk_kabupaten" => $id_fk_kabupaten,
      "rs_kode_pos" => $rs_kode_pos,
      "rs_telepon" => $rs_telepon,
      "rs_fax" => $rs_fax,
      "id_fk_jenis_rs" => $id_fk_jenis_rs,
      "id_fk_penyelenggara" => $id_fk_penyelenggara,
      "rs_status" => "aktif"
    );
    $where = array(
      "id_pk_rs" => $id_pk_rs
    );
    updateRow("mstr_rs", $data, $where);
  }

  public function search($kolom_pengurutan, $arah_kolom_pengurutan, $pencarian_phrase, $kolom_pencarian, $current_page)
  {
    $search_query = "";
    if ($pencarian_phrase != "") {
      if ($kolom_pencarian == "all") {
        $search_query = "and (rs_kode like '%" . $pencarian_phrase . "%' or rs_nama like '%" . $pencarian_phrase . "%' or rs_kelas like '%" . $pencarian_phrase . "%' or rs_direktur like '%" . $pencarian_phrase . "%' or rs_alamat like '%" . $pencarian_phrase . "%' or rs_kategori like '%" . $pencarian_phrase . "%' or rs_kode_pos like '%" . $pencarian_phrase . "%' or rs_telepon like '%" . $pencarian_phrase . "%' or rs_fax like '%" . $pencarian_phrase . "%' or kabupaten_nama like '%" . $pencarian_phrase . "%' or provinsi_nama like '%" . $pencarian_phrase . "%' or jenis_rs_nama like '%" . $pencarian_phrase . "%' or jenis_rs_kode like '%" . $pencarian_phrase . "%' or penyelenggara_nama like '%" . $pencarian_phrase . "%')";
      } else {
        $search_query = "and (" . $kolom_pencarian . " like '%" . $pencarian_phrase . "%')";
      }
    }
    // INNER JOIN mstr_jenis_rs ON mstr_rs.id_fk_jenis_rs = mstr_jenis_rs.id_pk_jenis_rs
    $sql = "SELECT id_pk_rs, rs_kode, rs_nama, rs_kelas, rs_direktur, rs_alamat, rs_kategori, id_fk_kabupaten, rs_kode_pos, rs_telepon, rs_fax, id_fk_jenis_rs, id_fk_penyelenggara, rs_status, mstr_kabupaten.kabupaten_nama AS nama_kabupaten, id_fk_provinsi, provinsi_nama, mstr_penyelenggara.penyelenggara_nama AS penyelenggara FROM mstr_rs 
      INNER JOIN mstr_kabupaten ON mstr_rs.id_fk_kabupaten = mstr_kabupaten.id_pk_kabupaten 
      INNER JOIN mstr_provinsi ON mstr_kabupaten.id_fk_provinsi = mstr_provinsi.id_pk_provinsi
      INNER JOIN mstr_penyelenggara ON mstr_rs.id_fk_penyelenggara = mstr_penyelenggara.id_pk_penyelenggara 
      WHERE rs_status = 'aktif' " . $search_query . " order by " . $kolom_pengurutan . " " . $arah_kolom_pengurutan . " limit 20 offset " . (20 * ($current_page - 1));

    return executeQuery($sql);
  }
  public function get_rs($kolom_pengurutan, $arah_kolom_pengurutan, $pencarian_phrase, $kolom_pencarian, $current_page)
  {
    $search_query = "";
    if ($pencarian_phrase != "") {
      if ($kolom_pencarian == "all") {
        $search_query = "and (rs_kode like '%" . $pencarian_phrase . "%' or rs_nama like '%" . $pencarian_phrase . "%' or rs_kelas like '%" . $pencarian_phrase . "%' or rs_direktur like '%" . $pencarian_phrase . "%' or rs_alamat like '%" . $pencarian_phrase . "%' or rs_kategori like '%" . $pencarian_phrase . "%' or rs_kode_pos like '%" . $pencarian_phrase . "%' or rs_telepon like '%" . $pencarian_phrase . "%' or rs_fax like '%" . $pencarian_phrase . "%' or kabupaten_nama like '%" . $pencarian_phrase . "%' or provinsi_nama like '%" . $pencarian_phrase . "%' or jenis_rs_nama like '%" . $pencarian_phrase . "%' or jenis_rs_kode like '%" . $pencarian_phrase . "%' or penyelenggara_nama like '%" . $pencarian_phrase . "%')";
      } else {
        $search_query = "and (" . $kolom_pencarian . " like '%" . $pencarian_phrase . "%')";
      }
    }
    // INNER JOIN mstr_jenis_rs ON mstr_rs.id_fk_jenis_rs = mstr_jenis_rs.id_pk_jenis_rs
    $sql = "SELECT id_pk_rs FROM mstr_rs 
      INNER JOIN mstr_kabupaten ON mstr_rs.id_fk_kabupaten = mstr_kabupaten.id_pk_kabupaten 
      INNER JOIN mstr_provinsi ON mstr_kabupaten.id_fk_provinsi = mstr_provinsi.id_pk_provinsi
      INNER JOIN mstr_penyelenggara ON mstr_rs.id_fk_penyelenggara = mstr_penyelenggara.id_pk_penyelenggara 
      WHERE rs_status = 'aktif' " . $search_query . " order by " . $kolom_pengurutan . " " . $arah_kolom_pengurutan;

    return executeQuery($sql);
  }
  public function check_duplicate_insert($rs_kode){
    $where = array(
      "rs_kode" => $rs_kode,
      "rs_status !=" => "nonaktif"
    );
    return selectRow("mstr_rs",$where);
  }
  public function check_duplicate_update($id_pk_rs, $rs_kode){
    $where = array(
      "id_pk_rs !=" => $id_pk_rs,
      "rs_kode" => $rs_kode,
      "rs_status !=" => "nonaktif"
    );
    return selectRow("mstr_rs",$where);
  }
}
