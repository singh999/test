<?php

class Auth_m extends Model {

    function Auth_m() {
        parent::Model();
    }

    //check user loggied or not
    function is_user_logged_in() {
        if ($this->session->userdata('nextclose_userlogged_in') !== true) {
            return false;
        } else {
            return true;
        }
    }

    //check and redirect to login
    function check_login() {
        if ($this->session->userdata('nextclose_userlogged_in') !== true) {
            redirect('auth/login');
            die('Not Authrised');
        } else {
            if ($this->session->userdata('nextclose_user_role') == 2) {
                return;
            } else {
                if ($this->uri->segment(1) !== false) {
                    if ($this->uri->segment(2) !== false) {
                        $func = $this->uri->segment(2);
                    } else {
                        $func = "index";
                    }
                    $controler = $this->uri->segment(1);
                    $id = ($this->session->userdata('nextclose_user_role'));
                    $query = $this->db->query("select is_active from ci_role_permissions where id_permission = 
		            (select id_permission from ci_functions where controller = '$controler' and method = '$func')
		            and id_role in ($id)");
                    $result = $query->result_array();
                    if ($result != array()) {
                        if ($result[0]['is_active'] == 'YES') {
                            return;
                        } else {
                            if ($this->uri->segment(1) == 'dashboard' && $this->uri->segment(2) == 'saveaccount') {
                                echo 'Not authorise cant update  ';
                                die();
                            } else {
                                redirect('auth/notauthorise');
                            }
                        }
                    } else {
                        if ($this->uri->segment(1) == 'dashboard' && $this->uri->segment(2) == 'saveaccount') {
                            echo 'Not authorise cant update  ';
                            die();
                        } else {
                            redirect('auth/notauthorise');
                        }
                    }
                } else {
                    die('Invalid url');
                }
            }
        }
    }

}
