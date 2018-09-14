<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: Glory
 * Date: 14/03/2018
 * Time: 8:24
 */
class Login extends CI_Controller
{
    var $gallerypath;
    function __construct()
    {
        parent::__construct();
        $this->load->helper(array('url','form'));
        $this->load->library(array('session','encryption'));
        $this->API="http://localhost/rest_ci/";
        $this->load->library('curl');
        $this->load->helper(array('url'));
    }

    function index(){

       $this->load->view("header");
        $this->load->view("login_peternak");
        $this->load->view("footer");
    }

    function loginPeternak(){

        $this->load->view("header");
        $this->load->view("login_peternak");
        $this->load->view("footer");

    }

    function loginInvestor(){

        $this->load->view("header");
        $this->load->view("login_investor");
        $this->load->view("footer");
    }

    function loginAdmin(){


        $this->load->view("header");
        $this->load->view("login_admin");
        $this->load->view("footer");
    }

    function gagalAdmin(){

        $this->load->view("header");
        $this->load->view("gagal_admin");
        $this->load->view("footer");
    }

    function gagalPeternak(){

        $this->load->view("header");
        $this->load->view("gagal_peternak");
        $this->load->view("footer");
    }

    function gagalInvestor(){

        $this->load->view("header");
        $this->load->view("gagal_investor");
        $this->load->view("footer");
    }

    function signInAdmin(){

        $id = $this->input->post("txt_id");
        $pass = $this->input->post("txt_pass");

        $check =  json_decode($this->curl->simple_get($this->API.'/Login/getCheckAdmin/'.$id));
        $dataAdmin = json_decode($this->curl->simple_get($this->API.'/Login/getDataAdmin/'.$id));
       // print_r($check);

        if ($check != 0){
            $pass_didb = $this->encryption->decrypt($dataAdmin[0]->password);

            if ($pass_didb == $pass){
                $data_session = array(
                    'id'=>$dataAdmin[0]->id,
                    'nama'=>$dataAdmin[0]->username,
                    'bagian'=>"admin"
                );
                $this->session->set_userdata('admin',$data_session);
                redirect('Admin');
            }else{
                redirect('Login/gagalAdmin');
            }

        }

        else{
          redirect('Login/gagalAdmin');
        }

    }

    function signInPeternak(){

        $id = $this->input->post("txt_id");
        $pass = $this->input->post("txt_pass");

        $dataEmail = array(
          'email'=>$id
        );

        $check =  $this->curl->simple_post($this->API.'/Login/getCheckPeternak', $dataEmail, array(CURLOPT_BUFFERSIZE => 10));
        $dataPeternak = json_decode($this->curl->simple_post($this->API.'/Login/getDataPeternak', $dataEmail, array(CURLOPT_BUFFERSIZE => 10)));


        if ($check != 0){
            $pass_didb = $this->encryption->decrypt($dataPeternak[0]->password);

            if ($pass_didb == $pass){
                $data_session = array(
                    'id'=>$dataPeternak[0]->idPeternak,
                    'nama'=>$dataPeternak[0]->namaPeternak,
                    'bagian'=>"peternak"
                );
                $this->session->set_userdata('user',$data_session);
                redirect('Peternak');

            }else{
                redirect('Login/gagalPeternak');
            }

        }else{
            redirect('Login/gagalPeternak');
        }

    }

    function signInInvestor(){

        $id = $this->input->post("txt_id");
        $pass = $this->input->post("txt_pass");

        $cek = $this->db->get_where('investor',array('email'=>$id))->num_rows();
        $result = $this->db->get_where('investor',array('email'=>$id))->result();

        if ($cek != 0){
            $pass_didb = $this->encryption->decrypt($result[0]->password);

            if ($pass_didb == $pass){
                $data_session = array(
                    'id'=>$result[0]->idInvestor,
                    'nama'=>$result[0]->namaInvestor,
                    'status'=>"login",
                    'bagian'=>"investor"
                );
                $this->session->set_userdata($data_session);
                redirect('Utama/listProyek');
            }else{
                redirect('Login/gagalInvestor');
            }

        }else{
            redirect('Login/gagalInvestor');
        }
    }

    function logout(){
        $this->session->sess_destroy();
        redirect('Login');
    }



}