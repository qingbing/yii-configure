<?php

namespace YiiConfigure\notice\models;


use YiiHelper\abstracts\Model;

/**
 * This is the model class for table "configure_notice_access_log".
 *
 * @property int $id 自增ID
 * @property int $notice_id 公告ID
 * @property string $ip 登录IP
 * @property int $uid 用户ID
 * @property int $access_times 访问次数
 * @property string $created_at 首次访问时间
 * @property string $updated_at 最后访问时间
 */
class NoticeAccessLog extends Model
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'configure_notice_access_log';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['notice_id', 'ip'], 'required'],
            [['notice_id', 'uid', 'access_times'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['ip'], 'string', 'max' => 15],
            [['notice_id', 'ip', 'uid'], 'unique', 'targetAttribute' => ['notice_id', 'ip', 'uid']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id'           => '自增ID',
            'notice_id'    => '公告ID',
            'ip'           => '登录IP',
            'uid'          => '用户ID',
            'access_times' => '访问次数',
            'created_at'   => '首次访问时间',
            'updated_at'   => '最后访问时间',
        ];
    }
}
