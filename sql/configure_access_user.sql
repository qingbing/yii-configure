-- ----------------------------
--  Table structure for `configure_access_user`
-- ----------------------------
CREATE TABLE `configure_access_user` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `uuid` varchar(50) NOT NULL DEFAULT '' COMMENT '用户/系统标识',
  `public_key` text DEFAULT NULL COMMENT '公钥',
  `private_key` text DEFAULT NULL COMMENT '私钥',
  `private_password` varchar(50) NOT NULL DEFAULT '' COMMENT 'openssl的私钥密码',
  `expire_ip` varchar(255) NOT NULL DEFAULT '' COMMENT '有效IP地址',
  `expire_begin_at` date NOT NULL DEFAULT '1000-01-01' COMMENT '生效日期',
  `expire_end_at` date NOT NULL DEFAULT '1000-01-01' COMMENT '失效日期',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `uk_uuid` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='三方系统访问权限登记';



-- ----------------------------
--  Table structure for `configure_access_user_token`
-- ----------------------------
CREATE TABLE `configure_access_user_token` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `uuid` varchar(50) NOT NULL DEFAULT '' COMMENT '用户/系统标识',
  `access_token` varchar(255) NOT NULL DEFAULT '' COMMENT '访问token',
  `expire_at` datetime NOT NULL COMMENT '有效时间',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  PRIMARY KEY (`id`),
  KEY `idx_uuid` (`uuid`),
  KEY `idx_expireAt` (`expire_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='三方系统访问token记录';


insert into `yii_configure`.`configure_access_user` ( `uuid`, `public_key`, `private_key`, `private_password`, `expire_ip`, `expire_begin_at`, `expire_end_at`, `created_at`, `updated_at`)
values
( 'transmit-portal', 'MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQCrKZhf2ksgP57L29CZ7rl42QVOJiEAvbiv5Q6N8s+rPVHXo/1gR1s/mqdxYHd9UEnm1m7dO2+jG3cglQQpw2pa8GyoaijRKtCV2NaRWLfjvz4IcuVTdOA1facqFOA1JVLQYyqzneOt5RSBHSBKsyqHM4A3mwxriPWFoIWMmmsluwIDAQAB', 'MIIC1DBOBgkqhkiG9w0BBQ0wQTApBgkqhkiG9w0BBQwwHAQIWtY18DMPo2oCAggAMAwGCCqGSIb3DQIJBQAwFAYIKoZIhvcNAwcECBkAOKIMm6QKBIICgLYl3vBWoVxP6MSz1VDZthEG93hkQtqTljtJrEp9QrqS4FvY0tHnLOQjGl6dxK3jvUuByc4O48p/E5FN6j1HFnS+V0qWONChmD8o4SOPJJK/Nat8UyOKE44GIqdWcP5lk5vtTvg56LuCJdlpzQVnHU/KcQ7ulQboE4ZWx+t50H5IPtyq2ovoXRCT0vJqdDpURxv1BMR26Qp4x0gwJUhKRP4KWxSyNRG+zSnG0dpbMOPowvRGqqCp3ILJzFZgQZ4/YWsrKsannGUqPbfAcDme5hIl5ouKaUGmZIVUXHUJQkQztIKEwzoRbyRFcZcy2LIb5/lbpJ45mMig0njpE8R2YI/BZlcAgIt1rYllrxX5pgMEfH9+rZE5VkHOdWu2mNlB+sIX3wAWNKxbnqgmGjpH5VddsT6b4WaG2U3s2ozOmFuZ/xhZfMVpJiH/HXFlNxMsohUwbyhXirDB426bdif46Ba0MKLWnmrs8UX32ixWpxbDFVRKlng6tOC6MO+ooJ7whHLQxrnPwdeF9xbjb5HKX03ym5ml7plloKW0Z5UD3qm7ZCAQR1JE6S0c1wyIwBnRME6QjsCLcbncrZ6Zcv4Lnb52QdvpqSJJgaLJ8RkSyQU/sgL1MdhI4KMv0A5G1KnilxPgkZEZF4ujcLMlM5YtBgEi1od30j64q+a5iJvexyL7avA2kDlmVp4WUuB2xPBwqb9M8PvkA8Upb/2M8v7oKilSLu2bcrOw1pPgnJr4j4M0j84TvZtMATugNpwtnUFMWPpMvRMAmfl1wVOEaxv3HTCCQzMvk8nr8eN95DS6vTGv8SyPupPzHEYhuAODMLithtmxazQz/QDTSAoYKx/9TIo=', 'phpcorner.net', '', '1000-01-01', '1000-01-01', '2021-11-03 16:24:19', '2021-11-06 10:42:52'),
( 'portal', 'MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQC1o1cbhRTFQcQoIXynI6P04fXmxb9NCz6xJK+x37KWSPLQ0XrqY87m1PZC92XDXn/UsXRZpenatE8gEfwawOkC3uGuGcTkk4LFrp/+iodxYxGYDaFrtCaSYwEu0xv585aKr+e22EoJmqYVNS8vAlzNt+zmUg9skE3cMnYy5OoYLQIDAQAB', 'MIIC1DBOBgkqhkiG9w0BBQ0wQTApBgkqhkiG9w0BBQwwHAQINIBnUpLY+RQCAggAMAwGCCqGSIb3DQIJBQAwFAYIKoZIhvcNAwcECK8eIseAq41vBIICgDJamlgi1wiA1D/sQR1gsHxdoAG/Ib5dGwPImc46SeitTg5aOQOMK7RYCliiszz7s35F33nkDUepk8i/wiMNEZzJRpmk6rJ3KxW2FoBaaFhgsBzmzMWtgD+7Qj3qoBk1AALmF8fXn1w1TfwJ5RDHtv/E9u2NbEU31J1W/hmCwHDQ2wbLMnUHsH+3h8GhqQcu5vPQ6OeYtAUSJVUEfZLgXscw0MQTy9fM1LzggKZIQwDshj+UEZIeTSBBIOomIiY7/QBVUHZsr6JbCCO8r5A8ag1f8GDXM5zOauZcfmKcXN0mLOnPhWdOnFJMEvffVlzD+Iu7IKnwbmU4T2TkGVNHzoLG52PqCrJQEEeQscuAqFXukj4Yybq8zDf20NO8AJQDlVvLbnD/0IDyUq82xHxIIg4B8F2FQo64jHzwgE+MVSUc/8/daEKJwUymsiz9y2ki1QLKXJTvMe8GTgmJ4gNRyLXNJVUCgJ9za4pZ7qeOm1eyR/5Jt9DZ17duCFqY5I6UV0Yh9RMKkOO5SwdQfpcgywvwI3O/fcnBI6kaLi5SDq/sRWa/9TqQBWIiEyFbyvKRnDPSbLn/1GGTY6q5ri2iwAzm/yDC0iaM9+64IpmZCsAjA8ZRSsXyH0bnE428lSQEpOVrPezEiVb5c6i4+UgDasUmrxsWGO9kud+dIHrbDm0nTa6R8d3Es48+EcaNxsqJu9v4IKXc3gbvhXUjcOQciiA8TfrBuU7VqU1qi1RFttr3gEPo/81WRBaNPv0Kv+zSODWI1yZ6Q4dTDeeAN/HWGRikx8LcxqO8I2ykjpahgg7Quo7SWYTKUBHXXZpHQxX8/QHvqgtFJPxjdgF5X/98FqU=', 'phpcorner.net', '', '1000-01-01', '1000-01-01', '2021-11-04 10:58:17', '2021-11-06 11:33:56');
