<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: Glory
 * Date: 14/03/2018
 * Time: 8:21
 */
class Utama extends CI_Controller
{
    var $gallerypath;
    var $API ="";
    function __construct()
    {
        parent::__construct();
        $this->API="http://localhost/rest_ci/";
        $this->load->library('curl');
        $this->load->helper(array('url'));
        $this->load->library(array('form_validation','session','encryption','pagination'));

    }

    function tes(){

        $nmfile = "file_".time();
        $this->gallerypath = realpath(APPPATH.'./foto');

        $config['upload_path'] = $this->gallerypath;
        $config['allowed_types'] = 'jpg|png|jpeg';
        $config['max_size'] = 10000;
        $config['max_width'] = 5000;
        $config['max_height'] = 5000;
        $config['file_name'] = $nmfile;
        $this->load->library('upload',$config);
        $this->upload->do_upload('img-siup');
        $foto_siup = $this->upload->file_name;

        if ( ! $this->upload->do_upload('img-siup')){
            $error = array('error' => $this->upload->display_errors());
            print_r($error);
            print_r("------------------------ \n");
        }else{
            $data = array('upload_data' => $this->upload->data());
            print_r("berhasil");
            print_r($data);
        }


        $tanggal_batasgalang = $this->input->post('txt_batasgalang');
        $tanggal_batasgalang   = date('Y-m-d', strtotime($tanggal_batasgalang));

        $tanggal_mulai = $this->input->post('txt_mulai');
        $tanggal_mulai = date('Y-m-d', strtotime($tanggal_mulai));

        $tanggal_akhir = $this->input->post('txt_akhir');
        $tanggal_akhir = date('Y-m-d', strtotime($tanggal_akhir));


        print_r($foto_siup);
        print_r("   -------------------------- \n");
       // print_r($foto_usaha);
    }

    function tesdua(){
        $this->load->view('tes_login');
    }

    function index(){

        $this->load->view("header");
        $this->load->view("beranda");
        $this->load->view("footer");
    }



    function caraInvestasi(){
        $id = $this->session->userdata("id");
        $nama = $this->session->userdata("nama");
        $bagian = $this->session->userdata("bagian");
        $data["id"] = $id;
        $data["nama"] = $nama;
        $data["bagian"] = $bagian;

        $this->load->view("header",$data);
        $this->load->view("cara_investasi",$data);
        $this->load->view("footer");
    }

    function tentangKami(){
        $id = $this->session->userdata("id");
        $nama = $this->session->userdata("nama");
        $bagian = $this->session->userdata("bagian");
        $data["id"] = $id;
        $data["nama"] = $nama;
        $data["bagian"] = $bagian;

        $this->load->view("header",$data);
        $this->load->view("tentang_kami",$data);
        $this->load->view("footer");
    }

    function pertanyaan(){
        $id = $this->session->userdata("id");
        $nama = $this->session->userdata("nama");
        $bagian = $this->session->userdata("bagian");
        $data["id"] = $id;
        $data["nama"] = $nama;
        $data["bagian"] = $bagian;

        $this->load->view("header",$data);
        $this->load->view("pertanyaan",$data);
        $this->load->view("footer");
    }

    function listProyek(){

        $jml_data =  json_decode($this->curl->simple_get($this->API.'/Proyek/jmlListProyek/'));
        $this->load->library('pagination');
        $config['base_url'] = base_url().'/Utama/listProyek';
        $config['total_rows'] = $jml_data;
        $config['per_page'] = 9;
        $from = $this->uri->segment(3);
        $this->pagination->initialize($config);
        $data['data_proyek'] = json_decode($this->curl->simple_get($this->API.'/Proyek/listProyek/'));
        $data['gambar'] = json_decode($this->curl->simple_get($this->API.'/Proyek/getAllImgUtama/'));

       // print_r($data['data_proyek']);

       $this->load->view("header");
        $this->load->view("proyek",$data);
        $this->load->view("footer");
    }

    function daftarPeternak(){

        $this->load->view("header");
        $this->load->view("register_peternak");
        $this->load->view("footer");
    }

    function daftarInvestor(){

       // $this->session->set_flashdata('error','eror boy!');
     //   $this->session->set_flashdata('error',null);

        $this->load->view("header");
        $this->load->view("register_investor");
        $this->load->view("footer");
    }

    function detailProyek($id_proyek){


        $proyek = json_decode($this->curl->simple_get($this->API.'/Proyek/detailProyek/'.$id_proyek));
        $data['proyek'] = $proyek;
        foreach ($proyek as $b){
            $idPeternak = $b->idPeternak;
        }

        $peternak = json_decode($this->curl->simple_get($this->API.'/Peternak/detailPeternak/'.$idPeternak));
        $data['peternak'] = $peternak;
        $data['gambar'] = json_decode($this->curl->simple_get($this->API.'/Proyek/getImgProyekByID/'.$id_proyek));
        $data['gambar_utama'] = json_decode($this->curl->simple_get($this->API.'/Proyek/getImgUtamaProyekByID/'.$id_proyek));

        $this->load->view("header");
        $this->load->view("detail_proyek_user",$data);
        $this->load->view("footer");
    }

    function pilihanDaftar(){

        $this->load->view("header");
        $this->load->view("pilihan_daftar");
        $this->load->view("footer");
    }

    function pilihanLogin(){

        $this->load->view("header");
        $this->load->view("pilihan_login");
        $this->load->view("footer");
    }

    function berhasilDaftarPeternak(){


        $this->load->view("header");
        $this->load->view("berhasil_daftar_peternak");
        $this->load->view("footer");
    }

    function berhasilDaftarInvestor(){

        $this->load->view("header");
        $this->load->view("berhasil_daftar_investor");
        $this->load->view("footer");
    }

    function simpanPeternak(){

                $password1 = $this->input->post('txt_password');
                $password2 = $this->input->post('txt_konfir_psw');

                if ($password1 == $password2 ){

                    $enkripsi = $this->encryption->encrypt($password1);

                    $data_peternak = array(
                        'idPeternak'=>chr(rand(65,90)).chr(rand(65,90)).rand(10,100).rand(10,100),
                      'namaPeternak'=>$this->input->post('txt_name'),
                        'email'=>$this->input->post('txt_email'),
                        'password'=>$enkripsi,
                        'no_telp'=>$this->input->post('txt_notelp'),
                        'no_rek'=>$this->input->post('txt_norek'),
                        'alamat'=>$this->input->post('txt_alamat'),
                        'saldo_wallet'=>0
                    );

                    //simpan data peternak
                    $this->curl->simple_post($this->API.'/Akun/prosesSimpanPeternak', $data_peternak, array(CURLOPT_BUFFERSIZE => 10));
                    redirect('Utama/berhasilDaftarPeternak');
                }else{

                    $this->session->set_flashdata('error','Konfirmasi Password tidak valid !');

                    $this->load->view("header");
                    echo "Konfirmasi password tidak valid";
                    $this->load->view("register_peternak");
                    $this->load->view("footer");
                }


    }

    function simpanInvestor(){


                $password1 = $this->input->post('txt_password');
                $password2 = $this->input->post('txt_konfir_psw');

                if ($password1 == $password2 ){

                    $enkripsi = $this->encryption->encrypt($password1);

                    $data_investor = array(
                        'idInvestor'=>chr(rand(65,90)).chr(rand(65,90)).rand(10,100).rand(10,100),
                        'namaInvestor'=>$this->input->post('txt_name'),
                        'email'=>$this->input->post('txt_email'),
                        'password'=>$enkripsi,
                        'no_telp'=>$this->input->post('txt_notelp'),
                        'no_rek'=>$this->input->post('txt_norek'),
                        'saldo_wallet'=>0
                    );

                    $this->session->set_flashdata('error',null);
                    $this->curl->simple_post($this->API.'/Akun/prosesSimpanInvestor', $data_investor, array(CURLOPT_BUFFERSIZE => 10));
                    redirect('Utama/berhasilDaftarInvestor');
                }else{

                    $this->session->set_flashdata('error','Konfirmasi Password tidak valid !');
                    $this->load->view("header");
                    $this->load->view("register_investor");
                    $this->load->view("footer");
                }
            }



}