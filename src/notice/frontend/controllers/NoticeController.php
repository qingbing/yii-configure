<?php
/**
 * @link        http://www.phpcorner.net
 * @author      qingbing<780042175@qq.com>
 * @copyright   Chengdu Qb Technology Co., Ltd.
 */

namespace YiiConfigure\notice\frontend\controllers;


use Exception;
use YiiConfigure\notice\frontend\interfaces\INoticeService;
use YiiConfigure\notice\frontend\services\NoticeService;
use YiiHelper\abstracts\RestController;
use Zf\Helper\Traits\Models\TLabelYesNo;

/**
 * 控制器(前台使用): 前端展示公告
 *
 * Class NoticeController
 * @package YiiConfigure\notice\frontend\controllers
 *
 * @property-read INoticeService $service
 */
class NoticeController extends RestController
{
    public $serviceInterface = INoticeService::class;
    public $serviceClass     = NoticeService::class;

    /**
     * 小模块展示列表
     *
     * @return array
     * @throws Exception
     */
    public function actionBlock()
    {
        // 参数验证和获取
        $params = $this->validateParams([
            ['limit', 'integer', 'label' => '显示条数', 'default' => 5],
        ]);
        // 业务处理
        $res = $this->service->block($params);
        // 渲染结果
        return $this->success($res, '区块展示');
    }

    /**
     * 公告分页列表
     *
     * @return array
     * @throws Exception
     */
    public function actionList()
    {
        // 参数验证和获取
        $params = $this->validateParams([
            ['title', 'string', 'label' => '标题'],
            ['is_top', 'boolean', 'label' => '置顶'],
        ], null, true);
        // 业务处理
        $res = $this->service->list($params);
        // 渲染结果
        return $this->success($res, '公告列表');
    }

    /**
     * 查看公告详情
     *
     * @return array
     * @throws Exception
     */
    public function actionDetail()
    {
        // 参数验证和获取
        $params = $this->validateParams([
            ['id', 'string', 'label' => 'id'],
        ], null, true);
        // 业务处理
        $res = $this->service->detail($params);
        // 渲染结果
        return $this->success($res, '公告详情');
    }
}