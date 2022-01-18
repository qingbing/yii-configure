<?php
/**
 * @link        http://www.phpcorner.net
 * @author      qingbing<780042175@qq.com>
 * @copyright   Chengdu Qb Technology Co., Ltd.
 */

namespace YiiConfigure\block\frontend\services;

use YiiConfigure\block\frontend\interfaces\IBlockService;
use YiiConfigure\block\models\BlockCategory;
use YiiConfigure\block\models\BlockOption;
use YiiHelper\abstracts\Service;

/**
 * 服务: 区块展示
 *
 * Class BlockService
 * @package YiiConfigure\block\frontend\services
 */
class BlockService extends Service implements IBlockService
{
    /**
     * 获取区块信息
     *
     * @param array $params
     * @return mixed
     */
    public function info(array $params)
    {
        // 类型
        $category = BlockCategory::find()
            ->select([
                'is_enable',
                'key',
                'type',
                'name',
                'description',
                'src',
                'content',
            ])
            ->andWhere(['=', 'key', $params['key']])
            ->asArray()
            ->one();
        if (!$category['is_enable']) {
            return ['is_enable' => 0];
        }
        if (in_array($category['type'], [
            BlockCategory::TYPE_CONTENT,
            BlockCategory::TYPE_IMAGE_LINK,
        ])) {
            // 内容和图片链接没有选项
            return $category;
        }
        // 选项
        $query               = BlockOption::find()
            ->select([
                "label",
                "link",
                "src",
                "is_blank",
                "description",
            ])
            ->andWhere(['=', 'key', $params['key']])
            ->andWhere(['=', 'is_enable', IS_ENABLE_YES])
            ->orderBy('sort_order ASC');
        $category['options'] = $query->asArray()
            ->all();
        return $category;
    }
}