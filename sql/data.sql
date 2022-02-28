
-- 表头类型
insert into `yii_configure`.`configure_header_category` ( `key`, `name`, `description`, `sort_order`, `is_open`)
values
( 'backend-replace-setting', '后管系统-替换模版管理', '后管系统-替换模版管理', '127', '0');

-- 表头选项
insert into `yii_configure`.`configure_header_option`
( `key`, `field`, `label`, `width`, `fixed`, `default`, `align`, `is_tooltip`, `is_resizable`, `is_editable`, `component`, `options`, `params`, `description`, `sort_order`, `is_required`, `is_default`, `is_enable`, `operate_ip`, `operate_uid`)
values
( 'backend-replace-setting', '_idx', '序号', '50', 'left', '', '', '0', '0', '0', '', '\"\"', '\"\"', '', '1', '0', '1', '1', '192.168.1.1', '100000000'),
( 'backend-replace-setting', 'code', '标识码', '150', 'left', '', 'left', '0', '0', '0', '', '\"\"', '\"\"', '', '2', '1', '1', '1', '192.168.1.1', '100000000'),
( 'backend-replace-setting', 'name', '配置名称', '150', '', '', 'left', '0', '0', '0', '', '\"\"', '\"\"', '', '3', '1', '1', '1', '192.168.1.1', '100000000'),
( 'backend-replace-setting', 'sort_order', '排序', '80', '', '', 'left', '0', '0', '0', '', '\"\"', '\"\"', '', '4', '1', '1', '1', '192.168.1.1', '100000000'),
( 'backend-replace-setting', 'is_open', '是否开放', '80', '', '', '', '0', '0', '1', '', '\"\"', '{\"type\": \"switch\"}', '', '5', '1', '1', '1', '192.168.1.1', '100000000'),
( 'backend-replace-setting', 'operate', '操作', '', 'right', '', 'left', '0', '0', '0', 'operate', '\"\"', '[]', '', '6', '1', '1', '1', '192.168.1.1', '100000000');

-- 表单类型
insert into `yii_configure`.`configure_form_category` ( `key`, `name`, `description`, `sort_order`, `is_setting`, `is_open`)
values
( 'backend-replace-setting', '后管系统——替换模版管理', '后管系统——替换模版管理', '127', '0', '0');

-- 表单选项
insert into `yii_configure`.`configure_form_option`
( `key`, `field`, `label`, `input_type`, `default`, `description`, `sort_order`, `is_enable`, `exts`, `rules`, `is_required`, `required_msg`)
values
( 'backend-replace-setting', 'code', '标识码', 'input-text', '', '', '1', '1', '\"\"', '\"\"', '1', ''),
( 'backend-replace-setting', 'name', '配置名称', 'input-text', '', '', '2', '1', '\"\"', '\"\"', '1', ''),
( 'backend-replace-setting', 'is_open', '是否开放', 'ele-switch', '', '', '3', '1', '\"\"', '\"\"', '1', ''),
( 'backend-replace-setting', 'sort_order', '排序', 'input-number', '127', '', '4', '1', '\"\"', '\"\"', '1', ''),
( 'backend-replace-setting', 'description', '描述', 'input-area', '', '', '5', '1', '\"\"', '\"\"', '1', ''),
( 'backend-replace-setting', 'replace_fields', '替换字段', 'json-editor', '', '', '6', '1', '\"\"', '\"\"', '0', ''),
( 'backend-replace-setting', 'template', '配置母版', 'vue-editor', '', '', '7', '1', '\"\"', '\"\"', '0', ''),
( 'backend-replace-setting', 'content', '模版', 'vue-editor', '', '', '8', '1', '\"\"', '\"\"', '0', '');
