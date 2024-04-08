<?php
class Users extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $id = $this->session->userdata('user_id');
        if($id == ''){
            redirect(base_url().'login');
        }
        $this->load->model('users_mod');
        $this->load->model('schemes_model');
        $this->load->library('form_validation');
        $this->load->helper('code');
    }

    function _remap($method, $params=array())
    {
        $methodToCall = method_exists($this, $method) ? $method : 'index';
        return call_user_func_array(array($this, $methodToCall), $params);
    }


 	public function checkEmail()
    {
       $email = trim($this->input->post('email'));
       $user_id = trim($this->input->post('user_id'));
     
       $checkEmail = $this->users_mod->check_email_exist($email,$user_id);
       
       if($checkEmail == 1){
       	   echo "taken";	
       }else{
       	echo 'not_taken';
       }
       exit();
   }
   	public function checkPhoneNo()
    {
       $phone = trim($this->input->post('phone'));
       $user_id = trim($this->input->post('user_id'));
       	$checkPhone = $this->users_mod->check_phone_exist($phone,$user_id);
       if($checkPhone == 1){
       	   echo "taken";	
       }else{
       	echo 'not_taken';
       }
       exit();
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
                redirect(base_url()."users/".$searchUri);
            }
        }
        if($this->session->userdata('user_type')=="Admin Level"){
        	 $data['users']  = $this->users_mod->get_user_list_by();
        	 $data['total_count'] = $this->users_mod->totalCountby();
        }elseif ($this->session->userdata('user_type')=="Senior Level") {
        	 $data['users']  = $this->users_mod->get_user_list_by();
        	 $data['total_count'] = $this->users_mod->totalCountby();
        }else{
        	 $data['users']  = $this->users_mod->get_user_list();
        	 $data['total_count'] = $this->users_mod->totalCount();
        }
       
		
        $data['searchKeyVal'] = $this->uri->uri_to_assoc(2);
        $this->load->view('users/list',$data);
    }

    public function add()
    {
       $data['schemes']  = $this->schemes_model->get_active_scheme_list();
	   $this->load->view('users/add', $data);
    }

    public function do_add()
    {
            $data['schemes']  = $this->schemes_model->get_active_scheme_list();
			$this->form_validation->set_error_delimiters('<small class="text-danger" style="font-weight: bolder; font-size: 11px;">', '</small>');

			$config = array(
				array(
					'field' => 'scheme_type',
					'label' => 'Scheme Type',
					'rules' => 'required',
					'errors' => array(
									'required' => 'Please Select %s.',
									)
				),
				array(
					'field' => 'first_name',
					'label' => 'First Name',
					'rules' => 'required',
					'errors' => array(
									'required' => 'Please Select %s.',
									)
				),
				array(
					'field' => 'last_name',
					'label' => 'Last Name',
					'rules' => 'required',
					'errors' => array(
									'required' => 'Please Select %s.',
									)
				),
	        array(
	                'field' => 'email',
	                'label' => 'Email',
	                'rules' => 'required|valid_email|is_unique[users.email]',
	                'errors' => array(
									'required' => 'Please Enter %s.'
									)
	        ),
				array(
					'field' => 'phone',
					'label' => 'Mobile Number',
					'rules' => 'required|trim|numeric|is_unique[users.phone]',
					'errors' => array(
									'required' => 'Please Enter %s.',
									'numeric' => '%s Should be Numeric Only.',
									)
				),
			
				array(
					'field' => 'date_of_birth',
					'label' => 'Date of birth',
					'rules' => 'required',
					'errors' => array(
									'required' => 'Please Enter %s.',
									)
				)
	
				
			);

		$this->form_validation->set_rules($config);

		if ($this->form_validation->run() == FALSE)
		{

	        $this->load->view('users/add', $data);

		}else{

            $insertUser = $this->users_mod->insertUser();
			if($insertUser)
		        {
			    $this->session->set_userdata('admin_success','User added successfully');
			    redirect(base_url().'users');
			}
			else
		        {
			    $this->session->set_userdata('admin_error','Faild to add user');
			    redirect(base_url().'users/add');
			}

		}
	
    }
    

	function edit($id)
	{		
		
		$id = base64_decode(urldecode($id));
		$data['users'] = $this->users_mod->get_single_user_list($id);
		$data['schemes']  = $this->schemes_model->get_active_scheme_list();
		$this->load->view('users/edit',$data);	
	}
	
	function do_edit()
	{
		$id = $this->input->post('id');
		$data['schemes']  = $this->schemes_model->get_active_scheme_list();
	    $this->form_validation->set_error_delimiters('<small class="text-danger" style="font-weight: bolder; font-size: 11px;">', '</small>');

			$config = array(
				array(
					'field' => 'scheme_type',
					'label' => 'Scheme Type',
					'rules' => 'required',
					'errors' => array(
									'required' => 'Please Select %s.',
									)
				),
				array(
					'field' => 'first_name',
					'label' => 'First Name',
					'rules' => 'required',
					'errors' => array(
									'required' => 'Please Select %s.',
									)
				),
				array(
					'field' => 'last_name',
					'label' => 'Last Name',
					'rules' => 'required',
					'errors' => array(
									'required' => 'Please Select %s.',
									)
				),
	        array(
	                'field' => 'email',
	                'label' => 'Email',
	                'rules' => 'required|valid_email',
	                'errors' => array(
									'required' => 'Please Enter %s.'
									)
	        ),
				array(
					'field' => 'phone',
					'label' => 'Mobile Number',
					'rules' => 'required|trim|numeric',
					'errors' => array(
									'required' => 'Please Enter %s.',
									'numeric' => '%s Should be Numeric Only.',
									)
				),
			
				array(
					'field' => 'date_of_birth',
					'label' => 'Date of birth',
					'rules' => 'required',
					'errors' => array(
									'required' => 'Please Enter %s.',
									)
				)

			);
		$this->form_validation->set_rules($config);

		if ($this->form_validation->run() == FALSE)
		{

	        $this->load->view('users/edit', $data);

		}else{
				$updateUser= $this->users_mod->updateUser($id);
				if($updateUser)
				{
				   $this->session->set_userdata('admin_success','User updated successfully');
					redirect(base_url()."users");
				}
				else
				{
					$this->session->set_userdata('admin_error','Faild to update user');
					redirect(base_url()."users/edit");
				}
	      }
	}
	
	
	function delete($id = 0)
	{
		$this->users_mod->deleteUser(base64_decode(urldecode($id)));
		redirect(base_url()."users");
	}

	function forward_to($id = 0)
	{
		$this->users_mod->forwardUser(base64_decode(urldecode($id)));
		redirect(base_url()."users");
	}

	function approved_by($id = 0)
	{
	  if($this->session->userdata('user_type')=="Admin Level"){
		$this->users_mod->approvedUser(base64_decode(urldecode($id)));
	   }
		redirect(base_url()."users");
	}

	function rejected_by($id = 0)
	{
	  if($this->session->userdata('user_type')=="Admin Level"){
		$this->users_mod->rejectedUser(base64_decode(urldecode($id)));
	   }
		redirect(base_url()."users");
	}

}
?>