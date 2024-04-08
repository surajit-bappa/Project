<?php
class Mis extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $id = $this->session->userdata('user_id');
        if($id == ''){
            redirect(base_url().'login');
        }
        $this->load->model('users_mod');
        $this->load->model('mis_model');
    }

    function _remap($method, $params=array())
    {
        $methodToCall = method_exists($this, $method) ? $method : 'index';
        return call_user_func_array(array($this, $methodToCall), $params);
    }


    function index(){
      
        $data['total_user_count']  = $this->users_mod->get_user_list();
        $data['total_forwardedto_senior_level_count'] = $this->mis_model->get_forwarded_to_senior_level_count();
		$data['total_forwardedto_admin_level_count'] = $this->mis_model->get_forwarded_to_admin_level_count();
		$data['total_approved_count'] = $this->mis_model->get_total_approved_count();
		$data['total_rejected_count'] = $this->mis_model->get_total_rejected_count();
        $this->load->view('mis/list',$data);
  
    }

}
?>