<?php
/**
 * @link        http://www.phpcorner.net
 * @author      qingbing<780042175@qq.com>
 * @copyright   Chengdu Qb Technology Co., Ltd.
 */

namespace YiiConfigure\replaceSetting\interfaces;


use YiiHelper\services\interfaces\ICurdService;

/**
 * 接口类: 替换配置
 *
 * Interface IReplaceSettingService
 * @package YiiConfigure\replaceSetting\interfaces
 */
interface IReplaceSettingService extends ICurdService
{
    /**
     * 替换配置设置成默认内容
     *
     * @param array $params
     * @return bool
     */
    public function setDefault(array $params = []): bool;
}
