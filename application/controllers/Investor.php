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
    var $saldoInvestor;
    var $namaInvestor;
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
            redirect('Login/loginInvestor');
        }
        $this->idInvestor = $userSession['id'];
        $this->saldoInvestor = $userSession['saldo'];
        $this->namaInvestor = $userSession['nama'];
    }

    function index(){

        $userSession = $this->session->userdata('user');
        $idInvestor = $userSession['id'];
        $proyekDiambil = json_decode($this->curl->simple_get($this->API.'/Proyek/getProyekInvestor/'.$idInvestor));
      ///  print_r($proyekDiambil);
        $data['proyek'] = $proyekDiambil;

        $this->load->view("header");
        $this->load->view("investor/dashboard_investor",$data);
        $this->load->view("footer");
    }

    function detailProyek($idProyek){
        $proyek = json_decode($this->curl->simple_get($this->API.'/Proyek/detailProyek/'.$idProyek));
        $data['proyek'] = $proyek;
        $jml_data =  json_decode($this->curl->simple_get($this->API.'/Proyek/getJmlInvestor/'.$idProyek));

        $data['jmlInvestor'] = $jml_data;

        $data['gambar'] = json_decode($this->curl->simple_get($this->API.'/Proyek/getImgProyekByID/'.$idProyek));
        $data['gambar_utama'] = json_decode($this->curl->simple_get($this->API.'/Proyek/getImgUtamaProyekByID/'.$idProyek));

        $saldoProyek = $proyek[0]->saldo_proyek;
        $targetDana = $proyek[0]->target_dana;
        $persentase = ($saldoProyek / $targetDana) * 100;
        $data['persentase'] = $persentase;

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

    function lakukanInvestasi($idProyek){

        $proyek = json_decode($this->curl->simple_get($this->API.'/Proyek/detailProyek/'.$idProyek));
        $data['proyek'] = $proyek;
        foreach ($proyek as $b){
            $idPeternak = $b->idPeternak;
        }

        $saldoProyek = $proyek[0]->saldo_proyek;
        $targetDana = $proyek[0]->target_dana;
        $persentase = ($saldoProyek / $targetDana) * 100;


        $peternak = json_decode($this->curl->simple_get($this->API.'/Peternak/detailPeternak/'.$idPeternak));
        $data['peternak'] = $peternak;
        $data['gambar'] = json_decode($this->curl->simple_get($this->API.'/Proyek/getImgProyekByID/'.$idProyek));
        $data['gambar_utama'] = json_decode($this->curl->simple_get($this->API.'/Proyek/getImgUtamaProyekByID/'.$idProyek));
        $data['persentase'] = $persentase;

        $this->load->view("header");
        $this->load->view("investor/lakukan_investasi",$data);
        $this->load->view("footer");

    }

    function simpanInvestasi(){
        $user = $this->session->userdata('user');
        $jmlInvest = $this->input->post('txt_jmlInvest');
        $jmlInvest = (int) $jmlInvest;
        $saldoInvestor = (int) $this->saldoInvestor;
        $idProyek = $this->input->post('txt_id');
        $idInvestor = $this->idInvestor;
        $proyek = json_decode($this->curl->simple_get($this->API.'/Proyek/detailProyek/'.$idProyek));
        foreach ($proyek as $b){
            $namaProyek = $b->namaProyek;
            $saldoProyekNow = (int) $b->saldo_proyek;
            $targetDana = $b->target_dana;
        }
        $saldoAfter = $saldoProyekNow + $jmlInvest;
        $targetDana = (int) $targetDana;
        if ($jmlInvest > $saldoInvestor){
            $this->session->set_flashdata('error','Saldo tidak cukup');
            redirect('Investor/lakukanInvestasi/'.$idProyek);
        }else if ($saldoAfter > $targetDana){
            $this->session->set_flashdata('warning','Investasi melebihi batas');
            redirect('Investor/lakukanInvestasi/'.$idProyek);
        }
        else {

            $dataInvestasi = array(
                'idDetailInvestasi'=>chr(rand(65,90)).chr(rand(65,90)).rand(10,100).rand(10,100),
              'jml_invest'=>$jmlInvest,
                'idInvestor'=>$idInvestor,
                'id_proyek'=>$idProyek,
                'namaInvestor'=>$this->namaInvestor,
                'namaProyek'=>$namaProyek,
                'returnInvest'=>0
            );



            $this->curl->simple_post($this->API.'/Investor/prosesSimpanInvestasi', $dataInvestasi, array(CURLOPT_BUFFERSIZE => 10));
            //update session saldo
            $saldoUpdate = $saldoInvestor - $jmlInvest;
            $user['saldo'] = $saldoUpdate;
            $this->session->set_userdata('user', $user);
            redirect('Investor/berhasilInvest');

        }
    }


    function berhasilInvest(){

        $this->load->view("header");
        $this->load->view("berhasil_invest");
        $this->load->view("footer");
    }



}