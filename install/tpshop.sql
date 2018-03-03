/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50553
Source Host           : localhost:3306
Source Database       : tpblog

Target Server Type    : MYSQL
Target Server Version : 50553
File Encoding         : 65001

Date: 2018-02-28 23:24:23
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
INSERT INTO `jq_aboutme` VALUES ('aboutme', 'PHP开发从业者');
INSERT INTO `jq_aboutme` VALUES ('wechat', 'wechat');
INSERT INTO `jq_aboutme` VALUES ('QQ', 'QQ123456789');

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
INSERT INTO `jq_admin` VALUES ('1', 'admin', 'e10adc3949ba59abbe56e057f20f883e', '1519738143', '22', '1', '0');

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
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COMMENT='文章表';

-- ----------------------------
-- Records of jq_article
-- ----------------------------

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
) ENGINE=MyISAM AUTO_INCREMENT=43 DEFAULT CHARSET=utf8 COMMENT='文章分类表';

-- ----------------------------
-- Records of jq_article_class
-- ----------------------------
INSERT INTO `jq_article_class` VALUES ('42', null, 'JavaScript', '0', '6');
INSERT INTO `jq_article_class` VALUES ('41', null, 'Miniapp', '0', '5');
INSERT INTO `jq_article_class` VALUES ('40', null, 'MySQL', '0', '4');
INSERT INTO `jq_article_class` VALUES ('37', null, 'HTML', '0', '2');
INSERT INTO `jq_article_class` VALUES ('38', null, 'PHP', '0', '1');
INSERT INTO `jq_article_class` VALUES ('39', null, 'JAVA', '0', '3');

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
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COMMENT='首页设置';

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
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COMMENT='留言表';

-- ----------------------------
-- Records of jq_message_board
-- ----------------------------
INSERT INTO `jq_message_board` VALUES ('2', 'name', '1', '255', null, 'phone', 'infortion', '1501947288');
INSERT INTO `jq_message_board` VALUES ('3', 'name', '0', '255', null, 'phone', 'infortion', '1501947311');
INSERT INTO `jq_message_board` VALUES ('4', '吴某人', '1', '255', '328670712@qq.com', '13760767304', '阿富汗当局', '1505549955');
INSERT INTO `jq_message_board` VALUES ('5', '', '0', '255', '', '', '', '1505698305');

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
INSERT INTO `jq_setting` VALUES ('site_name', 'PHP历程——从零出发');
INSERT INTO `jq_setting` VALUES ('site_logo', '05715883667927707.jpg');
INSERT INTO `jq_setting` VALUES ('member_logo', '05715883667990365.png');
INSERT INTO `jq_setting` VALUES ('seller_center_logo', '05715883668035528.png');
INSERT INTO `jq_setting` VALUES ('site_intro', 'PHP（外文名:PHP: Hypertext Preprocessor，中文名：“超文本预处理器”）是一种通用开源脚本语言。语法吸收了C语言、Java和Perl的特点，利于学习，使用广泛，主要适用于Web开发领域。');

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
) ENGINE=MyISAM AUTO_INCREMENT=199 DEFAULT CHARSET=utf8 COMMENT='上传文件表';

-- ----------------------------
-- Records of jq_upload
-- ----------------------------
INSERT INTO `jq_upload` VALUES ('59', '05540815742747268.png', null, null, '1311', '0', '1', '1500737574', '78');
INSERT INTO `jq_upload` VALUES ('64', '05540928273090373.jpg', null, null, '38569', '0', '1', '1500748827', '81');
INSERT INTO `jq_upload` VALUES ('65', '05540928324499162.jpg', null, null, '13278', '0', '1', '1500748832', '81');
INSERT INTO `jq_upload` VALUES ('95', '05545646940414018.jpg', null, null, '37943', '0', '1', '1501220694', '82');
INSERT INTO `jq_upload` VALUES ('96', '05545646950635763.jpg', null, null, '16762', '0', '1', '1501220695', '82');
INSERT INTO `jq_upload` VALUES ('94', '05545646909793841.jpg', null, null, '83205', '0', '1', '1501220690', '82');
INSERT INTO `jq_upload` VALUES ('71', '05545636009930963.jpg', null, null, '281229', '0', '1', '1501219600', '83');
INSERT INTO `jq_upload` VALUES ('70', '05545635400248062.jpg', null, null, '154873', '0', '1', '1501219540', '75');
INSERT INTO `jq_upload` VALUES ('72', '05545636040423550.jpg', null, null, '261075', '0', '1', '1501219604', '83');
INSERT INTO `jq_upload` VALUES ('73', '05545636797194821.jpg', null, null, '242456', '0', '1', '1501219679', '75');
INSERT INTO `jq_upload` VALUES ('74', '05545637366309294.jpg', null, null, '247924', '0', '1', '1501219736', '84');
INSERT INTO `jq_upload` VALUES ('75', '05545637377169529.jpg', null, null, '273236', '0', '1', '1501219737', '84');
INSERT INTO `jq_upload` VALUES ('76', '05545637802674126.jpg', null, null, '155074', '0', '1', '1501219780', '85');
INSERT INTO `jq_upload` VALUES ('77', '05545637813363923.jpg', null, null, '137256', '0', '1', '1501219781', '85');
INSERT INTO `jq_upload` VALUES ('78', '05545638106335277.jpg', null, null, '239194', '0', '1', '1501219810', '86');
INSERT INTO `jq_upload` VALUES ('79', '05545638116850892.jpg', null, null, '279978', '0', '1', '1501219811', '86');
INSERT INTO `jq_upload` VALUES ('80', '05545638526735990.jpg', null, null, '176355', '0', '1', '1501219852', '87');
INSERT INTO `jq_upload` VALUES ('81', '05545638536866112.jpg', null, null, '183530', '0', '1', '1501219853', '87');
INSERT INTO `jq_upload` VALUES ('82', '05545639119920423.jpg', null, null, '253574', '0', '1', '1501219912', '88');
INSERT INTO `jq_upload` VALUES ('83', '05545639130532882.jpg', null, null, '202951', '0', '1', '1501219913', '88');
INSERT INTO `jq_upload` VALUES ('84', '05545640438186245.jpg', null, null, '222409', '0', '1', '1501220043', '89');
INSERT INTO `jq_upload` VALUES ('85', '05545640468786546.jpg', null, null, '286975', '0', '1', '1501220046', '89');
INSERT INTO `jq_upload` VALUES ('86', '05545640737198420.jpg', null, null, '89630', '0', '1', '1501220073', '90');
INSERT INTO `jq_upload` VALUES ('87', '05545640747880180.jpg', null, null, '54570', '0', '1', '1501220074', '90');
INSERT INTO `jq_upload` VALUES ('88', '05545641191942858.jpg', null, null, '232528', '0', '1', '1501220119', '91');
INSERT INTO `jq_upload` VALUES ('89', '05545641202259567.jpg', null, null, '268732', '0', '1', '1501220120', '91');
INSERT INTO `jq_upload` VALUES ('90', '05545641518773966.jpg', null, null, '192143', '0', '1', '1501220151', '92');
INSERT INTO `jq_upload` VALUES ('91', '05545641529393150.jpg', null, null, '257136', '0', '1', '1501220152', '92');
INSERT INTO `jq_upload` VALUES ('92', '05545641734052069.jpg', null, null, '262554', '0', '1', '1501220173', '93');
INSERT INTO `jq_upload` VALUES ('93', '05545641744345189.jpg', null, null, '230818', '0', '1', '1501220174', '93');
INSERT INTO `jq_upload` VALUES ('97', '05545646960815992.jpg', null, null, '68465', '0', '1', '1501220696', '82');
INSERT INTO `jq_upload` VALUES ('98', '05545646971441112.jpg', null, null, '16762', '0', '1', '1501220697', '82');
INSERT INTO `jq_upload` VALUES ('99', '05545646981751705.jpg', null, null, '104576', '0', '1', '1501220698', '82');
INSERT INTO `jq_upload` VALUES ('100', '05548359037419687.jpg', null, null, '239755', '0', '1', '1501491903', '94');
INSERT INTO `jq_upload` VALUES ('101', '05548359056684034.jpg', null, null, '240110', '0', '1', '1501491905', '94');
INSERT INTO `jq_upload` VALUES ('102', '05548359084275443.jpg', null, null, '177633', '0', '1', '1501491908', '94');
INSERT INTO `jq_upload` VALUES ('103', '05548359126637224.jpg', null, null, '257729', '0', '1', '1501491912', '94');
INSERT INTO `jq_upload` VALUES ('104', '05548359166897068.jpg', null, null, '271486', '0', '1', '1501491916', '94');
INSERT INTO `jq_upload` VALUES ('105', '05548359179930599.jpg', null, null, '268400', '0', '1', '1501491917', '94');
INSERT INTO `jq_upload` VALUES ('106', '05548359200112188.jpg', null, null, '268400', '0', '1', '1501491920', '94');
INSERT INTO `jq_upload` VALUES ('107', '05548359223722233.jpg', null, null, '316226', '0', '1', '1501491922', '94');
INSERT INTO `jq_upload` VALUES ('108', '05548359235693823.jpg', null, null, '177633', '0', '1', '1501491923', '94');
INSERT INTO `jq_upload` VALUES ('110', '05548359406792948.jpg', null, null, '240110', '0', '1', '1501491940', '94');
INSERT INTO `jq_upload` VALUES ('111', '05548359436844804.jpg', null, null, '373425', '0', '1', '1501491943', '94');
INSERT INTO `jq_upload` VALUES ('141', '05590628854849956.png', null, null, '10634', '0', '1', '1505718885', '122');
INSERT INTO `jq_upload` VALUES ('164', '05592228654915004.gif', null, null, '365763', '0', '1', '1505878865', '137');
INSERT INTO `jq_upload` VALUES ('169', '05592238775458338.jpg', null, null, '13094', '0', '1', '1505879877', '140');
INSERT INTO `jq_upload` VALUES ('190', '05593202255718197.jpg', null, null, '50179', '0', '1', '1505976225', '139');
INSERT INTO `jq_upload` VALUES ('144', '05590630720146446.png', null, null, '10634', '0', '1', '1505719072', '125');
INSERT INTO `jq_upload` VALUES ('143', '05590629584344685.png', null, null, '10634', '0', '1', '1505718958', '124');
INSERT INTO `jq_upload` VALUES ('142', '05590629239336081.png', null, null, '10634', '0', '1', '1505718923', '123');
INSERT INTO `jq_upload` VALUES ('189', '05593134821682033.jpg', null, null, '56818', '0', '1', '1505969482', '96');
INSERT INTO `jq_upload` VALUES ('168', '05592234231993050.jpg', null, null, '160105', '0', '1', '1505879423', '115');
INSERT INTO `jq_upload` VALUES ('194', '05593206517129634.png', null, null, '537178', '0', '1', '1505976651', '126');
INSERT INTO `jq_upload` VALUES ('197', '05599966961915113.jpg', null, null, '393061', '0', '1', '1506652696', '171');
INSERT INTO `jq_upload` VALUES ('192', '05593205807165362.png', null, null, '471025', '0', '1', '1505976580', '150');
INSERT INTO `jq_upload` VALUES ('191', '05593202332678137.jpg', null, null, '43537', '0', '1', '1505976233', '139');
INSERT INTO `jq_upload` VALUES ('166', '05592230813742339.jpg', null, null, '43664', '0', '1', '1505879081', '116');
INSERT INTO `jq_upload` VALUES ('138', '05590615031650591.png', null, null, '10634', '0', '1', '1505717503', '119');
INSERT INTO `jq_upload` VALUES ('139', '05590616862949986.png', null, null, '10634', '0', '1', '1505717686', '120');
INSERT INTO `jq_upload` VALUES ('140', '05590628431980164.png', null, null, '10634', '0', '1', '1505718843', '121');
INSERT INTO `jq_upload` VALUES ('160', '05592225499136547.jpg', null, null, '104169', '0', '1', '1505878549', '133');
INSERT INTO `jq_upload` VALUES ('196', '05599964048864705.jpg', null, null, '332265', '0', '1', '1506652404', '170');
INSERT INTO `jq_upload` VALUES ('135', '05590608717350647.png', null, null, '26895', '0', '1', '1505716871', '97');
INSERT INTO `jq_upload` VALUES ('186', '05592330736879338.jpg', null, null, '104169', '0', '1', '1505889073', '157');
INSERT INTO `jq_upload` VALUES ('162', '05592226511664794.jpg', null, null, '104169', '0', '1', '1505878651', '133');
INSERT INTO `jq_upload` VALUES ('181', '05592326540987730.jpg', null, null, '104169', '0', '1', '1505888654', '152');
INSERT INTO `jq_upload` VALUES ('182', '05592327196191486.jpg', null, null, '104169', '0', '1', '1505888719', '153');
INSERT INTO `jq_upload` VALUES ('183', '05592329977781486.jpg', null, null, '104169', '0', '1', '1505888997', '155');
INSERT INTO `jq_upload` VALUES ('184', '05592330313072514.jpg', null, null, '104169', '0', '1', '1505889031', '156');
INSERT INTO `jq_upload` VALUES ('185', '05592330665713625.jpg', null, null, '31778', '0', '1', '1505889066', '158');
INSERT INTO `jq_upload` VALUES ('187', '05592331306794576.jpg', null, null, '104169', '0', '1', '1505889130', '159');
INSERT INTO `jq_upload` VALUES ('198', '05703625328525767.jpg', null, null, '39586', '0', '1', '1517018532', '173');
