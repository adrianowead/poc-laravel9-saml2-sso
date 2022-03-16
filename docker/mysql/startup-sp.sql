CREATE TABLE IF NOT EXISTS `meu_banco_local_sp`.`tb_users` (
  `id` VARCHAR(255) NOT NULL,
  `email` VARCHAR(255) NOT NULL,
  `last_login` DATETIME NOT NULL DEFAULT NOW(),
  PRIMARY KEY (`uid`),
  UNIQUE INDEX `uid_UNIQUE` (`uid` ASC) VISIBLE);

CREATE TABLE IF NOT EXISTS `meu_banco_local_sp`.`sessions_spa` (
  `id` VARCHAR(255) NOT NULL,
  `user_id` VARCHAR(255) NULL,
  `ip_address` VARCHAR(45) NULL,
  `user_agent` TEXT NULL,
  `payload` TEXT NULL,
  `last_activity` INTEGER NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC) VISIBLE);

CREATE TABLE IF NOT EXISTS `meu_banco_local_sp`.`sessions_spb` (
  `id` VARCHAR(255) NOT NULL,
  `user_id` VARCHAR(255) NULL,
  `ip_address` VARCHAR(45) NULL,
  `user_agent` TEXT NULL,
  `payload` TEXT NULL,
  `last_activity` INTEGER NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC) VISIBLE);