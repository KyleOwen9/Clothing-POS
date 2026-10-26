-- create table named acc_db first :
 
CREATE TABLE `acc_db`.`user` (`id` INT NOT NULL AUTO_INCREMENT , `user_name` VARCHAR(255) NOT NULL , `password` VARCHAR(255) NOT NULL , `name` VARCHAR(255) NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;

-- second insert these values :

INSERT INTO `user` (`id`, `user_name`, `password`, `name`) VALUES (NULL, 'cashier', '1000', 'cashier'), (NULL, 'owner', '9999', 'owner')