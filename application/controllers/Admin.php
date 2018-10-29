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

        $jmlProyek =  json_decode($this->curl->simple_get($this->API.'/Proyek/jmlListProyek/'));

        $data["jml_proyek"] = $jmlProyek;
        $data['jml_investor'] = json_decode($this->curl->simple_get($this->API.'/Akun/getJmLInvestor/'));;
        $data['jml_peternak'] = json_decode($this->curl->simple_get($this->API.'/Akun/getJmLPeternak/'));;;

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
        $data['tanggalNow'] = date('Y-m-d H:i:s');

        $this->load->view("admin/header_admin");
        $this->load->view("admin/sidebar_admin");
        $this->load->view("admin/list_data_proyek",$data);
    }

    function listProyekSelesai(){
        $data['proyek'] = json_decode($this->curl->simple_get($this->API.'/Proyek/listProyekSelesai/'));
        $data['tanggalNow'] = date('Y-m-d H:i:s');

        $this->load->view("admin/header_admin");
        $this->load->view("admin/sidebar_admin");
        $this->load->view("admin/list_data_proyek",$data);
    }

    function detailProyek($id_proyek){


        $proyek = json_decode($this->curl->simple_get($this->API.'/Proyek/detailProyek/'.$id_proyek));
        $data['proyek'] = $proyek;
        $data['gambar_utama'] = json_decode($this->curl->simple_get($this->API.'/Proyek/getImgUtamaProyekByID/'.$id_proyek));
        foreach ($proyek as $b){
            $idPeternak = $b->idPeternak;
            $status = $b->status;
            $id_proyek = $b->id_proyek;
        }
        $investor = json_decode($this->curl->simple_get($this->API.'/Peternak/getInvestorDiProyek/'.$id_proyek));
        $data['investor'] = $investor;

        $jml_data =  json_decode($this->curl->simple_get($this->API.'/Proyek/getJmlInvestor/'.$id_proyek));

        $data['jmlInvestor'] = $jml_data;

        $peternak = json_decode($this->curl->simple_get($this->API.'/Peternak/detailPeternak/'.$idPeternak));
        $data['peternak'] = $peternak;
        $data['status'] = $status;

        $data['id_proyek'] = $id_proyek;

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


    function terimaProyek($id_proyek){
        $dataUbah = array(
            'status'=>1
        );
        $dataProyek = array(
          'idProyek'=>$id_proyek
        );
        /*
        $this->db->where('id_proyek',$id_proyek);
        $this->db->update("proyek",$dataUbah);
        return $this->db->affected_rows();*/

       $result = $this->curl->simple_post($this->API.'/Proyek/terimaVerifikasi', $dataProyek, array(CURLOPT_BUFFERSIZE => 10));
          // print_r($dataProyek['idProyek']);

         if ($result) {
            echo "berhasil ubah status";
        } else {
            echo "gagal ubah status";
        }

       redirect('Admin/listProyek');


    }

    function ubahStatusProyek(){
        $status = $this->input->post('combobx_ubahStatusProyek');
        $idProyek = $this->input->post('txt_id');

        if ($status == "4"){
            redirect('Admin/proyekBerakhir/'.$idProyek);
        }else {


            $dataUpdateStatus = array(
                'status' => $status,
                'idProyek' => $idProyek
            );

            $result = $this->curl->simple_post($this->API . '/Proyek/ubahStatusProyek', $dataUpdateStatus, array(CURLOPT_BUFFERSIZE => 10));
            // print_r($dataProyek['idProyek']);

            if ($result) {
                echo "berhasil ubah status";
            } else {
                echo "gagal ubah status";
            }

            redirect('Admin/detailProyek/' . $idProyek);
        }
    }

    function proyekBerakhir($idProyek){

        $data['idProyek'] = $idProyek;

        $this->load->view("admin/header_admin");
        $this->load->view("admin/sidebar_admin");
        $this->load->view("admin/input_keuntungan_proyek",$data);
    }

    function simpanProyekBerakhir(){
        $idProyek = $this->input->post('txt_id');
        $keuntungan = $this->input->post('txt_untungProyek');

        $dataProyekBerakhir = array(
          'idProyek'=>$idProyek,
            'keuntungan'=>$keuntungan
        );

        $result = $this->curl->simple_post($this->API.'/Proyek/proyekBerakhir', $dataProyekBerakhir, array(CURLOPT_BUFFERSIZE => 10));

        if ($result) {
            echo "berhasil ubah status";
        } else {
            echo "gagal ubah status";
        }

        //tambahin email juga kalo projek telah berakhir
        redirect('Admin/detailProyek/'.$idProyek);

    }

    function tolakProyek($id_proyek){
        $dataProyek = array(
            'idProyek'=>$id_proyek
        );

        $result = $this->curl->simple_post($this->API.'/Proyek/tolakVerifikasi', $dataProyek, array(CURLOPT_BUFFERSIZE => 10));

        if ($result) {
            echo "berhasil ubah status";
        } else {
            echo "gagal ubah status";
        }

        redirect('Admin/listWaiting');
    }

    function detailPeternak($idPeternak){
        $data['peternak'] = json_decode($this->curl->simple_get($this->API.'/Peternak/detailPeternak/'.$idPeternak));

        $this->load->view("admin/header_admin");
        $this->load->view("admin/sidebar_admin");
        $this->load->view("admin/detail_peternak",$data);
    }

    function listTopup(){
        $data['topup'] = json_decode($this->curl->simple_get($this->API.'/Investor/listTopupUnverifyAdmin/'));
        $data['verified'] = "false";

        $this->load->view("admin/header_admin");
        $this->load->view("admin/sidebar_admin");
        $this->load->view("admin/list_data_topup",$data);
    }

    function listTopupVerified(){
        $data['topup'] = json_decode($this->curl->simple_get($this->API.'/Investor/listTopupVerifyAdmin/'));
        $data['verified'] = "true";

        $this->load->view("admin/header_admin");
        $this->load->view("admin/sidebar_admin");
        $this->load->view("admin/list_data_topup",$data);
    }

    function detailTopup($idTopup){

        $topup = json_decode($this->curl->simple_get($this->API.'/Investor/detailTopup/'.$idTopup));

        $data['topup'] = json_decode($this->curl->simple_get($this->API.'/Investor/detailTopup/'.$idTopup));
        $idInvestor = $topup[0]->idInvestor;
        $data['investor'] = json_decode($this->curl->simple_get($this->API.'/Investor/detailInvestor/'.$idInvestor));

        $this->load->view("admin/header_admin");
        $this->load->view("admin/sidebar_admin");
        $this->load->view("admin/detail_topup_admin",$data);
    }

    function terimaTopup($idTopup){
        $topup = json_decode($this->curl->simple_get($this->API.'/Investor/detailTopup/'.$idTopup));

        $data['topup'] = $topup;
        $idInvestor = $topup[0]->idInvestor;
        $saldoTopup = $topup[0]->jmlTopup;
        $investor = json_decode($this->curl->simple_get($this->API.'/Investor/detailInvestor/'.$idInvestor));
        $namaInvestor = $investor[0]->namaInvestor;
        $emailInvestor = $investor[0]->email;


        $dataTopup = array(
            'idTopup'=>$idTopup,
            'idInvestor'=>$idInvestor,
            'saldoTopup'=>$saldoTopup
        );

        $result = $this->curl->simple_post($this->API.'/Investor/terimaTopup', $dataTopup, array(CURLOPT_BUFFERSIZE => 10));

        if ($result) {
            echo "berhasil ubah status";
        } else {
            echo "gagal ubah status";
        }

         //kriim notifikasi Email.

        $data['namaInvestor'] = $namaInvestor;

        $notif = $this->load->view('invoice_new',$data,TRUE);

        $config['protocol'] = "smtp";
        $config['smtp_host'] = "ssl://smtp.gmail.com";
        $config['smtp_port'] = "465";
        $config['smtp_user'] = "tapisdev@gmail.com";
        $config['smtp_pass'] = "t4p15d3v";
        $config['charset'] = "utf-8";
        $config['mailtype'] = "html";
        $config['newline'] = "\r\n";

        $this->load->library('email');
        $this->email->initialize($config);

        $from_email = "tapisdev@gmail.com";
        //$emailInvestor= 'arifglory46@gmail.com' ;

        $this->email->from($from_email,"Admin Ternak.in");
        $this->email->to($emailInvestor);
        $this->email->subject('Verifikasi Topup');
        $this->email->message($notif);
        $this->email->send();
        $this->load->view('invoice_new',$data);

        redirect('Admin/listTopupVerified');
    }

    function tolakTopup($idTopup){

        $dataTopupHapus = array(
            'idTopup'=>$idTopup
        );

        $topup = json_decode($this->curl->simple_get($this->API.'/Investor/detailTopup/'.$idTopup));

        $data['topup'] = $topup;
        $idInvestor = $topup[0]->idInvestor;
        $saldoTopup = $topup[0]->jmlTopup;
        $investor = json_decode($this->curl->simple_get($this->API.'/Investor/detailInvestor/'.$idInvestor));
        $namaInvestor = $investor[0]->namaInvestor;
        $emailInvestor = $investor[0]->email;


        $dataTopup = array(
            'idTopup'=>$idTopup,
            'idInvestor'=>$idInvestor,
            'saldoTopup'=>$saldoTopup
        );

        $result = $this->curl->simple_post($this->API.'/Investor/tolakTopup', $dataTopupHapus, array(CURLOPT_BUFFERSIZE => 10));

        if ($result) {
            echo "berhasil ubah status";
        } else {
            echo "gagal ubah status";
        }

        $data['namaInvestor'] = $namaInvestor;

        $notif = $this->load->view('invoice_tolak',$data,TRUE);

        $config['protocol'] = "smtp";
        $config['smtp_host'] = "ssl://smtp.gmail.com";
        $config['smtp_port'] = "465";
        $config['smtp_user'] = "tapisdev@gmail.com";
        $config['smtp_pass'] = "t4p15d3v";
        $config['charset'] = "utf-8";
        $config['mailtype'] = "html";
        $config['newline'] = "\r\n";

        $this->load->library('email');
        $this->email->initialize($config);

        $from_email = "tapisdev@gmail.com";
        //$emailInvestor= 'arifglory46@gmail.com' ;

        $this->email->from($from_email,"Admin Ternak.in");
        $this->email->to($emailInvestor);
        $this->email->subject('Verifikasi Topup');
        $this->email->message($notif);
        $this->email->send();
        $this->load->view('invoice_tolak',$data);

        redirect('Admin/listTopup');
    }



}