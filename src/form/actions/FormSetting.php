<?php
/**
 * @link        http://www.phpcorner.net
 * @author      qingbing<780042175@qq.com>
 * @copyright   Chengdu Qb Technology Co., Ltd.
 */

namespace YiiConfigure\form\actions;


use yii\base\Action;
use YiiConfigure\form\logic\FormSetting as FormSettingLogic;
use YiiConfigure\form\models\FormCategory;
use YiiHelper\traits\TResponse;
use YiiHelper\traits\TValidator;

/**
 * 操作: 获取表单配置
 *
 * Class FormSetting
 * @package YiiConfigure\form\actions
 */
class FormSetting extends Action
{
    use TValidator;
    use TResponse;

    /**
     * 获取表单配置
     *
     * @return bool|mixed|string|null
     * @return array
     * @throws \Zf\Helper\Exceptions\BusinessException
     * @throws \yii\base\InvalidConfigException
     */
    public function run()
    {
        // 参数验证和获取
        $params = $this->validateParams([
            ['key', 'required'],
            ['key', 'exist', 'label' => '表单标记', 'targetClass' => FormCategory::class, 'targetAttribute' => 'key'],
        ]);
        return $this->success(FormSettingLogic::getInstance($params['key'])->get());
    }
}