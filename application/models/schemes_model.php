<?php
class Schemes_model extends CI_Model
{

        function get_scheme_list()
    {
        $array_key = $this->uri->uri_to_assoc(2);
        $orderByArray = array('id','name');
        $orderTypeArray = array('ASC','DESC');

        // **Where string start**//
        $whereArray = array();
        $whereArray[] = "1=1";
        if ((array_key_exists('scheme_name',$array_key)) && ($array_key['scheme_name'] != '')){
            $title = str_replace("%20"," ",$array_key['scheme_name']);
            $whereArray[] = " (name like '%".$title."%')";
        }

        $where = implode(' AND ',$whereArray);

        // ** Where string end **//
        
        // ** Order by start **//
        $orderBy = 'id';
        $ordertype = 'DESC';
        
        if ((array_key_exists('orderby',$array_key)) && ($array_key['orderby'] != '') && (in_array($array_key['orderby'], $orderByArray))){
            $orderBy = $array_key['orderby'];
        }
        if ((array_key_exists('sortval',$array_key)) && ($array_key['sortval'] != '') && (in_array($array_key['sortval'], $orderTypeArray))){
            $ordertype = $array_key['sortval'];
        }
        // ** Order by end **//
        
        $PerPage = 10;
        $currentPage = (array_key_exists('page',$array_key))? $array_key['page'] : 1;
        if((!is_numeric($currentPage)) || ($currentPage < 1) ){
            $currentPage = 1;
        }
        $startpoint = (floor($currentPage) * $PerPage) - $PerPage;
        $orderByLimit = " ORDER BY ".$orderBy." ".$ordertype." LIMIT ".$startpoint.",".$PerPage;
        $selectSql = "SELECT * FROM `schemes` WHERE ".$where.$orderByLimit."";
        
        
        $selectSlider = $this->db->query($selectSql);
        return $selectSlider->result();
    }
    
    function totalCount()
    {
        $array_key = $this->uri->uri_to_assoc(2);
        $whereArray = array();
        $whereArray[] = "1=1";
        if ((array_key_exists('scheme_name',$array_key)) && ($array_key['scheme_name'] != '')){
            $title = str_replace("%20"," ",$array_key['scheme_name']);
            $whereArray[] = " (name like '%".$title."%')";
        }

       
        $where = implode(' AND ',$whereArray);
        $selectSlider = $this->db->query("SELECT * FROM `schemes` WHERE ".$where."");
        return $selectSlider->num_rows();
    }


    function get_authorization_list(){

        $response = array();
       
        $this->db->select("*");
        $this->db->from("login");
        $this->db->where_not_in('id', '3');
        $query = $this->db->get();
        if($query->num_rows() > 0)
        {
            $response = $query->result();
        }
        return $response;
    }

    function get_active_scheme_list(){

        $response = array();
       
        $this->db->select("*");
        $this->db->from("schemes");
        $this->db->where('status', '1');
        $query = $this->db->get();
        if($query->num_rows() > 0)
        {
            $response = $query->result();
        }
        return $response;
    }

 
    function insertScheme(){
        
        $schemeData['name'] =  trim($this->input->post('schemeName'));
        $schemeData['authorized_by'] = $this->input->post('authorized_by');
        $schemeData['status'] = trim($this->input->post('status'));
        
         $this->db->insert('schemes',$schemeData);
         $scheme_id = $this->db->insert_id();
         if($scheme_id!=''){
           return true;
         }else{
            return false;
         }  
    }
    function deleteScheme($id)
    {
        $this->db->where('id', $id);
        $qry = $this->db->delete('schemes');
        if($qry){
        return true;
        }
        else{
        return false;
        }   
     }

    function get_single_scheme_list($id)
    {
        $this->db->select("*");
        $this->db->from("schemes");
        $this->db->where('id', $id);
        $query = $this->db->get();
        
        if($query->num_rows()>0)
        {
            return $query->row();
        }
        else{
            return array();
        }
    }

    function updateScheme($id)
    {
        if($id != ''){
            $schemeData['name'] =  trim($this->input->post('schemeName'));
            $schemeData['authorized_by'] = $this->input->post('authorized_by');
            $schemeData['status'] = trim($this->input->post('status'));
        
            $whereArray = array('id'=>$id);
            $this->db->where($whereArray);
            $qry = $this->db->update('schemes',$schemeData);
    
            if($qry){
             
                return true;
            }
            else{
                return false;
            }
        }

    }
  
}