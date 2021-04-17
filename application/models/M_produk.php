<?php
date_default_timezone_set("Asia/Jakarta");
class M_produk extends CI_Model{

     private $id_pk_produk;
     private $produk_no_katalog;
     private $produk_principal;
     private $produk_no_sap;
     private $produk_nama;
     private $produk_kategori;
     private $produk_price_list;
     private $produk_harga_ekat;
     private $produk_deskripsi;
     private $produk_foto;
     private $produk_status;
     private $tgl_create_produk;
     private $tgl_edit_produk;
     private $tgl_delete_produk;
     private $id_create_produk;
     private $id_edit_produk;
     private $id_delete_produk;

     public function get_produk(){
         $sql = "SELECT id_pk_produk, produk_no_katalog, produk_principal, produk_no_sap, produk_nama, produk_kategori, produk_price_list, produk_harga_ekat, produk_deskripsi FROM mstr_produk WHERE produk_status = 'aktif'";
         $result = $this->db->query($sql);
         return $result;
     }

     public function insert_produk($produk_no_katalog, $produk_principal, $produk_no_sap, $produk_nama, $produk_kategori, $produk_price_list, $produk_harga_ekat, $produk_deskripsi, $produk_status) {
 			$data = array(
        "produk_no_katalog"=>$produk_no_katalog,
        "produk_principal"=>$produk_principal,
        "produk_no_sap"=>$produk_no_sap,
        "produk_nama"=>$produk_nama,
        "produk_kategori"=>$produk_kategori,
        "produk_price_list"=>$produk_price_list,
        "produk_harga_ekat"=>$produk_harga_ekat,
        "produk_deskripsi"=>$produk_deskripsi,
        "produk_status"=>"aktif"
 			);
 			$this->db->insert("mstr_produk",$data);
 		}

    public function delete_produk($id_pk_produk) {
      $sql = "UPDATE mstr_produk SET produk_status = 'nonaktif' WHERE id_pk_produk = $id_pk_produk";
      $result = $this->db->query($sql);
    }

    public function edit_produk($id_pk_produk, $produk_no_katalog, $produk_principal, $produk_no_sap, $produk_nama, $produk_kategori, $produk_price_list, $produk_harga_ekat, $produk_deskripsi) {
      $sql = "UPDATE mstr_produk SET produk_no_katalog = '$produk_no_katalog', produk_principal = '$produk_principal', produk_no_sap = '$produk_no_sap', produk_nama = '$produk_nama', produk_kategori = '$produk_kategori', produk_price_list = '$produk_price_list', produk_harga_ekat = '$produk_harga_ekat', produk_deskripsi = '$produk_deskripsi' WHERE id_pk_produk = $id_pk_produk";
      $result = $this->db->query($sql);
    }
}
