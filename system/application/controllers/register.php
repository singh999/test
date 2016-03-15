<?php

class Register extends Controller {

    var $data;

    function Register() {
        $this->data = array(
            'page_title' => 'Register With NextClose',
            'page_extrs_js' => '',
            'error' => ''
        );
        parent::Controller();
        $this->load->model('pages_m');
        $this->load->model('user_m');
    }

    function index() {
        $this->data['page_extrs_js'] = 'register_js';
        $this->load->library('form_validation');
        $this->form_validation->set_rules('logid', 'Name', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('passwordid', 'Password', 'required|matches[repassword]');
        $this->form_validation->set_rules('repassword', 'Reenter-Password', 'required');
        $this->form_validation->set_rules('agree', 'Agree', 'required');
        if ($this->form_validation->run() == FALSE) {
            $this->data['title'] = $this->pages_m->getpagetitles(10);
            $this->data['title2'] = $this->pages_m->getpagetitles(7);
            $this->load->view('user/register', $this->data);
        } else {
            //echo "logged In";
            $username = $this->input->post('logid');
            $password = $this->input->post('passwordid');
            $email = $this->input->post('email');
            $id = $this->user_m->save_user($username, $email, $password);
            $this->confirmemail($id, $username, $email);
            redirect('register/thanx', 'refresh');
        }
    }

    function username_check() {
        $resp = array();
        $username = $_POST['username'];
        if (!$username) {
            $resp = array('cls' => 'tip', 'msg' => "Please Enter Username");
        } else if (!preg_match("/^([-a-z0-9_-])+$/i", $username)) {
            $resp = array("cls" => 'wrong', "msg" => "Alphanumeric chracters only!.");
        } else {
            $resp = array("cls" => 'ok', "msg" => "Available");
        }
        echo json_encode($resp);
        exit;
    }

    function email_check() {
        $resp = array();
        $email = $_POST['email'];
        if (!$email) {
            $resp = array('cls' => 'tip', 'msg' => "Please Enter Email");
        } else if (!preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $email) == true) {
            $resp = array("cls" => 'wrong', "msg" => "Invalid Email Address");
        } else if ($this->user_m->email_exists($email)) {
            $resp = array("cls" => 'wrong', "msg" => "Email already exists.");
        } else {
            $resp = array("cls" => 'ok', "msg" => "Available!");
        }
        echo json_encode($resp);
        exit;
    }

    function password_check() {
        $resp = array();
        $password = $_POST['passwordid'];
        if (!$password) {
            $resp = array('cls' => 'tip', 'msg' => "Please Enter Password");
        } else {
            $resp = array("cls" => 'ok', "msg" => "ok..");
        }
        echo json_encode($resp);
        exit;
    }

    function forget() {

        $this->load->library('form_validation');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|callback_checkemail');
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('user/forget', $this->data);
        } else {
            $result = $this->user_m->getusernamepassword($this->input->post('email'));
            $this->load->library('email');
            $this->email->from('admin@nextclose.com', 'admin');
            $this->email->to($this->input->post('email'));
            $this->email->subject('New password.');
            $hash = $result[0]['hash'];
            $body = "Hello, Please click on the link below to reset your password.
		<br> http://188.72.198.65/projects/index.php/register/reset/" . $hash;
            $this->email->message($body);
            $this->email->send();
            $this->data['title'] = $this->pages_m->getpagetitles(10);
            $this->data['title2'] = $this->pages_m->getpagetitles(7);
            $this->load->view('user/thanx', $this->data);
        }
    }

    function checkemail() {
        $result = $this->user_m->getusernamepassword($this->input->post('email'));
        if ($result == array()) {
            $this->form_validation->set_message('checkemail', 'Email does not Exists');
            return false;
        } else {
            return true;
        }
    }

    function confirmemail($id, $username, $email) {
        $this->load->library('email');
        $this->email->from('admin@nextclose.com', 'admin');
        $this->email->to($email);
        $this->email->subject('New Account Confirmation');
        $body = "Hello,<br> You have registered a new account with username " . $username . " <br> Please click on the link below to confirm your account.
		<br> http://188.72.198.65/projects/index.php/register/confirm/" . md5($id);
        $this->email->message($body);
        $this->email->send();
    }

    function confirm() {
        if ($this->uri->segment(3) !== false) {
            $id = $this->uri->segment(3);
        } else {
            $this->index();
        }
        $this->user_m->confirm($id);
        redirect('auth/login', 'refresh');
    }

    function thanx() {
        $this->data['title'] = $this->pages_m->getpagetitles(10);
        $this->data['title2'] = $this->pages_m->getpagetitles(7);
        $this->load->view('user/thanxconfirm', $this->data);
    }

    function reset() {
        if ($this->input->post('update') !== false) {
            if ($this->uri->segment(3) !== FALSE) {
                $this->load->library('form_validation');
                $this->form_validation->set_rules('passwordid', 'Password', 'required|matches[repassword]');
                $this->form_validation->set_rules('repassword', 'Reenter-Password', 'required');
                $data['id'] = $this->uri->segment(3);
                if ($this->form_validation->run() == FALSE) {
                    $this->load->view('user/resetpassword', $this->data);
                } else {
                    $this->user_m->resetpassword($this->uri->segment(3), $this->input->post('repassword'));
                    redirect('auth/login', 'refresh');
                }
            } else {
                redirect('auth/login', 'refresh');
            }
        } else {
            $this->data['title'] = $this->pages_m->getpagetitles(10);
            $this->data['title2'] = $this->pages_m->getpagetitles(7);
            $this->load->view('user/resetpassword', $this->data);
        }
    }

}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */