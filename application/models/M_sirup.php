<?php

class M_sirup extends CI_Model
{

  public function insert($sirup_rup, $sirup_paket, $sirup_klpd, $sirup_satuan_kerja, $sirup_tahun_anggaran, $sirup_volume_pekerjaan, $sirup_uraian_pekerjaan, $sirup_spesifikasi_pekerjaan, $sirup_produk_dalam_negri, $sirup_usaha_kecil, $sirup_pra_dipa, $sirup_jenis_pengadaan, $sirup_total, $sirup_metode_pemilihan, $sirup_histori_paket, $sirup_tgl_perbarui_paket, $sirup_id_create, $id_fk_pencarian_sirup, $sirup_status, $sirup_status_sesuai_pencarian, $sirup_aspek_ekonomi, $sirup_aspek_sosial, $sirup_aspek_lingkungan, $sirup_total_pagu, $sirup_jadwal_pemilihan, $kabupaten, $provinsi)
  {
    $sql = "select * from mstr_sirup where sirup_rup = ? and sirup_tgl_update is null and id_fk_pencarian_sirup != 0";
    $args = array(
      $sirup_rup
    );
    $sirup = executeQuery($sql, $args); #cari sirup yang udah kedaftar di mstr sirup supaya prevent duplicate.
    if ($sirup) {
      $where = array(
        "id_pk_sirup" => $sirup[0]['id_pk_sirup']
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
        "sirup_status" => $sirup_status,
        "sirup_tgl_create" => date("Y-m-d H:i:s"),
        "sirup_id_create" => $sirup_id_create,
        "id_fk_pencarian_sirup" => $id_fk_pencarian_sirup,
        "sirup_status_sesuai_pencarian" => $sirup_status_sesuai_pencarian,
        "sirup_aspek_ekonomi" => $sirup_aspek_ekonomi,
        "sirup_aspek_sosial" => $sirup_aspek_sosial,
        "sirup_aspek_lingkungan" => $sirup_aspek_lingkungan,
        "sirup_total_pagu" => $sirup_total_pagu,
        "sirup_jadwal_pemilihan" => $sirup_jadwal_pemilihan,
        "sirup_kabupaten" => $kabupaten,
        "sirup_provinsi" => $provinsi
      );
      #insertRow("mstr_sirup_archieve", $data); #masukin ke archieve
      return updateRow("mstr_sirup", $data, $where); #masukin ke table utama
    } else {
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
        "id_fk_pencarian_sirup" => $id_fk_pencarian_sirup,
        "sirup_status_sesuai_pencarian" => $sirup_status_sesuai_pencarian,
        "sirup_aspek_ekonomi" => $sirup_aspek_ekonomi,
        "sirup_aspek_sosial" => $sirup_aspek_sosial,
        "sirup_aspek_lingkungan" => $sirup_aspek_lingkungan,
        "sirup_total_pagu" => $sirup_total_pagu,
        "sirup_jadwal_pemilihan" => $sirup_jadwal_pemilihan,
        "sirup_kabupaten" => $kabupaten,
        "sirup_provinsi" => $provinsi
      );
      #insertRow("mstr_sirup_archieve", $data); #masukin ke archieve
      return insertRow("mstr_sirup", $data); #masukin ke table utama
    }
  }
  public function insert_lokasi_pekerjaan($data, $id_fk_sirup)
  {
    $data = array(
      "lokasi_pekerjaan" => $data,
      "id_fk_sirup" => $id_fk_sirup
    );
    insertRow("tbl_sirup_lokasi_pekerjaan", $data);
    #insertRow("tbl_sirup_lokasi_pekerjaan_archieve", $data);
  }
  public function insert_sumber_dana($data, $id_fk_sirup)
  {
    $data = array(
      "sumber_dana" => $data,
      "id_fk_sirup" => $id_fk_sirup
    );
    insertRow("tbl_sirup_sumber_dana", $data);
    #insertRow("tbl_sirup_sumber_dana_archieve", $data);
  }
  public function insert_pemanfaatan_barang($data, $id_fk_sirup)
  {
    $data = array(
      "pemanfaatan_barang" => $data,
      "id_fk_sirup" => $id_fk_sirup
    );
    insertRow("tbl_sirup_pemanfaatan_barang", $data);
    #insertRow("tbl_sirup_pemanfaatan_barang_archieve", $data);
  }
  public function insert_jadwal_pelaksanaan($data, $id_fk_sirup)
  {
    $data = array(
      "jadwal_pelaksanaan" => $data,
      "id_fk_sirup" => $id_fk_sirup
    );
    insertRow("tbl_sirup_jadwal_pelaksanaan", $data);
    #insertRow("tbl_sirup_jadwal_pelaksanaan_archieve", $data);
  }
  public function insert_pemilihan_penyedia($data, $id_fk_sirup)
  {
    $data = array(
      "pemilihan_penyedia" => $data,
      "id_fk_sirup" => $id_fk_sirup
    );
    insertRow("tbl_sirup_pemilihan_penyedia", $data);
    #insertRow("tbl_sirup_pemilihan_penyedia_archieve", $data);
  }
  public function is_id_exists($id)
  {
    $where = array(
      "sirup_rup" => $id,
      "sirup_status" => "aktif"
    );
    return isExistsInTable("mstr_sirup", $where);
  }
  public function get_detail_lokasi_pekerjaan($id_fk_sirup)
  {
    $sql = "select id_pk_lokasi_pekerjaan, lokasi_pekerjaan from tbl_sirup_lokasi_pekerjaan where id_fk_sirup = ?"; #2
    $args = array(
      $id_fk_sirup
    );
    return executeQuery($sql, $args);
  }

  public function get_detail_status($id_pk_sirup)
  {
    $sql = "select sirup_funnel, sirup_notes, sirup_no_funnel from mstr_sirup where id_pk_sirup = ?"; #2
    $args = array(
      $id_pk_sirup
    );
    return executeQuery($sql, $args);
  }
  public function get_detail_sumber_dana($id_fk_sirup)
  {
    $sql = "select id_pk_sumber_dana, sumber_dana from tbl_sirup_sumber_dana where id_fk_sirup = ?"; #5
    $args = array(
      $id_fk_sirup
    );
    return executeQuery($sql, $args);
  }
  public function get_detail_pemanfaatan_barang($id_fk_sirup)
  {
    $sql = "select id_pk_pemanfaatan_barang, pemanfaatan_barang from tbl_sirup_pemanfaatan_barang where id_fk_sirup = ?"; #3
    $args = array(
      $id_fk_sirup
    );
    return executeQuery($sql, $args);
  }
  public function get_detail_pelaksanaan_kontrak($id_fk_sirup)
  {
    $sql = "select id_pk_jadwal_pelaksanaan, jadwal_pelaksanaan from tbl_sirup_jadwal_pelaksanaan where id_fk_sirup = ?"; #1
    $args = array(
      $id_fk_sirup
    );
    return executeQuery($sql, $args);
  }
  public function get_detail_jadwal_pemilihan($id_fk_sirup)
  {
    $sql = "select id_pk_pemilihan_penyedia, pemilihan_penyedia from tbl_sirup_pemilihan_penyedia where id_fk_sirup = ?"; #4
    $args = array(
      $id_fk_sirup
    );
    return executeQuery($sql, $args);
  }
  public function update($id_pk_sirup, $sirup_rup, $sirup_paket, $sirup_klpd, $sirup_satuan_kerja, $sirup_tahun_anggaran, $sirup_volume_pekerjaan, $sirup_uraian_pekerjaan, $sirup_spesifikasi_pekerjaan, $sirup_produk_dalam_negri, $sirup_usaha_kecil, $sirup_pra_dipa, $sirup_jenis_pengadaan, $sirup_total, $sirup_metode_pemilihan, $sirup_histori_paket, $sirup_tgl_perbarui_paket)
  {
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

  public function edit($id_pk_sirup, $status_funnel, $notes, $no_funnel)
  {
    $where = array(
      "id_pk_sirup" => $id_pk_sirup
    );
    $data = array(
      "sirup_funnel" => $status_funnel,
      "sirup_notes" => $notes,
      "sirup_no_funnel" => $no_funnel,
      "sirup_id_update" => $this->session->id_user,
      "sirup_tgl_update" => date("Y-m-d H:i:s")
    );
    updateRow("mstr_sirup", $data, $where);
  }
  public function update_lokasi_pekerjaan($id_pk_lokasi_pekerjaan, $data)
  {
    $where = array(
      "id_pk_lokasi_pekerjaan" => $id_pk_lokasi_pekerjaan
    );
    $data = array(
      "lokasi_pekerjaan" => $data,
    );
    updateRow("tbl_sirup_lokasi_pekerjaan", $data, $where);
  }
  public function update_sumber_dana($id_pk_sumber_dana, $data)
  {
    $where = array(
      "id_pk_sumber_dana" => $id_pk_sumber_dana
    );
    $data = array(
      "sumber_dana" => $data,
    );
    updateRow("tbl_sirup_sumber_dana", $data, $where);
  }
  public function update_pemanfaatan_barang($id_pk_pemanfaatan_barang, $data)
  {
    $where = array(
      "id_pk_pemanfaatan_barang" => $id_pk_pemanfaatan_barang
    );
    $data = array(
      "pemanfaatan_barang" => $data,
    );
    updateRow("tbl_sirup_pemanfaatan_barang", $data, $where);
  }
  public function update_jadwal_pelaksanaan($id_pk_jadwal_pelaksanaan, $data)
  {
    $where = array(
      "id_pk_jadwal_pelaksanaan" => $id_pk_jadwal_pelaksanaan
    );
    $data = array(
      "jadwal_pelaksanaan" => $data,
    );
    updateRow("tbl_sirup_jadwal_pelaksanaan", $data, $where);
  }
  public function update_pemilihan_penyedia($id_pk_pemilihan_penyedia, $data)
  {
    $where = array(
      "id_pk_pemilihan_penyedia" => $id_pk_pemilihan_penyedia
    );
    $data = array(
      "pemilihan_penyedia" => $data,
    );
    updateRow("tbl_sirup_pemilihan_penyedia", $data, $where);
  }
  public function delete($id_pk_sirup)
  {
    $where = array(
      "id_pk_sirup" => $id_pk_sirup
    );
    $data = array(
      "sirup_status" => "nonaktif"
    );
    updateRow("mstr_sirup", $data, $where);
  }
  public function search($kolom_pengurutan, $arah_kolom_pengurutan, $pencarian_phrase, $kolom_pencarian, $current_page)
  {
    $search_query = "";
    if ($pencarian_phrase != "") {
      if ($kolom_pencarian == "all") {
        $search_query = "and (sirup_rup like '%" . $pencarian_phrase . "%' or sirup_paket like '%" . $pencarian_phrase . "%' or sirup_klpd like '%" . $pencarian_phrase . "%' or sirup_satuan_kerja like '%" . $pencarian_phrase . "%' or sirup_tahun_anggaran like '%" . $pencarian_phrase . "%' or sirup_jenis_pengadaan like '%" . $pencarian_phrase . "%' or sirup_total like '%" . $pencarian_phrase . "%' or sirup_metode_pemilihan like '%" . $pencarian_phrase . "%' or sirup_histori_paket like '%" . $pencarian_phrase . "%' or sirup_tgl_perbarui_paket like '%" . $pencarian_phrase . "%')";
      } else {
        $search_query = "and (" . $kolom_pencarian . " like '%" . $pencarian_phrase . "%')";
      }
    }
    $sql = "
    select id_pk_sirup,sirup_rup,sirup_paket,sirup_klpd,sirup_satuan_kerja,sirup_tahun_anggaran,sirup_volume_pekerjaan,sirup_uraian_pekerjaan,sirup_spesifikasi_pekerjaan,sirup_produk_dalam_negri,sirup_usaha_kecil,sirup_pra_dipa,sirup_jenis_pengadaan,sirup_total,sirup_metode_pemilihan,sirup_histori_paket,sirup_tgl_perbarui_paket,sirup_status,ifnull(sirup_tgl_update, sirup_tgl_create) as sirup_tgl_create,sirup_tgl_delete,sirup_id_create,sirup_id_update,sirup_id_delete,id_fk_pencarian_sirup, if(pencarian_sirup_tahun is null,'',pencarian_sirup_tahun) as pencarian_sirup_tahun, if(pencarian_sirup_frase is null,'',pencarian_sirup_frase) as pencarian_sirup_frase, if(pencarian_sirup_jenis is null,'',pencarian_sirup_jenis) as pencarian_sirup_jenis, ifnull(user_username,'SYSTEM') as user_create
    from mstr_sirup
    left join mstr_pencarian_sirup on mstr_pencarian_sirup.id_pk_pencarian_sirup =  mstr_sirup.id_fk_pencarian_sirup
    left join mstr_user on mstr_user.id_pk_user = mstr_sirup.sirup_id_create
    where sirup_status = 'aktif' and
    sirup_status_sesuai_pencarian != 0 " . $search_query . " order by " . $kolom_pengurutan . " " . $arah_kolom_pengurutan . " limit 20 offset " . (20 * ($current_page - 1));
    return executeQuery($sql);
  }
  public function search_system($kolom_pengurutan, $arah_kolom_pengurutan, $pencarian_phrase, $kolom_pencarian, $current_page, $funnel)
  {
    $search_query = "";
    if ($pencarian_phrase != "") {
      if ($kolom_pencarian == "all") {
        $search_query = "and (sirup_rup like '%" . $pencarian_phrase . "%' or sirup_paket like '%" . $pencarian_phrase . "%' or sirup_klpd like '%" . $pencarian_phrase . "%' or sirup_satuan_kerja like '%" . $pencarian_phrase . "%' or sirup_tahun_anggaran like '%" . $pencarian_phrase . "%' or sirup_jenis_pengadaan like '%" . $pencarian_phrase . "%' or sirup_total like '%" . $pencarian_phrase . "%' or sirup_metode_pemilihan like '%" . $pencarian_phrase . "%' or sirup_histori_paket like '%" . $pencarian_phrase . "%' or sirup_tgl_perbarui_paket like '%" . $pencarian_phrase . "%')";
      } else {
        $search_query = "and (" . $kolom_pencarian . " like '%" . $pencarian_phrase . "%')";
      }
    }
    $sirup_funnel = "";
    if ($funnel == "1") {
      $sirup_funnel = "and mstr_sirup.sirup_funnel = '1' ";
    }
    if ($funnel == "2") {
      $sirup_funnel = "and mstr_sirup.sirup_funnel = '0' ";
    }
    if ($this->session->user_role == "Sales Engineer" || $this->session->user_role == "Supervisor") {

      $query_kabupaten = "select kabupaten_nama from mstr_kabupaten
        join tbl_user_kabupaten on tbl_user_kabupaten.id_fk_kabupaten = mstr_kabupaten.id_pk_kabupaten
        join mstr_user on tbl_user_kabupaten.id_fk_user = mstr_user.id_pk_user
        where tbl_user_kabupaten.user_kabupaten_status = 'aktif' and tbl_user_kabupaten.id_fk_user = " . $this->session->id_user;

      $kabupaten = executeQuery($query_kabupaten)->result_array();
      if ($kabupaten == []) {
        $like_kabupaten = "";
        die();
      } else {
        $like_kabupaten = " and mstr_sirup.sirup_kabupaten LIKE";
        for ($i = 0; $i < count($kabupaten); $i++) {
          if ($i == count($kabupaten) - 1) {
            $like_kabupaten .= " '%" . $kabupaten[$i]["kabupaten_nama"] . "%' ";
          } else {
            $like_kabupaten .= " '%" . $kabupaten[$i]["kabupaten_nama"] . "%' OR mstr_sirup.sirup_kabupaten LIKE";
          }
        }
      }

      $sql = "
        select id_pk_sirup,sirup_rup,sirup_paket,sirup_klpd,sirup_satuan_kerja,sirup_tahun_anggaran,sirup_volume_pekerjaan,sirup_uraian_pekerjaan,sirup_spesifikasi_pekerjaan,sirup_produk_dalam_negri,sirup_usaha_kecil,sirup_pra_dipa,sirup_jenis_pengadaan,sirup_total,sirup_metode_pemilihan,sirup_histori_paket,sirup_tgl_perbarui_paket,sirup_status,sirup_tgl_create,sirup_tgl_update,sirup_tgl_delete,sirup_id_create,sirup_id_update,sirup_id_delete,id_fk_pencarian_sirup, if(pencarian_sirup_tahun is null,'',pencarian_sirup_tahun) as pencarian_sirup_tahun, if(pencarian_sirup_frase is null,'',pencarian_sirup_frase) as pencarian_sirup_frase, if(pencarian_sirup_jenis is null,'',pencarian_sirup_jenis) as pencarian_sirup_jenis
        from mstr_sirup
        left join mstr_pencarian_sirup on mstr_pencarian_sirup.id_pk_pencarian_sirup =  mstr_sirup.id_fk_pencarian_sirup
        left join mstr_prospek on mstr_prospek.no_faktur = mstr_sirup.sirup_rup
        where sirup_status = 'aktif' and sirup_status_sesuai_pencarian != 0 " . $like_kabupaten . $sirup_funnel . $search_query . " order by " . $kolom_pengurutan . " " . $arah_kolom_pengurutan . " limit 20 offset " . (20 * ($current_page - 1));

      return executeQuery($sql);
    } else if ($this->session->user_role == "Area Sales Manager") {
      $sql = "select id_pk_user from mstr_user where user_status = 'aktif' and user_supervisor = " . $this->session->id_user;
      $result = executeQuery($sql);

      $id_user_arr = $result->result_array();
      $id_user = "";

      for ($i = 0; $i < count($id_user_arr); $i++) {
        if ($id_user != "") {
          $id_user = $id_user . "," . $id_user_arr[$i]['id_pk_user'];
        } else {
          $id_user = $id_user_arr[$i]['id_pk_user'];
        }
      }

      $query_kabupaten = "select kabupaten_nama from mstr_kabupaten
        join tbl_user_kabupaten on tbl_user_kabupaten.id_fk_kabupaten = mstr_kabupaten.id_pk_kabupaten
        join mstr_user on tbl_user_kabupaten.id_fk_user = mstr_user.id_pk_user
        where tbl_user_kabupaten.user_kabupaten_status = 'aktif' and tbl_user_kabupaten.id_fk_user in ($id_user)";

      $kabupaten = executeQuery($query_kabupaten)->result_array();

      if ($kabupaten == []) {
        $like_kabupaten = "";
        die();
      } else {
        $like_kabupaten = " and mstr_sirup.sirup_kabupaten LIKE";
        for ($i = 0; $i < count($kabupaten); $i++) {
          if ($i == count($kabupaten) - 1) {
            $like_kabupaten .= " '%" . $kabupaten[$i]["kabupaten_nama"] . "%' ";
          } else {
            $like_kabupaten .= " '%" . $kabupaten[$i]["kabupaten_nama"] . "%' OR mstr_sirup.sirup_kabupaten LIKE";
          }
        }
      }

      $sql = "
        select id_pk_sirup,sirup_rup,sirup_paket,sirup_klpd,sirup_satuan_kerja,sirup_tahun_anggaran,sirup_volume_pekerjaan,sirup_uraian_pekerjaan,sirup_spesifikasi_pekerjaan,sirup_produk_dalam_negri,sirup_usaha_kecil,sirup_pra_dipa,sirup_jenis_pengadaan,sirup_total,sirup_metode_pemilihan,sirup_histori_paket,sirup_tgl_perbarui_paket,sirup_status,sirup_tgl_create,sirup_tgl_update,sirup_tgl_delete,sirup_id_create,sirup_id_update,sirup_id_delete,id_fk_pencarian_sirup, if(pencarian_sirup_tahun is null,'',pencarian_sirup_tahun) as pencarian_sirup_tahun, if(pencarian_sirup_frase is null,'',pencarian_sirup_frase) as pencarian_sirup_frase, if(pencarian_sirup_jenis is null,'',pencarian_sirup_jenis) as pencarian_sirup_jenis
        from mstr_sirup
        left join mstr_pencarian_sirup on mstr_pencarian_sirup.id_pk_pencarian_sirup =  mstr_sirup.id_fk_pencarian_sirup
        left join mstr_prospek on mstr_prospek.no_faktur = mstr_sirup.sirup_rup
        where sirup_status = 'aktif' and sirup_status_sesuai_pencarian != 0 " . $like_kabupaten . $sirup_funnel . $search_query . " order by " . $kolom_pengurutan . " " . $arah_kolom_pengurutan . " limit 20 offset " . (20 * ($current_page - 1));

      return executeQuery($sql);
    } else {
      $sql = "
        select id_pk_sirup,sirup_rup,sirup_paket,sirup_klpd,sirup_satuan_kerja,sirup_tahun_anggaran,sirup_volume_pekerjaan,sirup_uraian_pekerjaan,sirup_spesifikasi_pekerjaan,sirup_produk_dalam_negri,sirup_usaha_kecil,sirup_pra_dipa,sirup_jenis_pengadaan,sirup_total,sirup_metode_pemilihan,sirup_histori_paket,sirup_tgl_perbarui_paket,sirup_status,sirup_tgl_create,sirup_tgl_update,sirup_tgl_delete,sirup_id_create,sirup_id_update,sirup_id_delete,id_fk_pencarian_sirup, if(pencarian_sirup_tahun is null,'',pencarian_sirup_tahun) as pencarian_sirup_tahun, if(pencarian_sirup_frase is null,'',pencarian_sirup_frase) as pencarian_sirup_frase, if(pencarian_sirup_jenis is null,'',pencarian_sirup_jenis) as pencarian_sirup_jenis
        from mstr_sirup
        left join mstr_pencarian_sirup on mstr_pencarian_sirup.id_pk_pencarian_sirup =  mstr_sirup.id_fk_pencarian_sirup
        where sirup_status = 'aktif' and sirup_status_sesuai_pencarian != 0 " . $sirup_funnel . $search_query . " order by " . $kolom_pengurutan . " " . $arah_kolom_pengurutan . " limit 20 offset " . (20 * ($current_page - 1));

      return executeQuery($sql);
    }
  }
  public function search_with_creator($kolom_pengurutan, $arah_kolom_pengurutan, $pencarian_phrase, $kolom_pencarian, $current_page)
  {
    $search_query = "";
    if ($pencarian_phrase != "") {
      if ($kolom_pencarian == "all") {
        $search_query = "and (sirup_rup like '%" . $pencarian_phrase . "%' or sirup_paket like '%" . $pencarian_phrase . "%' or sirup_klpd like '%" . $pencarian_phrase . "%' or sirup_satuan_kerja like '%" . $pencarian_phrase . "%' or sirup_tahun_anggaran like '%" . $pencarian_phrase . "%' or sirup_jenis_pengadaan like '%" . $pencarian_phrase . "%' or sirup_total like '%" . $pencarian_phrase . "%' or sirup_metode_pemilihan like '%" . $pencarian_phrase . "%' or sirup_histori_paket like '%" . $pencarian_phrase . "%' or sirup_tgl_perbarui_paket like '%" . $pencarian_phrase . "%')";
      } else {
        $search_query = "and (" . $kolom_pencarian . " like '%" . $pencarian_phrase . "%')";
      }
    }
    $sql = "
    select id_pk_sirup,sirup_rup,sirup_paket,sirup_klpd,sirup_satuan_kerja,sirup_tahun_anggaran,sirup_volume_pekerjaan,sirup_uraian_pekerjaan,sirup_spesifikasi_pekerjaan,sirup_produk_dalam_negri,sirup_usaha_kecil,sirup_pra_dipa,sirup_jenis_pengadaan,sirup_total,sirup_metode_pemilihan,sirup_histori_paket,sirup_tgl_perbarui_paket,sirup_status,sirup_tgl_create,sirup_tgl_update,sirup_tgl_delete,sirup_id_create,sirup_id_update,sirup_id_delete,id_fk_pencarian_sirup, if(pencarian_sirup_tahun is null,'',pencarian_sirup_tahun) as pencarian_sirup_tahun, if(pencarian_sirup_frase is null,'',pencarian_sirup_frase) as pencarian_sirup_frase, if(pencarian_sirup_jenis is null,'',pencarian_sirup_jenis) as pencarian_sirup_jenis
    from mstr_sirup
    left join mstr_pencarian_sirup on mstr_pencarian_sirup.id_pk_pencarian_sirup =  mstr_sirup.id_fk_pencarian_sirup
    where sirup_status = 'aktif' and
    sirup_id_create = ? and sirup_status_sesuai_pencarian != 0 " . $search_query . " order by " . $kolom_pengurutan . " " . $arah_kolom_pengurutan . " limit 20 offset " . (20 * ($current_page - 1));
    $args = array(
      $this->session->id_user
    );
    return executeQuery($sql, $args);
  }
  public function get_data($kolom_pengurutan, $arah_kolom_pengurutan, $pencarian_phrase, $kolom_pencarian, $current_page)
  {
    $search_query = "";
    if ($pencarian_phrase != "") {
      if ($kolom_pencarian == "all") {
        $search_query = "and (sirup_rup like '%" . $pencarian_phrase . "%' or sirup_paket like '%" . $pencarian_phrase . "%' or sirup_klpd like '%" . $pencarian_phrase . "%' or sirup_satuan_kerja like '%" . $pencarian_phrase . "%' or sirup_tahun_anggaran like '%" . $pencarian_phrase . "%' or sirup_jenis_pengadaan like '%" . $pencarian_phrase . "%' or sirup_total like '%" . $pencarian_phrase . "%' or sirup_metode_pemilihan like '%" . $pencarian_phrase . "%' or sirup_histori_paket like '%" . $pencarian_phrase . "%' or sirup_tgl_perbarui_paket like '%" . $pencarian_phrase . "%')";
      } else {
        $search_query = "and (" . $kolom_pencarian . " like '%" . $pencarian_phrase . "%')";
      }
    }
    $sql = "
    select id_pk_sirup
    from mstr_sirup
    left join mstr_pencarian_sirup on mstr_pencarian_sirup.id_pk_pencarian_sirup =  mstr_sirup.id_fk_pencarian_sirup
    where sirup_status = 'aktif' and sirup_status_sesuai_pencarian != 0 " . $search_query;
    return executeQuery($sql);
  }
  public function get_data_system($kolom_pengurutan, $arah_kolom_pengurutan, $pencarian_phrase, $kolom_pencarian, $current_page, $funnel)
  {
    $search_query = "";
    if ($pencarian_phrase != "") {
      if ($kolom_pencarian == "all") {
        $search_query = "and (sirup_rup like '%" . $pencarian_phrase . "%' or sirup_paket like '%" . $pencarian_phrase . "%' or sirup_klpd like '%" . $pencarian_phrase . "%' or sirup_satuan_kerja like '%" . $pencarian_phrase . "%' or sirup_tahun_anggaran like '%" . $pencarian_phrase . "%' or sirup_jenis_pengadaan like '%" . $pencarian_phrase . "%' or sirup_total like '%" . $pencarian_phrase . "%' or sirup_metode_pemilihan like '%" . $pencarian_phrase . "%' or sirup_histori_paket like '%" . $pencarian_phrase . "%' or sirup_tgl_perbarui_paket like '%" . $pencarian_phrase . "%')";
      } else {
        $search_query = "and (" . $kolom_pencarian . " like '%" . $pencarian_phrase . "%')";
      }
    }
    $sirup_funnel = "";
    if ($funnel == "1") {
      $sirup_funnel = "and mstr_sirup.sirup_funnel = '1' ";
    }
    if ($funnel == "2") {
      $sirup_funnel = "and mstr_sirup.sirup_funnel = '0' ";
    }
    if ($this->session->user_role == "Sales Engineer" || $this->session->user_role == "Supervisor") {

      $query_kabupaten = "select kabupaten_nama from mstr_kabupaten
        join tbl_user_kabupaten on tbl_user_kabupaten.id_fk_kabupaten = mstr_kabupaten.id_pk_kabupaten
        join mstr_user on tbl_user_kabupaten.id_fk_user = mstr_user.id_pk_user
        where tbl_user_kabupaten.user_kabupaten_status = 'aktif' and tbl_user_kabupaten.id_fk_user = " . $this->session->id_user;

      $kabupaten = executeQuery($query_kabupaten)->result_array();

      if ($kabupaten == []) {
        $like_kabupaten = "";
        die();
      } else {
        $like_kabupaten = " and mstr_sirup.sirup_kabupaten LIKE";
        for ($i = 0; $i < count($kabupaten); $i++) {
          if ($i == count($kabupaten) - 1) {
            $like_kabupaten .= " '%" . $kabupaten[$i]["kabupaten_nama"] . "%' ";
          } else {
            $like_kabupaten .= " '%" . $kabupaten[$i]["kabupaten_nama"] . "%' OR mstr_sirup.sirup_kabupaten LIKE";
          }
        }
      }

      $sql = "
        select id_pk_sirup,sirup_rup,sirup_paket,sirup_klpd,sirup_satuan_kerja,sirup_tahun_anggaran,sirup_volume_pekerjaan,sirup_uraian_pekerjaan,sirup_spesifikasi_pekerjaan,sirup_produk_dalam_negri,sirup_usaha_kecil,sirup_pra_dipa,sirup_jenis_pengadaan,sirup_total,sirup_metode_pemilihan,sirup_histori_paket,sirup_tgl_perbarui_paket,sirup_status,sirup_tgl_create,sirup_tgl_update,sirup_tgl_delete,sirup_id_create,sirup_id_update,sirup_id_delete,id_fk_pencarian_sirup, if(pencarian_sirup_tahun is null,'',pencarian_sirup_tahun) as pencarian_sirup_tahun, if(pencarian_sirup_frase is null,'',pencarian_sirup_frase) as pencarian_sirup_frase, if(pencarian_sirup_jenis is null,'',pencarian_sirup_jenis) as pencarian_sirup_jenis
        from mstr_sirup
        left join mstr_pencarian_sirup on mstr_pencarian_sirup.id_pk_pencarian_sirup =  mstr_sirup.id_fk_pencarian_sirup
        left join mstr_prospek on mstr_prospek.no_faktur = mstr_sirup.sirup_rup
        where sirup_status = 'aktif' and sirup_status_sesuai_pencarian != 0 " . $like_kabupaten . $sirup_funnel . $search_query . " order by " . $kolom_pengurutan . " " . $arah_kolom_pengurutan;

      return executeQuery($sql);
    } else if ($this->session->user_role == "Area Sales Manager") {
      $sql = "select id_pk_user from mstr_user where user_status = 'aktif' and user_supervisor = " . $this->session->id_user;
      $result = executeQuery($sql);

      $id_user_arr = $result->result_array();
      $id_user = "";

      for ($i = 0; $i < count($id_user_arr); $i++) {
        if ($id_user != "") {
          $id_user = $id_user . "," . $id_user_arr[$i]['id_pk_user'];
        } else {
          $id_user = $id_user_arr[$i]['id_pk_user'];
        }
      }

      $query_kabupaten = "select kabupaten_nama from mstr_kabupaten
        join tbl_user_kabupaten on tbl_user_kabupaten.id_fk_kabupaten = mstr_kabupaten.id_pk_kabupaten
        join mstr_user on tbl_user_kabupaten.id_fk_user = mstr_user.id_pk_user
        where tbl_user_kabupaten.user_kabupaten_status = 'aktif' and tbl_user_kabupaten.id_fk_user in ($id_user)";

      $kabupaten = executeQuery($query_kabupaten)->result_array();

      if ($kabupaten == []) {
        $like_kabupaten = "";
        die();
      } else {
        $like_kabupaten = " and mstr_sirup.sirup_kabupaten LIKE";
        for ($i = 0; $i < count($kabupaten); $i++) {
          if ($i == count($kabupaten) - 1) {
            $like_kabupaten .= " '%" . $kabupaten[$i]["kabupaten_nama"] . "%' ";
          } else {
            $like_kabupaten .= " '%" . $kabupaten[$i]["kabupaten_nama"] . "%' OR mstr_sirup.sirup_kabupaten LIKE";
          }
        }
      }

      $sql = "
        select id_pk_sirup,sirup_rup,sirup_paket,sirup_klpd,sirup_satuan_kerja,sirup_tahun_anggaran,sirup_volume_pekerjaan,sirup_uraian_pekerjaan,sirup_spesifikasi_pekerjaan,sirup_produk_dalam_negri,sirup_usaha_kecil,sirup_pra_dipa,sirup_jenis_pengadaan,sirup_total,sirup_metode_pemilihan,sirup_histori_paket,sirup_tgl_perbarui_paket,sirup_status,sirup_tgl_create,sirup_tgl_update,sirup_tgl_delete,sirup_id_create,sirup_id_update,sirup_id_delete,id_fk_pencarian_sirup, if(pencarian_sirup_tahun is null,'',pencarian_sirup_tahun) as pencarian_sirup_tahun, if(pencarian_sirup_frase is null,'',pencarian_sirup_frase) as pencarian_sirup_frase, if(pencarian_sirup_jenis is null,'',pencarian_sirup_jenis) as pencarian_sirup_jenis
        from mstr_sirup
        left join mstr_pencarian_sirup on mstr_pencarian_sirup.id_pk_pencarian_sirup =  mstr_sirup.id_fk_pencarian_sirup
        left join mstr_prospek on mstr_prospek.no_faktur = mstr_sirup.sirup_rup
        where sirup_status = 'aktif' and sirup_status_sesuai_pencarian != 0 " . $like_kabupaten . $sirup_funnel . $search_query . " order by " . $kolom_pengurutan . " " . $arah_kolom_pengurutan;

      return executeQuery($sql);
    } else {
      $sql = "
        select id_pk_sirup,sirup_rup,sirup_paket,sirup_klpd,sirup_satuan_kerja,sirup_tahun_anggaran,sirup_volume_pekerjaan,sirup_uraian_pekerjaan,sirup_spesifikasi_pekerjaan,sirup_produk_dalam_negri,sirup_usaha_kecil,sirup_pra_dipa,sirup_jenis_pengadaan,sirup_total,sirup_metode_pemilihan,sirup_histori_paket,sirup_tgl_perbarui_paket,sirup_status,sirup_tgl_create,sirup_tgl_update,sirup_tgl_delete,sirup_id_create,sirup_id_update,sirup_id_delete,id_fk_pencarian_sirup, if(pencarian_sirup_tahun is null,'',pencarian_sirup_tahun) as pencarian_sirup_tahun, if(pencarian_sirup_frase is null,'',pencarian_sirup_frase) as pencarian_sirup_frase, if(pencarian_sirup_jenis is null,'',pencarian_sirup_jenis) as pencarian_sirup_jenis
        from mstr_sirup
        left join mstr_pencarian_sirup on mstr_pencarian_sirup.id_pk_pencarian_sirup =  mstr_sirup.id_fk_pencarian_sirup
        where sirup_status = 'aktif' and sirup_status_sesuai_pencarian != 0 " . $sirup_funnel . $search_query . " order by " . $kolom_pengurutan . " " . $arah_kolom_pengurutan;

      return executeQuery($sql);
    }
  }
  public function get_data_with_creator($kolom_pengurutan, $arah_kolom_pengurutan, $pencarian_phrase, $kolom_pencarian, $current_page)
  {
    $search_query = "";
    if ($pencarian_phrase != "") {
      if ($kolom_pencarian == "all") {
        $search_query = "and (sirup_rup like '%" . $pencarian_phrase . "%' or sirup_paket like '%" . $pencarian_phrase . "%' or sirup_klpd like '%" . $pencarian_phrase . "%' or sirup_satuan_kerja like '%" . $pencarian_phrase . "%' or sirup_tahun_anggaran like '%" . $pencarian_phrase . "%' or sirup_jenis_pengadaan like '%" . $pencarian_phrase . "%' or sirup_total like '%" . $pencarian_phrase . "%' or sirup_metode_pemilihan like '%" . $pencarian_phrase . "%' or sirup_histori_paket like '%" . $pencarian_phrase . "%' or sirup_tgl_perbarui_paket like '%" . $pencarian_phrase . "%')";
      } else {
        $search_query = "and (" . $kolom_pencarian . " like '%" . $pencarian_phrase . "%')";
      }
    }
    $sql = "
    select id_pk_sirup
    from mstr_sirup
    left join mstr_pencarian_sirup on mstr_pencarian_sirup.id_pk_pencarian_sirup =  mstr_sirup.id_fk_pencarian_sirup
    where sirup_id_create = ? and sirup_status = 'aktif' and sirup_status_sesuai_pencarian != 0 " . $search_query;
    $args = array(
      $this->session->id_user
    );
    return executeQuery($sql, $args);
  }
  public function delete_lokasi_pekerjaan($id)
  {
    $where = array(
      "id_pk_lokasi_pekerjaan" => $id
    );
    deleteRow("tbl_sirup_lokasi_pekerjaan", $where);
  }
  public function delete_sumber_dana($id)
  {
    $where = array(
      "id_pk_sumber_dana" => $id
    );
    deleteRow("tbl_sirup_sumber_dana", $where);
  }
  public function delete_pemanfaatan_barang($id)
  {
    $where = array(
      "id_pk_pemanfaatan_barang" => $id
    );
    deleteRow("tbl_sirup_pemanfaatan_barang", $where);
  }
  public function delete_pelaksanaan_kontrak($id)
  {
    $where = array(
      "id_pk_jadwal_pelaksanaan" => $id
    );
    deleteRow("tbl_sirup_jadwal_pelaksanaan", $where);
  }
  public function delete_pemilihan_penyedia($id)
  {
    $where = array(
      "id_pk_pemilihan_penyedia" => $id
    );
    deleteRow("tbl_sirup_pemilihan_penyedia", $where);
  }
  public function check_duplicate_insert($sirup_rup)
  {
    $where = array(
      "sirup_rup" => $sirup_rup,
      "sirup_status !=" => "nonaktif"
    );
    return selectRow("mstr_sirup", $where);
  }
  public function check_duplicate_update($id_pk_sirup, $sirup_rup)
  {
    $where = array(
      "id_pk_sirup !=" => $id_pk_sirup,
      "sirup_rup" => $sirup_rup,
      "sirup_status !=" => "nonaktif"
    );
    return selectRow("mstr_sirup", $where);
  }

  public function export_sirup($kolom_pengurutan, $arah_kolom_pengurutan, $pencarian_phrase, $kolom_pencarian, $funnel)
  {
    $search_query = "";
    if ($pencarian_phrase != "") {
      if ($kolom_pencarian == "all") {
        $search_query = "and (sirup_rup like '%" . $pencarian_phrase . "%' or sirup_paket like '%" . $pencarian_phrase . "%' or sirup_klpd like '%" . $pencarian_phrase . "%' or sirup_satuan_kerja like '%" . $pencarian_phrase . "%' or sirup_tahun_anggaran like '%" . $pencarian_phrase . "%' or sirup_jenis_pengadaan like '%" . $pencarian_phrase . "%' or sirup_total like '%" . $pencarian_phrase . "%' or sirup_metode_pemilihan like '%" . $pencarian_phrase . "%' or sirup_histori_paket like '%" . $pencarian_phrase . "%' or sirup_tgl_perbarui_paket like '%" . $pencarian_phrase . "%')";
      } else {
        $search_query = "and (" . $kolom_pencarian . " like '%" . $pencarian_phrase . "%')";
      }
    }
    $sirup_funnel = "";
    if ($funnel == "1") {
      $sirup_funnel = "and mstr_sirup.sirup_funnel = '1' ";
    }
    if ($funnel == "2") {
      $sirup_funnel = "and mstr_sirup.sirup_funnel = '0' ";
    }
    if ($this->session->user_role == "Sales Engineer" || $this->session->user_role == "Supervisor") {

      $query_kabupaten = "select kabupaten_nama from mstr_kabupaten
        join tbl_user_kabupaten on tbl_user_kabupaten.id_fk_kabupaten = mstr_kabupaten.id_pk_kabupaten
        join mstr_user on tbl_user_kabupaten.id_fk_user = mstr_user.id_pk_user
        where tbl_user_kabupaten.user_kabupaten_status = 'aktif' and tbl_user_kabupaten.id_fk_user = " . $this->session->id_user;

      $kabupaten = executeQuery($query_kabupaten)->result_array();

      if ($kabupaten == []) {
        $like_kabupaten = "";
        die();
      } else {
        $like_kabupaten = " and mstr_sirup.sirup_kabupaten LIKE";
        for ($i = 0; $i < count($kabupaten); $i++) {
          if ($i == count($kabupaten) - 1) {
            $like_kabupaten .= " '%" . $kabupaten[$i]["kabupaten_nama"] . "%' ";
          } else {
            $like_kabupaten .= " '%" . $kabupaten[$i]["kabupaten_nama"] . "%' OR mstr_sirup.sirup_kabupaten LIKE";
          }
        }
      }

      $sql = "
        select id_pk_sirup,sirup_rup,sirup_paket,sirup_klpd,sirup_kabupaten,sirup_provinsi,sirup_jadwal_pemilihan,sirup_satuan_kerja,sirup_tahun_anggaran,sirup_volume_pekerjaan,sirup_uraian_pekerjaan,sirup_spesifikasi_pekerjaan,sirup_produk_dalam_negri,sirup_usaha_kecil,sirup_pra_dipa,sirup_jenis_pengadaan,sirup_total,sirup_metode_pemilihan,sirup_histori_paket,sirup_tgl_perbarui_paket,sirup_status,sirup_tgl_create,sirup_tgl_update,sirup_tgl_delete,sirup_id_create,sirup_id_update,sirup_id_delete,id_fk_pencarian_sirup, if(pencarian_sirup_tahun is null,'',pencarian_sirup_tahun) as pencarian_sirup_tahun, if(pencarian_sirup_frase is null,'',pencarian_sirup_frase) as pencarian_sirup_frase, if(pencarian_sirup_jenis is null,'',pencarian_sirup_jenis) as pencarian_sirup_jenis
        from mstr_sirup 
        left join mstr_pencarian_sirup on mstr_pencarian_sirup.id_pk_pencarian_sirup =  mstr_sirup.id_fk_pencarian_sirup
        left join mstr_prospek on mstr_prospek.no_faktur = mstr_sirup.sirup_rup
        where sirup_status = 'aktif' and sirup_status_sesuai_pencarian != 0 " . $like_kabupaten . $sirup_funnel . $search_query . " order by " . $kolom_pengurutan . " " . $arah_kolom_pengurutan;

      return executeQuery($sql);
    } else if ($this->session->user_role == "Area Sales Manager") {
      $sql = "select id_pk_user from mstr_user where user_status = 'aktif' and user_supervisor = " . $this->session->id_user;
      $result = executeQuery($sql);

      $id_user_arr = $result->result_array();
      $id_user = "";

      for ($i = 0; $i < count($id_user_arr); $i++) {
        if ($id_user != "") {
          $id_user = $id_user . "," . $id_user_arr[$i]['id_pk_user'];
        } else {
          $id_user = $id_user_arr[$i]['id_pk_user'];
        }
      }

      $query_kabupaten = "select kabupaten_nama from mstr_kabupaten
        join tbl_user_kabupaten on tbl_user_kabupaten.id_fk_kabupaten = mstr_kabupaten.id_pk_kabupaten
        join mstr_user on tbl_user_kabupaten.id_fk_user = mstr_user.id_pk_user
        where tbl_user_kabupaten.user_kabupaten_status = 'aktif' and tbl_user_kabupaten.id_fk_user in ($id_user)";

      $kabupaten = executeQuery($query_kabupaten)->result_array();

      if ($kabupaten == []) {
        $like_kabupaten = "";
        die();
      } else {
        $like_kabupaten = " and mstr_sirup.sirup_kabupaten LIKE";
        for ($i = 0; $i < count($kabupaten); $i++) {
          if ($i == count($kabupaten) - 1) {
            $like_kabupaten .= " '%" . $kabupaten[$i]["kabupaten_nama"] . "%' ";
          } else {
            $like_kabupaten .= " '%" . $kabupaten[$i]["kabupaten_nama"] . "%' OR mstr_sirup.sirup_kabupaten LIKE";
          }
        }
      }

      $sql = "
        select id_pk_sirup,sirup_rup,sirup_paket,sirup_klpd,sirup_kabupaten,sirup_provinsi,sirup_jadwal_pemilihan,sirup_satuan_kerja,sirup_tahun_anggaran,sirup_volume_pekerjaan,sirup_uraian_pekerjaan,sirup_spesifikasi_pekerjaan,sirup_produk_dalam_negri,sirup_usaha_kecil,sirup_pra_dipa,sirup_jenis_pengadaan,sirup_total,sirup_metode_pemilihan,sirup_histori_paket,sirup_tgl_perbarui_paket,sirup_status,sirup_tgl_create,sirup_tgl_update,sirup_tgl_delete,sirup_id_create,sirup_id_update,sirup_id_delete,id_fk_pencarian_sirup, if(pencarian_sirup_tahun is null,'',pencarian_sirup_tahun) as pencarian_sirup_tahun, if(pencarian_sirup_frase is null,'',pencarian_sirup_frase) as pencarian_sirup_frase, if(pencarian_sirup_jenis is null,'',pencarian_sirup_jenis) as pencarian_sirup_jenis
        from mstr_sirup 
        left join mstr_pencarian_sirup on mstr_pencarian_sirup.id_pk_pencarian_sirup =  mstr_sirup.id_fk_pencarian_sirup
        left join mstr_prospek on mstr_prospek.no_faktur = mstr_sirup.sirup_rup
        where sirup_status = 'aktif' and sirup_status_sesuai_pencarian != 0 " . $like_kabupaten . $sirup_funnel . $search_query . " order by " . $kolom_pengurutan . " " . $arah_kolom_pengurutan;

      return executeQuery($sql);
    } else if ($this->session->user_role == "Sales Manager") {
      $sql = "select id_pk_user from mstr_user where user_status = 'aktif' and user_supervisor = " . $this->session->id_user;
      $result = executeQuery($sql);

      $id_user_arr = $result->result_array();
      $id_user_asm = "";

      for ($i = 0; $i < count($id_user_arr); $i++) {
        if ($id_user_asm != "") {
          $id_user_asm = $id_user_asm . "," . $id_user_arr[$i]['id_pk_user'];
        } else {
          $id_user_asm = $id_user_arr[$i]['id_pk_user'];
        }
      }

      $sql = "select id_pk_user from mstr_user where user_status = 'aktif' and user_supervisor in ($id_user_asm)";

      $result = executeQuery($sql);

      $id_user_arr = $result->result_array();
      $id_user = "";

      for ($i = 0; $i < count($id_user_arr); $i++) {
        if ($id_user != "") {
          $id_user = $id_user . "," . $id_user_arr[$i]['id_pk_user'];
        } else {
          $id_user = $id_user_arr[$i]['id_pk_user'];
        }
      }


      $query_kabupaten = "select kabupaten_nama from mstr_kabupaten
        join tbl_user_kabupaten on tbl_user_kabupaten.id_fk_kabupaten = mstr_kabupaten.id_pk_kabupaten
        join mstr_user on tbl_user_kabupaten.id_fk_user = mstr_user.id_pk_user
        where tbl_user_kabupaten.user_kabupaten_status = 'aktif' and tbl_user_kabupaten.id_fk_user in ($id_user)";

      $kabupaten = executeQuery($query_kabupaten)->result_array();

      if ($kabupaten == []) {
        $like_kabupaten = "";
        die();
      } else {
        $like_kabupaten = " and mstr_sirup.sirup_kabupaten LIKE";
        for ($i = 0; $i < count($kabupaten); $i++) {
          if ($i == count($kabupaten) - 1) {
            $like_kabupaten .= " '%" . $kabupaten[$i]["kabupaten_nama"] . "%' ";
          } else {
            $like_kabupaten .= " '%" . $kabupaten[$i]["kabupaten_nama"] . "%' OR mstr_sirup.sirup_kabupaten LIKE";
          }
        }
      }
      $sql = "
        select id_pk_sirup,sirup_rup,sirup_paket,sirup_klpd,sirup_kabupaten,sirup_provinsi,sirup_jadwal_pemilihan,sirup_satuan_kerja,sirup_tahun_anggaran,sirup_volume_pekerjaan,sirup_uraian_pekerjaan,sirup_spesifikasi_pekerjaan,sirup_produk_dalam_negri,sirup_usaha_kecil,sirup_pra_dipa,sirup_jenis_pengadaan,sirup_total,sirup_metode_pemilihan,sirup_histori_paket,sirup_tgl_perbarui_paket,sirup_status,sirup_tgl_create,sirup_tgl_update,sirup_tgl_delete,sirup_id_create,sirup_id_update,sirup_id_delete,id_fk_pencarian_sirup, if(pencarian_sirup_tahun is null,'',pencarian_sirup_tahun) as pencarian_sirup_tahun, if(pencarian_sirup_frase is null,'',pencarian_sirup_frase) as pencarian_sirup_frase, if(pencarian_sirup_jenis is null,'',pencarian_sirup_jenis) as pencarian_sirup_jenis
        from mstr_sirup
        left join mstr_pencarian_sirup on mstr_pencarian_sirup.id_pk_pencarian_sirup =  mstr_sirup.id_fk_pencarian_sirup
        left join mstr_prospek on mstr_prospek.no_faktur = mstr_sirup.sirup_rup
        where sirup_status = 'aktif' and sirup_status_sesuai_pencarian != 0 " . $like_kabupaten . $sirup_funnel . $search_query . " order by " . $kolom_pengurutan . " " . $arah_kolom_pengurutan;

      return executeQuery($sql);
    } else {
      $sql = "
        select id_pk_sirup,sirup_rup,sirup_paket,sirup_klpd,sirup_kabupaten,sirup_provinsi,sirup_jadwal_pemilihan,sirup_satuan_kerja,sirup_tahun_anggaran,sirup_volume_pekerjaan,sirup_uraian_pekerjaan,sirup_spesifikasi_pekerjaan,sirup_produk_dalam_negri,sirup_usaha_kecil,sirup_pra_dipa,sirup_jenis_pengadaan,sirup_total,sirup_metode_pemilihan,sirup_histori_paket,sirup_tgl_perbarui_paket,sirup_status,sirup_tgl_create,sirup_tgl_update,sirup_tgl_delete,sirup_id_create,sirup_id_update,sirup_id_delete,id_fk_pencarian_sirup, if(pencarian_sirup_tahun is null,'',pencarian_sirup_tahun) as pencarian_sirup_tahun, if(pencarian_sirup_frase is null,'',pencarian_sirup_frase) as pencarian_sirup_frase, if(pencarian_sirup_jenis is null,'',pencarian_sirup_jenis) as pencarian_sirup_jenis
        from mstr_sirup
        left join mstr_pencarian_sirup on mstr_pencarian_sirup.id_pk_pencarian_sirup =  mstr_sirup.id_fk_pencarian_sirup
        where sirup_status = 'aktif' and sirup_status_sesuai_pencarian != 0 " . $sirup_funnel . $search_query . " order by " . $kolom_pengurutan . " " . $arah_kolom_pengurutan;

      return executeQuery($sql);
    }
  }

  public function get_sirup_id_pencarian($keyword)
  {
    $sql = "select id_pk_pencarian_sirup from mstr_pencarian_sirup
    where pencarian_sirup_status = aktif and pencarian_sirup_frase = '" . $keyword . "'";
    return executeQuery($sql);
  }

  public function delete_sirup($id_pk_pencarian_sirup)
  {
    $sql = "delete from mstr_sirup where id_fk_pencarian_sirup = " . $id_pk_pencarian_sirup;
    executeQuery($sql);
    return $sql;
  }
  public function sirup_funnel_backup($funnel)
  {
    $sirup_funnel = "";
    if ($funnel == "1") {
      $sirup_funnel = "and mstr_sirup.sirup_funnel = '1' ";
    }
    if ($funnel == "2") {
      $sirup_funnel = "and mstr_sirup.sirup_funnel = '0' ";
    }
    if ($this->session->user_role == "Sales Engineer" || $this->session->user_role == "Area Sales Manager" || $this->session->user_role == "Supervisor") {

      $query_kabupaten = "select kabupaten_nama from mstr_kabupaten
        join tbl_user_kabupaten on tbl_user_kabupaten.id_fk_kabupaten = mstr_kabupaten.id_pk_kabupaten
        join mstr_user on tbl_user_kabupaten.id_fk_user = mstr_user.id_pk_user
        where tbl_user_kabupaten.user_kabupaten_status = 'aktif' and tbl_user_kabupaten.id_fk_user = " . $this->session->id_user;

      $kabupaten = executeQuery($query_kabupaten)->result_array();

      if ($kabupaten == []) {
        $like_kabupaten = "";
        die();
      } else {
        $like_kabupaten = " and tbl_sirup_lokasi_pekerjaan.lokasi_pekerjaan LIKE";
        for ($i = 0; $i < count($kabupaten); $i++) {
          // $pattern = "/\KOTA |\KABUPATEN /";
          // $components = preg_split($pattern, $kabupaten[$i]['kabupaten_nama']);

          // if ($i == count($kabupaten) - 1) {
          //   $like_kabupaten .= " '%" . $components[1] . "%' ";
          // } else {
          //   $like_kabupaten .= " '%" . $components[1] . "%' OR tbl_sirup_lokasi_pekerjaan.lokasi_pekerjaan LIKE";
          // }
          if ($i == count($kabupaten) - 1) {
            $like_kabupaten .= " '%" . $kabupaten[$i]["kabupaten_nama"] . "%' ";
          } else {
            $like_kabupaten .= " '%" . $kabupaten[$i]["kabupaten_nama"] . "%' OR tbl_sirup_lokasi_pekerjaan.lokasi_pekerjaan LIKE";
          }
        }
      }

      $sql = "
        select id_pk_sirup,sirup_rup,sirup_paket,sirup_klpd,sirup_satuan_kerja,sirup_tahun_anggaran,sirup_volume_pekerjaan,sirup_uraian_pekerjaan,sirup_spesifikasi_pekerjaan,sirup_produk_dalam_negri,sirup_usaha_kecil,sirup_pra_dipa,sirup_jenis_pengadaan,sirup_total,sirup_metode_pemilihan,sirup_histori_paket,sirup_tgl_perbarui_paket,sirup_status,sirup_tgl_create,sirup_tgl_update,sirup_tgl_delete,sirup_id_create,sirup_id_update,sirup_id_delete,id_fk_pencarian_sirup, if(pencarian_sirup_tahun is null,'',pencarian_sirup_tahun) as pencarian_sirup_tahun, if(pencarian_sirup_frase is null,'',pencarian_sirup_frase) as pencarian_sirup_frase, if(pencarian_sirup_jenis is null,'',pencarian_sirup_jenis) as pencarian_sirup_jenis
        from mstr_sirup
        left join mstr_pencarian_sirup on mstr_pencarian_sirup.id_pk_pencarian_sirup =  mstr_sirup.id_fk_pencarian_sirup
        left join tbl_sirup_lokasi_pekerjaan on tbl_sirup_lokasi_pekerjaan.id_fk_sirup = mstr_sirup.id_pk_sirup
        left join mstr_prospek on mstr_prospek.no_faktur = mstr_sirup.sirup_rup
        where sirup_id_create = " . $this->session->id_user . " " . $like_kabupaten . " and sirup_status = 'aktif' " . $sirup_funnel;
      return executeQuery($sql);
    } else {
      $sql = "
        select id_pk_sirup,sirup_rup,sirup_paket,sirup_klpd,sirup_satuan_kerja,sirup_tahun_anggaran,sirup_volume_pekerjaan,sirup_uraian_pekerjaan,sirup_spesifikasi_pekerjaan,sirup_produk_dalam_negri,sirup_usaha_kecil,sirup_pra_dipa,sirup_jenis_pengadaan,sirup_total,sirup_metode_pemilihan,sirup_histori_paket,sirup_tgl_perbarui_paket,sirup_status,sirup_tgl_create,sirup_tgl_update,sirup_tgl_delete,sirup_id_create,sirup_id_update,sirup_id_delete,id_fk_pencarian_sirup, if(pencarian_sirup_tahun is null,'',pencarian_sirup_tahun) as pencarian_sirup_tahun, if(pencarian_sirup_frase is null,'',pencarian_sirup_frase) as pencarian_sirup_frase, if(pencarian_sirup_jenis is null,'',pencarian_sirup_jenis) as pencarian_sirup_jenis
        from mstr_sirup
        left join mstr_pencarian_sirup on mstr_pencarian_sirup.id_pk_pencarian_sirup =  mstr_sirup.id_fk_pencarian_sirup
        left join mstr_prospek on mstr_prospek.no_faktur = mstr_sirup.sirup_rup
        where sirup_status = 'aktif' and sirup_status_sesuai_pencarian != 0 " . $sirup_funnel;

      return executeQuery($sql);
    }
  }

  public function sirup_funnel($funnel)
  {
    if ($this->session->user_role == "Supervisor") {

      $query_kabupaten = "select kabupaten_nama from mstr_kabupaten
        join tbl_user_kabupaten on tbl_user_kabupaten.id_fk_kabupaten = mstr_kabupaten.id_pk_kabupaten
        join mstr_user on tbl_user_kabupaten.id_fk_user = mstr_user.id_pk_user
        where tbl_user_kabupaten.user_kabupaten_status = 'aktif' and tbl_user_kabupaten.id_fk_user = " . $this->session->id_user;

      $kabupaten = executeQuery($query_kabupaten)->result_array();
      if ($kabupaten == []) {
        $like_kabupaten = "";
        die();
      } else {
        $like_kabupaten = " and mstr_sirup.sirup_kabupaten LIKE";
        for ($i = 0; $i < count($kabupaten); $i++) {
          if ($i == count($kabupaten) - 1) {
            $like_kabupaten .= " '%" . $kabupaten[$i]["kabupaten_nama"] . "%' ";
          } else {
            $like_kabupaten .= " '%" . $kabupaten[$i]["kabupaten_nama"] . "%' OR mstr_sirup.sirup_kabupaten LIKE";
          }
        }
      }
      $sql = "
        select count(id_pk_sirup) as jmlh
        from mstr_sirup 
        left join mstr_pencarian_sirup on mstr_pencarian_sirup.id_pk_pencarian_sirup =  mstr_sirup.id_fk_pencarian_sirup
        left join mstr_prospek on mstr_prospek.no_faktur = mstr_sirup.sirup_rup
        where sirup_status = 'aktif' and sirup_funnel = $funnel and sirup_status_sesuai_pencarian != 0" . $like_kabupaten;
      return executeQuery($sql);
    } else if ($this->session->user_role == "Area Sales Manager") {
      $sql = "select id_pk_user from mstr_user where user_status = 'aktif' and user_supervisor = " . $this->session->id_user;
      $result = executeQuery($sql);

      $id_user_arr = $result->result_array();
      $id_user = "";

      for ($i = 0; $i < count($id_user_arr); $i++) {
        if ($id_user != "") {
          $id_user = $id_user . "," . $id_user_arr[$i]['id_pk_user'];
        } else {
          $id_user = $id_user_arr[$i]['id_pk_user'];
        }
      }

      $query_kabupaten = "select kabupaten_nama from mstr_kabupaten
        join tbl_user_kabupaten on tbl_user_kabupaten.id_fk_kabupaten = mstr_kabupaten.id_pk_kabupaten
        join mstr_user on tbl_user_kabupaten.id_fk_user = mstr_user.id_pk_user
        where tbl_user_kabupaten.user_kabupaten_status = 'aktif' and tbl_user_kabupaten.id_fk_user in ($id_user)";

      $kabupaten = executeQuery($query_kabupaten)->result_array();
      if ($kabupaten == []) {
        $like_kabupaten = "";
        die();
      } else {
        $like_kabupaten = " and mstr_sirup.sirup_kabupaten LIKE";
        for ($i = 0; $i < count($kabupaten); $i++) {
          if ($i == count($kabupaten) - 1) {
            $like_kabupaten .= " '%" . $kabupaten[$i]["kabupaten_nama"] . "%' ";
          } else {
            $like_kabupaten .= " '%" . $kabupaten[$i]["kabupaten_nama"] . "%' OR mstr_sirup.sirup_kabupaten LIKE";
          }
        }
      }
      $sql = "
        select count(id_pk_sirup) as jmlh
        from mstr_sirup 
        left join mstr_pencarian_sirup on mstr_pencarian_sirup.id_pk_pencarian_sirup =  mstr_sirup.id_fk_pencarian_sirup
        left join mstr_prospek on mstr_prospek.no_faktur = mstr_sirup.sirup_rup
        where sirup_status = 'aktif' and sirup_funnel = $funnel and sirup_status_sesuai_pencarian != 0" . $like_kabupaten;
      return executeQuery($sql);
    } else if ($this->session->user_role == "Sales Manager") {
      $sql = "
        select count(id_pk_sirup) as jmlh
        from mstr_sirup 
        left join mstr_pencarian_sirup on mstr_pencarian_sirup.id_pk_pencarian_sirup =  mstr_sirup.id_fk_pencarian_sirup
        left join mstr_prospek on mstr_prospek.no_faktur = mstr_sirup.sirup_rup
        where sirup_status = 'aktif' and sirup_status_sesuai_pencarian != 0 and sirup_funnel = $funnel";

      return executeQuery($sql);
    } else {
      $sql = "
        select count(id_pk_sirup) as jmlh
        from mstr_sirup 
        left join mstr_pencarian_sirup on mstr_pencarian_sirup.id_pk_pencarian_sirup =  mstr_sirup.id_fk_pencarian_sirup
        where sirup_status = 'aktif' and sirup_status_sesuai_pencarian != 0 and sirup_funnel = $funnel";

      return executeQuery($sql);
    }
  }
}
