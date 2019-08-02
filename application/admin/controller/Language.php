<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2019/6/6
 * Time: 17:52
 */

namespace app\admin\controller;

use app\admin\agency\language as agency;

/***
 * Class Language
 * @package app\admin\controller
 */
class Language extends Base
{
    public function initialize()
    {
        parent::initialize();
        $this->url = '/' . $this->backendPrefix . '/system/language/list.html';
    }

    /***
     * @return mixed
     */
    public function index()
    {
        $result = (new agency())->getAll();
        if ($result['status'] == true) {
            $this->assign('data', $result['data']);
        }
        return $this->fetch();
    }

    /***
     * @return mixed
     */
    public function add()
    {
        if (request()->isGet()) {
            return $this->fetch();
        }
        if (request()->isPost()) {
            $data = input('post.');
            $result = (new agency())->saveData($data);
            if ($result['status']) {
                return show($result['status'], $result['message'], $this->url);
            } else {
                return show($result['status'], $result['message']);
            }
        }
    }

    /***
     * @param $id
     */
    public function edit($id)
    {
        if (request()->isGet()) {
            $result = (new agency())->getDataById(['id' => $id]);
            if ($result['status']) {
                $this->assign('data', $result['data']);
            } else {
                return show($result['status'], $result['message']);
            }
            return $this->fetch();
        }
        if (request()->isPost()) {
            $data = input('post.');
            $result = (new agency())->saveData($data);
            if ($result['status']) {
                return show($result['status'], $result['message'], $this->url);
            } else {
                return show($result['status'], $result['message']);
            }
        }
    }
}