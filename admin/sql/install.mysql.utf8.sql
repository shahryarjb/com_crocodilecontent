CREATE TABLE IF NOT EXISTS `#__crocodilecontent` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(120) NOT NULL,
  `pic` text NOT NULL,
  `article_id` int(11) NOT NULL,
  `width` varchar(8) NOT NULL,
  `height` varchar(8) NOT NULL,
  `type` tinyint(10) NOT NULL,
  `menudbid` int(120) NOT NULL,
  `custom` text NOT NULL,
  `template_name` text NOT NULL,
  `label_name` varchar(120) NOT NULL,
  `published` tinyint(10) NOT NULL,
  `first_day` date NOT NULL,
  `last_day` date NOT NULL,
  `second_ttl` text NOT NULL,
  `sign` text NOT NULL,
  `attached_file` varchar(512) NOT NULL,
  `filepath` varchar(512) NOT NULL,
  `show_id` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE IF NOT EXISTS `#__label` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `label` varchar(120) NOT NULL,
  `type` tinyint(10) NOT NULL,
  `disc` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
