<?php

class Rumah_sakit extends CI_Controller{

    public function index(){
      $this->load->model("m_rumah_sakit");
      $result1 = $this->m_rumah_sakit->get_rs();
      $result2 = $this->m_rumah_sakit->get_provinsi();
      $result3 = $this->m_rumah_sakit->kabupaten_default();
      $data = array (
        "datadb" => $result1->result_array(),
        "dataprovinsi" => $result2->result_array(),
        "datakabupaten" => $result3->result_array()
      );
      $this->load->view("rumah_sakit/index",$data);
    }

    public function insert() {
      $temp_rs_kode= $this->input->post('koderumahsakit');
      $temp_rs_nama= $this->input->post('namarumahsakit');
      $temp_rs_kelas= $this->input->post('kelasrumahsakit');
      $temp_rs_direktur= $this->input->post('direktur');
      $temp_rs_alamat= $this->input->post('alamat');
      $temp_rs_kategori= $this->input->post('kategori');
      $temp_id_fk_kabupaten= $this->input->post('kabupaten');
      $temp_rs_kode_pos= $this->input->post('kodepos');
      $temp_rs_telepon= $this->input->post('telepon');
      $temp_rs_fax= $this->input->post('fax');
      $temp_id_fk_jenis_rs= $this->input->post('jenisrumahsakit');
      $temp_id_fk_penyelenggara= $this->input->post('penyelenggara');
      $temp_rs_status= "aktif";
  		$this->load->model("m_rumah_sakit");
  		$this->m_rumah_sakit->insert_rs($temp_rs_kode, $temp_rs_nama, $temp_rs_kelas, $temp_rs_direktur, $temp_rs_alamat, $temp_rs_kategori, $temp_id_fk_kabupaten, $temp_rs_kode_pos, $temp_rs_telepon, $temp_rs_fax, $temp_id_fk_jenis_rs, $temp_id_fk_penyelenggara, $temp_rs_status);
      Redirect("rumah_sakit/index");
  	}

    public function delete($id_pk_rs) {
      $this->load->model("m_rumah_sakit");
      $this->m_rumah_sakit->delete_produk($id_pk_rs);
      Redirect("rumah_sakit/index");
    }

    public function edit() {
      $temp_rs_kode= $this->input->post('koderumahsakit');
      $temp_rs_nama= $this->input->post('namarumahsakit');
      $temp_rs_kelas= $this->input->post('kelasrumahsakit');
      $temp_rs_direktur= $this->input->post('direktur');
      $temp_rs_alamat= $this->input->post('alamat');
      $temp_rs_kategori= $this->input->post('kategori');
      $temp_id_fk_kabupaten= $this->input->post('kabupaten');
      $temp_rs_kode_pos= $this->input->post('kodepos');
      $temp_rs_telepon= $this->input->post('telepon');
      $temp_rs_fax= $this->input->post('fax');
      $temp_id_fk_jenis_rs= $this->input->post('jenisrumahsakit');
      $temp_id_fk_penyelenggara= $this->input->post('penyelenggara');
      $this->load->model("m_rumah_sakit");
      $this->m_rumah_sakit->edit_rs($temp_rs_kode, $temp_rs_nama, $temp_rs_kelas, $temp_rs_direktur, $temp_rs_alamat, $temp_rs_kategori, $temp_id_fk_kabupaten, $temp_rs_kode_pos, $temp_rs_telepon, $temp_rs_fax, $temp_id_fk_jenis_rs, $temp_id_fk_penyelenggara);
      Redirect("produk/index");
    }

}
?>