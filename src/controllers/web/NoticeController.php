<?php
/**
 * @link        http://www.phpcorner.net
 * @author      qingbing<780042175@qq.com>
 * @copyright   Chengdu Qb Technology Co., Ltd.
 */

namespace YiiConfigure\controllers\web;


use YiiConfigure\notice\interfaces\IWebNoticeService;
use YiiConfigure\notice\services\WebNoticeService;
use YiiHelper\abstracts\RestController;

/**
 * 控制器(web): 前端展示公告
 *
 * Class NoticeController
 * @package YiiConfigure\controllers\web
 */
class NoticeController extends RestController
{
    public $serviceInterface = IWebNoticeService::class;
    public $serviceClass     = WebNoticeService::class;

    /**
     * 小模块展示列表
     *
     * @return array
     */
    public function actionBlock()
    {
        // TODO: Implement block() method.
    }

    /**
     * 公告分页列表
     *
     * @return array
     */
    public function actionList()
    {
        // TODO: Implement list() method.
    }

    /**
     * 查看公告详情
     *
     * @return mixed
     */
    public function actionDetail()
    {
        // TODO: Implement detail() method.
    }
}