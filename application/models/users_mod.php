<?php
class Users_mod extends CI_Model
{

    function get_user_list()
    {
        $array_key = $this->uri->uri_to_assoc(2);
        $orderByArray = array('id','first_name','last_name','full_name','email');
        $orderTypeArray = array('ASC','DESC');

        // **Where string start**//
        $whereArray = array();
        $whereArray[] = "1=1";
             if ((array_key_exists('user_name',$array_key)) && ($array_key['user_name'] != '')){
            //echo str_replace("%20"," ",rawurldecode($array_key['user_name']));exit;
            $user_nameArray = explode(' ',str_replace("%20"," ",rawurldecode($array_key['user_name'])));
            $orArray = array();
            if(!empty($user_nameArray)){
                foreach($user_nameArray AS $user_name){
                    if($user_name != ''){
                        $orArray[] = " `full_name` like '%".addslashes($user_name)."%' or `email` like '%".addslashes($user_name)."%' ";
                    }
                }
            }
            if(!empty($orArray)){
                $whereString = ' ('.implode(' OR ',$orArray).') ';
                array_push($whereArray, $whereString);
            }
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
        $selectSql = "SELECT * FROM `users` WHERE ".$where.$orderByLimit."";
      
        $totaluser = $this->db->query($selectSql);
        return $totaluser->result();
    }
    
    function totalCount()
    {
        $array_key = $this->uri->uri_to_assoc(2);
        $whereArray = array();
        $whereArray[] = "1=1";
                if ((array_key_exists('user_name',$array_key)) && ($array_key['user_name'] != '')){
            
            $user_nameArray = explode(' ',str_replace("%20"," ",$array_key['user_name']));
            $orArray = array();
            if(!empty($user_nameArray)){
                foreach($user_nameArray AS $user_name){
                    if($user_name != ''){
                        $orArray[] = " `full_Name` like '%".$user_name."%' or `email` like '%".$user_name."%' ";
                    }
                }
            }
            if(!empty($orArray)){
                $whereString = ' ('.implode(' OR ',$orArray).') ';
                array_push($whereArray, $whereString);
            }
        }
      
        $where = implode(' AND ',$whereArray);
        $userCount = $this->db->query("SELECT * FROM `users` WHERE ".$where."");
        return $userCount->num_rows();
    }

      function get_user_list_by()
    {
        $array_key = $this->uri->uri_to_assoc(2);
        $orderByArray = array('id','first_name','last_name','full_name','email');
        $orderTypeArray = array('ASC','DESC');

        // **Where string start**//
        $whereArray = array();
        $whereArray[] = "1=1";
             if ((array_key_exists('user_name',$array_key)) && ($array_key['user_name'] != '')){
            //echo str_replace("%20"," ",rawurldecode($array_key['user_name']));exit;
            $user_nameArray = explode(' ',str_replace("%20"," ",rawurldecode($array_key['user_name'])));
            $orArray = array();
            if(!empty($user_nameArray)){
                foreach($user_nameArray AS $user_name){
                    if($user_name != ''){
                        $orArray[] = " `full_name` like '%".addslashes($user_name)."%' or `email` like '%".addslashes($user_name)."%' ";
                    }
                }
            }
            if(!empty($orArray)){
                $whereString = ' ('.implode(' OR ',$orArray).') ';

                array_push($whereArray, $whereString);
            }
        }
        $whereArray[]="forwarded_to=".$this->session->userdata('user_id')." or `approved_to`=1" ;
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
        $selectSql = "SELECT * FROM `users` WHERE ".$where.$orderByLimit."";
        $totaluser = $this->db->query($selectSql);
        return $totaluser->result();
    }

    function totalCountby()
    {
        $array_key = $this->uri->uri_to_assoc(2);
        $whereArray = array();
        $whereArray[] = "1=1";
                if ((array_key_exists('user_name',$array_key)) && ($array_key['user_name'] != '')){
            
            $user_nameArray = explode(' ',str_replace("%20"," ",$array_key['user_name']));
            $orArray = array();
            if(!empty($user_nameArray)){
                foreach($user_nameArray AS $user_name){
                    if($user_name != ''){
                        $orArray[] = " `full_Name` like '%".$user_name."%' or `email` like '%".$user_name."%' ";
                    }
                }
            }
            if(!empty($orArray)){
                $whereString = ' ('.implode(' OR ',$orArray).') ';
                array_push($whereArray, $whereString);
            }
        }

        $whereArray[]="forwarded_to=".$this->session->userdata('user_id')." or `approved_to`=1" ;
      
        $where = implode(' AND ',$whereArray);
        $usrcount = $this->db->query("SELECT * FROM `users` WHERE ".$where."");
        return $usrcount->num_rows();
    }



    function check_email_exist($email,$user_id){
        
        $this->db->select("*");
        $this->db->from("users");
        $this->db->where("email", $email);
        $this->db->where("id !=", $user_id); 
        $query = $this->db->get();
        if($query->num_rows() > 0)
        {
           return 1;
        }else{
            return 0;
        }
     }

     function check_phone_exist($phone,$user_id){
        
        $this->db->select("*");
        $this->db->from("users");
        $this->db->where("phone", $phone);
        $this->db->where("id !=", $user_id); 
        $query = $this->db->get();
        if($query->num_rows() > 0)
        {
           return 1;
        }else{
            return 0;
        }
     }

 
    function insertUser(){

        $userData['scheme_type'] = $this->input->post('scheme_type');
        $userData['first_name'] = $first_name = trim($this->input->post('first_name'));
        $userData['last_name'] = $last_name = trim($this->input->post('last_name'));
        $userData['full_name'] = $first_name.' '.$last_name; 
        $userData['email'] = trim($this->input->post('email'));
        $userData['gender'] = trim($this->input->post('gender'));
        $userData['phone'] = trim($this->input->post('phone'));
          if($this->input->post('date_of_birth')!=''){
               $userData['date_of_birth'] = date("Y-m-d", strtotime($this->input->post('date_of_birth')));
            }else{
               $userData['date_of_birth'] = "0000-00-00";
            }

        $userData['created_by'] =  $this->session->userdata('user_id');
       
         $this->db->insert('users',$userData);
         $user_id = $this->db->insert_id();
         if($user_id!=''){
           return true;
         }else{
            return false;
         }
   
    }
    function deleteUser($id)
    {
        $this->db->where('id', $id);
        $qry = $this->db->delete('users');
        if($qry){
        return true;
        }
        else{
        return false;
        }   
     }

     function get_single_user_list($id){

        $response = array();
       
        $this->db->select("*");
        $this->db->from("users");
        $this->db->where('id', $id);
        $query = $this->db->get();
        if($query->num_rows() > 0)
        {
            return $query->row();
        }else{
            return array();
        }
       
    }

     function updateUser($id)
    {
        if($id != ''){
             $userData['scheme_type'] = $this->input->post('scheme_type');
            $userData['first_name'] = $first_name = trim($this->input->post('first_name'));
            $userData['last_name'] = $last_name = trim($this->input->post('last_name'));
            $userData['full_name'] = $first_name.' '.$last_name; 
            $userData['email'] = trim($this->input->post('email'));
            $userData['gender'] = trim($this->input->post('gender'));
            $userData['phone'] = trim($this->input->post('phone'));
              if($this->input->post('date_of_birth')!=''){
                   $userData['date_of_birth'] = date("Y-m-d", strtotime($this->input->post('date_of_birth')));
                }else{
                   $userData['date_of_birth'] = "0000-00-00";
                }

            $userData['updated_by'] =  $this->session->userdata('user_id');
            $userData[' updated_at'] = 'now()';

            $whereArray = array('id'=>$id);
            $this->db->where($whereArray);
            $qry = $this->db->update('users',$userData);
    
            if($qry){
                
                return true;
            }
            else{
                return false;
            }
        }

    }

    function forwardUser($id)
    {

        $this->load->model('schemes_model');
        $rowDetails = $this->get_single_user_list($id);
        if(!empty($rowDetails))
       {
           $scheme_type=$rowDetails->scheme_type;
           $scheme_details = $this->schemes_model->get_single_scheme_list($scheme_type);
           $authorized_by=$scheme_details->authorized_by;

            if($this->session->userdata('user_type')=="Senior Level"){
                $data = array(
                'forwarded_by' =>  $this->session->userdata('user_id'),
                'approved_to' => 1,
                'forwarded_at' => 'now()'
            );
            }
            else{

                $data = array(
                'forwarded_by' =>  $this->session->userdata('user_id'),
                'forwarded_to' => $authorized_by,
                'forwarded_at' => 'now()'
            );

            }

            $whereArray = array('id'=>$id);
            $this->db->where($whereArray);
            $this->db->update('users',$data);
            return true;
        }else{
             return false;
        }
        
    }


    function approvedUser($id)
    {

        $rowDetails = $this->get_single_user_list($id);
        if(!empty($rowDetails))
       {

            $data = array(
                'approved_by' =>  $this->session->userdata('user_id'),
                'approved_at' => 'now()'
            );

            $whereArray = array('id'=>$id);
            $this->db->where($whereArray);
            $this->db->update('users',$data);
            return true;
        }else{
             return false;
        }
        
    }

    function rejectedUser($id)
    {

        $rowDetails = $this->get_single_user_list($id);
        if(!empty($rowDetails))
       {

            $data = array(
                'rejected_by' =>  $this->session->userdata('user_id'),
                'rejected_at' => 'now()'
            );

            $whereArray = array('id'=>$id);
            $this->db->where($whereArray);
            $this->db->update('users',$data);
            return true;
        }else{
             return false;
        }
        
    }




    
      
    
}