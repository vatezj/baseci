<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/3/7
 * Time: 10:30
 */
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . 'libraries/REST_Controller.php';

use Restserver\Libraries\REST_Controller;

class Test extends REST_Controller
{

    function __construct()
    {
        parent::__construct();
    }

    public function test_get()
    {
        echo 1;
    }
}