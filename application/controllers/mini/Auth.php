<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation', 'form');
    }

    /**
     * 登录
     */
    public function login()
    {
        $date = new DateTime();
        $token_data = array(
            // 用户 ID
            'id' => 1,
            // 签发时间
            'iat' => $date->getTimestamp(),
            // 过期时间（10小时后）
            'exp' => $date->getTimestamp() + 10 * 60 * 60 * 1000,
        );
        $response['token'] = Authorization::generateToken($token_data);
        echoSuccess($response);
    }

    /**
     * 创建超级用户
     */
    public function superuser()
    {
        if ($this->UserModel->superuser_exist()) {
            header('Content-Type: text/plain; charset=utf-8');
            set_status_header(406, 'superuser is exist');
            echoMsg('superuser is exist', '超级管理员已存在');
        } else {
            if ($this->form_validation->run('auth_register') === FALSE) {
                $errors = $this->form_validation->error_array();
                echoFail(current($errors));
            } else {
                $data = $this->input->post();
                $result = $this->UserModel->user_create($data, TRUE);
                if ($result) {
                    $this->UserModel->superuser_lock();
                }
                $result ? echoSuccess() : echoFail();
            }
        }
    }

    /**
     * 创建普通用户
     */
    public function user()
    {
        if ($this->form_validation->run('auth_register') === FALSE) {
            $errors = $this->form_validation->error_array();
            echoFail($errors);
        } else {
            $data = $this->input->post();
            $result = $this->UserModel->user_create($data);
            $result ? echoSuccess() : echoFail();
        }
    }

}