<?php
/**
 * @link        http://www.phpcorner.net
 * @author      qingbing<780042175@qq.com>
 * @copyright   Chengdu Qb Technology Co., Ltd.
 */

namespace YiiConfigure\replaceSetting\backend\services;


use yii\base\Action;
use YiiConfigure\replaceSetting\backend\interfaces\IReplaceSettingSuperService;
use YiiConfigure\replaceSetting\models\ReplaceSetting;
use YiiHelper\abstracts\Service;
use YiiHelper\helpers\Pager;
use YiiHelper\helpers\Req;
use Zf\Helper\Exceptions\BusinessException;
use Zf\Helper\Exceptions\ForbiddenHttpException;
use Zf\Helper\Exceptions\UnsupportedException;

/**
 * 服务类: 替换配置
 *
 * Class ReplaceSettingSuperService
 * @package YiiConfigure\replaceSetting\backend\services
 */
class ReplaceSettingSuperService extends Service implements IReplaceSettingSuperService
{
    /**
     * 在action前统一执行
     *
     * @param Action|null $action
     * @return bool
     * @throws ForbiddenHttpException
     */
    public function beforeAction(Action $action = null)
    {
        if (!Req::getIsSuper()) {
            throw new ForbiddenHttpException('您不是超级管理员，无权操作');
        }
        return parent::beforeAction($action);
    }

    /**
     * 替换配置列表
     *
     * @param array|null $params
     * @return array
     */
    public function list(array $params = []): array
    {
        $query = ReplaceSetting::find()
            ->select([
                "code",
                "name",
                "description",
                "IFNULL(content, template)",
                "sort_order",
                "is_open",
                "replace_fields",
            ])
            ->orderBy('sort_order ASC');
        // 等于查询
        $this->attributeWhere($query, $params, 'is_open');
        // like 查询
        $this->likeWhere($query, $params, ['code', 'name']);
        return Pager::getInstance()->pagination($query, $params['pageNo'], $params['pageSize']);
    }

    /**
     * 添加替换配置
     *
     * @param array $params
     * @return bool
     * @throws BusinessException
     */
    public function add(array $params): bool
    {
        throw new UnsupportedException("该功能未开通，可考虑通过SQL实现");
    }

    /**
     * 编辑替换配置
     *
     * @param array $params
     * @return bool
     * @throws BusinessException
     * @throws \yii\db\Exception
     */
    public function edit(array $params): bool
    {
        $model = $this->getModel($params);
        unset($params['code']);
        $model->setFilterAttributes($params);
        return $model->saveOrException();
    }

    /**
     * 替换配置设置成默认内容
     *
     * @param array $params
     * @return bool
     * @throws BusinessException
     * @throws \yii\db\Exception
     */
    public function setDefault(array $params = []): bool
    {
        $model          = $this->getModel($params);
        $model->content = NULL;
        return $model->saveOrException();
    }

    /**
     * 删除替换配置
     *
     * @param array $params
     * @return bool
     * @throws BusinessException
     */
    public function del(array $params): bool
    {
        throw new UnsupportedException("该功能未开通，但不建议通过SQL实现");
    }

    /**
     * 查看详情
     *
     * @param array $params
     * @return mixed|ReplaceSetting
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
     * @return ReplaceSetting
     * @throws BusinessException
     */
    protected function getModel(array $params): ReplaceSetting
    {
        $model = ReplaceSetting::findOne([
            'code' => $params['code'] ?? null
        ]);
        if (null === $model) {
            throw new BusinessException("替换配置不存在");
        }
        return $model;
    }
}