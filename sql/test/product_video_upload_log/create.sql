CREATE TABLE `product_video_upload_log` (
  `product_video_upload_log_id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `product_video_id` INT(10) UNSIGNED NOT NULL,
  `youtube_video_id` VARCHAR(11) DEFAULT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`product_video_upload_log_id`),
  UNIQUE KEY `product_video_id` (`product_video_id`),
  KEY `created` (`created`)
) ENGINE=InnoDB CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
