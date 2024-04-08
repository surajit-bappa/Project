<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function get_authorized_by($id) {

    $ci=& get_instance();
    $ci->load->database();
    $ci->db->select('user_type');
    $ci->db->where('id', $id);
    $row = $ci->db->get('login')->row();
    $user_type = $row->user_type;
    return $user_type;
   }
   function get_scheme_type($id) {

    $ci=& get_instance();
    $ci->load->database();
    $ci->db->select('name');
    $ci->db->where('id', $id);
    $row = $ci->db->get('schemes')->row();
    $scheme_type = $row->name;
    return $scheme_type;
   }

?>