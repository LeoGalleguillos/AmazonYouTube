CREATE TABLE `browse_node` (
  `browse_node_id` int unsigned not null auto_increment,
  `name` VARCHAR(255) NOT NULL,
  `active` tinyint(1) unsigned not null default 1,
  PRIMARY KEY (`browse_node_id`),
  UNIQUE `name` (`name`),
  UNIQUE `active_name` (`active`, `name`)
) ENGINE=InnoDB CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
