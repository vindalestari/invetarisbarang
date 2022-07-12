<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Kelola_barang_masuk extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $c_url = $this->router->fetch_class();
        $this->layout->auth();
        $this->layout->auth_privilege($c_url);
        $this->load->model('Kelola_barang_masuk_model');
        $this->load->model('Kelola_barang_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));

        if ($q <> '') {
            $config['base_url'] = base_url() . 'kelola_barang_masuk?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'kelola_barang_masuk?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'kelola_barang_masuk';
            $config['first_url'] = base_url() . 'kelola_barang_masuk';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Kelola_barang_masuk_model->total_rows($q);
        $kelola_barang_masuk = $this->Kelola_barang_masuk_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'kelola_barang_masuk_data' => $kelola_barang_masuk,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $data['title'] = 'Kelola Barang Masuk';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Kelola Barang Masuk' => '',
        ];

        $data['page'] = 'kelola_barang_masuk/kelola_barang_masuk_list';
        $this->load->view('template/backend', $data);
    }

    public function read($id)
    {
        $row = $this->Kelola_barang_masuk_model->get_by_id($id);
        if ($row) {
            $data = array(
                'id' => $row->id,
                'id_user' => $row->id_user,
                'id_supplier' => $row->id_supplier,
                'harga_barang' => $row->harga_barang,
                'jml_barang_masuk' => $row->jml_barang_masuk,
                'tgl_masuk' => $row->tgl_masuk,
            );
            $data['title'] = 'Kelola Barang Masuk';
            $data['subtitle'] = '';
            $data['crumb'] = [
                'Dashboard' => '',
            ];

            $data['page'] = 'kelola_barang_masuk/kelola_barang_masuk_read';
            $this->load->view('template/backend', $data);
        } else {
            $this->session->set_flashdata('error', 'Record Not Found');
            redirect(site_url('kelola_barang_masuk'));
        }
    }

    public function create()
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('kelola_barang_masuk/create_action'),
            'id' => set_value('id'),
            'id_user' => set_value('id_user'),
            'id_supplier' => set_value('id_supplier'),
            'harga_barang' => set_value('harga_barang'),
            'jml_barang_masuk' => set_value('jml_barang_masuk'),
            'tgl_masuk' => set_value('tgl_masuk'),
        );
        $data['title'] = 'Kelola Barang Masuk';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Dashboard' => '',
        ];

        $data['page'] = 'kelola_barang_masuk/kelola_barang_masuk_form';
        $this->load->view('template/backend', $data);
    }

    public function create_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
                'id_user' => $this->input->post('id_user', TRUE),
                'id_supplier' => $this->input->post('id_supplier', TRUE),
                'harga_barang' => $this->input->post('harga_barang', TRUE),
                'jml_barang_masuk' => $this->input->post('jml_barang_masuk', TRUE),
                'tgl_masuk' => $this->input->post('tgl_masuk', TRUE),
            );

            $this->Kelola_barang_masuk_model->insert($data);
            $this->session->set_flashdata('success', 'Create Record Success');
            redirect(site_url('kelola_barang_masuk'));
        }
    }

    public function update($id)
    {
        $row = $this->Kelola_barang_masuk_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('kelola_barang_masuk/update_action'),
                'id' => set_value('id', $row->id),
                'id_user' => set_value('id_user', $row->id_user),
                'id_supplier' => set_value('id_supplier', $row->id_supplier),
                'harga_barang' => set_value('harga_barang', $row->harga_barang),
                'jml_barang_masuk' => set_value('jml_barang_masuk', $row->jml_barang_masuk),
                'tgl_masuk' => set_value('tgl_masuk', $row->tgl_masuk),
            );
            $data['title'] = 'Kelola Barang Masuk';
            $data['subtitle'] = '';
            $data['crumb'] = [
                'Dashboard' => '',
            ];

            $data['page'] = 'kelola_barang_masuk/kelola_barang_masuk_form';
            $this->load->view('template/backend', $data);
        } else {
            $this->session->set_flashdata('error', 'Record Not Found');
            redirect(site_url('kelola_barang_masuk'));
        }
    }

    public function update_action($id)
    {
        $data = array(
            'status' => 1
        );

        $this->Kelola_barang_masuk_model->update($id, $data);

        $jumlah_barang_masuk = $this->db->query("SELECT jml_barang_masuk FROM kelola_barang_masuk WHERE id = $id")->row()->jml_barang_masuk;

        $id_barang = $this->db->query("SELECT p.id_barang FROM kelola_barang_masuk kb join pengajuan p on (kb.id_pengajuan=p.id) WHERE kb.id = $id")->row()->id_barang;



        $jumlah_barang_sebelumnya = $this->db->query("SELECT jumlah FROM kelola_barang WHERE id = $id_barang")->row()->jumlah;
        $data_barang = array(
            'jumlah' => $jumlah_barang_sebelumnya + $jumlah_barang_masuk
        );

        $this->Kelola_barang_model->update($id_barang, $data_barang);


        $this->session->set_flashdata('success', 'Update Record Success');
        redirect(site_url('kelola_barang_masuk'));
    }

    public function delete($id)
    {
        $row = $this->Kelola_barang_masuk_model->get_by_id($id);

        if ($row) {
            $this->Kelola_barang_masuk_model->delete($id);
            $this->session->set_flashdata('success', 'Delete Record Success');
            redirect(site_url('kelola_barang_masuk'));
        } else {
            $this->session->set_flashdata('error', 'Record Not Found');
            redirect(site_url('kelola_barang_masuk'));
        }
    }

    public function deletebulk()
    {
        $delete = $this->Kelola_barang_masuk_model->deletebulk();
        if ($delete) {
            $this->session->set_flashdata('success', 'Delete Record Success');
        } else {
            $this->session->set_flashdata('error', 'Delete Record failed');
        }
        echo $delete;
    }

    public function _rules()
    {
        $this->form_validation->set_rules('id_user', 'id user', 'trim|required');
        $this->form_validation->set_rules('id_supplier', 'id supplier', 'trim|required');
        $this->form_validation->set_rules('harga_barang', 'harga barang', 'trim|required');
        $this->form_validation->set_rules('jml_barang_masuk', 'jml barang masuk', 'trim|required');
        $this->form_validation->set_rules('tgl_masuk', 'tgl masuk', 'trim|required');

        $this->form_validation->set_rules('id', 'id', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }
}

/* End of file Kelola_barang_masuk.php */
/* Location: ./application/controllers/Kelola_barang_masuk.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2022-06-30 10:22:17 */
/* http://harviacode.com */