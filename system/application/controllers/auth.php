<?php
echo phpinfo();
die();
class Auth extends Controller {
	var $data;
	function Auth()
	{
			$this->data = array(
				'page_title' => 'login',
				'page_extrs_js' => '',
				'error' => ''
				);
			parent::Controller();
			$this->load->model('pages_m');
			$this->load->model('user_m');
	}
	function index(){
		$this->login();
	}
	//start login function for user
	function login(){
		//die('d');
		$this->load->library('form_validation');
        $this->form_validation->set_rules('email', 'Email', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');
        if ($this->form_validation->run() == FALSE){
        	        $this->data['title'] = $this->pages_m->getpagetitles(10);
		$this->data['title2'] = $this->pages_m->getpagetitles(7);  
      				$this->load->view('user/user_login_single',$this->data);
		}else {
				//echo "logged In";
                $email = $this->input->post('email');
                $password =$this->input->post('password');    
                $result = $this->user_m->get_data_by_username_password($email,$password);
                  if($result !== false){
					//set all user parameters
                    $this->session->set_userdata('nextclose_userlogged_in',true);
					$this->session->set_userdata('nextclose_user_id',$result['id_user']);
					$this->session->set_userdata('nextclose_username',$result['first_name']);
					$this->session->set_userdata('nextclose_email',$result['email']);
					$this->session->set_userdata('nextclose_user_first_name',$result['first_name']);
					$this->session->set_userdata('nextclose_user_last_name',$result['last_name']);
					$this->session->set_userdata('nextclose_user_role',$result['id_role']);
					redirect('dashboard','refresh');
				} else {
					$this->data['error'] = 'email/password dosn\'t match ';
					$this->data['title'] = $this->pages_m->getpagetitles(10);
		            $this->data['title2'] = $this->pages_m->getpagetitles(7);
					$this->load->view('user/user_login_single',$this->data);
                }
         }
	}
	function notauthorise()
	{
		$this->data['title'] = $this->pages_m->getpagetitles(10);
		$this->data['title2'] = $this->pages_m->getpagetitles(7);
		$this->load->view('members/notauthorise');
	}
	//end function 
}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */