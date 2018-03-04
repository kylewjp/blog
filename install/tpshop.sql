/*
Navicat MySQL Data Transfer

Source Server         : 本地数据库
Source Server Version : 50540
Source Host           : localhost:3306
Source Database       : tpblog

Target Server Type    : MYSQL
Target Server Version : 50540
File Encoding         : 65001

Date: 2018-03-04 14:53:45
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `jq_aboutme`
-- ----------------------------
DROP TABLE IF EXISTS `jq_aboutme`;
CREATE TABLE `jq_aboutme` (
  `name` varchar(50) NOT NULL COMMENT '名称',
  `value` text COMMENT '值',
  PRIMARY KEY (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of jq_aboutme
-- ----------------------------
INSERT INTO `jq_aboutme` VALUES ('aboutme', '个人博客，技术积累。');
INSERT INTO `jq_aboutme` VALUES ('wechat', 'wechat');
INSERT INTO `jq_aboutme` VALUES ('QQ', '328670712');

-- ----------------------------
-- Table structure for `jq_admin`
-- ----------------------------
DROP TABLE IF EXISTS `jq_admin`;
CREATE TABLE `jq_admin` (
  `admin_id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '管理员ID',
  `admin_name` varchar(20) NOT NULL COMMENT '管理员名称',
  `admin_password` varchar(32) NOT NULL DEFAULT '' COMMENT '管理员密码',
  `admin_login_time` int(10) NOT NULL DEFAULT '0' COMMENT '登录时间',
  `admin_login_num` int(11) NOT NULL DEFAULT '0' COMMENT '登录次数',
  `admin_is_super` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否超级管理员',
  `admin_gid` smallint(6) DEFAULT '0' COMMENT '权限组ID',
  PRIMARY KEY (`admin_id`),
  KEY `member_id` (`admin_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='管理员表';

-- ----------------------------
-- Records of jq_admin
-- ----------------------------
INSERT INTO `jq_admin` VALUES ('1', 'admin', 'e10adc3949ba59abbe56e057f20f883e', '1520145743', '6', '1', '0');

-- ----------------------------
-- Table structure for `jq_admin_log`
-- ----------------------------
DROP TABLE IF EXISTS `jq_admin_log`;
CREATE TABLE `jq_admin_log` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `content` varchar(50) NOT NULL COMMENT '操作内容',
  `createtime` int(10) unsigned DEFAULT NULL COMMENT '发生时间',
  `admin_name` char(20) NOT NULL COMMENT '管理员',
  `admin_id` mediumint(8) unsigned NOT NULL DEFAULT '0' COMMENT '管理员ID',
  `ip` char(15) NOT NULL COMMENT 'IP',
  `url` varchar(50) NOT NULL DEFAULT '' COMMENT 'act&op',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='管理员操作日志';

-- ----------------------------
-- Records of jq_admin_log
-- ----------------------------

-- ----------------------------
-- Table structure for `jq_article`
-- ----------------------------
DROP TABLE IF EXISTS `jq_article`;
CREATE TABLE `jq_article` (
  `article_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '索引id',
  `ac_id` mediumint(8) unsigned NOT NULL DEFAULT '0' COMMENT '分类id',
  `article_url` varchar(100) DEFAULT NULL COMMENT '跳转链接',
  `article_show` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '是否显示，0为否，1为是，默认为1',
  `article_sort` tinyint(3) unsigned NOT NULL DEFAULT '200' COMMENT '排序',
  `article_title` varchar(100) DEFAULT NULL COMMENT '标题',
  `article_content` text COMMENT '内容',
  `article_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '发布时间',
  PRIMARY KEY (`article_id`),
  KEY `ac_id` (`ac_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='文章表';

-- ----------------------------
-- Records of jq_article
-- ----------------------------
INSERT INTO `jq_article` VALUES ('1', '2', '', '1', '255', '安装docker', '=============================================================<br />\r\n相关服务指令<br />\r\n查看容器<br />\r\ndocker ps -a&nbsp;<br />\r\n开启容器<br />\r\ndocker start containerID<br />\r\n关闭容器<br />\r\ndocker stop containerID<br />\r\n进入容器<br />\r\ndocker attach containerID<br />\r\n删除容器<br />\r\ndocker rm containerID<br />\r\n查看镜像<br />\r\ndocker images<br />\r\n删除镜像<br />\r\ndocker rmi IMAGE ID<br />\r\n打开容器<br />\r\ndocker exec -it myapp-php /bin/bash<br />\r\n<br />\r\ndocker login<br />\r\n<p>\r\n	【帐号】\r\n</p>\r\n<p>\r\n	【密码】\r\n</p>\r\n<br />\r\ndocker commit -m \"nginx\" -a \"wjp328670712\" 79c761f627f3 hub.c.163.com/wjp328670712/mysql<br />\r\ndocker push wjp328670712/nginx<br />\r\n<br />\r\n==============================================================<br />\r\n1. 下载docker binary<br />\r\nmkdir /docker<br />\r\ncd /docker<br />\r\nyum -y install wget<br />\r\nwget https://get.docker.com/builds/Linux/x86_64/docker-1.11.0.tgz&nbsp;<br />\r\n<br />\r\n2、解压缩,安装<br />\r\n<br />\r\ntar xzf docker-1.11.0.tgz&nbsp;<br />\r\nmv docker/* /usr/bin<br />\r\n<br />\r\n3、创建docker组<br />\r\n<br />\r\ngroupadd docker&nbsp;<br />\r\nusermod -aG docker $USER<br />\r\n<br />\r\n4、配置docker服务&nbsp;<br />\r\n<br />\r\nwget https://github.com/docker/docker/raw/v1.11.2/contrib/init/systemd/docker.service -O /usr/lib/systemd/system/docker.service<br />\r\n<br />\r\nwget https://github.com/docker/docker/raw/v1.11.2/contrib/init/systemd/docker.socket -O /usr/lib/systemd/system/docker.socket<br />\r\n<br />\r\nsystemctl daemon-reload<br />\r\nsystemctl enable docker.service<br />\r\n<br />\r\nreboot&nbsp;<br />\r\n<br />\r\n5、如果无法运行<br />\r\nvi&nbsp; /etc/yum.repos.d/docker.repo<br />\r\n[dockerrepo]<br />\r\nname=Docker Repository<br />\r\nbaseurl=https://yum.dockerproject.org/repo/main/centos/$releasever/<br />\r\nenabled=1<br />\r\ngpgcheck=1<br />\r\ngpgkey=https://yum.dockerproject.org/gpg<br />\r\n#:wq<br />\r\n<br />\r\nyum -y install docker-engine<br />\r\n<br />\r\n<br />\r\n6、加载镜像<br />\r\n<br />\r\n查看系统镜像容器：docker ps -a<br />\r\n查看已下载的镜像：docker images<br />\r\n下载镜像：docker pull [镜像名字] 如： docker pull centos<br />\r\n运行镜像为容器：docker run -it [镜像名字] 如: docker run -it centos<br />\r\n<br />\r\ndocker commit -m \"Added nginx from ubuntu14.04\" -a \"saymagic\" 79c761f627f3 saymagic/ubuntu-nginx:v1<br />\r\n【其中，-m参数用来来指定提交的说明信息；-a可以指定用户信息的；79c761f627f3代表的是容器的id；saymagic/ubuntu-nginx:v1指定目标镜像的用户名、仓库名和tag 信息。创建成功后会返回这个镜像的ID信息。注意的是，你一定要将saymagic改为你自己的用户名。因为下文还会用到此用户名。相关参数可以docker ps -a查看】<br />\r\n<br />\r\n【官网推送（速度慢一点）】<br />\r\n登录后台系统：docker login<span> </span>（输入帐号密码即可）<br />\r\n推送镜像到dockerhub后台:docker push [版本名字]<br />\r\n如： docker push saymagic/ubuntu-nginx:v1<br />\r\n<br />\r\n【国内推送（网易蜂巢）】<br />\r\ndocker login hub.c.163.com<br />\r\n邮箱注册用户，蜂巢账号为邮箱帐号；<br />\r\n手机注册用户，蜂巢账号为手机号码登录；<br />\r\n<br />\r\n返回「Login Succeded」即为登录成功。<br />\r\n<br />\r\ndocker login hub.c.163.com<br />\r\n<br />\r\ndocker commit -m \"full=ssh+mysql+php+apache2\" -a \"wjp328670712\" e674623bbf5b hub.c.163.com/wjp328670712/lamp<br />\r\ndocker push hub.c.163.com/wjp328670712/lamp<br />\r\n<br />\r\ndocker tag [镜像名或ID] hub.c.163.com/[你的用户名]/[标签名]<br />\r\ndocker push hub.c.163.com/[你的用户名]/[标签名]<br />\r\n<br />\r\n参考连接<br />\r\nhttp://kb.cnblogs.com/page/536115/<br />\r\nhttp://www.jb51.net/yunying/461750.html<br />', '1520093730');

-- ----------------------------
-- Table structure for `jq_article_class`
-- ----------------------------
DROP TABLE IF EXISTS `jq_article_class`;
CREATE TABLE `jq_article_class` (
  `ac_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '索引ID',
  `ac_code` varchar(20) DEFAULT NULL COMMENT '分类标识码',
  `ac_name` varchar(100) NOT NULL COMMENT '分类名称',
  `ac_parent_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '父ID',
  `ac_sort` tinyint(1) unsigned NOT NULL DEFAULT '255' COMMENT '排序',
  PRIMARY KEY (`ac_id`),
  KEY `ac_parent_id` (`ac_parent_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='文章分类表';

-- ----------------------------
-- Records of jq_article_class
-- ----------------------------
INSERT INTO `jq_article_class` VALUES ('1', null, 'Linux', '0', '2');
INSERT INTO `jq_article_class` VALUES ('2', null, 'docker', '0', '1');

-- ----------------------------
-- Table structure for `jq_friendlink`
-- ----------------------------
DROP TABLE IF EXISTS `jq_friendlink`;
CREATE TABLE `jq_friendlink` (
  `friendlink_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '索引id',
  `friendlink_title` varchar(100) DEFAULT NULL COMMENT '标题',
  `friendlink_url` varchar(100) DEFAULT NULL COMMENT '跳转链接',
  `friendlink_show` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '是否显示，0为否，1为是，默认为1',
  `friendlink_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '发布时间',
  PRIMARY KEY (`friendlink_id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COMMENT='友情连接表';

-- ----------------------------
-- Records of jq_friendlink
-- ----------------------------
INSERT INTO `jq_friendlink` VALUES ('3', '区块链技术视频网站', 'http://www.kongyixueyuan.com/', '1', '1518013633');
INSERT INTO `jq_friendlink` VALUES ('4', '以太坊官网', 'https://www.ethereum.org/', '1', '1518013654');
INSERT INTO `jq_friendlink` VALUES ('5', 'Solidity', 'https://solidity.readthedocs.io/en/develop/', '1', '1518014214');
INSERT INTO `jq_friendlink` VALUES ('6', 'Truffle FrameWork', 'http://truffleframework.com/', '1', '1518014227');
INSERT INTO `jq_friendlink` VALUES ('7', 'Embark FrameWork', 'http://embark.readthedocs.io/', '1', '1518014240');
INSERT INTO `jq_friendlink` VALUES ('8', 'IBM开源技术微讲堂', 'https://www.ibm.com/developerworks/community/groups/service/html/communityview?communityUuid=3302cc3', '1', '1518014555');
INSERT INTO `jq_friendlink` VALUES ('9', 'Bitcoin.com', 'https://www.bitcoin.com/', '1', '1518014566');
INSERT INTO `jq_friendlink` VALUES ('10', 'bitshares1-core', 'https://github.com/bitshares/bitshares1-core', '1', '1518014578');
INSERT INTO `jq_friendlink` VALUES ('11', 'ipfs官网', 'https://ipfs.io/', '1', '1518014590');
INSERT INTO `jq_friendlink` VALUES ('12', 'ipfs中文网', 'http://ipfser.org/', '1', '1518014602');

-- ----------------------------
-- Table structure for `jq_gadmin`
-- ----------------------------
DROP TABLE IF EXISTS `jq_gadmin`;
CREATE TABLE `jq_gadmin` (
  `gid` smallint(5) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增id',
  `gname` varchar(50) DEFAULT NULL COMMENT '组名',
  `limits` text COMMENT '权限内容',
  PRIMARY KEY (`gid`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COMMENT='权限组';

-- ----------------------------
-- Records of jq_gadmin
-- ----------------------------
INSERT INTO `jq_gadmin` VALUES ('2', '前台管理', '55nbl6gg1u0QnUkSFlmRCOZACSsM3hY9KtwodLgeItzOeV1h2ZPKybUGy3fCDzTBPkLIvoLzwgJIAjp');
INSERT INTO `jq_gadmin` VALUES ('4', '后台管理', 'lrn-nwiHVIoX7UsDt0OUJv3UP9jLEvj8Dp0ec-3UP4k7M5gO363vYw6krGhrUHg9D1yfkqzzP4lr8Hj-X11-sH3UvFk7cqg-PnyesH3UvFk7cqf93n1PkH0jbDgrs5mOT01NU-4kn3gLcHi-Hr1-c_1zbEnbk9i-b2x_sE6jj5lbsBheX_4fY92TTFlbs6isD-zuc53T__ncI9i9712e862CbDgrA-i9_t4fY92TTFlbs6isDo2uQv2jDEhM47jtDz0Po02TX1g8c5gN3v0-0H3jb_j8Y7jtDq4fY61zXKjMQvgePC2-UAzT_7k84thd3y4eM0zUnFkLo6jJ_zxuQs0TzSjrsujtD5zeU7mD7FjLY-mN7vxPg63T_FkXAyi9Dq1NU4zzX3hLcHidrp1-U-1jbGT7k6i9X5xOIs3UrSjrsujtD5zeU7mD7FjLY-f93n1Pkq2jDJlc44hdT40Pkz2UeEkbc9j9D0xuIH2zD5k7E-hND2k_Yw3ErFj7M3e97n0-cy00PDirU9i-Tu0PX53jzIkLE5fd3p0ec-3UPDirU9i-Tu0PX53jzIkLE5fd3p0ec-3SbCisU_mN7vxPg63T_FkXA-kND4yvI41zrIjMUzi-G01Po63Dz1jrM5fdjr4eM0zUnFkLo6jJ_p0OM40zXKnb80f-P11O463fX5jL84gd_6wOMs2Dj9hs44hdT40Pkz2UeEgrYBmN7vxPg63T_FkXAsgOfl0uc5zz77nbU4j8DzxuQs0TzSgL8-e9r0yesD6jrDkKEsjuXvxOIw6jrDkKEsjuXvxOIwyTrCgsU-mNTz1NU71zrKlsQwmNTz1NU71zrKlsQwe9Tyxvk-6jrDkKE-jNbpzuc36jrDkKE5fefvyOc_1zbEnbU4j8D6xu0HzTTJfLU6id7r0_oHzTDIgL4we-Tr2fo02D6EirAvgenCxO89zTP7fL8widPr1-Iw4DzCT7s5gUNb-4ek03DrChqEuiNL51PIu10n5jbcqidL0xu0w6jr_k7U3gcD6zes400P5isQuiNbl0us4zDzInbU0jtTyytU02D3Fk78Hf9r4xOIwyUr7lcY0iti0xuoByTT3j7MygXGG');

-- ----------------------------
-- Table structure for `jq_mb_home`
-- ----------------------------
DROP TABLE IF EXISTS `jq_mb_home`;
CREATE TABLE `jq_mb_home` (
  `h_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '索引',
  `h_title` varchar(6) NOT NULL COMMENT '标题',
  `h_desc` varchar(10) NOT NULL COMMENT '描述',
  `h_img` varchar(100) NOT NULL COMMENT '图片',
  `h_keyword` varchar(6) NOT NULL COMMENT '关键字',
  `h_sort` tinyint(3) unsigned NOT NULL DEFAULT '255' COMMENT '排序',
  `h_type` varchar(10) NOT NULL COMMENT '类型 (type1 type2)',
  `h_multi_keyword` varchar(50) DEFAULT NULL COMMENT '多关键字',
  `h_url` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`h_id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COMMENT='首页设置';

-- ----------------------------
-- Records of jq_mb_home
-- ----------------------------

-- ----------------------------
-- Table structure for `jq_message_board`
-- ----------------------------
DROP TABLE IF EXISTS `jq_message_board`;
CREATE TABLE `jq_message_board` (
  `message_board_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '索引id',
  `message_board_name` varchar(20) DEFAULT NULL COMMENT '留言姓名',
  `message_board_show` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '是否显示，0为否，1为是，默认为1',
  `message_board_sort` tinyint(3) unsigned NOT NULL DEFAULT '255' COMMENT '排序',
  `message_board_email` varchar(100) DEFAULT NULL COMMENT '留言邮箱',
  `message_board_phone` varchar(20) DEFAULT NULL COMMENT '留言手机',
  `message_board_content` text COMMENT '留言内容',
  `message_board_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '留言发布时间',
  PRIMARY KEY (`message_board_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='留言表';

-- ----------------------------
-- Records of jq_message_board
-- ----------------------------
INSERT INTO `jq_message_board` VALUES ('1', '', '0', '255', '', '', '', '1505698305');
INSERT INTO `jq_message_board` VALUES ('2', 'name', '1', '255', null, 'phone', 'infortion', '1501947288');

-- ----------------------------
-- Table structure for `jq_setting`
-- ----------------------------
DROP TABLE IF EXISTS `jq_setting`;
CREATE TABLE `jq_setting` (
  `name` varchar(50) NOT NULL COMMENT '名称',
  `value` text COMMENT '值',
  PRIMARY KEY (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='系统设置表';

-- ----------------------------
-- Records of jq_setting
-- ----------------------------
INSERT INTO `jq_setting` VALUES ('site_name', '吴佳鹏');
INSERT INTO `jq_setting` VALUES ('site_logo', '05734897907424955.jpg');
INSERT INTO `jq_setting` VALUES ('member_logo', '05734899124860268.jpg');
INSERT INTO `jq_setting` VALUES ('seller_center_logo', '05734903156075852.jpg');
INSERT INTO `jq_setting` VALUES ('site_intro', '2014年毕业于：广东海洋大学 软件工程专业。');

-- ----------------------------
-- Table structure for `jq_upload`
-- ----------------------------
DROP TABLE IF EXISTS `jq_upload`;
CREATE TABLE `jq_upload` (
  `upload_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '索引ID',
  `file_name` varchar(100) DEFAULT NULL COMMENT '文件名',
  `file_thumb` varchar(100) DEFAULT NULL COMMENT '缩微图片',
  `file_wm` varchar(100) DEFAULT NULL COMMENT '水印图片',
  `file_size` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '文件大小',
  `store_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '店铺ID，0为管理员',
  `upload_type` tinyint(1) NOT NULL DEFAULT '0' COMMENT '文件类别，0为无，1为文章图片，默认为0，2为商品切换图片，3为商品内容图片，4为系统文章图片，5为积分礼品切换图片，6为积分礼品内容图片',
  `upload_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '添加时间',
  `item_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '信息ID',
  PRIMARY KEY (`upload_id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COMMENT='上传文件表';

-- ----------------------------
-- Records of jq_upload
-- ----------------------------