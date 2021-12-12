<?php
/**
 * @link        http://www.phpcorner.net
 * @author      qingbing<780042175@qq.com>
 * @copyright   Chengdu Qb Technology Co., Ltd.
 */

namespace YiiConfigure\form\services;


use YiiConfigure\form\interfaces\IFormSettingService;
use YiiConfigure\form\logic\FormSetting;
use YiiHelper\abstracts\Service;
use Zf\Helper\Exceptions\BusinessException;

/**
 * 服务: 配置表单管理
 *
 * Class FormSettingService
 * @package YiiConfigure\form\services
 */
class FormSettingService extends Service implements IFormSettingService
{
    /**
     * 获取配置表单选项
     *
     * @param array $params
     * @return bool|mixed|string|null
     */
    public function get(array $params)
    {
        return FormSetting::getInstance($params['key'])->get();
    }

    /**
     * 保存配置表单数据
     *
     * @param array $params
     * @return bool
     * @throws BusinessException
     * @throws \yii\base\InvalidConfigException
     * @throws \yii\db\Exception
     */
    public function save(array $params): bool
    {
        return FormSetting::getInstance($params['key'])->save($params);
    }
}