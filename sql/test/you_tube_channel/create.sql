CREATE TABLE `you_tube_channel` (
  `you_tube_channel_id` INT UNSIGNED NOT NULL,
  `browse_node_id` INT UNSIGNED DEFAULT NULL,
  `access_token` VARCHAR(255) DEFAULT NULL,
  `access_token_expiration` DATETIME DEFAULT NULL,
  `refresh_token` VARCHAR(255) DEFAULT NULL,
  PRIMARY KEY (`you_tube_channel_id`),
  UNIQUE `browse_node_id` (`browse_node_id`)
) ENGINE=InnoDB CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
