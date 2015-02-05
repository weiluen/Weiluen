-- WordPress Backup to Dropbox SQL Dump
-- Version 1.3
-- http://wpb2d.com
-- Generation Time: November 22, 2012 at 00:25

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Create and use the backed up database
--

CREATE DATABASE IF NOT EXISTS wrd_k4g2n25ccb;
USE wrd_k4g2n25ccb;

--
-- Table structure for table `wp_ngg_album`
--

CREATE TABLE `wp_ngg_album` (
  `id` bigint(20) NOT NULL auto_increment,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `previewpic` bigint(20) NOT NULL default '0',
  `albumdesc` mediumtext,
  `sortorder` longtext NOT NULL,
  `pageid` bigint(20) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Table `wp_ngg_album` is empty
--

--
-- Table structure for table `wp_ngg_gallery`
--

CREATE TABLE `wp_ngg_gallery` (
  `gid` bigint(20) NOT NULL auto_increment,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `path` mediumtext,
  `title` mediumtext,
  `galdesc` mediumtext,
  `pageid` bigint(20) NOT NULL default '0',
  `previewpic` bigint(20) NOT NULL default '0',
  `author` bigint(20) NOT NULL default '0',
  PRIMARY KEY  (`gid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Table `wp_ngg_gallery` is empty
--

--
-- Table structure for table `wp_ngg_pictures`
--

CREATE TABLE `wp_ngg_pictures` (
  `pid` bigint(20) NOT NULL auto_increment,
  `image_slug` varchar(255) NOT NULL,
  `post_id` bigint(20) NOT NULL default '0',
  `galleryid` bigint(20) NOT NULL default '0',
  `filename` varchar(255) NOT NULL,
  `description` mediumtext,
  `alttext` mediumtext,
  `imagedate` datetime NOT NULL default '0000-00-00 00:00:00',
  `exclude` tinyint(4) default '0',
  `sortorder` bigint(20) NOT NULL default '0',
  `meta_data` longtext,
  PRIMARY KEY  (`pid`),
  KEY `post_id` (`post_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Table `wp_ngg_pictures` is empty
--

--
-- Table structure for table `wp_pp_thesaurus_g2t`
--

CREATE TABLE `wp_pp_thesaurus_g2t` (
  `g` mediumint(8) unsigned NOT NULL,
  `t` mediumint(8) unsigned NOT NULL,
  UNIQUE KEY `gt` (`g`,`t`),
  KEY `tg` (`t`,`g`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci DELAY_KEY_WRITE=1;

--
-- Table `wp_pp_thesaurus_g2t` is empty
--

--
-- Table structure for table `wp_pp_thesaurus_id2val`
--

CREATE TABLE `wp_pp_thesaurus_id2val` (
  `id` mediumint(8) unsigned NOT NULL,
  `misc` tinyint(1) NOT NULL default '0',
  `val` text collate utf8_unicode_ci NOT NULL,
  `val_type` tinyint(1) NOT NULL default '0',
  UNIQUE KEY `id` (`id`,`val_type`),
  KEY `v` (`val`(64))
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci DELAY_KEY_WRITE=1;

--
-- Table `wp_pp_thesaurus_id2val` is empty
--

--
-- Table structure for table `wp_pp_thesaurus_o2val`
--

CREATE TABLE `wp_pp_thesaurus_o2val` (
  `id` mediumint(8) unsigned NOT NULL,
  `misc` tinyint(1) NOT NULL default '0',
  `val_hash` char(32) collate utf8_unicode_ci NOT NULL,
  `val` text collate utf8_unicode_ci NOT NULL,
  UNIQUE KEY `id` (`id`),
  KEY `vh` (`val_hash`),
  KEY `v` (`val`(64))
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci DELAY_KEY_WRITE=1;

--
-- Table `wp_pp_thesaurus_o2val` is empty
--

--
-- Table structure for table `wp_pp_thesaurus_s2val`
--

CREATE TABLE `wp_pp_thesaurus_s2val` (
  `id` mediumint(8) unsigned NOT NULL,
  `misc` tinyint(1) NOT NULL default '0',
  `val_hash` char(32) collate utf8_unicode_ci NOT NULL,
  `val` text collate utf8_unicode_ci NOT NULL,
  UNIQUE KEY `id` (`id`),
  KEY `vh` (`val_hash`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci DELAY_KEY_WRITE=1;

--
-- Table `wp_pp_thesaurus_s2val` is empty
--

--
-- Table structure for table `wp_pp_thesaurus_setting`
--

CREATE TABLE `wp_pp_thesaurus_setting` (
  `k` char(32) collate utf8_unicode_ci NOT NULL,
  `val` text collate utf8_unicode_ci NOT NULL,
  UNIQUE KEY `k` (`k`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci DELAY_KEY_WRITE=1;

--
-- Table `wp_pp_thesaurus_setting` is empty
--

--
-- Table structure for table `wp_pp_thesaurus_triple`
--

CREATE TABLE `wp_pp_thesaurus_triple` (
  `t` mediumint(8) unsigned NOT NULL,
  `s` mediumint(8) unsigned NOT NULL,
  `p` mediumint(8) unsigned NOT NULL,
  `o` mediumint(8) unsigned NOT NULL,
  `o_lang_dt` mediumint(8) unsigned NOT NULL,
  `o_comp` char(35) collate utf8_unicode_ci NOT NULL,
  `s_type` tinyint(1) NOT NULL default '0',
  `o_type` tinyint(1) NOT NULL default '0',
  `misc` tinyint(1) NOT NULL default '0',
  UNIQUE KEY `t` (`t`),
  KEY `sp` (`s`,`p`),
  KEY `os` (`o`,`s`),
  KEY `po` (`p`,`o`),
  KEY `misc` (`misc`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci DELAY_KEY_WRITE=1;

--
-- Table `wp_pp_thesaurus_triple` is empty
--

--
-- Table structure for table `wp_w3tc_cdn_queue`
--

CREATE TABLE `wp_w3tc_cdn_queue` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `local_path` varchar(150) NOT NULL default '',
  `remote_path` varchar(150) NOT NULL default '',
  `command` tinyint(1) unsigned NOT NULL default '0' COMMENT '1 - Upload, 2 - Delete, 3 - Purge',
  `last_error` varchar(150) NOT NULL default '',
  `date` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `path` (`local_path`,`remote_path`),
  KEY `date` (`date`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Table `wp_w3tc_cdn_queue` is empty
--

