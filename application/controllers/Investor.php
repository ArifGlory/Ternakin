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
    var $idInvestor;
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
        if ($userSession['bagian'] != "investor"){
            redirect('Login');
        }
        $this->idInvestor = $userSession['id'];
    }

    function index(){

        $userSession = $this->session->userdata('user');
        $idInvestor = $userSession['id'];
        $proyekDiambil = json_decode($this->curl->simple_get($this->API.'/Proyek/getProyekInvestor/'.$idInvestor));
       // print_r($proyekDiambil['']);
        $data['proyek'] = $proyekDiambil;

        $this->load->view("header");
        $this->load->view("investor/dashboard_investor",$data);
        $this->load->view("footer");
    }

    function detailProyek($idProyek){
        $proyek = json_decode($this->curl->simple_get($this->API.'/Proyek/detailProyek/'.$idProyek));
        $data['proyek'] = $proyek;

        $this->load->view("header");
        $this->load->view("investor/detail_proyek_investor",$data);
        $this->load->view("footer");
    }

    function wallet(){

        $idInvestor = $this->idInvestor;
        $data['wallet'] = json_decode($this->curl->simple_get($this->API.'/Investor/getWalletInvestor/'.$idInvestor));

        $this->load->view("header");
        $this->load->view("investor/wallet_investor",$data);
        $this->load->view("footer");
    }

    function topUp(){
        $this->load->view("header");
        $this->load->view("investor/topup_saldo");
        $this->load->view("footer");
    }

    function prosesTopUp(){
        $jml_topUp = preg_replace("/[^0-9]/", "", $this->input ->post('txt_jmltoptup'));
        $jml_topUp = (int)$jml_topUp;
        $kodeUnik = (rand(10,100));
        $totalTopUp = 0;
        $totalTopUp = $jml_topUp + $kodeUnik;

        $dataTopUp = array(
          'idTopup'=>chr(rand(65,90)).chr(rand(65,90)).rand(10,100).rand(10,100),
            'kodeUnik'=>$kodeUnik,
            'jmlTopup'=>$totalTopUp,
            'tanggal_topup'=>date('Y-m-d H:i:s'),
            'status'=>0,
            'idInvestor'=>$this->idInvestor

        );

        $this->curl->simple_post($this->API.'/Investor/prosesSimpanTopUp', $dataTopUp, array(CURLOPT_BUFFERSIZE => 10));

        $data['totalTopUp'] = $totalTopUp;


        $this->load->view("header");
        $this->load->view("investor/topup_saldo_next",$data);
        $this->load->view("footer");
    }

    function detailTopUp($idTopup){

        $data['topup'] = json_decode($this->curl->simple_get($this->API.'/Investor/detailTopUp/'.$idTopup));

        $this->load->view("header");
        $this->load->view("investor/detail_topup",$data);
        $this->load->view("footer");
    }

    function lakukanInvestasi(){

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


        $this->load->view("header");
        $this->load->view("berhasil_invest");
        $this->load->view("footer");
    }



}