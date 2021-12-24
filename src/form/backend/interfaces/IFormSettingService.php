<?php
/**
 * @link        http://www.phpcorner.net
 * @author      qingbing<780042175@qq.com>
 * @copyright   Chengdu Qb Technology Co., Ltd.
 */

namespace YiiConfigure\form\backend\interfaces;

/**
 * 接口: 配置表单管理
 *
 * Interface IFormSettingService
 * @package YiiConfigure\form\backend\interfaces
 */
interface IFormSettingService
{
    /**
     * 获取配置表单选项
     *
     * @param array $params
     * @return bool
     */
    public function get(array $params);

    /**
     * 保存配置表单数据
     *
     * @param array $params
     * @return bool
     */
    public function save(array $params): bool;
}