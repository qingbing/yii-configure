<?php
/**
 * @link        http://www.phpcorner.net
 * @author      qingbing<780042175@qq.com>
 * @copyright   Chengdu Qb Technology Co., Ltd.
 */

namespace YiiConfigure\notice\backend\services;


use Yii;
use YiiConfigure\notice\backend\interfaces\INoticeService;
use YiiConfigure\notice\models\Notice;
use YiiHelper\abstracts\Service;
use YiiHelper\helpers\Pager;
use Zf\Helper\Exceptions\BusinessException;
use Zf\Helper\Format;
use Zf\PhpAnalysis\PhpAnalysis;

/**
 * 服务: 后台公告管理
 *
 * Class NoticeService
 * @package YiiConfigure\notice\backend\services
 */
class NoticeService extends Service implements INoticeService
{
    /**
     * 公告列表
     *
     * @param array|null $params
     * @return array
     */
    public function list(array $params = []): array
    {
        $query = Notice::find()
            ->orderBy('id DESC');
        // 等于查询
        $this->attributeWhere($query, $params, [
            'is_top',
            'is_enable',
        ]);
        // like 查询
        $this->likeWhere($query, $params, ['title', 'tag', 'description', 'author']);
        // 是否有效查询
        if (isset($params['isExpire'])) {
            $this->expireWhere($query, $params['isExpire'], 'expire_begin_date', 'expire_end_date');
        }
        // 分页查询
        return Pager::getInstance()->pagination($query, $params['pageNo'], $params['pageSize']);
    }

    /**
     * 添加公告
     *
     * @param array $params
     * @return bool
     * @throws \yii\base\InvalidConfigException
     * @throws \yii\db\Exception
     */
    public function add(array $params): bool
    {
        // 公告关键字
        $params['tag'] = $params['tag'] ?: PhpAnalysis::getInstance()->start($params['content'])->getFinallyKeywords(3, false);
        // 创建模型
        $model = Yii::createObject(Notice::class);
        $model->setFilterAttributes($params);
        return $model->saveOrException();
    }

    /**
     * 编辑公告
     *
     * @param array $params
     * @return bool
     * @throws BusinessException
     * @throws \yii\db\Exception
     */
    public function edit(array $params): bool
    {
        $model = $this->getModel($params);
        unset($params['id']);
        // 公告关键字
        $params['tag'] = $params['tag'] ?: PhpAnalysis::getInstance()->start($params['content'])->getFinallyKeywords(3, false);
        // 更新时间
        $params['updated_at'] = Format::datetime();
        $model->setFilterAttributes($params);
        return $model->saveOrException();
    }

    /**
     * 删除公告
     *
     * @param array $params
     * @return bool
     * @throws BusinessException
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function del(array $params): bool
    {
        $model = $this->getModel($params);
        return $model->delete();
    }

    /**
     * 查看公告详情
     *
     * @param array $params
     * @return mixed|Notice
     * @throws BusinessException
     */
    public function view(array $params)
    {
        return $this->getModel($params);
    }

    /**
     * 获取当前操作模型
     *
     * @param array $params
     * @return Notice
     * @throws BusinessException
     */
    protected function getModel(array $params): Notice
    {
        $model = Notice::findOne([
            'id' => $params['id'] ?? null,
        ]);
        if (null === $model) {
            throw new BusinessException("表单选项不存在");
        }
        return $model;
    }
}