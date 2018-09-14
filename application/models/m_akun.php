<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: Glory
 * Date: 14/03/2018
 * Time: 9:22
 */
class m_akun extends CI_Model
{
    function getJumlahInvestor(){
        return $this->db->get_where('investor')->num_rows();
    }

    function getJumlahPeternak(){
        return $this->db->get_where('peternak')->num_rows();
    }

    function getDetailInvestor(){
        $id_investor = $this->session->userdata('id');
        return $this->db->get_where('investor',array('idInvestor'=>$id_investor));
    }

    function getDetailPeternak($id_peternak){
        return $this->db->get_where('peternak',array('idPeternak'=>$id_peternak));
    }

}