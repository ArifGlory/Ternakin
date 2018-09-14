<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: Glory
 * Date: 14/03/2018
 * Time: 8:25
 */
class Investor extends CI_Controller
{
    var $gallerypath;
    function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form'));
        $this->load->library(array('form_validation','session','encryption','pagination'));
        $this->load->model('m_proyek');
        $this->load->model('m_akun');

        if ($this->session->userdata("status") != "login"){
            redirect('Login/loginInvestor');
        }
        if ($this->session->userdata("status") != "login" && $this->session->userdata("bagian") != "investor"){
            redirect('Login/loginInvestor');
        }
    }

    function index(){
        $id = $this->session->userdata("id");
        $nama = $this->session->userdata("nama");
        $bagian = $this->session->userdata("bagian");
        $data["id"] = $id;
        $data["nama"] = $nama;
        $data["bagian"] = $bagian;

        $this->load->view("header",$data);
        $this->load->view("dashboard_investor",$data);
        $this->load->view("footer");
    }

    function lakukanInvestasi(){
        $id = $this->session->userdata("id");
        $nama = $this->session->userdata("nama");
        $bagian = $this->session->userdata("bagian");
        $data["id"] = $id;
        $data["nama"] = $nama;
        $data["bagian"] = $bagian;

        $id_proyek = $this->input->post('txt_id_proyek');

        $this->form_validation->set_rules('txt_invest','Jumlah Investasi','required');

        if ($this->form_validation->run() != false){
            $jml_invest = $this->input->post('txt_invest');
            $proyek = $this->m_proyek->getDetailProyek($id_proyek)->row_array();
            $investor  = $this->m_akun->getDetailInvestor()->row_array();
            $id_investor = $investor['idInvestor'];
            $saldo_investor = $investor['saldo_wallet'];
            $saldo_proyek = $proyek['saldo_proyek'];

            $saldo_proyek = $saldo_proyek +$jml_invest;
            $saldo_investor = $saldo_investor - $jml_invest;
            //ubah dana
            $data_saldoProyek = array(
                'saldo_proyek'=>$saldo_proyek
            );

            $data_saldo_investor = array(
                'saldo_investor'=>$saldo_investor
            );

            $this->db->where('id',$id_proyek);
            $this->db->update('proyek',$data_saldoProyek);

            //update saldo investor
            $this->db->where('idInvestor',$id_investor);
            $this->db->update('investor',$data_saldo_investor);

            redirect('Investor/berhasilInvest');

        }else{
            $id = $this->session->userdata("id");
            $nama = $this->session->userdata("nama");
            $bagian = $this->session->userdata("bagian");
            $data["id"] = $id;
            $data["nama"] = $nama;
            $data["bagian"] = $bagian;

            $proyek = $this->m_proyek->getDetailProyek($id_proyek)->row_array();
            $id_peternak = $proyek['idPeternak'];
            $peternak = $this->m_akun->getDetailPeternak($id_peternak)->row_array();
            $data['proyek'] = $proyek;
            $data['nama_peternak'] = $peternak['namaPeternak'];

            $this->load->view("header",$data);
            $this->load->view("detail_proyek",$data);
            $this->load->view("footer");
        }
    }

    function berhasilInvest(){
        $id = $this->session->userdata("id");
        $nama = $this->session->userdata("nama");
        $bagian = $this->session->userdata("bagian");
        $data["id"] = $id;
        $data["nama"] = $nama;
        $data["bagian"] = $bagian;

        $this->load->view("header",$data);
        $this->load->view("berhasil_invest",$data);
        $this->load->view("footer");
    }



}