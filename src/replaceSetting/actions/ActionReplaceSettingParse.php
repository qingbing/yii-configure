<?php
/**
 * @link        http://www.phpcorner.net
 * @author      qingbing<780042175@qq.com>
 * @copyright   Chengdu Qb Technology Co., Ltd.
 */

namespace YiiConfigure\replaceSetting\actions;


use Exception;
use yii\base\Action;
use YiiConfigure\replaceSetting\logic\ReplaceSetting as ReplaceSettingLogic;
use YiiConfigure\replaceSetting\models\ReplaceSetting;
use YiiHelper\traits\TResponse;
use YiiHelper\traits\TValidator;

/**
 * 操作: 获取最终替换的文本
 *
 * Class ActionReplaceSettingParse
 * @package YiiConfigure\replaceSetting\actions
 */
class ActionReplaceSettingParse extends Action
{
    use TValidator;
    use TResponse;

    /**
     * 获取最终替换的文本
     *
     * @return array
     * @throws Exception
     */
    public function run()
    {
        // 参数验证和获取
        $params = $this->validateParams([
            [['code', 'fields'], 'required'],
            ['code', 'exist', 'label' => '表头标记', 'targetClass' => ReplaceSetting::class, 'targetAttribute' => 'code'],
            ['fields', 'safe', 'label' => '替换字段'],
        ]);
        // 渲染结果
        return $this->success(ReplaceSettingLogic::getInstance($params['code'])->getContent($params['fields']));
    }
}