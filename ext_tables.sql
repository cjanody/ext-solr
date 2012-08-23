#
# Table structure for table 'tx_solr_last_searches'
#
CREATE TABLE tx_solr_last_searches (
	sequence_id tinyint(3) unsigned DEFAULT '0' NOT NULL,
	tstamp int(11) DEFAULT '0' NOT NULL,
	keywords varchar(128) DEFAULT '' NOT NULL,

	PRIMARY KEY (sequence_id)
) ENGINE=InnoDB;


#
# Table structure for table 'tx_solr_statistics'
#
CREATE TABLE tx_solr_statistics (
	uid int(11) NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,
	root_pid int(11) DEFAULT '0' NOT NULL,
	tstamp int(11) DEFAULT '0' NOT NULL,
	language int(11) DEFAULT '0' NOT NULL,

	num_found int(11) DEFAULT '0' NOT NULL,
	suggestions_shown int(1) DEFAULT '0' NOT NULL,
	time_total int(11) DEFAULT '0' NOT NULL,
	time_preparation int(11) DEFAULT '0' NOT NULL,
	time_processing int(11) DEFAULT '0' NOT NULL,

	feuser_id int(11) unsigned DEFAULT '0' NOT NULL,
	cookie varchar(10) DEFAULT '' NOT NULL,
	ip varchar(255) DEFAULT '' NOT NULL,

	keywords varchar(128) DEFAULT '' NOT NULL,
	page int(5) unsigned DEFAULT '0' NOT NULL,
	filters blob,
	sorting varchar(128) DEFAULT '' NOT NULL,
	parameters blob,

	PRIMARY KEY (uid),
	KEY keywords (keywords),
	KEY rootpid_keywords (root_pid,keywords)
) ENGINE=InnoDB;


#
# Table structure for table 'tx_solr_indexqueue_item'
#
CREATE TABLE tx_solr_indexqueue_item (
	uid int(11) NOT NULL auto_increment,

	root int(11) DEFAULT '0' NOT NULL,

	item_type varchar(255) DEFAULT '' NOT NULL,
	item_uid int(11) DEFAULT '0' NOT NULL,
	indexing_configuration varchar(255) DEFAULT '' NOT NULL,
	has_indexing_properties tinyint(1) DEFAULT '0' NOT NULL,
	indexing_priority int(11) DEFAULT '0' NOT NULL,
	changed int(11) DEFAULT '0' NOT NULL,
	indexed int(11) DEFAULT '0' NOT NULL,
	errors text NOT NULL,

	PRIMARY KEY (uid),
	KEY changed (changed),
	KEY item_id (item_type,item_uid)
) ENGINE=InnoDB;


#
# Table structure for table 'tx_solr_indexqueue_indexing_property'
#
CREATE TABLE tx_solr_indexqueue_indexing_property (
	uid int(11) NOT NULL auto_increment,

	root int(11) DEFAULT '0' NOT NULL,
	item_id int(11) DEFAULT '0' NOT NULL,

	property_key varchar(255) DEFAULT '' NOT NULL,
	property_value mediumtext NOT NULL,

	PRIMARY KEY (uid),
	KEY item_id (item_id)
) ENGINE=InnoDB;
