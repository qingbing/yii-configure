<?php
/**
 * @link        http://www.phpcorner.net
 * @author      qingbing<780042175@qq.com>
 * @copyright   Chengdu Qb Technology Co., Ltd.
 */

namespace YiiConfigure\replaceSetting\services;


use Exception;
use yii\base\Action;
use YiiConfigure\replaceSetting\interfaces\IWebReplaceSettingService;
use YiiConfigure\replaceSetting\models\ReplaceSetting;
use YiiHelper\abstracts\Service;
use YiiHelper\helpers\Req;
use Zf\Helper\Exceptions\BusinessException;
use Zf\Helper\Exceptions\ForbiddenHttpException;

/**
 * 服务类: 替换配置(web，只为编辑内容提供接口输出)
 *
 * Class WebReplaceSettingService
 * @package YiiConfigure\replaceSetting\services
 */
class WebReplaceSettingService extends Service implements IWebReplaceSettingService
{
    /**
     * @var ReplaceSetting
     */
    protected $setting;

    /**
     * 在action前统一执行
     *
     * @param Action|null $action
     * @return bool
     * @throws Exception
     */
    public function beforeAction(Action $action = null)
    {
        if ('options' !== $action->id) {
            $this->setting = ReplaceSetting::findOne([
                'code' => $action->controller->getParam('code', null),
            ]);
            if (null === $this->setting) {
                throw new BusinessException("替换配置不存在");
            }
            if (!$this->setting->is_open && !Req::getIsSuper()) {
                throw new ForbiddenHttpException("您无权操作该配置");
            }
        }
        return parent::beforeAction($action);
    }

    /**
     * 开放状态的替换配置做成选项
     *
     * @return array
     */
    public function options(): array
    {
        $query = ReplaceSetting::find()
            ->select([
                "code",
                "name",
            ])
            ->andWhere(['=', 'is_open', IS_YES])
            ->orderBy('sort_order ASC');
        return $query->asArray()
            ->all();
    }

    /**
     * 开放状态的替换配置设置成默认内容
     *
     * @param array $params
     * @return bool
     * @throws \yii\db\Exception
     */
    public function setDefault(array $params = []): bool
    {
        $model          = $this->setting;
        $model->content = NULL;
        return $model->saveOrException();
    }

    /**
     * 保存替换配置内容
     *
     * @param array $params
     * @return bool
     * @throws \yii\db\Exception
     */
    public function save(array $params = []): bool
    {
        $model          = $this->setting;
        $model->content = $params['content'];
        return $model->saveOrException();
    }

    /**
     * 替换配置详情
     *
     * @param array $params
     * @return array
     */
    public function detail(array $params = []): array
    {
        $model = $this->setting;
        return [
            "code"           => $model->code,
            "name"           => $model->name,
            "description"    => $model->description,
            "content"        => $model->content ?: $model->template,
            "replace_fields" => $model->replace_fields,
        ];
    }
}