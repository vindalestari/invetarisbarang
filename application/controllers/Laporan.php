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
}
