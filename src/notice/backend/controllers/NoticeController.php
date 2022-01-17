<?php
/**
 * @link        http://www.phpcorner.net
 * @author      qingbing<780042175@qq.com>
 * @copyright   Chengdu Qb Technology Co., Ltd.
 */

namespace YiiConfigure\notice\backend\controllers;


use Exception;
use YiiConfigure\notice\backend\interfaces\INoticeService;
use YiiConfigure\notice\backend\services\NoticeService;
use YiiConfigure\notice\models\Notice;
use YiiHelper\abstracts\RestController;
use Zf\Helper\Traits\Models\TLabelEnable;

/**
 * 控制器: 后台公告管理
 *
 * Class NoticeController
 * @package YiiConfigure\notice\backend\controllers
 * @property-read INoticeService $service
 */
class NoticeController extends RestController
{
    public $serviceInterface = INoticeService::class;
    public $serviceClass     = NoticeService::class;

    /**
     * 公告列表
     *
     * @return array
     * @throws Exception
     */
    public function actionList()
    {
        // 参数验证和获取
        $params = $this->validateParams([
            ['title', 'string', 'label' => '标题'],
            ['tag', 'string', 'label' => '标签'],
            ['description', 'string', 'label' => '描述'],
            ['author', 'string', 'label' => '发布者'],
            ['is_top', 'boolean', 'label' => '是否置顶'],
            ['is_enable', 'in', 'range' => array_keys(TLabelEnable::enableLabels()), 'label' => '启用状态'],
            // 有效期规则
            ['isExpire', 'boolean', 'label' => '是否有效'],
        ], null, true);
        // 业务处理
        $res = $this->service->list($params);
        // 渲染结果
        return $this->success($res, '公告列表');
    }

    /**
     * 添加公告
     *
     * @return array
     * @throws Exception
     */
    public function actionAdd()
    {
        // 参数验证和获取
        $params = $this->validateParams([
            [['title', 'content', 'expire_begin_date'], 'required'],
            ['title', 'string', 'label' => '标题'],
            ['content', 'string', 'label' => '内容'],
            ['tag', 'string', 'label' => '标签'],
            ['description', 'string', 'label' => '描述'],
            ['author', 'string', 'label' => '发布者'],
            ['is_top', 'boolean', 'default' => '0', 'label' => '是否置顶'],
            ['is_enable', 'in', 'default' => '0', 'range' => array_keys(TLabelEnable::enableLabels()), 'label' => '启用状态'],
            [
                'expire_ip',
                'each',
                'label' => '有效IP地址',
                'rule'  => [
                    'ip'
                ]
            ],
            ['expire_begin_date', 'datetime', 'label' => '生效日期', 'format' => 'php:Y-m-d'],
            ['expire_end_date', 'datetime', 'label' => '失效日期', 'format' => 'php:Y-m-d'],
        ]);
        // 业务处理
        $res = $this->service->add($params);
        // 渲染结果
        return $this->success($res, '添加公告成功');
    }

    /**
     * 编辑公告
     *
     * @return array
     * @throws Exception
     */
    public function actionEdit()
    {
        // 参数验证和获取
        $params = $this->validateParams([
            [['id', 'title', 'content', 'expire_begin_date'], 'required'],
            ['id', 'exist', 'label' => 'ID', 'targetClass' => Notice::class, 'targetAttribute' => 'id'],
            ['title', 'string', 'label' => '标题'],
            ['content', 'string', 'label' => '内容'],
            ['tag', 'string', 'label' => '标签'],
            ['description', 'string', 'label' => '描述'],
            ['author', 'string', 'label' => '发布者'],
            ['is_top', 'boolean', 'default' => '0', 'label' => '是否置顶'],
            ['is_enable', 'in', 'default' => '0', 'range' => array_keys(TLabelEnable::enableLabels()), 'label' => '启用状态'],
            [
                'expire_ip',
                'each',
                'label' => '有效IP地址',
                'rule'  => [
                    'ip'
                ]
            ],
            ['expire_begin_date', 'datetime', 'label' => '生效日期', 'format' => 'php:Y-m-d'],
            ['expire_end_date', 'datetime', 'label' => '失效日期', 'format' => 'php:Y-m-d'],
        ]);
        // 业务处理
        $res = $this->service->edit($params);
        // 渲染结果
        return $this->success($res, '编辑公告成功');
    }

    /**
     * 删除公告
     *
     * @return array
     * @throws Exception
     */
    public function actionDel()
    {
        // 参数验证和获取
        $params = $this->validateParams([
            [['id'], 'required'],
            ['id', 'exist', 'label' => 'ID', 'targetClass' => Notice::class, 'targetAttribute' => 'id'],
        ]);
        // 业务处理
        $res = $this->service->del($params);
        // 渲染结果
        return $this->success($res, '删除公告成功');
    }

    /**
     * 查看公告详情
     *
     * @return array
     * @throws Exception
     */
    public function actionView()
    {
        // 参数验证和获取
        $params = $this->validateParams([
            [['id'], 'required'],
            ['id', 'exist', 'label' => 'ID', 'targetClass' => Notice::class, 'targetAttribute' => 'id'],
        ]);
        // 业务处理
        $res = $this->service->view($params);
        // 渲染结果
        return $this->success($res, '查看公告详情');
    }
}