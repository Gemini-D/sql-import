# ************************************************************
# Sequel Ace SQL dump
# 版本号： 20067
#
# https://sequel-ace.com/
# https://github.com/Sequel-Ace/Sequel-Ace
#
# 主机: 127.0.0.1 (MySQL 5.7.38-log)
# 数据库: sworder
# 生成时间: 2024-07-14 06:48:55 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
SET NAMES utf8mb4;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE='NO_AUTO_VALUE_ON_ZERO', SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# 转储表 users
# ------------------------------------------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `openid` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT 'OpenID',
  `nickname` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '昵称',
  `avatar` varchar(256) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '头像',
  `created_at` datetime NOT NULL DEFAULT '2022-01-01 00:00:00',
  `updated_at` datetime NOT NULL DEFAULT '2022-01-01 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQUE_OPENID` (`openid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='用户表';

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;

INSERT INTO `users` (`id`, `openid`, `nickname`, `avatar`, `created_at`, `updated_at`)
VALUES
	(1,'oce1K5XJCQ2GDuMN4QSGZ7mHJWzs','李铭昕','https://thirdwx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTIAY8nicWdB83Dey694QOqLbNeuU6tkiakux0MaQqiaeiasLicy1kOd4qPyBBDlOZjOAicDcmfmSf20IIXg/132','2022-01-01 00:00:00','2022-01-01 00:00:00');

/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
