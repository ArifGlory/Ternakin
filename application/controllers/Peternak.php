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
        $investor = json_decode($this->curl->simple_get($this->API.'/Peternak/getInvestorDiProyek/'.$id_proyek));
        $data['investor'] = $investor;
        $data['gambar'] = json_decode($this->curl->simple_get($this->API.'/Proyek/getImgProyekByID/'.$id_proyek));
        $data['gambar_utama'] = json_decode($this->curl->simple_get($this->API.'/Proyek/getImgUtamaProyekByID/'.$id_proyek));

        $jml_data =  json_decode($this->curl->simple_get($this->API.'/Proyek/getJmlInvestor/'.$id_proyek));

        $data['jmlInvestor'] = $jml_data;

        $saldoProyek = $proyek[0]->saldo_proyek;
        $targetDana = $proyek[0]->target_dana;
        $persentase = ($saldoProyek / $targetDana) * 100;
        $data['persentase'] = $persentase;

        $this->load->view("header");
        $this->load->view("peternak/detail_proyek_peternak",$data);
        $this->load->view("footer");
    }

    function simpanProyek(){

        $user = $this->session->userdata('user');
        $idProyek =chr(rand(65,90)).chr(rand(65,90)).rand(10,100).rand(10,100);
        $nmfile = "file_".time();
            $this->gallerypath = realpath(APPPATH.'../foto');

                $config['upload_path'] = $this->gallerypath;
                $config['allowed_types'] = 'jpg|png|jpeg';
                $config['max_size'] = 10000;
                $config['max_width'] = 5000;
                $config['max_height'] = 5000;
                $config['file_name'] = $nmfile;
                $this->load->library('upload',$config);
                $this->upload->do_upload('img_siup');
                $foto_siup = $this->upload->file_name;

                $data_proyek = array(
                    'id_proyek'=>$idProyek,
                  'namaProyek'=>$this->input->post('txt_name'),
                    'target_dana'=>preg_replace("/[^0-9]/", "", $this->input ->post('txt_targetdana')),
                    'lokasi'=>$this->input->post('txt_lokasi'),
                    'deskripsi'=>$this->input->post('txt_deskripsi'),
                    'batas_galang'=>$this->input->post('txt_batasgalang'),
                    'mulai_proyek'=>$this->input->post('txt_mulai'),
                    'akhir_proyek'=>$this->input->post('txt_akhir'),
                    'kategori'=>$this->input->post('txt_kategori'),
                    'hasil_ternak'=>$this->input->post('txt_hasil_ternak'),
                    'foto_siup'=>$foto_siup,
                    'saldo_proyek'=>0,
                    'jml_investor'=>0,
                    'status'=>0,
                    'idPeternak'=>$user['id'],
                    'estimasi'=>$this->input->post('txt_estimasi'),
                    'keuntungan'=>0
                );

               // $this->db->insert('proyek',$data_proyek);
        $result =   $this->curl->simple_post($this->API.'/Proyek/prosesSimpanProyek', $data_proyek, array(CURLOPT_BUFFERSIZE => 10));
        if ($result) {
            echo "berhasil upload proyek";
        } else {
            echo "gagal upload proyek";
        }
                // print_r($data_proyek);

                $ses_id_proyek = array(
                    'idProyek' => $idProyek
                );
                $this->session->set_userdata('idProyek',$ses_id_proyek);
                redirect('Peternak/inputGambarProyek');

    }

    function inputGambarProyek(){
        $this->load->view("header");
        $this->load->view("peternak/upload_foto_proyek");
        $this->load->view("footer");
    }


    function walletPeternak(){

    }

    function berhasilProyek(){

        $this->load->view("header");
        $this->load->view("peternak/berhasil_proyek");
        $this->load->view("footer");
    }



}