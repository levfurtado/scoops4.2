-- Alter log table
ALTER TABLE `Log` ADD `id` int(10) unsigned NOT NULL AUTO_INCREMENT FIRST, ADD PRIMARY KEY(`id`);
ALTER TABLE `Log` ADD `priority` smallint(1) unsigned NOT NULL DEFAULT '6';
ALTER TABLE `Log` CHANGE `user_ip` `user_ip` VARCHAR(39) NOT NULL DEFAULT '';
ALTER TABLE `Log` DROP KEY `IdEvent`;
ALTER TABLE `Log` ADD KEY `priority` (`priority`);

-- Add Acl Role table
CREATE TABLE IF NOT EXISTS `acl_role` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

-- Add Acl Rule table
CREATE TABLE IF NOT EXISTS `acl_rule` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `type` enum('allow','deny') NOT NULL DEFAULT 'allow',
  `role_id` int(10) NOT NULL,
  `resource` varchar(80) NOT NULL DEFAULT '',
  `action` varchar(80) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  UNIQUE (`role_id`, `resource`, `action`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

-- Add role id to user/group table
ALTER TABLE `liveuser_groups` ADD `role_id` int(10) DEFAULT NULL; -- to be altered to NOT NULL when populated
ALTER TABLE `liveuser_users` ADD `role_id` int(10) DEFAULT NULL; -- to be altered to NOT NULL when populated
ALTER TABLE  `liveuser_users` ADD  `author_id` INT( 10 ) UNSIGNED NULL, ADD INDEX (  `author_id` );

-- Add autoincremet to groups
ALTER TABLE `liveuser_groups` CHANGE `group_id` `group_id` int(11) NOT NULL AUTO_INCREMENT;

-- Remove article audioclips tables
DROP TABLE IF EXISTS `ArticleAudioclips`;
DROP TABLE IF EXISTS `AudioclipMetadata`;


-- Add Ouput table
CREATE TABLE IF NOT EXISTS `output` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE (`name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8; 

INSERT INTO `output` (`name`) VALUES('Web');



-- Add Resources table
CREATE TABLE IF NOT EXISTS `resource` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `path` varchar(200) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE (`path`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8; 



-- Add Output Themes table
CREATE TABLE IF NOT EXISTS `output_theme` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,  
  `fk_output_id` int(10) unsigned NOT NULL,
  `fk_publication_id` int(10) unsigned NOT NULL,
  `fk_theme_path_id` int(10) unsigned NOT NULL,
  `fk_front_page_id` int(10) unsigned NOT NULL,
  `fk_section_page_id` int(10) unsigned NOT NULL,
  `fk_article_page_id` int(10) unsigned NOT NULL,
  `fk_error_page_id` int(10) unsigned NOT NULL,

  PRIMARY KEY (`id`),
  UNIQUE (`fk_output_id`, `fk_publication_id`, `fk_theme_path_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

-- Add Output Issue table
CREATE TABLE IF NOT EXISTS `output_issue` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,  
  `fk_output_id` int(10) unsigned NOT NULL,
  `fk_issue_id` int(10) unsigned NOT NULL,
  `fk_theme_path_id` int(10) unsigned NOT NULL,
  `fk_front_page_id` int(10) unsigned,
  `fk_section_page_id` int(10) unsigned,
  `fk_article_page_id` int(10) unsigned,
  `fk_error_page_id` int(10) unsigned,

  PRIMARY KEY (`id`),
  UNIQUE (`fk_output_id`, `fk_issue_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;


-- Add Output Section table
CREATE TABLE IF NOT EXISTS `output_section` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,  
  `fk_output_id` int(10) unsigned NOT NULL,
  `fk_section_id` int(10) unsigned NOT NULL,
  `fk_front_page_id` int(10) unsigned,
  `fk_section_page_id` int(10) unsigned,
  `fk_article_page_id` int(10) unsigned,
  `fk_error_page_id` int(10) unsigned,

  PRIMARY KEY (`id`),
  UNIQUE (`fk_output_id`, `fk_section_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;


 -- The issue table will no longer need the TPL (emaplate) fields
 -- Change the old code to also provide for the section the issue foreign key. ***

ALTER TABLE `Issues` ADD COLUMN `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT FIRST,
DROP PRIMARY KEY,
ADD PRIMARY KEY  USING BTREE(`id`);
ALTER TABLE `Issues` ADD UNIQUE INDEX `issue_unique`(`IdPublication`, `Number`, `IdLanguage`);

ALTER TABLE `Sections` ADD COLUMN `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT FIRST,
DROP PRIMARY KEY,
ADD PRIMARY KEY  USING BTREE(`id`);
ALTER TABLE `Sections` ADD UNIQUE INDEX `section_unique`(`IdPublication`, `NrIssue`, `IdLanguage`, `Number`);


ALTER TABLE `Sections` ADD COLUMN `fk_issue_id` INTEGER UNSIGNED NOT NULL AFTER `id`;

ALTER TABLE `Publications` 
 ADD COLUMN `comments_public_enabled` tinyint(1)  NOT NULL DEFAULT '0' AFTER `comments_public_moderated`,
 ADD COLUMN `comments_moderator_to` VARCHAR(255)  NOT NULL DEFAULT '' AFTER `comments_spam_blocking_enabled`,
 ADD COLUMN `comments_moderator_from` VARCHAR(255)  NOT NULL DEFAULT '' AFTER `comments_moderator_to`;

-- Comment main table
DROP TABLE IF EXISTS `comment`;
CREATE TABLE IF NOT EXISTS  `comment` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `fk_comment_commenter_id` int(10) unsigned NOT NULL,
  `fk_forum_id` int(10) unsigned NOT NULL,
  `fk_thread_id` int(10) unsigned NOT NULL DEFAULT '0',
  `fk_language_id` int(10) unsigned DEFAULT '0',  
  `fk_parent_id` int(10) unsigned DEFAULT NULL,
  `subject` varchar(140) NOT NULL DEFAULT '',
  `message` text NOT NULL,
  `thread_order` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `thread_level` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `status` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `ip` varchar(39) NOT NULL DEFAULT '',
  `likes` tinyint(3) unsigned DEFAULT '0',
  `dislikes` tinyint(3) unsigned DEFAULT '0',
  `time_created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `time_updated` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `recommended` tinyint(1) unsigned DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `comments_users` (`fk_comment_commenter_id`),
  KEY `publication` (`fk_forum_id`),
  KEY `article` (`fk_thread_id`),
  KEY `parent` (`fk_parent_id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

-- Comment Commenter main table
DROP TABLE IF EXISTS `comment_commenter`;
CREATE TABLE  `comment_commenter` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `fk_user_id` int(10) unsigned DEFAULT NULL,
  `email` varchar(100) NOT NULL DEFAULT '',
  `url` varchar(255) NOT NULL DEFAULT '',
  `name` varchar(100) NOT NULL DEFAULT '',
  `ip` varchar(39) NOT NULL DEFAULT '',
  `time_created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `time_updated` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

-- Comment Acceptance main table
DROP TABLE IF EXISTS `comment_acceptance`;
CREATE TABLE  `comment_acceptance` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `fk_forum_id` int(10) DEFAULT '0',
  `for_column` tinyint(4) NOT NULL DEFAULT '0',
  `type` tinyint(4) NOT NULL DEFAULT '0',
  `search_type` tinyint(4) NOT NULL DEFAULT '0',
  `search` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `fk_forum_id` (`fk_forum_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- Update SubsSections
ALTER TABLE `SubsSections` MODIFY COLUMN `IdLanguage` INTEGER UNSIGNED DEFAULT NULL,
 ADD COLUMN `id` INTEGER UNSIGNED NOT NULL AUTO_INCREMENT FIRST,
 DROP PRIMARY KEY,
 ADD PRIMARY KEY (`id`),
 ADD UNIQUE (`IdSubscription`, `SectionNumber`, `IdLanguage`);

-- Tables for context box
CREATE TABLE IF NOT EXISTS `context_articles` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `fk_context_id` int(10) NOT NULL,
  `fk_article_no` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


CREATE TABLE IF NOT EXISTS `context_boxes` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `fk_article_no` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=21 ;


-- Feedback main table
DROP TABLE IF EXISTS `feedback`;
CREATE TABLE `feedback` (
   `id` int(11) not null auto_increment,
   `user_id` int(11),
   `section_id` int(11),
   `publication_id` int(11),
   `article_language` int(11),
   `article_number` int(11),
   `subject` varchar(128),
   `message` varchar(2048) not null,
   `status` tinyint(1) unsigned not null,
   `url` varchar(128) not null,
   `time_created` datetime not null,
   `time_updated` datetime not null,
   `attachment_type` int(1),
   `attachment_id` int(11),
   PRIMARY KEY (`id`),
   KEY `user` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- user_subscription main table
DROP TABLE IF EXISTS `user_subscription`;
CREATE TABLE `user_subscription` (
   `id` int(11) unsigned not null auto_increment,
   `user_id` int(11) unsigned,
   `subscription_type` int(1),
   `time_begin` datetime,
   `time_end` datetime,
   `subscription` int(11),
   PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

-- User topics table
DROP TABLE IF EXISTS `user_topic`;
CREATE TABLE `user_topic` (
  `user_id` int(11) unsigned NOT NULL,
  `topic_id` int(11) unsigned NOT NULL,
  `topic_language` int(11) unsigned NOT NULL,
  PRIMARY KEY (`user_id`,`topic_id`,`topic_language`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Article playlist tables 
DROP TABLE IF EXISTS `playlist`;
CREATE TABLE `playlist` (
  `id_playlist` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(256) NOT NULL,
  `notes` varchar(1024) DEFAULT NULL,
  PRIMARY KEY (`id_playlist`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `playlist_article`;
CREATE TABLE `playlist_article` (
  `id_playlist_article` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_playlist` int(10) unsigned NOT NULL,
  `article_no` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id_playlist_article`),
  UNIQUE KEY `id_playlist` (`id_playlist`,`article_no`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


-- Update Images
ALTER TABLE `Images`
 ADD COLUMN `Source` enum('local','feedback','newsfeed') not null default 'local',
 ADD COLUMN `Status` enum('unapproved','approved') not null default 'approved',
 DROP PRIMARY KEY,
 ADD PRIMARY KEY (`id`);

-- Update Attachments
ALTER TABLE `Attachments`
 ADD COLUMN `Source` enum('local','feedback') not null default 'local',
 ADD COLUMN `Status` enum('unapproved','approved') not null default 'approved',
 DROP PRIMARY KEY,
 ADD PRIMARY KEY (`id`);

-- Upgrade templates to themes
system php ./create_themes.php

-- Importing the stored function for 'Point in Polygon' checking
system php ./checkpp.php

-- Update from 3.6
ALTER TABLE `liveuser_users` ADD `last_name` varchar(80) DEFAULT NULL;
ALTER TABLE `liveuser_users` ADD `status` tinyint(1) NOT NULL DEFAULT '0';
ALTER TABLE `liveuser_users` ADD `is_admin` boolean NOT NULL DEFAULT '0';
ALTER TABLE `liveuser_users` ADD `is_public` boolean NOT NULL DEFAULT '0';
ALTER TABLE `liveuser_users` ADD `points` int(10) DEFAULT '0';
ALTER TABLE `liveuser_users` CHANGE `time_created` `time_created` datetime NOT NULL;
ALTER TABLE `liveuser_users` CHANGE `time_updated` `time_updated` timestamp DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP;
ALTER TABLE `liveuser_users` ADD `image` varchar(255) DEFAULT NULL;
ALTER TABLE `liveuser_users` ADD `subscriber` int(10) DEFAULT NULL;

UPDATE `liveuser_users` SET `status` = 1, `is_public` = 1;
UPDATE liveuser_users l0_ INNER JOIN liveuser_groupusers l2_ ON l0_.Id = l2_.perm_user_id INNER JOIN liveuser_groups l1_ ON l1_.group_id = l2_.group_id AND (l1_.group_id IN (SELECT `group_id` FROM `liveuser_groups`)) SET l0_.is_admin = true;

DROP TABLE IF EXISTS `audit_event`;
CREATE TABLE IF NOT EXISTS `audit_event` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned DEFAULT NULL,
  `resource_type` varchar(80) NOT NULL,
  `resource_id` varchar(80) DEFAULT NULL,
  `resource_title` varchar(255) DEFAULT NULL,
  `resource_diff` longtext,
  `action` varchar(80) NOT NULL,
  `created` datetime NOT NULL,
  `is_public` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `user_attribute`;
CREATE TABLE IF NOT EXISTS `user_attribute` (
  `user_id` int(11) unsigned NOT NULL,
  `attribute` varchar(255) NOT NULL,
  `value` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`user_id`,`attribute`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `community_ticker_event`;
CREATE TABLE IF NOT EXISTS `community_ticker_event` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `event` varchar(80) NOT NULL,
  `params` text,
  `created` datetime NOT NULL,
  `user_id` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `user_points_index`;
CREATE TABLE IF NOT EXISTS `user_points_index` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `action` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL DEFAULT '',
  `points` int(10) NOT NULL DEFAULT '0',
  `enabled` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `user_token`;
CREATE TABLE IF NOT EXISTS `user_token` (
  `user_id` int(11) unsigned NOT NULL,
  `action` varchar(40) NOT NULL,
  `token` varchar(40) NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`user_id`,`action`,`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `article_datetimes`;
CREATE TABLE `article_datetimes` (
  `id_article_datetime` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `start_time` time DEFAULT NULL COMMENT 'NULL = 00:00',
  `end_time` time DEFAULT NULL COMMENT 'NULL = 24:00',
  `start_date` date NOT NULL,
  `end_date` date DEFAULT NULL COMMENT 'NULL = no end',
  `recurring` enum('daily','weekly','monthly','yearly') DEFAULT NULL,
  `article_id` int(10) unsigned NOT NULL,
  `article_type` varchar(166) NOT NULL,
  `field_name` varchar(166) NOT NULL,
--  `event_comment` TEXT, -- being set a 3.6.x upgrade roll set
  PRIMARY KEY (`id_article_datetime`),
  KEY `article_id` (`article_id`),
  KEY `start_time` (`start_time`),
  KEY `end_time` (`end_time`),
  KEY `start_date` (`start_date`),
  KEY `end_date` (`end_date`),
  KEY `article_type` (`article_type`),
  KEY `field_name` (`field_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Image renditions

CREATE TABLE IF NOT EXISTS `ArticleRendition` (
  `image_id` int(11) NOT NULL,
  `rendition_id` varchar(255) NOT NULL,
  `articleNumber` int(11) NOT NULL,
  `imageSpecs` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`articleNumber`,`image_id`,`rendition_id`),
  KEY `IDX_794B8A6C3DA5256D` (`image_id`),
  KEY `IDX_794B8A6CFD656AA1` (`rendition_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `package` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rendition_id` varchar(255) DEFAULT NULL,
  `headline` varchar(255) NOT NULL,
  `description` longtext,
  `slug` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_DE686795989D9B62` (`slug`),
  KEY `IDX_DE686795FD656AA1` (`rendition_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

CREATE TABLE IF NOT EXISTS `package_article` (
  `id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `package_article_package` (
  `article_id` int(11) NOT NULL,
  `package_id` int(11) NOT NULL,
  PRIMARY KEY (`article_id`,`package_id`),
  KEY `IDX_BB5F0F827294869C` (`article_id`),
  KEY `IDX_BB5F0F82F44CABFF` (`package_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `package_item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `package_id` int(11) DEFAULT NULL,
  `image_id` int(11) DEFAULT NULL,
  `offset` int(11) NOT NULL,
  `caption` varchar(255) DEFAULT NULL,
  `coords` varchar(255) DEFAULT NULL,
  `video_url` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_A45640D6F44CABFF` (`package_id`),
  KEY `IDX_A45640D63DA5256D` (`image_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

CREATE TABLE IF NOT EXISTS `rendition` (
  `name` varchar(255) NOT NULL,
  `width` int(11) NOT NULL,
  `height` int(11) NOT NULL,
  `specs` varchar(255) NOT NULL,
  `offset` int(11) DEFAULT NULL,
  `label` varchar(80) DEFAULT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE `Images`
    ADD `width` int(5) DEFAULT NULL,
    ADD `height` int(5) DEFAULT NULL;

ALTER TABLE `ArticleImages`
    ADD `is_default` int(1) DEFAULT NULL;

ALTER TABLE `package_article_package`
  ADD CONSTRAINT `package_article_package_ibfk_1` FOREIGN KEY (`article_id`) REFERENCES `package_article` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `package_article_package_ibfk_2` FOREIGN KEY (`package_id`) REFERENCES `package` (`id`) ON DELETE CASCADE;

