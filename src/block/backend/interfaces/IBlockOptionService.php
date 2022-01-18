<?php
/**
 * @link        http://www.phpcorner.net
 * @author      qingbing<780042175@qq.com>
 * @copyright   Chengdu Qb Technology Co., Ltd.
 */

namespace YiiConfigure\block\backend\interfaces;


use YiiHelper\services\interfaces\ICurdService;

/**
 * 接口: 区块选项管理
 *
 * Interface IBlockOptionService
 * @package YiiConfigure\block\backend\interfaces
 */
interface IBlockOptionService extends ICurdService
{
    /**
     * 刷新区块中选项排序
     *
     * @param array $params
     * @return bool
     */
    public function refreshOrder(array $params): bool;

    /**
     * 上移选项顺序
     *
     * @param array $params
     * @return bool
     */
    public function orderUp(array $params): bool;

    /**
     * 下移选项顺序
     *
     * @param array $params
     * @return bool
     */
    public function orderDown(array $params): bool;
}