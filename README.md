# yii-portal
yii配置组件，包含：网站配置、表头配置、表单配置等


# 使用
## 一、配置

### 1.1 配置控制器 web.php
```php
'controllerMap' => [
    // table 表头控制
    'header-category' => \YiiConfigure\tableHeader\controllers\HeaderCategoryController::class,
    'header-option'   => \YiiConfigure\tableHeader\controllers\HeaderOptionController::class,
    // form 表单控制
    'form-category'   => \YiiConfigure\form\controllers\FormCategoryController::class,
    'form-option'     => \YiiConfigure\form\controllers\FormOptionController::class,
    'form-setting'    => \YiiConfigure\form\controllers\FormSettingController::class,
]
```

### 1.2 配置控制开关 web.php
```php
'components' => [
    'bootAccessLog'  => [
        'class'          => \YiiAccessLog\boots\AccessLogBootstrap::class,
        'accessLogModel' => \YiiAccessLog\models\AccessLogs::class, // 日志模型类
        'open'           => define_var('COM_BOOT_ACCESS_LOG_OPEN', true), // 开启访问日志
        'ignorePaths'    => [
            '*/list', // 列表的日志不记录，太大
        ],
    ],
],
```

### 1.3 组件常量配置 define-local.php
```php
// bootAccessLog 组件配置
defined('COM_BOOT_ACCESS_LOG_OPEN') or define('COM_BOOT_ACCESS_LOG_OPEN', true); // 开启访问日志

```

## 二、面板使用说明
### 2.1 对于表头类型的操作
- 对于"是否开放"字段只有超级管理员能够进行操作
- 对于"开放"的表头类型，只有超级管理员能编辑和删除


### 2.2 对于表单类型的操作
- 对于"是否开放"字段只有超级管理员能够进行操作
- 对于"开放"的表单类型，只有超级管理员能编辑和删除

### 2.3 对于替换配置
- \YiiConfigure\replaceSetting\controllers\ReplaceSettingController, 替换配置的管理(只能超级管理员操作)
- \YiiConfigure\controllers\web\ReplaceSettingController, 只提供给普通管理员修改配置内容
- 解析 replace-setting 内容
    - Action: \YiiConfigure\replaceSetting\actions\ReplaceSettingParse
    - Logic: \YiiConfigure\replaceSetting\logic\ReplaceSetting::getInstance($code)->getContent($fields)



