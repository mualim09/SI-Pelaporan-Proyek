<?php
date_default_timezone_set("Asia/Jakarta");
error_reporting(0);
class Sch_sirup extends CI_Controller
{
  private $list_rup = "";

  public function index()
  {
    // if ($this->input->get("login")) {
    //   if (md5($this->input->get("login")) == "523c2c2940a37fb651b7a19b68149e0b") {
    echo "Welcome to sch_sirup, below is our available links!:<br/>";
    echo "<a target = '_blank' href = '" . base_url() . "sch_sirup/reset_status_query'>function reset_status_query()</a><br/>";
    echo "<a target = '_blank' href = '" . base_url() . "sch_sirup/query_sirup'>function query_sirup()</a><br/>";
    echo "<a target = '_blank' href = '" . base_url() . "sch_sirup/extract_sirup_item'>function extract_sirup_item()</a><br/>";
    echo "<a target = '_blank' href = '" . base_url() . "sch_sirup/query_sirup_detail'>function query_sirup_detail()</a><br/>";
    echo "<a target = '_blank' href = '" . base_url() . "sch_sirup/revalidate_search_similarity'>function revalidate_search_similarity()</a><br/>";
    echo "<a target = '_blank' href = '" . base_url() . "sch_sirup/update_sirup_weekly'>function update_sirup_weekly()</a><br/>";
    //   } else {
    //     echo "babai.";
    //     exit();
    //   }
    // } else {
    //   echo "babai.";
    //   exit();
    // }
  }
  public function reset_status_query()
  {
    $sql = "update mstr_pencarian_sirup set pencarian_sirup_status_query_today = 0 where pencarian_sirup_status = 'aktif'";
    executeQuery($sql);
  }
  public function query_sirup()
  {
    $sql = "select * from mstr_pencarian_sirup where pencarian_sirup_status_query_today = 0 and pencarian_sirup_status = 'aktif'";
    $result = executeQuery($sql);
    $result = $result->result_array();
    for ($query_sirup_row = 0; $query_sirup_row < count($result); $query_sirup_row++) {
      $id_pk_pencarian_sirup = $result[$query_sirup_row]["id_pk_pencarian_sirup"];
      $pencarian_sirup_tahun = date('Y');
      $pencarian_sirup_frase = urlencode($result[$query_sirup_row]["pencarian_sirup_frase"]);
      $pencarian_sirup_jenis = $result[$query_sirup_row]["pencarian_sirup_jenis"];
      $amount = 50; #ini paling ideal untuk masuk ke text type, karena gamuat juga anyway.

      $where = array(
        "id_pk_pencarian_sirup" => $id_pk_pencarian_sirup
      );
      $data = array(
        "pencarian_sirup_last_checkpoint" => date("Y-m-d H:i:s"),
        "pencarian_sirup_status_query_today" => 1
      );
      updateRow("mstr_pencarian_sirup", $data, $where);


      $count = 0;
      do {
        #urutin pagu itu ada di kolom 2 dengan order dir nya DESC.
        $start = $amount * $count;
        // new
        if ($pencarian_sirup_jenis == 0) {
          $pencarian_sirup_jenis = "";
        }
        $url = "https://sirup.lkpp.go.id/sirup/ro/caripaket2/search?tahunAnggaran=" . $pencarian_sirup_tahun . "&jenisPengadaan=$pencarian_sirup_jenis" . "&minPagu=&maxPagu=&bulan=&draw=1&columns=&order[0][column]=5&order[0][dir]=DESC&start=$start&length=$amount&search[value]=" . $pencarian_sirup_frase . "&search[regex]=false";

        $curl = curl_init();
        curl_setopt_array($curl, array(
          CURLOPT_URL => $url,
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "GET",
        ));
        $response = curl_exec($curl);

        if ($response) {
          $data = array(
            "sirup_general" => $response,
            "id_fk_pencarian_sirup" => $id_pk_pencarian_sirup,
            "sirup_general_tgl_create" => date("Y-m-d H:i:s")
          );
          insertRow("temp_sirup_general", $data);

          $response = json_decode($response, true);
          if ($response["recordsTotal"] < $amount * ($count + 1)) {
            break;
          }
          $count++;
        } else {
          echo "Fail";
          break;
        }
      } while (true);
    }
  }
  public function extract_sirup_item()
  {

    #note. 1 kali narik, bisa aja udah ketarik semua dan ada yang ga diatas 100 juta. Jadi wajar kalau yang ketarik 58 data tapi pas diekstrak ga dapet 58 (might be less)
    $sql = "
    select * from temp_sirup_general 
    inner join mstr_pencarian_sirup on mstr_pencarian_sirup.id_pk_pencarian_sirup = temp_sirup_general.id_fk_pencarian_sirup";
    $result = executeQuery($sql);

    if ($result->num_rows() > 0) {
      $result = $result->result_array();
      for ($sirup_general_row = 0; $sirup_general_row < count($result); $sirup_general_row++) {
        $result_temp = $result[$sirup_general_row]["sirup_general"];
        $data = json_decode($result_temp, true);
        $list = $data["data"];
        echo "========= list ======== <br/>";
        echo "sirup_general_row: " . $result[$sirup_general_row]["sirup_general"] . "<br/>";
        print_r($list);
        echo " -----";
        echo "========= end list ======== <br/>";
        for ($a = 0; $a < count($list); $a++) {
          $data = array(
            "no_sirup" => $list[$a]["id"],
            "pagu" => $list[$a]["pagu"],
            "id_fk_sirup_general" => $result[$sirup_general_row]["id_pk_sirup_general"]
          );
          insertRow("temp_sirup_detil", $data);
        }
        $where = array(
          "id_pk_sirup_general" => $result[$sirup_general_row]["id_pk_sirup_general"]
        );
        $data = array(
          "sirup_general_last_checkpoint" => date("Y-m-d H:i:s"),
          "sirup_general_status_query_today" => 1
        );
        updateRow("temp_sirup_general", $data, $where);
      }
    }
  }
  public function query_sirup_detail()
  {
    #oke ini yang sangat lama disini, karena kita kurang 1 step untuk pecahin jadi satuan row baru natni di query masing=masing.
    $sql = "
    select * from temp_sirup_detil
    inner join temp_sirup_general on temp_sirup_general.id_pk_sirup_general =  temp_sirup_detil.id_fk_sirup_general
    inner join mstr_pencarian_sirup on mstr_pencarian_sirup.id_pk_pencarian_sirup = temp_sirup_general.id_fk_pencarian_sirup
    where sirup_detil_status_query_today = 0 and sirup_general is not null and is_executed = 0 limit 25";

    $result = executeQuery($sql);
    $result = $result->result_array();
    // echo "=============query sirup detail result================<br/><br/>";
    // print_r($result);
    // echo "<br/>=============================<br/><br/>";
    for ($temp_sirup_detil_row = 0; $temp_sirup_detil_row < count($result); $temp_sirup_detil_row++) {
      $this->load->model("m_sirup");
      $id_pk_sirup_detil = $result[$temp_sirup_detil_row]["id_pk_sirup_detil"];
      $id_pk_pencarian_sirup = $result[$temp_sirup_detil_row]["id_fk_pencarian_sirup"];
      $search_phrase = $result[$temp_sirup_detil_row]["pencarian_sirup_frase"];
      $sirup_no = $result[$temp_sirup_detil_row]["no_sirup"];
      $pagu = $result[$temp_sirup_detil_row]["pagu"];

      $where = array(
        "id_pk_sirup_detil" => $id_pk_sirup_detil
      );
      $data = array(
        "sirup_detil_last_checkpoint" => date("Y-m-d H:i:s"),
        "sirup_detil_status_query_today" => 1,
        "is_executed" => 1
      );
      updateRow("temp_sirup_detil", $data, $where);

      $id = str_replace(" ", "", $sirup_no);

      $url = "https://sirup.lkpp.go.id/sirup/ro/pp/2018/" . $id;

      #$url = "https://sirup.lkpp.go.id/sirup/home/detailPaketPenyediaPublic2017/29375834";
      $curl = curl_init();
      curl_setopt_array($curl, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
      ));
      $response = curl_exec($curl);
      curl_close($curl);

      $dom = new domDocument;
      $dom->loadHTML($response);
      $content = $dom->getElementById("detil");
      $response = strval($content->nodeValue);
      $response = preg_replace('/\s+/', ' ', $response);
      $response = preg_replace('/\t+/', ' ', $response);
      $response = preg_replace('/\n\r+/', '', $response);

      $data = array(
        "sirup_detil_query_response" => $response,
        "sirup_detil_query_rup" => $id,
        "sirup_detil_query_tgl_create" => date("Y-m-d H:i:s")
      );
      // print_r($data);
      insertRow("temp_sirup_detil_query", $data);

      $this->extract_data($response, $pagu, $id_pk_pencarian_sirup, $search_phrase);
    }
  }
  private function extract_data($response, $sirup_total, $id_fk_pencarian_sirup, $search_phrase)
  {
    #asumsi history paket aja yang beda
    $sirup_rup = str_replace(" ", "", explode("Nama Paket", explode("Kode RUP", $response)[1])[0]);
    $this->list_rup .= $sirup_rup . " ";
    $sirup_paket = explode("Nama KLPD", explode("Nama Paket", $response)[1])[0];
    $sirup_klpd = explode("Satuan Kerja", explode("Nama KLPD", $response)[1])[0];
    $sirup_satuan_kerja = explode("Tahun Anggaran", explode("Satuan Kerja", $response)[1])[0];
    $sirup_tahun_anggaran = explode("Lokasi Pekerjaan No. Provinsi Kabupaten/Kota Detail Lokasi", explode("Tahun Anggaran", $response)[1])[0];
    $sirup_lokasi = explode("Volume Pekerjaan", explode("Lokasi Pekerjaan No. Provinsi Kabupaten/Kota Detail Lokasi", $response)[1])[0];
    $sirup_volume_pekerjaan = explode("Uraian Pekerjaan", explode("Volume Pekerjaan", $response)[1])[0];
    $sirup_uraian_pekerjaan = explode("Spesifikasi Pekerjaan", explode("Uraian Pekerjaan", $response)[1])[0];
    $sirup_spesifikasi_pekerjaan = explode("Produk Dalam Negeri", explode("Spesifikasi Pekerjaan", $response)[1])[0];
    $sirup_produk_dalam_negri = trim(explode("Usaha Kecil/Koperasi", explode("Produk Dalam Negeri", $response)[1])[0]);
    $sirup_usaha_kecil = trim(explode("Pengadaan Berkelanjutan atau Sustainable Public Procurement (SPP)", explode("Usaha Kecil/Koperasi", $response)[1])[0]);

    $sirup_aspek_ekonomi = trim(explode("Aspek Sosial", explode("Aspek Ekonomi", $response)[1])[0]);
    $sirup_aspek_sosial = trim(explode("Aspek Lingkungan", explode("Aspek Sosial", $response)[1])[0]);
    $sirup_aspek_lingkungan = trim(explode("Pra DIPA / DPA", explode("Aspek Lingkungan", $response)[1])[0]);

    $sirup_pra_dipa = trim(explode("Sumber Dana No. Sumber Dana T.A. KLPD MAK Pagu", explode("Pra DIPA / DPA", $response)[1])[0]);

    $sumber_dana = explode("Total Pagu", explode("Sumber Dana No. Sumber Dana T.A. KLPD MAK Pagu", $response)[1])[0];

    $sirup_jenis_pengadaan = explode("Total Pagu", explode("Jenis Pengadaan No. Jenis Pengadaan Pagu Jenis Pengadaan", $response)[1])[0];

    $sirup_total_pagu = explode("Metode Pemilihan", explode("Total Pagu", $response)[2])[0];

    $sirup_metode_pemilihan = explode("Pemanfaatan Barang/Jasa", explode("Metode Pemilihan", $response)[1])[0];

    if (strpos($response, 'History Paket') == false) {
      $sirup_histori_paket = "";
      $sirup_jadwal_pemilihan = "";
    } else {
      $sirup_histori_paket = explode("Tanggal Perbarui Paket", explode("History Paket", $response)[1])[0];
      if (strpos($response, 'Jadwal Pemilihan Penyedia') == false) {
        $sirup_jadwal_pemilihan = "";
      } else {
        $sirup_jadwal_pemilihan = explode("History Paket", explode("Jadwal Pemilihan Penyedia Mulai Akhir", $response)[1])[0];
      }
    }

    $lokasi_pekerjaan = explode("Volume Pekerjaan", explode("Lokasi Pekerjaan No. Provinsi Kabupaten/Kota Detail Lokasi", $response)[1])[0];
    if (strpos($lokasi_pekerjaan, "(Kota)") !== false) {
      $kabupaten = explode(" ", explode("(Kota)", $lokasi_pekerjaan)[0]);
      $count_kabupaten = count($kabupaten) - 1;
      $kabupaten = $kabupaten[$count_kabupaten - 1] . " (Kota)";
    } else {
      $kabupaten = explode(" ", explode("(Kab.)", $lokasi_pekerjaan)[0]);
      $count_kabupaten = count($kabupaten) - 1;
      $kabupaten = $kabupaten[$count_kabupaten - 1] . " (Kab.)";
    }


    $sql = "SELECT kabupaten, provinsi FROM tbl_provinsi_kabupaten_sirup WHERE kabupaten LIKE '%" . $kabupaten . "%'";
    $execute = executeQuery($sql);
    $result = $execute->result_array();
    if (count($result) > 1) {
      for ($j = 0; $j < count($result); $j++) {
        if (strpos($lokasi_pekerjaan, $result[$j]['kabupaten'])) {
          $kabupaten = $result[$j]['kabupaten'];
          $provinsi = $result[$j]['provinsi'];

          break;
        }
      }
    } else {
      $kabupaten = $result[0]['kabupaten'];
      $provinsi = $result[0]['provinsi'];
    }



    $sumber_dana = explode("Total Pagu", explode("Sumber Dana No. Sumber Dana T.A. KLPD MAK Pagu", $response)[1])[0];
    $pemanfaatan_barang = explode("Jadwal Pelaksanaan Kontrak Mulai Akhir", explode("Pemanfaatan Barang/Jasa Mulai Akhir", $response)[1])[0];
    $jadwal_pelaksanaan = explode("Jadwal Pemilihan Penyedia Mulai Akhir", explode("Jadwal Pelaksanaan Kontrak Mulai Akhir", $response)[1])[0];
    $sirup_tgl_perbarui_paket = explode("Tanggal Perbarui Paket", $response)[1];
    if (strpos($response, 'History Paket') !== false) {
      $sirup_histori_paket = explode("Tanggal Perbarui Paket", explode("History Paket", $response)[1])[0];
      $pemilihan_penyedia = explode("History Paket", explode("Jadwal Pemilihan Penyedia Mulai Akhir", $response)[1])[0];
    } else {
      $pemilihan_penyedia = explode("Tanggal Perbarui Paket", explode("Jadwal Pemilihan Penyedia Mulai Akhir", $response)[1])[0];
    }
    $sirup_id_create = 0;
    if ($this->session->id_user != "") {
      $sirup_id_create = $this->session->id_user;
    }
    $this->load->model("m_sirup");
    $args = array(
      $sirup_rup
    );
    $sql = "delete tbl_sirup_jadwal_pelaksanaan from tbl_sirup_jadwal_pelaksanaan inner join mstr_sirup on mstr_sirup.id_pk_sirup = tbl_sirup_jadwal_pelaksanaan.id_fk_sirup where sirup_rup = ?";
    executeQuery($sql, $args);
    $sql = "delete tbl_sirup_lokasi_pekerjaan from tbl_sirup_lokasi_pekerjaan inner join mstr_sirup on mstr_sirup.id_pk_sirup = tbl_sirup_lokasi_pekerjaan.id_fk_sirup where sirup_rup = ?";
    executeQuery($sql, $args);
    $sql = "delete tbl_sirup_pemanfaatan_barang from tbl_sirup_pemanfaatan_barang inner join mstr_sirup on mstr_sirup.id_pk_sirup = tbl_sirup_pemanfaatan_barang.id_fk_sirup where sirup_rup = ?";
    executeQuery($sql, $args);
    $sql = "delete tbl_sirup_pemilihan_penyedia from tbl_sirup_pemilihan_penyedia inner join mstr_sirup on mstr_sirup.id_pk_sirup = tbl_sirup_pemilihan_penyedia.id_fk_sirup where sirup_rup = ?";
    executeQuery($sql, $args);
    $sql = "delete tbl_sirup_sumber_dana from tbl_sirup_sumber_dana inner join mstr_sirup on mstr_sirup.id_pk_sirup = tbl_sirup_sumber_dana.id_fk_sirup where sirup_rup = ?";
    executeQuery($sql, $args);

    if (strpos($sirup_paket, $search_phrase) !== false) {
      $id_pk_sirup = $this->m_sirup->insert($sirup_rup, $sirup_paket, $sirup_klpd, $sirup_satuan_kerja, $sirup_tahun_anggaran, $sirup_volume_pekerjaan, $sirup_uraian_pekerjaan, $sirup_spesifikasi_pekerjaan, $sirup_produk_dalam_negri, $sirup_usaha_kecil, $sirup_pra_dipa, $sirup_jenis_pengadaan, $sirup_total, $sirup_metode_pemilihan, $sirup_histori_paket, $sirup_tgl_perbarui_paket, $sirup_id_create, $id_fk_pencarian_sirup, "aktif", 1, $sirup_aspek_ekonomi, $sirup_aspek_sosial, $sirup_aspek_lingkungan, $sirup_total_pagu, $sirup_jadwal_pemilihan, $kabupaten, $provinsi);
    } else {
      $id_pk_sirup = $this->m_sirup->insert($sirup_rup, $sirup_paket, $sirup_klpd, $sirup_satuan_kerja, $sirup_tahun_anggaran, $sirup_volume_pekerjaan, $sirup_uraian_pekerjaan, $sirup_spesifikasi_pekerjaan, $sirup_produk_dalam_negri, $sirup_usaha_kecil, $sirup_pra_dipa, $sirup_jenis_pengadaan, $sirup_total, $sirup_metode_pemilihan, $sirup_histori_paket, $sirup_tgl_perbarui_paket, $sirup_id_create, $id_fk_pencarian_sirup, "aktif", 0, $sirup_aspek_ekonomi, $sirup_aspek_sosial, $sirup_aspek_lingkungan, $sirup_total_pagu, $sirup_jadwal_pemilihan, $kabupaten, $provinsi);
    }
    if (!$id_pk_sirup) {
      echo "fail";
      #data udah pernah diinsert dan tidak ada perubahan.
      return false;
    }
    $preg = '/[0-9]\.\ /';
    $lokasi_pekerjaan = preg_split($preg, $lokasi_pekerjaan);
    // print_r($lokasi_pekerjaan);
    for ($a = 1; $a < count($lokasi_pekerjaan); $a++) { #ini mulai dari 1 karena contoh data itu 1. asdfasdf, kalau di preg_split, asdfasdf itu ada di index 1 bukan index 0. index0nya kosong. POC juga sama kalau misalnya pake test hahahahah test bbebee, kalau di split pake test, dia 0 nya itu null.
      if ($lokasi_pekerjaan[$a] != "") {
        $this->m_sirup->insert_lokasi_pekerjaan($lokasi_pekerjaan[$a], $id_pk_sirup);
      } else {
        echo "fail lokasi_pekerjaan";
      }
      #start dari 1 karena 0 nya pasti blank. Cth data 1. abcdef, nah karena split by 1. , jadinya abcdefnya itu ada di index 1
      #print_r($lokasi_pekerjaan);
    }
    #echo $sumber_dana."<br/>";
    $sumber_dana = preg_split($preg, $sumber_dana);
    // print_r($sumber_dana);
    for ($a = 1; $a < count($sumber_dana); $a++) {
      if ($sumber_dana[$a]) {
        $this->m_sirup->insert_sumber_dana($sumber_dana[$a], $id_pk_sirup);
      }
      #start dari 1 karena 0 nya pasti blank. Cth data 1. abcdef, nah karena split by 1. , jadinya abcdefnya itu ada di index 1
      #print_r($sumber_dana);
    }
    #echo $pemanfaatan_barang."<br/>";
    $pemanfaatan_barang = preg_split($preg, $pemanfaatan_barang);
    // print_r($pemanfaatan_barang);
    for ($a = 0; $a < count($pemanfaatan_barang); $a++) { #untuk pemanfaatan barang dia gapake nomor 1., jadi actually ga ada preg split anyway.
      if ($pemanfaatan_barang[$a]) {
        $this->m_sirup->insert_pemanfaatan_barang($pemanfaatan_barang[$a], $id_pk_sirup);
      }
      #start dari 1 karena 0 nya pasti blank. Cth data 1. abcdef, nah karena split by 1. , jadinya abcdefnya itu ada di index 1
      #print_r($pemanfaatan_barang);
    }
    echo $jadwal_pelaksanaan . "<br/>";
    $jadwal_pelaksanaan = preg_split($preg, $jadwal_pelaksanaan);
    // print_r($jadwal_pelaksanaan);
    for ($a = 0; $a < count($jadwal_pelaksanaan); $a++) {
      if ($jadwal_pelaksanaan[$a]) {
        $this->m_sirup->insert_jadwal_pelaksanaan($jadwal_pelaksanaan[$a], $id_pk_sirup);
      }
      #start dari 1 karena 0 nya pasti blank. Cth data 1. abcdef, nah karena split by 1. , jadinya abcdefnya itu ada di index 1
      #print_r($jadwal_pelaksanaan);
    }
    echo $pemilihan_penyedia . "<br/>";
    $pemilihan_penyedia = preg_split($preg, $pemilihan_penyedia);
    // print_r($pemilihan_penyedia);
    for ($a = 0; $a < count($pemilihan_penyedia); $a++) {
      if ($pemilihan_penyedia[$a]) {
        $this->m_sirup->insert_pemilihan_penyedia($pemilihan_penyedia[$a], $id_pk_sirup);
      }
      #start dari 1 karena 0 nya pasti blank. Cth data 1. abcdef, nah karena split by 1. , jadinya abcdefnya itu ada di index 1
      #print_r($pemilihan_penyedia);
    }
  }
  public function revalidate_search_similarity()
  {
    $sql = "update mstr_sirup set sirup_status_sesuai_pencarian = 1";
    executeQuery($sql);
    $sql = "delete from mstr_sirup where sirup_rup =''";
    executeQuery($sql);
  }
  // public function revalidate_search_similarity()
  // {
  //   $sql = "select *
  //   from mstr_sirup
  //   left join mstr_pencarian_sirup on mstr_pencarian_sirup.id_pk_pencarian_sirup = mstr_sirup.id_fk_pencarian_sirup
  //   where sirup_status = 'aktif' and id_fk_pencarian_sirup > 0";
  //   $result = executeQuery($sql);
  //   $result = $result->result_array();
  //   for ($a = 0; $a < count($result); $a++) {
  //     $where = array(
  //       "id_pk_sirup" => $result[$a]["id_pk_sirup"]
  //     );
  //     $data = array(
  //       "sirup_status_sesuai_pencarian" => 1
  //     );
  //     updateRow("mstr_sirup", $data, $where);
  //   }
  // }
  public function truncate_all_temp()
  {
    $sql = "delete from temp_sirup_detil
    where is_executed = 1";
    executeQuery($sql);
    $sql = "truncate table temp_sirup_detil_query";
    executeQuery($sql);
    $sql = "truncate table temp_sirup_general";
    executeQuery($sql);
    $data = array(
      "date" => date("H:i:s"),
      "keterangan" => "Deleting all temp"
    );
    insertRow("testcron", $data);
  }
  public function execute_all_function()
  {
    $this->reset_status_query();
    $this->truncate_all_temp();
    $this->query_sirup();
    $this->extract_sirup_item();
    $this->query_sirup_detail();
    $this->revalidate_search_similarity();
  }

  public function cron_delete_temp()
  {
    $data = array(
      "date" => date("Y-m-d H:i:s"),
      "keterangan" => "Deleting temp"
    );
    insertRow("testcron", $data);
    $sql = "select * from temp_sirup_detil where is_executed = 0";

    $check = executeQuery($sql);
    $not_empty = $check->result_array();
    if (!$not_empty) {
      $sql = "delete from temp_sirup_detil
        where is_executed = 1";
      executeQuery($sql);
      $sql = "truncate table temp_sirup_detil_query";
      executeQuery($sql);
      $sql = "truncate table temp_sirup_general";
      executeQuery($sql);
    } else {
      // do nothing
    }
  }

  public function test_cron()
  {
    $data = array(
      "date" => date("Y-m-d H:i:s"),
      "keterangan" => "Pulling data"
    );
    insertRow("testcron", $data);
    $this->query_sirup_detail();
    $this->revalidate_search_similarity();
  }

  public function update_sirup_weekly()
  {
    $data = array(
      "date" => date("Y-m-d H:i:s"),
      "keterangan" => "Updating Sirup"
    );
    insertRow("testcron", $data);

    $sql = "truncate table temp_sirup_detil_query";
    executeQuery($sql);
    $sql = "truncate table temp_sirup_detil";
    executeQuery($sql);
    $sql = "truncate table temp_sirup_general";
    executeQuery($sql);


    $this->reset_status_query();
    $this->query_sirup();
    $this->extract_sirup_item();
    $this->query_sirup_detail();
    $this->revalidate_search_similarity();
  }
}
