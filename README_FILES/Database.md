

# Database instructions


## To create usuarios table:

sql>``` CREATE TABLE IF NOT EXISTS `bienesraices_crud`.`usuarios` (
    `id` INT(2) NOT NULL AUTO_INCREMENT,
    `email` VARCHAR(50) NULL,
    `password` CHAR(60) NULL,
    PRIMARY KEY (`id`))
    ENGINE = InnoDB
    DEFAULT CHARACTER SET = utf8;
    ```