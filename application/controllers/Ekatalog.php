<?php
class Ekatalog extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    if(!$this->session->id_user){
      $this->session->set_flashdata("status","danger");
      $this->session->set_flashdata("msg","Session expired, silahkan login");
      redirect("welcome");
      exit();
    }
  }
  public function index()
  {
    $data["field"] = array(
      array(
        "field_value" => "ekatalog_id_paket",
        "field_text" => "ID Paket"
      ),
      array(
        "field_value" => "ekatalog_nama_paket",
        "field_text" => "Paket"
      ),
      array(
        "field_value" => "ekatalog_satuan_kerja",
        "field_text" => "Satuan Kerja"
      ),
      array(
        "field_value" => "ekatalog_total_produk",
        "field_text" => "Total Produk"
      ),
      array(
        "field_value" => "ekatalog_instansi",
        "field_text" => "Instansi"
      ),
      array(
        "field_value" => "ekatalog_posisi_paket",
        "field_text" => "Posisi Paket"
      ),
      array(
        "field_value" => "ekatalog_status_paket",
        "field_text" => "Status Paket"
      ),
      array(
        "field_value" => "ekatalog_total_harga",
        "field_text" => "Total Harga"
      ),
      array(
        "field_value" => "ekatalog_tgl_buat_online",
        "field_text" => "Tanggal Buat"
      ),
      array(
        "field_value" => "ekatalog_tgl_ubah_online",
        "field_text" => "Tanggal Ubah"
      ),
    );
    $this->load->view("ekatalog/index", $data);
  }
  public function semua()
  {
    $data["field"] = array(
      array(
        "field_value" => "ekatalog_id_paket",
        "field_text" => "ID Paket"
      ),
      array(
        "field_value" => "ekatalog_nama_paket",
        "field_text" => "Paket"
      ),
      array(
        "field_value" => "ekatalog_satuan_kerja",
        "field_text" => "Satuan Kerja"
      ),
      array(
        "field_value" => "ekatalog_total_produk",
        "field_text" => "Total Produk"
      ),
      array(
        "field_value" => "ekatalog_instansi",
        "field_text" => "Instansi"
      ),
      array(
        "field_value" => "ekatalog_posisi_paket",
        "field_text" => "Posisi Paket"
      ),
      array(
        "field_value" => "ekatalog_status_paket",
        "field_text" => "Status Paket"
      ),
      array(
        "field_value" => "ekatalog_total_harga",
        "field_text" => "Total Harga"
      ),
      array(
        "field_value" => "ekatalog_tgl_buat_online",
        "field_text" => "Tanggal Buat"
      ),
      array(
        "field_value" => "ekatalog_tgl_ubah_online",
        "field_text" => "Tanggal Ubah"
      ),
    );
    $this->load->view("ekatalog/ekatalog-semua", $data);
  }
  public function buatan()
  {
    $data["field"] = array(
      array(
        "field_value" => "ekatalog_id_paket",
        "field_text" => "ID Paket"
      ),
      array(
        "field_value" => "ekatalog_nama_paket",
        "field_text" => "Paket"
      ),
      array(
        "field_value" => "ekatalog_satuan_kerja",
        "field_text" => "Satuan Kerja"
      ),
      array(
        "field_value" => "ekatalog_total_produk",
        "field_text" => "Total Produk"
      ),
      array(
        "field_value" => "ekatalog_instansi",
        "field_text" => "Instansi"
      ),
      array(
        "field_value" => "ekatalog_posisi_paket",
        "field_text" => "Posisi Paket"
      ),
      array(
        "field_value" => "ekatalog_status_paket",
        "field_text" => "Status Paket"
      ),
      array(
        "field_value" => "ekatalog_total_harga",
        "field_text" => "Total Harga"
      ),
      array(
        "field_value" => "ekatalog_tgl_buat_online",
        "field_text" => "Tanggal Buat"
      ),
      array(
        "field_value" => "ekatalog_tgl_ubah_online",
        "field_text" => "Tanggal Ubah"
      ),
    );
    $this->load->view("ekatalog/ekatalog-buatan", $data);
  }
  public function export()
  {
    $this->load->model("m_sirup");
    $sql = "select * from mstr_ekatalog
    inner join tbl_ekatalog_produk on mstr_ekatalog.id_pk_ekatalog = tbl_ekatalog_produk.id_fk_ekatalog";
    $result = executeQuery($sql);
    $data["data"] = $result->result_array();
    
    $this->load->view('ekatalog/ekatalog_export', $data);
  }
}
