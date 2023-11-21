-- Tabelas com auto incremento para o ID
CREATE TABLE IF NOT EXISTS `ecomerc`.`usuario` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(45) NOT NULL,
  `email` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`)
);

CREATE TABLE IF NOT EXISTS `ecomerc`.`carrinho` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `data` DATETIME NOT NULL,
  `usuario_id` INT NOT NULL,
  `status` VARCHAR(1) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_carrinho_usuario_idx` (`usuario_id` ASC),
  CONSTRAINT `fk_carrinho_usuario`
    FOREIGN KEY (`usuario_id`)
    REFERENCES `ecomerc`.`usuario` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION
);

CREATE TABLE IF NOT EXISTS `ecomerc`.`produto` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(45) NOT NULL,
  `valor` FLOAT NOT NULL,
  `descricao` VARCHAR(245) NOT NULL,
  PRIMARY KEY (`id`)
);

CREATE TABLE IF NOT EXISTS `ecomerc`.`carrinho_produto` (
  `carrinho_id` INT NOT NULL,
  `produto_id` INT NOT NULL,
  PRIMARY KEY (`carrinho_id`, `produto_id`),
  INDEX `fk_carrinho_has_produto_produto1_idx` (`produto_id` ASC),
  INDEX `fk_carrinho_has_produto_carrinho1_idx` (`carrinho_id` ASC),
  CONSTRAINT `fk_carrinho_has_produto_carrinho1`
    FOREIGN KEY (`carrinho_id`)
    REFERENCES `ecomerc`.`carrinho` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_carrinho_has_produto_produto1`
    FOREIGN KEY (`produto_id`)
    REFERENCES `ecomerc`.`produto` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION
);

CREATE TABLE IF NOT EXISTS `ecomerc`.`compra` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `data` DATE NOT NULL,
  `hora` TIME NOT NULL,
  `carrinho_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_compra_carrinho1_idx` (`carrinho_id` ASC),
  CONSTRAINT `fk_compra_carrinho1`
    FOREIGN KEY (`carrinho_id`)
    REFERENCES `ecomerc`.`carrinho` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION
);

-- Inserts para as tabelas
INSERT INTO `ecomerc`.`usuario` (`nome`, `email`) VALUES
('Usuário 1', 'usuario1@example.com'),
('Usuário 2', 'usuario2@example.com'),
('Usuário 3', 'usuario3@example.com');

INSERT INTO `ecomerc`.`carrinho` (`data`, `usuario_id`, `status`) VALUES
('2023-11-15 10:00:00', 1, 'F'),
('2023-11-16 11:30:00', 2, 'P'),
('2023-11-17 09:45:00', 3, 'F');

INSERT INTO `ecomerc`.`produto` (`nome`, `valor`, `descricao`) VALUES
('Produto 1', 20.00, 'Descrição do Produto 1'),
('Produto 2', 30.00, 'Descrição do Produto 2'),
('Produto 3', 40.00, 'Descrição do Produto 3');

INSERT INTO `ecomerc`.`carrinho_produto` (`carrinho_id`, `produto_id`) VALUES
(1, 1),
(1, 2),
(2, 2),
(3, 3);

INSERT INTO `ecomerc`.`compra` (`data`, `hora`, `carrinho_id`) VALUES
('2023-11-15', '10:00:00', 1),
('2023-11-16', '11:30:00', 2);
