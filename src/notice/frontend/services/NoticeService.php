<?php
/**
 * @link        http://www.phpcorner.net
 * @author      qingbing<780042175@qq.com>
 * @copyright   Chengdu Qb Technology Co., Ltd.
 */

namespace YiiConfigure\notice\frontend\services;


use YiiConfigure\notice\frontend\interfaces\INoticeService;
use YiiConfigure\notice\models\Notice;
use YiiHelper\abstracts\Service;
use YiiHelper\helpers\Pager;
use Zf\Helper\Exceptions\NotFoundHttpException;
use Zf\Helper\Format;

/**
 * 服务(前台使用): 前端展示公告
 *
 * Class NoticeService
 * @package YiiConfigure\notice\frontend\services
 */
class NoticeService extends Service implements INoticeService
{
    /**
     * 小模块展示列表
     *
     * @param array $params
     * @return array
     */
    public function block(array $params = []): array
    {
        // 构建查询
        $query = Notice::find()
            ->select([
                'id',
                'title',
                'tag',
                'author',
                'is_top',
                'expire_begin_date',
                'access_times',
            ])
            ->orderBy('is_top DESC, id DESC')
            ->andWhere(['=', 'is_enable', IS_YES]);
        // 是否有效查询
        $this->expireWhere($query, IS_YES, 'expire_begin_date', 'expire_end_date');
        // 显示查询条数
        $query->limit($params['limit'] ?? 5);
        // 获取查询结果
        return $query->asArray()
            ->all();
    }

    /**
     * 公告分页列表
     *
     * @param array|null $params
     * @return array
     */
    public function list(array $params = []): array
    {
        $query = Notice::find()
            ->select([
                'id',
                'title',
                'tag',
                'description',
                'author',
                'is_top',
                'expire_begin_date',
                'expire_end_date',
                'access_times',
                'access_at',
                'updated_at',
            ])
            ->orderBy('is_top DESC, id DESC')
            ->andWhere(['=', 'is_enable', IS_YES]);
        // 是否有效查询
        $this->expireWhere($query, IS_YES, 'expire_begin_date', 'expire_end_date');
        // 等于查询
        $this->attributeWhere($query, $params, [
            'is_top',
        ]);
        // like 查询
        $this->likeWhere($query, $params, ['title']);
        // 分页查询
        return Pager::getInstance()->pagination($query, $params['pageNo'], $params['pageSize']);
    }

    /**
     * 查看公告详情
     *
     * @param array $params
     * @return mixed
     */
    public function detail(array $params)
    {
        $query = Notice::find()
            ->select([
                'id',
                'title',
                'tag',
                'description',
                'content',
                'author',
                'is_top',
                'expire_begin_date',
                'expire_end_date',
                'access_times',
                'access_at',
                'created_at',
                'updated_at',
            ])
            ->andWhere(['=', 'is_enable', IS_YES])
            ->andWhere(['=', 'id', $params['id'] ?? null]);

        // 是否有效查询
        $this->expireWhere($query, IS_YES, 'expire_begin_date', 'expire_end_date');
        // 数据查询
        $model = $query->one();
        if (empty($model)) {
            throw new NotFoundHttpException("公告不存在或已过期");
        }
        // 记录访问信息
        $model->access_times += 1;
        $model->access_at    = Format::datetime();
        $model->save();
        return $model;
    }
}