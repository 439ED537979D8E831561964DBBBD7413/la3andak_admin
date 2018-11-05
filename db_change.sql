--24-08-2018
ALTER TABLE `product` ADD `offer_start_date` DATE NOT NULL AFTER `discounted_price`, ADD `offer_end_date` DATE NOT NULL AFTER `offer_start_date`;
ALTER TABLE `users` ADD `google_token` TEXT NOT NULL AFTER `timestamp`, ADD `facebook_token` TEXT NOT NULL AFTER `google_token`;
ALTER TABLE `users` ADD `mobile_verify` ENUM('Y','N') NOT NULL DEFAULT 'Y' AFTER `google_token`;

ALTER TABLE `users` CHANGE `google_token` `google_token` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL;
ALTER TABLE `users` CHANGE `facebook_token` `facebook_token` TEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL;


