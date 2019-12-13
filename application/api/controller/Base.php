<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2019/5/17
 * Time: 10:13
 */

namespace app\api\controller;


use think\Controller;

/**
 * Class Base
 * @package app\api\controller
 */
class Base extends Controller
{
    public function initialize()
    {
        parent::initialize(); // TODO: Change the autogenerated stub
        header('Access-Control-Allow-Origin:*');
        header('Access-Control-Allow-Methods:*');
        header('Access-Control-Allow-Headers:*');
        header('Access-Control-Allow-Credentials:false');
    }
}