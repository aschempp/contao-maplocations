-- **********************************************************
-- *                                                        *
-- * IMPORTANT NOTE                                         *
-- *                                                        *
-- * Do not import this file manually but use the TYPOlight *
-- * install tool to create and maintain database tables!   *
-- *                                                        *
-- **********************************************************

-- 
-- Table `tl_map_positions`
-- 

CREATE TABLE `tl_map_locations` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `pid` int(10) unsigned NOT NULL default '0',
  `tstamp` int(10) unsigned NOT NULL default '0',
  `headline` varchar(255) NOT NULL default '',
  `text` mediumtext NULL,
  `mapLocation` varchar(9) NOT NULL default '',
  `addImage` char(1) NOT NULL default '',
  `singleSRC` varchar(255) NOT NULL default '',
  `size` varchar(255) NOT NULL default '',
  `alt` varchar(255) NOT NULL default '',
  `caption` varchar(255) NOT NULL default '',
  `floating` varchar(32) NOT NULL default '',
  `imagemargin` varchar(255) NOT NULL default '',
  `fullsize` char(1) NOT NULL default '',
  `customPin` char(1) NOT NULL default '',
  `pinSRC` varchar(255) NOT NULL default '',
  `linkAddress` char(1) NOT NULL default '',
  `addressId` int(10) unsigned NOT NULL default '0',
  `addressFields` varchar(255) NOT NULL default '',
  `published` char(1) NOT NULL default '',
  PRIMARY KEY  (`id`),
  KEY `pid` (`pid`),
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


-- --------------------------------------------------------

-- 
-- Table `tl_maps`
-- 

CREATE TABLE `tl_maps` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `tstamp` int(10) unsigned NOT NULL default '0',
  `title` varchar(255) NOT NULL default '',
  `description` text NULL,
  `mapImage` varchar(255) NOT NULL default '',
  `customPin` char(1) NOT NULL default '',
  `pinSRC` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


-- --------------------------------------------------------

-- 
-- Table `tl_module`
-- 

CREATE TABLE `tl_module` (
  `map` int(10) unsigned NOT NULL default '0',
  `map_template` varchar(32) NOT NULL default ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

