<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2019/6/26
 * Time: 11:51
 */

namespace app\home\controller;


use app\common\agency\category;
use app\common\agency\article as ArticleAgency;

/***
 * Class Article
 * @package app\home\controller
 */
class Article extends Base
{
    /***
     * @param $category
     * @return mixed
     * 1、根据category 名 来查出他自己的SEO信息 以及 他的之分类ID 并组合成ids数组
     */
    public function lists($category)
    {
        if (request()->isGet()) {
            if(!isset($category)){
                return "hello";
            }
            $categorys = (new category())->getChild($category, $this->language['id']); // 获取SEO信息 以及 他的子分类ID
            $ids = $categorys['ids'];
            $data = (new category())->getDataByIds($category, $ids, $this->language['id']);//根据分类ID（ID为Int的一个数组）
            $this->assign('seo', $categorys['category']);
            $this->assign('data', $data);
            return $this->fetch($this->theme . '/article/lists.html');
        }
    }

    public function details($url_title)
    {
        if (request()->isGet()) {
            $result = (new ArticleAgency())->getDataByUrl_title($url_title);
            if ($result['status']) {
                $this->assign('data', $result['data']);
            }
            return $this->fetch($this->theme . '/article/details.html');
        }
    }
}