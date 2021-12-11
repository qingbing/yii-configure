<?php

namespace YiiConfigure\form\models;


use YiiHelper\abstracts\Model;

/**
 * This is the model class for table "{{%form_setting}}".
 *
 * @property string $key 表单分类（来自form_category）
 * @property string|null $values 表单配置项目值
 */
class FormSetting extends Model
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%form_setting}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['key'], 'required'],
            [['values'], 'safe'],
            [['key'], 'string', 'max' => 100],
            [['key'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'key'    => '表单分类（来自form_category）',
            'values' => '表单配置项目值',
        ];
    }
}
