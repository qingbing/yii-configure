<?php
/**
 * @link        http://www.phpcorner.net
 * @author      qingbing<780042175@qq.com>
 * @copyright   Chengdu Qb Technology Co., Ltd.
 */

namespace YiiConfigure\block\frontend\controllers;


use Exception;
use YiiConfigure\block\frontend\interfaces\IBlockService;
use YiiConfigure\block\frontend\services\BlockService;
use YiiConfigure\block\models\BlockCategory;
use YiiHelper\abstracts\RestController;

/**
 * 控制器: 区块展示
 *
 * Class BlockController
 * @package YiiConfigure\block\frontend\controllers
 *
 * @property-read IBlockService $service
 */
class BlockController extends RestController
{
    public $serviceInterface = IBlockService::class;
    public $serviceClass     = BlockService::class;

    /**
     * 获取区块信息
     *
     * @return array
     * @throws Exception
     */
    public function actionInfo()
    {
        // 参数验证和获取
        $params = $this->validateParams([
            [['key'], 'required'],
            ['key', 'exist', 'label' => '引用标识', 'targetClass' => BlockCategory::class, 'targetAttribute' => 'key'],
        ]);
        // 业务处理
        $res = $this->service->info($params);
        // 渲染结果
        return $this->success($res, '区块信息');
    }
}