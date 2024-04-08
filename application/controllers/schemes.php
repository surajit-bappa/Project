<?php
class Schemes extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $id = $this->session->userdata('user_id');
        if($id == ''){
            redirect(base_url().'login');
        }
        $this->load->library('form_validation');
        $this->load->model('schemes_model');
        $this->load->helper('code');
    }

    function _remap($method, $params=array())
    {
        $methodToCall = method_exists($this, $method) ? $method : 'index';
        return call_user_func_array(array($this, $methodToCall), $params);
    }


    function index(){
        $searchKeyandValue = array();
        if(isset($_POST['do_search'])){
            
            foreach ( $_POST as $key => $value )
            {
                if(($key != 'search') && ($key != 'do_search') && ($value !='')){
                    $searchKeyandValue[$key] = $value;
                }
            }
            if(!empty($searchKeyandValue)){
                $searchUri = $this->uri->assoc_to_uri($searchKeyandValue);
                redirect(base_url()."schemes/".$searchUri);
            }
        }
        $data['schemes']  = $this->schemes_model->get_scheme_list();
        $data['authorization_list'] = $this->schemes_model->get_authorization_list();
		$data['total_count'] = $this->schemes_model->totalCount();
        $data['searchKeyVal'] = $this->uri->uri_to_assoc(2);
        $this->load->view('scheme/list',$data);
  
    }

    public function add()
    {
      $data['user_level_list'] = $this->schemes_model->get_authorization_list();
	   $this->load->view('scheme/add',$data);
    }

    public function do_add()
    {
       $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
		$config = array(
			array(
				'field' => 'schemeName',
				'label' => 'Schem Name',
				'rules' => 'required'
			),
			array(
				'field' => 'authorized_by',
				'label' => 'Authorized By',
				'rules' => 'required'
			)
		);
	
		$this->form_validation->set_rules($config);
		if ($this->form_validation->run() == FALSE) {
			
			redirect(base_url()."schemes/add");
		} 
		else
		{
				$insertScheme = $this->schemes_model->insertScheme();
				if($insertScheme)
			        {
				    $this->session->set_userdata('admin_success','Scheme added successfully');
				    redirect(base_url().'schemes');
				}
				else
			        {
				    $this->session->set_userdata('admin_error','Faild to add Scheme');
				    redirect(base_url().'scheme/add');
				}
	      }
    }
    

	function edit($id)
	{		
		$id = base64_decode(urldecode($id));
		$data['schemes'] = $this->schemes_model->get_single_scheme_list($id);
		$data['authorization_list'] = $this->schemes_model->get_authorization_list();
		$this->load->view('scheme/edit',$data);	
	}
	
	
	function do_edit()
	{
		$id = $this->input->post('id');
		$updatScheme= $this->schemes_model->updateScheme($id);
		if($updatScheme)
		{
		   $this->session->set_userdata('admin_success','Scheme updated successfully');
			redirect(base_url()."schemes");
		}
		else
		{
			$this->session->set_userdata('admin_error','Faild to update scheme');
			redirect(base_url()."schemes/edit");
		}
	}
	
	
	function delete($id = 0)
	{
		$this->schemes_model->deleteScheme(base64_decode(urldecode($id)));
		redirect(base_url()."schemes");
	}


}
?>