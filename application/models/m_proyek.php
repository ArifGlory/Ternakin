<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: Glory
 * Date: 14/03/2018
 * Time: 9:22
 */
class m_proyek extends CI_Model
{
    function getJumlahProyek(){
        return $this->db->get_where('proyek')->num_rows();
    }

    function getJumlahProyekPeternak(){
        $id_peternak = $this->session->userdata("id");
        return $this->db->get_where('proyek',array('idPeternak'=>$id_peternak))->num_rows();
    }

    function getJumlahWaiting(){
        return $this->db->get_where('temporary')->num_rows();
    }

    function getDataWaiting($number,$offset){
        $this->db->order_by("id","asc");
        $this->db->select('*');
        $query = $this->db->get('temporary',$number,$offset)->result();
        return $query;
    }

    function getDetailWaiting($id_temporary){
        return $this->db->get_where('temporary',array('id'=>$id_temporary));
    }

    function getDataProyek($number,$offset){
        $this->db->order_by("id","asc");
        $this->db->select('*');
        $query = $this->db->get('proyek',$number,$offset)->result();
        return $query;
    }

    function getDetailProyek($id_proyek){
        return $this->db->get_where('proyek',array('id'=>$id_proyek));
    }

    function getProyekPeternak($number,$offset){
        $id_peternak = $this->session->userdata("id");
        $this->db->order_by("id","asc");
        $this->db->select('*');
        $this->db->where(array('idPeternak'=>$id_peternak));
        $query = $this->db->get('proyek',$number,$offset)->result();
        return $query;
    }

    function getLastRow(){
        $this->db->order_by("id","desc");
        $this->db->select('*');
        $this->db->limit(1);
        return $this->db->get('proyek')->result();
    }



}