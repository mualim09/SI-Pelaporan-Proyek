<?php
date_default_timezone_set("Asia/Jakarta");
class M_prospek extends CI_Model
{
  public function get_curr_year_prospek()
  {
    $sql = "SELECT id_pk_prospek
    FROM mstr_prospek
    WHERE year(prospek_tgl_create) =" . date("Y");
    return executeQuery($sql);
  }

  public function get_prospek($kolom_pengurutan, $arah_kolom_pengurutan, $pencarian_phrase, $kolom_pencarian, $current_page, $id_user)
  {
    $search_query = "";
    if ($pencarian_phrase != "") {
      if ($kolom_pencarian == "all") {
        $search_query = "and (provinsi_nama like '%" . $pencarian_phrase . "%' or kabupaten_nama like '%" . $pencarian_phrase . "%' or rs_nama like '%" . $pencarian_phrase . "%' or prospek_principle like '%" . $pencarian_phrase . "%' or total_price_prospek like '%" . $pencarian_phrase . "%' or no_faktur like '%" . $pencarian_phrase . "%' or no_ekatalog like '%" . $pencarian_phrase . "%' or funnel_percentage like '%" . $pencarian_phrase . "%' or estimasi_pembelian like '%" . $pencarian_phrase . "%' or funnel like '%" . $pencarian_phrase . "%' or notes_kompetitor like '%" . $pencarian_phrase . "%' or notes_prospek like '%" . $pencarian_phrase . "%' or prospek_status like '%" . $pencarian_phrase . "%')";
      } else {
        $search_query = "and (" . $kolom_pencarian . " like '%" . $pencarian_phrase . "%')";
      }
    }
    $sql = "SELECT id_pk_prospek, prospek_kode, mstr_provinsi.provinsi_nama as nama_provinsi, mstr_kabupaten.kabupaten_nama as nama_kabupaten, mstr_rs.rs_nama as nama_rs, prospek_principle, total_price_prospek, notes_kompetitor, notes_prospek, no_faktur, no_ekatalog, funnel, funnel_percentage, estimasi_pembelian, note_loss, prospek_status, prospek_id_create,user_username
    FROM mstr_prospek
    INNER JOIN mstr_rs on mstr_prospek.id_fk_rs = mstr_rs.id_pk_rs
    INNER JOIN mstr_kabupaten on mstr_kabupaten.id_pk_kabupaten = mstr_rs.id_fk_kabupaten
    INNER JOIN mstr_provinsi on mstr_provinsi.id_pk_provinsi = mstr_kabupaten.id_fk_provinsi
    INNER JOIN mstr_user on mstr_user.id_pk_user = mstr_prospek.prospek_id_create
    WHERE prospek_id_create= ? AND prospek_status='aktif' " . $search_query;
    $args = array(
      $id_user
    );
    return executeQuery($sql, $args);
  }
  public function search_per_user($kolom_pengurutan, $arah_kolom_pengurutan, $pencarian_phrase, $kolom_pencarian, $current_page, $id_user)
  {
    $search_query = "";
    if ($pencarian_phrase != "") {
      if ($kolom_pencarian == "all") {
        $search_query = "and (provinsi_nama like '%" . $pencarian_phrase . "%' or kabupaten_nama like '%" . $pencarian_phrase . "%' or rs_nama like '%" . $pencarian_phrase . "%' or prospek_principle like '%" . $pencarian_phrase . "%' or total_price_prospek like '%" . $pencarian_phrase . "%' or no_faktur like '%" . $pencarian_phrase . "%' or no_ekatalog like '%" . $pencarian_phrase . "%' or funnel_percentage like '%" . $pencarian_phrase . "%' or estimasi_pembelian like '%" . $pencarian_phrase . "%' or funnel like '%" . $pencarian_phrase . "%' or notes_kompetitor like '%" . $pencarian_phrase . "%' or notes_prospek like '%" . $pencarian_phrase . "%' or prospek_status like '%" . $pencarian_phrase . "%')";
      } else {
        $search_query = "and (" . $kolom_pencarian . " like '%" . $pencarian_phrase . "%')";
      }
    }
    $sql = "SELECT id_pk_prospek, prospek_kode, mstr_provinsi.provinsi_nama as nama_provinsi, mstr_kabupaten.kabupaten_nama as nama_kabupaten, mstr_rs.rs_nama as nama_rs, prospek_principle, total_price_prospek, notes_kompetitor, notes_prospek, no_faktur, no_ekatalog, funnel, funnel_percentage, estimasi_pembelian, note_loss, prospek_status, prospek_id_create,user_username
    FROM mstr_prospek
    INNER JOIN mstr_rs on mstr_prospek.id_fk_rs = mstr_rs.id_pk_rs
    INNER JOIN mstr_kabupaten on mstr_kabupaten.id_pk_kabupaten = mstr_rs.id_fk_kabupaten
    INNER JOIN mstr_provinsi on mstr_provinsi.id_pk_provinsi = mstr_kabupaten.id_fk_provinsi
    INNER JOIN mstr_user on mstr_user.id_pk_user = mstr_prospek.prospek_id_create
    WHERE prospek_id_create= ? AND prospek_status='aktif' " . $search_query . " order by " . $kolom_pengurutan . " " . $arah_kolom_pengurutan . " limit 20 offset " . (20 * ($current_page - 1));
    $args = array(
      $id_user
    );
    return executeQuery($sql, $args);
  }

  public function get_prospek_supervisee($kolom_pengurutan, $arah_kolom_pengurutan, $pencarian_phrase, $kolom_pencarian, $current_page)
  {
    $search_query = "";
    if ($pencarian_phrase != "") {
      if ($kolom_pencarian == "all") {
        $search_query = "and (provinsi_nama like '%" . $pencarian_phrase . "%' or kabupaten_nama like '%" . $pencarian_phrase . "%' or rs_nama like '%" . $pencarian_phrase . "%' or prospek_principle like '%" . $pencarian_phrase . "%' or total_price_prospek like '%" . $pencarian_phrase . "%' or no_faktur like '%" . $pencarian_phrase . "%' or no_ekatalog like '%" . $pencarian_phrase . "%' or funnel_percentage like '%" . $pencarian_phrase . "%' or estimasi_pembelian like '%" . $pencarian_phrase . "%' or funnel like '%" . $pencarian_phrase . "%' or notes_kompetitor like '%" . $pencarian_phrase . "%' or notes_prospek like '%" . $pencarian_phrase . "%' or prospek_status like '%" . $pencarian_phrase . "%')";
      } else {
        $search_query = "and (" . $kolom_pencarian . " like '%" . $pencarian_phrase . "%')";
      }
    }
    $sql = "SELECT id_pk_prospek, prospek_kode, mstr_provinsi.provinsi_nama as nama_provinsi, mstr_kabupaten.kabupaten_nama as nama_kabupaten, mstr_rs.rs_nama as nama_rs, prospek_principle, total_price_prospek, notes_kompetitor, notes_prospek, no_faktur, no_ekatalog, funnel, funnel_percentage, estimasi_pembelian, note_loss, prospek_status, prospek_id_create, user_username
    FROM mstr_prospek
    INNER JOIN mstr_rs on mstr_prospek.id_fk_rs = mstr_rs.id_pk_rs
    INNER JOIN mstr_kabupaten on mstr_kabupaten.id_pk_kabupaten = mstr_rs.id_fk_kabupaten
    INNER JOIN mstr_provinsi on mstr_provinsi.id_pk_provinsi = mstr_kabupaten.id_fk_provinsi
    INNER JOIN mstr_user on mstr_user.id_pk_user = mstr_prospek.prospek_id_create
    WHERE user_supervisor = ? AND prospek_status='aktif' " . $search_query; #user_supervisor dan yg prospeknya aktif. Untuk yg usernay ga aktif ttp aja gapapa, bisa aja orangnya keluar
    $args = array(
      $this->session->id_user #yang login pasti user yg bisa ada supervisee (gamungkin ke akses)
    );
    return executeQuery($sql, $args);
  }
  public function search_supervisee($kolom_pengurutan, $arah_kolom_pengurutan, $pencarian_phrase, $kolom_pencarian, $current_page)
  {
    $search_query = "";
    if ($pencarian_phrase != "") {
      if ($kolom_pencarian == "all") {
        $search_query = "and (provinsi_nama like '%" . $pencarian_phrase . "%' or kabupaten_nama like '%" . $pencarian_phrase . "%' or rs_nama like '%" . $pencarian_phrase . "%' or prospek_principle like '%" . $pencarian_phrase . "%' or total_price_prospek like '%" . $pencarian_phrase . "%' or no_faktur like '%" . $pencarian_phrase . "%' or no_ekatalog like '%" . $pencarian_phrase . "%' or funnel_percentage like '%" . $pencarian_phrase . "%' or estimasi_pembelian like '%" . $pencarian_phrase . "%' or funnel like '%" . $pencarian_phrase . "%' or notes_kompetitor like '%" . $pencarian_phrase . "%' or notes_prospek like '%" . $pencarian_phrase . "%' or prospek_status like '%" . $pencarian_phrase . "%')";
      } else {
        $search_query = "and (" . $kolom_pencarian . " like '%" . $pencarian_phrase . "%')";
      }
    }
    $sql = "SELECT id_pk_prospek, prospek_kode, mstr_provinsi.provinsi_nama as nama_provinsi, mstr_kabupaten.kabupaten_nama as nama_kabupaten, mstr_rs.rs_nama as nama_rs, prospek_principle, total_price_prospek, notes_kompetitor, notes_prospek, no_faktur, no_ekatalog, funnel, funnel_percentage, estimasi_pembelian, note_loss, prospek_status, prospek_id_create, user_username
    FROM mstr_prospek
    INNER JOIN mstr_rs on mstr_prospek.id_fk_rs = mstr_rs.id_pk_rs
    INNER JOIN mstr_kabupaten on mstr_kabupaten.id_pk_kabupaten = mstr_rs.id_fk_kabupaten
    INNER JOIN mstr_provinsi on mstr_provinsi.id_pk_provinsi = mstr_kabupaten.id_fk_provinsi
    INNER JOIN mstr_user on mstr_user.id_pk_user = mstr_prospek.prospek_id_create
    WHERE user_supervisor = ? AND prospek_status='aktif' " . $search_query . " order by " . $kolom_pengurutan . " " . $arah_kolom_pengurutan . " limit 20 offset " . (20 * ($current_page - 1));
    $args = array(
      $this->session->id_user #yang login pasti user yg bisa ada supervisee (gamungkin ke akses)
    );
    return executeQuery($sql, $args);
  }
  public function get_prospek_detail($id_pk_prospek, $id_user)
  {
    $sql = "SELECT id_pk_prospek, prospek_kode, prospek_kode, mstr_provinsi.provinsi_nama as nama_provinsi, mstr_kabupaten.kabupaten_nama as nama_kabupaten, mstr_rs.rs_nama as nama_rs, prospek_principle, total_price_prospek, notes_kompetitor, notes_prospek, no_faktur, no_ekatalog, funnel, funnel_percentage, estimasi_pembelian, note_loss, prospek_status, sumber_dana, jenis_pengadaan, rating, prospek_id_create
    FROM mstr_prospek
    INNER JOIN mstr_rs on mstr_prospek.id_fk_rs = mstr_rs.id_pk_rs
    INNER JOIN mstr_kabupaten on mstr_kabupaten.id_pk_kabupaten = mstr_rs.id_fk_kabupaten
    INNER JOIN mstr_provinsi on mstr_provinsi.id_pk_provinsi = mstr_kabupaten.id_fk_provinsi
    WHERE id_pk_prospek = $id_pk_prospek AND prospek_status='aktif'";
    return executeQuery($sql);
  }

  public function get_detail_rs($id_pk_rs)
  {
    $sql = "SELECT id_pk_rs, rs_kode, rs_nama, rs_kelas, rs_direktur, rs_alamat, rs_kategori, rs_kode_pos, rs_telepon, rs_fax, mstr_kabupaten.kabupaten_nama as nama_kabupaten, mstr_jenis_rs.jenis_rs_nama as jenis_rs, mstr_penyelenggara.penyelenggara_nama as penyelenggara
       FROM mstr_rs
       INNER JOIN mstr_kabupaten on mstr_kabupaten.id_pk_kabupaten = mstr_rs.id_fk_kabupaten
       INNER JOIN mstr_jenis_rs on mstr_jenis_rs.id_pk_jenis_rs = mstr_rs.id_fk_jenis_rs
       INNER JOIN mstr_penyelenggara on mstr_penyelenggara.id_pk_penyelenggara = mstr_rs.id_fk_penyelenggara
       WHERE id_pk_rs = $id_pk_rs AND rs_status='aktif'";
    return executeQuery($sql);
  }

  public function get_detail_ekat($id_pk_ekatalog)
  {
    $sql = "SELECT *
       FROM mstr_ekatalog
       WHERE ekatalog_id_paket = '$id_pk_ekatalog' AND ekatalog_status='aktif'";
    return executeQuery($sql);
  }

  public function get_detail_sirup($id_pk_sirup)
  {
    $sql = "SELECT *
       FROM mstr_sirup
       WHERE sirup_rup = '$id_pk_sirup' AND sirup_status='aktif'";
    return executeQuery($sql);
  }

  public function get_prospek_all($kolom_pengurutan, $arah_kolom_pengurutan, $pencarian_phrase, $kolom_pencarian, $current_page)
  {
    $search_query = "";
    if ($pencarian_phrase != "") {
      if ($kolom_pencarian == "all") {
        $search_query = "and (provinsi_nama like '%" . $pencarian_phrase . "%' or kabupaten_nama like '%" . $pencarian_phrase . "%' or rs_nama like '%" . $pencarian_phrase . "%' or prospek_principle like '%" . $pencarian_phrase . "%' or total_price_prospek like '%" . $pencarian_phrase . "%' or no_faktur like '%" . $pencarian_phrase . "%' or no_ekatalog like '%" . $pencarian_phrase . "%' or funnel_percentage like '%" . $pencarian_phrase . "%' or estimasi_pembelian like '%" . $pencarian_phrase . "%' or funnel like '%" . $pencarian_phrase . "%' or notes_kompetitor like '%" . $pencarian_phrase . "%' or notes_prospek like '%" . $pencarian_phrase . "%' or prospek_status like '%" . $pencarian_phrase . "%')";
      } else {
        $search_query = "and (" . $kolom_pencarian . " like '%" . $pencarian_phrase . "%')";
      }
    }
    $sql = "SELECT id_pk_prospek, prospek_kode, mstr_provinsi.provinsi_nama as nama_provinsi, mstr_kabupaten.kabupaten_nama as nama_kabupaten, mstr_rs.rs_nama as nama_rs, prospek_principle, total_price_prospek, notes_kompetitor, notes_prospek, no_faktur, no_ekatalog, funnel_percentage, estimasi_pembelian, note_loss, prospek_status, prospek_id_create, mstr_rs.rs_kategori, funnel,user_username,
      IF((funnel = 'Prospek') AND mstr_rs.rs_kategori = 'Pemerintah', 1,0) as flag_sirup, IF(funnel = 'Win' AND mstr_rs.rs_kategori = 'Pemerintah', 1,0) as flag_ekatalog
      FROM mstr_prospek
      INNER JOIN mstr_rs on mstr_prospek.id_fk_rs = mstr_rs.id_pk_rs
      INNER JOIN mstr_kabupaten on mstr_kabupaten.id_pk_kabupaten = mstr_rs.id_fk_kabupaten
      INNER JOIN mstr_provinsi on mstr_provinsi.id_pk_provinsi = mstr_kabupaten.id_fk_provinsi
      INNER JOIN mstr_user on mstr_user.id_pk_user = mstr_prospek.prospek_id_create
      WHERE prospek_status='aktif' " . $search_query;
    return executeQuery($sql);
  }
  public function get_prospek_all_ekat($kolom_pengurutan, $arah_kolom_pengurutan, $pencarian_phrase, $kolom_pencarian, $current_page)
  {
    $search_query = "";
    if ($pencarian_phrase != "") {
      if ($kolom_pencarian == "all") {
        $search_query = "and (provinsi_nama like '%" . $pencarian_phrase . "%' or kabupaten_nama like '%" . $pencarian_phrase . "%' or rs_nama like '%" . $pencarian_phrase . "%' or prospek_principle like '%" . $pencarian_phrase . "%' or total_price_prospek like '%" . $pencarian_phrase . "%' or no_faktur like '%" . $pencarian_phrase . "%' or no_ekatalog like '%" . $pencarian_phrase . "%' or funnel_percentage like '%" . $pencarian_phrase . "%' or estimasi_pembelian like '%" . $pencarian_phrase . "%' or funnel like '%" . $pencarian_phrase . "%' or notes_kompetitor like '%" . $pencarian_phrase . "%' or notes_prospek like '%" . $pencarian_phrase . "%' or prospek_status like '%" . $pencarian_phrase . "%')";
      } else {
        $search_query = "and (" . $kolom_pencarian . " like '%" . $pencarian_phrase . "%')";
      }
    }
    $sql = "SELECT id_pk_prospek, prospek_kode, mstr_provinsi.provinsi_nama as nama_provinsi, mstr_kabupaten.kabupaten_nama as nama_kabupaten, mstr_rs.rs_nama as nama_rs, prospek_principle, total_price_prospek, notes_kompetitor, notes_prospek, no_faktur, no_ekatalog, funnel_percentage, estimasi_pembelian, note_loss, prospek_status, prospek_id_create, mstr_rs.rs_kategori, funnel,user_username,
       IF((funnel = 'Prospek') AND mstr_rs.rs_kategori = 'Pemerintah', 1,0) as flag_sirup, IF(funnel = 'Win' AND mstr_rs.rs_kategori = 'Pemerintah', 1,0) as flag_ekatalog
       FROM mstr_prospek
       INNER JOIN mstr_rs on mstr_prospek.id_fk_rs = mstr_rs.id_pk_rs
    INNER JOIN mstr_kabupaten on mstr_kabupaten.id_pk_kabupaten = mstr_rs.id_fk_kabupaten
    INNER JOIN mstr_provinsi on mstr_provinsi.id_pk_provinsi = mstr_kabupaten.id_fk_provinsi
       INNER JOIN mstr_user on mstr_user.id_pk_user = mstr_prospek.prospek_id_create
       WHERE rs_kategori='Pemerintah' and (no_ekatalog is not null and no_ekatalog != '') and prospek_status='aktif' " . $search_query;
    return executeQuery($sql);
  }
  public function get_prospek_all_belum_ekat($kolom_pengurutan, $arah_kolom_pengurutan, $pencarian_phrase, $kolom_pencarian, $current_page)
  {
    $search_query = "";
    if ($pencarian_phrase != "") {
      if ($kolom_pencarian == "all") {
        $search_query = "and (provinsi_nama like '%" . $pencarian_phrase . "%' or kabupaten_nama like '%" . $pencarian_phrase . "%' or rs_nama like '%" . $pencarian_phrase . "%' or prospek_principle like '%" . $pencarian_phrase . "%' or total_price_prospek like '%" . $pencarian_phrase . "%' or no_faktur like '%" . $pencarian_phrase . "%' or no_ekatalog like '%" . $pencarian_phrase . "%' or funnel_percentage like '%" . $pencarian_phrase . "%' or estimasi_pembelian like '%" . $pencarian_phrase . "%' or funnel like '%" . $pencarian_phrase . "%' or notes_kompetitor like '%" . $pencarian_phrase . "%' or notes_prospek like '%" . $pencarian_phrase . "%' or prospek_status like '%" . $pencarian_phrase . "%')";
      } else {
        $search_query = "and (" . $kolom_pencarian . " like '%" . $pencarian_phrase . "%')";
      }
    }
    $sql = "SELECT id_pk_prospek, prospek_kode, mstr_provinsi.provinsi_nama as nama_provinsi, mstr_kabupaten.kabupaten_nama as nama_kabupaten, mstr_rs.rs_nama as nama_rs, prospek_principle, total_price_prospek, notes_kompetitor, notes_prospek, no_faktur, no_ekatalog, funnel_percentage, estimasi_pembelian, note_loss, prospek_status, prospek_id_create, mstr_rs.rs_kategori, funnel,user_username,
       IF((funnel = 'Prospek') AND mstr_rs.rs_kategori = 'Pemerintah', 1,0) as flag_sirup, IF(funnel = 'Win' AND mstr_rs.rs_kategori = 'Pemerintah', 1,0) as flag_ekatalog
       FROM mstr_prospek
       INNER JOIN mstr_rs on mstr_prospek.id_fk_rs = mstr_rs.id_pk_rs
    INNER JOIN mstr_kabupaten on mstr_kabupaten.id_pk_kabupaten = mstr_rs.id_fk_kabupaten
    INNER JOIN mstr_provinsi on mstr_provinsi.id_pk_provinsi = mstr_kabupaten.id_fk_provinsi
       INNER JOIN mstr_user on mstr_user.id_pk_user = mstr_prospek.prospek_id_create
       WHERE rs_kategori='Pemerintah' and (no_ekatalog is null or no_ekatalog = '') and prospek_status='aktif' " . $search_query;
    return executeQuery($sql);
  }
  public function get_prospek_all_sirup($kolom_pengurutan, $arah_kolom_pengurutan, $pencarian_phrase, $kolom_pencarian, $current_page)
  {
    $search_query = "";
    if ($pencarian_phrase != "") {
      if ($kolom_pencarian == "all") {
        $search_query = "and (provinsi_nama like '%" . $pencarian_phrase . "%' or kabupaten_nama like '%" . $pencarian_phrase . "%' or rs_nama like '%" . $pencarian_phrase . "%' or prospek_principle like '%" . $pencarian_phrase . "%' or total_price_prospek like '%" . $pencarian_phrase . "%' or no_faktur like '%" . $pencarian_phrase . "%' or no_ekatalog like '%" . $pencarian_phrase . "%' or funnel_percentage like '%" . $pencarian_phrase . "%' or estimasi_pembelian like '%" . $pencarian_phrase . "%' or funnel like '%" . $pencarian_phrase . "%' or notes_kompetitor like '%" . $pencarian_phrase . "%' or notes_prospek like '%" . $pencarian_phrase . "%' or prospek_status like '%" . $pencarian_phrase . "%')";
      } else {
        $search_query = "and (" . $kolom_pencarian . " like '%" . $pencarian_phrase . "%')";
      }
    }
    $sql = "SELECT id_pk_prospek, prospek_kode, mstr_provinsi.provinsi_nama as nama_provinsi, mstr_kabupaten.kabupaten_nama as nama_kabupaten, mstr_rs.rs_nama as nama_rs, prospek_principle, total_price_prospek, notes_kompetitor, notes_prospek, no_faktur, no_ekatalog, funnel_percentage, estimasi_pembelian, note_loss, prospek_status, prospek_id_create, mstr_rs.rs_kategori, funnel,user_username,
       IF((funnel = 'Prospek') AND mstr_rs.rs_kategori = 'Pemerintah', 1,0) as flag_sirup, IF(funnel = 'Win' AND mstr_rs.rs_kategori = 'Pemerintah', 1,0) as flag_ekatalog
       FROM mstr_prospek
       INNER JOIN mstr_rs on mstr_prospek.id_fk_rs = mstr_rs.id_pk_rs
    INNER JOIN mstr_kabupaten on mstr_kabupaten.id_pk_kabupaten = mstr_rs.id_fk_kabupaten
    INNER JOIN mstr_provinsi on mstr_provinsi.id_pk_provinsi = mstr_kabupaten.id_fk_provinsi
       INNER JOIN mstr_user on mstr_user.id_pk_user = mstr_prospek.prospek_id_create
       WHERE rs_kategori='Pemerintah' and (no_faktur is not null and no_faktur != '') and prospek_status='aktif' " . $search_query;
    return executeQuery($sql);
  }
  public function get_prospek_all_belum_sirup($kolom_pengurutan, $arah_kolom_pengurutan, $pencarian_phrase, $kolom_pencarian, $current_page)
  {
    $search_query = "";
    if ($pencarian_phrase != "") {
      if ($kolom_pencarian == "all") {
        $search_query = "and (provinsi_nama like '%" . $pencarian_phrase . "%' or kabupaten_nama like '%" . $pencarian_phrase . "%' or rs_nama like '%" . $pencarian_phrase . "%' or prospek_principle like '%" . $pencarian_phrase . "%' or total_price_prospek like '%" . $pencarian_phrase . "%' or no_faktur like '%" . $pencarian_phrase . "%' or no_ekatalog like '%" . $pencarian_phrase . "%' or funnel_percentage like '%" . $pencarian_phrase . "%' or estimasi_pembelian like '%" . $pencarian_phrase . "%' or funnel like '%" . $pencarian_phrase . "%' or notes_kompetitor like '%" . $pencarian_phrase . "%' or notes_prospek like '%" . $pencarian_phrase . "%' or prospek_status like '%" . $pencarian_phrase . "%')";
      } else {
        $search_query = "and (" . $kolom_pencarian . " like '%" . $pencarian_phrase . "%')";
      }
    }
    $sql = "SELECT id_pk_prospek, prospek_kode, mstr_provinsi.provinsi_nama as nama_provinsi, mstr_kabupaten.kabupaten_nama as nama_kabupaten, mstr_rs.rs_nama as nama_rs, prospek_principle, total_price_prospek, notes_kompetitor, notes_prospek, no_faktur, no_ekatalog, funnel_percentage, estimasi_pembelian, note_loss, prospek_status, prospek_id_create, mstr_rs.rs_kategori, funnel,user_username,
       IF((funnel = 'Prospek') AND mstr_rs.rs_kategori = 'Pemerintah', 1,0) as flag_sirup, IF(funnel = 'Win' AND mstr_rs.rs_kategori = 'Pemerintah', 1,0) as flag_ekatalog
       FROM mstr_prospek
       INNER JOIN mstr_rs on mstr_prospek.id_fk_rs = mstr_rs.id_pk_rs
    INNER JOIN mstr_kabupaten on mstr_kabupaten.id_pk_kabupaten = mstr_rs.id_fk_kabupaten
    INNER JOIN mstr_provinsi on mstr_provinsi.id_pk_provinsi = mstr_kabupaten.id_fk_provinsi
       INNER JOIN mstr_user on mstr_user.id_pk_user = mstr_prospek.prospek_id_create
       WHERE rs_kategori='Pemerintah' and (no_faktur is null or no_faktur = '') and prospek_status='aktif' " . $search_query;
    return executeQuery($sql);
  }

  public function search($kolom_pengurutan, $arah_kolom_pengurutan, $pencarian_phrase, $kolom_pencarian, $current_page)
  {
    $search_query = "";
    if ($pencarian_phrase != "") {
      if ($kolom_pencarian == "all") {
        $search_query = "and (prospek_kode like '%" . $pencarian_phrase . "%' or provinsi_nama like '%" . $pencarian_phrase . "%' or kabupaten_nama like '%" . $pencarian_phrase . "%' or rs_nama like '%" . $pencarian_phrase . "%' or prospek_principle like '%" . $pencarian_phrase . "%' or total_price_prospek like '%" . $pencarian_phrase . "%' or no_faktur like '%" . $pencarian_phrase . "%' or no_ekatalog like '%" . $pencarian_phrase . "%' or funnel_percentage like '%" . $pencarian_phrase . "%' or estimasi_pembelian like '%" . $pencarian_phrase . "%' or funnel like '%" . $pencarian_phrase . "%' or notes_kompetitor like '%" . $pencarian_phrase . "%' or notes_prospek like '%" . $pencarian_phrase . "%' or prospek_status like '%" . $pencarian_phrase . "%')";
      } else {
        $search_query = "and (" . $kolom_pencarian . " like '%" . $pencarian_phrase . "%')";
      }
    }
    $sql = "SELECT prospek_kode, id_pk_prospek, mstr_provinsi.provinsi_nama as nama_provinsi, mstr_kabupaten.kabupaten_nama as nama_kabupaten, mstr_rs.rs_nama as nama_rs, prospek_principle, total_price_prospek, notes_kompetitor, notes_prospek, no_faktur, no_ekatalog, funnel_percentage, estimasi_pembelian, note_loss, prospek_status, prospek_id_create, mstr_rs.rs_kategori, funnel,user_username,
       IF((funnel = 'Prospek') AND mstr_rs.rs_kategori = 'Pemerintah', 1,0) as flag_sirup, IF(funnel = 'Win' AND mstr_rs.rs_kategori = 'Pemerintah', 1,0) as flag_ekatalog
       FROM mstr_prospek
       INNER JOIN mstr_rs on mstr_prospek.id_fk_rs = mstr_rs.id_pk_rs
    INNER JOIN mstr_kabupaten on mstr_kabupaten.id_pk_kabupaten = mstr_rs.id_fk_kabupaten
    INNER JOIN mstr_provinsi on mstr_provinsi.id_pk_provinsi = mstr_kabupaten.id_fk_provinsi
       INNER JOIN mstr_user on mstr_user.id_pk_user = mstr_prospek.prospek_id_create
       WHERE prospek_status='aktif' " . $search_query . " order by " . $kolom_pengurutan . " " . $arah_kolom_pengurutan . " limit 20 offset " . (20 * ($current_page - 1));
    return executeQuery($sql);
  }
  public function search_ekat($kolom_pengurutan, $arah_kolom_pengurutan, $pencarian_phrase, $kolom_pencarian, $current_page)
  {
    $search_query = "";
    if ($pencarian_phrase != "") {
      if ($kolom_pencarian == "all") {
        $search_query = "and (prospek_kode like '%" . $pencarian_phrase . "%' or provinsi_nama like '%" . $pencarian_phrase . "%' or kabupaten_nama like '%" . $pencarian_phrase . "%' or rs_nama like '%" . $pencarian_phrase . "%' or prospek_principle like '%" . $pencarian_phrase . "%' or total_price_prospek like '%" . $pencarian_phrase . "%' or no_faktur like '%" . $pencarian_phrase . "%' or no_ekatalog like '%" . $pencarian_phrase . "%' or funnel_percentage like '%" . $pencarian_phrase . "%' or estimasi_pembelian like '%" . $pencarian_phrase . "%' or funnel like '%" . $pencarian_phrase . "%' or notes_kompetitor like '%" . $pencarian_phrase . "%' or notes_prospek like '%" . $pencarian_phrase . "%' or prospek_status like '%" . $pencarian_phrase . "%')";
      } else {
        $search_query = "and (" . $kolom_pencarian . " like '%" . $pencarian_phrase . "%')";
      }
    }
    $sql = "SELECT prospek_kode, id_pk_prospek, mstr_provinsi.provinsi_nama as nama_provinsi, mstr_kabupaten.kabupaten_nama as nama_kabupaten, mstr_rs.rs_nama as nama_rs, prospek_principle, total_price_prospek, notes_kompetitor, notes_prospek, no_faktur, no_ekatalog, funnel_percentage, estimasi_pembelian, note_loss, prospek_status, prospek_id_create, mstr_rs.rs_kategori, funnel,user_username,
       IF((funnel = 'Prospek') AND mstr_rs.rs_kategori = 'Pemerintah', 1,0) as flag_sirup, IF(funnel = 'Win' AND mstr_rs.rs_kategori = 'Pemerintah', 1,0) as flag_ekatalog
       FROM mstr_prospek
       INNER JOIN mstr_rs on mstr_prospek.id_fk_rs = mstr_rs.id_pk_rs
    INNER JOIN mstr_kabupaten on mstr_kabupaten.id_pk_kabupaten = mstr_rs.id_fk_kabupaten
    INNER JOIN mstr_provinsi on mstr_provinsi.id_pk_provinsi = mstr_kabupaten.id_fk_provinsi
       INNER JOIN mstr_user on mstr_user.id_pk_user = mstr_prospek.prospek_id_create
       WHERE rs_kategori='Pemerintah' and (no_ekatalog is not null and no_ekatalog != '') and prospek_status='aktif' " . $search_query . " order by " . $kolom_pengurutan . " " . $arah_kolom_pengurutan . " limit 20 offset " . (20 * ($current_page - 1));
    return executeQuery($sql);
  }
  public function search_belum_ekat($kolom_pengurutan, $arah_kolom_pengurutan, $pencarian_phrase, $kolom_pencarian, $current_page)
  {
    $search_query = "";
    if ($pencarian_phrase != "") {
      if ($kolom_pencarian == "all") {
        $search_query = "and (prospek_kode like '%" . $pencarian_phrase . "%' or provinsi_nama like '%" . $pencarian_phrase . "%' or kabupaten_nama like '%" . $pencarian_phrase . "%' or rs_nama like '%" . $pencarian_phrase . "%' or prospek_principle like '%" . $pencarian_phrase . "%' or total_price_prospek like '%" . $pencarian_phrase . "%' or no_faktur like '%" . $pencarian_phrase . "%' or no_ekatalog like '%" . $pencarian_phrase . "%' or funnel_percentage like '%" . $pencarian_phrase . "%' or estimasi_pembelian like '%" . $pencarian_phrase . "%' or funnel like '%" . $pencarian_phrase . "%' or notes_kompetitor like '%" . $pencarian_phrase . "%' or notes_prospek like '%" . $pencarian_phrase . "%' or prospek_status like '%" . $pencarian_phrase . "%')";
      } else {
        $search_query = "and (" . $kolom_pencarian . " like '%" . $pencarian_phrase . "%')";
      }
    }
    $sql = "SELECT prospek_kode, id_pk_prospek, mstr_provinsi.provinsi_nama as nama_provinsi, mstr_kabupaten.kabupaten_nama as nama_kabupaten, mstr_rs.rs_nama as nama_rs, prospek_principle, total_price_prospek, notes_kompetitor, notes_prospek, no_faktur, no_ekatalog, funnel_percentage, estimasi_pembelian, note_loss, prospek_status, prospek_id_create, mstr_rs.rs_kategori, funnel,user_username,
       IF((funnel = 'Prospek') AND mstr_rs.rs_kategori = 'Pemerintah', 1,0) as flag_sirup, IF(funnel = 'Win' AND mstr_rs.rs_kategori = 'Pemerintah', 1,0) as flag_ekatalog
       FROM mstr_prospek
       INNER JOIN mstr_rs on mstr_prospek.id_fk_rs = mstr_rs.id_pk_rs
    INNER JOIN mstr_kabupaten on mstr_kabupaten.id_pk_kabupaten = mstr_rs.id_fk_kabupaten
    INNER JOIN mstr_provinsi on mstr_provinsi.id_pk_provinsi = mstr_kabupaten.id_fk_provinsi
       INNER JOIN mstr_user on mstr_user.id_pk_user = mstr_prospek.prospek_id_create
       WHERE rs_kategori='Pemerintah' and (no_ekatalog is null or no_ekatalog = '') and prospek_status='aktif' " . $search_query . " order by " . $kolom_pengurutan . " " . $arah_kolom_pengurutan . " limit 20 offset " . (20 * ($current_page - 1));
    return executeQuery($sql);
  }
  public function search_sirup($kolom_pengurutan, $arah_kolom_pengurutan, $pencarian_phrase, $kolom_pencarian, $current_page)
  {
    $search_query = "";
    if ($pencarian_phrase != "") {
      if ($kolom_pencarian == "all") {
        $search_query = "and (prospek_kode like '%" . $pencarian_phrase . "%' or provinsi_nama like '%" . $pencarian_phrase . "%' or kabupaten_nama like '%" . $pencarian_phrase . "%' or rs_nama like '%" . $pencarian_phrase . "%' or prospek_principle like '%" . $pencarian_phrase . "%' or total_price_prospek like '%" . $pencarian_phrase . "%' or no_faktur like '%" . $pencarian_phrase . "%' or no_ekatalog like '%" . $pencarian_phrase . "%' or funnel_percentage like '%" . $pencarian_phrase . "%' or estimasi_pembelian like '%" . $pencarian_phrase . "%' or funnel like '%" . $pencarian_phrase . "%' or notes_kompetitor like '%" . $pencarian_phrase . "%' or notes_prospek like '%" . $pencarian_phrase . "%' or prospek_status like '%" . $pencarian_phrase . "%')";
      } else {
        $search_query = "and (" . $kolom_pencarian . " like '%" . $pencarian_phrase . "%')";
      }
    }
    $sql = "SELECT id_pk_prospek, prospek_kode, prospek_kode, mstr_provinsi.provinsi_nama as nama_provinsi, mstr_kabupaten.kabupaten_nama as nama_kabupaten, mstr_rs.rs_nama as nama_rs, prospek_principle, total_price_prospek, notes_kompetitor, notes_prospek, no_faktur, no_ekatalog, funnel_percentage, estimasi_pembelian, note_loss, prospek_status, prospek_id_create, mstr_rs.rs_kategori, funnel,user_username,
       IF((funnel = 'Prospek') AND mstr_rs.rs_kategori = 'Pemerintah', 1,0) as flag_sirup, IF(funnel = 'Win' AND mstr_rs.rs_kategori = 'Pemerintah', 1,0) as flag_ekatalog
       FROM mstr_prospek
       INNER JOIN mstr_rs on mstr_prospek.id_fk_rs = mstr_rs.id_pk_rs
    INNER JOIN mstr_kabupaten on mstr_kabupaten.id_pk_kabupaten = mstr_rs.id_fk_kabupaten
    INNER JOIN mstr_provinsi on mstr_provinsi.id_pk_provinsi = mstr_kabupaten.id_fk_provinsi
       INNER JOIN mstr_user on mstr_user.id_pk_user = mstr_prospek.prospek_id_create
       WHERE rs_kategori='Pemerintah' and (no_faktur is not null and no_faktur != '') and prospek_status='aktif' " . $search_query . " order by " . $kolom_pengurutan . " " . $arah_kolom_pengurutan . " limit 20 offset " . (20 * ($current_page - 1));
    return executeQuery($sql);
  }
  public function search_belum_sirup($kolom_pengurutan, $arah_kolom_pengurutan, $pencarian_phrase, $kolom_pencarian, $current_page)
  {
    $search_query = "";
    if ($pencarian_phrase != "") {
      if ($kolom_pencarian == "all") {
        $search_query = "and (prospek_kode like '%" . $pencarian_phrase . "%' or provinsi_nama like '%" . $pencarian_phrase . "%' or kabupaten_nama like '%" . $pencarian_phrase . "%' or rs_nama like '%" . $pencarian_phrase . "%' or prospek_principle like '%" . $pencarian_phrase . "%' or total_price_prospek like '%" . $pencarian_phrase . "%' or no_faktur like '%" . $pencarian_phrase . "%' or no_ekatalog like '%" . $pencarian_phrase . "%' or funnel_percentage like '%" . $pencarian_phrase . "%' or estimasi_pembelian like '%" . $pencarian_phrase . "%' or funnel like '%" . $pencarian_phrase . "%' or notes_kompetitor like '%" . $pencarian_phrase . "%' or notes_prospek like '%" . $pencarian_phrase . "%' or prospek_status like '%" . $pencarian_phrase . "%')";
      } else {
        $search_query = "and (" . $kolom_pencarian . " like '%" . $pencarian_phrase . "%')";
      }
    }
    $sql = "SELECT id_pk_prospek, prospek_kode, prospek_kode, mstr_provinsi.provinsi_nama as nama_provinsi, mstr_kabupaten.kabupaten_nama as nama_kabupaten, mstr_rs.rs_nama as nama_rs, prospek_principle, total_price_prospek, notes_kompetitor, notes_prospek, no_faktur, no_ekatalog, funnel_percentage, estimasi_pembelian, note_loss, prospek_status, prospek_id_create, mstr_rs.rs_kategori, funnel,user_username,
       IF((funnel = 'Prospek') AND mstr_rs.rs_kategori = 'Pemerintah', 1,0) as flag_sirup, IF(funnel = 'Win' AND mstr_rs.rs_kategori = 'Pemerintah', 1,0) as flag_ekatalog
       FROM mstr_prospek
       INNER JOIN mstr_rs on mstr_prospek.id_fk_rs = mstr_rs.id_pk_rs
    INNER JOIN mstr_kabupaten on mstr_kabupaten.id_pk_kabupaten = mstr_rs.id_fk_kabupaten
    INNER JOIN mstr_provinsi on mstr_provinsi.id_pk_provinsi = mstr_kabupaten.id_fk_provinsi
       INNER JOIN mstr_user on mstr_user.id_pk_user = mstr_prospek.prospek_id_create
       WHERE rs_kategori='Pemerintah' and (no_faktur is null or no_faktur = '') and prospek_status='aktif' " . $search_query . " order by " . $kolom_pengurutan . " " . $arah_kolom_pengurutan . " limit 20 offset " . (20 * ($current_page - 1));
    return executeQuery($sql);
  }
  public function get_prospek_produk($id_fk_prospek)
  {
    $sql = "SELECT id_pk_prospek_produk, id_fk_prospek, tbl_prospek_produk.id_fk_produk, mstr_produk.produk_nama as nama_produk, detail_prospek_quantity, detail_prospek_keterangan, detail_prospek_status, prospek_produk_price, prospek_produk_diskon, produk_harga_ekat, produk_price_list
       FROM tbl_prospek_produk
       INNER JOIN mstr_produk on tbl_prospek_produk.id_fk_produk = mstr_produk.id_pk_produk
       WHERE id_fk_prospek = $id_fk_prospek AND detail_prospek_status='aktif'";
    return executeQuery($sql);
  }

  public function get_kabupaten($id_fk_user)
  {
    $sql = "SELECT *
      FROM mstr_kabupaten
      INNER JOIN tbl_user_kabupaten on mstr_kabupaten.id_pk_kabupaten = tbl_user_kabupaten.id_fk_kabupaten
      WHERE tbl_user_kabupaten.id_fk_user = $id_fk_user AND kabupaten_status = 'aktif' AND user_kabupaten_status = 'aktif'";
    return executeQuery($sql);
  }

  public function get_provinsi()
  {
    $sql = "SELECT *
      FROM mstr_provinsi
      WHERE provinsi_status = 'aktif'";
    return executeQuery($sql);
  }

  public function get_kabupaten_adv($id_pk_provinsi)
  {
    $sql = "SELECT *
      FROM mstr_kabupaten
      WHERE id_fk_provinsi = $id_pk_provinsi AND kabupaten_status = 'aktif'";
    return executeQuery($sql);
  }

  public function get_rs_sales_engineer($id)
  {
    $sql = "SELECT id_pk_rs, rs_nama, rs_status
      FROM mstr_rs
      INNER JOIN tbl_user_rs on mstr_rs.id_pk_rs = tbl_user_rs.id_fk_rs
      WHERE tbl_user_rs.id_fk_user = ? AND rs_status = 'aktif' AND tbl_user_rs.user_rs_status = 'aktif'";
    $args = array(
      $id
    );
    $result = executeQuery($sql, $args);
    return $result;
  }

  public function get_produk()
  {
    $sql = "SELECT * FROM mstr_produk WHERE produk_status = 'aktif'";
    return executeQuery($sql);
  }

  public function get_data_price($id_pk_produk)
  {
    $sql = "SELECT id_pk_produk, produk_price_list, produk_harga_ekat FROM mstr_produk WHERE id_pk_produk = $id_pk_produk AND produk_status = 'aktif'";
    return executeQuery($sql);
  }

  public function get_rs($id_kabupaten)
  {
    $sql = "SELECT *
       FROM mstr_rs
       WHERE id_fk_kabupaten = ? AND rs_status = 'aktif'";
    $args = array(
      $id_kabupaten
    );
    return executeQuery($sql, $args);
  }

  public function get_data_rs_kategori($id_pk_rs)
  {
    $sql = "SELECT rs_kategori FROM mstr_rs WHERE id_pk_rs = $id_pk_rs AND rs_status = 'aktif'";
    return executeQuery($sql);
  }

  public function insert_prospek_se($id_fk_rs, $prospek_principle, $total_price_prospek, $notes_kompetitor, $notes_prospek, $estimasi_pembelian, $funnel, $id_user, $sumber_dana, $jenis_pengadaan, $rating, $no_po, $no_faktur)
  {
    $data = array(
      "id_fk_rs" => $id_fk_rs,
      "prospek_principle" => $prospek_principle,
      "total_price_prospek" => $total_price_prospek,
      "notes_kompetitor" => $notes_kompetitor,
      "notes_prospek" => $notes_prospek,
      "estimasi_pembelian" => $estimasi_pembelian,
      "funnel" => $funnel,
      "no_ekatalog" => $no_po,
      "no_faktur" => $no_faktur,
      "prospek_status" => "aktif",
      "prospek_id_create" => $id_user,
      "prospek_tgl_create" => date("Y-m-d H:i:s"),
      "sumber_dana" => $sumber_dana,
      "jenis_pengadaan" => $jenis_pengadaan,
      "rating" => $rating
    );
    return insertRow("mstr_prospek", $data);
  }

  public function insert_prospek_se_prospek($id_fk_rs, $prospek_principle, $total_price_prospek, $notes_kompetitor, $notes_prospek, $estimasi_pembelian, $funnel, $id_user, $funnel_percentage, $sumber_dana, $jenis_pengadaan, $rating, $no_po, $no_faktur)
  {
    $data = array(
      "id_fk_rs" => $id_fk_rs,
      "prospek_principle" => $prospek_principle,
      "total_price_prospek" => $total_price_prospek,
      "notes_kompetitor" => $notes_kompetitor,
      "notes_prospek" => $notes_prospek,
      "estimasi_pembelian" => $estimasi_pembelian,
      "funnel" => $funnel,
      "funnel_percentage" => $funnel_percentage,
      "no_ekatalog" => $no_po,
      "no_faktur" => $no_faktur,
      "prospek_status" => "aktif",
      "prospek_id_create" => $id_user,
      "prospek_tgl_create" => date("Y-m-d H:i:s"),
      "sumber_dana" => $sumber_dana,
      "jenis_pengadaan" => $jenis_pengadaan,
      "rating" => $rating
    );
    return insertRow("mstr_prospek", $data);
  }

  public function insert_prospek_se_loss($id_fk_rs, $prospek_principle, $total_price_prospek, $notes_kompetitor, $notes_prospek, $estimasi_pembelian, $funnel, $id_user, $note_loss, $sumber_dana, $jenis_pengadaan, $rating, $no_po, $no_faktur)
  {
    $data = array(
      "id_fk_rs" => $id_fk_rs,
      "prospek_principle" => $prospek_principle,
      "total_price_prospek" => $total_price_prospek,
      "notes_kompetitor" => $notes_kompetitor,
      "notes_prospek" => $notes_prospek,
      "estimasi_pembelian" => $estimasi_pembelian,
      "funnel" => $funnel,
      "note_loss" => $note_loss,
      "no_ekatalog" => $no_po,
      "no_faktur" => $no_faktur,
      "prospek_status" => "aktif",
      "prospek_id_create" => $id_user,
      "prospek_tgl_create" => date("Y-m-d H:i:s"),
      "sumber_dana" => $sumber_dana,
      "jenis_pengadaan" => $jenis_pengadaan,
      "rating" => $rating
    );
    return insertRow("mstr_prospek", $data);
  }

  public function insert_prospek_asm($id_fk_kabupaten, $id_fk_rs, $prospek_principle, $total_price_prospek, $notes_kompetitor, $notes_prospek, $estimasi_pembelian, $funnel, $id_user, $sumber_dana, $jenis_pengadaan, $rating, $no_po, $no_faktur)
  {
    $data = array(
      "id_fk_kabupaten" => $id_fk_kabupaten,
      "id_fk_rs" => $id_fk_rs,
      "prospek_principle" => $prospek_principle,
      "total_price_prospek" => $total_price_prospek,
      "notes_kompetitor" => $notes_kompetitor,
      "notes_prospek" => $notes_prospek,
      "estimasi_pembelian" => $estimasi_pembelian,
      "funnel" => $funnel,
      "no_ekatalog" => $no_po,
      "no_faktur" => $no_faktur,
      "prospek_status" => "aktif",
      "prospek_id_create" => $id_user,
      "prospek_tgl_create" => date("Y-m-d H:i:s"),
      "sumber_dana" => $sumber_dana,
      "jenis_pengadaan" => $jenis_pengadaan,
      "rating" => $rating
    );
    return insertRow("mstr_prospek", $data);
  }

  public function insert_prospek_asm_prospek($id_fk_kabupaten, $id_fk_rs, $prospek_principle, $total_price_prospek, $notes_kompetitor, $notes_prospek, $estimasi_pembelian, $funnel, $id_user, $funnel_percentage, $sumber_dana, $jenis_pengadaan, $rating, $no_po, $no_faktur)
  {
    $data = array(
      "id_fk_kabupaten" => $id_fk_kabupaten,
      "id_fk_rs" => $id_fk_rs,
      "prospek_principle" => $prospek_principle,
      "total_price_prospek" => $total_price_prospek,
      "notes_kompetitor" => $notes_kompetitor,
      "notes_prospek" => $notes_prospek,
      "estimasi_pembelian" => $estimasi_pembelian,
      "funnel" => $funnel,
      "funnel_percentage" => $funnel_percentage,
      "no_ekatalog" => $no_po,
      "no_faktur" => $no_faktur,
      "prospek_status" => "aktif",
      "prospek_id_create" => $id_user,
      "prospek_tgl_create" => date("Y-m-d H:i:s"),
      "sumber_dana" => $sumber_dana,
      "jenis_pengadaan" => $jenis_pengadaan,
      "rating" => $rating
    );
    return insertRow("mstr_prospek", $data);
  }

  public function insert_prospek_asm_loss($id_fk_kabupaten, $id_fk_rs, $prospek_principle, $total_price_prospek, $notes_kompetitor, $notes_prospek, $estimasi_pembelian, $funnel, $id_user, $note_loss, $sumber_dana, $jenis_pengadaan, $rating, $no_po, $no_faktur)
  {
    $data = array(
      "id_fk_kabupaten" => $id_fk_kabupaten,
      "id_fk_rs" => $id_fk_rs,
      "prospek_principle" => $prospek_principle,
      "total_price_prospek" => $total_price_prospek,
      "notes_kompetitor" => $notes_kompetitor,
      "notes_prospek" => $notes_prospek,
      "estimasi_pembelian" => $estimasi_pembelian,
      "funnel" => $funnel,
      "note_loss" => $note_loss,
      "no_ekatalog" => $no_po,
      "no_faktur" => $no_faktur,
      "prospek_status" => "aktif",
      "prospek_id_create" => $id_user,
      "prospek_tgl_create" => date("Y-m-d H:i:s"),
      "sumber_dana" => $sumber_dana,
      "jenis_pengadaan" => $jenis_pengadaan,
      "rating" => $rating
    );
    return insertRow("mstr_prospek", $data);
  }

  public function insert_prospek_asm_sirup($id_fk_kabupaten, $id_fk_rs, $prospek_principle, $total_price_prospek, $notes_kompetitor, $notes_prospek, $estimasi_pembelian, $funnel, $id_user, $no_faktur, $sumber_dana, $jenis_pengadaan, $rating, $no_po)
  {
    $data = array(
      "id_fk_kabupaten" => $id_fk_kabupaten,
      "id_fk_rs" => $id_fk_rs,
      "prospek_principle" => $prospek_principle,
      "total_price_prospek" => $total_price_prospek,
      "notes_kompetitor" => $notes_kompetitor,
      "notes_prospek" => $notes_prospek,
      "estimasi_pembelian" => $estimasi_pembelian,
      "funnel" => $funnel,
      "no_faktur" => $no_faktur,
      "no_ekatalog" => $no_po,
      "prospek_status" => "aktif",
      "prospek_id_create" => $id_user,
      "prospek_tgl_create" => date("Y-m-d H:i:s"),
      "sumber_dana" => $sumber_dana,
      "jenis_pengadaan" => $jenis_pengadaan,
      "rating" => $rating
    );
    return insertRow("mstr_prospek", $data);
  }

  public function insert_prospek_sm($id_fk_provinsi, $id_fk_kabupaten, $id_fk_rs, $prospek_principle, $total_price_prospek, $notes_kompetitor, $notes_prospek, $estimasi_pembelian, $funnel, $id_user, $sumber_dana, $jenis_pengadaan, $rating, $no_po, $no_faktur)
  {
    $data = array(
      "id_fk_provinsi" => $id_fk_provinsi,
      "id_fk_kabupaten" => $id_fk_kabupaten,
      "id_fk_rs" => $id_fk_rs,
      "prospek_principle" => $prospek_principle,
      "total_price_prospek" => $total_price_prospek,
      "notes_kompetitor" => $notes_kompetitor,
      "notes_prospek" => $notes_prospek,
      "funnel" => $funnel,
      "estimasi_pembelian" => $estimasi_pembelian,
      "no_ekatalog" => $no_po,
      "no_faktur" => $no_faktur,
      "prospek_status" => "aktif",
      "prospek_id_create" => $id_user,
      "prospek_tgl_create" => date("Y-m-d H:i:s"),
      "sumber_dana" => $sumber_dana,
      "jenis_pengadaan" => $jenis_pengadaan,
      "rating" => $rating
    );
    return insertRow("mstr_prospek", $data);
  }

  public function insert_prospek_sm_prospek($id_fk_provinsi, $id_fk_kabupaten, $id_fk_rs, $prospek_principle, $total_price_prospek, $notes_kompetitor, $notes_prospek, $estimasi_pembelian, $funnel, $id_user, $funnel_percentage, $sumber_dana, $jenis_pengadaan, $rating, $no_po, $no_faktur)
  {
    $data = array(
      "id_fk_provinsi" => $id_fk_provinsi,
      "id_fk_kabupaten" => $id_fk_kabupaten,
      "id_fk_rs" => $id_fk_rs,
      "prospek_principle" => $prospek_principle,
      "total_price_prospek" => $total_price_prospek,
      "notes_kompetitor" => $notes_kompetitor,
      "notes_prospek" => $notes_prospek,
      "estimasi_pembelian" => $estimasi_pembelian,
      "funnel" => $funnel,
      "funnel_percentage" => $funnel_percentage,
      "no_ekatalog" => $no_po,
      "no_faktur" => $no_faktur,
      "prospek_status" => "aktif",
      "prospek_id_create" => $id_user,
      "prospek_tgl_create" => date("Y-m-d H:i:s"),
      "sumber_dana" => $sumber_dana,
      "jenis_pengadaan" => $jenis_pengadaan,
      "rating" => $rating
    );
    return insertRow("mstr_prospek", $data);
  }

  public function insert_prospek_sm_loss($id_fk_provinsi, $id_fk_kabupaten, $id_fk_rs, $prospek_principle, $total_price_prospek, $notes_kompetitor, $notes_prospek, $estimasi_pembelian, $funnel, $id_user, $note_loss, $sumber_dana, $jenis_pengadaan, $rating, $no_po, $no_faktur)
  {
    $data = array(
      "id_fk_provinsi" => $id_fk_provinsi,
      "id_fk_kabupaten" => $id_fk_kabupaten,
      "id_fk_rs" => $id_fk_rs,
      "prospek_principle" => $prospek_principle,
      "total_price_prospek" => $total_price_prospek,
      "notes_kompetitor" => $notes_kompetitor,
      "notes_prospek" => $notes_prospek,
      "estimasi_pembelian" => $estimasi_pembelian,
      "funnel" => $funnel,
      "note_loss" => $note_loss,
      "no_ekatalog" => $no_po,
      "no_faktur" => $no_faktur,
      "prospek_status" => "aktif",
      "prospek_id_create" => $id_user,
      "prospek_tgl_create" => date("Y-m-d H:i:s"),
      "sumber_dana" => $sumber_dana,
      "jenis_pengadaan" => $jenis_pengadaan,
      "rating" => $rating
    );
    return insertRow("mstr_prospek", $data);
  }

  public function insert_prospek_sm_ekatalog($id_fk_provinsi, $id_fk_kabupaten, $id_fk_rs, $prospek_principle, $total_price_prospek, $notes_kompetitor, $notes_prospek, $estimasi_pembelian, $funnel, $id_user, $no_ekatalog, $sumber_dana, $jenis_pengadaan, $rating, $no_faktur)
  {
    $data = array(
      "id_fk_provinsi" => $id_fk_provinsi,
      "id_fk_kabupaten" => $id_fk_kabupaten,
      "id_fk_rs" => $id_fk_rs,
      "prospek_principle" => $prospek_principle,
      "total_price_prospek" => $total_price_prospek,
      "notes_kompetitor" => $notes_kompetitor,
      "notes_prospek" => $notes_prospek,
      "estimasi_pembelian" => $estimasi_pembelian,
      "funnel" => $funnel,
      "no_ekatalog" => $no_ekatalog,
      "no_faktur" => $no_faktur,
      "prospek_status" => "aktif",
      "prospek_id_create" => $id_user,
      "prospek_tgl_create" => date("Y-m-d H:i:s"),
      "sumber_dana" => $sumber_dana,
      "jenis_pengadaan" => $jenis_pengadaan,
      "rating" => $rating
    );
    return insertRow("mstr_prospek", $data);
  }

  public function insert_produk_prospek($id_fk_prospek, $id_fk_produk, $prospek_produk_price, $detail_prospek_quantity, $detail_prospek_keterangan, $prospek_produk_diskon)
  {

    $data = array(
      "id_fk_prospek" => $id_fk_prospek,
      "id_fk_produk" => $id_fk_produk,
      "prospek_produk_price" => $prospek_produk_price,
      "prospek_produk_diskon" => $prospek_produk_diskon,
      "detail_prospek_quantity" => $detail_prospek_quantity,
      "detail_prospek_keterangan" => $detail_prospek_keterangan,
      "detail_prospek_status" => "aktif",
      "prospek_produk_id_create" => $this->session->id_user,
      "prospek_produk_tgl_create" => date("Y-m-d H:i:s")
    );
    $this->db->insert("tbl_prospek_produk", $data);
  }

  public function insert_total_price($id_pk_prospek, $total)
  {
    $where = array(
      "id_pk_prospek" => $id_pk_prospek
    );

    $data = array(
      "total_price_prospek" => $total
    );
    return updateRow("mstr_prospek", $data, $where);
  }

  //Edit

  public function edit_prospek_se($id_pk_prospek, $id_fk_rs, $prospek_principle, $total_price_prospek, $notes_kompetitor, $notes_prospek, $estimasi_pembelian, $funnel, $id_user, $sumber_dana, $jenis_pengadaan, $rating, $no_po, $no_faktur)
  {
    $where = array(
      "id_pk_prospek" => $id_pk_prospek,
      "prospek_id_create" => $this->session->id_user
    );

    $data = array(
      "id_fk_rs" => $id_fk_rs,
      "prospek_principle" => $prospek_principle,
      "total_price_prospek" => $total_price_prospek,
      "notes_kompetitor" => $notes_kompetitor,
      "notes_prospek" => $notes_prospek,
      "estimasi_pembelian" => $estimasi_pembelian,
      "funnel" => $funnel,
      "no_ekatalog" => $no_po,
      "no_faktur" => $no_faktur,
      "prospek_status" => "aktif",
      "prospek_id_update" => $id_user,
      "prospek_tgl_update" => date("Y-m-d H:i:s"),
      "sumber_dana" => $sumber_dana,
      "jenis_pengadaan" => $jenis_pengadaan,
      "rating" => $rating
    );
    return updateRow("mstr_prospek", $data, $where);
  }

  public function edit_prospek_se_prospek($id_pk_prospek, $id_fk_rs, $prospek_principle, $total_price_prospek, $notes_kompetitor, $notes_prospek, $estimasi_pembelian, $funnel, $id_user, $funnel_percentage, $sumber_dana, $jenis_pengadaan, $rating, $no_po, $no_faktur)
  {
    $where = array(
      "id_pk_prospek" => $id_pk_prospek,
      "prospek_id_create" => $this->session->id_user
    );

    $data = array(
      "id_fk_rs" => $id_fk_rs,
      "prospek_principle" => $prospek_principle,
      "total_price_prospek" => $total_price_prospek,
      "notes_kompetitor" => $notes_kompetitor,
      "notes_prospek" => $notes_prospek,
      "estimasi_pembelian" => $estimasi_pembelian,
      "funnel" => $funnel,
      "funnel_percentage" => $funnel_percentage,
      "no_ekatalog" => $no_po,
      "no_faktur" => $no_faktur,
      "prospek_status" => "aktif",
      "prospek_id_update" => $id_user,
      "prospek_tgl_update" => date("Y-m-d H:i:s"),
      "sumber_dana" => $sumber_dana,
      "jenis_pengadaan" => $jenis_pengadaan,
      "rating" => $rating
    );
    return updateRow("mstr_prospek", $data, $where);
  }

  public function edit_prospek_se_loss($id_pk_prospek, $id_fk_rs, $prospek_principle, $total_price_prospek, $notes_kompetitor, $notes_prospek, $estimasi_pembelian, $funnel, $id_user, $note_loss, $sumber_dana, $jenis_pengadaan, $rating, $no_po, $no_faktur)
  {
    $where = array(
      "id_pk_prospek" => $id_pk_prospek,
      "prospek_id_create" => $this->session->id_user
    );
    $data = array(
      "id_fk_rs" => $id_fk_rs,
      "prospek_principle" => $prospek_principle,
      "total_price_prospek" => $total_price_prospek,
      "notes_kompetitor" => $notes_kompetitor,
      "notes_prospek" => $notes_prospek,
      "estimasi_pembelian" => $estimasi_pembelian,
      "funnel" => $funnel,
      "note_loss" => $note_loss,
      "no_ekatalog" => $no_po,
      "no_faktur" => $no_faktur,
      "prospek_status" => "aktif",
      "prospek_id_update" => $id_user,
      "prospek_tgl_update" => date("Y-m-d H:i:s"),
      "sumber_dana" => $sumber_dana,
      "jenis_pengadaan" => $jenis_pengadaan,
      "rating" => $rating
    );
    return updateRow("mstr_prospek", $data, $where);
  }

  public function edit_prospek_asm($id_pk_prospek, $id_fk_kabupaten, $id_fk_rs, $prospek_principle, $total_price_prospek, $notes_kompetitor, $notes_prospek, $estimasi_pembelian, $funnel, $id_user, $sumber_dana, $jenis_pengadaan, $rating, $no_po, $no_faktur)
  {
    $where = array(
      "id_pk_prospek" => $id_pk_prospek
    );
    $data = array(
      "id_fk_kabupaten" => $id_fk_kabupaten,
      "id_fk_rs" => $id_fk_rs,
      "prospek_principle" => $prospek_principle,
      "total_price_prospek" => $total_price_prospek,
      "notes_kompetitor" => $notes_kompetitor,
      "notes_prospek" => $notes_prospek,
      "estimasi_pembelian" => $estimasi_pembelian,
      "funnel" => $funnel,
      "no_ekatalog" => $no_po,
      "no_faktur" => $no_faktur,
      "prospek_status" => "aktif",
      "prospek_id_update" => $id_user,
      "prospek_tgl_update" => date("Y-m-d H:i:s"),
      "sumber_dana" => $sumber_dana,
      "jenis_pengadaan" => $jenis_pengadaan,
      "rating" => $rating
    );
    return updateRow("mstr_prospek", $data, $where);
  }

  public function edit_prospek_asm_prospek($id_pk_prospek, $id_fk_kabupaten, $id_fk_rs, $prospek_principle, $total_price_prospek, $notes_kompetitor, $notes_prospek, $estimasi_pembelian, $funnel, $id_user, $funnel_percentage, $sumber_dana, $jenis_pengadaan, $rating, $no_po, $no_faktur)
  {
    $where = array(
      "id_pk_prospek" => $id_pk_prospek
    );
    $data = array(
      "id_fk_kabupaten" => $id_fk_kabupaten,
      "id_fk_rs" => $id_fk_rs,
      "prospek_principle" => $prospek_principle,
      "total_price_prospek" => $total_price_prospek,
      "notes_kompetitor" => $notes_kompetitor,
      "notes_prospek" => $notes_prospek,
      "estimasi_pembelian" => $estimasi_pembelian,
      "funnel" => $funnel,
      "funnel_percentage" => $funnel_percentage,
      "no_ekatalog" => $no_po,
      "no_faktur" => $no_faktur,
      "prospek_status" => "aktif",
      "prospek_id_update" => $id_user,
      "prospek_tgl_update" => date("Y-m-d H:i:s"),
      "sumber_dana" => $sumber_dana,
      "jenis_pengadaan" => $jenis_pengadaan,
      "rating" => $rating
    );
    return updateRow("mstr_prospek", $data, $where);
  }

  public function edit_prospek_asm_loss($id_pk_prospek, $id_fk_kabupaten, $id_fk_rs, $prospek_principle, $total_price_prospek, $notes_kompetitor, $notes_prospek, $estimasi_pembelian, $funnel, $id_user, $note_loss, $sumber_dana, $jenis_pengadaan, $rating, $no_po, $no_faktur)
  {
    $where = array(
      "id_pk_prospek" => $id_pk_prospek
    );
    $data = array(
      "id_fk_kabupaten" => $id_fk_kabupaten,
      "id_fk_rs" => $id_fk_rs,
      "prospek_principle" => $prospek_principle,
      "total_price_prospek" => $total_price_prospek,
      "notes_kompetitor" => $notes_kompetitor,
      "notes_prospek" => $notes_prospek,
      "estimasi_pembelian" => $estimasi_pembelian,
      "funnel" => $funnel,
      "note_loss" => $note_loss,
      "no_ekatalog" => $no_po,
      "no_faktur" => $no_faktur,
      "prospek_status" => "aktif",
      "prospek_id_update" => $id_user,
      "prospek_tgl_update" => date("Y-m-d H:i:s"),
      "sumber_dana" => $sumber_dana,
      "jenis_pengadaan" => $jenis_pengadaan,
      "rating" => $rating
    );
    return updateRow("mstr_prospek", $data, $where);
  }

  public function edit_prospek_asm_sirup($id_pk_prospek, $id_fk_kabupaten, $id_fk_rs, $prospek_principle, $total_price_prospek, $notes_kompetitor, $notes_prospek, $estimasi_pembelian, $funnel, $id_user, $no_faktur, $sumber_dana, $jenis_pengadaan, $rating, $no_po)
  {
    $where = array(
      "id_pk_prospek" => $id_pk_prospek
    );

    $data = array(
      "id_fk_kabupaten" => $id_fk_kabupaten,
      "id_fk_rs" => $id_fk_rs,
      "prospek_principle" => $prospek_principle,
      "total_price_prospek" => $total_price_prospek,
      "notes_kompetitor" => $notes_kompetitor,
      "notes_prospek" => $notes_prospek,
      "estimasi_pembelian" => $estimasi_pembelian,
      "funnel" => $funnel,
      "no_faktur" => $no_faktur,
      "no_ekatalog" => $no_po,
      "prospek_status" => "aktif",
      "prospek_id_update" => $id_user,
      "prospek_tgl_update" => date("Y-m-d H:i:s"),
      "sumber_dana" => $sumber_dana,
      "jenis_pengadaan" => $jenis_pengadaan,
      "rating" => $rating
    );
    return updateRow("mstr_prospek", $data, $where);
  }

  public function edit_prospek_sm($id_pk_prospek, $id_fk_provinsi, $id_fk_kabupaten, $id_fk_rs, $prospek_principle, $total_price_prospek, $notes_kompetitor, $notes_prospek, $estimasi_pembelian, $funnel, $id_user, $sumber_dana, $jenis_pengadaan, $rating, $no_po, $no_faktur)
  {
    $where = array(
      "id_pk_prospek" => $id_pk_prospek
    );
    $data = array(
      "id_fk_provinsi" => $id_fk_provinsi,
      "id_fk_kabupaten" => $id_fk_kabupaten,
      "id_fk_rs" => $id_fk_rs,
      "prospek_principle" => $prospek_principle,
      "total_price_prospek" => $total_price_prospek,
      "notes_kompetitor" => $notes_kompetitor,
      "notes_prospek" => $notes_prospek,
      "estimasi_pembelian" => $estimasi_pembelian,
      "funnel" => $funnel,
      "no_ekatalog" => $no_po,
      "no_faktur" => $no_faktur,
      "prospek_status" => "aktif",
      "prospek_id_update" => $id_user,
      "prospek_tgl_update" => date("Y-m-d H:i:s"),
      "sumber_dana" => $sumber_dana,
      "jenis_pengadaan" => $jenis_pengadaan,
      "rating" => $rating
    );
    return updateRow("mstr_prospek", $data, $where);
  }

  public function edit_prospek_sm_prospek($id_pk_prospek, $id_fk_provinsi, $id_fk_kabupaten, $id_fk_rs, $prospek_principle, $total_price_prospek, $notes_kompetitor, $notes_prospek, $estimasi_pembelian, $funnel, $id_user, $funnel_percentage, $sumber_dana, $jenis_pengadaan, $rating, $no_po, $no_faktur)
  {
    $where = array(
      "id_pk_prospek" => $id_pk_prospek
    );
    $data = array(
      "id_fk_provinsi" => $id_fk_provinsi,
      "id_fk_kabupaten" => $id_fk_kabupaten,
      "id_fk_rs" => $id_fk_rs,
      "prospek_principle" => $prospek_principle,
      "total_price_prospek" => $total_price_prospek,
      "notes_kompetitor" => $notes_kompetitor,
      "notes_prospek" => $notes_prospek,
      "estimasi_pembelian" => $estimasi_pembelian,
      "funnel" => $funnel,
      "funnel_percentage" => $funnel_percentage,
      "no_ekatalog" => $no_po,
      "no_faktur" => $no_faktur,
      "prospek_status" => "aktif",
      "prospek_id_update" => $id_user,
      "prospek_tgl_update" => date("Y-m-d H:i:s"),
      "sumber_dana" => $sumber_dana,
      "jenis_pengadaan" => $jenis_pengadaan,
      "rating" => $rating
    );
    return updateRow("mstr_prospek", $data, $where);
  }

  public function edit_prospek_sm_loss($id_pk_prospek, $id_fk_provinsi, $id_fk_kabupaten, $id_fk_rs, $prospek_principle, $total_price_prospek, $notes_kompetitor, $notes_prospek, $estimasi_pembelian, $funnel, $id_user, $note_loss, $sumber_dana, $jenis_pengadaan, $rating, $no_po, $no_faktur)
  {
    $where = array(
      "id_pk_prospek" => $id_pk_prospek
    );
    $data = array(
      "id_fk_provinsi" => $id_fk_provinsi,
      "id_fk_kabupaten" => $id_fk_kabupaten,
      "id_fk_rs" => $id_fk_rs,
      "prospek_principle" => $prospek_principle,
      "total_price_prospek" => $total_price_prospek,
      "notes_kompetitor" => $notes_kompetitor,
      "notes_prospek" => $notes_prospek,
      "estimasi_pembelian" => $estimasi_pembelian,
      "funnel" => $funnel,
      "note_loss" => $note_loss,
      "no_ekatalog" => $no_po,
      "no_faktur" => $no_faktur,
      "prospek_status" => "aktif",
      "prospek_id_update" => $id_user,
      "prospek_tgl_update" => date("Y-m-d H:i:s"),
      "sumber_dana" => $sumber_dana,
      "jenis_pengadaan" => $jenis_pengadaan,
      "rating" => $rating
    );
    return updateRow("mstr_prospek", $data, $where);
  }

  public function edit_prospek_sm_ekatalog($id_pk_prospek, $id_fk_provinsi, $id_fk_kabupaten, $id_fk_rs, $prospek_principle, $total_price_prospek, $notes_kompetitor, $notes_prospek, $estimasi_pembelian, $funnel, $id_user, $no_ekatalog, $sumber_dana, $jenis_pengadaan, $rating, $no_faktur)
  {
    $where = array(
      "id_pk_prospek" => $id_pk_prospek
    );
    $data = array(
      "id_fk_provinsi" => $id_fk_provinsi,
      "id_fk_kabupaten" => $id_fk_kabupaten,
      "id_fk_rs" => $id_fk_rs,
      "prospek_principle" => $prospek_principle,
      "total_price_prospek" => $total_price_prospek,
      "notes_kompetitor" => $notes_kompetitor,
      "notes_prospek" => $notes_prospek,
      "estimasi_pembelian" => $estimasi_pembelian,
      "funnel" => $funnel,
      "no_ekatalog" => $no_ekatalog,
      "no_faktur" => $no_faktur,
      "prospek_status" => "aktif",
      "prospek_id_update" => $id_user,
      "prospek_tgl_update" => date("Y-m-d H:i:s"),
      "sumber_dana" => $sumber_dana,
      "jenis_pengadaan" => $jenis_pengadaan,
      "rating" => $rating
    );
    return updateRow("mstr_prospek", $data, $where);
  }

  public function edit_produk_prospek($id_pk_prospek_produk, $id_fk_produk, $prospek_produk_price, $detail_prospek_quantity, $detail_prospek_keterangan, $prospek_produk_diskon)
  {
    $where = array(
      "id_pk_prospek_produk" => $id_pk_prospek_produk
    );
    $data = array(
      "id_fk_produk" => $id_fk_produk,
      "detail_prospek_quantity" => $detail_prospek_quantity,
      "prospek_produk_price" => $prospek_produk_price,
      "prospek_produk_diskon" => $prospek_produk_diskon,
      "detail_prospek_keterangan" => $detail_prospek_keterangan,
      "detail_prospek_status" => "aktif",
      "prospek_produk_id_update" => $this->session->id_user,
      "prospek_produk_tgl_update" => date("Y-m-d H:i:s")
    );
    return updateRow("tbl_prospek_produk", $data, $where);
  }

  public function edit_get_prospek($id_pk_prospek)
  {
    $sql = "SELECT id_pk_prospek, prospek_kode, prospek_kode, mstr_prospek.id_fk_provinsi, mstr_provinsi.provinsi_nama as nama_provinsi, mstr_prospek.id_fk_kabupaten, mstr_kabupaten.kabupaten_nama as nama_kabupaten, mstr_prospek.id_fk_rs, mstr_rs.rs_nama as nama_rs, prospek_principle, total_price_prospek, notes_kompetitor, notes_prospek, funnel, funnel_percentage, no_faktur, no_ekatalog, note_loss, rating, sumber_dana, jenis_pengadaan, estimasi_pembelian, prospek_status, prospek_id_create
      FROM mstr_prospek
      INNER JOIN mstr_rs on mstr_prospek.id_fk_rs = mstr_rs.id_pk_rs
    INNER JOIN mstr_kabupaten on mstr_kabupaten.id_pk_kabupaten = mstr_rs.id_fk_kabupaten
    INNER JOIN mstr_provinsi on mstr_provinsi.id_pk_provinsi = mstr_kabupaten.id_fk_provinsi
      WHERE prospek_status='aktif' AND mstr_prospek.id_pk_prospek = $id_pk_prospek";
    return executeQuery($sql);
  }

  public function edit_get_id_user($id_pk_prospek)
  {
    $sql = "SELECT prospek_id_create
      FROM mstr_prospek
      WHERE id_pk_prospek = $id_pk_prospek AND prospek_status='aktif'";
    return executeQuery($sql);
  }

  public function edit_sirup($id_pk_prospek, $no_faktur, $no_po)
  {
    $where = array(
      "id_pk_prospek" => $id_pk_prospek
    );
    $data = array(
      "no_faktur" => $no_faktur,
      "no_ekatalog" => $no_po,
      "prospek_id_update" => $this->session->id_user,
      "prospek_tgl_update" => date("Y-m-d H:i:s")
    );
    return updateRow("mstr_prospek", $data, $where);
  }

  public function edit_ekatalog($id_pk_prospek, $no_ekatalog, $no_faktur)
  {
    $where = array(
      "id_pk_prospek" => $id_pk_prospek
    );
    $data = array(
      "no_ekatalog" => $no_ekatalog,
      "no_faktur" => $no_faktur,
      "prospek_id_update" => $this->session->id_user,
      "prospek_tgl_update" => date("Y-m-d H:i:s")
    );
    return updateRow("mstr_prospek", $data, $where);
  }

  public function delete($id_pk_prospek)
  {
    $where = array(
      "id_pk_prospek" => $id_pk_prospek,
      "prospek_id_create" => $this->session->id_user
    );
    $data = array(
      "prospek_status" => "deleted",
      "prospek_id_delete" => $this->session->id_user,
      "prospek_tgl_delete" => date("Y-m-d H:i:s")
    );
    updateRow("mstr_prospek", $data, $where);
  }

  public function delete_prospek_produk($id)
  {
    $where = array(
      "id_pk_prospek_produk" => $id
    );
    $data = array(
      "detail_prospek_status" => "deleted",
      "prospek_produk_id_delete" => $this->session->id_user,
      "prospek_produk_tgl_delete" => date("Y-m-d H:i:s")
    );
    return updateRow("tbl_prospek_produk", $data, $where);
  }

  public function get_sirup()
  {
    $sql = "SELECT * FROM mstr_sirup;";
    return executeQuery($sql);
  }
  public function get_ekat()
  {
    $sql = "SELECT * FROM mstr_ekatalog;";
    return executeQuery($sql);
  }

  public function export_prospek($kolom_pengurutan, $arah_kolom_pengurutan, $pencarian_phrase, $kolom_pencarian)
  {
    $search_query = "";
    if ($pencarian_phrase != "") {
      if ($kolom_pencarian == "all") {
        $search_query = "and (prospek_kode like '%" . $pencarian_phrase . "%' or provinsi_nama like '%" . $pencarian_phrase . "%' or kabupaten_nama like '%" . $pencarian_phrase . "%' or rs_nama like '%" . $pencarian_phrase . "%' or prospek_principle like '%" . $pencarian_phrase . "%' or total_price_prospek like '%" . $pencarian_phrase . "%' or no_faktur like '%" . $pencarian_phrase . "%' or no_ekatalog like '%" . $pencarian_phrase . "%' or funnel_percentage like '%" . $pencarian_phrase . "%' or estimasi_pembelian like '%" . $pencarian_phrase . "%' or funnel like '%" . $pencarian_phrase . "%' or notes_kompetitor like '%" . $pencarian_phrase . "%' or notes_prospek like '%" . $pencarian_phrase . "%' or prospek_status like '%" . $pencarian_phrase . "%')";
      } else {
        $search_query = "and (" . $kolom_pencarian . " like '%" . $pencarian_phrase . "%')";
      }
    }
    $sql = "SELECT prospek_kode, id_pk_prospek, mstr_provinsi.provinsi_nama as nama_provinsi, mstr_kabupaten.kabupaten_nama as nama_kabupaten, mstr_rs.rs_nama as nama_rs, id_fk_jenis_rs as jenis_outlet,  prospek_principle, total_price_prospek, notes_kompetitor, notes_prospek, no_faktur, no_ekatalog, rating, funnel_percentage, estimasi_pembelian, note_loss, prospek_status, prospek_id_create, mstr_rs.rs_kategori as rs_kategori, funnel,user_username,
       IF((funnel = 'Prospek') AND mstr_rs.rs_kategori = 'Pemerintah', 1,0) as flag_sirup, IF(funnel = 'Win' AND mstr_rs.rs_kategori = 'Pemerintah', 1,0) as flag_ekatalog
       FROM mstr_prospek
       INNER JOIN mstr_rs on mstr_prospek.id_fk_rs = mstr_rs.id_pk_rs
       INNER JOIN mstr_kabupaten on mstr_kabupaten.id_pk_kabupaten = mstr_rs.id_fk_kabupaten
       INNER JOIN mstr_provinsi on mstr_provinsi.id_pk_provinsi = mstr_kabupaten.id_fk_provinsi
       INNER JOIN mstr_user on mstr_user.id_pk_user = mstr_prospek.prospek_id_create
       WHERE prospek_status='aktif' " . $search_query . " order by " . $kolom_pengurutan . " " . $arah_kolom_pengurutan;

    return executeQuery($sql);
  }

  public function get_total_prospek_price()
  {
    $sql = "SELECT total_price_prospek 
    FROM mstr_prospek 
    WHERE prospek_status = 'aktif' AND prospek_id_create = ?";
    $args = array(
      $this->session->id_user
    );
    return executeQuery($sql, $args);
  }
  public function get_total_prospek_pemerintah()
  {
    $sql = "SELECT total_price_prospek, id_pk_prospek 
    FROM mstr_prospek 
    LEFT JOIN mstr_rs ON mstr_rs.id_pk_rs = mstr_prospek.id_fk_rs
    WHERE prospek_status = 'aktif' AND prospek_id_create = ? AND rs_kategori = 'Pemerintah'";
    $args = array(
      $this->session->id_user
    );
    return executeQuery($sql, $args);
  }

  public function get_total_prospek_outlet_pemerintah()
  {
    $sql = "SELECT total_price_prospek, id_pk_prospek 
    FROM mstr_prospek 
    LEFT JOIN mstr_rs ON mstr_rs.id_pk_rs = mstr_prospek.id_fk_rs
    WHERE prospek_status = 'aktif' AND rs_kategori = 'Pemerintah'";

    return executeQuery($sql);
  }

  public function get_total_prospek_outlet_swasta()
  {
    $sql = "SELECT total_price_prospek , id_pk_prospek
    FROM mstr_prospek 
    LEFT JOIN mstr_rs ON mstr_rs.id_pk_rs = mstr_prospek.id_fk_rs
    WHERE prospek_status = 'aktif' AND rs_kategori = 'Swasta'";

    return executeQuery($sql);
  }

  public function get_total_prospek_swasta()
  {
    $sql = "SELECT total_price_prospek , id_pk_prospek
    FROM mstr_prospek 
    LEFT JOIN mstr_rs ON mstr_rs.id_pk_rs = mstr_prospek.id_fk_rs
    WHERE prospek_status = 'aktif' AND prospek_id_create = ? AND rs_kategori = 'Swasta'";
    $args = array(
      $this->session->id_user
    );
    return executeQuery($sql, $args);
  }
}
