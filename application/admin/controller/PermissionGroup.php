<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2019/5/29
 * Time: 14:42
 */

namespace app\admin\controller;

use app\admin\agency\permissionGroup as agency;
use think\Exception;

/**
 * Class PermissionGroup
 * @package app\admin\controller
 */
class PermissionGroup extends Base
{
    public function initialize()
    {
        parent::initialize(); // TODO: Change the autogenerated stub
        $this->url = '/' . $this->backendPrefix . '/user/permission/group/list.html';
    }

    /**
     * @return mixed
     */
    public function index()
    {
        $data = (new agency())->getAll();
        if ($data['status'] == true) {
            $this->assign('data', $data['data']);
            $this->assign('count', count($data['data']));
        }
        if ($data['status'] == false) {
            //todo:: 异常处理
        }
        return $this->fetch();
    }

    /**
     * @return mixed
     */
    public function add()
    {
        $this->agency = new agency();
        if (request()->isGet()) {
            return $this->fetch();
        } elseif (request()->isPost()) {
            $data = input('post.');
            $result = (new agency())->saveData($data);
            if ($result['status'] == false) {
                return show($result['status'], $result['message']);
            }
            return show($result['status'], $result['message'], $this->url);
        }
    }

    /**
     * @param $id
     */
    public function edit($id)
    {
        $this->agency = new agency();
        if (request()->isGet()) {
            $result = (new agency())->getDataById(['id' => $id]);
            if ($result['status'] == false) {
                //todo:: 异常了
                return $this->error($result['message'], $this->url);
            } else {
                $this->assign('data', $result['data']);
            }
            return $this->fetch();
        }
        if (request()->isPost()) {
            $data = input('post.');
            $result = (new agency())->saveData($data);
            if ($result['status'] == false) {
                return show($result['status'], $result['message']);
            }
            return show($result['status'], $result['message'], $this->url);
        }
    }
}