<?php
class Mis_model extends CI_Model
{

    
    function get_forwarded_to_senior_level_count(){

        $response = array();
       
        $this->db->select("*");
        $this->db->from("users");
        $this->db->where('forwarded_to', 2);
        $query = $this->db->get();
        if($query->num_rows() > 0)
        {
            return $query->result();
        }else{
            return array();
        }
       
    }
    

    function get_forwarded_to_admin_level_count(){

        $response = array();
       
        $this->db->select("*");
        $this->db->from("users");
        $this->db->where('forwarded_to', 1);
        $this->db->or_where('approved_to', 1);
        $query = $this->db->get();
        if($query->num_rows() > 0)
        {
            return $query->result();
        }else{
            return array();
        }
       
    }
    function get_total_approved_count(){

        $response = array();
       
        $this->db->select("*");
        $this->db->from("users");
        $this->db->where('approved_by', 1);
        $query = $this->db->get();
        if($query->num_rows() > 0)
        {
            return $query->result();
        }else{
            return array();
        }
       
    }

     function get_total_rejected_count(){

        $response = array();
       
        $this->db->select("*");
        $this->db->from("users");
        $this->db->where('rejected_by', 1);
        $query = $this->db->get();
        if($query->num_rows() > 0)
        {
            return $query->result();
        }else{
            return array();
        }
       
    }

    



    
      
    
}