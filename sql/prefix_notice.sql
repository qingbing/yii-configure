-- ----------------------------
--  Table structure for `{{%notice}}`
-- ----------------------------
CREATE TABLE IF NOT EXISTS `{{%notice}}` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  -- 后管添加信息
  `title` varchar(255) NOT NULL COMMENT '公告标题',
  `tag` varchar(255) NOT NULL COMMENT '公告标签(关键字)',
  `description` varchar(255) NOT NULL DEFAULT '' COMMENT '公告描述',
  `content` text DEFAULT NULL COMMENT '公告内容',
  `author` varchar(100) DEFAULT NULL COMMENT '显示的发布者',
  `is_top` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否置顶',
  `is_enable` tinyint(1) NOT NULL DEFAULT '1' COMMENT '启用状态',
  `expire_ip` varchar(255) NOT NULL DEFAULT '' COMMENT '有效访问IP地址',
  `expire_begin_date` date NOT NULL DEFAULT '1000-01-01' COMMENT '生效日期',
  `expire_end_date` date NOT NULL DEFAULT '1000-01-01' COMMENT '失效日期',
  -- 自动填充信息
  `admin_uid` bigint(20) unsigned NOT NULL COMMENT '后管发布人员ID',
  `admin_ip` varchar(15) NOT NULL DEFAULT '' COMMENT '后管发布IP',
  -- 访问信息
  `access_times` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '访问次数',
  `access_at` datetime NOT NULL DEFAULT '1000-01-01 01:01:01' COMMENT '最后访问时间',
  -- 时间信息
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '更新时间',
  PRIMARY KEY (`id`),
  KEY `idx_isEnable` (`is_enable`),
  KEY `idx_expireBeginDate` (`expire_begin_date`),
  KEY `idx_expireEndDate` (`expire_end_date`),
  KEY `idx_accessTimes` (`access_times`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='公告管理';

-- ----------------------------
--  Table structure for `{{%notice_access_log}}`
-- ----------------------------
CREATE TABLE IF NOT EXISTS `{{%notice_access_log}}` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `notice_id` bigint(20) unsigned NOT NULL COMMENT '公告ID',
  `ip` varchar(15) NOT NULL COMMENT '登录IP',
  `uid` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '用户ID',
  `access_times` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '访问次数',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '首次访问时间',
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '最后访问时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `idx_noticeId_ip_uid` (`notice_id`,`ip`,`uid`),
  KEY `idx_noticeId` (`notice_id`),
  KEY `idx_uid` (`uid`),
  KEY `idx_accessTimes` (`access_times`),
  KEY `idx_createdAt` (`created_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='公告访问记录';
