CREATE TABLE `browse_node_channel` (
  `browse_node_channel_id` int unsigned not null auto_increment,
  `browse_node_id` INT(10) UNSIGNED NOT NULL,
  `channel_id` INT(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`browse_node_channel_id`)
) ENGINE=InnoDB CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
