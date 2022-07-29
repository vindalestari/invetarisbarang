<?php defined('BASEPATH') or exit('No direct script access allowed');

class Laporan extends CI_Controller
{


  function __construct()
  {
    parent::__construct();
    $this->load->model('Kelola_barang_masuk_model');
    $this->load->model('Kelola_barang_keluar_model');
    $this->load->library('form_validation');
  }

  public function laporan_barang_masuk()
  {
    $q = urldecode($this->input->get('q', TRUE));
    $start = intval($this->input->get('start'));

    if ($q <> '') {
      $config['base_url'] = base_url() . 'laporan/laporan_barang_masuk?q=' . urlencode($q);
      $config['first_url'] = base_url() . 'laporan/laporan_barang_masuk?q=' . urlencode($q);
    } else {
      $config['base_url'] = base_url() . 'laporan/laporan_barang_masuk';
      $config['first_url'] = base_url() . 'laporan/laporan_barang_masuk';
    }

    $config['per_page'] = 10;
    $config['page_query_string'] = TRUE;

    $dari = $this->input->post('dari');
    $sampai = $this->input->post('sampai');

    if ($dari) {
      $config['total_rows'] = $this->Kelola_barang_masuk_model->laporan_barang_masuk_total($q, $dari, $sampai);
      $barang_masuk = $this->Kelola_barang_masuk_model->laporan_barang_masuk($config['per_page'], $start, $q, $dari, $sampai);
    } else {
      $config['total_rows'] = $this->Kelola_barang_masuk_model->total_rows($q);
      $barang_masuk = $this->Kelola_barang_masuk_model->get_limit_data($config['per_page'], $start, $q);
    }

    $this->load->library('pagination');
    $this->pagination->initialize($config);

    $data = array(
      'barang_masuk_data' => $barang_masuk,
      'q' => $q,
      'pagination' => $this->pagination->create_links(),
      'total_rows' => $config['total_rows'],
      'start' => $start,
    );
    $data['title'] = 'Laporan';
    $data['subtitle'] = 'Laporan barang_masuk';

    $data['search_page'] = 'laporan/laporan_barang_masuk';
    $data['crumb'] = [
      'Laporan' => '',
    ];

    $data['page'] = 'laporan_bm';
    $this->load->view('template/backend', $data);
  }


  public function laporan_barang_keluar()
  {
    $q = urldecode($this->input->get('q', TRUE));
    $start = intval($this->input->get('start'));

    if ($q <> '') {
      $config['base_url'] = base_url() . 'laporan/laporan_barang_keluar?q=' . urlencode($q);
      $config['first_url'] = base_url() . 'laporan/laporan_barang_keluar?q=' . urlencode($q);
    } else {
      $config['base_url'] = base_url() . 'laporan/laporan_barang_keluar';
      $config['first_url'] = base_url() . 'laporan/laporan_barang_keluar';
    }

    $config['per_page'] = 10;
    $config['page_query_string'] = TRUE;

    $dari = $this->input->post('dari');
    $sampai = $this->input->post('sampai');

    if ($dari) {
      $config['total_rows'] = $this->Kelola_barang_keluar_model->laporan_barang_keluar_total($q, $dari, $sampai);
      $barang_keluar = $this->Kelola_barang_keluar_model->laporan_barang_keluar($config['per_page'], $start, $q, $dari, $sampai);
    } else {
      $config['total_rows'] = $this->Kelola_barang_keluar_model->total_rows($q);
      $barang_keluar = $this->Kelola_barang_keluar_model->get_limit_data($config['per_page'], $start, $q);
    }

    $this->load->library('pagination');
    $this->pagination->initialize($config);

    $data = array(
      'barang_keluar_data' => $barang_keluar,
      'q' => $q,
      'pagination' => $this->pagination->create_links(),
      'total_rows' => $config['total_rows'],
      'start' => $start,
    );
    $data['title'] = 'Laporan';
    $data['subtitle'] = 'Laporan barang_keluar';

    $data['search_page'] = 'laporan/laporan_barang_keluar';
    $data['crumb'] = [
      'Laporan' => '',
    ];

    $data['page'] = 'laporan_bk';
    $this->load->view('template/backend', $data);
  }

  public function laporan_barang_keluar_print()
  {

    $datareport = $this->Kelola_barang_keluar_model->get_limit_data_print_bk();
    $header = [
      'No',
      'Nama Pendistribusi',
      'Nama Barang',
      'Jumlah Barang',
      'Tanggal keluar',
      'Tujuan'
    ];
    $body = [
      'id_user',
      'id_barang',
      'jml_barang_keluar',
      'tgl_keluar',
      'tujuan'
    ];

    $this->load->helper('exportexcel');
    $namaFile = "laporan.xls";
    // $judul = "groups";
    $tablehead = 0;
    $tablebody = 1;
    $nourut = 1;
    //penulisan header
    header("Pragma: public");
    header("Expires: 0");
    header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
    header("Content-Type: application/force-download");
    header("Content-Type: application/octet-stream");
    header("Content-Type: application/download");
    header("Content-Disposition: attachment;filename=" . $namaFile . "");
    header("Content-Transfer-Encoding: binary ");

    xlsBOF();

    $kolomhead = 0;
    foreach ($header as $kolom) {
      xlsWriteLabel($tablehead, $kolomhead++, $kolom);
    }

    foreach ($datareport as $data) {
      $kolombody = 0;

      //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
      xlsWriteNumber($tablebody, $kolombody++, $nourut);
      // foreach ($body as $key => $value) {
      // echo $key;
      // if ($key == 'id_user') {
      $first_name = $this->db->query("select first_name,last_name from users where id=$data->id_user")->row()->first_name;
      $last_name = $this->db->query("select first_name,last_name from users where id=$data->id_user")->row()->last_name;
      $nama = $first_name . " " . $last_name;
      xlsWriteLabel($tablebody, $kolombody++, $nama);
      // }
      // if ($key == 'id_barang') {
      $datax = nama_barang($data->id_barang);
      xlsWriteLabel($tablebody, $kolombody++, $datax);
      // }
      // if ($key == 'jml_barang_keluar') {
      xlsWriteNumber($tablebody, $kolombody++, $data->jml_barang_keluar);
      // }
      // if ($key == 'tgl_keluar') {
      xlsWriteLabel($tablebody, $kolombody++, date('d-m-Y', strtotime($data->tgl_keluar)));
      // }
      // if ($key == 'tujuan') {
      xlsWriteLabel($tablebody, $kolombody++, $data->tgl_keluar);
      // }
      // xlsWriteLabel($tablebody, $kolombody++, $data->$value);
      // }

      $tablebody++;
      $nourut++;
    }

    xlsEOF();
    exit();
  }
  public function laporan_barang_masuk_print()
  {

    $datareport = $this->Kelola_barang_masuk_model->get_limit_data_print_bm();
    $header = [
      'No',
      'Nama Penyetuju',
      'Supplier',
      'Nama Barang',
      'Harga Barang',
      'Jumlah Barang',
      'Total Harga',
      'Tanggal',
      'Status'
    ];

    $this->load->helper('exportexcel');
    $namaFile = "laporan.xls";
    // $judul = "groups";
    $tablehead = 0;
    $tablebody = 1;
    $nourut = 1;
    //penulisan header
    header("Pragma: public");
    header("Expires: 0");
    header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
    header("Content-Type: application/force-download");
    header("Content-Type: application/octet-stream");
    header("Content-Type: application/download");
    header("Content-Disposition: attachment;filename=" . $namaFile . "");
    header("Content-Transfer-Encoding: binary ");

    xlsBOF();

    $kolomhead = 0;
    foreach ($header as $kolom) {
      xlsWriteLabel($tablehead, $kolomhead++, $kolom);
    }

    foreach ($datareport as $data) {
      $kolombody = 0;

      //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
      xlsWriteNumber($tablebody, $kolombody++, $nourut);
      // foreach ($body as $key => $value) {
      // echo $key;
      // if ($key == 'id_user') {
      $first_name = $this->db->query("select first_name,last_name from users where id=$data->id_user")->row()->first_name;
      $last_name = $this->db->query("select first_name,last_name from users where id=$data->id_user")->row()->last_name;
      $nama = $first_name . " " . $last_name;
      xlsWriteLabel($tablebody, $kolombody++, $nama);
      // }
      // if ($key == 'id_barang') {
      $supplier = $this->db->query("select * from kelola_supplier where id=$data->id_supplier")->row()->nama;

      xlsWriteLabel($tablebody, $kolombody++, $supplier);
      // }
      // if ($key == 'jml_barang_keluar') {
      $xxxxx = $this->db->query("select kelola_barang.nama_barang as nama_barang from pengajuan join kelola_barang on pengajuan.id_barang=kelola_barang.id where pengajuan.id=$data->id_pengajuan")->row()->nama_barang;
      xlsWriteNumber($tablebody, $kolombody++, $xxxxx);
      // }
      // if ($key == 'tgl_keluar') {
      // }
      // if ($key == 'tujuan') {
      xlsWriteLabel($tablebody, $kolombody++, $data->harga_barang);
      xlsWriteLabel($tablebody, $kolombody++, $data->jml_barang_masuk);
      xlsWriteLabel($tablebody, $kolombody++, $data->total_harga);
      xlsWriteLabel($tablebody, $kolombody++, $data->tgl_masuk);
      xlsWriteLabel($tablebody, $kolombody++, status_barang($data->status));

      // }
      // xlsWriteLabel($tablebody, $kolombody++, $data->$value);
      // }

      $tablebody++;
      $nourut++;
    }

    xlsEOF();
    exit();
  }
}
