<?php
/**
 * @link        http://www.phpcorner.net
 * @author      qingbing<780042175@qq.com>
 * @copyright   Chengdu Qb Technology Co., Ltd.
 */

namespace YiiConfigure\controllers\web;


use YiiConfigure\form\actions\ActionFormOption;
use YiiConfigure\tableHeader\actions\ActionTableHeaderOptions;
use YiiHelper\abstracts\RestController;

/**
 * 控制器(transmit): 对外提供服务
 *
 * Class PublicController
 * @package YiiConfigure\controllers\web
 */
class PublicController extends RestController
{
    /**
     * 操作集合
     *
     * @return array
     */
    public function actions()
    {
        return [
            // 获取表头类型选项
            'header-options' => ActionTableHeaderOptions::class,
            // 获取表单类型选项
            'form-options'   => ActionFormOption::class,
        ];
    }
}