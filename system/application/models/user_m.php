<?php

class user_m extends Model {

    function user_m() {
        parent::Model();
    }

    function get_data_by_username_password($email, $password) {
        $query = $this->db->query("SELECT * from ci_users WHERE email=" . $this->db->escape($email) . " AND password=" . $this->db->escape($password) . " AND user_status = 'ACTIVE' ");
        if ($query->num_rows() > 0) {
            $date = date('Y-m-d');
            $query2 = $this->db->query("update ci_users set last_login_date = '$date'  WHERE email=" . $this->db->escape($email) . " AND password=" . $this->db->escape($password) . "");
            $result = $query->result_array();
            $count = $result[0]['user_login_count'];
            $count = $count + 1;
            $query3 = $this->db->query("update ci_users set user_login_count = '$count'  WHERE email=" . $this->db->escape($email) . " AND password=" . $this->db->escape($password) . "");
            return $query->row_array();
        } else {
            return false;
        }
    }

    function username_exists($username) {
        $query = $this->db->query("SELECT * from ci_users WHERE username='$username'");
        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    function email_exists($email) {
        $query = $this->db->query("SELECT * from ci_users WHERE email='$email'");
        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    function save_user($username, $email, $password) {
        $data = array(
            'first_name' => $username,
            'email' => $email,
            'password' => $password,
            'user_status' => 'EMAILNC',
            'dt_add' => date('Y-m-d H:i:s'),
            'dt_mod' => date('Y-m-d H:i:s'),
            'id_role' => 1
        );
        $this->db->insert('ci_users', $data);
        $id = $this->db->insert_id();
        $this->_dowordpressregistration($data);
        $data = array(
            'hash' => md5($id)
        );
        $this->db->where('id_user', $id);
        $this->db->update('ci_users', $data);
        return $id;
    }

    function _dowordpressregistration($data) {
        $d = array(
            'user_login' => $data['email'],
            'user_nicename' => $data['first_name'],
            'user_email' => $data['email'],
            'user_status' => 0,
            'user_registered' => date('Y-m-d H:i:s'),
            'display_name' => $data['first_name']
        );
        $this->db->insert('wp_users', $d);
        $user_id = $this->db->insert_id();

        $usermeta = array();

        $usermeta['firstname'] = $data['first_name'];
        $usermeta['lastname'] = $data['email'];
        $usermeta['nickname'] = $data['first_name'];
        $usermeta['rich_editing'] = 'true';
        $usermeta['comment_shortcuts'] = 'false';
        $usermeta['admin_color'] = 'fresh';
        $usermeta['wp_capabilities'] = 'a:1:{s:10:"subscriber";b:1;}';

        foreach ($usermeta as $key => $value) {
            $data = array(
                'user_id' => $user_id,
                'meta_key' => $key,
                'meta_value' => $value
            );
            $this->db->insert('wp_usermeta', $data);
        }
        return true;
    }

    function getusernamepassword($email) {
        $query = $this->db->query("SELECT * from ci_users WHERE email='$email'");
        $result = $query->result_array();
        return $result;
    }

    function confirm($id) {
        $data = array(
            'user_status' => 'ACTIVE'
        );
        $this->db->where('hash', $id);
        $this->db->update('ci_users', $data);
    }

    function resetpassword($id, $password) {
        $data = array(
            'password' => $password
        );
        $this->db->where('hash', $id);
        $this->db->update('ci_users', $data);
    }

    function saveaccount($value, $id) {
        $data = array(
            $id => $value
        );
        $this->db->where('id_user', $this->session->userdata('nextclose_user_id'));
        $this->db->update('ci_users', $data);
    }

    function getaccount() {
        $id_user = $this->session->userdata('nextclose_user_id');
        $query = $this->db->query("SELECT * from ci_users WHERE id_user = $id_user");
        $result = $query->result_array();
        return $result;
    }

    function getusers($page = 0, $pagelength = 2, $role_id) {
        $cuurent = date('Y-m-d');
        $start = $pagelength * $page;
        $result = array();
        $query = $this->db->query("SELECT count(*) as total from ci_users ");
        $row = $query->row_array();
        $result[0] = $row['total'];
        $query = $this->db->query("select *, DATEDIFF('$cuurent',dt_add) as addt,DATEDIFF('$cuurent',last_login_date) as log from ci_users  order by id_user asc limit $start,$pagelength");
        $result[1] = $query->result_array();
        return $result;
    }

    function deleteusers($id_user) {
        $query = $this->db->query("delete from ci_users WHERE id_user = $id_user");
    }

    function getuser($id_user) {
        $query = $this->db->query("SELECT * from ci_users WHERE id_user = $id_user");
        $result = $query->result_array();
        return $result;
    }

    function updateusers($id_user, $email, $username, $first_name, $last_name, $role) {
        $data = array(
            'email' => $email,
            'username' => $username,
            'first_name' => $first_name,
            'last_name' => $last_name,
            'id_role' => $role
        );
        $this->db->where('id_user', $id_user);
        $this->db->update('ci_users', $data);
    }

    function updateuserajax($id_user, $fieldname, $fieldvalue) {
        //die($fieldname);
        $data = array(
            $fieldname => $fieldvalue
        );
        $this->db->where('id_user', $id_user);
        $this->db->update('ci_users', $data);
    }

    function saveimage($imagename, $id) {
        $data = array(
            'propimage_name' => $imagename,
            'prop_userid' => $id
        );
        $this->db->insert('ci_property', $data);
    }

}
