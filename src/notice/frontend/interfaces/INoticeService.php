<?php
/**
 * @link        http://www.phpcorner.net
 * @author      qingbing<780042175@qq.com>
 * @copyright   Chengdu Qb Technology Co., Ltd.
 */

namespace YiiConfigure\notice\frontend\interfaces;


use YiiHelper\services\interfaces\IService;

/**
 * 接口(前台使用): 前端展示公告
 *
 * Interface INoticeService
 * @package YiiConfigure\notice\frontend\interfaces
 */
interface INoticeService extends IService
{
    /**
     * 小模块展示列表
     *
     * @param array $params
     * @return array
     */
    public function block(array $params = []): array;

    /**
     * 公告分页列表
     *
     * @param array|null $params
     * @return array
     */
    public function list(array $params = []): array;

    /**
     * 查看公告详情
     *
     * @param array $params
     * @return mixed
     */
    public function detail(array $params);
}
