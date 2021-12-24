<?php
/**
 * @link        http://www.phpcorner.net
 * @author      qingbing<780042175@qq.com>
 * @copyright   Chengdu Qb Technology Co., Ltd.
 */

namespace YiiConfigure\replaceSetting\backend\controllers;


use Exception;
use YiiConfigure\replaceSetting\backend\interfaces\IReplaceSettingService;
use YiiConfigure\replaceSetting\backend\services\ReplaceSettingService;
use YiiConfigure\replaceSetting\models\ReplaceSetting;
use YiiHelper\abstracts\RestController;

/**
 * 控制器: 替换配置(web，只为编辑内容提供接口输出)
 *
 * Class ReplaceSettingController
 * @package YiiConfigure\replaceSetting\backend\controllers
 *
 * @property-read IReplaceSettingService $service
 */
class ReplaceSettingController extends RestController
{
    public $serviceInterface = IReplaceSettingService::class;
    public $serviceClass     = ReplaceSettingService::class;

    /**
     * 启用状态的替换配置做成选项
     *
     * @return array
     * @throws Exception
     */
    public function actionOptions()
    {
        // 业务处理
        $res = $this->service->options();
        // 渲染结果
        return $this->success($res, '替换选项');
    }

    /**
     * 开放状态的替换配置设置成默认内容
     *
     * @return array
     * @throws Exception
     */
    public function actionSetDefault()
    {
        // 参数验证和获取
        $params = $this->validateParams([
            [['code'], 'required'],
            ['code', 'exist', 'label' => '标识码', 'targetClass' => ReplaceSetting::class, 'targetAttribute' => 'code'],
        ]);
        // 业务处理
        $res = $this->service->setDefault($params);
        // 渲染结果
        return $this->success($res, '设置成功');
    }

    /**
     * 保存替换配置内容
     *
     * @return array
     * @throws Exception
     */
    public function actionSave()
    {
        // 参数验证和获取
        $params = $this->validateParams([
            [['code', 'content'], 'required'],
            ['code', 'exist', 'label' => '标识码', 'targetClass' => ReplaceSetting::class, 'targetAttribute' => 'code'],
            ['content', 'safe', 'label' => '模板'],
        ]);
        // 业务处理
        $res = $this->service->save($params);
        // 渲染结果
        return $this->success($res, '保存替换配置内容成功');
    }

    /**
     * 替换配置详情
     *
     * @return array
     * @throws Exception
     */
    public function actionDetail()
    {
        // 参数验证和获取
        $params = $this->validateParams([
            [['code'], 'required'],
            ['code', 'exist', 'label' => '标识码', 'targetClass' => ReplaceSetting::class, 'targetAttribute' => 'code'],
        ]);
        // 业务处理
        $res = $this->service->detail($params);
        // 渲染结果
        return $this->success($res, '替换配置详情');
    }
}