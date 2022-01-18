<?php
/**
 * @link        http://www.phpcorner.net
 * @author      qingbing<780042175@qq.com>
 * @copyright   Chengdu Qb Technology Co., Ltd.
 */

namespace YiiConfigure\block\frontend\interfaces;

use YiiHelper\services\interfaces\IService;

/**
 * 接口: 区块展示
 *
 * Interface IBlockService
 * @package YiiConfigure\block\frontend\interfaces
 */
interface IBlockService extends IService
{
    /**
     * 获取区块信息
     *
     * @param array $params
     * @return mixed
     */
    public function info(array $params);
}