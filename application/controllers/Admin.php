<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: Glory
 * Date: 14/03/2018
 * Time: 8:25
 */
class Admin extends CI_Controller
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

        $userSession = $this->session->userdata('admin');
        if ($userSession['bagian'] != "admin"){
            redirect('Login');
        }
    }

    function index(){


        $data["jml_proyek"] = 0;
        $data['jml_investor'] = 0;
        $data['jml_peternak'] = 0;

        $this->load->view("admin/header_admin");
        $this->load->view("admin/sidebar_admin");
        $this->load->view("admin/dashboard_admin",$data);
    }

    function listWaiting(){

        $data['waiting'] = json_decode($this->curl->simple_get($this->API.'/Proyek/listWaiting/'));

        $this->load->view("admin/header_admin");
        $this->load->view("admin/sidebar_admin");
        $this->load->view("admin/list_data_waiting",$data);
    }

    function listProyek(){


        $data['proyek'] = json_decode($this->curl->simple_get($this->API.'/Proyek/listProyek/'));

        $this->load->view("admin/header_admin");
        $this->load->view("admin/sidebar_admin");
        $this->load->view("admin/list_data_proyek",$data);
    }

    function detailProyek($id_proyek){


        $proyek = json_decode($this->curl->simple_get($this->API.'/Proyek/detailProyek/'.$id_proyek));
        $data['proyek'] = $proyek;
        foreach ($proyek as $b){
            $idPeternak = $b->idPeternak;
            $status = $b->status;
            $investor = $b->jml_investor;
            $foto = $b->foto_usaha;
        }

        $peternak = json_decode($this->curl->simple_get($this->API.'/Peternak/detailPeternak/'.$idPeternak));
        $data['peternak'] = $peternak;
        $data['status'] = $status;
        $data['jml_investor'] = $investor;
        $data['foto_usaha'] = $foto;

        $this->load->view("admin/header_admin");
        $this->load->view("admin/sidebar_admin");
        $this->load->view("admin/detail_proyek",$data);
    }

    function tesadmin(){
        $last_row = $this->m_proyek->getLastRow();
        print_r($last_row[0]->id);
    }

    function lakukanVerifikasi(){
        $id = $this->session->userdata("id");
        $nama = $this->session->userdata("nama");
        $bagian = $this->session->userdata("bagian");
        $data["id"] = $id;
        $data["nama"] = $nama;
        $data["bagian"] = $bagian;
        $id_temporary = $this->input->post('txt_id_temp');

        $this->form_validation->set_rules('txt_estimasi','Estimasi proyek','required');

        if ($this->form_validation->run() != false) {

            $id_temporary = $this->input->post('txt_id_temp');
            $estimasi = $this->input->post('txt_estimasi');
            $temporary = $this->m_proyek->getDetailWaiting($id_temporary)->row_array();

            $this->db->insert('proyek', $temporary);
            $last_row = $this->m_proyek->getLastRow();
            $akir = $last_row[0]->id;

            $data_ubah = array(
                'estimasi_profit' => $estimasi
            );

            //buat mengupdate
            $this->db->where('id', $akir);
            $this->db->update('proyek', $data_ubah);

            //buat menghapus
            $this->db->where('id', $id_temporary);
            $this->db->delete('temporary');

            redirect('Admin/listWaiting');
        }else{
            $id = $this->session->userdata("id");
            $nama = $this->session->userdata("nama");
            $bagian = $this->session->userdata("bagian");
            $data["id"] = $id;
            $data["nama"] = $nama;
            $data["bagian"] = $bagian;

            $temporary  = $this->m_proyek->getDetailWaiting($id_temporary)->row_array();

            $data['temporary'] = $temporary;

            $this->load->view("admin/header_admin",$data);
            $this->load->view("admin/sidebar_admin",$data);
            echo "Ada data yang belum diisi !";
            $this->load->view("admin/detail_waiting");
        }
    }

    function tolakVerifikasi(){
        $id = $this->session->userdata("id");
        $nama = $this->session->userdata("nama");
        $bagian = $this->session->userdata("bagian");
        $data["id"] = $id;
        $data["nama"] = $nama;
        $data["bagian"] = $bagian;
        $id_temporary = $this->input->post('txt_id_temp');

        $this->form_validation->set_rules('txt_alasan','Alasan Menolak','required');

        if ($this->form_validation->run() != false) {

            $alasan = $this->input->post('txt_alasan');

            $this->db->where('id',$id_temporary);
            $this->db->delete('temporary');
            redirect('Admin/listWaiting');

        }else{
            $id = $this->session->userdata("id");
            $nama = $this->session->userdata("nama");
            $bagian = $this->session->userdata("bagian");
            $data["id"] = $id;
            $data["nama"] = $nama;
            $data["bagian"] = $bagian;

            $temporary  = $this->m_proyek->getDetailWaiting($id_temporary)->row_array();

            $data['temporary'] = $temporary;

            $this->load->view("admin/header_admin",$data);
            $this->load->view("admin/sidebar_admin",$data);
            echo "Ada data yang belum diisi !";
            $this->load->view("admin/detail_waiting");
        }



    }

}