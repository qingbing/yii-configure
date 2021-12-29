<?php

namespace YiiConfigure\notice\models;


use yii\db\ActiveRecord;
use YiiHelper\abstracts\Model;
use YiiHelper\behaviors\DefaultBehavior;
use YiiHelper\behaviors\IpBehavior;
use YiiHelper\behaviors\UidBehavior;

/**
 * This is the model class for table "configure_notice".
 *
 * @property int $id 自增ID
 * @property string $title 公告标题
 * @property string $tag 公告标签(关键字)
 * @property string $description 公告描述
 * @property string|null $content 公告内容
 * @property string|null $author 显示的发布者
 * @property int $is_top 是否置顶
 * @property int $is_enable 启用状态
 * @property string $expire_ip 有效访问IP地址
 * @property string $expire_begin_date 生效日期
 * @property string $expire_end_date 失效日期
 * @property int $admin_uid 后管发布人员ID
 * @property string $admin_ip 后管发布IP
 * @property int $access_times 访问次数
 * @property string $access_at 最后访问时间
 * @property string $created_at 创建时间
 * @property string $updated_at 更新时间
 */
class Notice extends Model
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%notice}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'tag'], 'required'],
            [['content'], 'string'],
            [['is_top', 'is_enable', 'admin_uid', 'access_times'], 'integer'],
            [['expire_begin_date', 'expire_end_date', 'access_at', 'created_at', 'updated_at'], 'safe'],
            [['title', 'tag', 'description', 'expire_ip'], 'string', 'max' => 255],
            [['author'], 'string', 'max' => 100],
            [['admin_ip'], 'string', 'max' => 15],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id'                => '自增ID',
            'title'             => '公告标题',
            'tag'               => '公告标签(关键字)',
            'description'       => '公告描述',
            'content'           => '公告内容',
            'author'            => '显示的发布者',
            'is_top'            => '是否置顶',
            'is_enable'         => '启用状态',
            'expire_ip'         => '有效访问IP地址',
            'expire_begin_date' => '生效日期',
            'expire_end_date'   => '失效日期',
            'admin_uid'         => '后管发布人员ID',
            'admin_ip'          => '后管发布IP',
            'access_times'      => '访问次数',
            'access_at'         => '最后访问时间',
            'created_at'        => '创建时间',
            'updated_at'        => '更新时间',
        ];
    }

    /**
     * 绑定 behavior
     *
     * @return array
     */
    public function behaviors()
    {
        return [
            [
                'class'      => DefaultBehavior::class,
                'type'       => DefaultBehavior::TYPE_DATE,
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['expire_begin_date', 'expire_end_date'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['expire_begin_date', 'expire_end_date'],
                ],
            ],
            [
                'class'      => DefaultBehavior::class,
                'type'       => DefaultBehavior::TYPE_DATETIME,
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['access_at'],
                ],
            ],
            [
                'class'      => IpBehavior::class,
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => 'admin_ip',
                ],
            ],
            [
                'class'      => UidBehavior::class,
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => 'admin_uid',
                ],
            ],
        ];
    }
}
