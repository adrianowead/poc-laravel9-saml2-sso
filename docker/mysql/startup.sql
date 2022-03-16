CREATE TABLE IF NOT EXISTS `meu_auth_db`.`tb_users` (
  `uid` VARCHAR(255) NOT NULL,
  `name` VARCHAR(255) NOT NULL,
  `email` VARCHAR(45) NULL,
  `password` VARBINARY(255) NOT NULL,
  `salt` VARBINARY(255) NOT NULL DEFAULT 'MD5(RAND())',
  PRIMARY KEY (`uid`),
  UNIQUE INDEX `uid_UNIQUE` (`uid` ASC) VISIBLE);

DROP TRIGGER IF EXISTS `meu_auth_db`.`tb_users_BEFORE_INSERT`;

DELIMITER $$
USE `meu_auth_db`$$
CREATE DEFINER = CURRENT_USER TRIGGER `meu_auth_db`.`tb_users_BEFORE_INSERT` BEFORE INSERT ON `tb_users` FOR EACH ROW
BEGIN
  -- salt nao pode ser escolhido, por seguranca
	SET NEW.salt = MD5(rand());

	SET NEW.password = AES_ENCRYPT(CONCAT(NEW.salt, NEW.password), "727640ffa77f7a33fa06d2fb");
END$$
DELIMITER ;

DROP TRIGGER IF EXISTS `meu_auth_db`.`tb_users_BEFORE_UPDATE`;

DELIMITER $$
USE `meu_auth_db`$$
CREATE DEFINER = CURRENT_USER TRIGGER `meu_auth_db`.`tb_users_BEFORE_UPDATE` BEFORE UPDATE ON `tb_users` FOR EACH ROW
BEGIN
  -- nao permitir troca de salt
	IF (NEW.salt IS NOT NULL) THEN
		SET NEW.salt = OLD.salt;
  END IF;

  -- manter hash atualizada
  IF (NEW.password IS NOT NULL) THEN
		SET NEW.password = AES_ENCRYPT(CONCAT(NEW.password, OLD.salt), "727640ffa77f7a33fa06d2fb");
  END IF;
END$$
DELIMITER ;


-- criar usuario exemplo, se ainda não existir
INSERT INTO `meu_auth_db`.`tb_users` (uid, name, email, password)
SELECT * FROM (SELECT UUID(), 'Adriano Maciel', 'adriano_mail@hotmail.com', '123enter') AS tmp
WHERE NOT EXISTS (
    SELECT name FROM `meu_auth_db`.`tb_users` WHERE email = 'adriano_mail@hotmail.com'
) LIMIT 1;
