<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: Glory
 * Date: 14/03/2018
 * Time: 8:25
 */
class Peternak extends CI_Controller
{
    var $gallerypath;
    function __construct()
    {
        parent::__construct();
        $this->API="http://localhost/rest_ci/";
        $this->load->library('curl');
        $this->load->helper(array('url'));
        $this->load->helper(array('form'));
        $this->load->library(array('form_validation','session','encryption','pagination'));

        $userSession = $this->session->userdata('user');
        if ($userSession['bagian'] != "peternak"){
            redirect('Login');
        }
    }

    function index(){
        $userSession = $this->session->userdata('user');
        $idPeternak = $userSession['id'];
        $data['proyek'] = json_decode($this->curl->simple_get($this->API.'/Proyek/getProyekPeternak/'.$idPeternak));

        $this->load->view("header");
        $this->load->view("peternak/dashboard_peternak",$data);
        $this->load->view("footer");
    }

    function buatProyek(){

        $this->load->view("header");
        $this->load->view("peternak/buat_proyek");
        $this->load->view("footer");
    }

    function listProyekPeternak(){

        $jml_data = $this->m_proyek->getJumlahProyekPeternak();
        $this->load->library('pagination');
        $config['base_url'] = base_url().'/Peternak/listProyekPeternak';
        $config['total_rows'] = $jml_data;
        $config['per_page'] = 9;
        $from = $this->uri->segment(3);
        $this->pagination->initialize($config);
        $data['data_proyek'] = $this->m_proyek->getProyekPeternak($config['per_page'],$from);

        $this->load->view("header",$data);
        $this->load->view("list_proyek_peternak",$data);
        $this->load->view("footer");
    }

    function detailProyek($id_proyek){

        $proyek = json_decode($this->curl->simple_get($this->API.'/Proyek/detailProyek/'.$id_proyek));
        $data['proyek'] = $proyek;
        $investor = array();
        $data['investor'] = $investor;

        $this->load->view("header");
        $this->load->view("peternak/detail_proyek_peternak",$data);
        $this->load->view("footer");
    }

    function simpanProyek(){

            $nmfile = "file_".time();
            $this->gallerypath = realpath(APPPATH.'../foto');

        $this->form_validation->set_rules('txt_name','Nama','required');
        $this->form_validation->set_rules('txt_targetdana','Target Dana','required');
        $this->form_validation->set_rules('txt_minimaldana','Minimal dana','required');
        $this->form_validation->set_rules('txt_lokasi','Lokasi Proyek','required');
        $this->form_validation->set_rules('txt_deskripsi','Deskripsi','required');
        $this->form_validation->set_rules('txt_mulai','Waktu Mulai Proyek','required');
        $this->form_validation->set_rules('txt_akhir','Waktu Akhir Proyek','required');
        $this->form_validation->set_rules('txt_batasgalang','Waktu batas Galang dana','required');
        $this->form_validation->set_rules('txt_kategori','Kategori proyek','required');


            if ($this->form_validation->run() != false) {

                $config['upload_path'] = $this->gallerypath;
                $config['allowed_types'] = 'jpg|png|jpeg';
                $config['max_size'] = 10000;
                $config['max_width'] = 5000;
                $config['max_height'] = 5000;
                $config['file_name'] = $nmfile;
                $this->load->library('upload',$config);
                $this->upload->do_upload('img_siup');
                $foto_siup = $this->upload->file_name;

                $config2['upload_path'] = $this->gallerypath;
                $config2['allowed_types'] = 'jpg|png|jpeg';
                $config2['max_size'] = 10000;
                $config2['max_width'] = 5000;
                $config2['max_height'] = 5000;
                $config2['file_name'] = $nmfile;
                $this->load->library('upload',$config2);
                $this->upload->do_upload('img_usaha');
                $foto_usaha = $this->upload->file_name;

                $data_proyek = array(
                  'namaProyek'=>$this->input->post('txt_name'),
                    'target_dana'=>$this->input->post('txt_targetdana'),
                    'minimal_dana'=>$this->input->post('txt_minimaldana'),
                    'lokasi'=>$this->input->post('txt_lokasi'),
                    'deskripsi'=>$this->input->post('txt_deskripsi'),
                    'batas_galang'=>$this->input->post('txt_batasgalang'),
                    'mulai_proyek'=>$this->input->post('txt_mulai'),
                    'akhir_proyek'=>$this->input->post('txt_akhir'),
                    'kategori'=>$this->input->post('txt_kategori'),
                    'foto_siup'=>$foto_siup,
                    'foto_usaha'=>$foto_usaha,
                    'saldo_proyek'=>0,
                    'jml_investor'=>0,
                    'idPeternak'=>$this->session->userdata("id"),
                    'estimasi_profit'=>0
                );
                $this->db->insert('temporary',$data_proyek);
                redirect('Peternak/berhasilProyek');

                //print_r($data_proyek);
            }else{
                $id = $this->session->userdata("id");
                $nama = $this->session->userdata("nama");
                $bagian = $this->session->userdata("bagian");
                $data["id"] = $id;
                $data["nama"] = $nama;
                $data["bagian"] = $bagian;

                $this->load->view("header",$data);
                $this->load->view("peternak/buat_proyek",$data);
                $this->load->view("footer");
            }

    }


    function walletPeternak(){

    }

    function berhasilProyek(){

        $this->load->view("header",$data);
        $this->load->view("peternak/berhasil_proyek",$data);
        $this->load->view("footer");
    }



}